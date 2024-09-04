<?php
session_start();
include '../../config/functions.php';

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kerjasama</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <h2 class="mb-4">Data Kerjasama</h2>

        <!-- Button to open modal for adding new data -->
        <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#addKerjasamaModal">
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
                            <img src="../../assets/images/kerjasama/<?= htmlspecialchars(basename($row['foto'])) ?>" alt="Foto"
                                width="100">
                        </td>
                        <td>
                            <!-- Button to open modal for editing data -->
                            <button class="btn btn-warning btn-sm" data-bs-toggle="modal"
                                data-bs-target="#editKerjasamaModal<?= $row['id'] ?>">Edit</button>

                            <!-- Delete link -->
                            <a href="delete.php?id=<?= htmlspecialchars($row['id']); ?>"
                                class="btn btn-danger btn-sm"
                                onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Delete</a>
                        </td>
                    </tr>

                    <!-- Modal for editing data -->
                    <div class="modal fade" id="editKerjasamaModal<?= $row['id'] ?>" tabindex="-1"
                        aria-labelledby="editKerjasamaModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <form action="update.php" method="POST"
                                    enctype="multipart/form-data">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="editKerjasamaModalLabel">Edit Kerjasama</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <input type="hidden" name="id" value="<?= $row['id'] ?>">
                                        <div class="mb-3">
                                            <label for="judul" class="form-label">Judul</label>
                                            <input type="text" class="form-control" name="judul" id="judul"
                                                value="<?= htmlspecialchars($row['judul']) ?>" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="deskripsi" class="form-label">Deskripsi</label>
                                            <textarea class="form-control" name="deskripsi" id="deskripsi"
                                                rows="3"><?= htmlspecialchars($row['deskripsi']) ?></textarea>
                                        </div>
                                        <div class="mb-3">
                                            <label for="foto" class="form-label">Foto (Opsional)</label>
                                            <input type="file" class="form-control" name="foto" id="foto">
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
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
    <div class="modal fade" id="addKerjasamaModal" tabindex="-1" aria-labelledby="addKerjasamaModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="create.php" method="POST" enctype="multipart/form-data">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addKerjasamaModalLabel">Tambah Kerjasama</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="judul" class="form-label">Judul</label>
                            <input type="text" class="form-control" name="judul" id="judul" required>
                        </div>
                        <div class="mb-3">
                            <label for="deskripsi" class="form-label">Deskripsi</label>
                            <textarea class="form-control" name="deskripsi" id="deskripsi" rows="3"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="foto" class="form-label">Foto</label>
                            <input type="file" class="form-control" name="foto" id="foto" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>