-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 14, 2021 at 08:04 PM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 8.0.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `nekretnine`
--

-- --------------------------------------------------------

--
-- Table structure for table `korisnik`
--

CREATE TABLE `korisnik` (
  `id` int(6) NOT NULL,
  `ime_prezime` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sifra` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_uloga` int(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `korisnik`
--

INSERT INTO `korisnik` (`id`, `ime_prezime`, `email`, `sifra`, `id_uloga`) VALUES
(44, 'Miodrag Petrusic', 'miodrag@gmail.com', 'miodrag', 1),
(53, 'Milica Mandic', 'milica@gmail.com', 'milica', 2),
(54, 'jovan', 'jovan@gmail.com', 'jovanjovan', 2),
(55, 'Jovana Pavlovic', 'jovana@gmail.com', 'jovana', 2),
(56, 'Irena Nikolic', 'irena@gmail.com', 'irena', 2);

-- --------------------------------------------------------

--
-- Table structure for table `nekretnina`
--

CREATE TABLE `nekretnina` (
  `id` int(6) NOT NULL,
  `adresa` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `opis` varchar(600) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cena` int(11) NOT NULL,
  `kvadratura` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `nekretnina`
--

INSERT INTO `nekretnina` (`id`, `adresa`, `opis`, `cena`, `kvadratura`) VALUES
(52, 'Bulevar Milutina Milankovca 55', '5. sprat. Terasa. Dva mokra cvora.', 120000, 55),
(53, 'Nehurova 13', '4. sprat. Terasa i lodja. Dva mokra cvora.', 85, 130000),
(54, 'Sarajevska 10', 'Suturen. Jedno kupatilo.', 11000, 60),
(55, 'Nikole Marakovica 20', '10. sprat. Terasa. Dva mokra cvora.', 105000, 90),
(74, 'Omladinskih brigada 190', '11. sprat. Terasa od 30 kvadrata. 4 sobe. 2 mokra cvora', 250000, 100),
(75, 'Jove Ilica 15', '4. sprat. Dva mokra cvora. 3 sobe', 300000, 120),
(76, 'Jurija Gagarina 30', 'Ima terasu. 5. sprat. Dva mokra cvora', 90000, 45);

-- --------------------------------------------------------

--
-- Table structure for table `razgledanje`
--

CREATE TABLE `razgledanje` (
  `id` int(6) NOT NULL,
  `id_agent` int(6) NOT NULL DEFAULT 41,
  `id_kupac` int(6) NOT NULL,
  `id_nekretnina` int(6) NOT NULL,
  `razgledanje` varchar(260) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `datum` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `razgledanje`
--

INSERT INTO `razgledanje` (`id`, `id_agent`, `id_kupac`, `id_nekretnina`, `razgledanje`, `datum`) VALUES
(197, 44, 53, 54, 'Termin: 25.09.2021 10h', '2021-09-14');

-- --------------------------------------------------------

--
-- Table structure for table `uloga`
--

CREATE TABLE `uloga` (
  `id` int(6) NOT NULL,
  `naziv` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `uloga`
--

INSERT INTO `uloga` (`id`, `naziv`) VALUES
(1, 'agent'),
(2, 'kupac');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `korisnik`
--
ALTER TABLE `korisnik`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `uloga_fk` (`id_uloga`);

--
-- Indexes for table `nekretnina`
--
ALTER TABLE `nekretnina`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `razgledanje`
--
ALTER TABLE `razgledanje`
  ADD PRIMARY KEY (`id`),
  ADD KEY `kontrolor_fk` (`id_kupac`),
  ADD KEY `vlasnik_fk` (`id_agent`),
  ADD KEY `vozilo_fk` (`id_nekretnina`);

--
-- Indexes for table `uloga`
--
ALTER TABLE `uloga`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `korisnik`
--
ALTER TABLE `korisnik`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT for table `nekretnina`
--
ALTER TABLE `nekretnina`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=77;

--
-- AUTO_INCREMENT for table `razgledanje`
--
ALTER TABLE `razgledanje`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=198;

--
-- AUTO_INCREMENT for table `uloga`
--
ALTER TABLE `uloga`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `korisnik`
--
ALTER TABLE `korisnik`
  ADD CONSTRAINT `uloga_fk` FOREIGN KEY (`id_uloga`) REFERENCES `uloga` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `razgledanje`
--
ALTER TABLE `razgledanje`
  ADD CONSTRAINT `kontrolor_fk` FOREIGN KEY (`id_kupac`) REFERENCES `korisnik` (`id`),
  ADD CONSTRAINT `vlasnik_fk` FOREIGN KEY (`id_agent`) REFERENCES `korisnik` (`id`),
  ADD CONSTRAINT `vozilo_fk` FOREIGN KEY (`id_nekretnina`) REFERENCES `nekretnina` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
