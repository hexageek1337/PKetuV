--
-- Table structure for table `candidate`
--
DROP TABLE IF EXISTS `candidate`;
CREATE TABLE `candidate` (
  `id_candidate` int(11) NOT NULL,
  `id_pengguna` int(11) NOT NULL,
  `nama_candidate` varchar(255) NOT NULL,
  `hasil_candidate` double NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `candidate`
--

INSERT INTO `candidate` (`id_candidate`, `id_pengguna`, `nama_candidate`, `hasil_candidate`) VALUES
(1, 2, 'Dadang', 0),
(2, 3, 'Dudung', 0),
(3, 4, 'Mamat', 0);

-- --------------------------------------------------------

--
-- Table structure for table `criteria`
--
DROP TABLE IF EXISTS `criteria`;
CREATE TABLE `criteria` (
  `id_kriteria` int(11) NOT NULL,
  `nama_kriteria` varchar(255) NOT NULL,
  `tipe_kriteria` varchar(10) NOT NULL,
  `bobot_kriteria` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `criteria`
--

INSERT INTO `criteria` (`id_kriteria`, `nama_kriteria`, `tipe_kriteria`, `bobot_kriteria`) VALUES
(1, 'Kepemimpinan', 'benefit', 0.25),
(2, 'Kewibawaan', 'benefit', 0.2),
(3, 'Moral', 'benefit', 0.2),
(4, 'Pendidikan', 'benefit', 0.1),
(5, 'KKN', 'cost', 0.15),
(6, 'Umur', 'cost', 0.1);

-- --------------------------------------------------------

--
-- Table structure for table `value`
--
DROP TABLE IF EXISTS `value`;
CREATE TABLE `value` (
  `id_nilai` int(6) NOT NULL,
  `ket_nilai` varchar(45) NOT NULL,
  `jum_nilai` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `value`
--

INSERT INTO `value` (`id_nilai`, `ket_nilai`, `jum_nilai`) VALUES
(1, 'Baik', 80),
(2, 'Sangat Baik', 90),
(3, 'Cukup Baik', 70),
(4, 'Buruk', 60);

-- --------------------------------------------------------

--
-- Table structure for table `pengguna`
--
DROP TABLE IF EXISTS `pengguna`;
CREATE TABLE `pengguna` (
  `id_pengguna` int(11) NOT NULL,
  `kode_anggota` varchar(6) NULL,
  `nama_lengkap` varchar(255) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `role` ENUM('Admin','Peserta','Voter') NOT NULL DEFAULT 'Peserta'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `pengguna`
--

INSERT INTO `pengguna` (`id_pengguna`, `kode_anggota`, `nama_lengkap`, `username`, `password`, `role`) VALUES
(1, '', 'Hanif', 'admin', '21232f297a57a5a743894a0e4a801fc3','Admin'),
(2, '', 'Dadang', 'pesertasatu', '21232f297a57a5a743894a0e4a801fc3','Peserta'),
(3, '', 'Dudung', 'pesertadua', '21232f297a57a5a743894a0e4a801fc3','Peserta'),
(4, '', 'Mamat', 'pesertatiga', '21232f297a57a5a743894a0e4a801fc3','Peserta'),
(5, 'ASG001', 'Aku Voter', 'votersatu', '21232f297a57a5a743894a0e4a801fc3','Voter'),
(6, 'ASG001', 'Dia Voter', 'voterdua', '21232f297a57a5a743894a0e4a801fc3','Voter');

--
-- Table structure for table `anggota`
--
DROP TABLE IF EXISTS `anggota`;
CREATE TABLE `anggota` (
  `kode_anggota` varchar(6) NOT NULL,
  `nama_anggota` varchar(50) NOT NULL,
  `limit_anggota` int(11) NOT NULL,
  `deadline` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `anggota`
--

INSERT INTO `anggota` (`kode_anggota`, `nama_anggota`, `limit_anggota`, `deadline`) VALUES
('ASG001', 'Assisigoing', 3, '2020-01-10');

-- --------------------------------------------------------

--
-- Table structure for table `ranking`
--
DROP TABLE IF EXISTS `ranking`;
CREATE TABLE `ranking` (
  `id_candidate` int(11) NOT NULL,
  `id_kriteria` int(11) NOT NULL,
  `nilai_rangking` double NOT NULL,
  `nilai_normalisasi` double NULL,
  `bobot_normalisasi` double NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Table structure for table `voting`
--
DROP TABLE IF EXISTS `voting`;
CREATE TABLE `voting` (
  `id_candidate` int(11) NOT NULL,
  `id_kriteria` int(11) NOT NULL,
  `id_pengguna` int(11) NOT NULL,
  `nilai_voting` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `candidate`
--
ALTER TABLE `candidate`
  ADD PRIMARY KEY (`id_candidate`,`id_pengguna`);

--
-- Indexes for table `criteria`
--
ALTER TABLE `criteria`
  ADD PRIMARY KEY (`id_kriteria`);

--
-- Indexes for table `value`
--
ALTER TABLE `value`
  ADD PRIMARY KEY (`id_nilai`);

--
-- Indexes for table `anggota`
--
ALTER TABLE `anggota`
  ADD PRIMARY KEY (`kode_anggota`);

--
-- Indexes for table `pengguna`
--
ALTER TABLE `pengguna`
  ADD PRIMARY KEY (`id_pengguna`),
  ADD KEY `kode_anggota` (`kode_anggota`);

--
-- Indexes for table `ranking`
--
ALTER TABLE `ranking`
  ADD PRIMARY KEY (`id_candidate`,`id_kriteria`),
  ADD KEY `id_kriteria` (`id_kriteria`);

ALTER TABLE `voting`
  ADD PRIMARY KEY (`id_candidate`,`id_kriteria`,`id_pengguna`),
  ADD KEY `id_pengguna` (`id_pengguna`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `candidate`
--
ALTER TABLE `candidate`
  MODIFY `id_candidate` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `criteria`
--
ALTER TABLE `criteria`
  MODIFY `id_kriteria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `value`
--
ALTER TABLE `value`
  MODIFY `id_nilai` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `pengguna`
--
ALTER TABLE `pengguna`
  MODIFY `id_pengguna` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `candidate`
--
ALTER TABLE `candidate`
	ADD CONSTRAINT `candidate_ibfk_1` FOREIGN KEY (`id_pengguna`) REFERENCES `pengguna` (`id_pengguna`);

--
-- Constraints for table `ranking`
--
ALTER TABLE `ranking`
	ADD CONSTRAINT `rangking_ibfk_1` FOREIGN KEY (`id_candidate`) REFERENCES `candidate` (`id_candidate`),
	ADD CONSTRAINT `rangking_ibfk_2` FOREIGN KEY (`id_kriteria`) REFERENCES `criteria` (`id_kriteria`);

ALTER TABLE `voting`
	ADD CONSTRAINT `candidatevotingFK` FOREIGN KEY (`id_candidate`) REFERENCES `candidate`(`id_candidate`),
	ADD CONSTRAINT `criteriavotingFK` FOREIGN KEY (`id_kriteria`) REFERENCES `criteria`(`id_kriteria`),
	ADD CONSTRAINT `penggunavotingFK` FOREIGN KEY (`id_pengguna`) REFERENCES `pengguna`(`id_pengguna`);