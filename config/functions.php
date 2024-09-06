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
        $_SESSION['message'] = $uploadResult;
        $_SESSION['message_type'] = 'error';

        return false; // Indicate failure
    }

    // Insert data ke database
    $sql = "INSERT INTO sponsor (sponsor, foto) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('ss', $sponsor, $uploadResult);

    if ($stmt->execute()) {
        $stmt->close();

        // Set session message for successful insert
        $_SESSION['message'] = 'Sponsor berhasil ditambahkan';
        $_SESSION['message_type'] = 'success';

        return true;
    } else {
        $stmt->close();

        // Set session message for error during insert
        $_SESSION['message'] = 'Terjadi kesalahan saat menambahkan sponsor: ' . $conn->error;
        $_SESSION['message_type'] = 'error';

        return false; // Indicate failure
    }
    header("Location: ../dashboard/HalamanSponsor.php");
    exit();
}



function updateSponsor($id, $sponsor, $fotoFileInputName)
{
    session_start();
    global $conn;
    $targetDirectory = __DIR__ . "/../assets/images/sponsor/";
    $oldFotoPath = null;

    // Ambil path foto lama dari database (hanya nama file)
    $sql = "SELECT foto FROM sponsor WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $stmt->bind_result($oldFotoName);
    $stmt->fetch();
    $stmt->close();

    // Gabungkan nama file dengan direktori target untuk mendapatkan path lengkap
    $oldFotoPath = $targetDirectory . $oldFotoName;

    // Handle file upload jika ada file baru
    $newFotoPath = $oldFotoName; // Gunakan nama file lama secara default
    if (isset($_FILES[$fotoFileInputName]) && $_FILES[$fotoFileInputName]['error'] === UPLOAD_ERR_OK) {
        // Unggah file baru dan dapatkan path file yang baru
        $uploadResult = uploadImage($fotoFileInputName, $targetDirectory);

        if ($uploadResult === false) {
            // Jika upload gagal, kembalikan ke halaman update
            header("Location: update_sponsor.php?id=$id");
            exit();
        } else {
            $newFotoPath = $uploadResult;

            // Hapus foto lama dari server
            if ($oldFotoName && file_exists($oldFotoPath)) {
                unlink($oldFotoPath);
            }
        }
    }

    // Update data di database dengan nama file baru (atau lama jika tidak ada yang diunggah)
    $sql = "UPDATE sponsor SET sponsor=? , foto=? WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('ssi', $sponsor, basename($newFotoPath), $id);
    if ($stmt->execute()) {
        $_SESSION['message'] = "Berhasil memperbarui sponsor";
        $_SESSION['message_type'] = 'success';
    } else {
        $_SESSION['message'] = "Gagal memperbarui sponsor " . $stmt->error;
        $_SESSION['message_type'] = 'error';
    }
    $stmt->close();

    header("Location: ../dashboard/Halamansponsor.php?id=$id");
    exit();
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
        // Hapus file dari server jika ada
        if ($filePath) {
            $fullPath = '../../assets/images/sponsor/' . $filePath; // Sesuaikan dengan path file foto Anda
            if (file_exists($fullPath)) {
                unlink($fullPath);
            }
        }
        $_SESSION['message'] = 'Sponsor berhasil dihapus';
        $_SESSION['message_type'] = 'success';

        return true; // Indikasikan keberhasilan
    } else {
        $_SESSION['message'] = 'Terjadi kesalahan saat menghapus sponsor: ' . $conn->error;
        $_SESSION['message_type'] = 'error';

        return false; // Indikasikan kegagalan
    }
    $stmt->close();
}


