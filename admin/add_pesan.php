<?php
include '../config/functions.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $pesan_pengunjung = $_POST['pesan_pengunjung'];
    $email = $_POST['email'];

    // Proses insert data
    $resultMessage = insertPesan($pesan_pengunjung, $email);
    echo $resultMessage;

    // Redirect kembali ke halaman daftar pesan
    header("Location: ../index.php");
    exit();
}