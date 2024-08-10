<?php
session_start();
include '../../config/functions.php';
if (!isset($_SESSION['admin_id'])) {
    // Jika belum login, arahkan ke halaman login
    header("Location: ../login.php");
    exit();
}

// Cek apakah form telah disubmit
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['update_layanan'])) {
        $id = isset($_POST['id']) ? $_POST['id'] : null;
        $kelebihan = isset($_POST['kelebihan']) ? $_POST['kelebihan'] : null;
        $mengapa_ghaffar = isset($_POST['mengapa_ghaffar']) ? $_POST['mengapa_ghaffar'] : null;

        // Periksa apakah ada file yang di-upload
        if (isset($_FILES['foto']) && $_FILES['foto']['error'] === UPLOAD_ERR_OK) {
            $fotoFileInputName = 'foto';
        } else {
            $fotoFileInputName = null; // Tidak ada file baru
        }

        // Validasi nilai yang tidak boleh null
        if ($id && $mengapa_ghaffar && $kelebihan) {
            // Proses update data
            $resultMessage = updateLayanan($id, $kelebihan, $mengapa_ghaffar, $fotoFileInputName);
        } else {
            $_SESSION['message'] = "Data tidak lengkap, tidak bisa di-update.";
            $_SESSION['message_type'] = 'error';
        }
    } elseif (isset($_POST['update_investasi'])) {
        $id = isset($_POST['id']) ? $_POST['id'] : null;
        $jangka_investasi = isset($_POST['jangka_investasi']) ? $_POST['jangka_investasi'] : null;
        $jlh_investasi = isset($_POST['jlh_investasi']) ? $_POST['jlh_investasi'] : null;

        // Periksa apakah ada file yang di-upload
        if (isset($_FILES['foto']) && $_FILES['foto']['error'] === UPLOAD_ERR_OK) {
            $fotoFileInputName = 'foto';
        } else {
            $fotoFileInputName = null; // Tidak ada file baru
        }

        // Validasi nilai yang tidak boleh null
        if ($id && $jangka_investasi && $jlh_investasi) {
            // Proses update data
            $resultMessage = updateInvestasi($id, $jangka_investasi, $jlh_investasi, $fotoFileInputName);
        } else {
            $_SESSION['message'] = "Data tidak lengkap, tidak bisa di-update.";
            $_SESSION['message_type'] = 'error';
        }
    }
}

// Mendapatkan data dari database
$sqlLayanan = "SELECT id, foto, mengapa_ghaffar, kelebihan FROM layanan";
$resultLayanan = $conn->query($sqlLayanan);

$sqlInvestasi = "SELECT id, jangka_investasi, jlh_investasi, foto FROM investasi";
$resultInvestasi = $conn->query($sqlInvestasi);
?>

