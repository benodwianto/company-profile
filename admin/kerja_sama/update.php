<?php
session_start();
include '../../config/functions.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $judul = $_POST['judul'];
    $deskripsi = $_POST['deskripsi'];
    $foto = isset($_FILES['foto']) ? 'foto' : null;

    updateKerjasama($id, $judul, $deskripsi, $foto);
}
