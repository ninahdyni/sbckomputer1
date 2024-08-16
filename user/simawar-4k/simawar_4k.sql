-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 09 Jun 2022 pada 16.23
-- Versi server: 10.4.21-MariaDB
-- Versi PHP: 7.4.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `simawar_4k`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_bagian`
--

CREATE TABLE `tbl_bagian` (
  `id_bagian` int(11) NOT NULL,
  `nm_bagian` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tbl_bagian`
--

INSERT INTO `tbl_bagian` (`id_bagian`, `nm_bagian`) VALUES
(1, 'Rektorat'),
(2, 'Keuangan'),
(3, 'Kepegawaian'),
(4, 'Akreditasi'),
(5, 'Honorer');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_srt_klr`
--

CREATE TABLE `tbl_srt_klr` (
  `id_srt_klr` int(11) NOT NULL,
  `no_srt` varchar(50) NOT NULL,
  `tgl_srt` date NOT NULL,
  `lampiran` varchar(50) NOT NULL,
  `hal` varchar(100) NOT NULL,
  `untuk` text NOT NULL,
  `file` text NOT NULL,
  `penandatangan` int(11) NOT NULL,
  `tgl_ttd` date NOT NULL,
  `status` varchar(20) NOT NULL,
  `tgl_input` datetime NOT NULL,
  `oleh` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tbl_srt_klr`
--

INSERT INTO `tbl_srt_klr` (`id_srt_klr`, `no_srt`, `tgl_srt`, `lampiran`, `hal`, `untuk`, `file`, `penandatangan`, `tgl_ttd`, `status`, `tgl_input`, `oleh`) VALUES
(1, '001/UNISKA/A.15/20922', '2022-05-14', '1 berkas', 'Perjanjian Ditanggapi', 'Universitas Lambung Mangkurat', 'surat.pdf', 4, '2022-05-14', 'Ditandatangani', '2022-05-28 05:58:10', 'Mrs. Fitriyani'),
(2, '2010/A/5/2022', '2022-06-22', '1', 'Perjanjian Kerjasama', 'Mrs Nina Handayani', '62a2017b54a6a.pdf', 4, '0000-00-00', 'New', '2022-06-09 22:17:56', '1');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_srt_msk`
--

CREATE TABLE `tbl_srt_msk` (
  `id_srt_msk` int(11) NOT NULL,
  `no_srt` varchar(50) NOT NULL,
  `tgl_srt` date NOT NULL,
  `lampiran` varchar(50) NOT NULL,
  `hal` varchar(100) NOT NULL,
  `dari` text NOT NULL,
  `file` text NOT NULL,
  `tgl_terima` datetime NOT NULL,
  `penerima` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tbl_srt_msk`
--

INSERT INTO `tbl_srt_msk` (`id_srt_msk`, `no_srt`, `tgl_srt`, `lampiran`, `hal`, `dari`, `file`, `tgl_terima`, `penerima`) VALUES
(1, '001/ULM/A.15/20922', '2022-05-14', '-', 'Permintaan Kerja Sama', 'Universitas Lambung Mangkurat', 'surat.pdf', '2022-05-28 05:45:35', 'Mrs. Nina');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_user`
--

CREATE TABLE `tbl_user` (
  `id_user` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `nm_user` varchar(200) NOT NULL,
  `nik` varchar(20) NOT NULL,
  `id_bagian` int(11) NOT NULL,
  `telp` varchar(15) NOT NULL,
  `email` varchar(200) NOT NULL,
  `foto` varchar(100) NOT NULL,
  `password` varchar(200) NOT NULL,
  `level` int(11) NOT NULL,
  `tgl_reg` datetime NOT NULL,
  `oleh` varchar(200) NOT NULL,
  `status` int(11) NOT NULL,
  `theme` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tbl_user`
--

INSERT INTO `tbl_user` (`id_user`, `username`, `nm_user`, `nik`, `id_bagian`, `telp`, `email`, `foto`, `password`, `level`, `tgl_reg`, `oleh`, `status`, `theme`) VALUES
(1, 'nina', 'Mrs. Nina Handayani', '1234567890', 1, '088242739374', 'ninahdyni2202@gmail.com', 'profile.jpg', '$2y$10$9yIpumlc7rRpWww4axPpzOUdp36dbY0DobIIBnAPa94m6Gd/xMRDm', 1, '2022-05-21 13:45:57', 'Nina', 1, 'dark-theme'),
(2, 'fitri', 'Mrs Fitriyani', '23454346578', 2, '087894739374', 'ftryn10@gmail.com', 'fitri.png', '$2y$10$lZs3/bn/zcKeUUfSLe/dE.LrXoQAqDdw9cDVtDVg2XZhTIORyPyP2', 2, '2022-05-21 13:53:59', 'Nina', 1, 'semi-dark'),
(3, 'Kipli', 'Mr Kiplyansyah', '7899542689', 3, '082193745678', 'kiplyansyah22@gmail.com', 'kipli.png', '\n$2y$10$lZs3/bn/zcKeUUfSLe/dE.LrXoQAqDdw9cDVtDVg2XZhTIORyPyP2', 3, '2022-05-21 13:53:59', 'Nina', 1, 'semi-dark'),
(4, 'andi', 'Andie S.Kom', '2010010058', 3, '085242739374', 'abcdefg@gmail.com', 'default.png', '$2y$10$iwNGgqBvuEJynBRNa4buueQhq7e3zVSh4XifmsoN0SaeB06P/.6Zy', 4, '2022-06-09 22:14:45', 'Mrs. Nina Handsyani', 1, 'semi-dark');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tbl_bagian`
--
ALTER TABLE `tbl_bagian`
  ADD PRIMARY KEY (`id_bagian`);

--
-- Indeks untuk tabel `tbl_srt_klr`
--
ALTER TABLE `tbl_srt_klr`
  ADD PRIMARY KEY (`id_srt_klr`);

--
-- Indeks untuk tabel `tbl_srt_msk`
--
ALTER TABLE `tbl_srt_msk`
  ADD PRIMARY KEY (`id_srt_msk`);

--
-- Indeks untuk tabel `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `tbl_bagian`
--
ALTER TABLE `tbl_bagian`
  MODIFY `id_bagian` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `tbl_srt_klr`
--
ALTER TABLE `tbl_srt_klr`
  MODIFY `id_srt_klr` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `tbl_srt_msk`
--
ALTER TABLE `tbl_srt_msk`
  MODIFY `id_srt_msk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
