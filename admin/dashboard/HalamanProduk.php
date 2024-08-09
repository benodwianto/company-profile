<?php
include '../../config/functions.php';
session_start();

if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $resultMessage = deleteProduk($id);
    $_SESSION['message'] = $resultMessage;
    $_SESSION['message_type'] = 'success'; // atau 'error' sesuai kebutuhan
    header('Location: produk.php');
    exit;
}

// Ambil data produk untuk ditampilkan
$sql = "SELECT id, jenis_sapi, deskripsi_produk, foto FROM produk";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, maximum-scale=1, minimum-scale=1">
    <title>PT Ghaffar Farm Bersaudara - Dashboard</title>
    <link rel="stylesheet" href="../../assets/css/dashboard.css">
    <link rel="stylesheet" href="../../bootstrap-5.3.3-dist/css/bootstrap.min.css">
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.0/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
</head>

<body>
    <?php include 'aside.php'; ?>
    <article class="contracted">
        <?php include '../dashboard/nav.php'; ?>
        <div class="container mt-5">
            <div class="content" style="padding-top: 100px">
                <div class="content-page" id="halaman-produk">
                    <div class="container mt-5">
                        <h2>Daftar Produk</h2>

                        <!-- Menampilkan data produk -->
                        <div class="product-container">
                            <?php if ($result->num_rows > 0) : ?>
                            <?php while ($row = $result->fetch_assoc()) : ?>
                            <div class="product-card">
                                <img src="../../assets/images/produk/<?= htmlspecialchars(basename($row['foto'])); ?>"
                                    alt="<?= htmlspecialchars($row['jenis_sapi']); ?>" class="product-image">
                                <h4><?= htmlspecialchars($row['jenis_sapi']); ?></h4>
                                <div class="product-icons">
                                    <a href="../produk/update_produk.php?id=<?= htmlspecialchars($row['id']); ?>"
                                        class="icon-link"><i class="fa fa-edit"></i></a>
                                    <a href="../produk/delete_produk.php?id=<?= htmlspecialchars($row['id']); ?>"
                                        class="icon-link"
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
            </div>
        </div>
    </article>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="../../assets/js/scriptDashboard.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="../../bootstrap-5.3.3-dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>