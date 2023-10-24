-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 17, 2022 at 02:34 AM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `vaccin`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `login` varchar(100) DEFAULT NULL,
  `Password` varchar(100) DEFAULT NULL,
  `updationDate` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `login`, `Password`, `updationDate`) VALUES
(1, 'admin', '25d55ad283aa400af464c76d713c07ad', '2020-05-11 11:18:49');

-- --------------------------------------------------------

--
-- Table structure for table `centrevaccination`
--

CREATE TABLE `centrevaccination` (
  `id` int(11) NOT NULL,
  `adresse` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `centrevaccination`
--

INSERT INTO `centrevaccination` (`id`, `adresse`) VALUES
(1, 'Hopital Moulay Youssef'),
(2, 'Hopital sheikh zayed '),
(3, 'Hopital Ibn Sina'),
(4, 'Hopital Militaire Mohammed V'),
(5, 'Hopital Maternité Les Orangers');

-- --------------------------------------------------------

--
-- Table structure for table `dose`
--

CREATE TABLE `dose` (
  `id` int(11) NOT NULL,
  `numero` varchar(50) NOT NULL,
  `date` datetime NOT NULL,
  `idp` int(11) NOT NULL,
  `idv` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `dose`
--

INSERT INTO `dose` (`id`, `numero`, `date`, `idp`, `idv`) VALUES
(45, '1', '2022-04-26 00:50:00', 1, 6),
(46, '2', '2022-04-12 00:50:00', 1, 6),
(47, '3', '2022-04-27 00:05:00', 1, 6),
(48, '1', '2022-04-26 05:05:00', 15, 5),
(49, '2', '2022-04-19 00:05:00', 15, 5),
(50, '3', '2022-04-27 05:05:00', 15, 5);

-- --------------------------------------------------------

--
-- Stand-in structure for view `dview`
-- (See below for the actual view)
--
CREATE TABLE `dview` (
`id` int(11)
,`cin` varchar(20)
,`nom` varchar(102)
,`numero` varchar(50)
,`date` datetime
,`type` varchar(50)
);

-- --------------------------------------------------------

--
-- Table structure for table `passvacc`
--

CREATE TABLE `passvacc` (
  `num` int(11) NOT NULL,
  `iddose` int(11) NOT NULL,
  `idpersonne` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `personne`
--

CREATE TABLE `personne` (
  `id` int(11) NOT NULL,
  `cin` varchar(20) NOT NULL,
  `nom` varchar(50) NOT NULL,
  `prenom` varchar(50) NOT NULL,
  `adresse` text NOT NULL,
  `sexe` varchar(10) NOT NULL,
  `datenaissance` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `personne`
--

INSERT INTO `personne` (`id`, `cin`, `nom`, `prenom`, `adresse`, `sexe`, `datenaissance`) VALUES
(1, 'AA18556', 'hamza', 'barhoune', 'SALE', 'homme', '2000-01-26'),
(2, 'AB46465', 'salah', 'habiby', 'GLMIM', 'homme', '2022-04-21'),
(3, 'A45454', 'Houssam', 'Safir', 'Rabat', 'homme', '2001-04-18'),
(11, 'AB488DD', 'SIMON', 'MOHA', 'Rabat', 'homme', '2022-04-19'),
(14, 'A666666', 'JAHAR', 'RAHAJ', 'SALE', 'femme', '2022-04-19'),
(15, 'TEST', 'TEST', 'TEST', 'TEST', 'femme', '2022-04-25');

-- --------------------------------------------------------

--
-- Table structure for table `vaccins`
--

CREATE TABLE `vaccins` (
  `id` int(11) NOT NULL,
  `type` varchar(50) NOT NULL,
  `description` varchar(50) NOT NULL,
  `stock` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `vaccins`
--

INSERT INTO `vaccins` (`id`, `type`, `description`, `stock`) VALUES
(1, 'Feizer', 'PFizer', 455),
(2, 'Astrazinika', 'Astrazinika ', 454),
(3, 'Jansenn', 'Jansenn', 500),
(4, 'Moderna', 'Moderna', 30),
(5, 'Sinopharm', 'Sinopharm', 15),
(6, 'Sputnik V', 'Sputnik', 15),
(7, 'CoronaVac', 'CoronaVac', 100),
(8, 'Turkovac', 'Turkovac', 0),
(9, 'test', 'test', 0);

-- --------------------------------------------------------

--
-- Structure for view `dview`
--
DROP TABLE IF EXISTS `dview`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `dview`  AS SELECT `d`.`id` AS `id`, `p`.`cin` AS `cin`, concat(`p`.`nom`,'  ',`p`.`prenom`) AS `nom`, `d`.`numero` AS `numero`, `d`.`date` AS `date`, `v`.`type` AS `type` FROM ((`personne` `p` join `dose` `d`) join `vaccins` `v`) WHERE `p`.`id` = `d`.`idp` AND `v`.`id` = `d`.`idv` ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `centrevaccination`
--
ALTER TABLE `centrevaccination`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dose`
--
ALTER TABLE `dose`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_idp` (`idp`),
  ADD KEY `fk_idv` (`idv`);

--
-- Indexes for table `passvacc`
--
ALTER TABLE `passvacc`
  ADD PRIMARY KEY (`num`);

--
-- Indexes for table `personne`
--
ALTER TABLE `personne`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vaccins`
--
ALTER TABLE `vaccins`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `centrevaccination`
--
ALTER TABLE `centrevaccination`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `dose`
--
ALTER TABLE `dose`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `passvacc`
--
ALTER TABLE `passvacc`
  MODIFY `num` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `personne`
--
ALTER TABLE `personne`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `vaccins`
--
ALTER TABLE `vaccins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `dose`
--
ALTER TABLE `dose`
  ADD CONSTRAINT `fk_idp` FOREIGN KEY (`idp`) REFERENCES `personne` (`id`),
  ADD CONSTRAINT `fk_idv` FOREIGN KEY (`idv`) REFERENCES `vaccins` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
