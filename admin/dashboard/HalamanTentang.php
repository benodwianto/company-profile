<?php
session_start();
include '../../config/functions.php';

if (!isset($_SESSION['admin_id'])) {
    header("Location: ../login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'] ?? null;

    if (isset($_POST['update_tentang'])) {
        $deskripsi_tentang = $_POST['deskripsi_tentang'] ?? null;
        $fotoFileInputName = (isset($_FILES['foto']) && $_FILES['foto']['error'] === UPLOAD_ERR_OK) ? 'foto' : null;

        $resultMessage = ($id && $deskripsi_tentang)
            ? updateTentang($id, $deskripsi_tentang, $fotoFileInputName)
            : "Data tidak lengkap, tidak bisa di-update.";
    } elseif (isset($_POST['update_visimisi'])) {
        $visi = $_POST['visi'] ?? null;
        $misi = $_POST['misi'] ?? null;
        $fotoFileInputName = (isset($_FILES['foto_visimisi']) && $_FILES['foto_visimisi']['error'] === UPLOAD_ERR_OK) ? 'foto_visimisi' : null;

        $resultMessage = updateVisiMisi($id, $visi, $misi, $fotoFileInputName);
    }
}

$sql = "SELECT id, foto, deskripsi_tentang FROM tentang";
$result = $conn->query($sql);

$sqlVisiMisi = "SELECT id, visi, misi, foto FROM visi_misi";
$resultVisiMisi = $conn->query($sqlVisiMisi);
?>

<?php include 'aside.php'; ?>
<article class="contracted">
    <?php include 'nav.php'; ?>
    <div class="container mt-0">
        <div class="content">
            <div class="content-page" id="halaman-tentang">
                <h5 class="card-title mt-2 ms-5">Tentang Kami</h5>
                <div class="container mt-3">
                    <div class="card ms-4 shadow">
                        <!-- Form untuk Tentang Kami -->
                        <form action="" method="post" enctype="multipart/form-data" class="p-4">
                            <?php if ($result->num_rows > 0) : ?>
                                <?php while ($row = $result->fetch_assoc()) : ?>
                                    <input type="hidden" name="id" value="<?= htmlspecialchars($row['id']); ?>">
                                    <input type="hidden" name="update_tentang" value="1">

                                    <div class="mb-3">
                                        <label for="deskripsiSingkat" class="form-label">
                                            <h6>Deskripsi Singkat</h6>
                                        </label>
                                        <textarea class="form-control" name="deskripsi_tentang" id="deskripsiSingkat" rows="10"
                                            placeholder="Masukkan deskripsi singkat di sini..."><?= htmlspecialchars($row['deskripsi_tentang']); ?></textarea>
                                    </div>

                                    <!-- Input Gambar -->
                                    <div class="mb-3">
                                        <label for="inputGambar" class="form-label">
                                            <h6>Unggah Gambar</h6>
                                        </label>
                                        <div class="input-group">
                                            <img id="preview"
                                                src="<?= $row['foto'] ? '../../assets/images/tentang/' . htmlspecialchars(basename($row['foto'])) : 'https://community.softr.io/uploads/db9110/original/2X/7/74e6e7e382d0ff5d7773ca9a87e6f6f8817a68a6.jpeg'; ?>"
                                                alt="Gambar tentang" width="200" height="200">
                                            <input type="file" name="foto" class="form-control d-none" id="inputGambar">
                                            <label class="input-group-text rounded"
                                                style="transition: background-color 0.3s, color 0.3s; background-color: #f8f9fa; color: #212529;"
                                                onmouseover="this.style.backgroundColor='#951C11'; this.style.color='#fff';"
                                                onmouseout="this.style.backgroundColor='#f8f9fa'; this.style.color='#212529';"
                                                for="inputGambar">Choose file</label>
                                            <small class="form-text text-muted m-3" id="fileInfo">No file chosen</small>
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

                    <h5 class="card-title mt-5 ms-5">Visi Misi</h5>
                    <div class="card ms-4 shadow mt-3">
                        <!-- Form untuk Visi Misi -->
                        <form action="" method="post" enctype="multipart/form-data" class="p-4">
                            <?php if ($resultVisiMisi->num_rows > 0) : ?>
                                <?php while ($row = $resultVisiMisi->fetch_assoc()) : ?>
                                    <input type="hidden" name="id" value="<?= htmlspecialchars($row['id']); ?>">
                                    <input type="hidden" name="update_visimisi" value="1">

                                    <div class="mb-3">
                                        <label for="visi" class="form-label">
                                            <h6>Visi</h6>
                                        </label>
                                        <textarea class="form-control" name="visi" id="visi" rows="4"
                                            placeholder="Masukkan visi di sini..."><?= htmlspecialchars($row['visi']); ?></textarea>
                                    </div>

                                    <div class="mb-3">
                                        <label for="misi" class="form-label">
                                            <h6>Misi</h6>
                                        </label>
                                        <textarea class="form-control" name="misi" id="misi" rows="4"
                                            placeholder="Masukkan misi di sini..."><?= htmlspecialchars($row['misi']); ?></textarea>
                                    </div>

                                    <div class="mb-3">
                                        <label for="foto_visimisi" class="form-label">
                                            <h6>Unggah Gambar</h6>
                                        </label>
                                        <div class="input-group">
                                            <img id="preview_visimisi"
                                                src="<?= $row['foto'] ? '../../assets/images/visi_misi/' . htmlspecialchars(basename($row['foto'])) : 'https://community.softr.io/uploads/db9110/original/2X/7/74e6e7e382d0ff5d7773ca9a87e6f6f8817a68a6.jpeg'; ?>"
                                                alt="Gambar visi misi" width="200" height="200">
                                            <input type="file" name="foto_visimisi" class="form-control d-none"
                                                id="foto_visimisi">
                                            <label class="input-group-text rounded"
                                                style="transition: background-color 0.3s, color 0.3s; background-color: #f8f9fa; color: #212529;"
                                                onmouseover="this.style.backgroundColor='#951C11'; this.style.color='#fff';"
                                                onmouseout="this.style.backgroundColor='#f8f9fa'; this.style.color='#212529';"
                                                for="foto_visimisi">Choose file</label>
                                            <small class="form-text text-muted m-3" id="fileInfo_visimisi">No file
                                                chosen</small>
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
            </div>

            <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
            <script src="../../assets/js/scriptDashboard.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
            <script src="../../bootstrap-5.3.3-dist/js/bootstrap.bundle.min.js"></script>

            <!-- Preview Gambar Tentang Kami -->
            <script>
                document.getElementById('inputGambar').addEventListener('change', function(event) {
                    const file = event.target.files[0];
                    const preview = document.getElementById('preview');
                    const fileInfo = document.getElementById('fileInfo');

                    if (file) {
                        const reader = new FileReader();
                        reader.onload = function(e) {
                            preview.src = e.target.result;
                        }
                        reader.readAsDataURL(file);
                        fileInfo.textContent = file.name;
                    } else {
                        fileInfo.textContent = "No file chosen";
                    }
                });
            </script>

            <!-- Preview Gambar Visi Misi -->
            <script>
                document.getElementById('foto_visimisi').addEventListener('change', function(event) {
                    const file = event.target.files[0];
                    const preview = document.getElementById('preview_visimisi');
                    const fileInfo = document.getElementById('fileInfo_visimisi');

                    if (file) {
                        const reader = new FileReader();
                        reader.onload = function(e) {
                            preview.src = e.target.result;
                        }
                        reader.readAsDataURL(file);
                        fileInfo.textContent = file.name;
                    } else {
                        fileInfo.textContent = "No file chosen";
                    }
                });
            </script>
        </div>
    </div>
</article>