<?php
session_start();
include '../../config/functions.php';

$id = isset($_GET['id']) ? $_GET['id'] : null;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = isset($_POST['id']) ? $_POST['id'] : null;
    $sponsor = $_POST['sponsor'];

    // Periksa apakah ada file yang di-upload
    if (isset($_FILES['foto']) && $_FILES['foto']['error'] === UPLOAD_ERR_OK) {
        $fotoFileInputName = 'foto';
    } else {
        $fotoFileInputName = null; // Tidak ada file baru
    }

    // Proses update data
    $resultMessage = updateSponsor($id, $sponsor, $fotoFileInputName);
}

// Ambil data produk untuk ditampilkan di form
if ($id) {
    $sql = "SELECT id, sponsor, foto FROM sponsor WHERE id = $id";
    $result = $conn->query($sql);
} else {
    $result = null;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, maximum-scale=1, minimum-scale=1">
    <title>PT Ghaffar Farm Bersaudara - Dashboard</title>
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
                    <h2 class="mb-4">Update Sponsor</h2>

                    <!-- Menampilkan pesan hasil operasi -->
                    <?php if (isset($resultMessage)) : ?>
                        <div class="alert alert-info">
                            <?= htmlspecialchars($resultMessage); ?>
                        </div>
                    <?php endif; ?>

                    <!-- Menampilkan formulir input untuk setiap entri produk -->
                    <?php if ($result->num_rows > 0) : ?>
                        <?php while ($row = $result->fetch_assoc()) : ?>
                            <form action="update_sponsor.php" method="post" enctype="multipart/form-data" class="form-update">
                                <input type="hidden" name="id" value="<?= htmlspecialchars($row['id']); ?>">

                                <div class="mb-3">
                                    <label for="sponsor" class="form-label">Sponsor</label>
                                    <input type="text" name="sponsor" id="sponsor" class="form-control" value="<?= htmlspecialchars($row['sponsor']); ?>" required>
                                </div>

                                <div class="mb-3">
                                    <label for="inputGambarSponsor" class="form-label">
                                        <h6>Unggah Gambar</h6>
                                    </label>
                                    <div class="input-group">
                                        <img id="previewSponsor"
                                            src="<?= !empty($row['foto']) ? '../../assets/images/Sponsor/' . htmlspecialchars(basename($row['foto'])) : 'https://community.softr.io/uploads/db9110/original/2X/7/74e6e7e382d0ff5d7773ca9a87e6f6f8817a68a6.jpeg'; ?>"
                                            alt="Preview" width="200" height="200">
                                        <div class="inputan d-flex flex-row">
                                            <input type="file" name="foto" class="form-control d-none"
                                                id="inputGambarSponsor">
                                            <label class="input-group-text rounded"
                                                style="transition: background-color 0.3s, color 0.3s; background-color: #f8f9fa; color: #212529;"
                                                onmouseover="this.style.backgroundColor='#951C11'; this.style.color='#fff';"
                                                onmouseout="this.style.backgroundColor='#f8f9fa'; this.style.color='#212529';"
                                                for="inputGambarSponsor">Choose file</label>
                                            <small class="form-text text-muted m-3" id="fileInfoSponsor">No file
                                                chosen</small>
                                        </div>
                                    </div>
                                    <small class="form-text text-muted">Please upload image size less than 1000KB</small>
                                </div>

                                <button type="submit" class="btn btn-primary">Update Sponsor</button>
                            <?php endwhile; ?>
                        <?php else : ?>
                            <div class="alert alert-warning">
                                No data found in the database.
                            </div>
                        <?php endif; ?>
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
        document.addEventListener('DOMContentLoaded', function() {
            const inputGambarSponsor = document.getElementById('inputGambarSponsor');
            const previewSponsor = document.getElementById('previewSponsor');
            const fileInfoSponsor = document.getElementById('fileInfoSponsor');

            inputGambarSponsor.addEventListener('change', function(event) {
                const file = event.target.files[0];

                if (file) {
                    const reader = new FileReader();

                    reader.onload = function(e) {
                        previewSponsor.src = e.target.result;
                        previewSponsor.style.width = '200px'; // Menyesuaikan ukuran pratinjau
                        previewSponsor.style.height = '200px'; // Menyesuaikan ukuran pratinjau
                        fileInfoSponsor.textContent = file.name;
                    }

                    reader.readAsDataURL(file);
                } else {
                    previewSponsor.src = previewSponsor.dataset.defaultSrc;
                    previewSponsor.style.width = '200px'; // Menyesuaikan ukuran pratinjau
                    previewSponsor.style.height = '200px'; // Menyesuaikan ukuran pratinjau
                    fileInfoSponsor.textContent = "No file chosen";
                }
            });

            previewSponsor.dataset.defaultSrc = previewSponsor.src;
        });
    </script>
</body>

</html>