<?php
include '../../config/functions.php';

// Ambil ID dari query string
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($id > 0) {
    $resultMessage = deleteLegalitas($id);
    echo $resultMessage;
} else {
    echo "Invalid ID.";
}

// Redirect kembali ke halaman daftar legalitas
header("Location: legalitas_list.php");
exit();
