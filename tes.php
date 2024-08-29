<?php
session_start();
include 'config/functions.php'; 

?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, maximum-scale=1, minimum-scale=1">
    <title>CV Ghaffar Farm Bersaudara - Baru setiap hari</title>
    <meta name="description"
        content="CV Ghaffar Farm Bersaudara adalah perusahaan yang bergerak dalam penggemukan sapi dan pemasok daging untuk kebutuhan hotel, restoran, swalayan, dan lainnya. Kami menyediakan sapi qurban berkualitas super.">
    <meta name="keywords"
        content="CV Ghaffar Farm Bersaudara, penggemukan sapi, pemasok daging, sapi qurban, daging sapi lokal">
    <meta name="author" content="CV Ghaffar Farm Bersaudara">
    <link rel="canonical" href="https://www.ghaffarfarm.com/">
    <link rel="stylesheet" href="assets/css/tes.css?v=1.0.1">
    <link rel="stylesheet" href="bootstrap-5.3.3-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css">
    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css">
    <!-- Tambahkan ini di dalam tag <head> di file HTML kamu -->
    <link href="https://fonts.googleapis.com/css2?family=Merriweather:wght@400;700&display=swap" rel="stylesheet">



</head>

<body>
    <!-- loader -->
    <div class="overlay" id="overlay">
        <div class="loadingspinner m-auto align-items-center" id="loader">
            <div id="square1"></div>
            <div id="square2"></div>
            <div id="square3"></div>
            <div id="square4"></div>
            <div id="square5"></div>
        </div>
    </div>
    <!-- ini bagian konten header -->

    <div id="content">
        <div class="jumbotron">
            <div id="jumbotronCarousel" class="carousel slide" data-bs-ride="carousel" data-bs-interval="5000"
                data-bs-wrap="true">
                <!-- Indicators (Optional) -->
                <ol class="carousel-indicators">
                    <li data-bs-target="#jumbotronCarousel" data-bs-slide-to="0" class="active"></li>
                    <li data-bs-target="#jumbotronCarousel" data-bs-slide-to="1"></li>
                    <li data-bs-target="#jumbotronCarousel" data-bs-slide-to="2"></li>
                    <li data-bs-target="#jumbotronCarousel" data-bs-slide-to="3"></li>
                </ol>

                <!-- Carousel Inner -->
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img src="assets/images/farm/1 (1).jpeg" class="d-block w-100" alt="Gambar 1">
                    </div>
                    <div class="carousel-item">
                        <img src="assets/images/farm/1 (2).jpeg" class="d-block w-100" alt="Gambar 2">
                    </div>
                    <div class="carousel-item">
                        <img src="assets/images/farm/1 (3).jpeg" class="d-block w-100" alt="Gambar 3">
                    </div>
                    <div class="carousel-item">
                        <img src="assets/images/farm/1 (4).jpeg" class="d-block w-100" alt="Gambar 4">
                    </div>

                </div>

                <!-- Controls (Optional) -->
                <a class="carousel-control-prev" href="#jumbotronCarousel" role="button" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </a>
                <a class="carousel-control-next" href="#jumbotronCarousel" role="button" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </a>
            </div>

            <!-- Jumbotron Content -->
            <div class="jumbotron-content d-flex flex-column justify-content-start align-items-center align-items-sm-start justify-content-sm-center p-1"
                id="header">
                <h1>CV Ghaffar Farm Bersaudara</h1>
                <p>BARU SETIAP HARI</p>
                <p>
                    <?php
    $dataHome = getAllData('home');
    foreach ($dataHome as $home) : ?>
                    <?= nl2br(htmlspecialchars($home['deskripsi_dashboard'])); ?>
                    <?php endforeach; ?>
                </p>
                <button class="btn-jumbotron"><a href="#produk-kami">Lihat Produk</a></button>
            </div>

        </div>

        <nav class="navbar navbar-expand-lg sticky-top">
            <a class="navbar-brand" href="#">
                <img src="assets/images/logo.jpg" alt="Logo CV Ghaffar Farm Bersaudara" class="logo" />
                <span class="nav-text">CV. Ghaffar Farm Bersaudara</span>
            </a>
            <button class="navbar-toggler  navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-ikon" role="button">
                    <i class="fa fa-bars light-icon" aria-hidden="true"></i>
                    <i class="fa fa-times dark-icon d-none"></i>
                </span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">

                <ul class="navbar-nav m-auto">
                    <li class="nav-item"><a class="nav-link" href="#header">Home</a></li>
                    <li class="nav-item dropdown">
                        <a class="nav-link" href="#tentang-kami" onclick="toggleDropdown(event)">
                            Tentang Kami <span class="dropdown-icon">&#10095;</span>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#tentang-kami">Tentang Kami</a></li>
                            <li><a class="dropdown-item" href="#visi-misi">Visi & Misi</a></li>

                        </ul>
                    </li>
                    <li class="nav-item"><a class="nav-link" href="#produk-kami">Produk</a></li>
                    <li class="nav-item"><a class="nav-link" href="#layanan">Layanan</a></li>
                    <li class="nav-item"><a class="nav-link" href="#legalitas">Legalitas</a></li>
                    <li class="nav-item"><a class="nav-link" href="#footer">Hubungi Kami</a></li>
                </ul>


            </div>
        </nav>

        <main>
            <section class="tentangkami active" id="tentang-kami"><br>
                <h2 class="hello p-1">Tentang Kami<span class="line tentangkamii"></span></h2><br>
                <div class="container-fluid px-4">
                    <div class="row align-items-stretch">
                        <div class="col-lg-6 mb-4 mb-lg-0">
                            <div class="h-100 position-relative overflow-hidden">
                                <?php
                    $dataTentangKami = getAllData('tentang');
                    foreach ($dataTentangKami as $tentang_kami) : ?>
                                <img src="assets/images/tentang/<?= htmlspecialchars(basename($tentang_kami['foto'])); ?>"
                                    class="img-fluid w-100 h-100 object-fit-cover" alt="CV Ghaffar Farm Bersaudara"
                                    style="object-position: center;">
                                <?php endforeach; ?>
                                <div class="position-absolute top-0 start-0 w-100 h-100 bg-dark opacity-50"></div>
                                <div
                                    class="position-absolute top-0 start-0 w-100 h-100 d-flex flex-column justify-content-center align-items-center text-white text-center p-4">
                                    <h4 class="h2 mb-3">CV Ghaffar Farm Bersaudara</h4>
                                    <p class="mb-0">Keunggulan dalam Peternakan</p>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="bg-light h-100 p-4 p-lg-5">
                                <h3 class="mb-4" style="color: #951c11;">Selamat Datang..</h3>
                                <p class="lead">
                                    <?= nl2br(htmlspecialchars($tentang_kami['deskripsi_tentang'])); ?>
                                </p>
                                <div
                                    class="d-flex flex-column flex-md-row justify-content-center align-items-center mt-4">
                                    <a href="#layanan" class="btn btn-outline-danger me-md-2 mb-3 mb-md-0">Pelajari
                                        Lebih
                                        Lanjut</a>
                                    <a href="#footer" class="btn btn-danger">Hubungi Kami</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <br>
                <div class="content-section-visimisi" id="visi-misi">
                    <div class="left-visimisi">
                        <div class="left-visimisi-content">
                            <h2 style="color: #FEF5EA; text-align: center">Visi Misi</h2>
                            <div class="card" style="background-color: #FEF5EA!important;">
                                <h3 style="color: #951c11;">VISI</h3>
                                <p name="deskripsi-visi">
                                    <?php $getAllData = getAllData('visi_misi');
                            foreach ($getAllData as $visi_misi) :
                                echo $visi_misi['visi'];
                            ?>
                                </p>
                            </div>
                            <br>
                            <div class="card" style="background-color: #FEF5EA!important;">

                                <h3 style="color: #951c11;">MISI</h3>
                                <p name="deskripsi-misi">
                                    <?php echo $visi_misi['misi'];
                            endforeach; ?>
                                </p>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="right-visimisi">
                        <img src="assets/images/visi_misi/<?= htmlspecialchars(basename($visi_misi['foto'])); ?>"
                            class="gambar-visimisi" alt="gambar tentang CV Ghaffar Farm Bersaudara">
                    </div>
                </div>
            </section>



            <section id="produk-kami" name="produk-kami" class="produk-kami">
                <div class="content-section-produk-kami">
                    <h2 name="judul-produk-kami">Produk Kami</h2>
                    <div class="line"></div>
                    <p style="opacity: 0.5;">Jenis Produk Yang Kami Jual</p>
                    <div class="content-section-produk-kami-card">
                        <?php
                    $produks = getAllData('produk');
                    foreach ($produks as $produk) : ?>
                        <?php $uniqueId = uniqid(); ?>
                        <div class="card" style="width: 20rem; height: auto; position: relative;">
                            <h1 style="text-align: center; font-size: x-large;">
                                <?= htmlspecialchars($produk['jenis_sapi']); ?>
                            </h1>
                            <img src="assets/images/produk/<?= htmlspecialchars(basename($produk['foto'])); ?>"
                                class="card-img-top" alt="<?= htmlspecialchars($produk['jenis_sapi']); ?>"
                                style="height: 200px; object-fit: cover;">
                            <div class="card-body">
                                <div id="textContainer<?= $uniqueId ?>" style="max-height: 0; overflow: hidden;">
                                    <p class="card-text"><?= htmlspecialchars($produk['deskripsi_produk']); ?></p>
                                </div>
                                <div class="toggle-container">
                                    <span class="toggle-text" id="toggleText<?= $uniqueId ?>">Lihat Teks</span>
                                    <button class="btn toggle-btn" type="button"
                                        onclick="toggleText('<?= $uniqueId ?>')"
                                        style="background-color: #951C11; color: white;">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </section>



            <section id="layanan" class="layanan">
                <div class="content-section-layanan">
                    <h2 id="judul-produk-kami">Layanan</h2>
                    <div class="line"></div>
                    <br><br>
                    <?php
    $layanans = getAllData('layanan');
    foreach ($layanans as $layanan) : ?>

                    <img src="assets/images/layanan/<?= htmlspecialchars(basename($layanan['foto'])); ?>"
                        class="gambar-layanan" alt="gambar layanan CV Ghaffar Farm Bersaudara">



                    <div class="content-section-layanan-kami">

                        <div class="left-layanan">
                            <h3>Mengapa Investasi di Ghaffar Farm Bersaudara?</h3>
                            <div class='card w-100 m-auto'>
                                <?php
