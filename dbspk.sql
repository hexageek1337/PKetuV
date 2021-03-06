-- Database PKetuV v1.0
--
-- Table structure for  all table
--
DROP TABLE IF EXISTS `event`;
CREATE TABLE `event` (
  `kode_event` varchar(6) NOT NULL,
  `nama_event` varchar(50) NOT NULL,
  `limit_event` int(11) NOT NULL,
  `deadline` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `ranking`;
CREATE TABLE `ranking` (
  `id_candidate` int(11) NOT NULL,
  `id_kriteria` int(11) NOT NULL,
  `nilai_rangking` double NOT NULL,
  `nilai_normalisasi` double NULL,
  `bobot_normalisasi` double NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `voting`;
CREATE TABLE `voting` (
  `id_candidate` int(11) NOT NULL,
  `id_kriteria` int(11) NOT NULL,
  `id_pengguna` int(11) NOT NULL,
  `nilai_voting` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `candidate`;
CREATE TABLE `candidate` (
  `id_candidate` int(11) NOT NULL,
  `id_pengguna` int(11) NOT NULL,
  `nama_candidate` varchar(255) NOT NULL,
  `hasil_candidate` double NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `criteria`;
CREATE TABLE `criteria` (
  `id_kriteria` int(11) NOT NULL,
  `nama_kriteria` varchar(255) NOT NULL,
  `tipe_kriteria` varchar(10) NOT NULL,
  `bobot_kriteria` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `value`;
CREATE TABLE `value` (
  `id_nilai` int(6) NOT NULL,
  `ket_nilai` varchar(45) NOT NULL,
  `jum_nilai` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `pengguna`;
CREATE TABLE `pengguna` (
  `id_pengguna` int(11) NOT NULL,
  `kode_event` varchar(6) NULL,
  `nama_lengkap` varchar(255) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` ENUM('Admin','Peserta','Voter') NOT NULL DEFAULT 'Peserta'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for all table
--
INSERT INTO `event` (`kode_event`, `nama_event`, `limit_event`, `deadline`) VALUES
('PSG001', 'Paint Saint German', 3, '2020-01-25 23:59:59');

INSERT INTO `pengguna` (`id_pengguna`, `kode_event`, `nama_lengkap`, `username`, `password`, `role`) VALUES
(1, '', 'Hanif', 'admin', '$2y$10$nOhTmM0h9sJzXv5q6s7bO.53lIELJB4MqAY9AH/Yqz25yT4tRjCJe','Admin'),
(2, '', 'Dadang', 'pesertasatu', '$2y$10$DNmjxKE2Y4gO.NsMJVhNg.P.4cDOwh4mdQy5LBQil36vppj3MGjwy','Peserta'),
(3, '', 'Dudung', 'pesertadua', '$2y$10$f80vxPlA3Ur51rTTVA9SdeSb3SeGvN1UjlyIz68Q06OyKkTBL62eO','Peserta'),
(4, '', 'Mamat', 'pesertatiga', '$2y$10$XV/wS0ez9LmYOslpRrUevef389zJZkxVl0GLydLLij2VzbMPuJTjy','Peserta'),
(5, 'PSG001', 'Aku Voter', 'votersatu', '$2y$10$.jB8DSuAUFBVp84C3MIlUOCnBVwMXeCGELv8OHn2QyQvZpoaoVrrW','Voter'),
(6, 'PSG001', 'Dia Voter', 'voterdua', '$2y$10$Mclederq1bD2cI4l.wGqbeqj3VKyIfLeQgjYmpgA0BQ.p2rSiOAEi','Voter');

INSERT INTO `candidate` (`id_candidate`, `id_pengguna`, `nama_candidate`, `hasil_candidate`) VALUES
(1, 2, 'Dadang', 0),
(2, 3, 'Dudung', 0),
(3, 4, 'Mamat', 0);

INSERT INTO `criteria` (`id_kriteria`, `nama_kriteria`, `tipe_kriteria`, `bobot_kriteria`) VALUES
(1, 'Kepemimpinan', 'benefit', 0.25),
(2, 'Kewibawaan', 'benefit', 0.2),
(3, 'Moral', 'benefit', 0.2),
(4, 'Pendidikan', 'benefit', 0.1);

INSERT INTO `value` (`id_nilai`, `ket_nilai`, `jum_nilai`) VALUES
(1, 'Baik', 80),
(2, 'Sangat Baik', 90),
(3, 'Cukup Baik', 70),
(4, 'Buruk', 60);

-- --------------------------------------------------------

--
-- Indexes for dumped tables
--

ALTER TABLE `candidate`
  ADD PRIMARY KEY (`id_candidate`,`id_pengguna`);

ALTER TABLE `criteria`
  ADD PRIMARY KEY (`id_kriteria`);

ALTER TABLE `value`
  ADD PRIMARY KEY (`id_nilai`);

ALTER TABLE `event`
  ADD PRIMARY KEY (`kode_event`);

ALTER TABLE `pengguna`
  ADD PRIMARY KEY (`id_pengguna`,`kode_event`),
  ADD KEY `kode_event` (`kode_event`);

ALTER TABLE `ranking`
  ADD PRIMARY KEY (`id_candidate`,`id_kriteria`),
  ADD KEY `id_kriteria` (`id_kriteria`);

ALTER TABLE `voting`
  ADD PRIMARY KEY (`id_candidate`,`id_kriteria`,`id_pengguna`),
  ADD KEY `id_pengguna` (`id_pengguna`);

--
-- AUTO_INCREMENT for dumped tables
--

ALTER TABLE `candidate`
  MODIFY `id_candidate` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

ALTER TABLE `criteria`
  MODIFY `id_kriteria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

ALTER TABLE `value`
  MODIFY `id_nilai` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

ALTER TABLE `pengguna`
  MODIFY `id_pengguna` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- Constraints for dumped tables
--
ALTER TABLE `candidate`
	ADD CONSTRAINT `candidate_ibfk_1` FOREIGN KEY (`id_pengguna`) REFERENCES `pengguna` (`id_pengguna`) ON DELETE RESTRICT ON UPDATE RESTRICT;

ALTER TABLE `ranking`
	ADD CONSTRAINT `rangking_ibfk_1` FOREIGN KEY (`id_candidate`) REFERENCES `candidate` (`id_candidate`) ON DELETE RESTRICT ON UPDATE RESTRICT,
	ADD CONSTRAINT `rangking_ibfk_2` FOREIGN KEY (`id_kriteria`) REFERENCES `criteria` (`id_kriteria`) ON DELETE RESTRICT ON UPDATE RESTRICT;

ALTER TABLE `voting`
	ADD CONSTRAINT `candidatevotingFK` FOREIGN KEY (`id_candidate`) REFERENCES `candidate`(`id_candidate`) ON DELETE RESTRICT ON UPDATE RESTRICT,
	ADD CONSTRAINT `criteriavotingFK` FOREIGN KEY (`id_kriteria`) REFERENCES `criteria`(`id_kriteria`) ON DELETE RESTRICT ON UPDATE RESTRICT,
	ADD CONSTRAINT `penggunavotingFK` FOREIGN KEY (`id_pengguna`) REFERENCES `pengguna`(`id_pengguna`) ON DELETE RESTRICT ON UPDATE RESTRICT;