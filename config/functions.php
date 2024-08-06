<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ghaffar-farm";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
function uploadImage($fileInputName, $targetDirectory, $oldFotoPath = null)
{
    global $conn;
    // Menetapkan nama file tujuan
    $targetFile = $targetDirectory . basename($_FILES[$fileInputName]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

    // Cek apakah file gambar atau bukan
    $check = getimagesize($_FILES[$fileInputName]["tmp_name"]);
    if ($check === false) {
        $_SESSION['message'] = "file bukan gambar.";
        $_SESSION['message_type'] = 'error';
        return false;
    }

    // Cek ukuran file (batas 1MB)
    if ($_FILES[$fileInputName]["size"] > 1000000) {
        $_SESSION['message'] = "Ukuran file terlalu besar.";
        $_SESSION['message_type'] = 'error';
        return false;
    }

    // Izinkan format file tertentu
    if (!in_array($imageFileType, ['jpg', 'jpeg', 'png', 'gif'])) {
        $_SESSION['message'] = "Hanya mengizinkan file JPG, JPEG, PNG & GIF.";
        $_SESSION['message_type'] = 'error';
        return false;
    }

    // Cek apakah $uploadOk diset ke 0 karena kesalahan
    if ($uploadOk == 0) {
        $_SESSION['message'] = "Foto yang dipilih tidak sesuai.";
        $_SESSION['message_type'] = 'error';
        return false;
    } else {
        // Mengupload file
        if (move_uploaded_file($_FILES[$fileInputName]["tmp_name"], $targetFile)) {
            // Hapus foto lama jika ada
            if ($oldFotoPath && file_exists($oldFotoPath)) {
                unlink($oldFotoPath);
            }
            return basename($targetFile);
        } else {
            $_SESSION['message'] = "Ada yang salah saat mengupload foto.";
            $_SESSION['message_type'] = 'error';
            return false;
        }
    }
}

function getAllData($tableName)
{
    global $conn;

    $sql = "SELECT * FROM " . $tableName;
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $data = [];
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
        return $data;
    } else {
        return [];
    }
}

function insertSponsor($sponsor, $fileInputName)
{
    global $conn;
    $targetDirectory = __DIR__ . "/../assets/images/sponsor/";

    // Handle file upload
    $uploadResult = uploadImage($fileInputName, $targetDirectory);
    if (strpos($uploadResult, 'Sorry') === 0) {
        return $uploadResult; // Kembalikan pesan kesalahan jika ada
    }

    // Insert data ke database
    $sql = "INSERT INTO sponsor (sponsor, foto) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('ss', $sponsor, $uploadResult);

    if ($stmt->execute()) {
        return "Sponsor added successfully";
    } else {
        return "Error adding sponsor: " . $conn->error;
    }
    $stmt->close();
}


function updateSponsor($id, $sponsor, $fileInputName)
{
    global $conn;
    $targetDirectory = __DIR__ . "/../assets/images/sponsor/";
    $oldFilePath = null;

    // Ambil path foto lama dari database
    $sql = "SELECT foto FROM sponsor WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $stmt->bind_result($oldFilePath);
    $stmt->fetch();
    $stmt->close();

    // Handle file upload jika ada file
    $newFilePath = $oldFilePath; // Gunakan path foto lama secara default
    if (isset($_FILES[$fileInputName]) && $_FILES[$fileInputName]['error'] === UPLOAD_ERR_OK) {
        $uploadResult = uploadImage($fileInputName, $targetDirectory, $oldFilePath);

        if (strpos($uploadResult, 'Sorry') === 0) {
            return $uploadResult; // Kembalikan pesan kesalahan jika ada
        } else {
            $newFilePath = $uploadResult;
        }
    }

    // Update data di database
    $sql = "UPDATE sponsor SET sponsor=?, foto=? WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('ssi', $sponsor, $newFilePath, $id);
    if ($stmt->execute()) {
        return "Sponsor updated successfully";
    } else {
        return "Error updating sponsor: " . $conn->error;
    }
    $stmt->close();
}

