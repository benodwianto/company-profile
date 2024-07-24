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

function updateAdmin($id, $username, $password)
{
    global $conn;
    $sql = "UPDATE admin SET username=?, password=? WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('ssi', $username, $password, $id);
    if ($stmt->execute()) {
        return "Record updated successfully";
    } else {
        return "Error updating record: " . $conn->error;
    }
    $stmt->close();
    $conn->close();
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


function updateLegalitas($id, $legalitas)
{
    global $conn;
    $sql = "UPDATE legalitas SET legalitas=? WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('si', $legalitas, $id);
    if ($stmt->execute()) {
        return "Record updated successfully";
    } else {
        return "Error updating record: " . $conn->error;
    }
    $stmt->close();
    $conn->close();
}

function updateProduk($id, $jenis_sapi, $foto, $deskripsi_produk)
{
    global $conn;
    $sql = "UPDATE produk SET jenis_sapi=?, foto=?, deskripsi_produk=? WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('sssi', $jenis_sapi, $foto, $deskripsi_produk, $id);
    if ($stmt->execute()) {
        return "Record updated successfully";
    } else {
        return "Error updating record: " . $conn->error;
    }
    $stmt->close();
    $conn->close();
}

function insertProduk($jenis_sapi, $foto, $deskripsi_produk)
{
    global $conn;
    $sql = "INSERT INTO produk (jenis_sapi, foto, deskripsi_produk) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('sss', $jenis_sapi, $foto, $deskripsi_produk);
    if ($stmt->execute()) {
        return "Record inserted successfully";
    } else {
        return "Error inserting record: " . $conn->error;
    }
    $stmt->close();
    $conn->close();
}

function updateTentang($id, $tentang, $foto)
{
    global $conn;
    $sql = "UPDATE tentang SET tentang=?, foto=? WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('ssi', $tentang, $foto, $id);
    if ($stmt->execute()) {
        return "Record updated successfully";
    } else {
        return "Error updating record: " . $conn->error;
    }
    $stmt->close();
    $conn->close();
}
