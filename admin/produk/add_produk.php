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
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, maximum-scale=1, minimum-scale=1">
    <title>PT Ghaffar Farm Bersaudara - Insert Produk</title>
    <link rel="stylesheet" href="../../assets/css/dashboard.css">
    <link rel="stylesheet" href="../../bootstrap-5.3.3-dist/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.0/font/bootstrap-icons.min.css"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<body>
    <?php include 'asidesecond.php'; ?>
    <article class="contracted">
        <?php include 'navsecond.php'; ?>
        <div class="content">


            <div class="container mt-5">
                <h2 class="mb-4">Insert Produk</h2>

                <!-- Menampilkan pesan hasil operasi -->
                <?php if (isset($resultMessage)) : ?>
                <div class="alert alert-info">
                    <?= htmlspecialchars($resultMessage); ?>
                </div>
                <?php endif; ?>

                <!-- Formulir input untuk insert produk baru -->
                <form action="add_produk.php" method="post" enctype="multipart/form-data" class="form-insert">
                    <div class="mb-3">
                        <label for="jenis_sapi" class="form-label">Jenis Sapi:</label>
                        <input type="text" name="jenis_sapi" id="jenis_sapi" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label for="deskripsi_produk" class="form-label">Deskripsi Produk:</label>
                        <textarea name="deskripsi_produk" id="deskripsi_produk" class="form-control" rows="4"
                            required></textarea>
                    </div>

                    <div class="mb-3">
                        <label for="foto" class="form-label">Foto:</label>
                        <input type="file" name="foto" id="foto" class="form-control" required>
                    </div>

                    <button type="submit" class="btn btn-primary">Insert Produk</button>
                </form>
            </div>
        </div>
        <script src="../../bootstrap-5.3.3-dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>