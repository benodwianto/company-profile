<?php
session_start();
include '../../config/functions.php';

// Cek apakah admin sudah login
if (!isset($_SESSION['admin_id'])) {
    // Jika belum login, arahkan ke halaman login
    header("Location: ../login.php");
    exit();
}

// Cek apakah admin memiliki status yang sesuai
if ($_SESSION['status'] != 'Admin') {
    // Jika status bukan admin, arahkan ke halaman dashboard atau halaman lain
    header("Location: index.php");
    exit();
}
$admins = getAllData('admin');
$pesan_pengunjung = getAllData('pesan');
$info_login = getAllData('pesan');
$data_admin = getAllAdminsWithLastLoginTime();
$adminData = getAdminDataBySessionId();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = filter_input(INPUT_POST, 'username');
    $password = filter_input(INPUT_POST, 'password');
    $petugas = 'petugas';

    if ($username && $password) {
        // Proses insert data
        $resultMessage = insertAdmin($username, $password, $petugas);

        // Redirect dengan parameter query string yang divalidasi
        header("Location: HalamanTambahAdmin.php");
        exit();
    }
}

?>

<!-- Form Input -->
<?php include 'aside.php'; ?>
<article class="contracted">
    <?php include 'nav.php'; ?>
    <div class="container mt-5">
        <div class="content">
            <div class="content-page content-input-admin" id="halaman-tambah-admin">
                <h5>Form Input Admin Baru</h5>
                <?php if (isset($resultMessage)) : ?>
                <p><?= htmlspecialchars($resultMessage); ?></p>
                <?php endif; ?>
                <form action="" method="post">
                    <div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <div class="col-md-6">
                            <input type="text" class="form-control" id="username" name="username"
                                placeholder="Masukkan username" required>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <div class="col-md-6">
                            <input type="password" class="form-control" id="password" name="password"
                                placeholder="Masukkan password" required>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary" value="Add Admin">Tambah</button>
                </form>

                <!-- Tabel -->
                <div class="mt-5">
                    <h5>Daftar Pengguna</h5>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Username</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($admins as $index => $admin) : ?>
                            <tr>
                                <td><?= $index + 1; ?></td>
                                <td><?= htmlspecialchars($admin['username']); ?></td>
                                <td><a href="../user/delete_admin.php?id=<?= $admin['id']; ?>"><i
                                            class="bi bi-trash"></i></a>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</article>