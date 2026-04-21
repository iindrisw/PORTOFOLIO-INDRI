-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 21, 2026 at 06:30 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_pengaduan`
--

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id_comment` int(11) NOT NULL,
  `id_posts` int(11) NOT NULL,
  `id_users` int(11) NOT NULL,
  `comment_text` text NOT NULL,
  `likes` int(11) DEFAULT 0,
  `dislikes` int(11) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id_comment`, `id_posts`, `id_users`, `comment_text`, `likes`, `dislikes`, `created_at`) VALUES
(1, 10, 4, 'Dinas PUPR sudah melakukan pengerukan sedimen pagi tadi. Aliran lancar.', 15, 1, '2026-04-08 01:30:07'),
(2, 11, 4, 'Aspirasi diterima. Pemasangan lampu hias dijadwalkan bulan depan.', 8, 2, '2026-04-08 01:30:07'),
(3, 15, 4, 'Terima kasih atas laporannya. Dinas Lingkungan Hidup (DLH) Kota Cirebon telah mengerahkan armada tambahan ke lokasi Pasar Kanoman sore ini. Saat ini tumpukan sampah telah dibersihkan dan jadwal pengangkutan akan diperketat agar tidak terjadi penumpukan kembali. Mohon warga juga menjaga ketertiban pembuangan sampah pada tempatnya.\r\n', 0, 0, '2026-04-08 02:04:17'),
(4, 15, 4, 'Terima kasih atas laporannya. Dinas Lingkungan Hidup (DLH) Kota Cirebon telah mengerahkan armada tambahan ke lokasi Pasar Kanoman sore ini. Saat ini tumpukan sampah telah dibersihkan dan jadwal pengangkutan akan diperketat agar tidak terjadi penumpukan kembali. Mohon warga juga menjaga ketertiban pembuangan sampah pada tempatnya.\r\n', 0, 0, '2026-04-08 02:04:17'),
(5, 16, 4, '\"Laporan diterima! Informasi pemadaman listrik di wilayah UIN telah dikonfirmasi sebagai agenda pemeliharaan rutin. Estimasi pemadaman dimulai pukul 09.00 WIB. Tim lapangan akan memastikan proses pengerjaan berjalan lancar agar listrik kembali normal tepat waktu. Pastikan daya perangkat Anda terisi penuh dan simpan pekerjaan Anda tepat waktu. Tetap produktif!\"', 0, 0, '2026-04-21 16:19:45'),
(6, 17, 4, '\"Terima kasih atas laporannya, warga. Kami sangat menghargai kepedulian Anda terhadap keselamatan pengguna jalan. Informasi mengenai lubang jalan di depan gerbang utama UIN Siber Syekh Nurjati telah masuk dalam daftar prioritas perbaikan tim pemeliharaan jalan Dinas PUPR hari ini. Petugas akan segera melakukan penambalan darurat sore ini untuk meminimalkan risiko kecelakaan. Mohon tetap berhati-hati saat melintas, terutama saat cuaca hujan.\"', 0, 0, '2026-04-21 16:23:20');

-- --------------------------------------------------------

--
-- Table structure for table `comment_votes`
--

CREATE TABLE `comment_votes` (
  `id_vote` int(11) NOT NULL,
  `id_users` int(11) NOT NULL,
  `id_comment` int(11) NOT NULL,
  `vote_type` enum('like','dislike') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `laporan`
--

CREATE TABLE `laporan` (
  `id_laporan` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `judul` varchar(200) NOT NULL,
  `isi_laporan` text NOT NULL,
  `kategori` enum('PENGADUAN','ASPIRASI') NOT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `lokasi` varchar(255) DEFAULT NULL,
  `status` enum('pending','proses','selesai','ditolak') DEFAULT 'pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `laporan`
--

INSERT INTO `laporan` (`id_laporan`, `id_user`, `judul`, `isi_laporan`, `kategori`, `foto`, `lokasi`, `status`, `created_at`) VALUES
(10, 1, 'Drainase Tersumbat di Tuparev', 'Saluran air penuh sampah, air meluap ke jalan saat hujan.', 'PENGADUAN', NULL, NULL, 'selesai', '2026-04-08 01:30:07'),
(11, 1, 'Usulan Lampu Taman Krucuk', 'Alun-alun agak remang kalau malam, mohon ditambah lampu dekorasi.', 'ASPIRASI', NULL, NULL, 'selesai', '2026-04-08 01:30:07'),
(15, 1, 'Penumpukan Sampah di Dekat Pasar Kanoman', 'Sampah di bak penampungan sementara area Pasar Kanoman sudah meluap sampai ke badan jalan selama 3 hari terakhir. Bau menyengat sangat mengganggu pejalan kaki dan pedagang sekitar. Mohon segera dikirim armada tambahan dari DLH untuk pengangkutan rutin agar tidak menumpuk.', 'PENGADUAN', '863-images.jpg', '-6.724157, 108.550529', 'selesai', '2026-04-08 01:58:57'),
(16, 1, 'pemadaman listrik', 'katanya akan ada pemadaman listrik di sekitar uin kamis jam 09.00', '', NULL, '-6.734701, 108.531144', 'selesai', '2026-04-21 16:18:28'),
(17, 1, 'Jalan Berlubang Parah di Depan Gerbang Kampus UIN', 'Izin lapor Min, jalan di depan gerbang utama kampus UIN ada lubang yang cukup dalam dan lebar. Kalau hujan sering tergenang air jadi nggak kelihatan, kemarin ada mahasiswa yang hampir jatuh karena kejeblos. Mohon segera ditindaklanjuti sebelum ada korban jiwa. Terima kasih.', 'PENGADUAN', '643-images (1).jpg', '-6.735763, 108.532158', 'selesai', '2026-04-21 16:22:36');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id_user` int(11) NOT NULL,
  `nama_lengkap` varchar(100) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `level` enum('admin','user') NOT NULL,
  `points` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id_user`, `nama_lengkap`, `username`, `password`, `level`, `points`) VALUES
(1, 'Ayes Pahlawan', 'ayes', '123', 'user', 5),
(4, 'Admin Cirebon', 'admin', '123', 'admin', 0);

-- --------------------------------------------------------

--
-- Table structure for table `voucher_saya`
--

CREATE TABLE `voucher_saya` (
  `id_v_user` int(11) NOT NULL,
  `id_user` int(11) DEFAULT NULL,
  `nama_voucher` varchar(100) DEFAULT NULL,
  `kode_voucher` varchar(20) DEFAULT NULL,
  `tgl_tukar` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` enum('aktif','digunakan') DEFAULT 'aktif'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `voucher_saya`
