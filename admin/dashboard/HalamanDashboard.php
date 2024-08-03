<?php 
session_start();




$admins = getAllData('admin');
$pesan_pengunjung = getAllData('pesan');
$info_login = getAllData('pesan');
$data_admin = getAllAdminsWithLastLoginTime();
$adminData = getAdminDataBySessionId();
?>
<div class="content-page" id="halaman-dashboard">
    <h5 class="ms-4 mt-4">Informasi Admin</h5>
    <div class="card ms-4 shadow-sm">
        <div class="card-body">
            <h5 class="card-title">Profile</h5>
            <div class="admin-info">
                <img src="../../assets/images/logo.jpg" alt="Admin Photo" class="profile-img" width="100" height="100">
                <p><strong>Username:</strong> <?= $adminData['username'] ?></p>
                <p><strong>Status:</strong> <?= $adminData['status'] ?></p>
            </div>
            <?php if ($_SESSION['status'] === 'Admin') : ?>
            <h5 class="mt-4">Daftar Admin</h5>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Username</th>
                        <th>Terakhir Login</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($data_admin as $admin) : ?>
                    <tr>
                        <td><?= $admin['username'] ?></td>
                        <td><i class=""></i> <?= timeAgo($admin['lastLoginTime']) ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <?php endif; ?>

        </div>
    </div>
    <!-- Card Baru untuk Pesan Pengunjung -->
    <h5 class="ms-4 mt-4">Pesan Pengunjung</h5>

    <!-- Filter berdasarkan tanggal dan pencarian pesan -->
    <!-- Form Pencarian Pesan -->
    <div class="ms-4 mb-4">
        <form action="" method="get" class="d-flex align-items-center">
            <div class="input-group me-2">
                <span class="input-group-text"><i class="fas fa-search"></i></span>
                <input type="text" name="search" class="form-control" placeholder="Cari pesan...">
            </div>
            <button type="submit" class="btn btn-primary">Cari</button>
        </form>
    </div>

    <!-- Form Filter Berdasarkan Tanggal -->
    <div class="ms-4 mb-4">
        <form action="" method="get" class="d-flex align-items-center">
            <div class="input-group me-2">
                <span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
                <input type="date" name="date" class="form-control">
            </div>
            <button type="submit" class="btn btn-primary">Filter</button>
        </form>
    </div>


    <?php foreach ($pesan_pengunjung as $pesan) : ?>
    <div class="card ms-4 m-4 shadow-sm border-0 rounded-3">
        <div class="card-body">
            <div
                class="visitor-message d-flex justify-content-between align-items-center border p-3 rounded-3 bg-light">
                <div class="message-content">
                    <p class="mb-1"><strong>Email:</strong> <?= htmlspecialchars($pesan['email']) ?></p>
                    <p class="mb-0"><strong>Pesan:</strong> <?= htmlspecialchars($pesan['pesan_pengunjung']) ?></p>
                </div>
                <div class="message-time text-muted fs-6">
                    20.18 Senin 29 Agustus
                </div>
            </div>
        </div>
    </div>
    <?php endforeach; ?>


</div>