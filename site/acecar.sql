-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 18, 2023 at 05:31 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.0.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `acecar`
--

-- --------------------------------------------------------

--
-- Table structure for table `acces`
--

CREATE TABLE `acces` (
  `ID` int(11) NOT NULL,
  `Nume` varchar(64) NOT NULL,
  `Lista_acces` varchar(64) NOT NULL,
  `Imunitate` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `acces`
--

INSERT INTO `acces` (`ID`, `Nume`, `Lista_acces`, `Imunitate`) VALUES
(1, 'Angajat', 'abcdef', 10),
(2, 'Manager', 'abcdefgh', 20);

-- --------------------------------------------------------

--
-- Table structure for table `adrese`
--

CREATE TABLE `adrese` (
  `ID` int(11) NOT NULL,
  `ID_Client` int(11) NOT NULL,
  `Tara` varchar(64) NOT NULL,
  `Judet` varchar(64) NOT NULL,
  `Localitate` varchar(64) NOT NULL,
  `Strada` varchar(128) NOT NULL,
  `Numar` varchar(32) NOT NULL,
  `Bloc` varchar(32) NOT NULL,
  `Scara` varchar(32) NOT NULL,
  `Apartament` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `adrese`
--

INSERT INTO `adrese` (`ID`, `ID_Client`, `Tara`, `Judet`, `Localitate`, `Strada`, `Numar`, `Bloc`, `Scara`, `Apartament`) VALUES
(1, 3, 'Romania', 'Doljjfdfdfd', 'Craiova', 'Calea Bucurestiiii', '123A', 'a2', '3', '23');

-- --------------------------------------------------------

--
-- Table structure for table `angajati`
--

CREATE TABLE `angajati` (
  `ID` int(11) NOT NULL,
  `ID_Client` int(11) NOT NULL,
  `ID_Acces` int(11) NOT NULL,
  `Salariu` varchar(32) NOT NULL,
  `Data_promovarii` int(11) NOT NULL,
  `Data_angajarii` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `angajati`
--

INSERT INTO `angajati` (`ID`, `ID_Client`, `ID_Acces`, `Salariu`, `Data_promovarii`, `Data_angajarii`) VALUES
(1, 1, 1, '50000', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `categorie_vehicule`
--

CREATE TABLE `categorie_vehicule` (
  `ID` int(11) NOT NULL,
  `Nume` varchar(64) NOT NULL,
  `Descriere` text NOT NULL,
  `Pret_maxim` int(11) NOT NULL,
  `Pret_minim` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `categorie_vehicule`
--

INSERT INTO `categorie_vehicule` (`ID`, `Nume`, `Descriere`, `Pret_maxim`, `Pret_minim`) VALUES
(1, 'Sedan', 'test', 20000, 10000),
(2, 'Coupe', 'test', 20000, 10000),
(3, 'SUV', 'test', 20000, 10000),
(4, 'Sport', 'test', 20000, 10000),
(5, 'Minivan', 'test', 20000, 10000);

-- --------------------------------------------------------

--
-- Table structure for table `clienti`
--

CREATE TABLE `clienti` (
  `ID` int(11) NOT NULL,
  `accGoogle` varchar(128) NOT NULL DEFAULT '0',
  `Nume` varchar(512) NOT NULL,
  `Prenume` varchar(512) NOT NULL,
  `Username` varchar(512) NOT NULL,
  `Imagine` text NOT NULL,
  `Parola` varchar(128) NOT NULL,
  `Email` varchar(64) NOT NULL,
  `Data_nasterii` int(11) NOT NULL,
  `CNP` varchar(32) NOT NULL,
  `Telefon` varchar(32) NOT NULL,
  `Prima_conectare` int(11) NOT NULL,
  `Ultima_conectare` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `clienti`
--

INSERT INTO `clienti` (`ID`, `accGoogle`, `Nume`, `Prenume`, `Username`, `Imagine`, `Parola`, `Email`, `Data_nasterii`, `CNP`, `Telefon`, `Prima_conectare`, `Ultima_conectare`) VALUES
(1, '0', 'alex', 'mihai', 'test', '', 'B913D5BBB8E461C2C5961CBE0EDCDADFD29F068225CEB37DA6DEFCF89849368F8C6C2EB6A4C4AC75775D032A0ECFDFE8550573062B653FE92FC7B8FB3B7BE8D6', 'sds', 2001, '123', '123456789', 0, 1684335519),
(3, '102391754967061362157', 'alex', 'mihai', 'ShoK', 'https://lh3.googleusercontent.com/a/AGNmyxZVjVzMx0RtI6X4t_-nSGMObufwGKA5E_gwRGZbAA=s96-c', '', 'alex.am707@gmail.com', 2020, '1234', 'ShoKarON', 1683742576, 1683742576),
(4, '114440784547498476547', 'MIHAI-ALEXANDRU MĂCIUCĂ', '', '', 'https://lh3.googleusercontent.com/a/AGNmyxYNiH4A_6q48be-30muVRYNo3YdHkmrBcGhVb5nMw=s96-c', '', 'maciuca.mihai.r9d@student.ucv.ro', 0, '', '', 1683742789, 1683742789),
(5, '111858947801754453251', 'Darius', '', '', 'https://lh3.googleusercontent.com/a/AGNmyxbcSY8eFIr8yonwj8y2Pd8g9RlHiOlZnTbwI6sS=s96-c', '', 'alex.am707707707@gmail.com', 0, '', '', 1683743688, 1683743688);

-- --------------------------------------------------------

--
-- Table structure for table `filiale`
--

CREATE TABLE `filiale` (
  `ID` int(11) NOT NULL,
  `Oras` varchar(64) NOT NULL,
  `Imagine` varchar(128) NOT NULL,
  `Adresa` varchar(128) NOT NULL,
  `Telefon` varchar(32) NOT NULL,
  `Descriere` varchar(512) NOT NULL,
  `Ora_Deschidere` int(11) NOT NULL,
  `Ora_Inchidere` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `filiale`
--

INSERT INTO `filiale` (`ID`, `Oras`, `Imagine`, `Adresa`, `Telefon`, `Descriere`, `Ora_Deschidere`, `Ora_Inchidere`) VALUES
(1, 'Craiova', 'Craiova.png', 'Calea Bucuresti nr. 8', '0774405798', 'salut!', 8, 20),
(2, 'Bucuresti', 'Craiova.png', 'Calea Bucuresti nr. 8', '0774405798', 'salut!', 8, 20),
(3, 'Cluj', 'Craiova.png', 'Calea Bucuresti nr. 8', '0774405798', 'salut!', 8, 20),
(4, 'Constanta', 'Craiova.png', 'Calea Bucuresti nr. 8', '0774405798', 'salut!', 8, 20),
(5, 'Caracal', 'Craiova.png', 'Calea Caracal nr. 8', '0774405798', 'salut!', 8, 20);

-- --------------------------------------------------------

--
-- Table structure for table `inchirieri`
--

CREATE TABLE `inchirieri` (
  `ID` int(11) NOT NULL,
  `ID_Client` int(11) NOT NULL,
  `VIN_Vehicul` int(11) NOT NULL,
  `Start_inchiriere` int(11) NOT NULL,
  `Stop_inchiriere` int(11) NOT NULL,
  `Locatie_ridicare` int(2) NOT NULL,
  `Locatie_returnare` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `inchirieri`
--

INSERT INTO `inchirieri` (`ID`, `ID_Client`, `VIN_Vehicul`, `Start_inchiriere`, `Stop_inchiriere`, `Locatie_ridicare`, `Locatie_returnare`) VALUES
(1, 3, 1, 2023, 2023, 3, 4),
(2, 3, 1, 1684357200, 1684443600, 3, 2),
(3, 3, 1, 1684357200, 1684443600, 3, 2),
(4, 3, 1, 1684357200, 1684357200, 3, 3),
(5, 3, 1, 1684357200, 1684357200, 3, 4),
(6, 3, 1, 1684357200, 1684357200, 3, 4),
(7, 3, 1, 1684357200, 1684357200, 3, 5),
(8, 3, 1, 1684357200, 1684357200, 3, 4),
(9, 3, 1, 1684357200, 1684357200, 3, 4),
(10, 3, 1, 1684357200, 1684357200, 3, 4),
(11, 3, 1, 1684357200, 1684357200, 3, 4),
(12, 3, 1, 1684357200, 1684357200, 3, 4),
(13, 3, 1, 1684357200, 1684962000, 3, 1),
(14, 3, 1, 1684357200, 1684443600, 3, 3),
(15, 3, 1, 1684357200, 1684443600, 3, 4);

-- --------------------------------------------------------

--
-- Table structure for table `plati`
--

CREATE TABLE `plati` (
  `ID` int(11) NOT NULL,
  `ID_Inchirieri` int(11) NOT NULL,
  `Pret` varchar(32) NOT NULL,
  `Metoda_Plata` varchar(64) NOT NULL,
  `Stare` int(1) NOT NULL COMMENT '0 in asteptare\r\n1 confirmata\r\n2 eroare de plata',
  `Timestamp` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `plati`
--

INSERT INTO `plati` (`ID`, `ID_Inchirieri`, `Pret`, `Metoda_Plata`, `Stare`, `Timestamp`) VALUES
(1, 1, '200', '', 0, 1684372566),
(2, 1, '200', '', 0, 1684372603),
(3, 11, '200', '', 0, 1684372893),
(4, 12, '200', '', 0, 1684373214),
(5, 13, '1600', '', 0, 1684373232),
(6, 14, '400', '', 0, 1684380385),
(7, 15, '400', '', 0, 1684380463);

-- --------------------------------------------------------

--
-- Table structure for table `vehicule`
--

CREATE TABLE `vehicule` (
  `ID` int(11) NOT NULL,
  `ID_Categorie` int(11) NOT NULL,
  `ID_Filiala` int(11) NOT NULL,
  `Marca` varchar(64) NOT NULL,
  `Model` varchar(64) NOT NULL,
  `Imagine` varchar(128) NOT NULL,
  `An` int(11) NOT NULL,
  `Carburant` varchar(32) NOT NULL,
  `Motorizare` varchar(32) NOT NULL,
  `Tip_cutie` varchar(32) NOT NULL,
  `Km` int(11) NOT NULL,
  `Culoare` varchar(64) NOT NULL,
  `Nr_usi` int(2) NOT NULL,
  `Nr_bagaje` int(2) NOT NULL,
  `Nr_pasageri` int(2) NOT NULL,
  `Pret` int(11) NOT NULL,
  `Disponibilitate` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `vehicule`
--

INSERT INTO `vehicule` (`ID`, `ID_Categorie`, `ID_Filiala`, `Marca`, `Model`, `Imagine`, `An`, `Carburant`, `Motorizare`, `Tip_cutie`, `Km`, `Culoare`, `Nr_usi`, `Nr_bagaje`, `Nr_pasageri`, `Pret`, `Disponibilitate`) VALUES
(1, 1, 3, 'Opel', 'Corsa', 'opel.png', 1999, 'Benzina', '1.4', 'Manual', 500000, 'Negru', 4, 2, 5, 200, 1),
(2, 1, 3, 'Opel', 'Corsa', 'opel.png', 1999, 'Benzina', '1.4', 'Manual', 500000, 'Negru', 4, 2, 5, 200, 1),
(3, 1, 3, 'Opel', 'Corsa', 'opel.png', 1999, 'Benzina', '1.4', 'Manual', 500000, 'Negru', 4, 3, 5, 200, 1),
(4, 1, 3, 'Opel', 'Corsa', 'opel.png', 1999, 'Benzina', '1.4', 'Manual', 500000, 'Negru', 4, 1, 8, 200, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `acces`
--
ALTER TABLE `acces`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `adrese`
--
ALTER TABLE `adrese`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `id_user` (`ID_Client`);

--
-- Indexes for table `angajati`
--
ALTER TABLE `angajati`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `id_client` (`ID_Client`),
  ADD KEY `id_acces` (`ID_Acces`);

--
-- Indexes for table `categorie_vehicule`
--
ALTER TABLE `categorie_vehicule`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `clienti`
--
ALTER TABLE `clienti`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `filiale`
--
ALTER TABLE `filiale`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `inchirieri`
--
ALTER TABLE `inchirieri`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `plati`
--
ALTER TABLE `plati`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `inchirieri` (`ID_Inchirieri`);

--
-- Indexes for table `vehicule`
--
ALTER TABLE `vehicule`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `ID_categorie` (`ID_Categorie`),
  ADD KEY `id_filiala` (`ID_Filiala`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `acces`
--
ALTER TABLE `acces`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `adrese`
--
ALTER TABLE `adrese`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `angajati`
--
ALTER TABLE `angajati`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `categorie_vehicule`
--
ALTER TABLE `categorie_vehicule`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `clienti`
--
ALTER TABLE `clienti`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `filiale`
--
ALTER TABLE `filiale`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `inchirieri`
--
ALTER TABLE `inchirieri`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `plati`
--
ALTER TABLE `plati`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `vehicule`
--
ALTER TABLE `vehicule`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `adrese`
--
ALTER TABLE `adrese`
  ADD CONSTRAINT `id_user` FOREIGN KEY (`ID_Client`) REFERENCES `clienti` (`ID`);

--
-- Constraints for table `angajati`
--
ALTER TABLE `angajati`
  ADD CONSTRAINT `id_acces` FOREIGN KEY (`ID_Acces`) REFERENCES `acces` (`ID`),
  ADD CONSTRAINT `id_client` FOREIGN KEY (`ID_Client`) REFERENCES `clienti` (`ID`);

--
-- Constraints for table `plati`
--
ALTER TABLE `plati`
  ADD CONSTRAINT `inchirieri` FOREIGN KEY (`ID_Inchirieri`) REFERENCES `inchirieri` (`ID`);

--
-- Constraints for table `vehicule`
--
ALTER TABLE `vehicule`
  ADD CONSTRAINT `ID_categorie` FOREIGN KEY (`ID_Categorie`) REFERENCES `categorie_vehicule` (`ID`),
  ADD CONSTRAINT `id_filiala` FOREIGN KEY (`ID_Filiala`) REFERENCES `filiale` (`ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