--

INSERT INTO `voucher_saya` (`id_v_user`, `id_user`, `nama_voucher`, `kode_voucher`, `tgl_tukar`, `status`) VALUES
(1, 1, 'Nasi Jamblang Ibu Nur', '9C70AB33', '2026-04-21 16:23:39', 'aktif'),
(2, 1, 'Nasi Jamblang Ibu Nur', '5D78834E', '2026-04-21 16:26:43', 'aktif'),
(3, 1, 'Nasi Jamblang Ibu Nur', 'A6EA3F3D', '2026-04-21 16:29:20', 'aktif');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id_comment`),
  ADD KEY `id_users` (`id_users`),
  ADD KEY `fk_comments_laporan` (`id_posts`);

--
-- Indexes for table `comment_votes`
--
ALTER TABLE `comment_votes`
  ADD PRIMARY KEY (`id_vote`),
  ADD UNIQUE KEY `satu_vote_aja` (`id_users`,`id_comment`),
  ADD KEY `fk_vote_comment` (`id_comment`);

--
-- Indexes for table `laporan`
--
ALTER TABLE `laporan`
  ADD PRIMARY KEY (`id_laporan`),
  ADD KEY `fk_laporan_user` (`id_user`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `voucher_saya`
--
ALTER TABLE `voucher_saya`
  ADD PRIMARY KEY (`id_v_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id_comment` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `comment_votes`
--
ALTER TABLE `comment_votes`
  MODIFY `id_vote` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `laporan`
--
ALTER TABLE `laporan`
  MODIFY `id_laporan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `voucher_saya`
--
ALTER TABLE `voucher_saya`
  MODIFY `id_v_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`id_posts`) REFERENCES `laporan` (`id_laporan`) ON DELETE CASCADE,
  ADD CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`id_users`) REFERENCES `users` (`id_user`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_comments_laporan` FOREIGN KEY (`id_posts`) REFERENCES `laporan` (`id_laporan`) ON DELETE CASCADE;

--
-- Constraints for table `comment_votes`
--
ALTER TABLE `comment_votes`
  ADD CONSTRAINT `comment_votes_ibfk_1` FOREIGN KEY (`id_users`) REFERENCES `users` (`id_user`) ON DELETE CASCADE,
  ADD CONSTRAINT `comment_votes_ibfk_2` FOREIGN KEY (`id_comment`) REFERENCES `comments` (`id_comment`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_vote_comment` FOREIGN KEY (`id_comment`) REFERENCES `comments` (`id_comment`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_vote_user` FOREIGN KEY (`id_users`) REFERENCES `users` (`id_user`) ON DELETE CASCADE;

--
-- Constraints for table `laporan`
--
ALTER TABLE `laporan`
  ADD CONSTRAINT `fk_laporan_user` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`) ON DELETE CASCADE,
  ADD CONSTRAINT `laporan_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
