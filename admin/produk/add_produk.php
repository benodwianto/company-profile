<?php
session_start();
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
                <div class="content-update-produk">
                    <h2 class="mb-4">Insert Produk</h2>

                    <!-- Menampilkan pesan hasil operasi -->
                    <?php if (isset($resultMessage)) : ?>
                        <div class="alert alert-info">
                            <?= htmlspecialchars($resultMessage); ?>
                        </div>
                    <?php endif; ?>

                    <!-- Formulir input untuk insert produk baru -->
                    <form action="" method="post" enctype="multipart/form-data" class="form-update">
                        <div class="mb-3">
                            <label for="jenis_sapi" class="form-label">Jenis Sapi:</label>
                            <input type="text" name="jenis_sapi" id="jenis_sapi" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label for="deskripsi_produk" class="form-label">Deskripsi Produk:</label>
                            <textarea name="deskripsi_produk" id="deskripsi_produk" class="form-control" rows="4"
                                required></textarea>
                        </div>

                        <div class="inputan d-flex flex-row mb-3 gap-2">
                            <img id="previewGambar"
                                src="https://community.softr.io/uploads/db9110/original/2X/7/74e6e7e382d0ff5d7773ca9a87e6f6f8817a68a6.jpeg"
                                alt="Preview" width="50px" height="50px">
                            <input type="file" name="foto" class="form-control d-none" id="inputGambarProduk">
                            <label class="input-group-text rounded"
                                style="transition: background-color 0.3s, color 0.3s; background-color: #f8f9fa; color: #212529;"
                                onmouseover="this.style.backgroundColor='#951C11'; this.style.color='#fff';"
                                onmouseout="this.style.backgroundColor='#f8f9fa'; this.style.color='#212529';"
                                for="inputGambarProduk">Choose file</label>
                            <small class="form-text text-muted m-3" id="fileInsert">No file chosen</small>
                        </div>

                        <button type="submit" class="btn btn-primary" value="Insert">Insert Produk</button>
                    </form>
                </div>
            </div>
        </div>
        <!-- Menampilkan pesan hasil operasi -->
        <?php include '../dashboard/popup.php'; ?>
        <script src="../../bootstrap-5.3.3-dist/js/bootstrap.bundle.min.js"></script>
        <script>
            const inputGambar = document.getElementById('inputGambarProduk');
            const previewGambar = document.getElementById('previewGambar');
            const fileInsert = document.getElementById('fileInsert');

            inputGambar.addEventListener('change', function() {
                const file = this.files[0];
                if (file) {
                    const reader = new FileReader();

                    reader.onload = function(event) {
                        previewGambar.src = event.target.result;
                    }

                    reader.readAsDataURL(file);

                    fileInsert.textContent = file.name;
                } else {
                    previewGambar.src =
                        'https://community.softr.io/uploads/db9110/original/2X/7/74e6e7e382d0ff5d7773ca9a87e6f6f8817a68a6.jpeg';
                    fileInsert.textContent = 'No file chosen';
                }
            });
        </script>
</body>

</html>