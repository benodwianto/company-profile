<?php
include '../config/functions.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $jenis_sapi = $_POST['jenis_sapi'];
    $deskripsi_produk = $_POST['deskripsi_produk'];

    // Periksa apakah ada file yang di-upload
    if (isset($_FILES['foto']) && $_FILES['foto']['error'] === UPLOAD_ERR_OK) {
        $fotoFileInputName = 'foto';
    } else {
        $fotoFileInputName = null; // Tidak ada file baru
    }

    // Proses update data
    $resultMessage = updateProduk($id, $jenis_sapi, $deskripsi_produk, $fotoFileInputName);
}

// Ambil data produk untuk ditampilkan di form
$sql = "SELECT id, jenis_sapi, deskripsi_produk, foto FROM produk";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Update Produk</title>
</head>

<body>
    <h2>Update Produk</h2>

    <!-- Menampilkan pesan hasil operasi -->
    <?php if (isset($resultMessage)) : ?>
        <p><?= htmlspecialchars($resultMessage); ?></p>
    <?php endif; ?>

    <!-- Menampilkan formulir input untuk setiap entri produk -->
    <?php if ($result->num_rows > 0) : ?>
        <?php while ($row = $result->fetch_assoc()) : ?>
            <form action="update_produk.php" method="post" enctype="multipart/form-data">
                <input type="hidden" name="id" value="<?= htmlspecialchars($row['id']); ?>">
                <label for="jenis_sapi">Jenis Sapi:</label>
                <input type="text" name="jenis_sapi" id="jenis_sapi" value="<?= htmlspecialchars($row['jenis_sapi']); ?>" required><br>
                <label for="deskripsi_produk">Deskripsi Produk:</label>
                <textarea name="deskripsi_produk" id="deskripsi_produk" required><?= htmlspecialchars($row['deskripsi_produk']); ?></textarea><br>
                <label for="foto">Foto:</label>
                <input type="file" name="foto" id="foto">
                <?php if (!empty($row['foto'])) : ?>
                    <img src="../assets/images/tentang/<?= htmlspecialchars(basename($row['foto'])); ?>" alt="foto produk" width="50" height="50"><br>
                <?php endif; ?>
                <input type="submit" value="Update Produk">
            </form>
            <hr>
        <?php endwhile; ?>
    <?php else : ?>
        <p>No data found in the database.</p>
    <?php endif; ?>
</body>

</html>