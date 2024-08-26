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
    <title>CV Ghaffar Farm Bersaudara - Sentra Pemasok Daging Sapi</title>
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

    <!-- ini bagian konten header -->


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
            <p>SYARIAH, BAROKAH SUKSES</p>
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
            data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
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
        <section class="tentangkami active" id="tentang-kami">
            <h2 class="hello p-1">Tentang Kami<span class="line tentangkamii"></span></h2>
            <div class="card d-flex flex-column flex-lg-row" style="width: 98%;">
                <div class="left-tentangkami">
                    <?php
            $dataTentangKami = getAllData('tentang');
            foreach ($dataTentangKami as $tentang_kami) : ?>
                    <img src="assets/images/tentang/<?= htmlspecialchars(basename($tentang_kami['foto'])); ?>"
                        class="gambar-tentangkami rounded-circle img-fluid mb-3"
                        alt="gambar tentang CV Ghaffar Farm Bersaudara">
                    <?php endforeach; ?>
                </div>
                <div class="right-tentangkami d-flex align-items-center" style="height: 100%;">
                    <p class="text-left" style="width: 100%; text-align: left;">
                        <?= nl2br(htmlspecialchars($tentang_kami['deskripsi_tentang'])); ?>
                    </p>
                </div>

            </div>

            <br>
            <div class="content-section-visimisi" id="visi-misi">
                <div class="left-visimisi">
                    <div class="left-visimisi-content">
                        <h2 style="color: #951c11; text-align: center">Visi Misi</h2>
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
                                <button class="btn toggle-btn" type="button" onclick="toggleText('<?= $uniqueId ?>')"
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
                <div class="content-section-layanan-kami">
                    <?php
    $layanans = getAllData('layanan');
    foreach ($layanans as $layanan) : ?>
                    <div class="left-layanan">
                        <h2>Mengapa Ghaffar Farm Bersaudara?</h2>
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

                        <!-- <img src="assets/images/layanan/<?= htmlspecialchars(basename($layanan['foto'])); ?>"
                            class="gambar-layanan" alt="gambar layanan CV Ghaffar Farm Bersaudara"> -->
                    </div>
                    <div class="right-layanan">

                        <h2>Kelebihan Ghaffar Farm Bersaudara</h2>
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
                        $icon
                        <span class='list-text'>$poin</span>
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
                        class="gambar-jangka-investasi" alt="gambar tentang CV Ghaffar Farm Bersaudara" width="100%">
                </div>
                <?php endforeach; ?>
            </div>
            <div class="container my-5">
                <div class="row">
                    <div class="col-lg-6 col-12 mb-4">
                        <div class="card w-100 h-100">
                            <div class="card-body">
                                <h1 class="card-title h4 h-sm-3">Penjualan Daging Segar dan Beku</h1>
                                <p class="card-text">
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
                                <p class="card-text">
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
        </section>


        <section id="l" name="legalitas" class="legalitas">
            <div class="content-section-legalitas">
                <h2 id="judul-produk-kami">Kemitraan</h2>
                <div class="line"></div>

            </div>
        </section>

        <section id="legalitas" name="legalitas" class="legalitas">
            <div class="content-section-legalitas">
                <h2 id="judul-produk-kami">Legalitas</h2>
                <div class="line"></div>
                <div class="unduh-legalitas">
                    <p>Untuk informasi lebih lanjut tentang legalitas perusahaan kami, silakan unduh dokumen legalitas
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
                <h6 name="deskripsi-kerjasama" style="opacity: 0.6;">Kami Telah Bekerjasama dengan Berbagai Perusahaan
                    dan Brand.</h6>
                <p>Kami melayani bisnis penggemukan sapi oleh perusahaan kami dengan sistim kemitraan dengan berbagai
                    usaha peternakan lainnya yang berada di pulau Sumatera, Riau, Jawa dan bahkan daerah Nusa Tenggara
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
                        width="100%" height="295" style="border:0;" allowfullscreen="" loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade"></iframe>
                    <p style="text-align: left;"><?= $kontak['alamat'] ?></p>
                </div>
                <?php endforeach; ?>
            </div>
            <div class="right-footer">
                <h2 style="text-align: left; padding: 28px; margin: 20px auto; padding-bottom: 5px !important;">Company
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


    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="assets/js/tes.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"></script>
    <script src="bootstrap-5.3.3-dist/js/jquery.min.js"></script>
    <script src="bootstrap-5.3.3-dist/js/popper.min.js"></script>
    <script src="bootstrap-5.3.3-dist/js/bootstrap.min.js"></script>
    <script>
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