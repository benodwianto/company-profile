<?php
session_start();
include '../../config/functions.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Proses hapus data
    $resultMessage = deleteProduk($id);
}
