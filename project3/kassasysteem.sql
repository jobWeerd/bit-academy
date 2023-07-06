-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Gegenereerd op: 03 apr 2023 om 11:45
-- Serverversie: 10.4.27-MariaDB
-- PHP-versie: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kassasysteem`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `artikel`
--

CREATE TABLE `artikel` (
  `id` int(11) NOT NULL,
  `prijs` int(5) NOT NULL,
  `barcode` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `artikelgroep`
--

CREATE TABLE `artikelgroep` (
  `id` int(11) NOT NULL,
  `vlees` varchar(20) NOT NULL,
  `vis` varchar(20) NOT NULL,
  `groente/fruit` varchar(20) NOT NULL,
  `zuivel` varchar(20) NOT NULL,
  `dranken` varchar(20) NOT NULL,
  `diepvries` varchar(20) NOT NULL,
  `alcohol` varchar(20) NOT NULL,
  `artikel-id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `artikelvoorraad`
--

CREATE TABLE `artikelvoorraad` (
  `id` int(11) NOT NULL,
  `aantal` int(5) NOT NULL,
  `barcode` int(20) NOT NULL,
  `artikel` int(10) NOT NULL,
  `artikel-id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `bon`
--

CREATE TABLE `bon` (
  `id` int(11) NOT NULL,
  `datum` timestamp(5) NOT NULL DEFAULT current_timestamp(5) ON UPDATE current_timestamp(5),
  `gebruiker` int(10) NOT NULL,
  `bonregel-id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `bonregel`
--

CREATE TABLE `bonregel` (
  `id` int(11) NOT NULL,
  `regels` int(20) NOT NULL,
  `bon-id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `gebruiker`
--

CREATE TABLE `gebruiker` (
  `id` int(11) NOT NULL,
  `voornaam` varchar(10) NOT NULL,
  `tussenvoegsel` varchar(10) NOT NULL,
  `achternaam` varchar(10) NOT NULL,
  `rol-id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `gebruiker`
--

INSERT INTO `gebruiker` (`id`, `voornaam`, `tussenvoegsel`, `achternaam`, `rol-id`) VALUES
(1, '', '', '', 0);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `rol`
--

CREATE TABLE `rol` (
  `id` int(11) NOT NULL,
  `beheerder` varchar(10) NOT NULL,
  `medewerker` varchar(10) NOT NULL,
  `klant` varchar(10) NOT NULL,
  `gebruiker-id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `artikel`
--
ALTER TABLE `artikel`
  ADD PRIMARY KEY (`id`,`prijs`,`barcode`);

--
-- Indexen voor tabel `artikelgroep`
--
ALTER TABLE `artikelgroep`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `artikelvoorraad`
--
ALTER TABLE `artikelvoorraad`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `bon`
--
ALTER TABLE `bon`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `bonregel`
--
ALTER TABLE `bonregel`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `gebruiker`
--
ALTER TABLE `gebruiker`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `rol`
--
ALTER TABLE `rol`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `artikel`
--
ALTER TABLE `artikel`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT voor een tabel `artikelgroep`
--
ALTER TABLE `artikelgroep`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT voor een tabel `artikelvoorraad`
--
ALTER TABLE `artikelvoorraad`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT voor een tabel `bon`
--
ALTER TABLE `bon`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT voor een tabel `bonregel`
--
ALTER TABLE `bonregel`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT voor een tabel `gebruiker`
--
ALTER TABLE `gebruiker`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT voor een tabel `rol`
--
ALTER TABLE `rol`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
