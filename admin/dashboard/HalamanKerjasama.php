<?php
include '../../config/functions.php';
session_start();

if (!isset($_SESSION['admin_id']) || !isset($_SESSION['status'])) {
    header("Location: ../login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, maximum-scale=1, minimum-scale=1">
    <title>PT Ghaffar Farm Bersaudara - Dashboard</title>
    <link rel="stylesheet" href="../../assets/css/dashboard.css">
    <link rel="stylesheet" href="../../bootstrap-5.3.3-dist/css/bootstrap.min.css">
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.0/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

</head>

<body>
    <?php include 'aside.php'; ?>
    <article class="contracted">
        <?php include 'nav.php'; ?>
        <div class="container mt-2">
            <div class="content">
                <div class="content-page" id="halaman-kontak">
                    <h5 class="card-title ms-4 mb-4">Data Kerjasama</h5>
                    <div class="card ms-4 shadow-lg">
                        <div class="card-header">

                            <!-- Button to open modal for adding new data -->
                            <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal"
                                data-bs-target="#addKerjasamaModal">
                                Tambah Kerjasama
                            </button>

                            <!-- Data table -->
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Judul</th>
                                        <th>Deskripsi</th>
                                        <th>Foto</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                    $sql = getAllData('kerjasama');
                    foreach ($sql as $row) { ?>
                                    <tr>
                                        <td><?= htmlspecialchars($row['judul']) ?></td>
                                        <td><?= htmlspecialchars($row['deskripsi']) ?></td>
                                        <td>
                                            <img src="../../assets/images/Kerjasama/<?= htmlspecialchars(basename($row['foto'])) ?>"
                                                alt="Foto" width="100" class="img-thumbnail">
                                        </td>
                                        <td>
                                            <!-- Button to open modal for editing data -->
                                            <button class="btn btn-warning btn-sm" data-bs-toggle="modal"
                                                data-bs-target="#editKerjasamaModal<?= $row['id'] ?>">Edit</button>

                                            <!-- Delete link -->
                                            <a href="../kerja_sama/delete.php?id=<?= htmlspecialchars($row['id']); ?>"
                                                class="btn btn-danger btn-sm"
                                                onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Delete</a>
                                        </td>
                                    </tr>

                                    <!-- Modal for editing data -->
                                    <div class="modal fade" id="editKerjasamaModal<?= $row['id'] ?>" tabindex="-1"
                                        aria-labelledby="editKerjasamaModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <form action="../kerja_sama/update.php" method="POST"
                                                    enctype="multipart/form-data">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="editKerjasamaModalLabel">Edit
                                                            Kerjasama</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <input type="hidden" name="id" value="<?= $row['id'] ?>">
                                                        <div class="mb-3">
                                                            <label for="judul" class="form-label">Judul</label>
                                                            <input type="text" class="form-control" name="judul"
                                                                id="judul"
                                                                value="<?= htmlspecialchars($row['judul']) ?>" required>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="deskripsi" class="form-label">Deskripsi</label>
                                                            <textarea class="form-control" name="deskripsi"
                                                                id="deskripsi"
                                                                rows="3"><?= htmlspecialchars($row['deskripsi']) ?></textarea>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="foto" class="form-label">Foto (Opsional)</label>
                                                            <input type="file" class="form-control" name="foto"
                                                                id="foto">
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Batal</button>
                                                        <button type="submit" class="btn btn-primary">Simpan
                                                            Perubahan</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <?php }; ?>
                                </tbody>
                            </table>
                        </div>

                        <!-- Modal for adding new data -->
                        <div class="modal fade" id="addKerjasamaModal" tabindex="-1"
                            aria-labelledby="addKerjasamaModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <form action="../kerja_sama/create.php" method="POST" enctype="multipart/form-data">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="addKerjasamaModalLabel">Tambah Kerjasama</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="mb-3">
                                                <label for="judul" class="form-label">Judul</label>
                                                <input type="text" class="form-control" name="judul" id="judul"
                                                    placeholder="Masukkan judul kerjasama" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="deskripsi" class="form-label">Deskripsi</label>
                                                <textarea class="form-control" name="deskripsi" id="deskripsi" rows="3"
                                                    placeholder="Masukkan deskripsi kerjasama"></textarea>
                                            </div>
                                            <div class="mb-3">
                                                <label for="foto" class="form-label">Foto</label>
                                                <input type="file" class="form-control" name="foto" id="foto" required>
                                                <small class="form-text text-muted">Pilih file foto untuk
                                                    diunggah.</small>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Batal</button>
                                            <button type="submit" class="btn btn-primary">Simpan</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
    </article>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="../../assets/js/scriptDashboard.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="../../bootstrap-5.3.3-dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>