// Simpan teks di database dengan pemisah khusus, seperti #judul
$raw_text = $layanan['mengapa_ghaffar'];

// Pisahkan teks berdasarkan tag khusus
$sections = explode("\n", $raw_text);

// Awali output HTML
echo "<div class='info-section'>";

// Loop untuk setiap bagian
foreach ($sections as $section) {
    // Cek apakah bagian tersebut adalah judul
    if (strpos($section, '#') === 0) {
        // Hapus karakter # dan tampilkan sebagai <h3>
        $title = substr($section, 1);
        echo "<h3>$title</h3>";
    } else {
        // Tampilkan sebagai paragraf biasa
        echo "<p>$section</p>";
    }
}

// Akhiri output HTML
echo "</div>";
?>
                            </div>

                        </div>
                        <div class="right-layanan">

                            <h3>Kelebihan Investasi di Ghaffar Farm Bersaudara</h3>
                            <div class='card w-100 m-auto'>
                                <ul>
                                    <?php
        $kelebihan = nl2br(htmlspecialchars($layanan['kelebihan']));
        $kelebihan_poin = explode("\n", $kelebihan);

        foreach ($kelebihan_poin as $poin) {
            // Cek apakah poin dimulai dengan '#'
            if (strpos($poin, '#') === 0) {
                // Hilangkan '#' dan bungkus dengan tag <strong> dan <em>
                $poin = trim($poin, '# '); // Menghapus '#' dan spasi di depan dan belakang
                $poin = "<strong><em>$poin</em></strong>";
                $icon = ''; // Tidak ada ikon untuk judul
            } else {
                $icon = "<span class='list-icon'><i class='fa fa-check-circle'></i></span>"; // Ikon untuk poin biasa
            }

            echo "<li class='list-item'>
                    <div class='list-content'>
                        <span class='list-text'> $icon $poin</span>
                    </div>
                  </li>";
        }
        ?>
                                </ul>
                            </div>



                        </div>
                        <?php endforeach; ?>
                    </div>

                </div>
                <div class="content-section-jangka-investasi">
                    <div class="left-jangka-investasi">
                        <div class="left-jangka-investasi-content">
                            <h2 style="color: #FEF5EA; width: 100%;">INVESTASI</h2>
                            <h3 style="color: #FEF5EA;">Jangka Investasi:</h3>
                            <?php $investasian = getAllData('investasi');
                        foreach ($investasian as $investasi) : ?>
                            <p name="deskripsi-investasi">
                                <?= $investasi['jangka_investasi']; ?>
                            </p>

                            <h3 style="color: #FEF5EA;">Nilai Investasi:</h3>
                            <p name="deskripsi-nilai">
                                <?= $investasi['jlh_investasi']; ?>
                            </p>
                        </div>
                    </div>
                    <div class="right-jangka-investasi">
                        <img src="assets/images/investasi/<?= htmlspecialchars(basename($investasi['foto'])); ?>"
                            class="gambar-jangka-investasi" alt="gambar tentang CV Ghaffar Farm Bersaudara"
                            width="100%">
                    </div>
                    <?php endforeach; ?>
                </div>
                <div class="container my-5">
                    <div class="row">
                        <div class="col-lg-6 col-12 mb-4">
                            <div class="card w-100 h-100">
                                <div class="card-body">
                                    <h1 class="card-title h4 h-sm-3">Penjualan Daging Segar dan Beku</h1>
                                    <p class="flow-description">
                                        Kami menyediakan berbagai jenis daging segar dan beku dengan kualitas terbaik,
                                        langsung dari peternak ke konsumen.
                                    </p>
                                    <button class="btn" style="background-color: #951C11; color: white;">
                                        Beli Sekarang
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-12 mb-4">
                            <div class="card w-100 h-100">
                                <div class="card-body">
                                    <h1 class="card-title h4 h-sm-3">Penjualan Daging Qurban</h1>
                                    <p class="flow-description">
                                        Dapatkan daging qurban yang telah diproses sesuai syariah dengan harga yang
                                        terjangkau dan kualitas terjamin.
                                    </p>
                                    <button class="btn" style="background-color: #951C11; color: white;">
                                        Beli Sekarang
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <img src="assets/images/ghaffar.png" alt="">
                <section class="ghaffar-farm-section container my-4 py-5 h-auto">
                    <h2 class="text-center mb-3 fs-3">Kenapa Harus di PT. Ghaffar Farm Bersaudara?</h2>
                    <p class="text-center mx-auto mb-4 small" style="max-width: 700px;">
                        PT. GHAFFAR FARM BERSAUDARA menyiapkan sapi di Farm Balung Kab. Lima Puluh Kota atau kandang
                        mitra kami. Kami memastikan bahwa hewan qurban yang disediakan:
                    </p>
                    <div class="row g-3 justify-content-center">
                        <div class="col-xl-4 col-lg-3 col-md-4 col-sm-6">
                            <div class="gf-card h-100 text-center">
                                <div class="card-body d-flex flex-column align-items-center p-2">
                                    <div class="icon-wrapper bg-success bg-opacity-10">
                                        <i class="fas fa-user-md text-success"></i>
                                    </div>
                                    <h5 class="card-title mb-2">Pengawasan Profesional</h5>
                                    <p class="flow-description">Di bawah pengawasan dokter hewan.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-lg-3 col-md-4 col-sm-6">
                            <div class="gf-card h-100 text-center">
                                <div class="card-body d-flex flex-column align-items-center p-2">
                                    <div class="icon-wrapper bg-info bg-opacity-10">
                                        <i class="fas fa-gavel text-info"></i>
                                    </div>
                                    <h5 class="card-title mb-2">Aqad Syar'i</h5>
                                    <p class="flow-description">Aqad jual-beli sesuai syariat Islam.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-lg-3 col-md-4 col-sm-6">
                            <div class="gf-card h-100 text-center">
                                <div class="card-body d-flex flex-column align-items-center p-2">
                                    <div class="icon-wrapper bg-warning bg-opacity-10">
                                        <i class="fas fa-truck text-warning"></i>
                                    </div>
                                    <h5 class="card-title mb-2">Layanan Antar</h5>
                                    <p class="flow-description">Diantarkan ke alamat konsumen.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-lg-3 col-md-4 col-sm-6">
                            <div class="gf-card h-100 text-center">
                                <div class="card-body d-flex flex-column align-items-center p-2">
                                    <div class="icon-wrapper bg-danger bg-opacity-10">
                                        <i class="fas fa-shield-alt text-danger"></i>
                                    </div>
                                    <h5 class="card-title mb-2">Garansi Penuh</h5>
                                    <p class="flow-description">Garansi sapi sebelum serah terima.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-lg-3 col-md-4 col-sm-6">
                            <div class="gf-card h-100 text-center">
                                <div class="card-body d-flex flex-column align-items-center p-2">
                                    <div class="icon-wrapper bg-primary bg-opacity-10">
                                        <i class="fas fa-map-marker-alt text-primary"></i>
                                    </div>
                                    <h5 class="card-title mb-2">Jangkauan Luas</h5>
                                    <p class="card-text">Meliputi Sumatera Barat dan Riau.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <section id="w" name="workflow" class="workflow ghaffar-investment-flow h-auto">
                    <div class="content-section-workflow container">
                        <h2 id="judul-alur-kerja" class="text-center">Alur Kerja Perusahaan</h2>
                        <div class="line"></div>
                        <div class="flow-container">
                            <div class="flow-card">
                                <i class="flow-icon fas fa-user-edit"></i>
                                <h3 class="flow-title">Pendaftaran</h3>
                                <p class="flow-description">Nasabah mendaftar dan mengisi formulir</p>
                            </div>
                            <div class="flow-card">
                                <i class="flow-icon fas fa-file-signature"></i>
                                <h3 class="flow-title">Aqad</h3>
                                <p class="flow-description">Penandatanganan aqad jual beli di notaris</p>
                            </div>
                            <div class="flow-card">
                                <i class="flow-icon fas fa-piggy-bank"></i>
                                <h3 class="flow-title">Tabungan</h3>
                                <p class="flow-description">Nasabah menabung hingga 80% pada bulan ke-8</p>
                            </div>
                            <div class="flow-card">
                                <i class="flow-icon fas fa-check-circle"></i>
                                <h3 class="flow-title">Pelunasan</h3>
                                <p class="flow-description">Nasabah melunasi 100% tabungan pada bulan ke-10</p>
                            </div>
                        </div>
                    </div>
                    <div class="content-section-workflow container">
                        <h2 id="judul-alur-kerja" class="text-center">Alur Kerja Nasabah</h2>
                        <div class="line"></div>
                        <div class="flow-container">
                            <div class="flow-card">
                                <i class="flow-icon fas fa-user-edit"></i>
                                <h3 class="flow-title">Pendaftaran</h3>
                                <p class="flow-description">Nasabah mendatangi kantor dan mengisi formulir/ melalui agen
                                    marketing.</p>
                            </div>
                            <div class="flow-card">
                                <i class="flow-icon fas fa-file-signature"></i>
                                <h3 class="flow-title">Aqad</h3>
                                <p class="flow-description">Jika tabungan nasabah belum mencukupi sampai waktu yang
                                    ditentukan, maka tabungan akan diakomodasikan ke tahun berikutnya.</p>
                            </div>
                            <div class="flow-card">
                                <i class="flow-icon fas fa-piggy-bank"></i>
                                <h3 class="flow-title">Tabungan</h3>
                                <p class="flow-description">PT. GHAFFAR FARM BERSAUDARA menyiapkan sapi di Farm Balung
                                    Kab.
                                    Lima Puluh Kota atau kandang mitra PT. Ghaffar Farm Bersaudara.</p>
                            </div>
                            <div class="flow-card">
                                <i class="flow-icon fas fa-check-circle"></i>
                                <h3 class="flow-title">Pelunasan</h3>
                                <p class="flow-description">Nasabah melunasi 100% tabungan pada bulan ke-10</p>
                            </div>
                        </div>
                    </div>
                </section>
            </section>


            <section id="l" name="legalitas" class="legalitas ghaffar-investment-flow">
                <div class="content-section-legalitas container">
                    <h2 id="judul-produk-kami" class="text-center">Kemitraan</h2>
                    <div class="line"></div>
                    <div class="flow-container">
                        <div class="flow-card">
                            <i class="flow-icon fas fa-handshake"></i>
                            <h3 class="flow-title">Pendaftaran</h3>
                            <p class="flow-description">Daftar sebagai mitra investor kami</p>
                        </div>
                        <div class="flow-card">
                            <i class="flow-icon fas fa-coins"></i>
                            <h3 class="flow-title">Investasi</h3>
                            <p class="flow-description">Pilih paket investasi yang sesuai</p>
                        </div>
                        <div class="flow-card">
                            <i class="flow-icon fas fa-chart-line"></i>
                            <h3 class="flow-title">Pertumbuhan</h3>
                            <p class="flow-description">Pantau perkembangan investasi Anda</p>
                        </div>
                        <div class="flow-card">
                            <i class="flow-icon fas fa-hand-holding-usd"></i>
                            <h3 class="flow-title">Keuntungan</h3>
                            <p class="flow-description">Terima bagi hasil dari investasi</p>
                        </div>
                    </div>
                </div>
            </section>

            <section id="legalitas" name="legalitas" class="legalitas">
                <div class="content-section-legalitas">
                    <h2 id="judul-produk-kami">Legalitas</h2>
                    <div class="line"></div>
                    <div class="unduh-legalitas">
                        <p>Untuk informasi lebih lanjut tentang legalitas perusahaan kami, silakan unduh dokumen
                            legalitas
                            di bawah ini:</p>
                        <div class="list-group">
                            <?php
                        $dataLegalitas = getAllData('legalitas');
                        foreach ($dataLegalitas as $legalitas) : ?>
                            <a href="assets/pdf/legalitas/<?= $legalitas['legalitas']; ?>"
                                class="list-group-item list-group-item-action btn-download" download>
                                <i class="fas fa-download"></i> <span style="opacity: 0.5;">Sertifikat Standar Perizinan
                                    Ambulatori</span>
                            </a>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </section>



            <section id="kerjasama" name="kerjasama" class="kerjasama">
                <div class="content-section-kerjasama">
                    <h2>Support Partner</h2>
                    <div class="line"></div>
                    <h6 name="deskripsi-kerjasama" style="opacity: 0.6;">Kami Telah Bekerjasama dengan Berbagai
                        Perusahaan
                        dan Brand.</h6>
                    <p>Kami melayani bisnis penggemukan sapi oleh perusahaan kami dengan sistim kemitraan dengan
                        berbagai
                        usaha peternakan lainnya yang berada di pulau Sumatera, Riau, Jawa dan bahkan daerah Nusa
                        Tenggara
                        Timur dan Barat.</p>
                    <div class="marquee-wrapper">
                        <div class="marquee">
                            <div class="marquee-content">
                                <!-- get data sponsor -->
                                <?php
                            $dataSponsor = getAllData('sponsor');
                            foreach ($dataSponsor as $sponsor) :
                                // Convert absolute path to relative path
                                $absolutePath = $sponsor['foto'];
                                $relativePath = str_replace("C:\\laragon\\www\\company-profile\\", "", $absolutePath);
                                $relativePath = str_replace("\\", "/", $relativePath);
                            ?>
                                <img src="<?= htmlspecialchars($relativePath); ?>" class="marquee-image"
                                    alt="<?= htmlspecialchars($sponsor['sponsor']); ?>">
                                <?php endforeach; ?>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="whatsapp-icon" id="whatsappIcon">
                    <i class="fa fa-whatsapp" aria-hidden="true" style="font-size: 30px;"></i>
                </div>

                <div class="whatsapp-popup" id="whatsappPopup">
                    <textarea id="whatsappMessage" placeholder="Ketik pesan anda disini..."></textarea>
                    <button onclick="sendMessage()">Send</button>
                </div>
            </section>
            <section class="qa-section h-auto">
                <div class="container">
                    <h2 class="qa-header">Frequently Asked Questions (FAQ)</h2>
                    <div class="accordion" id="qaAccordion">
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingOne">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                    What services does your company offer?
                                </button>
                            </h2>
                            <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne"
                                data-bs-parent="#qaAccordion">
                                <div class="accordion-body">
                                    Our company provides a wide range of services including web development, mobile app
                                    development, digital marketing, and IT consulting. We aim to deliver high-quality
                                    solutions tailored to meet our clients' specific needs.
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingTwo">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                    How can I contact your support team?
                                </button>
                            </h2>
                            <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo"
                                data-bs-parent="#qaAccordion">
                                <div class="accordion-body">
                                    You can reach our support team via email at support@company.com or by calling our
                                    hotline at +123 456 7890. Our team is available 24/7 to assist you with any
                                    inquiries or
                                    issues.
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingThree">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                    What is your project delivery process?
                                </button>
                            </h2>
                            <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree"
                                data-bs-parent="#qaAccordion">
                                <div class="accordion-body">
                                    Our project delivery process consists of several stages: initial consultation,
                                    project
                                    planning, design, development, testing, and deployment. We keep our clients involved
                                    at
                                    every stage to ensure the final product meets their expectations.
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingFour">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                                    Do you offer post-project support?
                                </button>
                            </h2>
                            <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour"
                                data-bs-parent="#qaAccordion">
                                <div class="accordion-body">
                                    Yes, we offer comprehensive post-project support to ensure that everything runs
                                    smoothly
                                    after the project is completed. This includes maintenance, updates, and any
                                    necessary
                                    troubleshooting.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </main>
        <footer id="footer">
            <div class="footer">
                <div class="left-footer">
                    <div class="kontak">
                        <table>
                            <caption>Hubungi Kami</caption>
                            <tbody>
                                <?php $datakontak = getAllData('kontak');
                            foreach ($datakontak as $kontak) : ?>
                                <tr>
                                    <td><i class="fas fa-phone icon"></i></td>
                                    <td><?= $kontak['no_hp'] ?></td>
                                </tr>
                                <tr>
                                    <td><i class="fab fa-whatsapp icon"></i></td>
                                    <td><?= $kontak['no_wa'] ?></td>
                                </tr>
                                <tr>
                                    <td><i class="fab fa-instagram icon"></i></td>
                                    <td><?= $kontak['ig'] ?></td>
                                </tr>
                                <tr>
                                    <td><i class="fab fa-facebook icon"></i></td>
                                    <td><?= $kontak['fb'] ?></td>
                                </tr>
                            </tbody>
                        </table>

                    </div>
                    <div class="view-map" id="view-map">

                        <iframe
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3989.796557337123!2d100.65034387435526!3d-0.18924338540971586!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e2ab31ac2dc3b05%3A0x23c5173ad15bb109!2sCV.GHAFFAR%20FARM%20BERSAUDARA!5e0!3m2!1sid!2sid!4v1721993524153!5m2!1sid!2sid"
                            width="100%" height="295" style="border:0;" allowfullscreen=""
                            referrerpolicy="no-referrer-when-downgrade"></iframe>
                        <p style="text-align: left;"><?= $kontak['alamat'] ?></p>
                    </div>
                    <?php endforeach; ?>
                </div>
                <div class="right-footer">
                    <h2 style="text-align: left; padding: 28px; margin: 20px auto; padding-bottom: 5px !important;">
                        Company
                    </h2>
                    <div class="menu">
                        <ul>
                            <li class="nav-item"><a class="nav-link" href="#header">Home</a></li>
                            <li class="nav-item"><a class="nav-link" href="#produk-kami">Produk</a></li>
                            <li class="nav-item"><a class="nav-link" href="#layanan">Layanan</a></li>
                            <li class="nav-item"><a class="nav-link" href="#legalitas">Legalitas</a></li>
                            <li class="nav-item"><a class="nav-link" href="#footer">Hubungi Kami</a></li>
                        </ul>
                    </div>
                    <div class="feedback">
                        <div class="form">
                            <form action="admin/add_pesan.php" method="POST" onsubmit="return validateForm()">
                                <label style="text-align: left; ">Punya pertanyaan atau saran? silahkan kirimkan pesan
                                    anda....</label>
                                <textarea name="pesan_pengunjung" id="pesan" rows="5"
                                    placeholder="Tuliskan Pesan anda disini.." required></textarea>
                                <input type="email" name="email" id="email" placeholder="Email" required>
                                <input type="submit" value="Kirim pesan">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <?php include 'admin/dashboard/popup.php'; ?>
            <p>&copy; 2024 CV Ghaffar Farm Bersaudara. All rights reserved.</p>
        </footer>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="assets/js/tes.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"></script>
    <script src="bootstrap-5.3.3-dist/js/jquery.min.js"></script>
    <script src="bootstrap-5.3.3-dist/js/popper.min.js"></script>
    <script src="bootstrap-5.3.3-dist/js/bootstrap.min.js"></script>
    <script>
    window.addEventListener('load', function() {
        // Menyembunyikan overlay setelah halaman selesai dimuat
        document.getElementById('overlay').classList.add('hide-overlay');
    });

    document.getElementById('whatsappIcon').addEventListener('click', function() {
        var popup = document.getElementById('whatsappPopup');
        if (popup.style.display === 'none' || popup.style.display === '') {
            popup.style.display = 'block';
        } else {
            popup.style.display = 'none';
        }
    });

    function sendMessage() {
        var message = document.getElementById('whatsappMessage').value;
        var url = 'https://wa.me/6283167961562?text=' + encodeURIComponent(message);
        window.open(url, '_blank');
    }


    function toggleText(id) {
        const textContainer = document.getElementById('textContainer' + id);
        const toggleText = document.getElementById('toggleText' + id);
        const icon = toggleText.nextElementSibling.querySelector('i'); // Menemukan ikon di dalam tombol
        const maxHeight = textContainer.scrollHeight; // tinggi konten sebenarnya
        let currentHeight = textContainer.style.maxHeight === '0px' ? 0 : maxHeight;
        const increment = 30; // perubahan height per tick
        const intervalTime = 30; // interval waktu per tick

        if (currentHeight === 0) {
            // Expand
            textContainer.style.display = 'block';
            const expandInterval = setInterval(() => {
                if (currentHeight >= maxHeight) {
                    clearInterval(expandInterval);
                    toggleText.innerText = 'Tutup Teks';
                    icon.classList.replace("fa-eye", "fa-eye-slash");
                } else {
                    currentHeight += increment;
                    textContainer.style.maxHeight = currentHeight + 'px';
                }
            }, intervalTime);
        } else {
            // Collapse
            const collapseInterval = setInterval(() => {
                if (currentHeight <= 0) {
                    clearInterval(collapseInterval);
                    textContainer.style.maxHeight = '0px';
                    toggleText.innerText = 'Lihat Teks';
                    icon.classList.replace("fa-eye-slash", "fa-eye");
                } else {
                    currentHeight -= increment;
                    textContainer.style.maxHeight = currentHeight + 'px';
                }
            }, intervalTime);
        }
    }
    </script>




</body>

</html>