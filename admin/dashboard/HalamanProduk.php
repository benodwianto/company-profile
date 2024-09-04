<?php
include '../../config/functions.php';
session_start();

if (!isset($_SESSION['admin_id']) || !isset($_SESSION['status'])) {
    header("Location: ../login.php");
    exit();
}

if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $resultMessage = deleteProduk($id);
    $_SESSION['message'] = $resultMessage;
    $_SESSION['message_type'] = 'success'; // atau 'error' sesuai kebutuhan
    header('Location: produk.php');
    exit;
}

$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$searchQuery = isset($_GET['search']) ? $_GET['search'] : null;

$recordsPerPage = 9;
$produk = getProdukWithPagination($page, $recordsPerPage, $searchQuery);
$totalPages = getTotalProdukPages($recordsPerPage, $searchQuery);
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
        <div class="container mt-2">
            <div class="content" style="padding-top: 100px">
                <div class="content-page" id="halaman-produk">
                    <div class="container mt-5">
                        <h5>Daftar Produk</h5>

                        <!-- Form Pencarian Produk -->
                        <div class="mb-4">
                            <form action="" method="get" class="d-flex align-items-center w-50">
                                <div class="input-group me-2">
                                    <span class="input-group-text" style="height: 50px;"><i
                                            class="fas fa-search"></i></span>
                                    <input type="text" name="search" class="form-control" class="form-control"
                                        placeholder="Cari produk..." value="<?= $searchQuery; ?>">
                                </div>
                                <button type="submit" style="height: 50px;" class="btn btn-primary">Cari</button>
                            </form>
                        </div>
                        <!-- Menampilkan data produk -->
                        <div class="product-container">
                            <?php if (count($produk) > 0) : ?>
                            <?php foreach ($produk as $row) : ?>
                            <div class="product-card">
                                <img src="../../assets/images/produk/<?= htmlspecialchars(basename($row['foto'])); ?>"
                                    alt="<?= htmlspecialchars($row['jenis_sapi']); ?>" class="product-image">
                                <p class="nama-sponsordanproduk"><?= htmlspecialchars($row['jenis_sapi']); ?></p>
                                <div class="product-icons">
                                    <a href="../produk/update_produk.php?id=<?= htmlspecialchars($row['id']); ?>"
                                        class="icon-link"><i class="fa fa-edit"></i></a>
                                    <a href="../produk/delete_produk.php?id=<?= htmlspecialchars($row['id']); ?>"
                                        class="icon-link"><i class="fa fa-trash delete-button"></i></a>
                                </div>
                            </div>
                            <?php endforeach; ?>
                            <div class="product-card add-product">
                                <a href="../produk/add_produk.php" class="add-product-link">
                                    <i class="fa fa-plus"></i>
                                    <p>Tambah Produk</p>
                                </a>
                            </div>
                            <?php else : ?>
                            <div class="no-data text-center mt-5">
                                <h6>Tidak ada data produk ditemukan</h6>
                            </div>
                            <?php endif; ?>
                        </div>
                        <!-- Menampilkan pagination -->
                        <div class="pagination mt-4 mb-4 p-10">
                            <p class="m-10">Page</p>
                            <?= generatePaginationLinks($page, $totalPages); ?>
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
    <script>
    $(document).ready(function() {
        $('body').on('click', '.delete-button', function(e) {
            e.preventDefault();
            var link = $(this).closest('a').attr('href'); // Pastikan mengambil href dari elemen <a>

            Swal.fire({
                title: 'Apakah Anda Yakin?',
                text: "Anda tidak akan dapat memulihkan item ini",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, tetap hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href =
                    link; // Redirect ke URL penghapusan jika dikonfirmasi
                }
            });
        });
    });
    </script>
</body>

</html>