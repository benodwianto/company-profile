<?php


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
    } elseif (isset($_POST['update_visimisi'])) {
        $id = $_POST['id'];
        $visi = $_POST['visi'];
        $misi = $_POST['misi'];

        // Periksa apakah ada file yang di-upload
        if (isset($_FILES['foto_visimisi']) && $_FILES['foto_visimisi']['error'] === UPLOAD_ERR_OK) {
            $fotoFileInputName = 'foto_visimisi';
        } else {
            $fotoFileInputName = null; // Tidak ada file baru
        }

        // Proses update data
        $resultMessage = updateVisiMisi($id, $visi, $misi, $fotoFileInputName);
    }
}

// Mendapatkan data dari database
$sql = "SELECT id, foto, deskripsi_tentang FROM tentang";
$result = $conn->query($sql);

$sqlVisiMisi = "SELECT id, visi, misi, foto FROM visi_misi";
$resultVisiMisi = $conn->query($sqlVisiMisi);
?>

<div class="content-page" id="halaman-tentang" style="display: none;">
    <div class="container mt-3">
        <div class="card ms-4 shadow">
            <!-- Form untuk Tentang Kami -->
            <form action="" method="post" enctype="multipart/form-data" class="p-4">
                <?php if ($result->num_rows > 0) : ?>
                <?php while ($row = $result->fetch_assoc()) : ?>
                <input type="hidden" name="id" value="<?= htmlspecialchars($row['id']); ?>">
                <input type="hidden" name="update_tentang" value="1">
                <div class="mb-3">
                    <label for="deskripsiSingkat" class="form-label">Deskripsi Singkat</label>
                    <textarea class="form-control" name="deskripsi_tentang" id="deskripsiSingkat" rows="10"
                        placeholder="Masukkan deskripsi singkat di sini..."><?= htmlspecialchars($row['deskripsi_tentang']); ?></textarea>
                </div>
                <!-- Input Gambar -->
                <div class="mb-3">
                    <label for="inputGambar" class="form-label">Unggah Gambar</label>
                    <div class="input-group">
                        <?php if ($row['foto']) : ?>
                        <img src="../../assets/images/tentang/<?= htmlspecialchars(basename($row['foto'])); ?>"
                            alt="Gambar tentang" width="200" height="200">
                        <?php else : ?>
                        <img id="preview"
                            src="https://community.softr.io/uploads/db9110/original/2X/7/74e6e7e382d0ff5d7773ca9a87e6f6f8817a68a6.jpeg"
                            alt="Preview" width="50px" height="50px">
                        <?php endif; ?>
                        <input type="file" name="foto" class="form-control d-none" id="inputGambar">
                        <label class="input-group-text" for="inputGambar">Choose file</label>
                        <small class="form-text text-muted" id="fileInfo">No file chosen</small>
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

        <div class="card ms-4 shadow mt-3">
            <!-- Form untuk Visi Misi -->
            <form action="" method="post" enctype="multipart/form-data" class="p-4">
                <?php if ($resultVisiMisi->num_rows > 0) : ?>
                <?php while ($row = $resultVisiMisi->fetch_assoc()) : ?>
                <input type="hidden" name="id" value="<?= htmlspecialchars($row['id']); ?>">
                <input type="hidden" name="update_visimisi" value="1">
                <div class="mb-3">
                    <label for="visi" class="form-label">Visi</label>
                    <textarea class="form-control" name="visi" id="visi" rows="4"
                        placeholder="Masukkan visi di sini..."><?= htmlspecialchars($row['visi']); ?></textarea>
                </div>
                <div class="mb-3">
                    <label for="misi" class="form-label">Misi</label>
                    <textarea class="form-control" name="misi" id="misi" rows="4"
                        placeholder="Masukkan misi di sini..."><?= htmlspecialchars($row['misi']); ?></textarea>
                </div>
                <div class="mb-3">
                    <label for="foto_visimisi" class="form-label">Unggah Gambar</label>
                    <div class="input-group">
                        <?php if ($row['foto']) : ?>
                        <img src="../assets/images/visi_misi/<?= htmlspecialchars(basename($row['foto'])); ?>"
                            alt="Gambar visi misi" width="200" height="200">
                        <?php else : ?>
                        <img id="preview_visimisi"
                            src="https://community.softr.io/uploads/db9110/original/2X/7/74e6e7e382d0ff5d7773ca9a87e6f6f8817a68a6.jpeg"
                            alt="Preview" width="50px" height="50px">
                        <?php endif; ?>
                        <input type="file" name="foto_visimisi" class="form-control d-none" id="foto_visimisi">
                        <label class="input-group-text" for="foto_visimisi">Choose file</label>
                        <small class="form-text text-muted" id="fileInfo_visimisi">No file chosen</small>
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