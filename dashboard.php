<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, maximum-scale=1, minimum-scale=1">
    <title>PT Ghaffar Farm Bersaudara - Dashboard</title>
    <link rel="stylesheet" href="assets/css/dashboard.css">
    <link rel="stylesheet" href="bootstrap-5.3.3-dist/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.0/font/bootstrap-icons.min.css" rel="stylesheet">
</head>

<body>
    <?php include 'aside.php'; ?>
    <article class="contracted">
        <?php include 'nav.php'; ?>
        <div class="container mt-5">
            <!-- Content Div -->
            <div class="content">
                <?php include 'HalamanDashboard.php';
                include 'HalamanTentang.php';
                include 'HalamanProduk.php';
                include 'HalamanLayanan.php';
                include 'HalamanLegalitas.php';
                include 'HalamanTambahAdmin.php';
                ?>
                <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                <script>
                    $(document).ready(function() {
                        $('.menu-link').click(function() {
                            // Menghapus kelas 'active' dari semua elemen
                            $('.menu-link').removeClass('active');
                            // Menambahkan kelas 'active' ke elemen yang diklik
                            $(this).addClass('active');
                        });

                        $('#tambah-admin-btn').click(function() {
                            $('#halaman-tambah-admin').show(); // Menampilkan halaman tambah admin
                            $('#halaman-dashboard').hide(); // Menyembunyikan halaman dashboard
                            $('#halaman-tentang').hide();
                            // Menghapus kelas 'active' dari semua elemen
                            $('.menu-link').removeClass('active');
                            // Menambahkan kelas 'active' ke tombol tambah admin
                            $(this).addClass('active');
                        });

                        $('#Dashboard-btn').click(function() {
                            $('#halaman-dashboard').show(); // Menampilkan halaman dashboard
                            $('#halaman-tambah-admin').hide();
                            $('#halaman-tentang').hide();
                            $('#halaman-produk').hide();
                            $('#halaman-layanan').hide();
                            $('#halaman-legalitas').hide();
                            // Menghapus kelas 'active' dari semua elemen
                            $('.menu-link').removeClass('active');
                            // Menambahkan kelas 'active' ke tombol dashboard
                            $(this).addClass('active');
                        });

                        $('#Tentang-btn').click(function() {
                            $('#halaman-dashboard').hide(); // Menampilkan halaman dashboard
                            $('#halaman-tambah-admin').hide(); // Menyembunyikan halaman tambah admin
                            $('#halaman-tentang').show();
                            $('#halaman-produk').hide();
                            $('#halaman-layanan').hide();
                            $('#halaman-legalitas').hide(); // Menyembunyikan halaman tambah admin
                            // Menghapus kelas 'active' dari semua elemen
                            $('.menu-link').removeClass('active');
                            // Menambahkan kelas 'active' ke tombol dashboard
                            $(this).addClass('active');
                        });

                        $('#Produk-btn').click(function() {
                            $('#halaman-dashboard').hide(); // Menampilkan halaman dashboard
                            $('#halaman-tambah-admin').hide(); // Menyembunyikan halaman tambah admin
                            $('#halaman-tentang').hide();
                            $('#halaman-produk').show();
                            $('#halaman-layanan').hide();
                            $('#halaman-legalitas').hide(); // Menyembunyikan halaman tambah admin
                            // Menghapus kelas 'active' dari semua elemen
                            $('.menu-link').removeClass('active');
                            // Menambahkan kelas 'active' ke tombol dashboard
                            $(this).addClass('active');
                        });

                        $('#Layanan-btn').click(function() {
                            $('#halaman-dashboard').hide(); // Menampilkan halaman dashboard
                            $('#halaman-tambah-admin').hide(); // Menyembunyikan halaman tambah admin
                            $('#halaman-tentang').hide();
                            $('#halaman-produk').hide();
                            $('#halaman-layanan').show();
                            $('#halaman-legalitas').hide(); // Menyembunyikan halaman tambah admin
                            // Menghapus kelas 'active' dari semua elemen
                            $('.menu-link').removeClass('active');
                            // Menambahkan kelas 'active' ke tombol dashboard
                            $(this).addClass('active');
                        });

                        $('#Legalitas-btn').click(function() {
                            $('#halaman-dashboard').hide(); // Menampilkan halaman dashboard
                            $('#halaman-tambah-admin').hide(); // Menyembunyikan halaman tambah admin
                            $('#halaman-tentang').hide();
                            $('#halaman-produk').hide();
                            $('#halaman-layanan').hide();
                            $('#halaman-legalitas').show(); // Menyembunyikan halaman tambah admin
                            // Menghapus kelas 'active' dari semua elemen
                            $('.menu-link').removeClass('active');
                            // Menambahkan kelas 'active' ke tombol dashboard
                            $(this).addClass('active');
                        });

                        window.addEventListener('beforeunload', function() {
                            $('.menu-link').removeClass('active');
                        });
                    });
                </script>
                <script>
                    $(document).ready(function() {
                        // Fungsi untuk mengganti teks h3
                        function updateH3Text(newText) {
                            $('#section-title').text(newText);
                        }

                        // Ketika menu-link diklik
                        $('.menu-link').click(function(event) {
                            event.preventDefault(); // Mencegah default link behaviour

                            // Menghapus kelas 'active' dari semua elemen
                            $('.menu-link').removeClass('active');

                            // Menambahkan kelas 'active' ke elemen yang diklik
                            $(this).addClass('active');

                            // Ambil teks dari span dalam elemen yang diklik
                            const newText = $(this).find('span').text();

                            // Panggil fungsi untuk mengganti teks h3
                            updateH3Text(newText);
                        });
                    });
                </script>

            </div>
        </div>
    </article>

    <script src="assets/js/scriptDashboard.js"></script>
    <script src="bootstrap-5.3.3-dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>