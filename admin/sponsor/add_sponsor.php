<?php
session_start();
include '../../config/functions.php'; // Meng-include file fungsi

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $sponsor = $_POST['sponsor'];
    $fotoFileInputName = 'foto';

    // Proses insert data
    $resultMessage = insertSponsor($sponsor, $fotoFileInputName);
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, maximum-scale=1, minimum-scale=1">
    <title>PT Ghaffar Farm Bersaudara - Tambah Sponsor</title>
    <link rel="stylesheet" href="../../assets/css/dashboard.css">
    <link rel="stylesheet" href="../../bootstrap-5.3.3-dist/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.0/font/bootstrap-icons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<body>
    <?php include '../produk/asidesecond.php'; ?>
    <article class="contracted">
        <?php include '../produk/navsecond.php'; ?>
        <div class="content">

            <div class="container mt-5">
                <div class="content-update-produk">
                    <h2 class="mb-4">Tambah sponsor</h2>

                    <!-- Menampilkan pesan hasil operasi -->
                    <?php if (isset($resultMessage)) : ?>
                        <div class="alert alert-info">
                            <?= htmlspecialchars($resultMessage); ?>
                        </div>
                    <?php endif; ?>

                    <!-- Menampilkan formulir input untuk setiap entri sponsor -->
                    <form action="" method="post" enctype="multipart/form-data" class="form-update">
                        <div class="mb-3">
                            <label for="sponsor" class="form-label">Sponsor:</label>
                            <input type="text" name="sponsor" id="sponsor" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label for="inputGambarsponsor" class="form-label">
                                <h6>Unggah Gambar</h6>
                            </label>
                            <div class="inputan d-flex flex-row mb-3 gap-2">
                                <img id="previewGambar"
                                    src="https://community.softr.io/uploads/db9110/original/2X/7/74e6e7e382d0ff5d7773ca9a87e6f6f8817a68a6.jpeg"
                                    alt="Preview" width="50px" height="50px">
                                <input type="file" name="foto" class="form-control d-none" id="inputGambarSponsor">
                                <label class="input-group-text rounded"
                                    style="transition: background-color 0.3s, color 0.3s; background-color: #f8f9fa; color: #212529;"
                                    onmouseover="this.style.backgroundColor='#951C11'; this.style.color='#fff';"
                                    onmouseout="this.style.backgroundColor='#f8f9fa'; this.style.color='#212529';"
                                    for="inputGambarSponsor">Choose file</label>
                                <small class="form-text text-muted m-3" id="fileInsert">No file chosen</small>
                            </div>
                            <small class="form-text text-muted">Please upload image size less than 1000KB</small>
                        </div>

                        <button type="submit" class="btn btn-primary">Tambah sponsor</button>
                    </form>
                    <hr>

                </div>
            </div>

        </div>
    </article>

    <?php include '../dashboard/popup.php'; ?>

    <script src="../../assets/js/scriptDashboard.js"></script>
    <script src="../../bootstrap-5.3.3-dist/js/bootstrap.bundle.min.js"></script>
    <script>
        const inputGambar = document.getElementById('inputGambarSponsor');
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