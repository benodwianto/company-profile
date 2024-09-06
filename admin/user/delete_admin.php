<?php
session_start();
include '../../config/functions.php'; // Memanggil file yang berisi fungsi

// Logika penghapusan admin
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Hapus data admin beserta relasi login
    if (deleteAdminWithLogin($id)) {
        header("Location: ../dashboard/halamanTambahAdmin.php");
        exit();
    } else {
        header("Location: ../dashboard/halamanTambahAdmin.php");
        exit();
    }
} else {
    $_SESSION['message'] = 'ID admin tidak ditemukan.';
    $_SESSION['message_type'] = 'error';
    header("Location: ../dashboard/halamanTambahAdmin.php");
    exit();
}
