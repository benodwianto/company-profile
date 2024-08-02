<?php
include '../../config/functions.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT id FROM admin WHERE id = $id";
    $result = $conn->query($sql);

    $id = $result->fetch_assoc()['id'];
    // Proses hapus data
    $resultMessage = deleteAdmin($id);
    echo $resultMessage;

    // Redirect kembali ke halaman daftar produk
    header("Location: ../dashboard/?page=halaman-produk");
    exit();
} else {
    echo "Invalid request.";
}
