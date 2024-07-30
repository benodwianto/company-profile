-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jul 30, 2024 at 05:57 AM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ghaffar-farm`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`) VALUES
(2, 'admin', '$2y$10$D4MCpRRYgm7VOqEvP5hb7OYsoFh8K/VZ.GFcGo45wykMJ56iP.pxW');

-- --------------------------------------------------------

--
-- Table structure for table `home`
--

CREATE TABLE `home` (
  `id` int NOT NULL,
  `deskripsi_dashboard` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `home`
--

INSERT INTO `home` (`id`, `deskripsi_dashboard`) VALUES
(1, 'Sering menghadapi tantangan dalam mendapatkan pasokan daging berkualitas tinggi secara konsisten dan tepat waktu untuk memenuhi kebutuhan harian dan acara khusus. PT. GHAFFAR FARM BERSAUDARA hadir untuk mengatasi masalah-masalah ini dengan menyediakan daging berkualitas tinggi dan sapi qurban yang memenuhi standar tertinggi, serta layanan yang handal dan profesional sejak 2010.');

-- --------------------------------------------------------

--
-- Table structure for table `investasi`
--

CREATE TABLE `investasi` (
  `id` int NOT NULL,
  `jangka_investasi` varchar(255) NOT NULL,
  `jlh_investasi` varchar(255) NOT NULL,
  `foto` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `investasi`
--

INSERT INTO `investasi` (`id`, `jangka_investasi`, `jlh_investasi`, `foto`) VALUES
(1, 'Investor Musiman (6 Bulan) Investor Tetap (15 Tahun)', 'Minimal 50 juta rupiah Maksimal 16 Miliar Rupiah', 'C:\\laragon\\www\\company-profile\\config/../assets/images/investasi/invests.jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `kontak`
--

CREATE TABLE `kontak` (
  `id` int NOT NULL,
  `no_hp` varchar(200) NOT NULL,
  `no_wa` varchar(200) NOT NULL,
  `ig` varchar(255) NOT NULL,
  `fb` varchar(255) NOT NULL,
  `alamat` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `kontak`
--

INSERT INTO `kontak` (`id`, `no_hp`, `no_wa`, `ig`, `fb`, `alamat`) VALUES
(1, '+62 812-3456-7890', '+62 812-3456-7890', '@ghaffarfarmbersaudara', '@ghaffarfarmbersaudara', 'OFFICE CV. Ghaffar Farm Bersaudara Komplek Ruko OTS Tanjung Onau Jalan Raya Sumbar-Riau, Batas Kota Payakumbuh-Tanjung Pati Payakumbuh, Sumbar 26271');

-- --------------------------------------------------------

--
-- Table structure for table `layanan`
--

CREATE TABLE `layanan` (
  `id` int NOT NULL,
  `kelebihan` text NOT NULL,
  `mengapa_ghaffar` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `foto` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `layanan`
--

INSERT INTO `layanan` (`id`, `kelebihan`, `mengapa_ghaffar`, `foto`) VALUES
(1, 'Pasar daging sapi yang selalu terbuka dan menjanjikan dengan harga yang terjamin.                            Biaya investasi beragam, mulai dari 50 Juta rupiah hingga 16 Milyar dengan masa investasi yang dapat disesuaikan dengan keinginan investor.                            Investor dapat berkunjung langsung ke Farm dan menikmati suasana peternakan.                            Pasar ekspor yang sudah menunggu mulai dari tahun 2024.                            Rapat terbuka investor dengan perusahaan dan informasi yang up-to-date setiap bulannya.', 'Berbeda dengan konsep bisnis lainnya, investasi di perusahaan kami menerapkan konsep syariah dengan sistem bagi hasil yang terjamin keamanannya. Segala akad perjanjian akan melalui akta notaris dengan kekuatan hukum yang kuat. Investor di perusahaan kami sangat tenang dan nyaman karena ternak sapinya diasuransikan sehingga sapi mati, sakit, dan cacat selama program menjadi tanggung jawab perusahaan. <br><br> Pakan sapi peternakan kami 50% dari rumput yang ditanami di sekitar lahan farm, 50% berasal dari limbah pertanian dan limbah usaha makanan dengan biaya yang relatif kecil dan selalu tersedia sepanjang tahun. Sumber pakan tersebut berasal dari daerah sekitar lahan farm baik di farm sendiri ataupun farm mitra. Limbah pertanian tersebut berupa jerami, batang jagung, dedak, bungkil sawit yang selanjutnya diolah dengan proses fermentasi agar nilai gizinya meningkat.', 'C:\\laragon\\www\\company-profile\\config/../assets/images/layanan/logo-removebg-preview.png');

-- --------------------------------------------------------

--
-- Table structure for table `legalitas`
--

CREATE TABLE `legalitas` (
  `id` int NOT NULL,
  `sertifikat` varchar(255) NOT NULL,
  `legalitas` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `legalitas`
--

INSERT INTO `legalitas` (`id`, `sertifikat`, `legalitas`) VALUES
(1, '	Sertifikat Standar Perizinan Berusaha Berbasis Risiko', 'Sertifikat Standar Perizinan Berusaha Berbasis Risiko (1).pdf'),
(5, 'Sertifikat Standar Perizinan Berusaha Berbasis Ambulatori', 'Sertifikat Standar Perizinan Ambulatori (1).pdf');

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `id` int NOT NULL,
  `id_admin` int NOT NULL,
  `waktu` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`id`, `id_admin`, `waktu`) VALUES
(1, 2, '2024-07-26 04:15:25');

-- --------------------------------------------------------

--
-- Table structure for table `pesan`
--

CREATE TABLE `pesan` (
  `id` int NOT NULL,
  `pesan_pengunjung` text NOT NULL,
  `email` varchar(200) NOT NULL,
  `tanggal` timestamp NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `pesan`
--

INSERT INTO `pesan` (`id`, `pesan_pengunjung`, `email`, `tanggal`) VALUES
(1, 'mangtafffffff', '', '2024-07-26 05:47:57'),
(2, 'ghhghhghghghghgh', 'ben@gmail.com', '2024-07-26 05:51:32'),
(3, 'Kulitas daging sapi sangat bagus,sangat disarankan.', 'bambang@gmail.com', '2024-07-28 08:26:33');

-- --------------------------------------------------------

--
-- Table structure for table `produk`
--

CREATE TABLE `produk` (
  `id` int NOT NULL,
  `jenis_sapi` varchar(255) NOT NULL,
  `foto` text NOT NULL,
  `deskripsi_produk` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`id`, `jenis_sapi`, `foto`, `deskripsi_produk`) VALUES
(4, 'Sapi Bali', 'C:\\laragon\\www\\company-profile\\config/../assets/images/produk/sapibali.jpg', 'sapi Bali merupakan sapi asli dan murni Indonesia, merupakan keturunan asli banteng (Bibos banteng) yang telah didomestikasi sejak zaman prasejarah 3500 SM. Dinamakan sapi Bali karena gen asli sapi ini berasal dari pulau Bali, kemudian menyebar luas ke daerah Asia Tenggara.'),
(5, 'Sapi Sigmental', 'C:\\laragon\\www\\company-profile\\config/../assets/images/produk/sapisigmental.jpg', 'Sapi Simmental merupakan salah satu jenis sapi potong yang berasal dari Lembah Simme, Swiss. Sapi ini memiliki karakteristik dengan tubuh yang besar dan berat badan yang mencapai ratusan kilogram. '),
(6, 'Sapi Pesisir', 'C:\\laragon\\www\\company-profile\\config/../assets/images/produk/sapipesisir.jpg', 'Sapi Pesisir adalah salah satu rumpun sapi asli Indonesia. sapi ini merupakan salah satu sapi lokal yang populasinya menyebar di seluruh Provinsi Sumatera Barat. Sapi jenis ini memiliki keseragaman bentuk fisik dan mempunyai komposisi genetik dengan kemampuan adaptasi yang baik meskipun pada lingkungan yang buruk');

-- --------------------------------------------------------

--
-- Table structure for table `sponsor`
--

CREATE TABLE `sponsor` (
  `id` int NOT NULL,
  `sponsor` varchar(255) NOT NULL,
  `foto` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `sponsor`
--

INSERT INTO `sponsor` (`id`, `sponsor`, `foto`) VALUES
(3, 'Bank BRI', 'C:\\laragon\\www\\company-profile\\config/../assets/images/sponsor/logo-bri-png-transparan-jasalogocepat-01.png'),
(4, 'Bank Nagari', 'C:\\laragon\\www\\company-profile\\config/../assets/images/sponsor/Logo-Bank-Nagari.png'),
(5, 'Farmers', 'C:\\laragon\\www\\company-profile\\config/../assets/images/sponsor/download (3).png'),
(6, 'Grand Central Hotel', 'C:\\laragon\\www\\company-profile\\config/../assets/images/sponsor/1a9c90a9597c7141442cde84c8231570.jpg'),
(7, 'Holycow', 'C:\\laragon\\www\\company-profile\\config/../assets/images/sponsor/CMbBXKeVAAATyeI.jpg'),
(8, 'Steak n Shake', 'C:\\laragon\\www\\company-profile\\config/../assets/images/sponsor/download (4).png'),
(9, 'HAri hari Pasar Swalayan', 'C:\\laragon\\www\\company-profile\\config/../assets/images/sponsor/download (34).jpeg'),
(10, 'Jakarta Market', 'C:\\laragon\\www\\company-profile\\config/../assets/images/sponsor/download (35).jpeg'),
(11, 'Ekaputra', 'C:\\laragon\\www\\company-profile\\config/../assets/images/sponsor/download (36).jpeg'),
(12, 'Bank BSI', 'C:\\laragon\\www\\company-profile\\config/../assets/images/sponsor/Download Logo BANK SYARIAH INDONESIA CDR dan PNG.png'),
(13, 'Hotel Pangeran', 'C:\\laragon\\www\\company-profile\\config/../assets/images/sponsor/hotel-pangeran-pekanbaru.png'),
(14, 'Hotel Santika', 'C:\\laragon\\www\\company-profile\\config/../assets/images/sponsor/hotel-santika-logo-83EBACA14E-seeklogo.com.png'),
(15, 'Indofood', 'C:\\laragon\\www\\company-profile\\config/../assets/images/sponsor/Indofood-Logo.wine.png'),
(16, 'Hypermart', 'C:\\laragon\\www\\company-profile\\config/../assets/images/sponsor/logo.png'),
(17, 'Super Indo', 'C:\\laragon\\www\\company-profile\\config/../assets/images/sponsor/Logo_Super_Indo.png'),
(18, 'Novotel', 'C:\\laragon\\www\\company-profile\\config/../assets/images/sponsor/Novotel-Logo.png');

-- --------------------------------------------------------

--
-- Table structure for table `tentang`
--

CREATE TABLE `tentang` (
  `id` int NOT NULL,
  `deskripsi_tentang` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `foto` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tentang`
--

INSERT INTO `tentang` (`id`, `deskripsi_tentang`, `foto`) VALUES
(1, 'PT.GHAFFAR FARM BERSAUDARA adalah perusahaan yang bergerak dalam bidang penggemukan sapi dan pemasok daging untuk kebutuhan pemotongan harian, kebutuhan logistik usaha perhotelan, restoran, swalayan kebutuhan harian, toko daging (meat shop), minimarket, pesantren pendidikan bahkan rumah sakit.<br><br>                        PT. GHAFFAR FARM BERSAUDARA juga menyediakan stok sapi qurban jantan kualitas super dari berbagai jenis sapi lokal maupun impor. PT. GHAFFAR FARM BERSAUDARA berdiri pada tahun2010 di Jawa Barat, kemudian pada tahun 2012 mulai mengembangkan kepak bisnis di Sumatera Barat dan Riau.<br><br>                        PT. GHAFFAR FARM BERSAUDARA berdiri pada tahun2010 di Jawa Barat, kemudianpada tahun 2012 mulai mengembangkan kepak bisnis di Sumatera Barat dan Riau. Pendirian perusahaan berdasarkan akta notaris dan SK Kemenkumham yang sah secara hukum dengan notaris pribadi perusahaan kami adalah Notaris Mulyana, SH, MKn, Saat ini, perusahaan kami melakukan pembangunan farm secara progresif pada lahan seluas 12 Ha di daerahTanjung Balik, Pangkalan, Kabupaten Limapuluh Kota, Sumatera Barat dengan konsep Farm Integrasi Sawit dan Sapi. Kepemilikan lahanadalah milik perusahaan yang sah secara hukum berdasarkan akta notaris', 'C:\\laragon\\www\\company-profile\\config/../assets/images/tentang/Tentang kami.png');

-- --------------------------------------------------------

--
-- Table structure for table `visi_misi`
--

CREATE TABLE `visi_misi` (
  `id` int NOT NULL,
  `visi` text NOT NULL,
  `misi` text NOT NULL,
  `foto` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `visi_misi`
--

INSERT INTO `visi_misi` (`id`, `visi`, `misi`, `foto`) VALUES
(1, 'Menjadi sentra pemasok daging sapi lokal dan olahannya untuk kebutuhan dalam negeri dan komoditas ekport', 'Menghasilkan daging sapi lokal dan olahannya dengan kualitasterjamin serta layak ekportdan menerapkan konsep Aman, Sehat, Utuh dan Halal.', 'C:\\laragon\\www\\company-profile\\config/../assets/images/visi_misi/visimisi.png');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `home`
--
ALTER TABLE `home`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `investasi`
--
ALTER TABLE `investasi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kontak`
--
ALTER TABLE `kontak`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `layanan`
--
ALTER TABLE `layanan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `legalitas`
--
ALTER TABLE `legalitas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_admin` (`id_admin`);

--
-- Indexes for table `pesan`
--
ALTER TABLE `pesan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sponsor`
--
ALTER TABLE `sponsor`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tentang`
--
ALTER TABLE `tentang`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `visi_misi`
--
ALTER TABLE `visi_misi`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `home`
--
ALTER TABLE `home`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `investasi`
--
ALTER TABLE `investasi`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `kontak`
--
ALTER TABLE `kontak`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `layanan`
--
ALTER TABLE `layanan`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `legalitas`
--
ALTER TABLE `legalitas`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `login`
--
ALTER TABLE `login`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `pesan`
--
ALTER TABLE `pesan`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `produk`
--
ALTER TABLE `produk`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `sponsor`
--
ALTER TABLE `sponsor`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `tentang`
--
ALTER TABLE `tentang`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `visi_misi`
--
ALTER TABLE `visi_misi`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `login`
--
ALTER TABLE `login`
  ADD CONSTRAINT `login_ibfk_1` FOREIGN KEY (`id_admin`) REFERENCES `admin` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
