<?php
include '../../config/functions.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Proses hapus data
    $resultMessage = deleteProduk($id);
    echo $resultMessage;

    // Redirect kembali ke halaman daftar produk
    header("Location: produk.php");
    exit();
} else {
    echo "Invalid request.";
}
