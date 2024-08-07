<?php
session_start();
include '../config/functions.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $pesan_pengunjung = $_POST['pesan_pengunjung'];
    $email = $_POST['email'];

    // Proses insert data
    $resultMessage = insertPesan($pesan_pengunjung, $email);
}
