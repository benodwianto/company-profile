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

function updateLayanan($id, $investasi, $foto)
{
    global $conn;
    $sql = "UPDATE layanan SET investasi=?, foto=? WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('ssi', $investasi, $foto, $id);
    if ($stmt->execute()) {
        return "Record updated successfully";
    } else {
        return "Error updating record: " . $conn->error;
    }
    $stmt->close();
    $conn->close();
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
