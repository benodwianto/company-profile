<div class="content-tentang" id="halaman-tentang" style="display: none;">
    <div class="container mt-4">
        <form>
            <!-- Judul Deskripsi Singkat -->
            <div class="mb-3">
                <label for="deskripsiSingkat" class="form-label">Deskripsi Singkat</label>
                <textarea class="form-control" id="deskripsiSingkat" rows="3"
                    placeholder="Masukkan deskripsi singkat di sini..."></textarea>
            </div>

            <!-- Judul Tentang Kami -->
            <div class="mb-3">
                <label for="tentangKami" class="form-label">Tentang Kami</label>
                <textarea class="form-control" id="tentangKami" rows="5"
                    placeholder="Masukkan tentang kami di sini..."></textarea>
            </div>

            <!-- Input Gambar -->
            <div class="mb-3">
                <label for="inputGambar" class="form-label">Unggah Gambar</label>
                <div class="input-group">
                    <img id="preview"
                        src="https://community.softr.io/uploads/db9110/original/2X/7/74e6e7e382d0ff5d7773ca9a87e6f6f8817a68a6.jpeg"
                        alt="Preview" width="50px" height="50px">
                    <input type="file" class="form-control d-none" id="inputGambar">
                    <label class="input-group-text" for="inputGambar">Choose file</label>
                    <small class="form-text text-muted" id="fileInfo">No file chosen</small>
                </div>
                <small class="form-text text-muted">Please upload image size less than 1000KB</small>
            </div>

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