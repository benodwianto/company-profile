<?php
include '../../config/functions.php';

session_start();

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
        header("Location: {$_SERVER['PHP_SELF']}?page=halaman-tambah-admin&status=success");
        exit();
    } else {
        $resultMessage = "Invalid input!";
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
                <h2>Form Input Admin Baru</h2>
                <?php if (isset($resultMessage)) : ?>
                <p><?= htmlspecialchars($resultMessage); ?></p>
                <?php endif; ?>
                <form action="" method="post">
                    <div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <div class="col-md-6">
                            <input type="text" class="form-control" id="username" name="username"
                                placeholder="Masukkan username">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <div class="col-md-6">
                            <input type="password" class="form-control" id="password" name="password"
                                placeholder="Masukkan password">
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary" value="Add Admin">Tambah</button>
                </form>

                <!-- Tabel -->
                <div class="mt-5">
                    <h2>Daftar Pengguna</h2>
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
                                <td><a href="delete_admin.php?id=<?= $admin['id']; ?>"><i class="bi bi-trash"></i></a>
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