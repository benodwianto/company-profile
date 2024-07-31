<?php

if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $resultMessage = deleteProduk($id);
}

// Ambil data produk untuk ditampilkan
$sql = "SELECT id, jenis_sapi, deskripsi_produk, foto FROM produk";
$result = $conn->query($sql);
?>

<div class="content-page" id="halaman-produk" style="display: none;">
    <div class="container mt-5">
        <h2>Daftar Produk</h2>

        <!-- Menampilkan pesan hasil operasi -->
        <?php if (isset($resultMessage)) : ?>
        <p><?= htmlspecialchars($resultMessage); ?></p>
        <?php endif; ?>

        <!-- Menampilkan data produk -->
        <div class="product-container">
            <?php if ($result->num_rows > 0) : ?>
            <?php while ($row = $result->fetch_assoc()) : ?>
            <div class="product-card">
                <img src="../../assets/images/produk/<?= htmlspecialchars(basename($row['foto'])); ?>"
                    alt="<?= htmlspecialchars($row['jenis_sapi']); ?>" class="product-image">
                <h3><?= htmlspecialchars($row['jenis_sapi']); ?></h3>
                <div class="product-icons">
                    <a href="../produk/update_produk.php?id=<?= htmlspecialchars($row['id']); ?>" class="icon-link"><i
                            class="fa fa-edit"></i></a>
                    <a href="delete_produk.php?id=<?= htmlspecialchars($row['id']); ?>" class="icon-link"
                        onclick="return confirm('Are you sure you want to delete this item?');"><i
                            class="fa fa-trash"></i></a>
                </div>
            </div>
            <?php endwhile; ?>
            <?php else : ?>
            <p>No data found in the database.</p>
            <?php endif; ?>
            <div class="product-card add-product">
                <a href="../produk/add_produk.php" class="add-product-link">
                    <i class="fa fa-plus"></i>
                    <p>Tambah Produk</p>
                </a>
            </div>
        </div>
    </div>
</div>