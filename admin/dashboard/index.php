<?php 
include '../../config/functions.php'

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, maximum-scale=1, minimum-scale=1">
    <title>PT Ghaffar Farm Bersaudara - Dashboard</title>
    <link rel="stylesheet" href="../../assets/css/dashboard.css">
    <link rel="stylesheet" href="../../bootstrap-5.3.3-dist/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.0/font/bootstrap-icons.min.css"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">


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
                    include '../produk/HalamanProduk.php'; // Pastikan ini sudah benar
                    include 'HalamanLayanan.php';
                    include 'HalamanLegalitas.php';
                    include '../user/HalamanTambahAdmin.php';
                    // include '../legalitas/add_legalitas.php';
                  
                    ob_end_flush(); // Akhiri output buffering dan kirim output ke browser
                ?>
            </div>
        </div>
    </article>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
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
    </script>

    <script>
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
                // 'halaman-add-legalitas': 'InsertLegalitas'
            };
            const pageKey = urlParams.get('page');
            updateH3Text(pageTitleMap[pageKey] || 'Dashboard');
        }
    });

    $(document).ready(function() {
        $('#inputGambar').on('change', function() {
            var fileName = $(this).val().split('\\').pop();
            if (fileName) {
                $('#fileInfo').text(fileName);
            } else {
                $('#fileInfo').text('No file chosen');
            }

            // Preview the image
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#preview').attr('src', e.target.result);
            }
            reader.readAsDataURL(this.files[0]);
        });
    });
    </script>

    <script src="../../assets/js/scriptDashboard.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="../../bootstrap-5.3.3-dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>