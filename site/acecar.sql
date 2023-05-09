-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 09, 2023 at 10:06 PM
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

-- --------------------------------------------------------

--
-- Table structure for table `clienti`
--

CREATE TABLE `clienti` (
  `ID` int(11) NOT NULL,
  `Nume` varchar(64) NOT NULL,
  `Prenume` varchar(128) NOT NULL,
  `Username` varchar(64) NOT NULL,
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

INSERT INTO `clienti` (`ID`, `Nume`, `Prenume`, `Username`, `Parola`, `Email`, `Data_nasterii`, `CNP`, `Telefon`, `Prima_conectare`, `Ultima_conectare`) VALUES
(1, 'alex', 'mihai', 'test', '', 'sds', 2001, '123', '123456789', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `filiale`
--

CREATE TABLE `filiale` (
  `ID` int(11) NOT NULL,
  `Oras` varchar(64) NOT NULL,
  `Adresa` varchar(128) NOT NULL,
  `Telefon` varchar(32) NOT NULL,
  `Descriere` varchar(512) NOT NULL,
  `Ora_Deschidere` int(11) NOT NULL,
  `Ora_Inchidere` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
  `Locatie_ridicare` varchar(64) NOT NULL,
  `Locatie_returnare` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
  `An` int(11) NOT NULL,
  `Carburant` varchar(32) NOT NULL,
  `Motorizare` varchar(32) NOT NULL,
  `Km` int(11) NOT NULL,
  `Culoare` varchar(64) NOT NULL,
  `Nr_usi` int(2) NOT NULL,
  `Pret` int(11) NOT NULL,
  `Disponibilitate` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `adrese`
--
ALTER TABLE `adrese`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `angajati`
--
ALTER TABLE `angajati`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `categorie_vehicule`
--
ALTER TABLE `categorie_vehicule`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `clienti`
--
ALTER TABLE `clienti`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `filiale`
--
ALTER TABLE `filiale`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `inchirieri`
--
ALTER TABLE `inchirieri`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `plati`
--
ALTER TABLE `plati`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `vehicule`
--
ALTER TABLE `vehicule`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

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
