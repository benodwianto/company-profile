<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $deskripsi_tentang = $_POST['deskripsi_tentang'];
    $tentang_kami = $_POST['tentang_kami'];

    // Periksa apakah ada file yang di-upload
    if (isset($_FILES['foto']) && $_FILES['foto']['error'] === UPLOAD_ERR_OK) {
        $fotoFileInputName = 'foto';
    } else {
        $fotoFileInputName = null; // Tidak ada file baru
    }

    // Proses update data
    $resultMessage = updateTentang($id, $deskripsi_tentang, $tentang_kami, $fotoFileInputName);
}

$sql = "SELECT id, foto, deskripsi_tentang,tentang_kami, foto FROM tentang";
$result = $conn->query($sql);
?>

<div class="content-page" id="halaman-tentang" style="display: none;">
    <div class="container mt-4">
        <form action="" method="post" enctype="multipart/form-data">
            <!-- Judul Deskripsi Singkat -->
            <?php if ($result->num_rows > 0) : ?>
                <?php while ($row = $result->fetch_assoc()) : ?>
                    <input type="hidden" name="id" value="<?= htmlspecialchars($row['id']); ?>">
                    <div class="mb-3">
                        <label for="deskripsiSingkat" class="form-label">Deskripsi Singkat</label>
                        <textarea class="form-control" name="deskripsi_tentang" id="deskripsiSingkat" rows="3" placeholder="Masukkan deskripsi singkat di sini..."><?= htmlspecialchars($row['deskripsi_tentang']); ?></textarea>
                    </div>

                    <!-- Judul Tentang Kami -->
                    <div class="mb-3">
                        <label for="tentangKami" class="form-label">Tentang Kami</label>
                        <textarea class="form-control" name="tentang_kami" id="tentangKami" rows="5" placeholder="Masukkan tentang kami di sini..."><?= htmlspecialchars($row['tentang_kami']); ?></textarea>
                    </div>

                    <!-- Input Gambar -->
                    <div class="mb-3">
                        <label for="inputGambar" class="form-label">Unggah Gambar</label>
                        <div class="input-group">
                            <?php if ($row['foto']) : ?>
                                <img src="../../assets/images/tentang/<?= htmlspecialchars(basename($row['foto'])); ?>" alt="Gambar tentang" width="200" height="200">
                            <?php else : ?>
                                <img id="preview" src="https://community.softr.io/uploads/db9110/original/2X/7/74e6e7e382d0ff5d7773ca9a87e6f6f8817a68a6.jpeg" alt="Preview" width="50px" height="50px">
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

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('#inputGambar').on('change', function() {
            var fileName = $(this).val().split('\\').pop();
            if (fileName) {
                $('#fileInfo').text(fileName);
            } else {
                $('#fileInfo').text('No file chosen');
            }

            // Preview the image
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#preview').attr('src', e.target.result);
            }
            reader.readAsDataURL(this.files[0]);
        });
    });
</script>