function deleteSponsor($id)
{
    global $conn;

    // Ambil path foto dari database
    $sql = "SELECT foto FROM sponsor WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $stmt->bind_result($filePath);
    $stmt->fetch();
    $stmt->close();

    // Hapus data dari database
    $sql = "DELETE FROM sponsor WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $id);

    if ($stmt->execute()) {
        // Hapus file dari server
        if ($filePath && file_exists($filePath)) {
            unlink($filePath);
        }
        return "Sponsor deleted successfully";
    } else {
        return "Error deleting sponsor: " . $conn->error;
    }
    $stmt->close();
}


function updateHome($id, $deskripsi_dashboard)
{
    global $conn;
    $sql = "UPDATE home SET deskripsi_dashboard=? WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('si', $deskripsi_dashboard, $id);
    if ($stmt->execute()) {
        return "Record updated successfully";
    } else {
        return "Error updating record: " . $conn->error;
    }
    $stmt->close();
    $conn->close();
}

function insertAdmin($username, $password, $petugas)
{
    global $conn;

    // Hash password sebelum menyimpannya ke database
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Insert data ke database
    $sql = "INSERT INTO admin (username, password, status) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('sss', $username, $hashedPassword, $petugas);

    if ($stmt->execute()) {
        return "Admin added successfully";
    } else {
        return "Error adding admin: " . $conn->error;
    }
    $stmt->close();
}

function updateAdmin($id, $username, $password = null)
{
    global $conn;

    // Jika password diisi, maka hash password dan update, jika tidak biarkan password lama
    if ($password) {
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
        $sql = "UPDATE admin SET username=?, password=? WHERE id=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('ssi', $username, $hashedPassword, $id);
    } else {
        $sql = "UPDATE admin SET username=? WHERE id=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('si', $username, $id);
    }

    if ($stmt->execute()) {
        return "Admin updated successfully";
    } else {
        return "Error updating admin: " . $conn->error;
    }
    $stmt->close();
}

function getAdminDataBySessionId()
{
    global $conn;

    // Periksa apakah sesi admin_id sudah diatur
    if (isset($_SESSION['admin_id'])) {
        $admin_id = $_SESSION['admin_id'];

        // Query untuk mengambil data admin berdasarkan admin_id
        $sql = "SELECT * FROM admin WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('i', $admin_id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $adminData = $result->fetch_assoc();
            $stmt->close();
            return $adminData;
        } else {
            $stmt->close();
            return null;
        }
    } else {
        return null;
    }
}

function recordLoginTime($id_admin)
{
    global $conn;

    // Periksa apakah sudah ada login untuk admin ini
    $sql_check = "SELECT COUNT(*) FROM login WHERE id_admin = ?";
    $stmt_check = $conn->prepare($sql_check);
    $stmt_check->bind_param('i', $id_admin);
    $stmt_check->execute();
    $stmt_check->bind_result($count);
    $stmt_check->fetch();
    $stmt_check->close();

    if ($count > 0) {
        // Jika sudah ada, update waktu login
        $sql_update = "UPDATE login SET waktu = NOW() WHERE id_admin = ?";
        $stmt_update = $conn->prepare($sql_update);
        $stmt_update->bind_param('i', $id_admin);

        if ($stmt_update->execute()) {
            $stmt_update->close();
            return "Login time updated successfully";
        } else {
            $stmt_update->close();
            return "Error updating login time: " . $conn->error;
        }
    } else {
        // Jika belum ada, insert data login baru
        $sql_insert = "INSERT INTO login (id_admin, waktu) VALUES (?, NOW())";
        $stmt_insert = $conn->prepare($sql_insert);
        $stmt_insert->bind_param('i', $id_admin);

        if ($stmt_insert->execute()) {
            $stmt_insert->close();
            return "Login time recorded successfully";
        } else {
            $stmt_insert->close();
            return "Error recording login time: " . $conn->error;
        }
    }
}


