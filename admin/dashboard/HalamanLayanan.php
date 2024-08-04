<?php
include '../../config/functions.php';
session_start();
if (!isset($_SESSION['admin_id'])) {
    // Jika belum login, arahkan ke halaman login
    header("Location: ../login.php");
    exit();
}
// Cek apakah form telah disubmit
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['update_tentang'])) {
        $id = isset($_POST['id']) ? $_POST['id'] : null;
        $deskripsi_tentang = isset($_POST['deskripsi_tentang']) ? $_POST['deskripsi_tentang'] : null;

        // Periksa apakah ada file yang di-upload
        if (isset($_FILES['foto']) && $_FILES['foto']['error'] === UPLOAD_ERR_OK) {
            $fotoFileInputName = 'foto';
        } else {
            $fotoFileInputName = null; // Tidak ada file baru
        }

        // Validasi nilai yang tidak boleh null
        if ($id && $deskripsi_tentang) {
            // Proses update data
            $resultMessage = updateTentang($id, $deskripsi_tentang, $fotoFileInputName);
        } else {
            $resultMessage = "Data tidak lengkap, tidak bisa di-update.";
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
            $resultMessage = "Data tidak lengkap, tidak bisa di-update.";
        }
    }
}

// Mendapatkan data dari database
$sqlTentang = "SELECT id, foto, deskripsi_tentang FROM tentang";
$resultTentang = $conn->query($sqlTentang);

$sqlInvestasi = "SELECT id, jangka_investasi, jlh_investasi, foto FROM investasi";
$resultInvestasi = $conn->query($sqlInvestasi);

?>

<?php include 'aside.php'; ?>
<article class="contracted">
    <?php include 'nav.php'; ?>
    <div class="container mt-0 m-auto">
        <div class="content">
            <div class="content-page ms-4" id="halaman-layanan">
                <label for="deskripsiSingkat" class="form-label">Deskripsi Singkat</label>
                <div class="card shadow">
                    <form action="" method="post" enctype="multipart/form-data" class="p-4">
                        <?php if ($resultTentang->num_rows > 0) : ?>
                        <?php while ($rowTentang = $resultTentang->fetch_assoc()) : ?>
                        <input type="hidden" name="id" value="<?= htmlspecialchars($rowTentang['id']); ?>">
                        <input type="hidden" name="update_tentang" value="1">
                        <div class="mb-3">

                            <textarea class="form-control" name="deskripsi_tentang" id="deskripsiSingkat" rows="10"
                                placeholder="Masukkan deskripsi singkat di sini..."><?= htmlspecialchars($rowTentang['deskripsi_tentang']); ?></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="inputGambarTentang" class="form-label">Unggah Gambar</label>
                            <div class="input-group">
                                <?php if ($rowTentang['foto']) : ?>
                                <img src="../../assets/images/tentang/<?= htmlspecialchars(basename($rowTentang['foto'])); ?>"
                                    alt="Gambar tentang" width="200" height="200">
                                <?php else : ?>
                                <img id="previewTentang"
                                    src="https://community.softr.io/uploads/db9110/original/2X/7/74e6e7e382d0ff5d7773ca9a87e6f6f8817a68a6.jpeg"
                                    alt="Preview" width="50px" height="50px">
                                <?php endif; ?>
                                <input type="file" name="foto" class="form-control d-none" id="inputGambarTentang">
                                <label class="input-group-text" for="inputGambarTentang">Choose file</label>
                                <small class="form-text text-muted" id="fileInfoTentang">No file chosen</small>
                            </div>
                            <small class="form-text text-muted">Please upload image size less than
                                1000KB</small>
                        </div>
                        <?php endwhile; ?>
                        <?php else : ?>
                        <p>No data found in the database.</p>
                        <?php endif; ?>

                        <!-- Tombol Simpan -->
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </form>
                </div>

                <!-- Form Investasi -->
                <div class="card  shadow mt-3">
                    <form action="" method="post" enctype="multipart/form-data" class="p-4">
                        <?php if ($resultInvestasi->num_rows > 0) : ?>
                        <?php while ($rowInvestasi = $resultInvestasi->fetch_assoc()) : ?>
                        <input type="hidden" name="id" value="<?= htmlspecialchars($rowInvestasi['id']); ?>">
                        <input type="hidden" name="update_investasi" value="1">
                        <div class="mb-3">
                            <label for="jangkaInvestasi" class="form-label">Jangka Investasi</label>
                            <input type="text" class="form-control" name="jangka_investasi" id="jangkaInvestasi"
                                value="<?= htmlspecialchars($rowInvestasi['jangka_investasi']); ?>"
                                placeholder="Masukkan jangka investasi">
                        </div>
                        <div class="mb-3">
                            <label for="jlhInvestasi" class="form-label">Jumlah Investasi</label>
                            <input type="text" class="form-control" name="jlh_investasi" id="jlhInvestasi"
                                value="<?= htmlspecialchars($rowInvestasi['jlh_investasi']); ?>"
                                placeholder="Masukkan jumlah investasi">
                        </div>
                        <div class="mb-3">
                            <label for="inputGambarInvestasi" class="form-label">Unggah Gambar</label>
                            <div class="input-group">
                                <?php if ($rowInvestasi['foto']) : ?>
                                <img src="../../assets/images/investasi/<?= htmlspecialchars(basename($rowInvestasi['foto'])); ?>"
                                    alt="Foto investasi" width="200" height="200">
                                <?php else : ?>
                                <img id="previewInvestasi"
                                    src="https://community.softr.io/uploads/db9110/original/2X/7/74e6e7e382d0ff5d7773ca9a87e6f6f8817a68a6.jpeg"
                                    alt="Preview" width="50px" height="50px">
                                <?php endif; ?>
                                <input type="file" name="foto" class="form-control d-none" id="inputGambarInvestasi">
                                <label class="input-group-text" for="inputGambarInvestasi">Choose file</label>
                                <small class="form-text text-muted" id="fileInfoInvestasi">No file
                                    chosen</small>
                            </div>
                            <small class="form-text text-muted">Please upload image size less than
                                1000KB</small>
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
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="../../assets/js/scriptDashboard.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="../../bootstrap-5.3.3-dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>