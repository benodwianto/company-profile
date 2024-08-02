<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $kelebihan = isset($_POST['kelebihan']) ? $_POST['kelebihan'] : null;
    $mengapa_ghaffar = isset($_POST['mengapa_ghaffar']) ? $_POST['mengapa_ghaffar'] : null;

    // Periksa apakah ada file yang di-upload
    if (isset($_FILES['foto']) && $_FILES['foto']['error'] === UPLOAD_ERR_OK) {
        $fotoFileInputName = 'foto';
    } else {
        $fotoFileInputName = null; // Tidak ada file baru
    }

    // Proses update data
    if ($id && $kelebihan && $mengapa_ghaffar) {
        $resultMessage = updateLayanan($id, $kelebihan, $mengapa_ghaffar, $fotoFileInputName);
    } else {
        $resultMessage = "Data tidak lengkap, tidak bisa di-update.";
    }
}

$sql = "SELECT id, kelebihan, mengapa_ghaffar, foto FROM layanan";
$result = $conn->query($sql);
?>

<div class="content-page" id="halaman-layanan" style="display: none;">
    <div class="card ms-4 shadow">
        <form action="" method="post" enctype="multipart/form-data" class="p-4">
            <!-- Menampilkan formulir input untuk setiap entri layanan -->
            <?php if ($result->num_rows > 0) : ?>
            <?php while ($row = $result->fetch_assoc()) : ?>
            <input type="hidden" name="id" value="<?= htmlspecialchars($row['id']); ?>">
            <div class="mb-3">
                <label for="Mengapaghaffar" class="form-label">Mengapa Ghaffar</label>
                <textarea class="form-control" name="mengapa_ghaffar" id="Mengapaghaffar" rows="3"
                    placeholder="Masukkan deskripsi singkat di sini..."><?= htmlspecialchars($row['mengapa_ghaffar']); ?></textarea>
            </div>
            <div class="mb-3">
                <label for="kelebihan" class="form-label">Kelebihan</label>
                <textarea class="form-control" name="kelebihan" id="kelebihan" rows="3"
                    placeholder="Masukkan deskripsi singkat di sini..."><?= htmlspecialchars($row['kelebihan']); ?></textarea>
            </div>

            <!-- Input Gambar -->
            <div class="mb-3">
                <label for="inputGambar" class="form-label">Unggah Gambar</label>
                <div class="input-group">
                    <?php if ($row['foto']) : ?>
                    <img src="../../assets/images/layanan/<?= htmlspecialchars(basename($row['foto'])); ?>"
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
</div>