<?php
session_start();
include '../../config/functions.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT id FROM admin WHERE id = $id";
    $result = $conn->query($sql);

    $id = $result->fetch_assoc()['id'];
    // Proses hapus data
    $resultMessage = deleteAdmin($id);
    header("Location: ../dashboard/halamanTambahAdmin.php");

    exit();
}