function login($username, $password)
{
    global $conn;

    // Cari admin berdasarkan username
    $sql = "SELECT id, password, status FROM admin WHERE username=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('s', $username);
    $stmt->execute();
    $stmt->bind_result($id, $hashedPassword, $status);
    $stmt->fetch();
    $stmt->close();

    // Verifikasi password
    if (password_verify($password, $hashedPassword)) {
        // Jika login berhasil, catat waktu login
        recordLoginTime($id);
        return ['id' => $id, 'status' => $status]; // Kembalikan array yang berisi ID admin dan status
    } else {
        return false; // Kembalikan false jika login gagal
    }
}

function updateLayanan($id, $kelebihan, $mengapa_ghaffar, $fotoFileInputName)
{
    session_start();
    global $conn;
    $targetDirectory = __DIR__ . "/../assets/images/layanan/";
    $oldFotoPath = null;

    // Ambil path foto lama dari database
    $sql = "SELECT foto FROM layanan WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $stmt->bind_result($oldFotoPath);
    $stmt->fetch();
    $stmt->close();

    // Handle file upload jika ada file
    $newFotoPath = $oldFotoPath; // Gunakan path foto lama secara default
    if (isset($_FILES[$fotoFileInputName]) && $_FILES[$fotoFileInputName]['error'] === UPLOAD_ERR_OK) {
        $uploadResult = uploadImage($fotoFileInputName, $targetDirectory, $oldFotoPath);

        if ($uploadResult === false) {
            header("Location: HalamanLayanan.php?id=$id");
            exit();
        } else {
            $newFotoPath = $uploadResult;
        }
    }

    // Update data di database
    $sql = "UPDATE layanan SET kelebihan=?, mengapa_ghaffar=?, foto=? WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('sssi', $kelebihan, $mengapa_ghaffar, $newFotoPath, $id);
    if ($stmt->execute()) {
        $_SESSION['message'] = "Berhasil memperbarui Data layanan";
        $_SESSION['message_type'] = 'success';
    } else {
        $_SESSION['message'] = "Gagal Memperbarui Data Layanan" . $stmt->error;
        $_SESSION['message_type'] = 'error';
    }
    $stmt->close();

    header("Location: HalamanLayanan.php?id=$id");
    exit();
}

function updateInvestasi($id, $jangka_investasi, $jlh_investasi, $fotoFileInputName)
{
    session_start();
    global $conn;
    $targetDirectory = __DIR__ . "/../assets/images/investasi/";
    $oldFotoPath = null;

    // Ambil path foto lama dari database
    $sql = "SELECT foto FROM investasi WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $stmt->bind_result($oldFotoPath);
    $stmt->fetch();
    $stmt->close();

    // Handle file upload jika ada file
    $newFotoPath = $oldFotoPath; // Gunakan path foto lama secara default
    if (isset($_FILES[$fotoFileInputName]) && $_FILES[$fotoFileInputName]['error'] === UPLOAD_ERR_OK) {
        $uploadResult = uploadImage($fotoFileInputName, $targetDirectory, $oldFotoPath);

        if ($uploadResult === false) {
            header("Location: HalamanLayanan.php?id=$id");
            exit();
        } else {
            $newFotoPath = $uploadResult;
        }
    }

    // Update data di database
    $sql = "UPDATE investasi SET jangka_investasi=?, jlh_investasi=?, foto=? WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('sssi', $jangka_investasi, $jlh_investasi, $newFotoPath, $id);
    if ($stmt->execute()) {
        $_SESSION['message'] = "Berhasil memperbarui data Investasi";
        $_SESSION['message_type'] = 'success';
    } else {
        $_SESSION['message'] = "Gagal memperbarui data Investasi" . $stmt->error;
        $_SESSION['message_type'] = 'error';
    }
    $stmt->close();

    header("Location: HalamanLayanan.php?id=$id");
    exit();
}
function uploadLegalitas($fileInputName)
{
    global $conn;
    $targetDirectory = __DIR__ . "/../assets/pdf/legalitas/";
    $filePath = null;

    if (isset($_FILES[$fileInputName]) && $_FILES[$fileInputName]['error'] === UPLOAD_ERR_OK) {
        $fileType = strtolower(pathinfo($_FILES[$fileInputName]['name'], PATHINFO_EXTENSION));
        if ($fileType != 'pdf') {
            $_SESSION['message'] = "Hanya boleh file PDF yang diupload.";
            $_SESSION['message_type'] = 'error';
            return null;
        }

        $fileName = basename($_FILES[$fileInputName]["name"]);
        $filePath = $targetDirectory . $fileName;

        if (move_uploaded_file($_FILES[$fileInputName]["tmp_name"], $filePath)) {
            return $fileName;
        } else {
            $_SESSION['message'] = "Maaf, terjadi masalah saat mengunggah file. Silakan coba lagi.";
            $_SESSION['message_type'] = 'error';
            return null;
        }
    }

    $_SESSION['message'] = "File tidak ditemukan.";
    $_SESSION['message_type'] = 'error';
    return null;
}

