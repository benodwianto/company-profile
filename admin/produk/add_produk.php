<?php
include '../../config/functions.php'; // Meng-include file fungsi

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $jenis_sapi = $_POST['jenis_sapi'];
    $deskripsi_produk = $_POST['deskripsi_produk'];
    $fotoFileInputName = 'foto';

    // Proses insert data
    $resultMessage = insertProduk($jenis_sapi, $deskripsi_produk, $fotoFileInputName);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Insert Produk</title>
</head>

<body>
    <h2>Insert Produk</h2>

    <!-- Menampilkan pesan
    <?php if (isset($resultMessage)) : ?>
        <p><?= htmlspecialchars($resultMessage); ?></p>
    <?php endif; ?>

    <!-- Formulir input untuk insert produk baru -->
    <form action="add_produk.php" method="post" enctype="multipart/form-data">
        <label for="jenis_sapi">Jenis Sapi:</label>
        <input type="text" name="jenis_sapi" id="jenis_sapi" required><br>

        <label for="deskripsi_produk">Deskripsi Produk:</label>
        <textarea name="deskripsi_produk" id="deskripsi_produk" required></textarea><br>

        <label for="foto">Foto:</label>
        <input type="file" name="foto" id="foto" required><br>

        <input type="submit" value="Insert Produk">
    </form>
</body>

</html>