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
-- Struttura della tabella `recensioni`
--

CREATE TABLE `recensioni` (
  `id_recensione` int(16) NOT NULL,
  `id_ristorante` int(16) NOT NULL,
  `username` varchar(256) NOT NULL DEFAULT 'anonimo',
  `titolo` varchar(256) NOT NULL,
  `data_recensione` date NOT NULL,
  `valutazione` int(16) NOT NULL,
  `testo` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `recensioni`
--

INSERT INTO `recensioni` (`id_recensione`, `id_ristorante`, `username`, `titolo`, `data_recensione`, `valutazione`, `testo`) VALUES
(1, 76, 'anonimo', 'Buonissima pizza senza glutine!', '2018-05-02', 5, 'Una delle migliori pizze senza glutine di Roma.'),
(2, 76, 'paolodc_89', 'Assolutamente consigliato.', '2019-08-31', 4, 'Locale spazioso, personale attento e disponibile. Le ordinazioni sono arrivate subito. Consigliato.'),
(3, 76, '£Silvia£', 'Bella serata, da ripetere.', '2020-02-12', 5, 'Mi sono trovata molto bene, ci tornerò sicuramente.'),
(4, 82, 'Marco M', 'Ottimo panino gluten free!', '2019-05-14', 4, 'Valido ristorante di quartiere che propone una formula “fai da te” per gli hamburger in cui il cliente può decidere carni, pane ed ingredienti. Tra i vari tipi di pane disponibili c\'è anche quello senza glutine! Da celiaco, ho finalmente potuto gustare un buon hamburger. Consigliatissimo.'),
(5, 82, '£Silvia£', 'Super panini!', '2021-04-27', 3, 'Locale molto carino e accogliente, personale gentile. Abbiamo passato una serata tra amici accompagnata da ottimi panini, ne sono rimasta davvero soddisfatta! Tanti condimenti da aggiungere e varia scelta, sia il tipo sia il peso della carne. Simpatico il foglietto da compilare per costruire l\'ordinazione. Buone anche le birre artigianali.'),
(6, 79, 'Random_User', 'Comodo per il suo format.', '2021-05-10', 3, 'Ottima la possibilità di ordinare attraverso il tablet. Menù molto variegato e di qualità, specialmente il sashimi, il tutto a prezzi nella media.'),
(7, 76, 'Raf_95', 'Una piacevole scoperta.', '2011-06-01', 3, 'Ho cenato poche sere fa da Lievito, valutata la vicinanza dal luogo dove lavoro e il parere positivo di amici che già ci erano stati. Confermo che il locale si è rivelato un\'ottima scoperta. Ho optato per la pizza ed era veramente gustosa sia come impasto che come condimento. La prossima volta proverò gli hamburger.'),
(8, 82, 'paolodc_89', 'Serata tra amici', '2021-05-04', 3, 'Cena piacevole da The Butcher House. Locale esteticamente molto bello, accogliente e pulito; personale di sala disponibile, gentile e attento. Carne di buona qualità. Ognuno di noi ha creato l\'hamburger con la combinazione di ingredienti che più ci incuriosiva. Buon rapporto qualità/prezzo.'),
(9, 79, 'anonimo', 'Sushi nella media...', '2021-01-29', 2, 'Ho trovato il sushi un po’ al di sotto della media, il sashimi invece molto al di sotto... purtroppo i prodotti utilizzati non sono dei migliori, buono il salmone ma non il tonno. Il prezzo è al di sotto di altri All You Can Eat.'),
(10, 82, 'elle.emme', 'Scegli come comporre il tuo panino.', '2018-03-30', 4, 'Il locale offre una vasta scelta e possibilità di combinare i panini in vario modo, accontentando le persone come me che hanno bisogno di assaggiare sempre qualcosa di nuovo. Servio ottimo e anche la qualità degli ingredienti. Da provare!'),
(11, 79, '£Silvia£', 'Carino.', '2019-05-07', 3, 'Niente di strabiliante, sicuramente comodo il tablet per ordinare le varie pietanze. Il servizio è veloce, la proposta del menù è molto ampia e il sushi è nella media, per ciò che si paga va bene.'),
(12, 79, 'AC', 'Sushi buono ma troppo riso.', '2018-10-03', 3, 'Ho cenato in questo ristorante dopo aver già provato altri ristoranti di questa catena e penso che sia molto buono ma non il migliore. Di solito è molto affollato, specialmente nei weekend, e il locale non è molto grande. Oltre ad ordinare con il tablet ci sono i camerieri che prendono ordinazioni per i piatti del menù cartaceo (sempre incluso nell’ayce). Questo ristorante offre una vasta scelta di roll tutti buonissimi, soprattutto i fritti. Unica pecca: spesso nei roll c’è davvero troppo riso. Per quanto riguarda i prezzi, sono quelli di un ayce con prezzi nella media.'),
(13, 79, 'Marco M', 'Esperienza piacevole.', '2017-06-21', 4, 'Abbiamo deciso di provare questo posto per pranzare e si è rivelata un\'esperienza molto piacevole. Un sacco di sushi deliziosi e altri piatti giapponesi. Per il prezzo fisso si può mangiare quanto si vuole. Il personale era molto cordiale e disponibile.'),
(14, 79, 'anonimo', 'Buono.', '2018-03-27', 4, 'Prima esperienza con il sushi ma veramente una piacevole sorpresa. Ambiente raffinato, personale gentile e veloce. Pietanze gustose si scelgono comodamente attraverso un tablet, il tutto a prezzi modici. Consiglio di provarlo!'),
(15, 73, 'Random_User', 'Splendida serata.', '2021-03-19', 3, 'Abbiamo cenato in tanti... dal pesce alla carne, devo dire servizio fantastico e tutto di eccellente qualità. Pranzo tra amici, piatti serviti in poco tempo e con cordialità. Prezzi ottimi devo dire.'),
(16, 73, 'Marco M', 'Eccellente.', '2021-11-15', 5, 'Ristorante molto carino e accogliente, personale gentile e disponibile. Ottimo rapporto qualità-prezzo.'),
(17, 73, 'Raf_95', 'Cena al Binario96.', '2020-08-10', 4, 'Cucina molto buona, personale abbastanza rapido, prezzi un po\' altini, ma nell\'insieme abbiamo passato una bella serata. Il locale è ben arredato e sicuramente caratteristico. Abbiamo ordinato una delle loro pizzottelle, a mio avviso ottime, due primi: un tonnarello alla bottarga e una trofia con cozze, entrambe buone. Poi due millefoglie di branzino, ottimi. Sicuramente è un locale valido per il pesce.'),
(18, 74, 'anonimo', 'Pasta fresca gluten free.', '2020-09-23', 5, 'Meraviglioso pranzetto senza glutine in pienissimo centro a Roma. In totale 20€ di conto con una bottiglietta d\'acqua. Carbonara assolutamente squisita, anche il guanciale era ottimo.'),
(19, 74, 'paolodc_89', 'Tutto anche gluten free!', '2020-04-30', 5, 'Per la felicità di celiaci e intolleranti, tutto il menù è disponibile anche senza glutine! Seduti fuori abbiamo ordinato un fritto di pesce e un\'amatriciana senza glutine (fatta con ottima pasta fresca!).\r\nServizio gentilissimo e rapporto qualità prezzo buono, ha decisamente superato le aspettative!\r\nConsiglio.'),
(20, 75, 'tambourine_man', 'You must try pasta', '2019-08-26', 5, 'Nice place and kind service. I got some really delicious pasta with clams and shrimps. I will come back for sure! Thank you chef!'),
(21, 75, 'English_Man_In_Rome', 'Lovely midnight snack!', '2019-07-20', 5, 'I was walking by and was offered a sample of pizza. A simple yet flavorsome piece that immediately intrigued my palette. I must wonder in I thought, and so I did. A cocktail and pizza was the order.The pizza... wow. Simple, delicate and delicious. Would reccomend to anyone.'),
(22, 75, 'Random_User', 'Uno dei migliori ristoranti di Roma', '2014-01-31', 5, 'Situato nel cuore della città accanto alla fontana di Trevi, pizza e pasta sono deliziose e lo staff davvero amichevole. Ci tornerò sicuramente.'),
(23, 77, 'anonimo', 'La miglior pizza senza glutine.', '2021-05-18', 5, 'La pizza senza glutine migliore che io abbia mai mangiato. L’atmosfera sempre serena e super accogliente mi hanno spinto irresistibilmente a tornare in questo posto che mi è tanto mancato in questo periodo di chiusure .. complimenti per essere riusciti a mantenere la qualità delle pietanze e per la simpatia del personale.'),
(24, 77, 'paolodc_89', 'Cena gluten free', '2015-04-22', 4, 'Siamo in vacanza a Roma e abbiamo cenato in questo ristorante ieri sera, è stata un\'ottima scelta visto che è disponibile il menù completo senza glutine! Inoltre con due cucine separate è garantito che non avvenga contaminazione. Personale gentilissimo, torneremo sicuramente!'),
(25, 77, '£Silvia£', 'Pranzo a Trastevere', '2020-01-27', 4, 'Ottima cena con e senza glutine. Grazie al personale per la professionalità e la simpatia. Consigliato.'),
(26, 78, 'AC', 'Gelato top!', '2020-10-10', 4, 'La gelateria migliore in zona. La consiglio! Personale gentile e cordiale.\r\nNon c\'è molto spazio all\'interno per sedersi e gustare il gelato, però hanno molti tavolini all\'esterno.\r\nComplimenti allo staff per l\'attenzione al proprio mestiere, si vede che c\'è impegno dietro.'),
(27, 78, '£Silvia£', 'Molto buono', '2019-07-12', 3, 'L\'ho scoperto per un passaparola perché rimane un po\' nascosto. Personale gentile, locale molto carino, ottimo gelato e rapporto qualità-prezzo. È anche bar.'),
(28, 78, 'anonimo', 'Vero gelato artigianale', '2018-06-13', 3, 'Vado spesso in questa gelateria, gelato artigianale con gusti favolosi e sempre vari! Consiglio cioccolato bianco e sale, pistacchio di bronte, miele e mandorla'),
(29, 78, 'elle.emme', 'Non solo buon gelato', '2017-03-12', 4, 'Il gelato è per loro una vera arte, ma Memo non è solo questo: si organizzano eventi a tema, feste di compleanno e laboratori per bambini e ragazzi. Mia figlia si è divertita tantissimo!'),
(30, 78, 'Raf_95', 'Memo-rabile.', '2018-05-12', 5, 'Senza dubbio la mia gelateria preferita, tutti i gusti sono strepitosi e variano ogni volta. Hanno anche un laboratorio con una scuola in cui insegnano a fare il gelato. Da provare il gusto \"sabbia\". Ciao!'),
(31, 81, 'elle.emme', 'Ristorante vegano TOP!', '2019-02-13', 5, 'Non ha bisogno di recensioni perché la sua fama lo precede, e devo dire meritatamente! Ero in viaggio con amici e ci siamo fermati a Roma di proposito per provare questo locale. Una scelta di piatti vegan vastissima. Camerieri gentilissimi e atmosfera davvero gradevole. Se abitassi a Roma sarei lì ogni settimana!'),
(32, 81, 'Raf_95', 'Cibo ok, ma troppo affollato.', '2020-08-01', 2, 'Mi era stato consigliato di andare a mangiare in questo ristorantino accanto alla stazione termini, molto rinomato. Il posto offre tavoli sia all\'interno che all\'esterno; date le temperature abbiamo preferito mangiare dentro, ma forse non era il caso. Il ristorante è davvero piccolo e i tavoli sono tutti vicini, non è possibile rispettare la distanza di sicurezza necessaria per il covid. Non ci siamo sentiti al sicuro.'),
(33, 81, 'anonimo', 'La tradizione in chiave veg', '2019-11-20', 4, 'Durante un recente soggiorno a Roma ho provato questo ristorante di cui avevo molto sentito parlare. Il suo punto di forza del locale è senz\'altro la possibilità di mangiare piatti tipici romani sia onnivori che rivisitati in chiave vegana (come i saltimbocca , le scaloppine, la carbonara e tante altre specialità preparate, ovviamente, senza derivati animali). Era tutto ottimo. Ottimo rapporto qualità prezzo e personale gentile.');

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `recensioni`
--
ALTER TABLE `recensioni`
  ADD PRIMARY KEY (`id_recensione`),
  ADD KEY `id_ristorante` (`id_ristorante`);

--
-- AUTO_INCREMENT per le tabelle scaricate
--

--
-- AUTO_INCREMENT per la tabella `recensioni`
--
ALTER TABLE `recensioni`
  MODIFY `id_recensione` int(16) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=125;

--
-- Limiti per le tabelle scaricate
--

--
-- Limiti per la tabella `recensioni`
--
ALTER TABLE `recensioni`
  ADD CONSTRAINT `recensioni_ibfk_3` FOREIGN KEY (`id_ristorante`) REFERENCES `dati_ristoranti` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
