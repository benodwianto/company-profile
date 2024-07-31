<?php
ob_start(); // Mulai output buffering

include '../../config/functions.php'; // Meng-include file fungsi

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
    $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);

    if ($username && $password) {
        // Proses insert data
        $resultMessage = insertAdmin($username, $password);

        // Redirect dengan parameter query string yang divalidasi
        header("Location: {$_SERVER['PHP_SELF']}?page=halaman-tambah-admin&status=success");
        exit();
    } else {
        $resultMessage = "Invalid input!";
    }
}
?>
<!-- Form Input -->
<div class="content-page content-input-admin" id="halaman-tambah-admin">
    <h2>Form Input Admin Baru</h2>
    <?php if (isset($resultMessage)) : ?>
    <p><?= htmlspecialchars($resultMessage); ?></p>
    <?php endif; ?>
    <form action="" method="post">
        <div class="mb-3">
            <label for="username" class="form-label">Username</label>
            <div class="col-md-6">
                <input type="text" class="form-control" id="username" name="username" placeholder="Masukkan username">
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
                <tr>
                    <td>1</td>
                    <td>user1</td>
                    <td><i class="bi bi-trash"></i></td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>user2</td>
                    <td><a href="#"><i class="bi bi-trash"></i></a></td>
                </tr>
                <!-- Tambahkan lebih banyak baris sesuai kebutuhan -->
            </tbody>
        </table>
    </div>
</div>

<?php
ob_end_flush(); // Akhiri output buffering dan kirim output ke browser
?>