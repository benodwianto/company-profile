<?php session_start();
$admins = getAllData('admin');
$pesan_pengunjung = getAllData('pesan');
$info_login = getAllData('pesan');
$data_admin = getAllAdminsWithLastLoginTime();
$adminData = getAdminDataBySessionId();
?>
<div class="content-page" id="halaman-dashboard">
    <h5 class="ms-4 mt-4">Informasi Admin</h5>
    <div class="card ms-4">
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
    <?php foreach ($pesan_pengunjung as $pesan) : ?>
        <div class="card ms-4">
            <div class="card-body">
                <div class="visitor-message">
                    <p><strong>Email:</strong> <?= $pesan['email'] ?></p>
                    <p><strong>Pesan:</strong> <?= $pesan['pesan_pengunjung'] ?></p>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>