<?php session_start();
include '../../config/functions.php';

$admins = getAllData('admin');
$pesan_pengunjung = getAllData('pesan');

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, maximum-scale=1, minimum-scale=1">
    <title>PT Ghaffar Farm Bersaudara - Dashboard</title>
    <link rel="stylesheet" href="../../assets/css/dashboard.css">
    <link rel="stylesheet" href="../../bootstrap-5.3.3-dist/css/bootstrap.min.css">
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
                <?php
                ob_start(); // Mulai output buffering
                include 'HalamanDashboard.php';
                include 'HalamanTentang.php';
                include 'HalamanProduk.php';
                include 'HalamanLayanan.php';
                include 'HalamanLegalitas.php';
                include '../user/HalamanTambahAdmin.php';
                ob_end_flush(); // Akhiri output buffering dan kirim output ke browser
                ?>
            </div>
        </div>
    </article>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
<<<<<<< HEAD
        $(document).ready(function() {
            // Fungsi untuk menampilkan halaman yang dipilih dan menyembunyikan halaman lainnya
            function showPage(pageId) {
                // Sembunyikan semua halaman
                $('.content-page').hide();
                // Tampilkan halaman yang dipilih
                $(pageId).show();
                // Menghapus kelas 'active' dari semua elemen
                $('.menu-link').removeClass('active');
                // Menambahkan kelas 'active' ke tombol yang sesuai
                $('[data-target="' + pageId + '"]').addClass('active');
            }

            // Event handler untuk setiap tombol menu
            $('.menu-link').click(function(event) {
                event.preventDefault(); // Mencegah default link behaviour
                var pageId = $(this).data('target');
                showPage(pageId);
            });

            // Event handler untuk tombol "Tambah Admin"
            $('#tambah-admin-btn').click(function(event) {
                event.preventDefault(); // Mencegah default button behaviour
                var pageId = $(this).data('target');
                showPage(pageId);
            });

            // Menampilkan halaman default saat pertama kali dimuat
            var defaultPage = '#halaman-dashboard';
            var urlParams = new URLSearchParams(window.location.search);
            if (urlParams.has('page')) {
                defaultPage = '#' + urlParams.get('page');
            }
            showPage(defaultPage);

            // Menyimpan state halaman yang aktif sebelum halaman dimuat ulang
            window.addEventListener('beforeunload', function() {
                $('.menu-link').removeClass('active');
            });
        });
=======
    $(document).ready(function() {
        function showPage(pageId) {
            $('.content-page').hide();
            $(pageId).show();
            $('.menu-link').removeClass('active');
            $('[data-target="' + pageId + '"]').addClass('active');

            // Update URL
            var pageName = pageId.replace('#', '');
            var newUrl = window.location.protocol + "//" + window.location.host + window.location.pathname +
                '?page=' + pageName;
            history.pushState({
                path: newUrl
            }, '', newUrl);
        }

        $('.menu-link').click(function(event) {
            event.preventDefault();
            var pageId = $(this).data('target');
            showPage(pageId);
        });

        $('#tambah-admin-btn').click(function(event) {
            event.preventDefault();
            var pageId = $(this).data('target');
            showPage(pageId);
        });

        var defaultPage = '#halaman-dashboard';
        var urlParams = new URLSearchParams(window.location.search);
        if (urlParams.has('page')) {
            defaultPage = '#' + urlParams.get('page');
        }
        showPage(defaultPage);

        window.addEventListener('beforeunload', function() {
            $('.menu-link').removeClass('active');
        });
    });
>>>>>>> 0fcc3cc1c236e149726bde06e858496d30abd3eb
    </script>

    <script>
<<<<<<< HEAD
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

            // Event handler untuk tombol "Tambah Admin"
            $('#tambah-admin-btn').click(function(event) {
                event.preventDefault(); // Mencegah default button behaviour

                // Menghapus kelas 'active' dari semua elemen
                $('.menu-link').removeClass('active');

                // Menambahkan kelas 'active' ke elemen yang diklik
                $(this).addClass('active');

                // Panggil fungsi untuk mengganti teks h3
                updateH3Text('Tambah Admin');
            });

            // Perbarui teks h3 berdasarkan URL parameter
            var urlParams = new URLSearchParams(window.location.search);
            if (urlParams.has('page')) {
                const pageTitleMap = {
                    'halaman-tambah-admin': 'Tambah Admin',
                    'halaman-dashboard': 'Dashboard',
                    'halaman-tentang': 'Tentang',
                    'halaman-produk': 'Produk',
                    'halaman-layanan': 'Layanan',
                    'halaman-legalitas': 'Legalitas'
                };
                const pageKey = urlParams.get('page');
                updateH3Text(pageTitleMap[pageKey] || 'Dashboard');
            }
        });
=======
    $(document).ready(function() {
        function updateH3Text(newText) {
            $('#section-title').text(newText);
        }

        $('.menu-link').click(function(event) {
            event.preventDefault();
            $('.menu-link').removeClass('active');
            $(this).addClass('active');
            const newText = $(this).find('span').text();
            updateH3Text(newText);
        });

        $('#tambah-admin-btn').click(function(event) {
            event.preventDefault();
            $('.menu-link').removeClass('active');
            $(this).addClass('active');
            updateH3Text('Tambah Admin');
        });

        var urlParams = new URLSearchParams(window.location.search);
        if (urlParams.has('page')) {
            const pageTitleMap = {
                'halaman-tambah-admin': 'Tambah Admin',
                'halaman-dashboard': 'Dashboard',
                'halaman-tentang': 'Tentang',
                'halaman-produk': 'Produk',
                'halaman-layanan': 'Layanan',
                'halaman-legalitas': 'Legalitas'
            };
            const pageKey = urlParams.get('page');
            updateH3Text(pageTitleMap[pageKey] || 'Dashboard');
        }
    });
>>>>>>> 0fcc3cc1c236e149726bde06e858496d30abd3eb
    </script>

    <script src="../../assets/js/scriptDashboard.js"></script>
    <script src="../../bootstrap-5.3.3-dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>