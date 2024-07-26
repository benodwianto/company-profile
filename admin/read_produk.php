<?php
include '../config/functions.php';

if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $resultMessage = deleteProduk($id);
}

// Ambil data produk untuk ditampilkan
$sql = "SELECT id, jenis_sapi, deskripsi_produk, foto FROM produk";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Daftar Produk</title>
</head>

<body>
    <h2>Daftar Produk</h2>

    <!-- Menampilkan pesan hasil operasi -->
    <?php if (isset($resultMessage)) : ?>
        <p><?= htmlspecialchars($resultMessage); ?></p>
    <?php endif; ?>

    <!-- Menampilkan tabel data produk -->
    <?php if ($result->num_rows > 0) : ?>
        <table border="1">
            <tr>
                <th>ID</th>
                <th>Jenis Sapi</th>
                <th>Deskripsi Produk</th>
                <th>Foto</th>
                <th>Aksi</th>
            </tr>
            <?php while ($row = $result->fetch_assoc()) : ?>
                <tr>
                    <td><?= htmlspecialchars($row['id']); ?></td>
                    <td><?= htmlspecialchars($row['jenis_sapi']); ?></td>
                    <td><?= htmlspecialchars($row['deskripsi_produk']); ?></td>
                    <td>
                        <?php if (!empty($row['foto'])) : ?>
                            <img src="../assets/images/tentang/<?= htmlspecialchars(basename($row['foto'])); ?>" alt="foto produk" width="50" height="50">
                        <?php else : ?>
                            Tidak ada foto
                        <?php endif; ?>
                    </td>
                    <td>
                        <a href="update_produk.php?id=<?= htmlspecialchars($row['id']); ?>">Update</a> |
                        <a href="daftar_produk.php?delete=<?= htmlspecialchars($row['id']); ?>" onclick="return confirm('Are you sure you want to delete this item?');">Delete</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </table>
    <?php else : ?>
        <p>No data found in the database.</p>
    <?php endif; ?>
</body>

</html>