function updateLegalitas($id, $fileInputName, $sertifikat)
{
    global $conn;
    $targetDirectory = __DIR__ . "../../assets/pdf/legalitas/"; // Pastikan path benar
    $oldFilePath = null;

    // Ambil nama file lama dari database
    $sql = "SELECT legalitas FROM legalitas WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $stmt->bind_result($oldFileName); // Nama file lama, bukan path
    $stmt->fetch();
    $stmt->close();

    $oldFilePath = $targetDirectory . $oldFileName; // Gabungkan dengan path direktori

    // Handle file upload jika ada file
    $newFileName = $oldFileName; // Gunakan nama file lama sebagai default
    if (isset($_FILES[$fileInputName]) && $_FILES[$fileInputName]['error'] === UPLOAD_ERR_OK) {
        $uploadResult = uploadLegalitas($fileInputName);

        if ($uploadResult === null) {
            // Gagal upload, redirect dengan pesan error
            $_SESSION['message'] = "Gagal mengupload file.";
            $_SESSION['message_type'] = 'error';
            header("Location: ../dashboard/HalamanLegalitas.php");
            exit();
        } else {
            $newFileName = $uploadResult; // Update dengan nama file baru
        }
    }

    // Update data di database
    $sql = "UPDATE legalitas SET sertifikat=?, legalitas=? WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('ssi', $sertifikat, $newFileName, $id);
    if ($stmt->execute()) {
        // Hapus file lama jika ada
        if ($oldFileName && file_exists($oldFilePath) && $oldFileName != $newFileName) {
            unlink($oldFilePath);
        }
        $_SESSION['message'] = "Berhasil memperbarui data Legalitas";
        $_SESSION['message_type'] = 'success';
    } else {
        $_SESSION['message'] = "Gagal memperbarui data Legalitas: " . $conn->error;
        $_SESSION['message_type'] = 'error';
    }
    $stmt->close();
    header("Location: ../dashboard/HalamanLegalitas.php");
    exit();
}


function insertLegalitas($fileInputNameLegalitas, $sertifikat)
{
    global $conn;
    $targetDirectoryLegalitas = __DIR__ . "/../assets/pdf/legalitas/";

    // Handle file upload untuk legalitas
    $filePathLegalitas = null;
    if (isset($_FILES[$fileInputNameLegalitas]) && $_FILES[$fileInputNameLegalitas]['error'] === UPLOAD_ERR_OK) {
        $uploadResultLegalitas = uploadLegalitas($fileInputNameLegalitas);

        if ($uploadResultLegalitas === null) {
            header("Location: HalamanLegalitas.php");
            exit();
        } else {
            $filePathLegalitas = $uploadResultLegalitas;
        }
    }

    // Insert data ke database
    $sql = "INSERT INTO legalitas (legalitas, sertifikat) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('ss', $filePathLegalitas, $sertifikat);
    if ($stmt->execute()) {
        $_SESSION['message'] = "Berhasil menambahkan data Legalitas";
        $_SESSION['message_type'] = 'success';
    } else {
        $_SESSION['message'] = "Gagal menambahkan data Legalitas" . $conn->error;
        $_SESSION['message_type'] = 'error';
    }
    $stmt->close();
    header("Location: HalamanLegalitas.php");
    exit();
}

