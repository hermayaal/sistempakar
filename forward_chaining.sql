-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 12 Bulan Mei 2022 pada 04.52
-- Versi server: 10.4.22-MariaDB
-- Versi PHP: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `forward_chaining`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `admin`
--

CREATE TABLE `admin` (
  `id_admin` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `admin`
--

INSERT INTO `admin` (`id_admin`, `username`, `password`) VALUES
(1, 'admin', 'admin');

-- --------------------------------------------------------

--
-- Struktur dari tabel `artikel`
--

CREATE TABLE `artikel` (
  `id_artikel` int(100) NOT NULL,
  `judul_artikel` varchar(100) NOT NULL,
  `isi_artikel` varchar(2000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `artikel`
--

INSERT INTO `artikel` (`id_artikel`, `judul_artikel`, `isi_artikel`) VALUES
(1, 'Mengenal Burung Murai Batu dan Jenisnya', 'Coba');

-- --------------------------------------------------------

--
-- Struktur dari tabel `aturan`
--

CREATE TABLE `aturan` (
  `id_aturan` int(11) NOT NULL,
  `id_penyakit` int(11) NOT NULL,
  `id_gejala` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `aturan`
--

INSERT INTO `aturan` (`id_aturan`, `id_penyakit`, `id_gejala`) VALUES
(36, 8, 32),
(37, 8, 33),
(38, 8, 34),
(39, 8, 35),
(40, 8, 36),
(41, 9, 37),
(42, 9, 38),
(43, 9, 39),
(44, 9, 40),
(45, 10, 41),
(46, 10, 42),
(47, 10, 43),
(48, 11, 44),
(49, 11, 45),
(50, 11, 46),
(51, 12, 41),
(52, 12, 47),
(53, 12, 48),
(54, 12, 49),
(55, 13, 41),
(56, 13, 50),
(57, 13, 51),
(58, 14, 52),
(59, 14, 53),
(60, 14, 54),
(61, 14, 55),
(62, 15, 41),
(63, 15, 56),
(64, 15, 57),
(65, 15, 58),
(66, 16, 59),
(67, 16, 60),
(68, 17, 61),
(69, 17, 62),
(70, 17, 63),
(71, 18, 64),
(72, 18, 65),
(73, 19, 66),
(74, 20, 67),
(75, 20, 68),
(76, 20, 69),
(77, 20, 70),
(78, 20, 71),
(79, 21, 72),
(80, 21, 73),
(81, 21, 74),
(82, 21, 75),
(83, 21, 76),
(84, 22, 67),
(85, 22, 77),
(86, 22, 78),
(87, 22, 79);

-- --------------------------------------------------------

--
-- Struktur dari tabel `gejala`
--

CREATE TABLE `gejala` (
  `id_gejala` int(11) NOT NULL,
  `kode_gejala` varchar(5) NOT NULL,
  `nama_gejala` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `gejala`
--

INSERT INTO `gejala` (`id_gejala`, `kode_gejala`, `nama_gejala`) VALUES
(32, 'C01', 'Pertumbuhan burung terhambat'),
(33, 'C02', 'Kulit dan Bulu berubah menjadi kasar'),
(34, 'C03', 'Mengalami gangguan pada reproduksi'),
(35, 'C04', 'Terjadi pembengkakan pada persendian dan kaku'),
(36, 'C05', 'Mata mengalami kebutaan'),
(37, 'C06', 'Nafsu makan burung mulai menghilang'),
(38, 'C07', 'Otot pada burung melemah'),
(39, 'C08', 'Mengalami degenerative syarat tubuh'),
(40, 'C09', 'Lumpuh'),
(41, 'C10', 'Pertumbuhan lambat'),
(42, 'C11', 'Adanya syndrome curled toe paralysis'),
(43, 'C12', 'Kaki pada burung mengalami kelumpuhan'),
(44, 'C13', 'Penurunan daya tetas telur'),
(45, 'C14', 'Kerontokan pada bulu'),
(46, 'C15', 'Kulit yang mulai bersisik'),
(47, 'C16', 'Terdapat kutil pada jari-jari dan kaki burung'),
(48, 'C17', 'Mengalami tremor atau gemetaran'),
(49, 'C18', 'Kordinasi gerakan tidak terkendali'),
(50, 'C19', 'Pertumbuhan bulu tidak bagus atau jelek'),
(51, 'C20', 'Daya tetas rendah pada telur'),
(52, 'C21', 'Selaput lendir pada mulut burung terlihat membengkak'),
(53, 'C22', 'Berdarah dan luka-luka'),
(54, 'C23', 'Tulang melemah'),
(55, 'C24', 'Kapiler darah mudah pecah'),
(56, 'C25', 'Pembengkakan pada tulang kaki dan dada'),
(57, 'C26', 'Kekerasan paruh melunak'),
(58, 'C27', 'Tekstur dari kulit telur tipis'),
(59, 'C28', 'Mudah untuk terluka'),
(60, 'C29', 'Mengalami pendarahan'),
(61, 'C30', 'Terdapat kelainan pada tulang'),
(62, 'C31', 'Sendi membesar'),
(63, 'C32', 'Tulang yang tua mengalami kelunakan dan kelumpuhan'),
(64, 'C33', 'Kotoran berubah menjadi berwarna merah'),
(65, 'C34', 'Mengalami diare berdarah yang kemudian berakhir dengan kematian'),
(66, 'C35', 'Terdapat kotoran berwarna putih seperti kapur'),
(67, 'C36', 'Keinginan makan menjadi turun'),
(68, 'C37', 'Mengalami demam'),
(69, 'C38', 'Tampak lesu'),
(70, 'C39', 'Menjadi lebih lemah'),
(71, 'C40', 'Mengalami bersin-bersin dan ingus terlihat keluar'),
(72, 'C41', 'Kerusakan pada bulu burung'),
(73, 'C42', 'Burung menjadi lebih gelisah'),
(74, 'C43', 'Terlihat perilaku mematuk bulu sendiri dan kanibal sesamanya'),
(75, 'C44', 'Kicauan terdengar macet'),
(76, 'C45', 'Suara kicauan tidak los'),
(77, 'C46', 'Mengalami penurunan berat badan'),
(78, 'C47', 'Bulu terlihat lebih kusam'),
(79, 'C48', 'Kerontokan bulu yang belum saatnya');

-- --------------------------------------------------------

--
-- Struktur dari tabel `penyakit`
--

CREATE TABLE `penyakit` (
  `id_penyakit` int(11) NOT NULL,
  `kode_penyakit` varchar(5) NOT NULL,
  `nama_penyakit` varchar(50) NOT NULL,
  `pengobatan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `penyakit`
--

INSERT INTO `penyakit` (`id_penyakit`, `kode_penyakit`, `nama_penyakit`, `pengobatan`) VALUES
(8, 'S01', 'Avitaminosis A', 'Beri Vitamin A (makanan atau olahan pakan dari rumput hijau, jagung kuning, tepung lembaga jagung, tepung daun kacang-kacangan, susu, minyak ikan, tepung hati dan karoten)'),
(9, 'S02', 'Polyneuritis', 'Beri vitamin B1 (Sumber Vit B1:pakan olahan lain dari bekatul, biji-bijian sereal dan hijauan atau sayuran. Burung kena polyneuritis jangan diberi pakan mengandung thiaminase, seperti ikan mentah)'),
(10, 'S03', 'Paralysis', 'Berikan Vitamin B2 (Sumber Vitamin B2 adalah pakan atau bahan olahan lain dari hijauan, sayuran, ragi atau jamur, kotoran unggas yang sudah mengalami proses proses pengeringan dengan baik, susu dan hati).'),
(11, 'S04', 'Avitaminosis B5', 'Berikan Vitamin B5 (Sumber vitamin B5: pakan atau olahan lain dari biji-biji sereal, hijauan atau sayuran, tepung hati, tepung kacang, ragi, tepung terigu, tepung kedelai dan jagung).'),
(12, 'S05', 'Dermatitis', 'Berikan Vitamin B6 (Sumber tepung ragi, tepung hati, hijauan, biji-bijian sereal, tetes gula tebu, tepung terigu, menir dan susu).'),
(13, 'S06', 'Avitaminosis B12', 'Berikan vitamin B12 (Sumber vitamin B12 adalah makanan atau barang olahan lain dari faeses yang dikeringkan, kuning telur, tepung ikan, whey (hasil sampingan keju), tepung kedelai, makanan lain yang sudah mengalami fermentasi zat renik seperti ragi)'),
(14, 'S07', 'Avitaminosis C', 'Berikan Vitamin C (Sumber buah-buahan, sayuran dan hijauan)'),
(15, 'S08', 'Rachitis', 'Berikan vitamin D (Sumber makanan atau bahan lain seperti susu). Disertai pula penjemuran di pagi hari antara pukul 08.00 sampai 09.00.'),
(16, 'S09', 'Hemorraghi', 'Berikan Vitamin K (Sumber seperti sayuran warna hijau dan tepung ikan)'),
(17, 'S10', 'Demineralisasi tulang', 'Berikan Kalsium (Sumber Kalsium adalah tulang ikan, kulit kerang dan daun tanaman legume)'),
(18, 'S11', 'Koksidiosis / berak darah', 'Jaga kebersihan kandang dan peralatan dengan penyemprotan rutin tiap bulan dengan obat antiparasit'),
(19, 'S12', 'Pullorum / berak kapur', 'Jaga kebersihan kandang dan peralatan dengan penyemprotan rutin tiap bulan dengan obat anti parasit.'),
(20, 'S13', 'Psittacosis', 'Belum ada obatnya yang benar-benar bisa bekerja; Jaga kebersihan kandang dan peralatan dengan penyemprotan rutin tiap bulan dengan desinfektan.'),
(21, 'S14', 'Ektoparasit', 'Diolesi obat sistemik pembunuh kutu yang tidak hanya berkeliaran di luar tetapi juga yang bersembunyi di lapisan kulit.'),
(22, 'S15', 'Endoparasit', 'Dioles dengan obat antiparasit yang bekerja secara sistemik dan /atau diberi obat cacing; pemberian berkelanjutan dilakukan sebulan sekali.');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indeks untuk tabel `artikel`
--
ALTER TABLE `artikel`
  ADD PRIMARY KEY (`id_artikel`);

--
-- Indeks untuk tabel `aturan`
--
ALTER TABLE `aturan`
  ADD PRIMARY KEY (`id_aturan`),
  ADD KEY `id_penyakit` (`id_penyakit`),
  ADD KEY `id_gejala` (`id_gejala`);

--
-- Indeks untuk tabel `gejala`
--
ALTER TABLE `gejala`
  ADD PRIMARY KEY (`id_gejala`);

--
-- Indeks untuk tabel `penyakit`
--
ALTER TABLE `penyakit`
  ADD PRIMARY KEY (`id_penyakit`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `admin`
--
ALTER TABLE `admin`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `artikel`
--
ALTER TABLE `artikel`
  MODIFY `id_artikel` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `aturan`
--
ALTER TABLE `aturan`
  MODIFY `id_aturan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=88;

--
-- AUTO_INCREMENT untuk tabel `gejala`
--
ALTER TABLE `gejala`
  MODIFY `id_gejala` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=80;

--
-- AUTO_INCREMENT untuk tabel `penyakit`
--
ALTER TABLE `penyakit`
  MODIFY `id_penyakit` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `aturan`
--
ALTER TABLE `aturan`
  ADD CONSTRAINT `aturan_ibfk_1` FOREIGN KEY (`id_penyakit`) REFERENCES `penyakit` (`id_penyakit`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `aturan_ibfk_2` FOREIGN KEY (`id_gejala`) REFERENCES `gejala` (`id_gejala`) ON DELETE CASCADE ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
