<?php
session_start();
include '../../config/functions.php';

if (!isset($_SESSION['admin_id'])) {
    // Jika belum login, arahkan ke halaman login
    header("Location: ../login.php");
    exit();
}

$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$recordsPerPage = 6;

$startDate = isset($_GET['start_date']) ? $_GET['start_date'] : null;
$endDate = isset($_GET['end_date']) ? $_GET['end_date'] : null;

$data = getDataWithPagination($page, $recordsPerPage, $startDate, $endDate);
$totalPages = getTotalPages($recordsPerPage, $startDate, $endDate);

$admins = getAllData('admin');
$info_login = getAllData('pesan');
$data_admin = getAllAdminsWithLastLoginTime();
$adminData = getAdminDataBySessionId();

include 'aside.php'; ?>
<article class="contracted">
    <?php include 'nav.php'; ?>
    <div class="container ml-0">
        <div class="content">
            <div class="content-page" id="halaman-dashboard">
                <h5 class="ms-4 mt-2">Informasi Admin</h5>
                <div class="card ms-4 shadow-lg">
                    <div class="card-body d-flex ">
                        <div class="card shadow-sm col-lg-3" style="background-color: #951C11;">
                            <!-- Menggunakan mx-auto untuk memposisikan kolom di tengah -->
                            <h5 class="card-title text-center mt-4 text-light">Profile</h5>
                            <div class="admin-info text-center p-2 text-light">
                                <img src="../../assets/images/profile.png" alt="Admin Photo" class="profile-img"
                                    width="70" height="100">
                                <p>Username <span>:</span>
                                    <strong> <?= htmlspecialchars($adminData['username']) ?>
                                </p></strong>
                                <p>Status<span>:</span> <strong><?= htmlspecialchars($adminData['status']) ?></strong>
                                </p>
                            </div>
                        </div>
                        <?php if ($_SESSION['status'] === 'Admin') : ?>
                            <div class="tebel ms-4 col-6">
                                <h6 class="mt-4 ms-1 font-bold opacity-50">Daftar Admin</h6>
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Username</th>
                                            <th>Terakhir Login</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        foreach ($data_admin as $admin) : ?>
                                            <tr>
                                                <td><?= htmlspecialchars($admin['username']) ?></td>
                                                <td><i class=""></i> <?= timeAgo($admin['lastLoginTime']) ?></td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            <?php endif; ?>
                            </div>
                    </div>
                </div>
                <!-- Card Baru untuk Pesan Pengunjung -->
                <h5 class="ms-4 mt-5">Pesan Pengunjung</h5>

                <!-- Form Filter Berdasarkan Tanggal -->
                <div class="ms-4 mb-4">
                    <form action="" method="get" class="d-flex align-items-center w-50">
                        <div class="input-group me-2">
                            <span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
                            <input type="date" name="start_date" value="<?php echo isset($_GET['start_date']) ? $_GET['start_date'] : ''; ?>" class="form-control">
                            <input type="date" name="end_date" value="<?php echo isset($_GET['end_date']) ? $_GET['end_date'] : ''; ?>" class="form-control ms-2">
                        </div>
                        <button type="submit" class="btn btn-primary">Filter</button>
                    </form>
                </div>

                <div class="card ms-4 m-4 shadow-sm border-0 rounded-3">
                    <div class="card-body">
                        <?php if (empty($data)) : ?>
                            <div class="alert alert-info" role="alert">
                                Tidak ada pesan yang ditemukan untuk tanggal yang dipilih.
                            </div>
                        <?php else : ?>
                            <?php foreach ($data as $pesan) : ?>
                                <div
                                    class="visitor-message d-flex justify-content-between align-items-center border p-3 rounded-3 bg-light">
                                    <div class="message-content">
                                        <p class="mb-1"><strong>Email:</strong> <?= htmlspecialchars($pesan['email']) ?></p>
                                        <p class="mb-0"><strong>Pesan:</strong>
                                            <?= htmlspecialchars($pesan['pesan_pengunjung']) ?></p>
                                    </div>
                                    <div class="message-time text-muted fs-6">
                                        <?= timeAgo($pesan['tanggal']) ?>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                </div>
                <!-- Menampilkan pagination -->
                <div class="pagination mt-4 mb-4 d-flex">
                    <p class="m-10">Page</p>
                    <?= generatePaginationLinks($page, $totalPages); ?>
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