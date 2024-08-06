<?php
session_start();
include '../../config/functions.php';

// Ambil ID dari query string
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($id > 0) {
    $resultMessage = deleteLegalitas($id);
    exit();
}