function deleteLegalitas($id)
{
    global $conn;
    $targetDirectory = __DIR__ . "../../assets/pdf/legalitas/";

    // Ambil nama file dari database
    $sql = "SELECT legalitas FROM legalitas WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $stmt->bind_result($fileName);
    $stmt->fetch();
    $stmt->close();

    $filePath = $targetDirectory . $fileName; // Gabungkan path direktori dan nama file

    // Hapus data dari database
    $sql = "DELETE FROM legalitas WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $id);

    if ($stmt->execute()) {
        // Hapus file dari server
        if ($fileName && file_exists($filePath)) {
            if (unlink($filePath)) {
                $_SESSION['message'] = "Berhasil menghapus data Legalitas";
                $_SESSION['message_type'] = 'success';
            } else {
                $_SESSION['message'] = "Gagal menghapus file: " . $filePath;
                $_SESSION['message_type'] = 'error';
            }
        } else {
            $_SESSION['message'] = "File tidak ditemukan atau path salah: " . $filePath;
            $_SESSION['message_type'] = 'error';
        }
    } else {
        $_SESSION['message'] = "Gagal menghapus data Legalitas: " . $conn->error;
        $_SESSION['message_type'] = 'error';
    }
    $stmt->close();
    header("Location: ../dashboard/HalamanLegalitas.php");
    exit();
}
function deleteAdmin($username)
{
    global $conn;

    // Siapkan pernyataan SQL untuk menghapus data
    $sql = "DELETE FROM admin WHERE username = ?";
    $stmt = $conn->prepare($sql);

    // Cek apakah pernyataan berhasil disiapkan
    if ($stmt === false) {
        return "Error preparing statement: " . $conn->error;
    }

    // Bind parameter ke pernyataan SQL
    $stmt->bind_param('s', $username);

    // Eksekusi pernyataan SQL
    if ($stmt->execute()) {
        $result = "Record deleted successfully";
    } else {
        $result = "Error deleting record: " . $conn->error;
    }

    // Tutup pernyataan
    $stmt->close();

    return $result;
}

function insertProduk($jenis_sapi, $deskripsi_produk, $fotoFileInputName)
{
    global $conn;
    $targetDirectory = __DIR__ . "/../assets/images/produk/";

    // Handle file upload
    $uploadResult = uploadImage($fotoFileInputName, $targetDirectory);

    if (!$uploadResult) {
        return;
    } else {
        $fotoPath = $uploadResult;
    }

    // Insert data into database
    $sql = "INSERT INTO produk (jenis_sapi, foto, deskripsi_produk) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('sss', $jenis_sapi, $fotoPath, $deskripsi_produk);

    if ($stmt->execute()) {
        $_SESSION['message'] = "Berhasil menambahkan produk";
        $_SESSION['message_type'] = 'success';
    } else {
        $_SESSION['message'] = "Gagal menambahkan produk: " . $stmt->error;
        $_SESSION['message_type'] = 'error';
    }
    $stmt->close();

    header("Location: ../dashboard/HalamanProduk.php");
    exit();
}

