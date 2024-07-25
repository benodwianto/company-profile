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
    // Menetapkan nama file tujuan
    $targetFile = $targetDirectory . basename($_FILES[$fileInputName]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

    // Cek apakah file gambar atau bukan
    $check = getimagesize($_FILES[$fileInputName]["tmp_name"]);
    if ($check === false) {
        return "File is not an image.";
    }

    // Cek ukuran file (contoh: batas 5MB)
    if ($_FILES[$fileInputName]["size"] > 5000000) {
        return "Sorry, your file is too large.";
    }

    // Izinkan format file tertentu
    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
        return "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    }

    // Cek apakah $uploadOk diset ke 0 karena kesalahan
    if ($uploadOk == 0) {
        return "Sorry, your file was not uploaded.";
    } else {
        // Mengupload file
        if (move_uploaded_file($_FILES[$fileInputName]["tmp_name"], $targetFile)) {
            // Hapus foto lama jika ada
            if ($oldFotoPath && file_exists($oldFotoPath)) {
                unlink($oldFotoPath);
            }
            return $targetFile;
        } else {
            return "Sorry, there was an error uploading your file.";
        }
    }
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

function insertAdmin($username, $password)
{
    global $conn;

    // Hash password sebelum menyimpannya ke database
    $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

    // Insert data ke database
    $sql = "INSERT INTO admin (username, password) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('ss', $username, $hashedPassword);

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


function updateLayanan($id, $kelebihan, $investasi, $fotoFileInputName)
{
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

        if (strpos($uploadResult, 'Sorry') === 0) {
            return $uploadResult; // Kembalikan pesan kesalahan jika ada
        } else {
            $newFotoPath = $uploadResult;
        }
    }

    // Update data di database
    $sql = "UPDATE layanan SET kelebihan=?, investasi=?, foto=? WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('sssi', $kelebihan, $investasi, $newFotoPath, $id);
    if ($stmt->execute()) {
        return "Record updated successfully";
    } else {
        return "Error updating record: " . $conn->error;
    }
    $stmt->close();
}

function uploadLegalitas($fileInputName)
{
    global $conn;
    $targetDirectory = __DIR__ . "/../assets/pdf/legalitas/";
    $filePath = null;

    if (isset($_FILES[$fileInputName]) && $_FILES[$fileInputName]['error'] === UPLOAD_ERR_OK) {
        $fileType = strtolower(pathinfo($_FILES[$fileInputName]['name'], PATHINFO_EXTENSION));
        if ($fileType != 'pdf') {
            return "Sorry, only PDF files are allowed.";
        }

        $filePath = $targetDirectory . basename($_FILES[$fileInputName]["name"]);

        if (move_uploaded_file($_FILES[$fileInputName]["tmp_name"], $filePath)) {
            return $filePath; // Return the path to be stored in database
        } else {
            return "Sorry, there was an error uploading your file.";
        }
    }

    return "No file uploaded or error occurred.";
}

function updateLegalitas($id, $fileInputName)
{
    global $conn;
    $targetDirectory = __DIR__ . "/../assets/pdf/legalitas/";
    $oldFilePath = null;

    // Ambil path file lama dari database
    $sql = "SELECT legalitas FROM legalitas WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $stmt->bind_result($oldFilePath);
    $stmt->fetch();
    $stmt->close();

    // Handle file upload jika ada file
    $newFilePath = $oldFilePath; // Gunakan path file lama secara default
    if (isset($_FILES[$fileInputName]) && $_FILES[$fileInputName]['error'] === UPLOAD_ERR_OK) {
        $uploadResult = uploadLegalitas($fileInputName);

        if (strpos($uploadResult, 'Sorry') === 0) {
            return $uploadResult; // Kembalikan pesan kesalahan jika ada
        } else {
            $newFilePath = $uploadResult;
        }
    }

    // Update data di database
    $sql = "UPDATE legalitas SET legalitas=? WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('si', $newFilePath, $id);
    if ($stmt->execute()) {
        // Hapus file lama jika ada
        if ($oldFilePath && file_exists($oldFilePath) && $oldFilePath != $newFilePath) {
            unlink($oldFilePath);
        }
        return "Record updated successfully";
    } else {
        return "Error updating record: " . $conn->error;
    }
    $stmt->close();
}


function insertProduk($jenis_sapi, $deskripsi_produk, $fotoFileInputName)
{
    global $conn;
    $targetDirectory = __DIR__ . "/../assets/images/produk/";

    // Handle file upload
    $uploadResult = uploadImage($fotoFileInputName, $targetDirectory);

    if (strpos($uploadResult, 'Sorry') === 0) {
        return $uploadResult; // Return upload error message
    } else {
        $fotoPath = $uploadResult;
    }

    // Insert data into database
    $sql = "INSERT INTO produk (jenis_sapi, foto, deskripsi_produk) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('sss', $jenis_sapi, $fotoPath, $deskripsi_produk);

    if ($stmt->execute()) {
        return "Product inserted successfully";
    } else {
        return "Error inserting product: " . $conn->error;
    }
    $stmt->close();
}

function updateProduk($id, $jenis_sapi, $deskripsi_produk, $fotoFileInputName)
{
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

        if (strpos($uploadResult, 'Sorry') === 0) {
            return $uploadResult; // Kembalikan pesan kesalahan jika ada
        } else {
            $newFotoPath = $uploadResult;
        }
    }

    // Update data di database
    $sql = "UPDATE produk SET jenis_sapi=?, deskripsi_produk=?, foto=? WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('sssi', $jenis_sapi, $deskripsi_produk, $newFotoPath, $id);
    if ($stmt->execute()) {
        return "Record updated successfully";
    } else {
        return "Error updating record: " . $conn->error;
    }
    $stmt->close();
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
        // Hapus file foto lama jika ada
        if ($oldFotoPath && file_exists($oldFotoPath)) {
            unlink($oldFotoPath);
        }
        return "Record deleted successfully";
    } else {
        return "Error deleting record: " . $conn->error;
    }
    $stmt->close();
}


function updateTentang($id, $deskripsi_tentang, $fotoFileInputName)
{
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

        if (strpos($uploadResult, 'Sorry') === 0) {
            return $uploadResult; // Kembalikan pesan kesalahan jika ada
        } else {
            $newFotoPath = $uploadResult;
        }
    }

    // Update data di database
    $sql = "UPDATE tentang SET deskripsi_tentang=?, foto=? WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('ssi', $deskripsi_tentang, $newFotoPath, $id);
    if ($stmt->execute()) {
        return "Record updated successfully";
    } else {
        return "Error updating record: " . $conn->error;
    }
    $stmt->close();
}
