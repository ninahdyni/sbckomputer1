-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 16 Agu 2024 pada 02.47
-- Versi server: 10.4.25-MariaDB
-- Versi PHP: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `lkpsbc`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `bagian`
--

CREATE TABLE `bagian` (
  `id_bagian` int(11) NOT NULL,
  `nm_bagian` varchar(55) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `bagian`
--

INSERT INTO `bagian` (`id_bagian`, `nm_bagian`) VALUES
(1, 'Administrator '),
(2, 'Direktur'),
(3, 'Pengajar'),
(4, 'Pengguna');

-- --------------------------------------------------------

--
-- Struktur dari tabel `evaluasi`
--

CREATE TABLE `evaluasi` (
  `id_evaluasi` int(11) NOT NULL,
  `id` int(11) NOT NULL,
  `platform` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `evaluasi`
--

INSERT INTO `evaluasi` (`id_evaluasi`, `id`, `platform`) VALUES
(12, 2, 'whatsapp'),
(14, 1, 'spanduk'),
(16, 14, 'telegram'),
(18, 12, 'whatsapp'),
(19, 12, 'whatsapp'),
(22, 15, 'twitter'),
(23, 16, 'whatsapp'),
(24, 17, 'website'),
(25, 18, 'twitter');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pendaftaran`
--

CREATE TABLE `pendaftaran` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `nm_user2` varchar(50) NOT NULL,
  `nm_user3` varchar(50) NOT NULL,
  `nm_user4` varchar(50) NOT NULL,
  `telp2` varchar(15) NOT NULL,
  `telp3` varchar(15) NOT NULL,
  `telp4` varchar(15) NOT NULL,
  `id_program` int(11) NOT NULL,
  `tanggal_mulai` varchar(25) NOT NULL,
  `jadwal_kursus` text NOT NULL,
  `bukti_transfer` varchar(25) NOT NULL,
  `id_team` int(11) NOT NULL,
  `status_daftar` int(11) NOT NULL,
  `tgl_pendaftaran` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `pendaftaran`
--

INSERT INTO `pendaftaran` (`id`, `id_user`, `nm_user2`, `nm_user3`, `nm_user4`, `telp2`, `telp3`, `telp4`, `id_program`, `tanggal_mulai`, `jadwal_kursus`, `bukti_transfer`, `id_team`, `status_daftar`, `tgl_pendaftaran`) VALUES
(1, 8, '', '', '', '', '', '', 7, '2024-02-25', 'Senin: 16.00-18.00, Kamis: 19.30-21.30, Jumat: 16.00-18.00', 'bukti_transfer_12.jpg', 1, 2, '2024-02-25'),
(2, 6, 'Widya Astuti', '', '', '08789073567', '', '', 6, '2024-02-29', 'Senin: 14.00-16.00, Jumat: 16.00-18.00', '0eP3cI5.png', 5, 2, '2024-02-25'),
(5, 8, '', '', '', '', '', '', 4, '2024-02-29', 'Senin: 14.00-16.00, Jumat: 16.00-18.00', 'bukti_transfer_8.png', 1, 2, '2024-02-25'),
(6, 23, '', '', '', '', '', '', 1, '2024-03-29', 'Kamis: 14.00-16.00, Jumat: 16.00-18.00', 'bukti_transfer_23.png', 1, 2, '2024-03-22'),
(10, 27, '', '', '', '', '', '', 1, '2024-07-25', 'Senin: 14.00-16.00, Selasa: 14.00-16.00, Rabu: 14.00-16.00', 'bukti_transfer_27.png', 1, 2, '2024-07-18'),
(11, 8, '', '', '', '', '', '', 1, '2024-07-20', 'Jumat: 16.00-18.00, Sabtu: 16.00-18.00', 'bukti_transfer_8.png', 0, 2, '2024-07-20'),
(12, 5, '', '', '', '', '', '', 1, '2024-07-27', 'Rabu: 19.30-21.30, Jumat: 19.30-21.30', 'bukti_transfer_5.png', 3, 2, '2024-07-20'),
(14, 5, '', '', '', '', '', '', 1, '2024-07-21', 'Jumat: 16.00-18.00, Sabtu: 16.00-18.00', 'bukti_transfer_5.png', 3, 2, '2024-07-22'),
(15, 12, '', '', '', '', '', '', 1, '2024-07-22', 'Selasa: 16.00-18.00, Jumat: 16.00-18.00', 'bukti_transfer_12.png', 3, 2, '2024-07-22'),
(16, 27, '', '', '', '', '', '', 1, '2024-07-22', 'Kamis: 19.30-21.30, Jumat: 19.30-21.30', 'bukti_transfer_27.png', 0, 1, '2024-07-22'),
(17, 1, '', '', '', '', '', '', 1, '2024-08-06', 'Jumat: 16.00-18.00, Sabtu: 16.00-18.00', 'bukti_transfer_1.png', 1, 2, '2024-08-06'),
(18, 1, '', '', '', '', '', '', 1, '2024-08-22', 'Senin: 16.00-18.00, Rabu: 16.00-18.00, Minggu: 19.30-21.30', 'bukti_transfer_1.png', 0, 1, '2024-08-15');

-- --------------------------------------------------------

--
-- Struktur dari tabel `program`
--

CREATE TABLE `program` (
  `id_program` int(11) NOT NULL,
  `nama_kelas` varchar(50) NOT NULL,
  `jenis_kelas` varchar(20) NOT NULL,
  `deskripsi` text NOT NULL,
  `materi` text NOT NULL,
  `lama_pendidikan` varchar(20) NOT NULL,
  `biaya` varchar(20) NOT NULL,
  `foto_program` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `program`
--

INSERT INTO `program` (`id_program`, `nama_kelas`, `jenis_kelas`, `deskripsi`, `materi`, `lama_pendidikan`, `biaya`, `foto_program`) VALUES
(1, 'Aplikasi Perkantoran (Ms. Office)', 'Private', 'Untuk menunjang tugas perkantoran maka diperlukan aplikasi ms office yang telah menjadi program dasar perkantoran,  bisnis dan pendidikan.  Setelah mengikuti program kursus ini siswa didik dapat melakukan pembuatan dokumen,  mengolah data keuangan,  table,  grafik,  sekaligus dapat mempresentasikan laporan secara visual komputerisasi dan juga menerima email,  membuat maupun mengirim email.', 'Ms Office Word 2003 / 2007 / 2010,  Ms Office Excel 2003 / 2007 / 2010,  Ms Office Power Point 2003 / 2007 / 2010 Dan Internet.', '12 Pertemuan', 'Rp. 950.000,00', 'program1.jpg'),
(2, 'BORLAND DELPHI 7', 'Private', 'Setelah mengikuti program kursus ini peserta didik bisa membuat database SQL Dan Acces  dalam pembuatan  aplikasi .Mengunakan Borland Delphi 7', 'Pengantar Delphi ( Interface ),  Mengenal IDE (Form Design,Object Inspector,Unit,Tool Palette),  Komponent Standard &amp; Latihan Program (Kalkulator). Mengenal Struktur Menu Delphi, file, Edit,Search,View Dll,  Tipe Data &amp; Operator + Latihan program (Toko Klontong). Teknik Pemrograman,  Pernyataan Kondisional.(If-Then-Else,Case of),  Perulangan (Repeat ..Until,While ..Do)  + Latihan Program.  Mengakses Database Paradox,  Koneksi,Format Savem,  Latihan Aplikasi ( Pendaftaran Siswa Baru) Database Lanjutan, koneksi 2 tabel,  Query,  Latihan Program &amp; Evaluasi. Dll.', '12 Pertemuan', 'Rp. 1.300.000,00', 'program2.jpg'),
(3, 'Teknisi Komputer dan Jaringan ', 'Reguler', ' Setelah mengikuti program kursus ini siswa didik mapu merakit computer,  mengatasi kerusakan,  penyelamatan data,  instalasi  &amp; konfigurasi jaringan.', 'Mengenal hardware dan software,  memhami prosedur instalasi hardware &amp; software,  data,  cloning, troublesolving software dan hardware, instalasi &amp; konfigurasi jaringan, control computer,  pemasangan warnet', '12 Pertemuan', 'Rp. 1.300.000,00', '6512b17c56d5e.jpg'),
(4, 'Design Grafis', 'Private', 'Setelah mengikuti program kursus ini siswa didik dapat membuat logo,  kartu nama,  brosur,  spanduk, dan juga dapat mengedit dan merekayasa foto', '  Corel draw dan photoshop', '12 Pertemuan', 'Rp. 1.100.000,00', 'dg.jpg'),
(6, 'Komputer Akuntansi', 'Private', 'Pelatihan Komputer Akuntansi (Accounting) merupakan pelatihan yang memberikan pemahaman dasar kepada peserta mengenai analisis transaksi, siklus akuntansi, dan perlakuan akuntansi untuk aset. Pelatihan ini bertujuan agar peserta mampu menyusun laporan keuangan secara manual dan menggunakan software akuntansi (accounting software)', 'Pembahasan materi secara teori &amp; Praktek Latihan Soal menggunakan komputer', '10 Pertemuan', 'Rp. 1.500.000,00', '7224ecd1b2423c927aed3e8587c6ff9e.jpg'),
(7, 'Web Master', 'Private', 'web master', 'web master', '20 Pertemuan', 'Rp. 2.100.000,00', 'gambar.png');

-- --------------------------------------------------------

--
-- Struktur dari tabel `promo`
--

CREATE TABLE `promo` (
  `id_promo` int(11) NOT NULL,
  `judul` varchar(100) NOT NULL,
  `id_program` int(11) NOT NULL,
  `kode` varchar(20) NOT NULL,
  `biaya_promo` varchar(20) NOT NULL,
  `pesan1` text NOT NULL,
  `pesan2` text NOT NULL,
  `batas` varchar(20) NOT NULL,
  `terpakai` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `promo`
--

INSERT INTO `promo` (`id_promo`, `judul`, `id_program`, `kode`, `biaya_promo`, `pesan1`, `pesan2`, `batas`, `terpakai`) VALUES
(1, 'Promo Akhir Tahun', 1, 'SBC2024', 'Rp. 800.000,00', 'Berkirim pesan secara privat Privasi Anda adalah prioritas kami. Dengan enkripsi end-to-end, Anda dapat merasa yakin bahwa pesan pribadi Anda hanya diketahui oleh Anda dan penerima pesan.', 'Glosarium adalah suatu daftar alfabetis istilah dalam suatu ranah pengetahuan tertentu yang dilengkapi dengan definisi untuk istilah-istilah tersebut. Biasanya glosarium ada di bagian akhir suatu buku dan menyertakan istilah-istilah dalam buku tersebut yang baru diperkenalkan atau paling tidak, tak umum ditemukan. Wikipedia', '10', '10'),
(2, 'PROMO PROMO PROMO', 1, 'LKPSBC', 'Rp. 900.000,00', '', '', '10', '10'),
(4, 'NEW YEAR', 2, 'SBCNY2024', 'Rp. 1.200.000,00', 'Selamat Tahun Baru! Kami di LKP SULTAN BERUNTUNG CENTRE ingin mengucapkan selamat datang di tahun yang baru dengan kesempatan baru. Apakah Anda bermimpi tentang menjadi seorang desainer grafis yang berbakat? Inilah saatnya untuk mewujudkannya! Bergabunglah dengan program Kursus Desain Grafis kami di Tahun Baru dan jadilah seorang kreator visual yang handal. Pelajari teknik-teknik desain terkini, eksplorasi kreativitas Anda, dan siapkan diri Anda untuk melonjak ke dunia desain yang menarik.', 'Dalam program Kursus Desain Grafis kami, Anda akan mendapatkan pengalaman praktis dalam merancang grafis yang memukau. Tim pengajar kami yang berpengalaman akan membimbing Anda melalui setiap langkahnya. Dari desain logo hingga ilustrasi digital, Anda akan memperoleh keterampilan yang diperlukan untuk menciptakan desain yang menarik dan efektif. Selain itu, Anda akan bergabung dengan komunitas desainer yang bersemangat, berbagi ide, dan mendapatkan wawasan berharga. Bergabunglah dengan kami dan mulailah tahun ini dengan langkah besar dalam karier desain grafis Anda. Jangan lewatkan kesempatan ini!', '10', '10');

-- --------------------------------------------------------

--
-- Struktur dari tabel `registrasi`
--

CREATE TABLE `registrasi` (
  `id_registrasi` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `foto_ktp` varchar(25) NOT NULL,
  `bukti_registrasi` varchar(25) NOT NULL,
  `status_regis` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `registrasi`
--

INSERT INTO `registrasi` (`id_registrasi`, `id_user`, `foto_ktp`, `bukti_registrasi`, `status_regis`) VALUES
(28, 1, 'ktp_6.jpeg', 'bukti_registrasi_6.png', '2'),
(29, 2, 'ktp_5.jpeg', 'bukti_registrasi_5.jpg', '2'),
(34, 3, 'ktp_1.png', 'bukti_registrasi_1.png', '2'),
(46, 4, 'ktp_1.png', 'bukti_registrasi_1.png', '1'),
(64, 9, 'ktp_6.jpg', 'bukti_registrasi_6.jpg', '1'),
(65, 10, 'ktp_10.png', 'bukti_registrasi_10.jpg', '1'),
(72, 23, 'ktp_23.jpg', 'bukti_registrasi_23.png', '2'),
(73, 27, 'ktp_27.jpg', 'bukti_registrasi_27.jpg', '2'),
(74, 5, 'ktp_5.jpg', 'bukti_registrasi_5.jpg', '1'),
(75, 1, 'ktp_1.png', 'bukti_registrasi_1.png', '1');

-- --------------------------------------------------------

--
-- Struktur dari tabel `sertifikat`
--

CREATE TABLE `sertifikat` (
  `id_sertifikat` int(11) NOT NULL,
  `id` int(11) NOT NULL,
  `tanggal_selesai` date NOT NULL,
  `file_sertifikat` text NOT NULL,
  `keterangan` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `sertifikat`
--

INSERT INTO `sertifikat` (`id_sertifikat`, `id`, `tanggal_selesai`, `file_sertifikat`, `keterangan`) VALUES
(5, 1, '2024-07-21', 'SERTIFIKAT-2010010058 (2)_compressed.pdf', '2'),
(6, 14, '2024-07-28', 'LEMBAGA KURSUS DAN PELATIHAN 2.pdf', '2'),
(8, 17, '2024-09-28', 'LEMBAGA KURSUS DAN PELATIHAN 2.pdf', '2'),
(9, 1, '2024-08-15', 'CETAK.pdf', '2');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_admin`
--

CREATE TABLE `tbl_admin` (
  `id_admin` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `nm_user` varchar(150) NOT NULL,
  `nik` varchar(20) NOT NULL,
  `id_bagian` int(11) NOT NULL,
  `telp` varchar(15) NOT NULL,
  `email` varchar(150) NOT NULL,
  `foto` text NOT NULL,
  `password` text NOT NULL,
  `tgl_reg` datetime NOT NULL,
  `oleh` varchar(150) NOT NULL,
  `status` int(11) NOT NULL,
  `theme` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tbl_admin`
--

INSERT INTO `tbl_admin` (`id_admin`, `username`, `nm_user`, `nik`, `id_bagian`, `telp`, `email`, `foto`, `password`, `tgl_reg`, `oleh`, `status`, `theme`) VALUES
(1, 'nina', 'Mrs. Nina Handayani', '1234567890', 1, '088242739374', 'ninahdyni2202@gmail.com', 'team-2.jpg', '$2y$10$J3dZEnP9RPtKy08RsnvTgOlupuZhUU63XNGd.rG3xSv22zzcLxFR6', '2022-05-21 13:45:57', 'Nina', 1, 'semi-dark'),
(2, 'fitri', 'Mrs Fitriyani', '23454346578', 3, '087894739374', 'ftryn10@gmail.com', 'fitri.png', '$2y$10$lZs3/bn/zcKeUUfSLe/dE.LrXoQAqDdw9cDVtDVg2XZhTIORyPyP2', '2022-05-21 13:53:59', 'Nina', 1, 'semi-dark'),
(3, 'Kipli', 'Mr Kiplyansyah', '7899542689', 3, '082193745678', 'kiplyansyah22@gmail.com', 'kipli.png', '\n$2y$10$lZs3/bn/zcKeUUfSLe/dE.LrXoQAqDdw9cDVtDVg2XZhTIORyPyP2', '2022-05-21 13:53:59', 'Nina', 1, 'semi-dark'),
(6, 'sbckomputer', 'LKP SULTAN BERUNTUNG CENTRE', '272727', 1, '087814649469', 'sultanberuntungcentre@gmail.com', 'logo1.png', '$2y$10$iwNGgqBvuEJynBRNa4buueQhq7e3zVSh4XifmsoN0SaeB06P/.6Zy', '2023-11-30 13:47:16', 'Mrs. Nina Handayani', 1, 'semi-dark');

-- --------------------------------------------------------

--
-- Struktur dari tabel `team`
--

CREATE TABLE `team` (
  `id_team` int(11) NOT NULL,
  `nm_team` varchar(50) NOT NULL,
  `nik` varchar(20) NOT NULL,
  `id_bagian` int(11) NOT NULL,
  `whatsapp` varchar(20) NOT NULL,
  `instagram` varchar(50) NOT NULL,
  `twitter` varchar(50) NOT NULL,
  `email_team` varchar(150) NOT NULL,
  `telp_team` varchar(15) NOT NULL,
  `foto_team` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `team`
--

INSERT INTO `team` (`id_team`, `nm_team`, `nik`, `id_bagian`, `whatsapp`, `instagram`, `twitter`, `email_team`, `telp_team`, `foto_team`) VALUES
(0, '-', '-', 3, '', '', '', '', '', ''),
(1, 'Herry Adi Chandra, S.Kom., M.Kom', 'SBC0117111987', 2, '087814649469', 'herry_sbc', '@herry_sbc', 'sbckomputer@gmail.com', '088242739374', 'team-1.jpg'),
(2, 'Yusup Indra Wijaya, S.Kom.,M.Kom.', 'SBC1109121985', 2, '08782134536', '#', '#', 'yusupindrawijaya@gmail.com', '08782134536', 'team-3.jpg'),
(3, 'Nida Putri Rahmawati, S.E.,M.Ak.', 'SBC0122011990', 3, '0878654321345', 'nidaputrirahmawati', '@nidaputrirahmawati', 'nidaputri@gmail.com', '087812345689', 'team-2.jpg'),
(4, 'Putra Nada', 'SBC1507062001', 3, '089765743658', 'simpelx_', '@simpelx_', 'putranada@gmail.com', '087812673183', 'fitri.png'),
(5, 'Nina Handayani', 'SBC2022022001', 3, '088242739374', 'ninahdyni', 'ninahdyni', 'ninahdyni2202@gmail.com', '088242739374', 'default.png'),
(6, 'Hilmy Al Shiddiq ', 'SBC12092000', 3, '0878654321345', 'hilmy_asshidiq', '@hilmy_asshidiq', 'hilmy089@gmail.com', '087865432134', 'testimonials-5.jpg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `testimonial`
--

CREATE TABLE `testimonial` (
  `id_testi` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `komentar` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `testimonial`
--

INSERT INTO `testimonial` (`id_testi`, `id_user`, `komentar`) VALUES
(2, 1, 'Belajar di SBC Komputer sangat menyenangkan karena disini kita diajarkan dan dibimbing dengan baik oleh instrukturnya dan apabila kita tertinggal materi, instruktur akan membantu kita agar dapat menyelesaikannya. Saya sangat senang bisa mendapatkan kesempatan untuk belajar bersama di Lembaga Pelatihan SBC Komputer Saya sudah bisa memahami komputer dengan baik berkat SBC Komputer. Terima Kasih untuk semua pelayanan yang sangat baik dan bermanfaat ini.'),
(4, 2, 'Saya sangat senang mengikuti pelatihan Digital Marketing di Lembaga Pelatihan SBC Komputer. Materi yang diberikan juga sangat menarik dan tidak membuat mengantuk meskipun di siang hari. Semuanya sangat baik dan sabar dalam memberikan ajaran mulai dari Pengajar yang asik, staf-staf yang baik yang membuat kami mengikuti proses ini dengan semangat. Terimakasih atas ilmu yang diberikan kepada saya dan teman-teman. '),
(5, 6, 'Lembaga Pelatihan SBC Komputer Merupakan tempat kursus yang sangat nyaman, karena ketika kita belajar di SBC Komputer kita diajari sampai bisa. Instrukturnyapun baik, ramah dan murah senyum dan memiliki kompetensi dibidangnya masing- masing. Semoga SBC Komputer semakin jaya kedepannya dan semakin dikenal banyak orang.'),
(6, 10, 'Semoga testimonial ini dapat memberikan gambaran positif tentang Lembaga Pelatihan SBC Komputer. Anda dapat menyesuaikan testimonial ini atau menambahkan detail khusus sesuai dengan pengalaman Anda atau pengalaman orang lain yang relevan.'),
(7, 3, 'Terima Kasih Lembaga Pelatihan SBC Komputer untuk ilmunya, Terima kasih juga untuk para tutor yang membimbing saya selama saya kursus di SBC, saya sekarang sudah bisa banyak membuat desain, seperti desain spanduk, banner, kartu nama, baliho dan lain-lain. Saya bisa terapkan ilmu yang saya dapat di salah satu perusahaan saya bekerja saat ini, Semoga SBC Komputer semakin berkembang dan jayalah selalu Lembaga Pelatihan SBC Komputer.'),
(10, 4, 'Magnam dolores commodi suscipit. Necessitatibus eius consequatur ex aliquid fuga eum quidem. Sit sint consectetur velit. Quisquam quos quisquam cupiditate. Et nemo qui impedit suscipit alias ea. Quia fugiat sit in iste officiis commodi quidem hic quas. Magnam dolores commodi suscipit. Necessitatibus eius consequatur ex aliquid fuga eum quidem. Sit sint consectetur velit. Quisquam quos quisquam cupiditate. Et nemo qui impedit suscipit alias ea. Quia fugiat sit in iste officiis commodi quidem hic quas.'),
(13, 14, 'BAGUS SEKALI!!!'),
(14, 12, 'Saya telah mengikuti beberapa kursus di LKP Sultan Beruntung Centre Komputer dan saya sangat puas dengan pengalaman saya. Instruktur mereka sangat kompeten dan sabar dalam memberikan pelatihan. Saya merasa mendapatkan pemahaman yang mendalam tentang materi yang diajarkan dan telah meningkatkan keterampilan saya secara signifikan. Terima kasih kepada tim LKP Sultan Beruntung Centre Komputer!'),
(16, 23, 'ALHAMDULILLAH BELAJAR DI LKP SBC SANGAT BAGUS'),
(17, 1, 'oke oke saja');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `nm_user` varchar(150) NOT NULL,
  `tempat_lahir` varchar(50) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `pekerjaan` varchar(50) NOT NULL,
  `telp` varchar(15) NOT NULL,
  `email` varchar(150) NOT NULL,
  `foto` text NOT NULL,
  `password` text NOT NULL,
  `tgl_reg` datetime NOT NULL,
  `id_bagian` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id_user`, `username`, `nm_user`, `tempat_lahir`, `tanggal_lahir`, `pekerjaan`, `telp`, `email`, `foto`, `password`, `tgl_reg`, `id_bagian`) VALUES
(1, 'nina', 'Mrs. Nina Handayani', 'Banjarmasin', '2001-02-22', 'Mahasiswa', '088242739374', 'ninahdyni2202@gmail.com', '66b1916ab751a.jpg', '$2y$10$ntbiFgkdh0JNpKvNS1tmgOx1FDukk3HDjmyGpkyKq/TMCMiWvNbFS', '2022-05-21 13:45:57', 4),
(2, 'fitri', 'Mrs Fitriyani', 'Banjarmasin', '1997-01-17', 'Admin CS', '087894739374', 'ftryn10@gmail.com', 'team-2.jpg', '$2y$10$lZs3/bn/zcKeUUfSLe/dE.LrXoQAqDdw9cDVtDVg2XZhTIORyPyP2', '2022-05-21 13:53:59', 4),
(3, 'Kipli', 'Mr Kiplyansyah', 'Banjarmasin', '1895-08-27', 'Pegawai', '082193745678', 'kiplyansyah22@gmail.com', 'kipli.png', '$2y$10$iwNGgqBvuEJynBRNa4buueQhq7e3zVSh4XifmsoN0SaeB06P/.6Zy', '2022-05-21 13:53:59', 4),
(4, 'andi', 'Andie S.Kom', 'Kayu Tangi', '1990-11-22', 'Dosen', '085242739374', 'abcdefg@gmail.com', '650d315866613.jpg', '$2y$10$iwNGgqBvuEJynBRNa4buueQhq7e3zVSh4XifmsoN0SaeB06P/.6Zy', '2022-06-09 22:14:45', 4),
(5, '2010010058', 'eka', 'Banjarmasin', '2002-10-22', 'Jurnalis', '08781901234', 'eka22@gmail.com', '66a84baac0177.jpg', '$2y$10$uIGpbLZ9DNLv/R9rVTWGvODn/QXzlp3B6WkpFIKLoK8WzAIDSpP.W', '2023-09-13 15:23:09', 4),
(6, 'yunita', 'Yunita Ardiani', 'Banjarmasin', '2001-05-09', 'Mahasiswa', '089737832875', 'yunita@gmail.com', '65db3a80caee6.png', '$2y$10$aFCmdNvfl0CnnF7AVGXZ0.yTf6AeWevHOELzogI3nHdOIuIL5amI2', '2023-09-22 16:16:47', 4),
(7, 'mifta', 'Mifta Nur Rahmi', 'Banjarmasin', '2002-03-01', 'Pengacara', '08765432189', 'miftanur@gmail.com', '650d568006812.jpg', '$2y$10$iwNGgqBvuEJynBRNa4buueQhq7e3zVSh4XifmsoN0SaeB06P/.6Zy', '2023-09-22 16:32:27', 4),
(8, 'budi', 'Budi Setiadi', 'Banjarmasin', '2000-01-17', 'Dosen', '08989754314', 'budi123@gmail.com', '66a84b4fe3ab7.jpg', '$2y$10$iwNGgqBvuEJynBRNa4buueQhq7e3zVSh4XifmsoN0SaeB06P/.6Zy', '2023-09-22 16:56:15', 4),
(9, 'annisa', 'Annisa Rahma', 'Banjarmasin', '2001-11-10', 'Guru', '08975314365', 'anissarahma@gmail.com', 'default.png', '$2y$10$N2cKvFvsQNh4K.ITLM7Cu.DSmWLXNZR0xiYEVTAWSQ5Gt/zyOzS.S', '2023-09-23 12:28:18', 4),
(10, 'widya', 'Widya Astuti', 'Banjarbaru', '2001-08-31', 'Mahasiswa', '08789654687', 'widya31@gmail.com', '650e6af9cdaac.jpg', '$2y$10$4QlyrFdvZKlRRPZP.9URgenuTiZkm4VVr5.nQyhv/fxALCou8PGpG', '2023-09-23 12:18:37', 4),
(12, 'putri', 'Putri Maulia Dewi', 'Barabai', '2000-04-13', 'Perawat', '087865432567', 'putrimd@gmail.com', '66a84b2ca6911.jpg', '$2y$10$g0D0ob/LEZbszY7k7qA4o.ZQWw0pohGRD/GPbJQFrCMKd9CeVoK7e', '2023-09-26 13:26:53', 4),
(14, 'andi', 'Muhammad Hidayat', 'Banjarmasin', '2000-11-22', 'Perawat', '08975325435', 'ninahdyni2202@gmail.com', 'default.png', '$2y$10$ntbiFgkdh0JNpKvNS1tmgOx1FDukk3HDjmyGpkyKq/TMCMiWvNbFS', '2023-11-13 16:39:22', 4),
(22, 'fizah', 'Hafizah Febreyana', 'Banjarmasin', '2002-02-25', 'Mahasiswa', '088242739374', 'hafizah@gmail.com', '65db397b8651b.png', '$2y$10$8UN/2ZftHVAJFBBdWhKnfOC6jV8Y2I01U2q3eMoTFiZ6m59dPuiKy', '2024-02-25 20:52:40', 4),
(23, 'siska', 'Siska Sari', 'Banjarbaru', '2002-03-12', 'Mahasiswa', '087890123456', 'siska123@gmail.com', '65fce98bf31d2.jpg', '$2y$10$Zc324BvpT8veo1a/SjoPJetQHqKzB/ei8mv2MP73KSyNbbJ3FhxcW', '2024-03-22 10:01:59', 4),
(27, 'muthiafarida', 'Muthia Farida', 'Banjarmasin', '2024-07-18', 'Dosen', '082153097097', 'muthiafarida59@gmail.com', '669b5fe748abf.jpg', '$2y$10$Me/3NvseUlXQ8KOUiZCSieeBr2dJSnp.zr2yPup9kQgm7IGxVnO7a', '2024-07-18 15:10:00', 4);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `bagian`
--
ALTER TABLE `bagian`
  ADD PRIMARY KEY (`id_bagian`);

--
-- Indeks untuk tabel `evaluasi`
--
ALTER TABLE `evaluasi`
  ADD PRIMARY KEY (`id_evaluasi`),
  ADD KEY `evaluasi_ibfk_1` (`id`);

--
-- Indeks untuk tabel `pendaftaran`
--
ALTER TABLE `pendaftaran`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pendaftaran_ibfk_1` (`id_user`),
  ADD KEY `pendaftaran_ibfk_2` (`id_program`),
  ADD KEY `pendaftaran_ibfk_3` (`id_team`);

--
-- Indeks untuk tabel `program`
--
ALTER TABLE `program`
  ADD PRIMARY KEY (`id_program`);

--
-- Indeks untuk tabel `promo`
--
ALTER TABLE `promo`
  ADD PRIMARY KEY (`id_promo`),
  ADD KEY `id_program` (`id_program`);

--
-- Indeks untuk tabel `registrasi`
--
ALTER TABLE `registrasi`
  ADD PRIMARY KEY (`id_registrasi`),
  ADD KEY `id_user` (`id_user`);

--
-- Indeks untuk tabel `sertifikat`
--
ALTER TABLE `sertifikat`
  ADD PRIMARY KEY (`id_sertifikat`),
  ADD KEY `sertifikat_ibfk_1` (`id`);

--
-- Indeks untuk tabel `tbl_admin`
--
ALTER TABLE `tbl_admin`
  ADD PRIMARY KEY (`id_admin`),
  ADD KEY `id_bagian` (`id_bagian`);

--
-- Indeks untuk tabel `team`
--
ALTER TABLE `team`
  ADD PRIMARY KEY (`id_team`),
  ADD KEY `id_bagian` (`id_bagian`);

--
-- Indeks untuk tabel `testimonial`
--
ALTER TABLE `testimonial`
  ADD PRIMARY KEY (`id_testi`),
  ADD KEY `id_user` (`id_user`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`),
  ADD KEY `id_bagian` (`id_bagian`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `bagian`
--
ALTER TABLE `bagian`
  MODIFY `id_bagian` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `evaluasi`
--
ALTER TABLE `evaluasi`
  MODIFY `id_evaluasi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT untuk tabel `pendaftaran`
--
ALTER TABLE `pendaftaran`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT untuk tabel `program`
--
ALTER TABLE `program`
  MODIFY `id_program` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `promo`
--
ALTER TABLE `promo`
  MODIFY `id_promo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `registrasi`
--
ALTER TABLE `registrasi`
  MODIFY `id_registrasi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=76;

--
-- AUTO_INCREMENT untuk tabel `sertifikat`
--
ALTER TABLE `sertifikat`
  MODIFY `id_sertifikat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `tbl_admin`
--
ALTER TABLE `tbl_admin`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `team`
--
ALTER TABLE `team`
  MODIFY `id_team` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT untuk tabel `testimonial`
--
ALTER TABLE `testimonial`
  MODIFY `id_testi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `evaluasi`
--
ALTER TABLE `evaluasi`
  ADD CONSTRAINT `evaluasi_ibfk_1` FOREIGN KEY (`id`) REFERENCES `pendaftaran` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `pendaftaran`
--
ALTER TABLE `pendaftaran`
  ADD CONSTRAINT `pendaftaran_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pendaftaran_ibfk_2` FOREIGN KEY (`id_program`) REFERENCES `program` (`id_program`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pendaftaran_ibfk_3` FOREIGN KEY (`id_team`) REFERENCES `team` (`id_team`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `promo`
--
ALTER TABLE `promo`
  ADD CONSTRAINT `promo_ibfk_1` FOREIGN KEY (`id_program`) REFERENCES `program` (`id_program`);

--
-- Ketidakleluasaan untuk tabel `registrasi`
--
ALTER TABLE `registrasi`
  ADD CONSTRAINT `registrasi_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `sertifikat`
--
ALTER TABLE `sertifikat`
  ADD CONSTRAINT `sertifikat_ibfk_1` FOREIGN KEY (`id`) REFERENCES `pendaftaran` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `tbl_admin`
--
ALTER TABLE `tbl_admin`
  ADD CONSTRAINT `tbl_admin_ibfk_1` FOREIGN KEY (`id_bagian`) REFERENCES `bagian` (`id_bagian`) ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `team`
--
ALTER TABLE `team`
  ADD CONSTRAINT `team_ibfk_1` FOREIGN KEY (`id_bagian`) REFERENCES `bagian` (`id_bagian`);

--
-- Ketidakleluasaan untuk tabel `testimonial`
--
ALTER TABLE `testimonial`
  ADD CONSTRAINT `testimonial_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`id_bagian`) REFERENCES `bagian` (`id_bagian`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
