-- phpMyAdmin SQL Dump
-- version 4.4.15.5
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1:3307
-- Время создания: Ноя 19 2017 г., 15:42
-- Версия сервера: 5.5.48
-- Версия PHP: 5.3.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `Econom`
--

-- --------------------------------------------------------

--
-- Структура таблицы `Bankrotstvo`
--

CREATE TABLE IF NOT EXISTS `Bankrotstvo` (
  `dvuhfaktor` float NOT NULL,
  `cheturehfaktor` float NOT NULL,
  `pyatifaktor` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `Bankrotstvo`
--

INSERT INTO `Bankrotstvo` (`dvuhfaktor`, `cheturehfaktor`, `pyatifaktor`) VALUES
(-38685.4, 6.07535, 2.10637);

-- --------------------------------------------------------

--
-- Структура таблицы `Koeficienti`
--

CREATE TABLE IF NOT EXISTS `Koeficienti` (
  `koef_koncentrac_sobstv_kapitala` float NOT NULL,
  `koef_finansirovania` float NOT NULL,
  `koef_koncentrac_zaem_kapitala` float NOT NULL,
  `koef_finance_ustoichivosti` float NOT NULL,
  `koef_manevrenost_sobstv_kapitala` float NOT NULL,
  `koef_obespech_zapasov_i_zatrat` float NOT NULL,
  `koef_sootnosheniya_vneoborot_i_oborot_activ` float NOT NULL,
  `koef_immushestva_proizvodstv` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `Koeficienti`
--

INSERT INTO `Koeficienti` (`koef_koncentrac_sobstv_kapitala`, `koef_finansirovania`, `koef_koncentrac_zaem_kapitala`, `koef_finance_ustoichivosti`, `koef_manevrenost_sobstv_kapitala`, `koef_obespech_zapasov_i_zatrat`, `koef_sootnosheniya_vneoborot_i_oborot_activ`, `koef_immushestva_proizvodstv`) VALUES
(20000, 21.7822, 0.0242356, 220000, 0.156915, 0.775805, 10.4349, 0.141574);

-- --------------------------------------------------------

--
-- Структура таблицы `MainTable`
--

CREATE TABLE IF NOT EXISTS `MainTable` (
  `id` int(11) NOT NULL,
  `start_year` varchar(100) NOT NULL,
  `year` varchar(100) NOT NULL,
  `nemat_activ` varchar(100) NOT NULL,
  `osn_sredstv` varchar(100) NOT NULL,
  `nezav_stroi` varchar(100) NOT NULL,
  `vloj_i_cennosti` varchar(100) NOT NULL,
  `financ_vloj` varchar(100) NOT NULL,
  `neoborot_activ` varchar(100) NOT NULL,
  `zapas` varchar(100) NOT NULL,
  `nalog` varchar(100) NOT NULL,
  `deb_zadolj` varchar(100) NOT NULL,
  `money` varchar(100) NOT NULL,
  `prochie_obor_activ` varchar(100) NOT NULL,
  `dolgosroch_obstoyatelstva_kreditov` varchar(100) NOT NULL,
  `prochie_dolgosroch_obstoyatelstva` varchar(100) NOT NULL,
  `kratkosroch_obstoyatelstva` varchar(100) NOT NULL,
  `kreditorskaya_zadolj` varchar(100) NOT NULL,
  `zadolj_po_viplate` varchar(100) NOT NULL,
  `rezervi_rashodov` varchar(100) NOT NULL,
  `prochie_kratkosroch_obyasatelstva` varchar(100) NOT NULL,
  `analitich_balanc` varchar(100) NOT NULL,
  `sobstvennie_sredstva` varchar(100) NOT NULL,
  `zaemnie_sredstva` varchar(100) NOT NULL,
  `nre` varchar(100) NOT NULL,
  `finance_izderjki` int(9) NOT NULL,
  `potrebn_oborot_activ` varchar(100) NOT NULL,
  `beznadej_debitorskaya_zadolj` varchar(100) NOT NULL,
  `viruchka_prodaj` varchar(100) NOT NULL,
  `sebestoimost_produkcii` varchar(100) NOT NULL,
  `mater_zatrati` varchar(100) NOT NULL,
  `chislo_dnei_vperiod` varchar(100) NOT NULL,
  `zapas_oborot_sredstv` varchar(100) NOT NULL,
  `faktich_sred_ostatki` varchar(100) NOT NULL,
  `srednie_ostatki_kratkosroch_obyaz` varchar(100) NOT NULL,
  `opf` varchar(100) NOT NULL,
  `komerch_rashodu` int(6) NOT NULL,
  `upravlench_rashodu` int(6) NOT NULL,
  `neraspred_pribil` int(6) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=170 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `MainTable`
--

INSERT INTO `MainTable` (`id`, `start_year`, `year`, `nemat_activ`, `osn_sredstv`, `nezav_stroi`, `vloj_i_cennosti`, `financ_vloj`, `neoborot_activ`, `zapas`, `nalog`, `deb_zadolj`, `money`, `prochie_obor_activ`, `dolgosroch_obstoyatelstva_kreditov`, `prochie_dolgosroch_obstoyatelstva`, `kratkosroch_obstoyatelstva`, `kreditorskaya_zadolj`, `zadolj_po_viplate`, `rezervi_rashodov`, `prochie_kratkosroch_obyasatelstva`, `analitich_balanc`, `sobstvennie_sredstva`, `zaemnie_sredstva`, `nre`, `finance_izderjki`, `potrebn_oborot_activ`, `beznadej_debitorskaya_zadolj`, `viruchka_prodaj`, `sebestoimost_produkcii`, `mater_zatrati`, `chislo_dnei_vperiod`, `zapas_oborot_sredstv`, `faktich_sred_ostatki`, `srednie_ostatki_kratkosroch_obyaz`, `opf`, `komerch_rashodu`, `upravlench_rashodu`, `neraspred_pribil`) VALUES
(164, 'Start year', '2014', '10000', '5000', '0', '2000', '8000', '800', '5000', '240', '90', '50000', '900', '6000', '1010', '3200', '8000', '1200', '6000', '5000', '2000', '100000', '1000', '200', 400, '4100', '600', '80000', '63000', '8000', '360', '7000', '4000', '1400', '5', 5000, 2000, 2000),
(165, 'Finish year', '2014', '14000', '5000', '0', '3000', '6000', '700', '1000', '220', '120', '30000', '800', '4000', '3000', '5000', '11100', '1500', '10000', '8650', '4000', '120000', '1000', '200', 100, '3200', '700', '120000', '10000', '14000', '360', '15000', '6000', '2200', '4', 4500, 2000, 1500),
(166, 'Start year', '2015', '12000', '7000', '0', '2000', '6000', '1200', '1000', '147', '150', '35000', '1000', '6000', '4000', '4020', '12000', '5000', '9000', '4660', '5050', '132000', '2050', '200', 100, '5000', '1000', '99000', '65000', '11000', '360', '11000', '5000', '3211', '4', 3699, 2500, 1900),
(167, 'Finish year', '2015', '16000', '4000', '0', '3000', '10000', '900', '1000', '195', '100', '47000', '700', '4000', '2900', '2500', '9000', '1500', '10000', '8666', '3000', '110000', '2000', '250', 100, '10000', '2000', '111000', '90000', '9000', '360', '8000', '6900', '3222', '4.5', 6000, 3333, 2200),
(168, 'Start year', '2016', '11500', '7000', '0', '2000', '7600', '950', '5000', '40', '60', '25000', '650', '6000', '3600', '3540', '9000', '5000', '15000', '6600', '5050', '123500', '2050', '200', 100, '7400', '2132', '79000', '78000', '13000', '360', '9000', '3433', '1400', '4', 3500, 3222, 1900),
(169, 'Finish year', '2016', '13000', '4000', '0', '3000', '9900', '780', '1050', '150', '50', '33000', '750', '4000', '3100', '4000', '7000', '1200', '11000', '7600', '3000', '112000', '2000', '250', 100, '6333', '2000', '99000', '97000', '7000', '360', '9000', '5000', '2100', '4.5', 4387, 1123, 2200);

-- --------------------------------------------------------

--
-- Структура таблицы `Param`
--

CREATE TABLE IF NOT EXISTS `Param` (
  `id_param` int(11) NOT NULL,
  `start_year` varchar(30) NOT NULL,
  `year` int(6) NOT NULL,
  `activi_raschet` int(11) NOT NULL,
  `pasivi_raschet` int(11) NOT NULL,
  `stoimost_activ` int(11) NOT NULL,
  `econom_rentabelnost` int(11) NOT NULL,
  `nalog_na_pribil` int(11) NOT NULL,
  `chistaya_pribil` int(11) NOT NULL,
  `rentabelnost_sredstv` int(11) NOT NULL,
  `ocenka_kachestva_zadolj` int(11) NOT NULL,
  `rashod_materialov` int(11) NOT NULL,
  `dostatochnaya_potrebnost` int(11) NOT NULL,
  `dostatochn_lvl_liquid` int(11) NOT NULL,
  `koef_obsolut_liquid` float NOT NULL,
  `koef_krit_fast_liquid` float NOT NULL,
  `koef_tekysh_liquid` float NOT NULL,
  `manevrenost_sobstv_oborot_activ` float NOT NULL,
  `koef_obespech_sobstv_sredstv` float NOT NULL,
  `koef_vostanov_pletejsposob` float NOT NULL,
  `stepen_platejnosti_obsh` float NOT NULL,
  `stepen_platejnosti_tekysh_pokazat` float NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=95 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `Param`
--

INSERT INTO `Param` (`id_param`, `start_year`, `year`, `activi_raschet`, `pasivi_raschet`, `stoimost_activ`, `econom_rentabelnost`, `nalog_na_pribil`, `chistaya_pribil`, `rentabelnost_sredstv`, `ocenka_kachestva_zadolj`, `rashod_materialov`, `dostatochnaya_potrebnost`, `dostatochn_lvl_liquid`, `koef_obsolut_liquid`, `koef_krit_fast_liquid`, `koef_tekysh_liquid`, `manevrenost_sobstv_oborot_activ`, `koef_obespech_sobstv_sredstv`, `koef_vostanov_pletejsposob`, `stepen_platejnosti_obsh`, `stepen_platejnosti_tekysh_pokazat`) VALUES
(89, 'Start year', 2014, 82030, 30410, 51620, 10, -40, -160, 0, 2, 22, 155556, 113, 18.125, 18.3125, 2.1875, 0.5, 14.2857, 0, 0.1775, 0.04),
(90, 'Finish year', 2014, 60840, 43250, 17590, 5, 20, 80, 0, 2, 39, 583333, 266, 7.2, 7.34, 3, 0.25, 8, 0, 0.147083, 0.0416667),
(91, 'Start year', 2015, 65497, 44680, 20817, 4, 20, 80, 0, 2, 31, 336111, 106, 10.199, 10.4478, 2.73632, 0.265152, 12, 0, 0.148283, 0.0406061),
(92, 'Finish year', 2015, 82895, 38566, 44329, 8, 30, 120, 0, 6, 25, 200000, 64, 22.8, 23.6, 3.2, 0.427273, 13.75, 0, 0.136631, 0.0225225),
(93, 'Start year', 2016, 59800, 48740, 11060, 4, 20, 80, 0, 4, 36, 325000, 235, 9.20904, 9.8113, 2.54237, 0.202429, 13.7222, 0, 0.204304, 0.0448101),
(94, 'Finish year', 2016, 65680, 37900, 27780, 8, 30, 120, 0, 3, 19, 175000, 85, 10.725, 11.225, 2.25, 0.294643, 12.4444, 0, 0.157576, 0.040404);

-- --------------------------------------------------------

--
-- Структура таблицы `Rentabelnost`
--

CREATE TABLE IF NOT EXISTS `Rentabelnost` (
  `id_rent` int(11) NOT NULL,
  `rentabelnost_activov` float NOT NULL,
  `rentabelnost_produktsii` float NOT NULL,
  `rentabelnost_prodaj` float NOT NULL,
  `rentabelnost_sobstv_kapitala` float NOT NULL,
  `rentabelnost_oborot_kapitala` float NOT NULL,
  `rentabelnost_proizvodstv_fondov` float NOT NULL,
  `rentabelnost_investic_predpriyat` float NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `Rentabelnost`
--

INSERT INTO `Rentabelnost` (`id_rent`, `rentabelnost_activov`, `rentabelnost_produktsii`, `rentabelnost_prodaj`, `rentabelnost_sobstv_kapitala`, `rentabelnost_oborot_kapitala`, `rentabelnost_proizvodstv_fondov`, `rentabelnost_investic_predpriyat`) VALUES
(15, 0.460717, 145.906, 145.761, 0.290782, 0.0767861, 3.2528, 0.278145);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `MainTable`
--
ALTER TABLE `MainTable`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `Param`
--
ALTER TABLE `Param`
  ADD PRIMARY KEY (`id_param`);

--
-- Индексы таблицы `Rentabelnost`
--
ALTER TABLE `Rentabelnost`
  ADD PRIMARY KEY (`id_rent`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `MainTable`
--
ALTER TABLE `MainTable`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=170;
--
-- AUTO_INCREMENT для таблицы `Param`
--
ALTER TABLE `Param`
  MODIFY `id_param` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=95;
--
-- AUTO_INCREMENT для таблицы `Rentabelnost`
--
ALTER TABLE `Rentabelnost`
  MODIFY `id_rent` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=16;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