function updateProduk($id, $jenis_sapi, $deskripsi_produk, $fotoFileInputName)
{
    session_start();
    global $conn;
    $targetDirectory = __DIR__ . "/../assets/images/produk/";
    $oldFotoPath = null;

    // Ambil path foto lama dari database
    $sql = "SELECT foto FROM produk WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $stmt->bind_result($oldFotoPath);
    $stmt->fetch();
    $stmt->close();

    // Handle file upload jika ada file
    $newFotoPath = $oldFotoPath; // Gunakan path foto lama secara default
    if (isset($_FILES[$fotoFileInputName]) && $_FILES[$fotoFileInputName]['error'] === UPLOAD_ERR_OK) {
        $uploadResult = uploadImage($fotoFileInputName, $targetDirectory, $oldFotoPath);

        if ($uploadResult === false) {
            header("Location: update_produk.php?id=$id");
            exit();
        } else {
            $newFotoPath = $uploadResult;
        }
    }

    // Update data di database
    $sql = "UPDATE produk SET jenis_sapi=?, deskripsi_produk=?, foto=? WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('sssi', $jenis_sapi, $deskripsi_produk, $newFotoPath, $id);
    if ($stmt->execute()) {
        $_SESSION['message'] = "Berhasil memperbarui produk";
        $_SESSION['message_type'] = 'success';
    } else {
        $_SESSION['message'] = "Gagal memperbarui produk " . $stmt->error;
        $_SESSION['message_type'] = 'error';
    }
    $stmt->close();

    header("Location: ../dashboard/HalamanProduk.php?id=$id");
    exit();
}

function deleteProduk($id)
{
    global $conn;
    $oldFotoPath = null;

    // Ambil path foto lama dari database
    $sql = "SELECT foto FROM produk WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $stmt->bind_result($oldFotoPath);
    $stmt->fetch();
    $stmt->close();

    // Hapus data dari database
    $sql = "DELETE FROM produk WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $id);
    if ($stmt->execute()) {
        $_SESSION['message'] = "Produk berhasil dihapus";
        $_SESSION['message_type'] = 'success';
    } else {
        $_SESSION['message'] = "Produk gagal dihapus: " . $conn->error;
        $_SESSION['message_type'] = 'error';
    }
    $stmt->close();

    header("Location: ../dashboard/HalamanProduk.php");
    exit();

    header("Location: ../dashboard/HalamanProduk.php");
    exit();
}


function updateTentang($id, $deskripsi_tentang, $fotoFileInputName)
{
    session_start();
    global $conn;
    $targetDirectory = __DIR__ . "/../assets/images/tentang/";
    $oldFotoPath = null;

    // Ambil path foto lama dari database
    $sql = "SELECT foto FROM tentang WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $stmt->bind_result($oldFotoPath);
    $stmt->fetch();
    $stmt->close();

    // Handle file upload jika ada file
    $newFotoPath = $oldFotoPath; // Gunakan path foto lama secara default
    if (isset($_FILES[$fotoFileInputName]) && $_FILES[$fotoFileInputName]['error'] === UPLOAD_ERR_OK) {
        $uploadResult = uploadImage($fotoFileInputName, $targetDirectory, $oldFotoPath);

        if ($uploadResult === false) {
            header("Location: HalamanTentang.php?id=$id");
            exit();
        } else {
            $newFotoPath = $uploadResult;
        }
    }

    // Update data di database
    $sql = "UPDATE tentang SET deskripsi_tentang=?, foto=? WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('ssi', $deskripsi_tentang, $newFotoPath, $id);
    if ($stmt->execute()) {
        $_SESSION['message'] = "Berhasil memperbarui Tentang";
        $_SESSION['message_type'] = 'success';
    } else {
        $_SESSION['message'] = "Gagal memperbarui Tentang: " . $stmt->error;
        $_SESSION['message_type'] = 'error';
    }
    $stmt->close();

    header("Location: HalamanTentang.php?id=$id");
    exit();
}

