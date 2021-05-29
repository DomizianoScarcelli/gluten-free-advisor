-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Creato il: Mag 29, 2021 alle 15:08
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
-- Struttura della tabella `dati_ristoranti`
--

CREATE TABLE `dati_ristoranti` (
  `id` int(16) NOT NULL,
  `indirizzo` varchar(256) NOT NULL,
  `nome` varchar(256) NOT NULL,
  `latitudine` double(128,6) NOT NULL,
  `longitudine` double(128,6) NOT NULL,
  `prezzo` int(2) DEFAULT NULL,
  `descrizione` longtext DEFAULT NULL,
  `listaFoto` varchar(2048) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `tags` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`tags`)),
  `google` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `dati_ristoranti`
--

INSERT INTO `dati_ristoranti` (`id`, `indirizzo`, `nome`, `latitudine`, `longitudine`, `prezzo`, `descrizione`, `listaFoto`, `tags`, `google`) VALUES
(73, 'Via Nocera Umbra, 96, Roma, RM, Italia', 'Binario 96', 41.877842, 12.528429, NULL, 'Carne e pizza in ristorante rustico-moderno con un vero binario a vista e la riproduzione di una locomotiva.', '[\"binario-96-1.jpg\",\"binario-96-2.jpg\",\"binario-96-3.jpg\",\"binario-96-4.jpg\"]', '\"Consegna a domicilio,Da asporto,Consumazione sul posto,Nella media,Pizza,Pasta,Dolci,Per vegetariani\"', 0),
(74, 'Via del Vantaggio, 43, 00186 Roma, RM, Italia', 'Il Melarancio', 41.908549, 12.476239, NULL, 'Locale che serve specialità romane rivisitate e aperitivi in sale intime o ai tavoli esterni in area pedonale.', '[\"melarancio-1.jpg\",\"melarancio-2.jpg\",\"melarancio-3.jpg\"]', '\"Consegna a domicilio,Da asporto,Consumazione sul posto,Nella media,Pizza,Pasta,Panini,Dolci,Per vegetariani\"', 0),
(75, 'Via di Pietra, 85, 00186 Roma, RM, Italia', 'La locanda del tempio', 41.899965, 12.480333, NULL, '', '[\"tempio-1.jpg\",\"tempio-2.jpg\",\"tempio-3.jpg\",\"tempio-4.png\",\"tempio-5.jpg\"]', '\"Consegna a domicilio,Da asporto,Raffinato,Pasta,Panini,Dolci,Per vegetariani\"', 0),
(76, 'Via del Forte Braschi, 82a, Roma, RM, Italia', 'Lievito 72', 41.914674, 12.420769, NULL, 'Supplì, focacce e pizze, anche senza glutine, tra gli interni moderni di un locale dal tocco minimalista.', '[\"lievito-1.jpg\",\"lievito-2.jpg\",\"lievito-3.jpg\",\"lievito-4.jpg\",\"lievito-5.jpg\"]', '\"Consegna a domicilio,Da asporto,Consumazione sul posto,Cucina separata,Nella media,Pizza,Pasta,Panini,Dolci,Gelato,Per vegetariani\"', 0),
(77, 'Via di S. Cosimato, 7/9, 00153 Roma, RM, Italia', 'Mama Eat Roma', 41.888409, 12.470572, NULL, 'Ristorante-pizzeria con piatti italiani, anche senza glutine, in uno spazio dal design moderno e colorato.', '[\"mama-1.jpg\",\"mama-2.jpg\",\"mama-3.jfif\",\"mama-4.jpg\",\"mama-5.jpg\"]', '\"Consegna a domicilio,Da asporto,Consumazione sul posto,Economico,Pizza,Pasta,Dolci,Per vegetariani\"', 0),
(78, 'Via della Stazione di Ottavia, 109/111, 00135 Roma, Roma, Italia', 'MeMo Gelato', 41.964150, 12.403961, NULL, '', '[\"memo-1.jpg\",\"memo-2.jpg\",\"memo-3.jpg\",\"memo-4.jfif\",\"memo-5.jpg\"]', '\"Da asporto,Consumazione sul posto,Economico,Gelato,Per vegetariani\"', 0),
(79, 'Via Aosta, 60a, Roma, RM, Italia', 'Neko Sushi San Giovanni', 41.884199, 12.515083, NULL, 'Tradizionale ristorante giapponese nel cuore di Roma.', '[\"neko-1.jpg\",\"neko-2.jpg\",\"neko-3.jpg\",\"neko-4.jpg\",\"neko-5.jpg\",\"neko-6.jpg\",\"neko-7.jpg\"]', '\"Consegna a domicilio,Da asporto,Consumazione sul posto,Nella media,Sushi,Per vegetariani,Per vegani\"', 0),
(80, 'Piazza Augusto Lorenzini, 11, 00149 Roma, RM, Italia', 'Pizzeria Il Cavaliere', 41.854996, 12.451013, NULL, '', '[\"cavaliere-1.jfif\",\"cavaliere-2.jpg\",\"cavaliere-3.jpg\",\"cavaliere-4.jpg\",\"cavaliere-5.png\"]', '\"Da asporto,Consumazione sul posto,Nella media,Pizza,Dolci,Per vegetariani,Per vegani\"', 0),
(81, 'Via Volturno, 39/41, 00185 Roma, RM, Italia', 'Rifugio Romano', 41.904439, 12.499599, NULL, 'Pietanze vegane e romane oltre a pizza servite in un ristorante informale con arredi di legno e area esterna.', '[\"rifugio-1.jpg\",\"rifugio-2.jpg\",\"rifugio-3.jpeg\",\"rifugio-4.jpg\",\"rifugio-5.jpg\"]', '\"Consegna a domicilio,Da asporto,Consumazione sul posto,Nella media,Pizza,Pasta,Dolci,Per vegetariani,Per vegani\"', 0),
(82, 'Via Giacomo Bove, 47, 00154 Roma, RM, Italia', 'The Butcher House', 41.871057, 12.481608, NULL, 'Nota hamburgeria del quadrante nord-est di Roma, famosa per la sua formula che permette ai clienti di comporre il proprio panino scegliendo a piacere gli ingredienti disponibili.', '[\"butcher-1.jpeg\",\"butcher-2.jpg\",\"butcher-3.jpg\",\"butcher-4.png\",\"butcher-5.jpg\"]', '\"Consegna a domicilio,Da asporto,Economico,Panini,Dolci,Per vegetariani\"', 0),
(87, 'Viale di Tor di Quinto, 35, 00191 Roma, RM, Italia', 'Fratelli la Bufala', 41.937365, 12.469537, NULL, 'Pizza napoletana e pietanze campane proposte in una catena di ristoranti moderni dall\'impronta mediterranea.', '[\"bufala-1.jpg\",\"bufala-2.jfif\",\"bufala-3.jpg\",\"bufala-4.jfif\",\"bufala-5.jpg\"]', '\"Consegna a domicilio,Da asporto,Consumazione sul posto,Nella media,Pizza,Pasta,Panini,Dolci,Gelato,Per vegetariani\"', 0),
(89, 'Piazza di San Calisto, 10, Roma, RM, Italia', 'Cajo & Gajo', 41.888804, 12.470909, NULL, 'Cucina romana, pizze e vini in un\'osteria rustica con mattoni a vista, lampade rétro e dehors su una piazza.', '[\"a.jpg\",\"cajo-2.jpg\",\"cajo-3.jpg\",\"cajo-4.jpg\",\"cajo-5.jpg\"]', '\"Da asporto,Consumazione sul posto,Nella media,Pasta,Dolci,Gelato,Per vegetariani\"', 0);

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `dati_ristoranti`
--
ALTER TABLE `dati_ristoranti`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT per le tabelle scaricate
--

--
-- AUTO_INCREMENT per la tabella `dati_ristoranti`
--
ALTER TABLE `dati_ristoranti`
  MODIFY `id` int(16) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=95;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