function updateHome($id, $deskripsi_dashboard)
{
    global $conn;

    // Pastikan id dan deskripsi_dashboard tidak kosong
    if (empty($id) || empty($deskripsi_dashboard)) {
        $_SESSION['message'] = 'ID atau Deskripsi tidak boleh kosong';
        $_SESSION['message_type'] = 'error';
        return false; // Indicate failure
    }

    // Persiapkan SQL untuk pembaruan data
    $sql = "UPDATE home SET deskripsi_dashboard=? WHERE id=?";
    $stmt = $conn->prepare($sql);

    if ($stmt === false) {
        $_SESSION['message'] = 'Gagal menyiapkan statement: ' . $conn->error;
        $_SESSION['message_type'] = 'error';
        return false; // Indicate failure
    }

    // Bind parameter
    $stmt->bind_param('si', $deskripsi_dashboard, $id);

    // Eksekusi statement
    if ($stmt->execute()) {
        $stmt->close();
        $conn->close();

        // Set session message for successful update
        $_SESSION['message'] = 'Deskripsi Home berhasil diperbarui';
        $_SESSION['message_type'] = 'success';

        return true; // Indicate success
    } else {
        $stmt->close();
        $conn->close();

        // Set session message for error during update
        $_SESSION['message'] = 'Terjadi kesalahan saat memperbarui deskripsi dashboard: ' . $stmt->error;
        $_SESSION['message_type'] = 'error';

        return false; // Indicate failure
    }
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
        $stmt->close();

        // Set session message for successful insert
        $_SESSION['message'] = 'Admin berhasil ditambahkan';
        $_SESSION['message_type'] = 'success';

        return true;
    } else {
        $stmt->close();

        // Set session message for error during insert
        $_SESSION['message'] = 'Terjadi kesalahan saat menambahkan admin' . $conn->error;
        $_SESSION['message_type'] = 'error';

        return false;
    }
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
        $stmt->close();

        // Set session message for successful update
        $_SESSION['message'] = 'Admin berhasil diperbarui';
        $_SESSION['message_type'] = 'success';

        return true;
    } else {
        $stmt->close();

        // Set session message for error during update
        $_SESSION['message'] = 'Terjadi kesalahan saat memperbarui admin' . $conn->error;
        $_SESSION['message_type'] = 'error';

        return false;
    }
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

