<?php
session_start();
include '../../config/functions.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $judul = $_POST['judul'];
    $deskripsi = $_POST['deskripsi'];
    $foto = $_FILES['foto'];

    insertKerjasama($judul, $deskripsi, 'foto');
}
