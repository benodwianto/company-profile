<?php
include '../config/functions.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $pesan_pengunjung = $_POST['pesan_pengunjung'];
    $email = $_POST['email'];

    // Proses insert data
    $resultMessage = insertPesan($pesan_pengunjung, $email);
    echo $resultMessage;

    // Redirect kembali ke halaman daftar pesan
    header("Location: pesan.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Insert Pesan</title>
</head>

<body>
    <h2>Insert Pesan</h2>

    <form action="" method="post">
        <label for="pesan_pengunjung">Pesan Pengunjung:</label>
        <textarea name="pesan_pengunjung" id="pesan_pengunjung" required></textarea><br>
        <label for="email">Email:</label>
        <input type="email" name="email" id="email" required><br>
        <input type="submit" value="Insert Pesan">
    </form>
</body>

</html>