function updateVisiMisi($id, $visi, $misi, $fotoFileInputName)
{
    session_start();
    global $conn;
    $targetDirectory = __DIR__ . "/../assets/images/visi_misi/";
    $oldFotoPath = null;

    // Ambil path foto lama dari database
    $sql = "SELECT foto FROM visi_misi WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $stmt->bind_result($oldFotoPath);
    $stmt->fetch();
    $stmt->close();

    // Handle file upload jika ada file
    $newFotoPath = $oldFotoPath; // Gunakan path foto lama secara default
    if (isset($_FILES[$fotoFileInputName]) && $_FILES[$fotoFileInputName]['error'] === UPLOAD_ERR_OK) {
        $uploadResult = uploadImage($fotoFileInputName, $targetDirectory, $oldFotoPath);

        if ($uploadResult === false) {
            header("Location: HalamanTentang.php?id=$id");
            exit();
        } else {
            $newFotoPath = $uploadResult;
        }
    }

    // Update data di database
    $sql = "UPDATE visi_misi SET visi=?, misi=?, foto=? WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('sssi', $visi, $misi, $newFotoPath, $id);
    if ($stmt->execute()) {
        $_SESSION['message'] = "Berhasil memperbarui Visi Misi";
        $_SESSION['message_type'] = 'success';
    } else {
        $_SESSION['message'] = "Gagal memperbarui Visi Misi: " . $stmt->error;
        $_SESSION['message_type'] = 'error';
    }
    $stmt->close();

    header("Location: HalamanTentang.php?id=$id");
    exit();
}



function updateKontak($id, $no_hp, $no_wa, $ig, $fb, $alamat)
{
    session_start();
    global $conn;

    // Update data di database
    $sql = "UPDATE kontak SET no_hp=?, no_wa=?, ig=?, fb=?, alamat=? WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('sssssi', $no_hp, $no_wa, $ig, $fb, $alamat, $id);

    if ($stmt->execute()) {
        $_SESSION['message'] = "Kontak berhasil diperbarui";
        $_SESSION['message_type'] = 'success';
    } else {
        $_SESSION['message'] = "Gagal memperbarui Kontak " . $stmt->error;
        $_SESSION['message_type'] = 'error';
    }
    $stmt->close();

    header("Location: HalamanKontak.php?id=$id");
    exit();
}


function insertPesan($pesan_pengunjung, $email)
{
    global $conn;

    // Insert data ke database
    $sql = "INSERT INTO pesan (pesan_pengunjung, email, tanggal) VALUES (?, ?, NOW())";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('ss', $pesan_pengunjung, $email);

    if ($stmt->execute()) {
        $message = "success";
    } else {
        $message = "error";
    }
    $stmt->close();

    $_SESSION['message'] = $message;
    header('Location: ../index.php');
    exit();
}

function getAllAdminsWithLastLoginTime()
{
    global $conn;

    // Query untuk menggabungkan tabel admin dan login berdasarkan id_admin
    $sql = "
        SELECT 
            a.id, a.username, a.status, MAX(l.waktu) as lastLoginTime
        FROM 
            admin a
        LEFT JOIN 
            login l ON a.id = l.id_admin
        GROUP BY 
            a.id, a.username, a.status
        ORDER BY 
            lastLoginTime DESC
    ";
    $result = $conn->query($sql);
    $admins = [];

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $admins[] = $row;
        }
    }

    return $admins;
}

// Fungsi untuk mengubah timestamp menjadi waktu relatif
function timeAgo($timestamp)
{
    if (!$timestamp || $timestamp === '1970-01-01 00:00:00') {
        return 'Belum pernah login';
    }

    $time = time() - strtotime($timestamp);
    $time = ($time < 1) ? 1 : $time;

    $tokens = array(
        31536000 => 'tahun',
        2592000 => 'bulan',
        604800 => 'minggu',
        86400 => 'hari',
        3600 => 'jam',
        60 => 'menit',
        1 => 'detik'
    );

    foreach ($tokens as $unit => $text) {
        if ($time < $unit) continue;
        $numberOfUnits = floor($time / $unit);
        return $numberOfUnits . ' ' . $text . ' yang lalu';
    }
}
