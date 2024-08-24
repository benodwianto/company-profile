<?php
include '../../config/functions.php';

session_start();
if (!isset($_SESSION['admin_id'])) {
    // Jika belum login, arahkan ke halaman login
    header("Location: ../login.php");
    exit();
}

// Ambil semua data legalitas
$dataLegalitas = getAllData('legalitas');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (!empty($_FILES['legalitas']['name'])) {
        // Validasi input dan proses pengunggahan file
        $fileInputNameLegalitas = 'legalitas';
        $sertifikat = isset($_POST['sertifikat']) ? $_POST['sertifikat'] : '';

        // Proses insert data
        $resultMessage = insertLegalitas($fileInputNameLegalitas, $sertifikat);
    }
}

?>


<?php include 'aside.php'; ?>

<article class="contracted">
    <?php include 'nav.php'; ?>
    <div class="container ml-0">
        <div class="content">
            <h5 class="card-title ms-01 mb-4">Legalitas</h5>
            <div class="card p-5 shadow mb-5">
                <h6>Upload Legalitas</h6>
                <form id="upload-form" action="" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <div class="file-upload-wrapper">
                            <img src="../../assets/images/pdf-icon.png" alt="PDF Icon" class="pdf-icon">
                            <div class="legalitas">
                                <label for="legalitas-upload" class="form-label">
                                    <h6>Hanya file PDF</h6>
                                </label>
                                <label for="legalitas-upload" class="btn-file">Choose File</label>
                                <input type="file" id="legalitas-upload" name="legalitas" accept=".pdf" required>
                            </div>
                            <div class="chosen mt-5 ms-3">
                                <span class="file-name">No File Chosen</span>
                            </div>
                        </div>

                        <label for="sertifikat" class="form-label" style="margin-top: 20px;">
                            <h6>Nama Sertifikat</h6>
                        </label>
                        <input type="text" name="sertifikat" id="sertifikat" class="form-control"
                            placeholder="Masukkan Nama Sertifikat" required>

                    </div>

                    <button type="submit" class="btn-dark">Tambahkan</button>
                </form>


                <h5 class="mt-5">Daftar Legalitas</h5>

                <table class="table table-striped table-bordered mt-4">
                    <thead class="table-dark">
                        <tr>
                            <th>No</th>
                            <th>Sertifikat</th>

                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        foreach ($dataLegalitas as $legalitas) : ?>
                            <tr>
                                <td><?= $no++; ?></td>
                                <td><?= htmlspecialchars($legalitas['sertifikat']); ?></td>

                                <td>
                                    <a href="../../assets/pdf/legalitas/<?= htmlspecialchars(basename($legalitas['legalitas'])); ?>"
                                        class="btn btn-secondary btn-sm"
                                        download="<?= htmlspecialchars(basename($legalitas['legalitas'])); ?>">
                                        View
                                    </a>
                                    <a href="../legalitas/delete_legalitas.php?id=<?= htmlspecialchars($legalitas['id']); ?>"
                                        class="btn btn-danger btn-sm delete-button">Delete</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>


</article>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="../../bootstrap-5.3.3-dist/js/bootstrap.bundle.min.js"></script>
<script src="../../assets/js/scriptDashboard.js"></script>
<script>
    document.getElementById("legalitas-upload").addEventListener("change", function() {
        var fileName = this.files[0] ? this.files[0].name : "No File Chosen";
        document.querySelector(".file-name").textContent = fileName;
    });

    $(document).ready(function() {
        // Konfirmasi penghapusan menggunakan SweetAlert2
        $('body').on('click', '.delete-button', function(e) {
            e.preventDefault();

            var link = $(this).attr('href'); // Ambil URL penghapusan dari atribut href

            Swal.fire({
                title: 'Apakah Anda Yakin?',
                text: "Anda tidak akan dapat memulihkan item ini",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, tetap hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href =
                        link; // Redirect ke URL penghapusan jika dikonfirmasi
                }
            });
        });
    });
</script>



</body>

</html>