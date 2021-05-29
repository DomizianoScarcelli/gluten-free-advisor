-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Creato il: Mag 29, 2021 alle 15:07
-- Versione del server: 10.4.19-MariaDB
-- Versione PHP: 8.0.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ristoranti`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `ristoranti_da_verificare`
--

CREATE TABLE `ristoranti_da_verificare` (
  `id` int(16) NOT NULL,
  `indirizzo` varchar(256) DEFAULT NULL,
  `citta` varchar(256) DEFAULT NULL,
  `nome` varchar(256) DEFAULT NULL,
  `latitudine` double(128,6) DEFAULT NULL,
  `longitudine` double(128,6) DEFAULT NULL,
  `prezzo` int(2) DEFAULT NULL,
  `descrizione` longtext DEFAULT NULL,
  `listaFoto` varchar(2048) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `tags` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`tags`)),
  `google` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `ristoranti_da_verificare`
--

INSERT INTO `ristoranti_da_verificare` (`id`, `indirizzo`, `citta`, `nome`, `latitudine`, `longitudine`, `prezzo`, `descrizione`, `listaFoto`, `tags`, `google`) VALUES
(1, NULL, 'asdasd', 'asdasd', NULL, NULL, 0, 'asdasd', '0', '[]', 0),
(2, 'Via del Forte Braschi, 82/A', NULL, 'Lievito 72', 41.914674, 12.420769, 0, 'Supplì, focacce e pizze, anche senza glutine, tra gli interni moderni di un locale dal tocco minimalista.', '0', '[\"Consegna a domicilio\",\"Da asporto\",\"Consumazione sul posto\",\"Cucina separata\",\"Nella media\",\"Pizza\",\"Dolci\",\"Per vegetariani\"]', 0),
(3, 'asdasd', NULL, 'asdasd', 34.057228, -118.307197, 0, 'asdasd', '0', '[]', 0),
(4, 'asdasd', NULL, 'asdasd', 34.057228, -118.307197, 0, '', '0', '[]', 0),
(5, 'asd', NULL, 'asdasd', 41.771051, -72.747347, 0, '', '0', '[]', 0),
(6, 'ss', NULL, 'ss', 37.043317, -94.481749, 0, '', '0', '[]', 0),
(7, 'null', NULL, 'Ristorante Prova', 45.649526, 13.776818, NULL, 'Un semplice ristorante di prova.', '[]', '[]', 0);

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `ristoranti_da_verificare`
--
ALTER TABLE `ristoranti_da_verificare`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT per le tabelle scaricate
--

--
-- AUTO_INCREMENT per la tabella `ristoranti_da_verificare`
--
ALTER TABLE `ristoranti_da_verificare`
  MODIFY `id` int(16) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