function recordLoginTime($admin_id)
{
    global $conn;

    // Periksa apakah sudah ada login untuk admin ini
    $sql_check = "SELECT COUNT(*) FROM login WHERE admin_id = ?";
    $stmt_check = $conn->prepare($sql_check);
    $stmt_check->bind_param('i', $admin_id);
    $stmt_check->execute();
    $stmt_check->bind_result($count);
    $stmt_check->fetch();
    $stmt_check->close();

    if ($count > 0) {
        // Jika sudah ada, update waktu login
        $sql_update = "UPDATE login SET waktu = NOW() WHERE admin_id = ?";
        $stmt_update = $conn->prepare($sql_update);
        $stmt_update->bind_param('i', $admin_id);

        if ($stmt_update->execute()) {
            $stmt_update->close();

            // Set session message for successful update
            $_SESSION['message'] = 'Login time updated successfully';
            $_SESSION['message_type'] = 'success';

            return true;
        } else {
            $stmt_update->close();

            // Set session message for error during update
            $_SESSION['message'] = 'Error updating login time: ' . $conn->error;
            $_SESSION['message_type'] = 'error';

            return false;
        }
    } else {
        // Jika belum ada, insert data login baru
        $sql_insert = "INSERT INTO login (admin_id, waktu) VALUES (?, NOW())";
        $stmt_insert = $conn->prepare($sql_insert);
        $stmt_insert->bind_param('i', $admin_id);

        if ($stmt_insert->execute()) {
            $stmt_insert->close();

            // Set session message for successful insert
            $_SESSION['message'] = 'Login time recorded successfully';
            $_SESSION['message_type'] = 'success';

            return true;
        } else {
            $stmt_insert->close();

            // Set session message for error during insert
            $_SESSION['message'] = 'Error recording login time: ' . $conn->error;
            $_SESSION['message_type'] = 'error';

            return false;
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
    if ($hashedPassword !== null && password_verify($password, $hashedPassword)) {
        // Jika login berhasil, catat waktu login
        recordLoginTime($id);

        // Set session message for successful login
        $_SESSION['message'] = 'Berhasil Login';
        $_SESSION['message_type'] = 'success';

        return ['id' => $id, 'status' => $status]; // Kembalikan array yang berisi ID admin dan status
    } else {
        // Set session message for failed login
        $_SESSION['message'] = 'Username atau Password salah';
        $_SESSION['message_type'] = 'error';

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

    $oldFotoPath = $targetDirectory . $oldFotoPath;
    // Handle file upload jika ada file
    $newFotoPath = $oldFotoPath; // Gunakan path foto lama secara default
    if (isset($_FILES[$fotoFileInputName]) && $_FILES[$fotoFileInputName]['error'] === UPLOAD_ERR_OK) {
        $uploadResult = uploadImage($fotoFileInputName, $targetDirectory, $oldFotoPath);

        if ($uploadResult === false) {
            header("Location: HalamanLayanan.php?id=$id");
            exit();
        } else {
            $newFotoPath = $uploadResult;

            if ($oldFotoPath && file_exists($oldFotoPath)) {
                unlink($oldFotoPath);
            }
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

    // Gabungkan nama file dengan direktori target untuk mendapatkan path lengkap
    $oldFotoPath = $targetDirectory . $oldFotoPath;

    // Handle file upload jika ada file
    $newFotoPath = $oldFotoPath; // Gunakan path foto lama secara default
    if (isset($_FILES[$fotoFileInputName]) && $_FILES[$fotoFileInputName]['error'] === UPLOAD_ERR_OK) {
        $uploadResult = uploadImage($fotoFileInputName, $targetDirectory, $oldFotoPath);

        if ($uploadResult === false) {
            header("Location: HalamanLayanan.php?id=$id");
            exit();
        } else {
            $newFotoPath = $uploadResult;

            // Hapus foto lama dari server
            if ($oldFotoPath && file_exists($oldFotoPath)) {
                unlink($oldFotoPath);
            }
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
    $targetDirectory = "../../assets/pdf/legalitas/";

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
                $_SESSION['message'] = "Berhasil menghapus data Legalitas dan file terkait";
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

function deleteAdminWithLogin($id)
{
    global $conn;

    // Hapus data yang berelasi di tabel 'login'
    $sql = "DELETE FROM login WHERE admin_id = ?";
    $stmt = $conn->prepare($sql);

    // Cek jika SQL statement gagal dipersiapkan
    if (!$stmt) {
        $_SESSION['message'] = "Terjadi kesalahan saat menyiapkan pernyataan login: " . $conn->error;
        $_SESSION['message_type'] = 'error';
        return false;
    }

    $stmt->bind_param('i', $id);
    if ($stmt->execute()) {
        $stmt->close();

        // Setelah menghapus data login, hapus data admin
        $sql = "DELETE FROM admin WHERE id = ?";
        $stmt = $conn->prepare($sql);

        if (!$stmt) {
            $_SESSION['message'] = "Terjadi kesalahan saat menyiapkan pernyataan admin: " . $conn->error;
            $_SESSION['message_type'] = 'error';
            return false;
        }

        $stmt->bind_param('i', $id);
        if ($stmt->execute()) {
            $_SESSION['message'] = "Data admin dan login berhasil dihapus";
            $_SESSION['message_type'] = 'success';
            $stmt->close();
            return true;
        } else {
            $_SESSION['message'] = "Terjadi kesalahan saat menghapus data admin: " . $stmt->error;
            $_SESSION['message_type'] = 'error';
            $stmt->close();
            return false;
        }
    } else {
        $_SESSION['message'] = "Terjadi kesalahan saat menghapus data login: " . $stmt->error;
        $_SESSION['message_type'] = 'error';
        $stmt->close();
        return false;
    }
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

    // Ambil path foto lama dari database (hanya nama file)
    $sql = "SELECT foto FROM produk WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $stmt->bind_result($oldFotoName);
    $stmt->fetch();
    $stmt->close();

    // Gabungkan nama file dengan direktori target untuk mendapatkan path lengkap
    $oldFotoPath = $targetDirectory . $oldFotoName;

    // Handle file upload jika ada file baru
    $newFotoPath = $oldFotoName; // Gunakan nama file lama secara default
    if (isset($_FILES[$fotoFileInputName]) && $_FILES[$fotoFileInputName]['error'] === UPLOAD_ERR_OK) {
        // Unggah file baru dan dapatkan path file yang baru
        $uploadResult = uploadImage($fotoFileInputName, $targetDirectory);

        if ($uploadResult === false) {
            // Jika upload gagal, kembalikan ke halaman update
            header("Location: update_produk.php?id=$id");
            exit();
        } else {
            $newFotoPath = $uploadResult;

            // Hapus foto lama dari server
            if ($oldFotoName && file_exists($oldFotoPath)) {
                unlink($oldFotoPath);
            }
        }
    }

    // Update data di database dengan nama file baru (atau lama jika tidak ada yang diunggah)
    $sql = "UPDATE produk SET jenis_sapi=?, deskripsi_produk=?, foto=? WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('sssi', $jenis_sapi, $deskripsi_produk, basename($newFotoPath), $id);
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

    // Jika foto ada, hapus file dari server
    if ($oldFotoPath) {
        $filePath = '../../assets/images/produk/' . $oldFotoPath;
        if (file_exists($filePath)) {
            unlink($filePath);
        }
    }

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

    $oldFotoPath = $targetDirectory . $oldFotoPath;
    // Handle file upload jika ada file
    $newFotoPath = $oldFotoPath; // Gunakan path foto lama secara default
    if (isset($_FILES[$fotoFileInputName]) && $_FILES[$fotoFileInputName]['error'] === UPLOAD_ERR_OK) {
        $uploadResult = uploadImage($fotoFileInputName, $targetDirectory, $oldFotoPath);

        if ($uploadResult === false) {
            header("Location: HalamanTentang.php?id=$id");
            exit();
        } else {
            $newFotoPath = $uploadResult;

            // Hapus foto lama dari server
            if ($oldFotoPath && file_exists($oldFotoPath)) {
                unlink($oldFotoPath);
            }
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

    $oldFotoPath = $targetDirectory . $oldFotoPath;

    // Handle file upload jika ada file
    $newFotoPath = $oldFotoPath; // Gunakan path foto lama secara default
    if (isset($_FILES[$fotoFileInputName]) && $_FILES[$fotoFileInputName]['error'] === UPLOAD_ERR_OK) {
        $uploadResult = uploadImage($fotoFileInputName, $targetDirectory, $oldFotoPath);

        if ($uploadResult === false) {
            header("Location: HalamanTentang.php?id=$id");
            exit();
        } else {
            $newFotoPath = $uploadResult;
            // Hapus foto lama dari server
            if ($oldFotoPath && file_exists($oldFotoPath)) {
                unlink($oldFotoPath);
            }
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
        $_SESSION['message'] = "Berhasil mengirim pesan";
        $_SESSION['message_type'] = 'success';
    } else {
        $_SESSION['message'] = "Gagal mengirim Pesan " . $stmt->error;
        $_SESSION['message_type'] = 'error';
    }
    $stmt->close();
    header('Location: ../index.php#footer');
    exit();
}

function deletePesan($id)
{
    global $conn;

    // Delete data dari database berdasarkan id
    $sql = "DELETE FROM pesan WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $id); // 'i' indicates the type is integer

    if ($stmt->execute()) {
        $_SESSION['message'] = "Pesan berhasil dihapus";
        $_SESSION['message_type'] = 'success';
    } else {
        $_SESSION['message'] = "Gagal menghapus pesan: " . $stmt->error;
        $_SESSION['message_type'] = 'error';
    }
    $stmt->close();
    header('Location: dashboard');
    exit();
}

function insertKerjasama($judul, $deskripsi, $fotoFileInputName)
{
    global $conn;
    $targetDirectory = __DIR__ . "/../assets/images/kerjasama/";

    // Handle file upload
    $uploadResult = uploadImage($fotoFileInputName, $targetDirectory);

    if (!$uploadResult) {
        return;
    } else {
        $fotoPath = $uploadResult;
    }

    // Insert data into database
    $sql = "INSERT INTO kerjasama (judul, deskripsi, foto) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('sss', $judul, $deskripsi, $fotoPath);

    if ($stmt->execute()) {
        $_SESSION['message'] = "Berhasil menambahkan kerjasama";
        $_SESSION['message_type'] = 'success';
    } else {
        $_SESSION['message'] = "Gagal menambahkan kerjasama: " . $stmt->error;
        $_SESSION['message_type'] = 'error';
    }
    $stmt->close();

    header("Location: index.php");
    exit();
}

function updateKerjasama($id, $judul, $deskripsi, $fotoFileInputName)
{
    global $conn;
    $targetDirectory = __DIR__ . "/../assets/images/kerjasama/";
    $oldFotoPath = null;

    // Ambil path foto lama dari database (hanya nama file)
    $sql = "SELECT foto FROM kerjasama WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $stmt->bind_result($oldFotoName);
    $stmt->fetch();
    $stmt->close();

    // Gabungkan nama file dengan direktori target untuk mendapatkan path lengkap
    $oldFotoPath = $targetDirectory . $oldFotoName;

    // Handle file upload jika ada file baru
    $newFotoPath = $oldFotoName; // Gunakan nama file lama secara default
    if (isset($_FILES[$fotoFileInputName]) && $_FILES[$fotoFileInputName]['error'] === UPLOAD_ERR_OK) {
        // Unggah file baru dan dapatkan path file yang baru
        $uploadResult = uploadImage($fotoFileInputName, $targetDirectory);

        if ($uploadResult === false) {
            // Jika upload gagal, kembalikan ke halaman update
            header("Location: update.php?id=$id");
            exit();
        } else {
            $newFotoPath = $uploadResult;

            // Hapus foto lama dari server
            if ($oldFotoName && file_exists($oldFotoPath)) {
                unlink($oldFotoPath);
            }
        }
    }

    // Update data di database dengan nama file baru (atau lama jika tidak ada yang diunggah)
    $sql = "UPDATE kerjasama SET judul=?, deskripsi=?, foto=? WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('sssi', $judul, $deskripsi, basename($newFotoPath), $id);
    if ($stmt->execute()) {
        $_SESSION['message'] = "Berhasil memperbarui kerjasama";
        $_SESSION['message_type'] = 'success';
    } else {
        $_SESSION['message'] = "Gagal memperbarui kerjasama " . $stmt->error;
        $_SESSION['message_type'] = 'error';
    }
    $stmt->close();

    header("Location: index.php");
    exit();
}


function deleteKerjasama($id)
{
    global $conn;
    $oldFotoPath = null;

    // Ambil path foto lama dari database
    $sql = "SELECT foto FROM kerjasama WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $stmt->bind_result($oldFotoPath);
    $stmt->fetch();
    $stmt->close();

    // Jika foto ada, hapus file dari server
    if ($oldFotoPath) {
        $filePath = '../../assets/images/kerjasama/' . $oldFotoPath;
        if (file_exists($filePath)) {
            unlink($filePath);
        }
    }

    // Hapus data dari database
    $sql = "DELETE FROM kerjasama WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $id);
    if ($stmt->execute()) {
        $_SESSION['message'] = "Kerjasama berhasil dihapus";
        $_SESSION['message_type'] = 'success';
    } else {
        $_SESSION['message'] = "Kerjasama gagal dihapus: " . $conn->error;
        $_SESSION['message_type'] = 'error';
    }
    $stmt->close();

    header("Location: index.php");
    exit();
}


function getAllAdminsWithLastLoginTime()
{
    global $conn;

    // Query untuk menggabungkan tabel admin dan login berdasarkan admin_id
    $sql = "
        SELECT 
            a.id, a.username, a.status, MAX(l.waktu) as lastLoginTime
        FROM 
            admin a
        LEFT JOIN 
            login l ON a.id = l.admin_id
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

function getDataWithPagination($page = 1, $recordsPerPage = 6, $startDate = null, $endDate = null)
{
    global $conn;

    $offset = ($page - 1) * $recordsPerPage;

    // Build the query with optional date filtering
    $sql = "SELECT * FROM pesan WHERE 1=1";

    if ($startDate) {
        $sql .= " AND tanggal >= ?";
    }
    if ($endDate) {
        $sql .= " AND tanggal <= ?";
    }

    // Add ordering, limit, and offset
    $sql .= " ORDER BY tanggal DESC LIMIT ? OFFSET ?";

    $stmt = $conn->prepare($sql);

    // Bind parameters based on the presence of date filters
    if ($startDate && $endDate) {
        $stmt->bind_param('ssii', $startDate, $endDate, $recordsPerPage, $offset);
    } elseif ($startDate) {
        $stmt->bind_param('sii', $startDate, $recordsPerPage, $offset);
    } elseif ($endDate) {
        $stmt->bind_param('sii', $endDate, $recordsPerPage, $offset);
    } else {
        $stmt->bind_param('ii', $recordsPerPage, $offset);
    }

    $stmt->execute();
    $result = $stmt->get_result();

    if ($result === false) {
        // Handle query error (optional)
        die('Error executing the query: ' . $stmt->error);
    }

    $data = [];
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }

    $stmt->close();

    return $data;
}

function getTotalPages($recordsPerPage = 6, $startDate = null, $endDate = null)
{
    global $conn;

    // Build the query with optional date filtering
    $sql = "SELECT COUNT(*) FROM pesan WHERE 1=1";

    if ($startDate) {
        $sql .= " AND tanggal >= ?";
    }
    if ($endDate) {
        $sql .= " AND tanggal <= ?";
    }

    $stmt = $conn->prepare($sql);

    // Bind parameters based on the presence of date filters
    if ($startDate && $endDate) {
        $stmt->bind_param('ss', $startDate, $endDate);
    } elseif ($startDate) {
        $stmt->bind_param('s', $startDate);
    } elseif ($endDate) {
        $stmt->bind_param('s', $endDate);
    }

    $stmt->execute();
    $stmt->bind_result($totalRecords);
    $stmt->fetch();

    $stmt->close();

    // Calculate total pages
    $totalPages = ceil($totalRecords / $recordsPerPage);

    return $totalPages;
}

function generatePaginationLinks($currentPage, $totalPages)
{
    $paginationLinks = '';

    for ($i = 1; $i <= $totalPages; $i++) {
        if ($i == $currentPage) {
            // Tambahkan class 'active' pada link yang aktif
            $paginationLinks .= "<a href='?page=$i' class='active'>$i</a> ";
        } else {
            $paginationLinks .= "<a href='?page=$i'>$i</a> ";
        }
    }

    return $paginationLinks;
}



// produk paginasi
function getProdukWithPagination($page = 1, $recordsPerPage = 10, $searchQuery = null)
{
    global $conn;

    $offset = ($page - 1) * $recordsPerPage;

    // Build the query with optional search filtering
    $sql = "SELECT * FROM produk WHERE 1=1";

    if ($searchQuery) {
        $sql .= " AND jenis_sapi LIKE ?";
    }

    $sql .= " LIMIT ? OFFSET ?";

    $stmt = $conn->prepare($sql);

    // Bind parameters based on the presence of a search query
    if ($searchQuery) {
        $searchQuery = "%" . $searchQuery . "%";
        $stmt->bind_param('sii', $searchQuery, $recordsPerPage, $offset);
    } else {
        $stmt->bind_param('ii', $recordsPerPage, $offset);
    }

    $stmt->execute();
    $result = $stmt->get_result();

    $data = [];
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }

    $stmt->close();

    return $data;
}

function getTotalProdukPages($recordsPerPage = 10, $searchQuery = null)
{
    global $conn;

    // Build the query with optional search filtering
    $sql = "SELECT COUNT(*) FROM produk WHERE 1=1";

    if ($searchQuery) {
        $sql .= " AND jenis_sapi LIKE ?";
    }

    $stmt = $conn->prepare($sql);

    // Bind parameters based on the presence of a search query
    if ($searchQuery) {
        $searchQuery = "%" . $searchQuery . "%";
        $stmt->bind_param('s', $searchQuery);
    }

    $stmt->execute();
    $stmt->bind_result($totalRecords);
    $stmt->fetch();

    $stmt->close();

    $totalPages = ceil($totalRecords / $recordsPerPage);

    return $totalPages;
}

function generateProdukPaginationLinks($currentPage, $totalPages)
{
    $paginationLinks = '';

    for ($i = 1; $i <= $totalPages; $i++) {
        if ($i == $currentPage) {
            $paginationLinks .= "<strong>$i</strong> ";
        } else {
            $paginationLinks .= "<a href='?page=$i'>$i</a> ";
        }
    }

    return $paginationLinks;
}

// Sponsor
function getSponsorWithPagination($page = 1, $recordsPerPage = 10, $searchQuery = null)
{
    global $conn;

    $offset = ($page - 1) * $recordsPerPage;

    // Build the query with optional search filtering
    $sql = "SELECT * FROM Sponsor WHERE 1=1";

    if ($searchQuery) {
        $sql .= " AND sponsor LIKE ?";
    }

    $sql .= " LIMIT ? OFFSET ?";

    $stmt = $conn->prepare($sql);

    // Bind parameters based on the presence of a search query
    if ($searchQuery) {
        $searchQuery = "%" . $searchQuery . "%";
        $stmt->bind_param('sii', $searchQuery, $recordsPerPage, $offset);
    } else {
        $stmt->bind_param('ii', $recordsPerPage, $offset);
    }

    $stmt->execute();
    $result = $stmt->get_result();

    $data = [];
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }

    $stmt->close();

    return $data;
}

function getTotalSponsorPages($recordsPerPage = 10, $searchQuery = null)
{
    global $conn;

    // Build the query with optional search filtering
    $sql = "SELECT COUNT(*) FROM sponsor WHERE 1=1";

    if ($searchQuery) {
        $sql .= " AND sponsor LIKE ?";
    }

    $stmt = $conn->prepare($sql);

    // Bind parameters based on the presence of a search query
    if ($searchQuery) {
        $searchQuery = "%" . $searchQuery . "%";
        $stmt->bind_param('s', $searchQuery);
    }

    $stmt->execute();
    $stmt->bind_result($totalRecords);
    $stmt->fetch();

    $stmt->close();

    $totalPages = ceil($totalRecords / $recordsPerPage);

    return $totalPages;
}

function generateSponsorPaginationLinks($currentPage, $totalPages)
{
    $paginationLinks = '';

    for ($i = 1; $i <= $totalPages; $i++) {
        if ($i == $currentPage) {
            $paginationLinks .= "<strong>$i</strong> ";
        } else {
            $paginationLinks .= "<a href='?page=$i'>$i</a> ";
        }
    }

    return $paginationLinks;
}
