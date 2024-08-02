<?php session_start(); 
$admins = getAllData('admin');
$pesan_pengunjung = getAllData('pesan'); 
?>
<div class="content-page" id="halaman-dashboard">
    <h5 class="ms-4 mt-4">Informasi Admin</h5>
    <div class="card ms-4 shadow-sm">
        <div class="card-body">
            <h5 class="card-title">Profile</h5>
            <div class="admin-info">
                <img src="../../assets/images/logo.jpg" alt="Admin Photo" class="profile-img" width="100" height="100">
                <p><strong>Username:</strong> admin_username</p>
                <p><strong>Status:</strong> Super Admin</p>
            </div>
            <h5 class="mt-4">Daftar Admin</h5>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Username</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($admins as $admin) : ?>
                    <tr>
                        <td><?= $admin['username'] ?></td>
                        <td><i class="bi bi-circle-fill status-online"></i> Online</td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
    <!-- Card Baru untuk Pesan Pengunjung -->
    <h5 class="ms-4 mt-4">Pesan Pengunjung</h5>
    <?php foreach ($pesan_pengunjung as $pesan) : ?>
    <div class="card ms-4 m-3">
        <div class="card-body">
            <div class="visitor-message">
                <p><strong>Email:</strong> <?= $pesan['email'] ?></p>
                <p><strong>Pesan:</strong> <?= $pesan['pesan_pengunjung'] ?></p>
            </div>
        </div>
    </div>
    <?php endforeach; ?>
</div>