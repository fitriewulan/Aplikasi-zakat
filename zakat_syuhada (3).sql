-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 29 Mar 2019 pada 05.05
-- Versi Server: 10.1.25-MariaDB
-- PHP Version: 7.0.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `zakat_syuhada`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `admin`
--

CREATE TABLE `admin` (
  `id_admin` int(11) NOT NULL,
  `username_admin` varchar(255) NOT NULL,
  `password_admin` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `admin`
--

INSERT INTO `admin` (`id_admin`, `username_admin`, `password_admin`) VALUES
(1, 'admin1', 'd033e22ae348aeb5660fc2140aec35850c4da997');

-- --------------------------------------------------------

--
-- Struktur dari tabel `amil`
--

CREATE TABLE `amil` (
  `id_amil` int(11) NOT NULL,
  `id_admin` int(11) NOT NULL,
  `nama_amil` varchar(255) NOT NULL,
  `alamat_amil` text NOT NULL,
  `no_hp_amil` varchar(12) NOT NULL,
  `username_amil` varchar(255) NOT NULL,
  `password_amil` varchar(255) NOT NULL,
  `status_amil` enum('aktif','nonaktif','','') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `amil`
--

INSERT INTO `amil` (`id_amil`, `id_admin`, `nama_amil`, `alamat_amil`, `no_hp_amil`, `username_amil`, `password_amil`, `status_amil`) VALUES
(2, 1, 'Fitri Wulandari', 'kp. payangan rt 04/07 bekasi', '081317712465', 'fitriwulan', 'caf44ddde50ed749bfe6b875a528c6ca7248d4d4', 'nonaktif'),
(3, 1, 'Diah Amalia Iksanti', 'kp payangan rt 04/07', '081317223922', 'diahamalia', '98f5799ad096ba59821da014de21180856962aa9', 'aktif'),
(4, 1, 'Prihatin Nur Cahya', 'Sragen', '08131771242', 'prihatin', 'c25e917e4594b3487222490b44244254d55ac15c', 'aktif'),
(5, 1, 'Utami Warna Sari', 'Jl. I Dewa Nyoman Oka No.13, Kotabaru, Gondokusuman, Kota Yogyakarta, Daerah Istimewa Yogyakarta 55224', '081317712464', 'utami', '10fd5106659cd98221c27a892fdfe9b25a374aa3', 'aktif'),
(7, 1, 'amil1', 'yogyakarta', '081317712982', 'amil1', '80380b82ddec98932b3d7fac680b2a9f85e777aa', 'aktif'),
(8, 1, 'istiqomah', 'sleman condongcaatur yogyakarta', '081317712462', 'astiqomah', '444a0c2338ed80c0634c0de673ce3c5cf865fb83', 'aktif');

-- --------------------------------------------------------

--
-- Struktur dari tabel `detail_tagihan`
--

CREATE TABLE `detail_tagihan` (
  `id_tagihan` int(11) NOT NULL,
  `id_harta` int(11) NOT NULL,
  `bayar_zakat` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `detail_tagihan`
--

INSERT INTO `detail_tagihan` (`id_tagihan`, `id_harta`, `bayar_zakat`) VALUES
(221, 104, 1657500),
(223, 102, 225000),
(224, 107, 32000000),
(224, 105, 1399500),
(225, 111, 275000),
(226, 118, 187500),
(227, 116, 30000000),
(227, 117, 554800),
(228, 120, 18000000),
(242, 129, 170000),
(243, 134, 212500),
(244, 122, 200000),
(245, 128, 2500000),
(246, 126, 200000),
(247, 114, 162500),
(248, 129, 170000),
(249, 135, 175000),
(249, 136, 1665000),
(255, 140, 30000000),
(256, 139, 2750000),
(257, 137, 2750000),
(258, 143, 317500),
(259, 144, 2750000),
(260, 139, 2750000),
(261, 145, 1375000),
(262, 146, 1375000),
(263, 149, 175000),
(265, 151, 4156250),
(267, 154, 8312500);

-- --------------------------------------------------------

--
-- Struktur dari tabel `harta`
--

CREATE TABLE `harta` (
  `id_harta` int(11) NOT NULL,
  `id_ket` int(11) NOT NULL,
  `id_muzaki` int(11) NOT NULL,
  `bruto_harta` int(11) NOT NULL,
  `total_harta` int(11) NOT NULL,
  `waktu_zakat` date NOT NULL,
  `bulan_Hijriah` varchar(255) NOT NULL,
  `status_harta` enum('aktif','non aktif','','') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `harta`
--

INSERT INTO `harta` (`id_harta`, `id_ket`, `id_muzaki`, `bruto_harta`, `total_harta`, `waktu_zakat`, `bulan_Hijriah`, `status_harta`) VALUES
(101, 7, 43, 0, 0, '0000-00-00', '9', 'aktif'),
(102, 1, 43, 13000000, 9000000, '0000-00-00', '8', 'non aktif'),
(104, 3, 43, 100, 100, '2018-05-05', '8', 'non aktif'),
(105, 4, 43, 5000, 5000, '2018-05-04', '8', 'non aktif'),
(106, 5, 43, 500, 500, '2018-05-11', '8', 'non aktif'),
(107, 6, 43, 80000, 80000, '2018-05-05', '8', 'non aktif'),
(108, 7, 44, 0, 0, '1596-09-01', '9', 'aktif'),
(109, 5, 44, 90, 90, '2018-05-08', '8', 'aktif'),
(110, 7, 45, 0, 0, '1596-09-01', '9', 'aktif'),
(111, 1, 45, 13000000, 11000000, '2018-05-06', '8', 'aktif'),
(112, 1, 44, 6000000, 1000000, '2018-05-08', '8', 'aktif'),
(113, 7, 46, 0, 0, '1596-09-01', '9', 'aktif'),
(114, 1, 46, 10000000, 6500000, '2018-05-07', '8', 'aktif'),
(115, 7, 47, 0, 0, '1596-09-01', '9', 'aktif'),
(116, 5, 47, 50, 50, '2018-05-07', '8', 'aktif'),
(117, 4, 47, 2000, 2000, '2018-05-08', '8', 'aktif'),
(118, 1, 47, 12000000, 7500000, '2018-05-09', '8', 'aktif'),
(119, 7, 48, 0, 0, '1596-09-01', '9', 'aktif'),
(120, 2, 48, 720000000, 720000000, '2018-05-12', '8', 'aktif'),
(121, 7, 49, 0, 0, '1596-09-01', '9', 'aktif'),
(122, 1, 49, 12000000, 8000000, '2018-05-02', '8', 'aktif'),
(123, 7, 50, 0, 0, '1596-09-01', '9', 'aktif'),
(124, 7, 51, 0, 0, '1596-09-01', '9', 'aktif'),
(125, 7, 52, 0, 0, '1596-09-01', '9', 'aktif'),
(126, 1, 52, 12000000, 8000000, '2018-05-16', '9', 'aktif'),
(127, 7, 53, 0, 0, '1596-09-01', '9', 'aktif'),
(128, 2, 53, 100000000, 100000000, '2018-05-07', '8', 'aktif'),
(129, 1, 48, 8000000, 6800000, '2018-05-10', '8', 'aktif'),
(130, 7, 54, 0, 0, '1596-09-01', '9', 'aktif'),
(134, 1, 54, 12000000, 8500000, '2018-05-10', '8', 'aktif'),
(135, 1, 51, 9000000, 7000000, '2018-05-10', '8', 'aktif'),
(136, 3, 51, 100, 100, '2018-05-10', '8', 'aktif'),
(137, 4, 51, 10000, 10000, '2018-05-10', '8', 'aktif'),
(138, 7, 55, 0, 0, '1596-09-05', '9', 'aktif'),
(139, 3, 55, 200, 200, '2016-05-13', '8', 'aktif'),
(140, 5, 55, 50, 50, '2018-05-14', '8', 'aktif'),
(141, 7, 56, 0, 0, '1596-09-05', '9', 'aktif'),
(142, 7, 56, 0, 0, '1596-09-05', '9', 'aktif'),
(143, 1, 50, 7000000, 4500000, '2018-05-15', '8', 'aktif'),
(144, 3, 50, 200, 200, '2018-05-13', '8', 'aktif'),
(145, 4, 46, 5000, 5000, '2018-05-14', '8', 'aktif'),
(146, 3, 49, 100, 100, '2018-05-14', '8', 'aktif'),
(147, 7, 57, 0, 0, '1596-09-05', '9', 'aktif'),
(148, 7, 58, 0, 0, '1596-09-05', '9', 'aktif'),
(149, 1, 58, 10000000, 7000000, '2018-05-14', '8', 'aktif'),
(150, 7, 59, 0, 0, '1596-09-05', '9', 'aktif'),
(151, 3, 59, 250, 250, '2018-05-15', '8', 'aktif'),
(152, 7, 60, 0, 0, '1596-09-05', '9', 'aktif'),
(154, 3, 60, 500, 500, '2018-07-15', '11', 'aktif'),
(155, 6, 60, 70, 70, '2018-07-15', '11', 'aktif'),
(156, 5, 60, 50, 50, '2018-07-15', '11', 'aktif'),
(157, 7, 61, 0, 0, '1596-09-05', '9', 'aktif'),
(158, 1, 61, 11000000, 7800000, '2018-09-28', '1', 'aktif');

-- --------------------------------------------------------

--
-- Struktur dari tabel `harta_peternakan`
--

CREATE TABLE `harta_peternakan` (
  `id_harta` int(11) NOT NULL,
  `umur1` int(11) NOT NULL,
  `umur2` int(11) NOT NULL,
  `harga_1` int(11) NOT NULL,
  `harga_2` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `harta_peternakan`
--

INSERT INTO `harta_peternakan` (`id_harta`, `umur1`, `umur2`, `harga_1`, `harga_2`) VALUES
(106, 11, 2, 10000000, 20000000),
(107, 8, 0, 4000000, 0),
(109, 2, 3, 10000000, 10000000),
(116, 1, 1, 10000000, 20000000),
(140, 1, 1, 10000000, 20000000),
(155, 1, 0, 5000000, 0),
(156, 1, 1, 10000000, 20000000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `ketentuan_zakat`
--

CREATE TABLE `ketentuan_zakat` (
  `id_ket` int(11) NOT NULL,
  `jenis_zakat` enum('zakat profesi','zakat perniagaan','zakat emas','zakat perak','zakat pertenakan','zakat fitrah') NOT NULL,
  `nisab` int(11) NOT NULL,
  `harga_satuan` int(11) NOT NULL,
  `jenis_nisab` enum('Emas','Perak','Beras','Sapi','Kambing') DEFAULT NULL,
  `haul` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `ketentuan_zakat`
--

INSERT INTO `ketentuan_zakat` (`id_ket`, `jenis_zakat`, `nisab`, `harga_satuan`, `jenis_nisab`, `haul`) VALUES
(1, 'zakat profesi', 520, 12000, 'Beras', 0),
(2, 'zakat perniagaan', 85, 665000, 'Emas', 12),
(3, 'zakat emas', 85, 665000, 'Emas', 12),
(4, 'zakat perak', 520, 10996, 'Perak', 12),
(5, 'zakat pertenakan', 30, 0, 'Sapi', 12),
(6, 'zakat pertenakan', 40, 0, 'Kambing', 12),
(7, 'zakat fitrah', 0, 12000, 'Beras', 12);

-- --------------------------------------------------------

--
-- Struktur dari tabel `muzaki`
--

CREATE TABLE `muzaki` (
  `id_muzaki` int(11) NOT NULL,
  `nama_muzaki` varchar(255) NOT NULL,
  `alamat_muzaki` text NOT NULL,
  `no_hp_muzaki` varchar(12) NOT NULL,
  `foto_muzaki` varchar(225) NOT NULL,
  `email_muzaki` varchar(255) NOT NULL,
  `password_muzaki` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `muzaki`
--

INSERT INTO `muzaki` (`id_muzaki`, `nama_muzaki`, `alamat_muzaki`, `no_hp_muzaki`, `foto_muzaki`, `email_muzaki`, `password_muzaki`) VALUES
(43, 'Fitri wulandari', 'kp. payangan Rt 04/07 jatisari jatiasih kotabekasi', '081317712465', 'coba@cobacom.jpg', 'coba@coba.com', '0e1964ed5f54a93f8d277168bde81e11e0b5b0f1'),
(44, 'prihatin nur cahya', 'Condongcatur depok sleman Yogyakarta', '081273849872', 'cahya@cobacoba.JPG', 'cahya@coba.coba', 'c25e917e4594b3487222490b44244254d55ac15c'),
(45, 'Coba', 'jl. waringin', '085647880111', 'coba@ccom.JPG', 'coba@c.com', 'caf44ddde50ed749bfe6b875a528c6ca7248d4d4'),
(46, 'Istiqomah R', 'kp. payangan Rt 04/07 jatisari jatiasih kotabekasi', '085647880247', 'istiqomah@syuhadacc.jpg', 'istiqomah@syuhada.cc', '444a0c2338ed80c0634c0de673ce3c5cf865fb83'),
(47, 'Suwarno', 'kp. payangan Rt 04/07 jatisari jatiasih kotabekasi', '085647880112', 'suwarno@syuhadacc.JPG', 'suwarno@syuhada.cc', 'd9b7e7bff6f437039ea8fb453cb42d6e76644684'),
(48, 'Tri Ismono', 'solo jawatengah', '082371923822', 'triismono@cccc.jpg', 'triismono@cc.cc', '5d41e2a269c893cb4b028ec3f3300dd03a40b981'),
(49, 'Agus Purnomo', 'krangngan bekasi', '082371923823', 'aguspurnomo@syuhadalcc.jpg', 'aguspurnomo@syuhadal.cc', 'd24a21eedd5385b72d6a1f6c0992bbad8c8c1ac5'),
(50, 'Muhamad Warisno', 'kp. payangan Rt 04/07 jatisari jatiasih kotabekasi', '082371923824', 'muhamadwarisno@syuhadacc.jpg', 'muhamadwarisno@syuhada.cc', '18d31333883daa8e8289ff1595802f8a5b57fe8c'),
(51, 'Utami Warna Sari', 'kp. payangan Rt 04/07 jatisari jatiasih kotabekasi', '085647880219', 'utami@syhudacc.jpg', 'utami@syhuda.cc', 'be53cf3a04aa710317f43fddd2f80d003f444a42'),
(52, 'Arif Sujatmiko', 'desa sawungan bantul yogyakarta', '081273849873', 'arifsujat@syuhadalcc.jpg', 'arifsujat@syuhadal.cc', 'd2f90e13e14b086aef724d4e73bcfa669d0667a5'),
(53, 'Azizatun Nurrohmah', 'desa sawungan bantul yogyakarta', '081273849874', 'azizatun@syuhadacc.JPG', 'azizatun@syuhada.cc', 'f3374edd4083328d63a6e17c4337f5ab1ea9e2c2'),
(54, 'Andika saputra', 'bantul yogyakarta', '085647880248', 'andikasaputraid@gmailcom.jpg', 'andikasaputra.id@gmail.com', '18551ce82831879059639fe7d91cc606e5b5dcaa'),
(55, 'H.A Junprahadi', 'yogyakarta', '08122715254', 'ha_junprahadi@syhadacc.jpg', 'junPrahadi@syhada.cc', '7a05818bf95ff6c69c883b6bf2f88be4032a478f'),
(56, 'cgjvj', 'hcxbvjlbdf', '085647880134', 'fitriwulandaru@gmailcom.JPG', 'fitriwulandaru@gmail.com', '0e1964ed5f54a93f8d277168bde81e11e0b5b0f1'),
(57, 'Djoko Intarto', 'jl. A. Jazuli N0 69 Yogyakarta', '08122721333', 'djoko@syuhdacc.jpg', 'Djoko@syuhda.cc', '6bc17527328e28dabe83fb349d962ee7f03e3ce4'),
(58, 'Sandra Lukita sari', 'jl. samirono baru n0 144 caturtunggal', '62861556045', 'sandra@syuhadacc1.png', 'sandra@syuhada.cc', '8fb8c165efd1ef5a826439dcde088b236e304d6c'),
(59, 'R. Novi Yanti', 'Kantor Bank Panin', '08112928381', 'novi@syuhadacc.png', 'Novi@syuhada.cc', '2d19f8a42bf25076da7eec21868b4878d5321186'),
(60, 'Siti Soimah', 'Wonosobo', '08192910012', 'siti@oimcom.png', 'siti@oim.com', '342f5583ed8e0ba9f9fe3babf65c3142ac4da854'),
(61, 'Muhamad Warisno', 'Kp. payangan Bekasi', '085647880678', 'warisno@coacom.jpg', 'warisno@coa.com', '18d31333883daa8e8289ff1595802f8a5b57fe8c');

-- --------------------------------------------------------

--
-- Struktur dari tabel `no_rek`
--

CREATE TABLE `no_rek` (
  `id_rek` int(11) NOT NULL,
  `id_admin` int(11) NOT NULL,
  `nama_bank` varchar(255) NOT NULL,
  `no_rek` varchar(255) NOT NULL,
  `nama_rek` varchar(255) NOT NULL,
  `Icon_bank` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `no_rek`
--

INSERT INTO `no_rek` (`id_rek`, `id_admin`, `nama_bank`, `no_rek`, `nama_rek`, `Icon_bank`) VALUES
(6, 1, 'Mandiri Syariah', '7088367248', 'LAZIS MASJID SYUHADA', 'mandiri-syariah.png'),
(7, 1, 'BNI Syariah', '0411112324', 'LAZIS MASJID SYUHADA', 'bni-syariah.png'),
(8, 1, 'Bank Muamalat', '5350007000', 'LAZIS MASJID SYUHADA', 'bank-muamalat.png');

-- --------------------------------------------------------

--
-- Struktur dari tabel `preferences`
--

CREATE TABLE `preferences` (
  `id` int(11) NOT NULL,
  `type` varchar(150) NOT NULL,
  `name` varchar(150) NOT NULL,
  `value` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `preferences`
--

INSERT INTO `preferences` (`id`, `type`, `name`, `value`) VALUES
(1, 'site', 'site_name', 'Lazis Syuhada'),
(2, 'site', 'site_description', 'Tunaikan Zakat LAZIS SYUHADA'),
(3, 'email', 'smtp_host', 'ssl://smtp.googlemail.com'),
(4, 'email', 'smtp_port', '465'),
(5, 'email', 'smtp_user', 'fitriwulandaru@gmail.com'),
(7, 'email', 'smtp_pass', 'cobalagi');

-- --------------------------------------------------------

--
-- Struktur dari tabel `profil_lazis`
--

CREATE TABLE `profil_lazis` (
  `id_lazis` int(11) NOT NULL,
  `id_admin` int(11) NOT NULL,
  `nama_lazis` varchar(255) NOT NULL,
  `alamat_lazis` text NOT NULL,
  `whatsapp` varchar(255) NOT NULL,
  `facebook` varchar(255) NOT NULL,
  `bbm` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `profil_lazis`
--

INSERT INTO `profil_lazis` (`id_lazis`, `id_admin`, `nama_lazis`, `alamat_lazis`, `whatsapp`, `facebook`, `bbm`) VALUES
(1, 1, 'Lazis Syuhada', 'Jl. I Dewa Nyoman Oka No.13, Kotabaru, Gondokusuman, Kota Yogyakarta, Daerah Istimewa Yogyakarta 55224  ', '+6285600888108', 'Lazis Syuhada', '5FE78C4A');

-- --------------------------------------------------------

--
-- Struktur dari tabel `simpanan`
--

CREATE TABLE `simpanan` (
  `id_muzaki` int(11) NOT NULL,
  `saldo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tagihan`
--

CREATE TABLE `tagihan` (
  `id_tagihan` int(11) NOT NULL,
  `tgl_tagihan` date NOT NULL,
  `jangka_waktu` date NOT NULL,
  `status` enum('yes','no','','') NOT NULL,
  `total_tagihan` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tagihan`
--

INSERT INTO `tagihan` (`id_tagihan`, `tgl_tagihan`, `jangka_waktu`, `status`, `total_tagihan`) VALUES
(221, '2018-05-04', '2018-05-09', 'no', 1657500),
(223, '2018-05-04', '2018-05-06', 'yes', 225000),
(224, '2018-05-04', '2018-05-08', 'yes', 33399500),
(225, '2018-05-05', '2018-05-15', 'yes', 275000),
(226, '2018-05-07', '2018-05-17', 'yes', 187500),
(227, '2018-05-07', '2018-05-17', 'yes', 30554800),
(228, '2018-05-07', '2018-05-17', 'yes', 18000000),
(231, '2018-05-10', '2018-05-20', 'yes', 170000),
(232, '2018-05-10', '2018-05-20', 'yes', 170000),
(233, '2018-05-10', '2018-05-20', 'yes', 170000),
(234, '2018-05-10', '2018-05-20', 'yes', 170000),
(235, '2018-05-10', '2018-05-20', 'yes', 170000),
(236, '2018-05-10', '2018-05-20', 'yes', 170000),
(237, '2018-05-10', '2018-05-20', 'yes', 170000),
(238, '2018-05-10', '2018-05-20', 'yes', 170000),
(239, '2018-05-10', '2018-05-20', 'yes', 170000),
(240, '2018-05-10', '2018-05-20', 'yes', 170000),
(241, '2018-05-10', '2018-05-20', 'yes', 170000),
(242, '2018-05-10', '2018-05-20', 'yes', 170000),
(243, '2018-05-10', '2018-05-20', 'yes', 212500),
(244, '2018-05-10', '2018-05-20', 'yes', 200000),
(245, '2018-05-10', '2018-05-20', 'yes', 2500000),
(246, '2018-05-10', '2018-05-20', 'yes', 200000),
(247, '2018-05-10', '2018-05-11', 'yes', 162500),
(248, '2018-05-10', '2018-05-12', 'yes', 170000),
(249, '2018-05-10', '2018-05-20', 'yes', 1840000),
(250, '2018-05-12', '2018-05-22', 'yes', 0),
(255, '2018-05-12', '2018-05-22', 'yes', 30000000),
(256, '2018-05-12', '2018-05-22', 'yes', 2750000),
(257, '2018-05-12', '2018-05-22', 'yes', 2750000),
(258, '2018-05-12', '2018-05-22', 'yes', 317500),
(259, '2018-05-12', '2018-05-22', 'yes', 2750000),
(260, '2018-05-13', '2018-05-23', 'yes', 2750000),
(261, '2018-05-14', '2018-05-24', 'yes', 1375000),
(262, '2018-05-14', '2018-05-24', 'yes', 1375000),
(263, '2018-05-14', '2018-05-24', 'yes', 175000),
(264, '2018-05-14', '2018-05-24', 'yes', 0),
(265, '2018-05-14', '2018-05-24', 'yes', 4156250),
(267, '2018-07-15', '2018-07-25', 'yes', 8312500);

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaksi`
--

CREATE TABLE `transaksi` (
  `id_trans` int(11) NOT NULL,
  `id_tagihan` int(11) NOT NULL,
  `trans_pembayaran` int(11) NOT NULL,
  `tgl_trans` date NOT NULL,
  `nama_rek` varchar(255) NOT NULL,
  `nama_bank` varchar(255) NOT NULL,
  `bukti_trans` varchar(255) NOT NULL,
  `status` enum('waiting','done','','') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `transaksi`
--

INSERT INTO `transaksi` (`id_trans`, `id_tagihan`, `trans_pembayaran`, `tgl_trans`, `nama_rek`, `nama_bank`, `bukti_trans`, `status`) VALUES
(1, 221, 1657500, '2018-05-04', 'Fitri Wulandari', 'Mandiri Syariah', '221.jpg', 'done'),
(2, 225, 275000, '2018-05-05', 'fhfjfjhh', 'BNI syariah', '225.JPG', 'done'),
(3, 226, 187500, '2018-05-07', 'suwarno', 'BNI syariah', '226.jpg', 'done'),
(4, 228, 18000000, '2018-05-07', 'tri ismono', 'Mandiri Syariah', '228.jpg', 'done'),
(5, 242, 170000, '2018-05-10', 'Fitri Wulandari', 'Transfer ke Rekening', '242.JPG', 'done'),
(6, 227, 30554800, '2018-05-12', 'suwarno', 'Transfer ke Rekening', '227.JPG', 'done'),
(7, 258, 317500, '2018-05-14', 'warisno', 'BNI Syariah', '258.jpg', 'waiting'),
(8, 249, 184000, '2018-05-13', 'Fitri Wulandari', 'Mandiri Syariah', '249.JPG', 'waiting'),
(9, 262, 1375000, '2018-05-14', 'agus purnomo', 'Bank Muamalat', '262.JPG', 'waiting'),
(10, 265, 4156250, '2018-05-14', 'novi', 'BNI Syariah', '265.png', 'waiting');

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaksi_umum`
--

CREATE TABLE `transaksi_umum` (
  `id_trans_umum` int(11) NOT NULL,
  `id_amil` int(11) NOT NULL,
  `ambil` varchar(255) NOT NULL,
  `tgl_trans_umum` date NOT NULL,
  `jenis_transaksi` varchar(255) NOT NULL,
  `keterangan` varchar(255) NOT NULL,
  `jumlah` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `transaksi_umum`
--

INSERT INTO `transaksi_umum` (`id_trans_umum`, `id_amil`, `ambil`, `tgl_trans_umum`, `jenis_transaksi`, `keterangan`, `jumlah`) VALUES
(1, 2, 'Mandiri Syariah', '2018-05-02', 'operasional kantor', 'pembayaran listrik ', 300000),
(2, 2, 'BNI Syariah', '2018-05-09', 'Zakat Mustahik', 'memberikan zakat ke mustahik', 3000000);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indexes for table `amil`
--
ALTER TABLE `amil`
  ADD PRIMARY KEY (`id_amil`),
  ADD UNIQUE KEY `username_amil` (`username_amil`),
  ADD UNIQUE KEY `no_hp_amil` (`no_hp_amil`),
  ADD KEY `id_admin` (`id_admin`);

--
-- Indexes for table `detail_tagihan`
--
ALTER TABLE `detail_tagihan`
  ADD KEY `id_tagihan` (`id_tagihan`),
  ADD KEY `id_harta` (`id_harta`);

--
-- Indexes for table `harta`
--
ALTER TABLE `harta`
  ADD PRIMARY KEY (`id_harta`),
  ADD KEY `id_ket` (`id_ket`),
  ADD KEY `id_muzaki` (`id_muzaki`);

--
-- Indexes for table `harta_peternakan`
--
ALTER TABLE `harta_peternakan`
  ADD KEY `id_harta` (`id_harta`);

--
-- Indexes for table `ketentuan_zakat`
--
ALTER TABLE `ketentuan_zakat`
  ADD PRIMARY KEY (`id_ket`);

--
-- Indexes for table `muzaki`
--
ALTER TABLE `muzaki`
  ADD PRIMARY KEY (`id_muzaki`),
  ADD UNIQUE KEY `email_muzaki` (`email_muzaki`),
  ADD UNIQUE KEY `no_hp_muzaki` (`no_hp_muzaki`);

--
-- Indexes for table `no_rek`
--
ALTER TABLE `no_rek`
  ADD PRIMARY KEY (`id_rek`),
  ADD KEY `id_admin` (`id_admin`);

--
-- Indexes for table `preferences`
--
ALTER TABLE `preferences`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `profil_lazis`
--
ALTER TABLE `profil_lazis`
  ADD PRIMARY KEY (`id_lazis`),
  ADD KEY `id_admin` (`id_admin`);

--
-- Indexes for table `simpanan`
--
ALTER TABLE `simpanan`
  ADD KEY `id_muzaki` (`id_muzaki`);

--
-- Indexes for table `tagihan`
--
ALTER TABLE `tagihan`
  ADD PRIMARY KEY (`id_tagihan`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id_trans`),
  ADD KEY `no_konfirmasi` (`id_tagihan`);

--
-- Indexes for table `transaksi_umum`
--
ALTER TABLE `transaksi_umum`
  ADD PRIMARY KEY (`id_trans_umum`),
  ADD KEY `id_amil` (`id_amil`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `amil`
--
ALTER TABLE `amil`
  MODIFY `id_amil` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `harta`
--
ALTER TABLE `harta`
  MODIFY `id_harta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=159;
--
-- AUTO_INCREMENT for table `ketentuan_zakat`
--
ALTER TABLE `ketentuan_zakat`
  MODIFY `id_ket` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `muzaki`
--
ALTER TABLE `muzaki`
  MODIFY `id_muzaki` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;
--
-- AUTO_INCREMENT for table `no_rek`
--
ALTER TABLE `no_rek`
  MODIFY `id_rek` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `preferences`
--
ALTER TABLE `preferences`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `profil_lazis`
--
ALTER TABLE `profil_lazis`
  MODIFY `id_lazis` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `tagihan`
--
ALTER TABLE `tagihan`
  MODIFY `id_tagihan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=268;
--
-- AUTO_INCREMENT for table `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id_trans` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `transaksi_umum`
--
ALTER TABLE `transaksi_umum`
  MODIFY `id_trans_umum` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `amil`
--
ALTER TABLE `amil`
  ADD CONSTRAINT `amil_ibfk_1` FOREIGN KEY (`id_admin`) REFERENCES `admin` (`id_admin`);

--
-- Ketidakleluasaan untuk tabel `detail_tagihan`
--
ALTER TABLE `detail_tagihan`
  ADD CONSTRAINT `detail_tagihan_ibfk_1` FOREIGN KEY (`id_harta`) REFERENCES `harta` (`id_harta`),
  ADD CONSTRAINT `detail_tagihan_ibfk_2` FOREIGN KEY (`id_tagihan`) REFERENCES `tagihan` (`id_tagihan`);

--
-- Ketidakleluasaan untuk tabel `harta`
--
ALTER TABLE `harta`
  ADD CONSTRAINT `harta_ibfk_1` FOREIGN KEY (`id_muzaki`) REFERENCES `muzaki` (`id_muzaki`),
  ADD CONSTRAINT `harta_ibfk_2` FOREIGN KEY (`id_ket`) REFERENCES `ketentuan_zakat` (`id_ket`);

--
-- Ketidakleluasaan untuk tabel `harta_peternakan`
--
ALTER TABLE `harta_peternakan`
  ADD CONSTRAINT `harta_peternakan_ibfk_1` FOREIGN KEY (`id_harta`) REFERENCES `harta` (`id_harta`);

--
-- Ketidakleluasaan untuk tabel `no_rek`
--
ALTER TABLE `no_rek`
  ADD CONSTRAINT `no_rek_ibfk_1` FOREIGN KEY (`id_admin`) REFERENCES `admin` (`id_admin`);

--
-- Ketidakleluasaan untuk tabel `profil_lazis`
--
ALTER TABLE `profil_lazis`
  ADD CONSTRAINT `profil_lazis_ibfk_1` FOREIGN KEY (`id_admin`) REFERENCES `admin` (`id_admin`);

--
-- Ketidakleluasaan untuk tabel `simpanan`
--
ALTER TABLE `simpanan`
  ADD CONSTRAINT `simpanan_ibfk_1` FOREIGN KEY (`id_muzaki`) REFERENCES `muzaki` (`id_muzaki`);

--
-- Ketidakleluasaan untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  ADD CONSTRAINT `transaksi_ibfk_1` FOREIGN KEY (`id_tagihan`) REFERENCES `tagihan` (`id_tagihan`);

--
-- Ketidakleluasaan untuk tabel `transaksi_umum`
--
ALTER TABLE `transaksi_umum`
  ADD CONSTRAINT `transaksi_umum_ibfk_1` FOREIGN KEY (`id_amil`) REFERENCES `amil` (`id_amil`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
