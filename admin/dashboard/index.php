<?php 
include '../../config/functions.php';

session_start();

$admins = getAllData('admin');
$pesan_pengunjung = getAllData('pesan');
$info_login = getAllData('pesan');
$data_admin = getAllAdminsWithLastLoginTime();
$adminData = getAdminDataBySessionId();

?>


<?php include 'aside.php'; ?>
<article class="contracted">
    <?php include 'nav.php'; ?>
    <div class="container mt-5">
        <div class="content">

            <div class="content-page" id="halaman-dashboard">
                <h5 class="ms-4 mt-4">Informasi Admin</h5>
                <div class="card ms-4 shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">Profile</h5>
                        <div class="admin-info">
                            <img src="../../assets/images/logo.jpg" alt="Admin Photo" class="profile-img" width="100"
                                height="100">
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
                                <p class="mb-0"><strong>Pesan:</strong>
                                    <?= htmlspecialchars($pesan['pesan_pengunjung']) ?></p>
                            </div>
                            <div class="message-time text-muted fs-6">
                                20.18 Senin 29 Agustus
                            </div>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>


            </div>
        </div>
    </div>
</article>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="../../assets/js/scriptDashboard.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="../../bootstrap-5.3.3-dist/js/bootstrap.bundle.min.js"></script>

<script>
// $(document).ready(function() {
//     function tampilkanHalaman(pageId) {
//         $('.content-page').hide();
//         $(pageId).show();
//         $('.menu-link').removeClass('active');
//         $('[data-target="' + pageId + '"]').addClass('active');
//         var pageName = pageId.replace('#', '');
//         var newUrl = window.location.protocol + "//" + window.location.host + window.location.pathname +
//             '?page=' + pageName;
//         history.pushState({
//             path: newUrl
//         }, '', newUrl);
//     }

//     $('.menu-link').click(function(event) {
//         event.preventDefault();
//         var pageId = $(this).data('target');
//         tampilkanHalaman(pageId);
//     });

//     $('#tambah-admin-btn').click(function(event) {
//         event.preventDefault();
//         var pageId = $(this).data('target');
//         tampilkanHalaman(pageId);
//     });

//     var halamanDefault = '#halaman-dashboard';
//     var urlParams = new URLSearchParams(window.location.search);
//     if (urlParams.has('page')) {
//         halamanDefault = '#' + urlParams.get('page');
//     }
//     tampilkanHalaman(halamanDefault);

//     window.addEventListener('beforeunload', function() {
//         $('.menu-link').removeClass('active');
//     });

// function updateJudul(newText) {
//     $('#section-title').text(newText);
// }

// $('.menu-link').click(function(event) {
//     event.preventDefault();
//     $('.menu-link').removeClass('active');
//     $(this).addClass('active');
//     const newText = $(this).find('span').text();
//     updateJudul(newText);
// });

//     $('#tambah-admin-btn').click(function(event) {
//         event.preventDefault();
//         $('.menu-link').removeClass('active');
//         $(this).addClass('active');
//         updateJudul('Tambah Admin');
//     });

//     if (urlParams.has('page')) {
//         const judulHalaman = {
//             'halaman-tambah-admin': 'Tambah Admin',
//             'halaman-dashboard': 'Dashboard',
//             'halaman-tentang': 'Tentang',
//             'halaman-produk': 'Produk',
//             'halaman-layanan': 'Layanan',
//             'halaman-legalitas': 'Legalitas',
//             'halaman-kontak': 'Kontak',
//         };
//         const pageKey = urlParams.get('page');
//         updateJudul(judulHalaman[pageKey] || 'Dashboard');
//     }

//     $('#inputGambar').on('change', function() {
//         var fileName = $(this).val().split('\\').pop();
//         $('#fileInfo').text(fileName ? fileName : 'No file chosen');
//         var reader = new FileReader();
//         reader.onload = function(e) {
//             $('#preview').attr('src', e.target.result);
//         }
//         reader.readAsDataURL(this.files[0]);
//     });
// });
</script>
</body>

</html>