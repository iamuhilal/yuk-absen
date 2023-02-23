-- User
CREATE TABLE `tb_user` (
  `id_user` int NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `nama_user` varchar(70) NOT NULL,
  `email_user` varchar(50) NOT NULL,
  `pass_user` varchar(70) NOT NULL,
  PRIMARY KEY(id_user)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

ALTER TABLE tb_user AUTO_INCREMENT=1;

---------------------------------------------------------------------------------------------------

-- Maker

CREATE TABLE `tb_maker` (
  `id_maker` int NOT NULL AUTO_INCREMENT,
  `id_user` int NOT NULL,
  `absenkey` varchar(100) NOT NULL,
  `title_absen` varchar(50) NOT NULL,
  `desc_absen` varchar(255),
  `time_end` datetime NOT NULL,
  `status` bit NOT NULL, --jika TRUE maka on progress, jika FALSE maka end
  PRIMARY KEY(id_maker)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

ALTER TABLE tb_maker AUTO_INCREMENT=1;

ALTER TABLE `tb_maker`
  ADD KEY `user_maker_fk1` (`id_user`);

ALTER TABLE `tb_maker`
  ADD CONSTRAINT `user_maker_fk1` FOREIGN KEY (`id_user`) REFERENCES `tb_user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;

-----------------------------------------------------------------------------------------------------


-- Absensi

CREATE TABLE `tb_absen` (
  `id_absen` int NOT NULL AUTO_INCREMENT,
  `id_maker` int NOT NULL,
  `nama_mhs` varchar(75) NOT NULL,
  `npm_mhs` varchar(50) NOT NULL,
  PRIMARY KEY(id_absen)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

ALTER TABLE tb_absen AUTO_INCREMENT=1;

ALTER TABLE `tb_absen`
  ADD KEY `maker_absen_fk1` (`id_maker`);

ALTER TABLE `tb_absen`
  ADD CONSTRAINT `maker_absen_fk1` FOREIGN KEY (`id_maker`) REFERENCES `tb_maker` (`id_maker`) ON DELETE CASCADE ON UPDATE CASCADE;