<?php include 'aside.php'; ?>
<article class="contracted">
    <?php include 'nav.php'; ?>
    <div class="container mt-0 m-auto">
        <div class="content">
            <div class="content-page ms-4" id="halaman-layanan">
                <h3 class="card-title mb-4 ms-5">Halaman Layanan</h3>
                <div class="card shadow-lg">
                    <form action="" method="post" enctype="multipart/form-data" class="p-4">
                        <?php if ($resultLayanan->num_rows > 0) : ?>
                            <?php while ($rowlayanan = $resultLayanan->fetch_assoc()) : ?>
                                <input type="hidden" name="id" value="<?= htmlspecialchars($rowlayanan['id']); ?>">
                                <input type="hidden" name="update_layanan" value="1">
                                <div class="mb-3">
                                    <label for="mengapa_ghaffar">
                                        <h5>Mengapa Ghaffar : </h5>
                                    </label>
                                    <textarea class="form-control" name="mengapa_ghaffar" id="mengapa_ghaffar" rows="10"
                                        placeholder="Masukkan deskripsi layanan di sini..."><?= htmlspecialchars($rowlayanan['mengapa_ghaffar']); ?></textarea>
                                </div>
                                <div class="mb-3">
                                    <label for="kelebihan">
                                        <h5>Kelebihan : </h5>
                                    </label>
                                    <textarea class="form-control" name="kelebihan" id="deskripsiSingkat" rows="10"
                                        placeholder="Masukkan kelebihan di sini..."><?= htmlspecialchars($rowlayanan['kelebihan']); ?></textarea>
                                </div>
                                <div class="mb-3">
                                    <label for="inputGambarlayanan" class="form-label">
                                        <h6>Unggah gambar</h6>
                                    </label>
                                    <div class="input-group">
                                        <?php if ($rowlayanan['foto']) : ?>
                                            <img src="../../assets/images/layanan/<?= htmlspecialchars(basename($rowlayanan['foto'])); ?>"
                                                alt="Gambar layanan" width="200" height="200">
                                        <?php else : ?>
                                            <img id="previewlayanan"
                                                src="https://community.softr.io/uploads/db9110/original/2X/7/74e6e7e382d0ff5d7773ca9a87e6f6f8817a68a6.jpeg"
                                                alt="Preview" width="50px" height="50px">
                                        <?php endif; ?>
                                        <div class="inputan d-flex flex-row">
                                            <input type="file" name="foto" class="form-control d-none" id="inputGambarlayanan">
                                            <label class="input-group-text rounded"
                                                style="transition: background-color 0.3s, color 0.3s; background-color: #f8f9fa; color: #212529;"
                                                onmouseover="this.style.backgroundColor='#007bff'; this.style.color='#fff';"
                                                onmouseout="this.style.backgroundColor='#f8f9fa'; this.style.color='#212529';"
                                                for="inputGambarLayanan">Choose file</label>
                                            <small class="form-text text-muted m-3" id="fileInfolayanan">No file chosen</small>
                                        </div>
                                    </div>

                                    <small class="form-text text-muted">Please upload image size less than 1000KB</small>
                                </div>
                            <?php endwhile; ?>
                        <?php else : ?>
                            <p>Tidak ada data di database</p>
                        <?php endif; ?>

                        <!-- Tombol Simpan -->
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </form>
                </div>

                <!-- Form Investasi -->
                <h3 class="card-title mt-5 ms-4 mb-0">Halaman Investasi</h3>
                <div class="card  shadow-lg mt-3 mb-5">
                    <form action="" method="post" enctype="multipart/form-data" class="p-4">
                        <?php if ($resultInvestasi->num_rows > 0) : ?>
                            <?php while ($rowInvestasi = $resultInvestasi->fetch_assoc()) : ?>
                                <input type="hidden" name="id" value="<?= htmlspecialchars($rowInvestasi['id']); ?>">
                                <input type="hidden" name="update_investasi" value="1">
                                <div class="mb-3">
                                    <label for="jangkaInvestasi" class="form-label">
                                        <h5>Jangka Investasi : </h5>
                                    </label>
                                    <input type="text" class="form-control" name="jangka_investasi" id="jangkaInvestasi"
                                        value="<?= htmlspecialchars($rowInvestasi['jangka_investasi']); ?>"
                                        placeholder="Masukkan jangka investasi">
                                </div>
                                <div class="mb-3">
                                    <label for="jlhInvestasi" class="form-label">
                                        <h5>Jumlah investasi : </h5>
                                    </label>
                                    <input type="text" class="form-control" name="jlh_investasi" id="jlhInvestasi"
                                        value="<?= htmlspecialchars($rowInvestasi['jlh_investasi']); ?>"
                                        placeholder="Masukkan jumlah investasi">
                                </div>
                                <div class="mb-3">
                                    <label for="inputGambarInvestasi" class="form-label">
                                        <h6>Unggah Gambar</h6>
                                    </label>
                                    <div class="input-group">
                                        <?php if ($rowInvestasi['foto']) : ?>
                                            <img src="../../assets/images/investasi/<?= htmlspecialchars(basename($rowInvestasi['foto'])); ?>"
                                                alt="Foto investasi" width="200" height="200">
                                        <?php else : ?>
                                            <img id="previewInvestasi"
                                                src="https://community.softr.io/uploads/db9110/original/2X/7/74e6e7e382d0ff5d7773ca9a87e6f6f8817a68a6.jpeg"
                                                alt="Preview" width="50px" height="50px">
                                        <?php endif; ?>
                                        <div class="inputan d-flex flex-row">
                                            <input type="file" name="foto" class="form-control d-none"
                                                id="inputGambarInvestasi">
                                            <label class="input-group-text rounded"
                                                style="transition: background-color 0.3s, color 0.3s; background-color: #f8f9fa; color: #212529;"
                                                onmouseover="this.style.backgroundColor='#007bff'; this.style.color='#fff';"
                                                onmouseout="this.style.backgroundColor='#f8f9fa'; this.style.color='#212529';"
                                                for="inputGambarInvestasi">Choose file</label>
                                            <small class="form-text text-muted m-3" id="fileInfoInvestasi">No file
                                                chosen</small>
                                        </div>
                                    </div>
                                    <small class="form-text text-muted">Please upload image size less than 1000KB</small>
                                </div>
                            <?php endwhile; ?>
                        <?php else : ?>
                            <p>No data found in the database.</p>
                        <?php endif; ?>

                        <!-- Tombol Simpan -->
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </form>
                </div>
            </div>
            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        </div>
    </div>
</article>
<?php include 'popup.php'; ?>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="../../assets/js/scriptDashboard.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="../../bootstrap-5.3.3-dist/js/bootstrap.bundle.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.getElementById('inputGambar').addEventListener('change', function(event) {
            const file = event.target.files[0];
            const preview = document.getElementById('previewlayanan');
            const fileInfo = document.getElementById('fileInfolayanan');

            if (file) {
                const reader = new FileReader();

                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.style.width = '200px'; // Menyesuaikan ukuran pratinjau
                    preview.style.height = '200px'; // Menyesuaikan ukuran pratinjau
                }

                reader.readAsDataURL(file);
                fileInfo.textContent = file.name;
            } else {
                preview.src =
                    "https://community.softr.io/uploads/db9110/original/2X/7/74e6e7e382d0ff5d7773ca9a87e6f6f8817a68a6.jpeg";
                preview.style.width = '50px'; // Ukuran default jika tidak ada file
                preview.style.height = '50px'; // Ukuran default jika tidak ada file
                fileInfo.textContent = "No file chosen";
            }
        });
    });
</script>

</body>

</html>