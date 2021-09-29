-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3307
-- Généré le : jeu. 28 jan. 2021 à 12:10
-- Version du serveur :  10.4.17-MariaDB
-- Version de PHP : 8.0.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `mediexperts`
--

-- --------------------------------------------------------

--
-- Structure de la table `actionnaires`
--

CREATE TABLE `actionnaires` (
  `id_act` int(10) UNSIGNED NOT NULL,
  `nom` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prenom` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nb_acts` int(11) NOT NULL,
  `percent` int(11) NOT NULL,
  `tag1` int(11) NOT NULL DEFAULT 1,
  `commentaire` varchar(5000) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nrc_e` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `cabinets`
--

CREATE TABLE `cabinets` (
  `nrc_cab` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `raisoci` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `formjury` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cap_soci` double NOT NULL,
  `dt_creat` date NOT NULL,
  `dom_compet1` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dom_compet2` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dom_compet3` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `materiel1` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `materiel2` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `materiel3` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_fiscal` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ncnss` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `npatente` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `effectif` int(11) NOT NULL,
  `autre_emp` int(11) NOT NULL,
  `nb_permanent` int(11) NOT NULL,
  `nb_vacataire` int(11) NOT NULL,
  `nb_formateur` int(11) NOT NULL,
  `nb_permanent_etr` int(11) NOT NULL,
  `nb_vacataire_etr` int(11) NOT NULL,
  `nb_formateur_etr` int(11) NOT NULL,
  `effectif_etr` int(11) NOT NULL,
  `autre_emp_etr` int(11) NOT NULL,
  `org_etranger` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'non',
  `nom_gr1` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pren_gr1` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `qualit_gr1` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nom_gr2` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pren_gr2` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `qualit_gr2` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `adress` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ville` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tele` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fax` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `website` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `commentaire` varchar(5000) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `cabinets`
--

INSERT INTO `cabinets` (`nrc_cab`, `raisoci`, `formjury`, `cap_soci`, `dt_creat`, `dom_compet1`, `dom_compet2`, `dom_compet3`, `materiel1`, `materiel2`, `materiel3`, `id_fiscal`, `ncnss`, `npatente`, `effectif`, `autre_emp`, `nb_permanent`, `nb_vacataire`, `nb_formateur`, `nb_permanent_etr`, `nb_vacataire_etr`, `nb_formateur_etr`, `effectif_etr`, `autre_emp_etr`, `org_etranger`, `nom_gr1`, `pren_gr1`, `qualit_gr1`, `nom_gr2`, `pren_gr2`, `qualit_gr2`, `adress`, `ville`, `tele`, `fax`, `email`, `website`, `commentaire`, `created_at`, `updated_at`) VALUES
('171287', 'Mediexperts', 'SARL', 600000, '2007-09-28', 'Formation et ingénierie de formation', 'Analyse stratégique', 'Accompagnement et organisation des entreprises', '3 Data show+ 10 ordinateurs + Imprimante +Fax', '4 salles de formation', '12 cellulaires + lignes groupées', '1107015', '7612999', '35890500', 160, 1, 9, 50, 100, 10, 0, 20, 30, 0, 'non', 'Soufiane', 'Raid', 'Co-Gérant', 'Belmokadem', 'Adil', 'Co-Gérant', '39, RUE AL FOURAT, 1er ETAGE, MAARIF, CASABLANCA', 'Casablanca', '0661680832', '0522991738', 'mediexperts@mediexperts.ma', 'https://mediexperts.ma', 'MediExperts est un cabinet de conseil en management des organisations.', '2020-07-24 05:28:19', '2020-11-25 14:22:02');

-- --------------------------------------------------------

--
-- Structure de la table `clients`
--

CREATE TABLE `clients` (
  `nrc_entrp` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `raisoci` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `rais_abrev` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ice` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `formjury` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dt_creat` date NOT NULL,
  `obj_soci` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `capt_soci` double(20,2) NOT NULL,
  `sect_activ` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `giac_rattach` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_fiscal` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ncnss` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `npatente` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `chif_aff_1` double(20,2) DEFAULT NULL,
  `chif_aff_2` double(20,2) DEFAULT NULL,
  `chif_aff_3` double(20,2) DEFAULT NULL,
  `chif_aff_4` double(20,2) DEFAULT NULL,
  `effectif` int(11) NOT NULL,
  `mass_salar` double(20,2) DEFAULT NULL,
  `tax_form_pers` double(20,2) DEFAULT NULL,
  `der_annee_csf` int(11) DEFAULT NULL,
  `nb_permanent` int(11) NOT NULL,
  `nb_employe` int(11) NOT NULL,
  `nb_occasional` int(11) NOT NULL,
  `nb_ouvrier` int(11) NOT NULL,
  `nb_cadre` int(11) NOT NULL,
  `IF1_1` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'non réalisée',
  `DS1_2` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'non réalisée',
  `PF1_3` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'non réalisée',
  `IF2_1` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'non réalisée',
  `DS2_2` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'non réalisée',
  `PF2_3` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'non réalisée',
  `IF3_1` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'non réalisée',
  `DS3_2` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'non réalisée',
  `PF3_3` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'non réalisée',
  `annee_deja1` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `annee_deja2` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `annee_deja3` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tel_1` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tel_2` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fix_1` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fix_2` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fax_1` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fax_2` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `website` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sg_soci` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `local_2` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ville` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nom_dg1` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fonct_dg1` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gsm_dg1` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_dg1` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nom_dg2` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fonct_dg2` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gsm_dg2` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_dg2` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nom_resp` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fonct_resp` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gsm_resp` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_resp` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `rib` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `agence_banc` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `estim_bgd_DS` double(20,2) DEFAULT NULL,
  `estim_bdg_IF` double(20,2) DEFAULT NULL,
  `estim_bdg_PF` double(20,2) DEFAULT NULL,
  `dt_relation` date NOT NULL,
  `commentaire` varchar(5000) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `clients`
--

INSERT INTO `clients` (`nrc_entrp`, `raisoci`, `rais_abrev`, `ice`, `formjury`, `dt_creat`, `obj_soci`, `capt_soci`, `sect_activ`, `giac_rattach`, `id_fiscal`, `ncnss`, `npatente`, `chif_aff_1`, `chif_aff_2`, `chif_aff_3`, `chif_aff_4`, `effectif`, `mass_salar`, `tax_form_pers`, `der_annee_csf`, `nb_permanent`, `nb_employe`, `nb_occasional`, `nb_ouvrier`, `nb_cadre`, `IF1_1`, `DS1_2`, `PF1_3`, `IF2_1`, `DS2_2`, `PF2_3`, `IF3_1`, `DS3_2`, `PF3_3`, `annee_deja1`, `annee_deja2`, `annee_deja3`, `tel_1`, `tel_2`, `fix_1`, `fix_2`, `fax_1`, `fax_2`, `website`, `sg_soci`, `local_2`, `ville`, `nom_dg1`, `fonct_dg1`, `gsm_dg1`, `email_dg1`, `nom_dg2`, `fonct_dg2`, `gsm_dg2`, `email_dg2`, `nom_resp`, `fonct_resp`, `gsm_resp`, `email_resp`, `rib`, `agence_banc`, `estim_bgd_DS`, `estim_bdg_IF`, `estim_bdg_PF`, `dt_relation`, `commentaire`, `created_at`, `updated_at`) VALUES
('103827', 'BURINTEL', 'BURINTEL', '000027618000050', 'S.A', '2000-05-01', 'Matériels informatiques', 5000000.00, 'TECHNOLOGIE', 'Giac Technologies', '1087144', '6232483', '34770458', 75632450.30, 68500000.00, 64670000.00, 0.00, 21, 1122.00, 60117.23, 2019, 6, 3, 0, 5, 7, 'non réalisée', 'réalisée', 'réalisée', 'non réalisée', 'non réalisée', 'non réalisée', 'non réalisée', 'non réalisée', 'non réalisée', '2020', NULL, NULL, '0661908484', NULL, '0522 25 47 22', NULL, '0522 25 47 62', NULL, 'http://www.burintel.com/', '03 Rue Ibrahim Ibnou Adham Maarif, CASABLANCA.', 'Casablanca', 'Casablanca', 'NAWAL BENJELLON', 'Gérante', '0661908484', 'burintel@burintel.net', NULL, NULL, NULL, NULL, 'NAWAL BENJELLON', 'Gérante', '0661908484', 'burintel@burintel.net', '0000', '0', NULL, NULL, NULL, '2019-01-01', NULL, '2020-10-21 13:12:02', '2020-11-25 14:16:49'),
('10963', 'Biscuiterie Moderne Zine', 'BMZ', '001878788000038', 'S.a.r.l', '2017-02-27', 'Exploitant biscuiterie industrielle marchand effec', 10000000.00, 'Agro Alimentaire', 'GIAC AGROALIMENTAIRE', '20751280', '5249116', '9962', 56567000.00, NULL, NULL, NULL, 101, 0.00, 0.00, 2019, 101, 49, 0, 41, 11, 'non réalisée', 'non réalisée', 'non réalisée', 'non réalisée', 'non réalisée', 'non réalisée', 'non réalisée', 'non réalisée', 'non réalisée', NULL, NULL, NULL, '0522 967 777', NULL, '0522 786 092', NULL, NULL, NULL, 'http://www.zinecapitalinvest.ma/', 'Route principale 3011, zone industrielle Sahel Had Soualem', 'Had Soualem', 'Settat', 'NOURREDDINE ZINE', 'PRÉSIDENT DIRECTEUR GÉNÉRAL', NULL, NULL, NULL, NULL, NULL, NULL, 'MOUNIR BAZE', 'DRH', NULL, 'm.baze@zinecapitalinvest.ma', '0000001', 'a.remplr', NULL, NULL, NULL, '2019-01-01', NULL, '2020-10-23 09:47:01', '2020-12-25 14:48:26'),
('11111', 'TEST ENTREPRISE', 'VIVO', '54641641648', 'SARL', '2011-03-09', 'TECHNOLOGIES', 1000000000.00, 'TECHNOLOGIES', 'GIAC AGROALIMENTAIRE', '8419819841', '5415848549', '58418416', 100000000.00, NULL, 100000000.00, 100000000.00, 50, 1000000.00, 10000.00, 2019, 20, 0, 10, 10, 10, 'non réalisée', 'non réalisée', 'non réalisée', 'non réalisée', 'non réalisée', 'non réalisée', 'non réalisée', 'non réalisée', 'non réalisée', '2015', '2017', '2019', '+212611111111', '+212611111111', '+212611111111', '+212611111111', '+212611111111', '+212611111111', 'https://vivo.com', '6640 W Belden Ave, Elmwood Park, IL, 60707', '6640 W Belden Ave, Elmwood Park, IL, 60707', 'Fès', 'Ali Ahmed', 'PDG', '+212611111111', 'pdg@vivo.com', NULL, NULL, NULL, NULL, 'Ahmed Karim', 'Responsable', '+212611111111', 'pdg@vivo.com', '6573988636866386368638', 'BMCI', 1000000.00, 1000000.00, 1000000.00, '2019-11-04', 'EZAFR', '2020-07-24 06:38:57', '2020-12-02 12:24:48'),
('117713', 'TRANSDINE', 'TRSD', '001539780000043', 'SARL', '2002-02-13', 'Transport Logistique', 6000000.00, 'Transport et distribution', 'GIAC TRANSLOG', '2521378', '6562898', '31468528', 0.00, 0.00, 0.00, 0.00, 278, 0.00, 0.00, 2019, 278, 269, 0, 4, 5, 'réalisée', 'réalisée', 'réalisée', 'réalisée', 'non réalisée', 'réalisée', 'réalisée', 'non réalisée', 'réalisée', '2017', '2018', '2019', '0', '0', '0', '0', '0', '0', 'https://zinecapitalinvest.ma', 'ROUTE PRINCIPALE 3011 ZONE INDUSTRIELLE', 'Casablanca', 'Casablanca', 'NOURREDDINE ZINE', 'PRÉSIDENT DIRECTEUR GÉNÉRAL', '0', 'n.zine@canalfood.ma', NULL, NULL, '0', NULL, 'Mounir baze', 'DRH', '0', 'm.baze@zinecapitalinvest.ma', '190780212119079000976', 'banqur populaire', 0.00, 0.00, 0.00, '2017-02-01', NULL, '2020-09-18 09:40:48', '2020-12-25 14:43:14'),
('126089', 'ROLINO', 'ROLINO', '000013812000041', 'SARL', '2003-01-01', 'Fabrication de produits en caoutchouc', 800000.00, 'INDUSTRIE', 'GIAC 1', '2203052', '6631057', '3209003', 7953687.00, 8998030.00, 8450592.00, NULL, 32, NULL, 30345.00, 2021, 32, 5, 0, 23, 4, 'non réalisée', 'non réalisée', 'non réalisée', 'non réalisée', 'non réalisée', 'non réalisée', 'non réalisée', 'non réalisée', 'non réalisée', NULL, NULL, NULL, '0708030287', NULL, '0522539696', NULL, NULL, NULL, 'https://www.rolino.ma', 'Aéropôle de Nouaceur, Casablanca 20240', 'Casablanca', 'Casablanca', 'Mostafa Bendoudouch', 'Gérant', '0661411568', 'mostafa.bendoudouch@rolino.ma', NULL, NULL, NULL, NULL, 'Younes Bendoudouch', 'Directeur Digital  - SI', '0708030287', 'younes.bendoudouch@rolino.ma', NULL, NULL, NULL, NULL, NULL, '2020-12-31', NULL, '2021-01-14 15:12:43', '2021-01-19 14:52:04'),
('143199', 'CANAL FOOD', 'CF', '001539608000031', 'SARL', '2019-09-05', 'agroalimentaire', 32000000.00, 'DISTRIBUTION', 'GIAC AGROALIMENTAIRE', '2261026', '7063978', '32990189', 205500000.00, 0.00, 0.00, 0.00, 848, 0.00, 0.00, 2019, 848, 696, 0, 117, 35, 'non réalisée', 'non réalisée', 'non réalisée', 'non réalisée', 'non réalisée', 'non réalisée', 'non réalisée', 'non réalisée', 'non réalisée', '2017', '2018', '2019', '0', '0', '0', '0', '0522967777', '0522964908', 'https:/www.zinecapitalinvest.ma', 'ZONE INDUSTRIELLE SAHEL ROUTE PRINCAPIALE 3011 HAD SOUALEM, MAROC', 'Casablanca', 'Casablanca', 'Nourredine ZINE', 'PRÉSIDENT DIRECTEUR GÉNÉRAL', '0', 'n.zine@canalfood.ma', '0', '0', '0', 'a-remplir@test.com', 'Mounir BAZE', 'DRH', '0660309339', 'm.baze@zinecapitalinvest.ma', '190780212119006972000008', 'Banque Populaire', 0.00, 0.00, 0.00, '2017-02-01', NULL, '2020-09-17 11:23:20', '2020-12-25 14:44:40'),
('193231', 'LES GRANDS MOULINS ZINE', 'LGMZ', '000196725000048', 'SARL', '2008-12-30', 'Agroalimentaire', 21000000.00, 'Moture de blé tendre', 'GIAC AGROALIMENTAIRE', '40277608', '7961974', '32930803', 60400000.00, 0.00, 0.00, 0.00, 270, 0.00, 0.00, 2019, 270, 114, 0, 138, 18, 'réalisée', 'non réalisée', 'réalisée', 'réalisée', 'réalisée', 'réalisée', 'réalisée', 'non réalisée', 'réalisée', '2017', '2018', '2019', '0', '0', '0522320107', '0522320178', '0', '0', 'https://www.zinecapitalinvest.m', 'Douar lagwassem  Bouskoura', 'Casablanca', 'Casablanca', 'Nourredine ZINE', 'PRÉSIDENT DIRECTEUR GÉNÉRAL', '0', 'n.zine@canalfood.ma', '0', '0', '0', NULL, 'Mounir BAZE', 'DRH', '0660309339', 'm.baze@zinecapitalinvest.ma', '190780212119556370001054', 'Banque Populaire', 0.00, 0.00, 0.00, '2017-02-01', NULL, '2020-09-18 06:40:09', '2021-01-06 16:28:44'),
('251529', 'SCRH Group', 'SCRH', '000213862000039', 'SARLAU', '2012-01-18', 'Entreprise de Recrutement et d\'Emploi', 200000.00, 'Secteur tertiaire', 'Giac tertiaire', '40459645', '9000077', '34792313', 6349853.48, 0.00, 0.00, 0.00, 105, 0.00, 73743.41, 2020, 105, 0, 0, 100, 5, 'non réalisée', 'réalisée', 'réalisée', 'non réalisée', 'non réalisée', 'non réalisée', 'non réalisée', 'non réalisée', 'non réalisée', '2020', NULL, NULL, '05 22 99 4867', '0', '05 22 99 1812', '0', '0', '0', 'https://www.scrhgroup.com', '210 BD ABDELMOUMEN Immeuble G2 N°4 CASABLANCA', 'Casablanca', 'Casablanca', 'FAHS MOHAMED', 'Gérant', '0661470407', 'm.fahs@scrhgroup.com', '--', '--', '--', 'none@none.none', 'FAHS MOHAMED', 'Gérant', '06 61 47 04 07', 'm.fahs@scrhgroup.com', '013 780 01283 000021 001 34', 'BMCI', 0.00, 0.00, 0.00, '2020-10-01', NULL, '2020-10-05 06:46:29', '2020-10-20 11:28:45'),
('254391', 'SYSTEMS ADVISERS GROUP', 'SGLOBAL', '000062689000047', 'S.A', '2012-02-28', 'Conseil, intégration et développement de solutions', 1000000.00, 'INGENIERIE ET SYSTEMES D\'INFORMATIONS', 'Giac Technologies', '40469493', '9041740', '34792375', 0.00, 0.00, 0.00, 0.00, 34, 0.00, 0.00, 2019, 0, 12, 0, 0, 22, 'non réalisée', 'non réalisée', 'non réalisée', 'non réalisée', 'non réalisée', 'non réalisée', 'non réalisée', 'non réalisée', 'non réalisée', '2017', '2018', '2019', '05 22 44 5428', '0', '05 22 44 3800', '0', '0', '0', 'https://www.saglobal.com/fr-ma/', '19 Rue Outba bnou ghazouane quartier palmier Casablanca', 'Casablanca', 'Casablanca', 'MOURAD JBIHA', 'DIRECTEUR GENERAL', '05 22 44 5428', 'mouradj@saglobal.com', '0', '00', '000', 'a-remplir@none.none', 'MOURAD JBIHA', 'DIRECTEUR GENERAL', '05 22 44 5428', 'mouradj@saglobal.com', '157570 2121116065630000 75', 'BP', 0.00, 0.00, 0.00, '2016-01-01', NULL, '2020-10-05 09:59:16', '2020-11-24 12:51:21'),
('286479', 'LES GRANDES SEMOULERIES ZINE', 'LGSZ', '000032849000045', 'SARL', '2013-08-07', 'Minoterie', 10000000.00, 'Agroalimentaire', 'GIAC AGROALIMENTAIRE', '14448724', '9174989', '32020358', 307000000.00, 0.00, 0.00, 0.00, 102, 0.00, 107068.00, 2019, 102, 37, 0, 54, 11, 'non réalisée', 'non réalisée', 'non réalisée', 'non réalisée', 'non réalisée', 'non réalisée', 'non réalisée', 'non réalisée', 'non réalisée', '2017', '2018', '2019', '0522334148', '0522592513', '0522334148', '0522592513', '0522592513', '0', 'http://www.zinecapitalinvest.ma/fr/', 'Zone industrielle Ouled Saleh-Bouskoura', 'Had Soualem', 'Settat', 'Nourredine ZINE', 'PRÉSIDENT DIRECTEUR GÉNÉRAL', '0', 'n.zine@canalfood.ma', NULL, NULL, NULL, 'contact@zinecapitalinvest.ma', 'BAZE MOUNIR', 'DIRECTEUR RH', '0660309339', 'm.baze@zinecapitalinvest.ma', '190780212118884958000945', 'Banque Populaire', 0.00, 0.00, 0.00, '2017-01-01', NULL, '2020-09-17 06:42:38', '2020-12-25 14:46:18'),
('296871', 'Hava Hard Trade', 'HAVA', '000083353000063', 'SARL', '2014-01-01', 'La distribution des produits de quincaillerie', 2500000.00, 'Bâtiment et travaux publics', 'GIAC BTP', '14488648', '9811325', '37948432', 19000000.00, 22000000.00, 20000000.00, 11000000.00, 12, 553847.00, 27288.00, 2019, 0, 2, 0, 5, 5, 'non réalisée', 'non réalisée', 'non réalisée', 'non réalisée', 'non réalisée', 'non réalisée', 'non réalisée', 'non réalisée', 'Réalisée', NULL, NULL, '2019', '0662555644', '05 22 40 4456', '05 22 40 44 5', NULL, NULL, NULL, 'https://vetra.ma', '644 Bd Mohamed V, 3éme étage N°7, belvédère. Casablanca.', 'Casablanca', 'Casablanca', 'Said BENOSMANE', 'Directeur Général', '05 22 40 4456', 'exploitation@havanegoce.com', NULL, NULL, NULL, NULL, 'Belaid OUJANA', 'Responsable', '05 22 40 4456', 'exploitation@havanegoce.com', '000000', 'aremplir', NULL, NULL, NULL, '2019-01-01', 'A remplir RIB + AGENCE', '2020-10-20 08:51:52', '2020-10-20 08:51:52'),
('328729', 'ZINE CAPITAL INVEST', 'ZCI', '001606285000072', 'SA', '2015-06-08', 'Valeurs mobilières', 405000000.00, 'Gestion des valeurs mobilieres', 'Giac tertiaire', '15260781', '4302618', '36167345', 0.00, 0.00, 0.00, 0.00, 23, 0.00, 0.00, 2019, 23, 0, 0, 0, 23, 'non réalisée', 'non réalisée', 'non réalisée', 'non réalisée', 'non réalisée', 'non réalisée', 'non réalisée', 'non réalisée', 'non réalisée', '2017', '2018', '2019', '0522786089', '0522786092', '0', '0', '0', '0', 'https://www.zinecapitalinvestt.ma', 'Lotissement la Colline II n°10 .Sidi Maarouf', 'CASABLANCA', 'Casablanca', 'Nourredine ZINE', 'PRÉSIDENT DIRECTEUR GÉNÉRAL', '0', 'n.zine@canalfood.ma', NULL, NULL, NULL, NULL, 'Mounir BAZE', 'DRH', '0', 'm.baze@zinecapitalinvest.ma', '190780212111314355000387', 'Banque populaire', 0.00, 0.00, 0.00, '2017-01-30', NULL, '2020-09-18 10:59:48', '2020-12-25 14:46:37'),
('376161', 'Sales Uplift', 'Uplift', '001923722000096', 'SARL', '2017-07-01', 'Logistique et distribution', 500000.00, 'Logistique', 'GIAC TRANSLOG', '20775319', '5483756', '36397176', 0.00, 0.00, 0.00, 0.00, 68, 0.00, 0.00, 2019, 68, 43, 0, 13, 12, 'non réalisée', 'réalisée', 'réalisée', 'non réalisée', 'non réalisée', 'non réalisée', 'non réalisée', 'non réalisée', 'non réalisée', '2019', '0', '0', '0614905110', '0', '0522583763', '0', '0522976742', '0', 'https://salesuplift.ma', 'N11, Immeuble E, Résidence Al Ahfad, 3éme étage. Boulevard Abou Bakr El Kadiri.', 'Casablanca', 'Casablanca', 'ADIL RAISS EL FENNI', 'Directeur Général', '0522583763', 'adil.raiss@sales-uplift.com', '0', '0', '0', 'kiu@jhbjh.com', 'ADIL RAISS EL FENNI', 'Directeur Général', '0522583763', 'adil.raiss@sales-uplift.com', '0', '0', 0.00, 0.00, 0.00, '2019-10-01', NULL, '2020-09-23 04:25:42', '2020-10-06 06:26:12'),
('38419', 'AMANI AGROALIMENTAIRE', 'AMANI', '000167446000031', 'SARL AU', '2011-09-14', 'Production de pâtes alimentaires', 6804000.00, 'Agro Alimentaire', 'GIAC AGROALIMENTAIRE', '40433766', '8891469', '17316041', 13894905.00, 15390340.00, 9097591.00, NULL, 33, NULL, 17928.00, 2021, 21, 14, 12, 2, 5, 'non réalisée', 'non réalisée', 'non réalisée', 'non réalisée', 'non réalisée', 'non réalisée', 'non réalisée', 'non réalisée', 'non réalisée', NULL, NULL, NULL, '0661345181', NULL, '0535500022', NULL, '0535500004', NULL, 'http://www.amaniagro.com/index.html', 'QUARTIER INDUSTRIEL BASSATINE MEKNES', 'Meknés', 'Meknès', 'M’hamed Ben taleb', 'Gérant', '0661345181', 'm.bentaleb@amaniagro.com', NULL, NULL, NULL, NULL, 'M’hamed Ben taleb', 'Gérant', '0661345181', 'm.bentaleb@amaniagro.com', '230492921320322102900080', 'CIH AIN TAOUJDATE', NULL, NULL, NULL, '2020-12-31', NULL, '2021-01-14 15:37:19', '2021-01-14 15:37:19'),
('45307', 'MAROC TISSUS PLASTIFIES', 'MATIPLAS', '000230889000090', 'SARL', '1984-12-17', 'Fabrication de Tissus Plastifiés, Cartons Plastifi', 8000000.00, 'INDUSTRIE', 'Giac textile et cuir', '1640033', '1155599', '30300390', 36832708.90, NULL, NULL, NULL, 53, NULL, 53433.35, 2020, 0, 0, 0, 41, 12, 'non réalisée', 'non réalisée', 'non réalisée', 'non réalisée', 'non réalisée', 'non réalisée', 'non réalisée', 'non réalisée', 'non réalisée', NULL, NULL, NULL, '0522 35 32 18', '0522 35 32 43', '0522 35 32 43', NULL, '0522 35 31 98', NULL, 'https://matiplas.ma', 'Angle Chemin Dahlias et Chemin Glaieuls Aïn Sebâa Casablanca.', 'Casablanca', 'Casablanca', 'MEHDI MIYARA', 'Directeur Général', '0654775836', 'matiplas@menara.ma', NULL, NULL, NULL, NULL, 'MEHDI MIYARA', 'Gérant', '0654775836', 'matiplas@menara.ma', '011780 0000 10 210 00 6646 90', 'BMCE', NULL, NULL, NULL, '2016-01-01', NULL, '2020-10-21 11:34:56', '2020-10-21 11:34:56'),
('5587', 'ZINE CEREALES', 'ZC', '001552391000016', 'SARL', '2011-01-07', 'Agroalimentaire', 70000000.00, 'Négoce de céréales, aliments de bétail et engrais', 'GIAC AGROALIMENTAIRE', '01680247', '8407050', '55710217', 159300000.00, 0.00, 0.00, 0.00, 181, 0.00, 0.00, 2019, 181, 100, 0, 70, 11, 'non réalisée', 'non réalisée', 'non réalisée', 'non réalisée', 'non réalisée', 'non réalisée', 'non réalisée', 'non réalisée', 'non réalisée', '2017', '2018', '2019', '0', '0', '0', '0', '0', '0', 'https://www.zinecapitalinvest.ma', 'Zone Industrielle Route Principale 3011 Had Soualem', 'Had Soualem', 'Settat', 'Nourredine ZINE', 'PRÉSIDENT DIRECTEUR GÉNÉRAL', '0', 'n.zine@canalfood.ma', NULL, NULL, NULL, NULL, 'Mounir BAZE', 'DRH', '+21260309339', 'm.baze@zinecapitalinvest.ma', '190780212112641760000788', 'Banque Populaire', 0.00, 0.00, 0.00, '2017-02-01', NULL, '2020-09-17 10:17:32', '2020-12-25 14:47:07'),
('7077', 'COMPLEXE ALIMENTAIRE ZINE', 'CALZ', '000031691000077', 'SARL', '2013-02-13', 'FABRICATION ET CONDITIONNEMENT DE PATES ET COUSCOU', 10000000.00, 'AGROALIMENTAIRE', 'GIAC AGROALIMENTAIRE', '14407420', '9174806', '55710221', 179830000.00, 0.00, 0.00, 0.00, 95, 0.00, 101421.00, 2019, 95, 0, 0, 87, 8, 'réalisée', 'réalisée', 'réalisée', 'réalisée', 'non réalisée', 'réalisée', 'réalisée', 'non réalisée', 'réalisée', '2017', '2018', '2019', '0669053082', '0669053082', '0522963689', '0522963689', '0522963684', '0522963684', 'http://www.zinecapitalinvest.ma', 'Zone industrielle, Sahel Had soualem', 'Had Soualem', 'Settat', 'NOURREDDINE ZINE', 'PRESIDENT DIRECTEUR GENERAL', '0522963689', 'n.zine@canalfood.ma', '--', '--', '0', NULL, 'BAZE MOUNIR', 'DIRECTEUR RH', '0660309339', 'm.baze@canalfood.ma', '011780000029210000074301', 'BMCE', 120000.00, 100000.00, 200000.00, '2017-01-01', NULL, '2020-08-04 05:26:34', '2021-01-06 16:29:18'),
('91175', 'Leader Food', 'LDF', '000013334000046', 'S.A', '1999-06-01', 'Fabrication de chips et snacks', 14920000.00, 'FABRICATION CHIPS ET SNACKS', 'GIAC AGROALIMENTAIRE', '1900841', '6091160', '00', 122564000.00, 100000000.00, NULL, NULL, 216, NULL, 222865.00, 2018, 128, 29, 0, 178, 9, 'non réalisée', 'non réalisée', 'non réalisée', 'non réalisée', 'non réalisée', 'non réalisée', 'non réalisée', 'non réalisée', 'non réalisée', NULL, NULL, NULL, '0522344442', NULL, '0522344442', NULL, NULL, NULL, 'http://www.leader-food.com/', 'BD CHEFCHAOUINI RUE SB Q1 SIDI BERNOUSSI', 'Casablanca', 'Casablanca', 'LARAKI HOSSEIN', 'DIRECTEUR GENERAL', '0522344442', 'h.laraki@leader-food.com', NULL, NULL, NULL, NULL, 'Ahmed BOUDRAA', 'DAF', '0661832879', 'a.boudraa@leader-food.com', '22780000001000600000000', 'SOCIETE GENERALE', NULL, NULL, NULL, '2018-01-01', NULL, '2020-11-02 07:39:43', '2021-01-06 16:01:46');

-- --------------------------------------------------------

--
-- Structure de la table `demande_financements`
--

CREATE TABLE `demande_financements` (
  `n_df` bigint(20) UNSIGNED NOT NULL,
  `d_eligib_csf_entrp` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'non préparé',
  `type_miss` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `annee_exerc` int(11) NOT NULL,
  `gc_rattach` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nb_interv` int(11) DEFAULT NULL,
  `dt_df` date DEFAULT NULL,
  `jr_hm_demande` int(11) DEFAULT NULL,
  `bdg_demande` double DEFAULT NULL,
  `d_bulltin_adhes` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'non préparé',
  `d_df_DS` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'non préparé',
  `d_df_IF` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'non préparé',
  `d_cheque` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'non préparé',
  `f_renseign_entrp` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'non préparé',
  `f_etude_DS` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'non préparé',
  `f_etude_IF` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'non préparé',
  `l_tierpay_DS` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'non préparé',
  `l_tierpay_IF` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'non préparé',
  `d_honor` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'non préparé',
  `d_model6_n_1` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'non préparé',
  `d_model6_n_2` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'non préparé',
  `d_honor_act_form` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'non préparé',
  `doss_jury` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'non préparé',
  `at_csf_doc` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT 'non préparé',
  `dem_csf` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'non préparé',
  `f1` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'non préparé',
  `d_statut` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'non préparé',
  `d_rc` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'non préparé',
  `at_domic_banc` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'non préparé',
  `d_pouvoir` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'non préparé',
  `at_csf_entrp` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'non préparé',
  `dt_at_csf` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT '',
  `bdg_pf` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT '',
  `at_qual_cab` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'non préparé',
  `at_compte` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT 'non préparé',
  `f_renseign_cab` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'non préparé',
  `d_eligib_csf_cab` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'non préparé',
  `d_fact_proforama_ds` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'non préparé',
  `d_fact_proforama_if` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'non préparé',
  `d_propal_DS` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'non préparé',
  `d_propal_IF` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'non préparé',
  `d_cv_consult_miss` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'non préparé',
  `dt_depos_df` date DEFAULT NULL,
  `accus_depos` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT 'non préparé',
  `dt_accord` date DEFAULT NULL,
  `ct_DS` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'non préparé',
  `ct_IF` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'non préparé',
  `dt_dep_contrat` date DEFAULT NULL,
  `dt_debut_miss` date DEFAULT NULL,
  `dt_fin_miss` date DEFAULT NULL,
  `jr_hm_valid` int(11) DEFAULT NULL,
  `cote_part_entrp` double DEFAULT NULL,
  `prc_cote_part` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bdg_accord` double DEFAULT NULL,
  `bdg_letter` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `av_realis_DS` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'non préparé',
  `av_realis_IF` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'non préparé',
  `dt_envoi_av` date DEFAULT NULL,
  `planing_DS` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'non préparé',
  `planing_IF` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'non préparé',
  `rpt_realis` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'non préparé',
  `dt_fin_realis` date DEFAULT NULL,
  `at_approb` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'non préparé',
  `dt_approb` date DEFAULT NULL,
  `p_garde_DS` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'non préparé',
  `p_garde_IF` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'non préparé',
  `dem_approb_ds` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'non préparé',
  `dem_approb_if` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'non préparé',
  `f2` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'non préparé',
  `model_1` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'non préparé',
  `rpt_depose` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'non préparé',
  `dt_depos_rpt` date DEFAULT NULL,
  `commentaire` varchar(10000) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `etat` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nrc_e` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `demande_financements`
--

INSERT INTO `demande_financements` (`n_df`, `d_eligib_csf_entrp`, `type_miss`, `annee_exerc`, `gc_rattach`, `nb_interv`, `dt_df`, `jr_hm_demande`, `bdg_demande`, `d_bulltin_adhes`, `d_df_DS`, `d_df_IF`, `d_cheque`, `f_renseign_entrp`, `f_etude_DS`, `f_etude_IF`, `l_tierpay_DS`, `l_tierpay_IF`, `d_honor`, `d_model6_n_1`, `d_model6_n_2`, `d_honor_act_form`, `doss_jury`, `at_csf_doc`, `dem_csf`, `f1`, `d_statut`, `d_rc`, `at_domic_banc`, `d_pouvoir`, `at_csf_entrp`, `dt_at_csf`, `bdg_pf`, `at_qual_cab`, `at_compte`, `f_renseign_cab`, `d_eligib_csf_cab`, `d_fact_proforama_ds`, `d_fact_proforama_if`, `d_propal_DS`, `d_propal_IF`, `d_cv_consult_miss`, `dt_depos_df`, `accus_depos`, `dt_accord`, `ct_DS`, `ct_IF`, `dt_dep_contrat`, `dt_debut_miss`, `dt_fin_miss`, `jr_hm_valid`, `cote_part_entrp`, `prc_cote_part`, `bdg_accord`, `bdg_letter`, `av_realis_DS`, `av_realis_IF`, `dt_envoi_av`, `planing_DS`, `planing_IF`, `rpt_realis`, `dt_fin_realis`, `at_approb`, `dt_approb`, `p_garde_DS`, `p_garde_IF`, `dem_approb_ds`, `dem_approb_if`, `f2`, `model_1`, `rpt_depose`, `dt_depos_rpt`, `commentaire`, `etat`, `nrc_e`, `created_at`, `updated_at`) VALUES
(1, 'préparé', 'diagnostic stratégique', 2010, 'GIAC AGROALIMENTAIRE', 3, '2020-09-03', 10, 10000, 'giac', 'giac', 'non préparé', 'giac', 'giac', 'giac', 'non préparé', 'giac', 'non préparé', 'giac', 'préparé', 'préparé', 'préparé', 'giac', 'giac', 'ofppt', 'ofppt', 'ofppt', 'ofppt', 'ofppt', 'ofppt', 'préparé', '2020-11-06', 'non préparé', 'giac', 'giac', 'giac', 'giac', 'giac', 'non préparé', 'giac', 'non préparé', 'giac', '2020-11-06', 'préparé', '2020-11-07', 'giac', 'non préparé', '2020-11-06', '2020-11-06', '2020-11-11', 10, 5000, '30%', 10000, 'DOUZE MILLE', 'préparé', 'non préparé', '2020-11-06', 'préparé', 'non préparé', 'préparé', '2020-11-06', 'préparé', '2020-11-06', 'préparé', 'non préparé', 'préparé', 'non préparé', 'non préparé', 'non préparé', 'préparé', '2020-11-06', 'La demande est approuvé et la DRB GIAC est initié', 'approuvé', '11111', '2020-11-12 14:11:16', '2020-12-03 09:21:30'),
(2, 'préparé', 'diagnostic stratégique', 2020, 'Giac Technologies', 3, '2020-11-20', 21, 147000, 'giac', 'non préparé', 'non préparé', 'giac', 'giac', 'giac', 'non préparé', 'giac', 'non préparé', 'giac', 'non préparé', 'non préparé', 'non préparé', 'giac', 'giac', 'ofppt', 'ofppt', 'ofppt', 'ofppt', 'ofppt', 'ofppt', 'préparé', '2020-11-28', 'non préparé', 'giac', 'giac', 'giac', 'giac', 'giac', 'non préparé', 'giac', 'non préparé', 'giac', '2020-03-12', 'préparé', '2020-07-27', 'giac', 'non préparé', '2020-09-22', '2020-08-03', '2020-08-08', 16, 40000, '30%', 80000, 'QUATRE-VINGT-SEIZE MILLE', 'préparé', 'non préparé', '2020-09-22', 'préparé', 'non préparé', 'préparé', '2020-10-17', 'préparé', '2020-10-23', 'préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'préparé', '2020-10-19', NULL, 'approuvé', '103827', '2020-11-16 13:18:22', '2020-12-02 15:15:41'),
(3, 'préparé', 'ingénierie de formation', 2020, 'Giac Technologies', 4, '2020-10-16', 17, 99000, 'giac', 'non préparé', 'non préparé', 'giac', 'giac', 'non préparé', 'giac', 'non préparé', 'giac', 'giac', 'non préparé', 'non préparé', 'non préparé', 'giac', 'giac', 'ofppt', 'ofppt', 'ofppt', 'ofppt', 'ofppt', 'ofppt', 'préparé', '2020-11-28', '300000', 'giac', 'giac', 'giac', 'giac', 'non préparé', 'giac', 'non préparé', 'giac', 'giac', '2020-10-16', 'préparé', '2020-10-22', 'non préparé', 'cabinet', '2020-11-24', '2020-10-21', '2020-10-23', 10, 20000, '20%', 50000, 'SOIXANTE MILLE', 'non préparé', 'préparé', '2020-10-23', 'non préparé', 'préparé', 'préparé', '2020-10-23', 'préparé', '2020-10-27', 'non préparé', 'préparé', 'non préparé', 'non préparé', 'préparé', 'préparé', 'préparé', '2020-10-23', NULL, 'approuvé', '103827', '2020-11-16 13:51:43', '2020-12-02 15:21:39'),
(4, 'préparé', 'ingénierie de formation', 2020, 'Giac Technologies', 3, '2020-01-21', 17, 99000, 'giac', 'non préparé', 'non préparé', 'giac', 'giac', 'non préparé', 'giac', 'non préparé', 'giac', 'giac', 'non préparé', 'préparé', 'préparé', 'giac', 'giac', 'ofppt', 'ofppt', 'ofppt', 'ofppt', 'ofppt', 'ofppt', 'préparé', '2020-01-29', 'non préparé', 'giac', 'giac', 'giac', 'giac', 'non préparé', 'giac', 'non préparé', 'giac', 'giac', '2020-03-12', 'préparé', '2020-07-27', 'non préparé', 'giac', '2020-09-16', '2020-08-03', '2020-08-06', 12, 30000, '30%', 60000, 'SOIXANTE-DOUZE MILLE', 'non préparé', 'préparé', '2020-09-22', 'non préparé', 'préparé', 'préparé', '2020-10-16', 'préparé', '2020-10-23', 'non préparé', 'préparé', 'non préparé', 'non préparé', 'préparé', 'préparé', 'préparé', '2020-10-19', NULL, 'approuvé', '254391', '2020-11-16 14:30:55', '2020-12-02 15:28:18'),
(5, 'préparé', 'diagnostic stratégique', 2020, 'Giac textile et cuir', 3, '2019-12-24', 20, 120000, 'giac', 'non préparé', 'non préparé', 'giac', 'giac', 'giac', 'non préparé', 'giac', 'non préparé', 'giac', 'non préparé', 'non préparé', 'non préparé', 'giac', 'non préparé', 'ofppt', 'ofppt', 'ofppt', 'ofppt', 'ofppt', 'ofppt', 'préparé', '2020-03-12', 'non préparé', 'giac', 'giac', 'giac', 'giac', 'giac', 'non préparé', 'giac', 'non préparé', 'giac', '2020-03-12', 'préparé', '2020-03-02', 'giac', 'non préparé', '2020-03-12', '2020-02-24', '2020-02-28', 10, 25000, '30%', 50000, 'SOIXANTE MILLE', 'préparé', 'non préparé', '2020-02-21', 'préparé', 'non préparé', 'préparé', '2020-10-12', 'préparé', '2020-10-19', 'préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'préparé', '2020-10-16', NULL, 'approuvé', '45307', '2020-11-16 14:40:17', '2020-12-04 08:03:50'),
(6, 'préparé', 'ingénierie de formation', 2020, 'Giac textile et cuir', 3, '2020-10-16', 16, 96000, 'giac', 'non préparé', 'non préparé', 'giac', 'giac', 'non préparé', 'giac', 'non préparé', 'giac', 'giac', 'non préparé', 'non préparé', 'non préparé', 'giac', 'giac', 'ofppt', 'ofppt', 'ofppt', 'ofppt', 'ofppt', 'ofppt', 'préparé', '2020-03-12', '000000', 'giac', 'giac', 'giac', 'giac', 'non préparé', 'giac', 'non préparé', 'giac', 'giac', '2020-10-16', 'préparé', '2020-10-19', 'non préparé', 'giac', '2020-10-23', '2020-10-20', '2020-10-22', 8, 19200, '20%', 48000, 'CINQUANTE-SEPT MILLE SIX CENTS', 'non préparé', 'préparé', '2020-10-19', 'non préparé', 'préparé', 'préparé', '2020-10-23', 'préparé', '2020-10-27', 'non préparé', 'préparé', 'non préparé', 'non préparé', 'préparé', 'préparé', 'préparé', '2020-10-23', NULL, 'approuvé', '45307', '2020-11-17 08:36:20', '2020-12-04 08:07:53'),
(7, 'préparé', 'diagnostic stratégique', 2020, 'Giac tertiaire', 3, '2020-11-04', 17, 119000, 'giac', 'non préparé', 'non préparé', 'giac', 'giac', 'giac', 'non préparé', 'giac', 'non préparé', 'giac', 'non préparé', 'non préparé', 'non préparé', 'giac', 'non préparé', 'ofppt', 'ofppt', 'ofppt', 'ofppt', 'ofppt', 'ofppt', 'préparé', '2020-11-04', 'non préparé', 'giac', 'giac', 'giac', 'giac', 'giac', 'non préparé', 'giac', 'non préparé', 'giac', '2020-09-24', 'préparé', '2020-09-30', 'giac', 'non préparé', '2020-10-23', '2020-10-05', '2020-10-10', 12, 33000, '30%', 66000, 'SOIXANTE-DIX-NEUF MILLE DEUX CENTS', 'préparé', 'non préparé', '2020-10-20', 'préparé', 'non préparé', 'non préparé', NULL, 'non préparé', NULL, 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', NULL, '- A récupérer contrats auprès du GIAC\r\n- A élaborer rapport', 'accordé', '251529', '2020-11-17 08:41:19', '2020-12-02 15:43:49'),
(8, 'préparé', 'ingénierie de formation', 2020, 'Giac tertiaire', 3, '2020-11-04', 17, 99000, 'giac', 'non préparé', 'giac', 'giac', 'giac', 'non préparé', 'giac', 'non préparé', 'giac', 'giac', 'non préparé', 'non préparé', 'non préparé', 'giac', 'giac', 'ofppt', 'ofppt', 'ofppt', 'ofppt', 'ofppt', 'ofppt', 'préparé', '2020-11-04', 'non préparé', 'giac', 'giac', 'giac', 'giac', 'non préparé', 'non préparé', 'non préparé', 'giac', 'giac', '2020-09-24', 'préparé', '2020-09-30', 'non préparé', 'giac', '2020-11-12', '2020-10-12', '2020-10-15', 11, 30250, '30%', 60500, 'SOIXANTE-DOUZE MILLE SIX CENTS', 'non préparé', 'préparé', '2020-10-20', 'non préparé', 'préparé', 'préparé', '2020-10-23', 'préparé', '2020-10-23', 'non préparé', 'préparé', 'non préparé', 'non préparé', 'préparé', 'préparé', 'préparé', '2020-10-23', 'A récupérer contrat auprès du GIAC', 'approuvé', '251529', '2020-11-17 09:14:46', '2020-12-02 15:45:40'),
(9, 'préparé', 'ingénierie de formation', 2020, 'GIAC BTP', 5, '2020-10-09', 16, 96000, 'giac', 'non préparé', 'non préparé', 'giac', 'giac', 'non préparé', 'giac', 'non préparé', 'giac', 'giac', 'non préparé', 'préparé', 'préparé', 'giac', 'giac', 'ofppt', 'ofppt', 'ofppt', 'ofppt', 'ofppt', 'ofppt', 'préparé', '2020-03-05', '98767,9', 'giac', 'giac', 'giac', 'giac', 'non préparé', 'giac', 'non préparé', 'giac', 'giac', '2020-10-09', 'préparé', '2020-10-16', 'non préparé', 'cabinet', '2020-11-25', '2020-10-19', '2020-10-21', 14, 35000, '30%', 70000, 'QUATRE-VINGT-QUATRE MILLE', 'non préparé', 'préparé', '2020-10-23', 'non préparé', 'préparé', 'préparé', '2020-10-23', 'préparé', '2020-10-26', 'non préparé', 'préparé', 'non préparé', 'non préparé', 'préparé', 'préparé', 'préparé', '2020-10-23', 'Contrat signé et déposé, à récupérer auprès du giac', 'approuvé', '296871', '2020-11-17 09:59:02', '2020-12-02 15:56:31'),
(10, 'préparé', 'ingénierie de formation', 2020, 'GIAC TRANSLOG', 3, '2020-09-16', 17, 99000, 'giac', 'non préparé', 'non préparé', 'giac', 'giac', 'non préparé', 'giac', 'non préparé', 'giac', 'giac', 'non préparé', 'non préparé', 'préparé', 'giac', 'giac', 'ofppt', 'ofppt', 'ofppt', 'ofppt', 'ofppt', 'ofppt', 'préparé', '2020-09-16', 'non préparé', 'giac', 'giac', 'giac', 'giac', 'non préparé', 'giac', 'non préparé', 'giac', 'giac', '2020-10-09', 'préparé', '2020-10-08', 'non préparé', 'giac', '2020-11-11', '2020-10-10', '2020-10-12', 8, 24000, '30%', 48000, 'CINQUANTE-SEPT MILLE SIX CENTS', 'non préparé', 'préparé', '2020-10-26', 'non préparé', 'préparé', 'préparé', '2020-10-26', 'préparé', '2020-10-28', 'non préparé', 'préparé', 'non préparé', 'non préparé', 'préparé', 'préparé', 'préparé', '2020-10-26', NULL, 'approuvé', '376161', '2020-11-17 10:59:15', '2020-12-03 07:45:15'),
(11, 'préparé', 'ingénierie de formation', 2020, 'GIAC AGROALIMENTAIRE', 4, '2020-05-29', 20, 120000, 'giac', 'non préparé', 'giac', 'giac', 'giac', 'non préparé', 'giac', 'non préparé', 'giac', 'giac', 'non préparé', 'non préparé', 'préparé', 'giac', 'giac', 'ofppt', 'ofppt', 'ofppt', 'ofppt', 'ofppt', 'ofppt', 'préparé', '2020-05-29', '200000', 'giac', 'giac', 'giac', 'giac', 'non préparé', 'giac', 'non préparé', 'giac', 'giac', '2020-10-26', 'préparé', '2020-09-08', 'non préparé', 'giac', '2020-10-26', '2020-09-14', '2020-09-17', 16, 40000, '30%', 80000, 'QUATRE-VINGT-SEIZE MILLE', 'non préparé', 'préparé', '2020-10-26', 'non préparé', 'préparé', 'préparé', '2020-10-26', 'préparé', '2020-10-27', 'non préparé', 'préparé', 'non préparé', 'préparé', 'préparé', 'préparé', 'préparé', '2020-10-26', 'A récupérer contrats auprès du GIAC', 'approuvé', '7077', '2020-11-17 12:18:40', '2020-12-03 08:55:35'),
(12, 'préparé', 'ingénierie de formation', 2020, 'GIAC AGROALIMENTAIRE', 5, '2020-05-29', 20, 120000, 'giac', 'non préparé', 'giac', 'giac', 'giac', 'non préparé', 'giac', 'non préparé', 'giac', 'giac', 'non préparé', 'non préparé', 'préparé', 'giac', 'giac', 'ofppt', 'ofppt', 'ofppt', 'ofppt', 'ofppt', 'ofppt', 'préparé', '2020-05-29', '200000', 'giac', 'non préparé', 'giac', 'giac', 'non préparé', 'giac', 'non préparé', 'giac', 'giac', '2020-10-26', 'préparé', '2020-09-08', 'non préparé', 'giac', '2020-10-26', '2020-09-14', '2020-09-16', 15, 37500, '30%', 75000, 'QUATRE-VINGT-DIX MILLE', 'non préparé', 'préparé', '2020-10-26', 'non préparé', 'préparé', 'préparé', '2020-10-26', 'préparé', '2020-10-27', 'non préparé', 'préparé', 'non préparé', 'préparé', 'préparé', 'préparé', 'préparé', '2020-10-26', 'A récupérer contrat auprès du GIAC', 'approuvé', '286479', '2020-11-17 12:42:19', '2020-12-03 08:58:03'),
(13, 'préparé', 'ingénierie de formation', 2020, 'GIAC AGROALIMENTAIRE', 5, '2020-05-29', 20, 120000, 'giac', 'non préparé', 'giac', 'giac', 'giac', 'non préparé', 'giac', 'non préparé', 'giac', 'giac', 'non préparé', 'non préparé', 'préparé', 'giac', 'giac', 'ofppt', 'ofppt', 'ofppt', 'ofppt', 'ofppt', 'ofppt', 'préparé', '2020-05-29', '200000', 'giac', 'non préparé', 'giac', 'giac', 'non préparé', 'giac', 'non préparé', 'giac', 'giac', '2020-10-26', 'préparé', '2020-09-08', 'non préparé', 'giac', '2020-10-26', '2020-09-20', '2020-09-24', 16, 40000, '30%', 80000, 'QUATRE-VINGT-SEIZE MILLE', 'non préparé', 'préparé', '2020-10-26', 'non préparé', 'préparé', 'préparé', '2020-10-26', 'préparé', '2020-10-27', 'non préparé', 'préparé', 'non préparé', 'préparé', 'préparé', 'préparé', 'préparé', '2020-10-26', 'A récupérer contrat auprès du GIAC', 'approuvé', '5587', '2020-11-17 13:04:25', '2020-12-03 09:23:20'),
(14, 'préparé', 'ingénierie de formation', 2020, 'GIAC AGROALIMENTAIRE', 3, '2020-05-19', 20, 120000, 'giac', 'non préparé', 'giac', 'giac', 'giac', 'non préparé', 'giac', 'non préparé', 'giac', 'giac', 'non préparé', 'préparé', 'préparé', 'giac', 'giac', 'ofppt', 'ofppt', 'ofppt', 'ofppt', 'ofppt', 'ofppt', 'préparé', '2020-05-19', '259946,73', 'giac', 'non préparé', 'giac', 'giac', 'non préparé', 'giac', 'non préparé', 'giac', 'giac', '2020-10-26', 'non préparé', '2020-09-08', 'non préparé', 'giac', '2020-10-26', '2020-09-20', '2020-09-24', 16, 40000, '30%', 80000, 'QUATRE-VINGT-SEIZE MILLE', 'non préparé', 'préparé', '2020-10-26', 'non préparé', 'préparé', 'préparé', '2020-10-26', 'préparé', '2020-10-27', 'non préparé', 'préparé', 'non préparé', 'préparé', 'préparé', 'préparé', 'préparé', '2020-10-26', 'A récupérer contrats auprès du GIAC', 'approuvé', '193231', '2020-11-17 13:45:57', '2020-12-03 09:02:51'),
(15, 'préparé', 'ingénierie de formation', 2020, 'GIAC TRANSLOG', 4, '2020-05-19', 16, 96000, 'giac', 'non préparé', 'non préparé', 'giac', 'giac', 'non préparé', 'giac', 'non préparé', 'giac', 'giac', 'non préparé', 'préparé', 'préparé', 'giac', 'giac', 'ofppt', 'ofppt', 'ofppt', 'ofppt', 'ofppt', 'ofppt', 'préparé', '2020-05-19', '337973,93', 'giac', 'non préparé', 'giac', 'giac', 'non préparé', 'giac', 'non préparé', 'giac', 'giac', '2020-07-23', 'préparé', '2020-10-08', 'non préparé', 'giac', '2020-10-19', '2020-10-12', '2020-10-14', 12, 28800, '20%', 72000, 'QUATRE-VINGT-SIX MILLE QUATRE CENTS', 'non préparé', 'préparé', '2020-10-26', 'non préparé', 'préparé', 'préparé', '2020-10-26', 'préparé', '2020-11-02', 'non préparé', 'préparé', 'non préparé', 'non préparé', 'préparé', 'préparé', 'préparé', '2020-10-26', NULL, 'approuvé', '117713', '2020-11-17 13:55:43', '2020-12-03 09:11:25'),
(16, 'préparé', 'ingénierie de formation', 2020, 'GIAC AGROALIMENTAIRE', 5, '2020-05-19', 20, 120000, 'giac', 'non préparé', 'giac', 'giac', 'giac', 'non préparé', 'giac', 'non préparé', 'giac', 'giac', 'non préparé', 'préparé', 'préparé', 'giac', 'giac', 'ofppt', 'ofppt', 'ofppt', 'ofppt', 'ofppt', 'ofppt', 'préparé', '2020-05-19', '840875,66', 'giac', 'giac', 'giac', 'giac', 'non préparé', 'giac', 'non préparé', 'giac', 'giac', '2020-10-26', 'non préparé', '2020-09-08', 'non préparé', 'giac', '2020-10-26', '2020-09-14', '2020-09-18', 18, 36000, '20%', 90000, 'CENT HUIT MILLE', 'non préparé', 'préparé', '2020-10-26', 'non préparé', 'préparé', 'préparé', '2020-10-26', 'préparé', '2020-10-27', 'non préparé', 'préparé', 'non préparé', 'préparé', 'préparé', 'préparé', 'préparé', '2020-10-26', 'A récupérer contrats auprès du giac', 'approuvé', '143199', '2020-11-17 14:09:01', '2020-12-03 09:31:01'),
(17, 'préparé', 'diagnostic stratégique', 2020, 'GIAC AGROALIMENTAIRE', 3, '2020-05-29', 20, 120000, 'giac', 'giac', 'non préparé', 'giac', 'giac', 'giac', 'non préparé', 'giac', 'non préparé', 'giac', 'non préparé', 'non préparé', 'non préparé', 'giac', 'giac', 'ofppt', 'ofppt', 'ofppt', 'ofppt', 'ofppt', 'ofppt', 'préparé', '2020-05-29', NULL, 'giac', 'non préparé', 'giac', 'giac', 'giac', 'non préparé', 'giac', 'non préparé', 'giac', '2020-10-26', 'non préparé', '2020-09-08', 'giac', 'non préparé', '2020-10-26', '2020-09-25', '2020-10-03', 20, 60000, '30%', 120000, 'CENT QUARANTE-QUATRE MILLE', 'préparé', 'non préparé', '2020-10-26', 'préparé', 'non préparé', 'non préparé', NULL, 'non préparé', NULL, 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', NULL, '- A élaborer rapport \r\n- A récupérer contrats auprès du GIAC', 'accordé', '10963', '2020-11-17 14:23:19', '2020-12-03 08:33:06'),
(18, 'préparé', 'ingénierie de formation', 2020, 'GIAC AGROALIMENTAIRE', 5, '2020-05-29', 20, 120000, 'giac', 'non préparé', 'giac', 'giac', 'giac', 'non préparé', 'giac', 'non préparé', 'giac', 'giac', 'non préparé', 'non préparé', 'non préparé', 'giac', 'giac', 'ofppt', 'ofppt', 'ofppt', 'ofppt', 'ofppt', 'ofppt', 'préparé', '2020-05-29', '300000', 'giac', 'non préparé', 'giac', 'giac', 'non préparé', 'giac', 'non préparé', 'giac', 'giac', '2020-10-26', 'non préparé', '2020-09-08', 'non préparé', 'giac', '2020-10-26', '2020-09-28', '2020-10-02', 20, 40000, '20%', 100000, 'CENT VINGT MILLE', 'non préparé', 'préparé', '2020-10-26', 'non préparé', 'préparé', 'préparé', '2020-10-26', 'préparé', '2020-10-27', 'non préparé', 'préparé', 'non préparé', 'préparé', 'préparé', 'préparé', 'préparé', '2020-10-26', 'contrats signé et déposé , à récupérer auprès du giac', 'approuvé', '10963', '2020-12-03 08:28:18', '2020-12-03 08:52:29'),
(20, 'préparé', 'diagnostic stratégique', 2021, 'GIAC 1', NULL, NULL, NULL, NULL, 'cabinet', 'non préparé', 'non préparé', 'giac', 'cabinet', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'ofppt', 'ofppt', 'ofppt', 'ofppt', 'ofppt', 'ofppt', 'préparé', '2021-01-19', NULL, 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', NULL, 'non préparé', NULL, 'non préparé', 'non préparé', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'NOMBRE NON VALIDE', 'non préparé', 'non préparé', NULL, 'non préparé', 'non préparé', 'non préparé', NULL, 'non préparé', NULL, 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', NULL, 'virement d\'adhésion effectué, en attente validation du giac.', 'instruction dossier', '126089', '2021-01-19 14:19:45', '2021-01-19 14:51:02'),
(21, 'Préparé', 'Ingénierie de formation', 2021, 'GIAC 1', NULL, NULL, NULL, NULL, 'cabinet', 'non préparé', 'non préparé', 'giac', 'cabinet', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'ofppt', 'ofppt', 'ofppt', 'ofppt', 'ofppt', 'ofppt', 'préparé', '2021-01-19', '300000', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', NULL, 'non préparé', NULL, 'non préparé', 'non préparé', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'NOMBRE NON VALIDE', 'non préparé', 'non préparé', NULL, 'non préparé', 'non préparé', 'non préparé', NULL, 'non préparé', NULL, 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', NULL, 'virement d\'adhésion effectué, en attente validation du giac', 'instruction dossier', '126089', '2021-01-19 14:54:30', '2021-01-19 14:54:30');

-- --------------------------------------------------------

--
-- Structure de la table `demande_remboursement_giacs`
--

CREATE TABLE `demande_remboursement_giacs` (
  `n_drb` bigint(20) UNSIGNED NOT NULL,
  `n_facture` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dt_facture` date DEFAULT NULL,
  `fact_cab_entr` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'non préparé',
  `relv_banc_cab` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'non préparé',
  `relv_banc_entrp` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'non préparé',
  `drb_ds` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'non préparé',
  `drb_if` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'non préparé',
  `frai_doss` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'non préparé',
  `dt_pay_entrp` date DEFAULT NULL,
  `moyen_fin` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'non préparé',
  `ref_fin` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'non préparé',
  `avis_remise_fin` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'non préparé',
  `part_giac` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `montant_entrp_ttc` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `montant_entrp_ht` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dt_depo_drb` date DEFAULT NULL,
  `dt_rb` date DEFAULT NULL,
  `moyen_rb` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'non préparé',
  `ref_rb` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'non préparé',
  `montant_rb` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `etat` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'initié',
  `commentaire` varchar(5000) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `n_df` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `demande_remboursement_giacs`
--

INSERT INTO `demande_remboursement_giacs` (`n_drb`, `n_facture`, `dt_facture`, `fact_cab_entr`, `relv_banc_cab`, `relv_banc_entrp`, `drb_ds`, `drb_if`, `frai_doss`, `dt_pay_entrp`, `moyen_fin`, `ref_fin`, `avis_remise_fin`, `part_giac`, `montant_entrp_ttc`, `montant_entrp_ht`, `dt_depo_drb`, `dt_rb`, `moyen_rb`, `ref_rb`, `montant_rb`, `etat`, `commentaire`, `n_df`, `created_at`, `updated_at`) VALUES
(4, '47-2020', '2020-12-03', '', '', '', '', '', '', NULL, 'non préparé', '', 'pas encore', '70%', '40000.00', '80000', NULL, NULL, 'non préparé', '', '56000', 'initié', NULL, 2, '2020-11-16 13:24:11', '2020-11-16 13:24:11'),
(5, '48-2020', '2020-12-03', '', '', '', '', '', '', NULL, 'non préparé', '', 'pas encore', '80%', '20000.00', '50000', NULL, NULL, 'non préparé', '', '40000', 'initié', NULL, 3, '2020-11-16 13:51:43', '2020-11-16 13:51:43'),
(6, '49-2020', '2020-12-03', '', '', '', '', '', '', NULL, 'non préparé', '', 'pas encore', '70%', '30000.00', '60000', NULL, NULL, 'non préparé', '', '42000', 'initié', NULL, 4, '2020-11-16 14:30:55', '2020-11-16 14:30:55'),
(7, '34-2020', '2020-08-13', 'préparé', 'préparé', 'préparé', 'non préparé', 'non préparé', 'non préparé', '2020-09-18', 'effet', 'ELC N 7218124', 'avis', '70%', '25000.00', '50000', '2020-10-16', '2020-10-19', 'chèque', 'CMI N° 7919118', '35000', 'remboursé', NULL, 5, '2020-11-17 06:36:52', '2020-11-23 07:21:58'),
(8, '37-2020', '2020-10-20', 'préparé', 'préparé', 'préparé', 'non préparé', 'non préparé', 'préparé', '2020-10-27', 'virement', 'VRT', 'remise', '80%', '19200.00', '48000', '2020-11-23', '2020-11-23', 'chèque', 'CMI N° 7919146', '38400', 'remboursé', NULL, 6, '2020-11-17 08:36:20', '2020-12-16 12:24:00'),
(9, '55-2020', '2020-12-03', '', '', '', '', '', '', NULL, 'non préparé', '', 'pas encore', '70%', '30250.00', '60500', NULL, NULL, 'non préparé', '', '42350', 'initié', NULL, 8, '2020-11-17 09:48:48', '2020-11-17 09:48:48'),
(10, '51-2020', '2020-12-03', '', '', '', '', '', '', NULL, 'non préparé', '', 'pas encore', '70%', '35000.00', '70000', NULL, NULL, 'non préparé', '', '49000', 'initié', NULL, 9, '2020-11-17 10:40:58', '2020-11-17 10:40:58'),
(11, '46-2020', '2020-12-03', '', '', '', '', '', '', NULL, 'non préparé', '', 'pas encore', '70%', '24000.00', '48000', NULL, NULL, 'non préparé', '', '33600', 'initié', NULL, 10, '2020-11-17 11:08:18', '2020-11-17 11:08:18'),
(14, '52-2020', '2020-12-03', '', '', '', '', '', '', NULL, 'non préparé', '', 'pas encore', '70%', '40000.00', '80000', NULL, NULL, 'non préparé', '', '56000', 'initié', NULL, 13, '2020-11-17 13:04:25', '2020-11-17 13:04:25'),
(16, '53-2020', '2020-12-03', '', '', '', '', '', '', NULL, 'non préparé', '', 'pas encore', '80%', '28800.00', '72000', NULL, NULL, 'non préparé', '', '57600', 'initié', NULL, 15, '2020-11-17 13:55:43', '2020-11-17 13:55:43'),
(17, '54-2020', '2020-12-03', '', '', '', '', '', '', NULL, 'non préparé', '', 'pas encore', '80%', '36000.00', '90000', NULL, NULL, 'non préparé', '', '72000', 'initié', NULL, 16, '2020-11-17 14:09:01', '2020-11-17 14:09:01'),
(18, '50-2020', '2020-12-03', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', NULL, 'non préparé', 'non préparé', 'non préparé', '70%', '33000.00', '66000', NULL, NULL, 'non préparé', 'non préparé', '46200', 'initié', NULL, 7, '2020-12-02 15:38:28', '2020-12-02 15:38:28'),
(19, '56-2020', '2020-12-03', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', NULL, 'non préparé', 'non préparé', 'non préparé', '70%', '60000.00', '120000', NULL, NULL, 'non préparé', 'non préparé', '84000', 'initié', NULL, 17, '2020-12-03 08:33:06', '2020-12-03 08:33:06'),
(25, '57-2020', '2020-12-03', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', NULL, 'non préparé', 'non préparé', 'non préparé', '80%', '40000.00', '100000', NULL, NULL, 'non préparé', 'non préparé', '80000', 'initié', NULL, 18, '2020-12-03 08:52:29', '2020-12-03 08:52:29'),
(26, '58-2020', '2020-12-03', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', NULL, 'non préparé', 'non préparé', 'non préparé', '70%', '40000.00', '80000', NULL, NULL, 'non préparé', 'non préparé', '56000', 'initié', NULL, 11, '2020-12-03 08:55:35', '2020-12-03 08:55:35'),
(27, '59-2020', '2020-12-03', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', NULL, 'non préparé', 'non préparé', 'non préparé', '70%', '37500.00', '75000', NULL, NULL, 'non préparé', 'non préparé', '52500', 'initié', NULL, 12, '2020-12-03 08:58:03', '2020-12-03 08:58:03'),
(31, '60-2020', '2020-12-03', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', NULL, 'non préparé', 'non préparé', 'non préparé', '70%', '40000.00', '80000', NULL, NULL, 'non préparé', 'non préparé', '56000', 'initié', NULL, 14, '2020-12-03 09:02:51', '2020-12-03 09:02:51'),
(36, NULL, NULL, 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', NULL, 'non préparé', 'non préparé', 'non préparé', '70%', '5000.00', '10000', NULL, NULL, 'non préparé', 'non préparé', '7000', 'initié', NULL, 1, '2020-12-03 09:21:30', '2020-12-03 09:21:30');

-- --------------------------------------------------------

--
-- Structure de la table `demande_remboursement_ofppts`
--

CREATE TABLE `demande_remboursement_ofppts` (
  `n_drb` bigint(20) UNSIGNED NOT NULL,
  `justif_paiem_entrp` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'non préparé',
  `justif_paiem_cab` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'non préparé',
  `model5` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'non préparé',
  `f4` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'non préparé',
  `fiche_eval_synth` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'non préparé',
  `model6` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'non préparé',
  `facture_PF` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'non préparé',
  `plan_form` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'non préparé',
  `moyen_fin` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'non préparé',
  `remise_avis_fin` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'non préparé',
  `releve_fin` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'non préparé',
  `moyen_rb` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'non préparé',
  `remise_avis` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'non préparé',
  `releve` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'non préparé',
  `dt_envoi` date DEFAULT NULL,
  `annee_csf` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dt_pay_entrp` date DEFAULT NULL,
  `montant_entrp_ttc` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `montant_entrp_ht` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dt_depo_drb` date DEFAULT NULL,
  `dt_rb` date DEFAULT NULL,
  `montant_rb` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `commentaire` varchar(5000) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nrc_e` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `domaines`
--

CREATE TABLE `domaines` (
  `id_domain` bigint(20) UNSIGNED NOT NULL,
  `nom_domain` varchar(300) COLLATE utf8mb4_unicode_ci NOT NULL,
  `region` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ville` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cout` double NOT NULL,
  `commentaire` varchar(3000) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `domaines`
--

INSERT INTO `domaines` (`id_domain`, `nom_domain`, `region`, `ville`, `cout`, `commentaire`, `created_at`, `updated_at`) VALUES
(3, 'Management', 'Grand Casablanca', 'Settat', 7000, NULL, '2020-07-24 05:21:10', '2020-11-23 09:36:02'),
(4, 'Technique', 'Grand Casablanca', 'Settat', 7000, NULL, '2020-08-04 06:28:21', '2020-08-04 06:28:21'),
(5, 'TEST DOMAINE', 'Grand Casablanca', 'Settat', 4000, '#DOMAINE DE TEST#', '2020-09-17 06:07:38', '2020-11-23 09:36:28'),
(6, 'Qualité', 'Grand Casablanca', 'Settat', 7000, NULL, '2020-09-17 06:46:41', '2020-09-17 06:46:41'),
(7, 'Logistique', 'Grand Casablanca', 'Settat', 6000, NULL, '2020-09-17 06:47:20', '2020-10-23 08:21:38'),
(8, 'Commerce et Marketing', 'Grand Casablanca', 'Settat', 7000, NULL, '2020-09-17 09:28:01', '2020-09-17 09:28:01'),
(9, 'Gestion des ressources humaines', 'Grand Casablanca', 'Settat', 7000, NULL, '2020-09-18 04:33:06', '2020-10-23 07:44:20'),
(10, 'Management', 'Grand Casablanca', 'Casablanca', 7500, NULL, '2020-09-18 08:50:32', '2020-09-25 10:58:02'),
(11, 'Commerce et Marketing', 'Grand Casablanca', 'Casablanca', 7000, NULL, '2020-09-18 08:59:40', '2020-09-18 08:59:40'),
(12, 'Qualité', 'Grand Casablanca', 'Casablanca', 7000, NULL, '2020-09-18 09:01:09', '2020-09-18 09:01:09'),
(13, 'Gestion des ressources humaines', 'Grand Casablanca', 'Casablanca', 8000, NULL, '2020-09-18 09:02:23', '2020-09-18 09:02:23'),
(14, 'Technique', 'Grand Casablanca', 'Casablanca', 7000, NULL, '2020-09-18 09:09:40', '2020-09-18 09:09:40'),
(15, 'Logistique', 'Grand Casablanca', 'Casablanca', 7000, NULL, '2020-09-18 09:11:57', '2020-10-06 08:03:38'),
(16, 'Finance et gestion  financière', 'Grand Casablanca', 'Casablanca', 7000, NULL, '2020-09-18 10:50:25', '2020-09-18 10:50:25'),
(17, 'TEST#', 'Fès - Boulemane', 'Fès', 1000, NULL, '2020-09-25 10:10:20', '2020-09-25 10:11:53'),
(18, 'Langues', 'Grand Casablanca', 'Casablanca', 5000, NULL, '2020-10-06 08:10:33', '2020-10-06 08:10:33'),
(19, 'Communication', 'Grand Casablanca', 'Casablanca', 7000, NULL, '2020-10-20 11:34:32', '2020-10-20 11:34:32'),
(20, 'Sécurité hygiène', 'Grand Casablanca', 'Casablanca', 7000, NULL, '2020-10-20 11:41:24', '2020-10-20 11:41:24'),
(21, 'Gestion des ressources humaines', 'Grand Casablanca', 'Casablanca', 8000, NULL, '2020-10-20 11:53:31', '2020-10-20 11:53:31'),
(22, 'Finance et gestion financière', 'Grand Casablanca', 'Settat', 6000, NULL, '2020-10-23 05:40:04', '2020-10-23 05:40:04'),
(23, 'Sécurité - hygiène', 'Grand Casablanca', 'Settat', 7000, NULL, '2020-10-23 10:21:15', '2020-10-23 10:21:15'),
(24, 'Informatique et système d\'information', 'Grand Casablanca', 'Casablanca', 5000, NULL, '2020-10-23 12:27:38', '2020-10-23 12:27:38'),
(25, 'Approche technique du métier de l\'entreprise', 'Grand Casablanca', 'Casablanca', 7000, NULL, '2020-11-02 06:54:24', '2020-11-02 06:54:24'),
(26, 'Bureautique et utilisation des outils informatiques', 'Grand Casablanca', 'Casablanca', 5000, NULL, '2020-11-02 07:00:50', '2020-11-02 07:00:50'),
(27, 'Management opérationnel', 'Grand Casablanca', 'Casablanca', 7500, NULL, '2020-11-02 07:01:50', '2020-11-02 07:01:50'),
(28, 'Stratégie marketing et commerciale', 'Grand Casablanca', 'Casablanca', 7000, NULL, '2020-11-02 07:02:57', '2020-11-02 07:02:57'),
(29, 'Gestion des approvisionnements', 'Grand Casablanca', 'Casablanca', 7000, NULL, '2020-11-02 07:04:04', '2020-11-02 07:04:04'),
(30, 'Approche générale de la sécurité et de l\'hygiène', 'Grand Casablanca', 'Casablanca', 7000, NULL, '2020-11-02 07:04:59', '2020-11-02 07:04:59'),
(31, 'Technique commerciale et technique de vente', 'Grand Casablanca', 'Casablanca', 7000, NULL, '2020-11-02 07:08:07', '2020-11-02 07:08:07');

-- --------------------------------------------------------

--
-- Structure de la table `formations`
--

CREATE TABLE `formations` (
  `id_form` bigint(20) UNSIGNED NOT NULL,
  `n_facture` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dt_facture` date DEFAULT NULL,
  `groupe` int(11) NOT NULL DEFAULT 0,
  `nb_benif` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `hr_debut` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `hr_fin` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pse_debut` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pse_fin` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date1` date NOT NULL,
  `date2` date DEFAULT NULL,
  `date3` date DEFAULT NULL,
  `date4` date DEFAULT NULL,
  `date5` date DEFAULT NULL,
  `date6` date DEFAULT NULL,
  `date7` date DEFAULT NULL,
  `date8` date DEFAULT NULL,
  `date9` date DEFAULT NULL,
  `date10` date DEFAULT NULL,
  `date11` date DEFAULT NULL,
  `date12` date DEFAULT NULL,
  `date13` date DEFAULT NULL,
  `date14` date DEFAULT NULL,
  `date15` date DEFAULT NULL,
  `date16` date DEFAULT NULL,
  `date17` date DEFAULT NULL,
  `date18` date DEFAULT NULL,
  `date19` date DEFAULT NULL,
  `date20` date DEFAULT NULL,
  `date21` date DEFAULT NULL,
  `date22` date DEFAULT NULL,
  `date23` date DEFAULT NULL,
  `date24` date DEFAULT NULL,
  `date25` date DEFAULT NULL,
  `date26` date DEFAULT NULL,
  `date27` date DEFAULT NULL,
  `date28` date DEFAULT NULL,
  `date29` date DEFAULT NULL,
  `date30` date DEFAULT NULL,
  `n_form` bigint(20) UNSIGNED NOT NULL,
  `commentaire` varchar(5000) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `formations`
--

INSERT INTO `formations` (`id_form`, `n_facture`, `dt_facture`, `groupe`, `nb_benif`, `hr_debut`, `hr_fin`, `pse_debut`, `pse_fin`, `date1`, `date2`, `date3`, `date4`, `date5`, `date6`, `date7`, `date8`, `date9`, `date10`, `date11`, `date12`, `date13`, `date14`, `date15`, `date16`, `date17`, `date18`, `date19`, `date20`, `date21`, `date22`, `date23`, `date24`, `date25`, `date26`, `date27`, `date28`, `date29`, `date30`, `n_form`, `commentaire`, `created_at`, `updated_at`) VALUES
(1, '10/2010', '2019-10-20', 1, '6', '09:00', '16:00', '12:30', '13:30', '2019-10-17', '2019-10-18', '2019-10-19', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 9, NULL, '2020-09-16 05:57:35', '2020-09-16 05:57:35'),
(2, NULL, NULL, 1, '6', '09:00', '16:00', '12:30', '13:30', '2019-10-24', '2019-10-25', '2019-10-26', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 10, NULL, '2020-09-16 06:03:45', '2020-09-16 06:03:45'),
(3, NULL, NULL, 1, '6', '09:00', '16:00', '12:30', '13:30', '2019-11-05', '2019-11-12', '2019-11-19', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 11, NULL, '2020-09-16 06:09:08', '2020-09-16 06:09:08'),
(4, NULL, NULL, 1, '6', '09:00', '16:00', '12:30', '13:30', '2019-10-22', '2019-10-23', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 31, NULL, '2020-09-23 05:10:15', '2020-09-23 05:10:15'),
(5, NULL, NULL, 1, '5', '09:00', '16:00', '12:30', '13:30', '2019-10-15', '2019-10-16', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 32, NULL, '2020-09-23 05:11:31', '2020-09-23 05:11:31'),
(6, NULL, NULL, 1, '6', '09:00', '16:00', '12:30', '13:30', '2019-11-26', '2019-11-27', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 33, NULL, '2020-09-23 05:13:18', '2020-09-23 05:13:18'),
(7, NULL, NULL, 1, '6', '09:00', '16:00', '12:30', '13:30', '2019-10-24', '2019-10-25', '2019-10-26', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 26, NULL, '2020-09-24 10:11:57', '2020-09-24 10:11:57'),
(8, NULL, NULL, 1, '6', '09:00', '16:00', '12:30', '13:30', '2019-10-17', '2019-10-18', '2019-10-19', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 27, NULL, '2020-09-24 10:13:47', '2020-09-24 10:13:47'),
(9, NULL, NULL, 1, '6', '09:00', '16:00', '12:30', '13:30', '2019-10-24', '2019-10-25', '2019-10-26', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 24, NULL, '2020-09-24 10:16:16', '2020-09-24 10:16:16'),
(10, NULL, NULL, 1, '6', '09:00', '16:00', '12:30', '13:30', '2019-10-17', '2019-10-18', '2019-10-19', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 25, NULL, '2020-09-24 10:17:41', '2020-09-24 10:17:41'),
(12, NULL, NULL, 1, '6', '09:00', '16:00', '12:30', '13:30', '2019-11-07', '2019-11-08', '2019-11-09', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 18, NULL, '2020-09-24 10:22:26', '2020-09-24 10:22:26'),
(13, NULL, NULL, 1, '6', '09:00', '16:00', '12:30', '13:30', '2019-10-24', '2019-10-25', '2019-10-26', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 19, NULL, '2020-09-24 10:24:26', '2020-09-24 10:24:26'),
(16, NULL, NULL, 1, '6', '09:00', '16:00', '12:30', '13:30', '2019-10-31', '2019-11-01', '2019-11-02', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 13, NULL, '2020-09-24 11:01:34', '2020-09-24 11:01:34'),
(17, NULL, NULL, 1, '6', '09:00', '16:00', '12:30', '13:30', '2019-10-17', '2019-10-18', '2019-10-19', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 14, NULL, '2020-09-24 11:07:30', '2020-09-24 11:07:30'),
(18, NULL, NULL, 1, '6', '09:00', '16:00', '12:30', '13:30', '2019-10-24', '2019-10-25', '2019-10-26', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 15, NULL, '2020-09-24 11:09:05', '2020-09-24 11:09:05'),
(19, NULL, NULL, 1, '6', '09:00', '16:00', '12:30', '13:30', '2019-11-07', '2019-11-08', '2019-11-09', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 16, NULL, '2020-09-24 11:10:32', '2020-09-24 11:10:32'),
(20, NULL, NULL, 1, '6', '09:00', '16:00', '12:30', '13:30', '2019-10-17', '2019-10-18', '2019-10-19', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 20, NULL, '2020-09-24 12:25:59', '2020-09-24 12:25:59'),
(21, NULL, NULL, 1, '7', '09:00', '16:00', '12:30', '13:30', '2019-12-16', '2019-12-17', '2019-12-18', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 21, NULL, '2020-09-24 12:34:27', '2020-09-24 12:34:27'),
(22, NULL, NULL, 1, '6', '09:00', '16:00', '12:30', '13:30', '2019-10-24', '2019-10-25', '2019-10-26', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 22, NULL, '2020-09-24 12:37:18', '2020-09-24 12:37:18'),
(23, NULL, NULL, 1, '6', '09:00', '16:00', '12:30', '13:30', '2019-11-14', '2019-11-15', '2019-11-16', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 23, NULL, '2020-09-24 12:38:34', '2020-09-24 12:38:34'),
(24, NULL, NULL, 1, '6', '09:00', '16:00', '12:30', '13:30', '2019-10-17', '2019-10-18', '2019-10-19', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 38, NULL, '2020-09-25 11:00:44', '2020-09-25 11:00:44'),
(25, NULL, NULL, 1, '6', '09:00', '16:00', '12:30', '13:30', '2019-10-24', '2019-10-25', '2019-10-26', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 37, NULL, '2020-09-25 11:02:08', '2020-09-25 11:02:08'),
(27, '92-2020', '2020-12-28', 1, '6', '09:00', '16:00', '12:30', '13:30', '2020-11-12', '2020-11-13', '2020-11-14', '2020-11-19', '2020-11-20', '2020-11-21', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 39, NULL, '2020-10-16 07:30:32', '2020-10-16 07:30:32'),
(28, '93-2020', '2020-12-28', 1, '5', '09:00', '16:00', '12:30', '13:30', '2020-11-26', '2020-11-27', '2020-11-28', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 41, NULL, '2020-10-16 07:32:37', '2020-10-16 07:32:37'),
(29, '94-2020', '2020-12-28', 1, '6', '17:00', '20:00', '00:00', '00:00', '2020-11-09', '2020-11-10', '2020-11-16', '2020-11-17', '2020-11-23', '2020-11-24', '2020-11-30', '2020-12-01', '2020-12-02', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 42, NULL, '2020-10-16 07:39:10', '2020-10-16 07:39:10'),
(30, '01-2021', '2021-01-20', 1, '6', '17:00', '20:00', '00:00', '00:00', '2020-12-07', '2020-12-08', '2020-12-14', '2020-12-15', '2020-12-21', '2020-12-22', '2020-12-28', '2020-12-29', '2021-01-04', '2021-01-05', '2021-01-12', '2021-01-18', '2021-01-19', '2021-01-20', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 43, 'A modifier intervenant', '2020-10-16 07:52:19', '2020-12-29 12:53:07'),
(31, '95-2020', '2020-12-28', 1, '5', '09:00', '16:00', '12:30', '13:30', '2020-12-03', '2020-12-04', '2020-12-05', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 44, 'A valider Intervenant', '2020-10-16 07:55:08', '2020-10-16 07:56:59'),
(37, '102-2020', '2020-12-28', 1, '5', '09:00', '16:00', '12:30', '13:30', '2020-11-19', '2020-11-20', '2020-11-21', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 45, NULL, '2020-10-20 12:59:00', '2020-10-21 09:25:19'),
(38, '103-2020', '2020-12-28', 1, '5', '09:00', '16:00', '12:30', '13:30', '2020-11-26', '2020-11-27', '2020-11-28', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 46, NULL, '2020-10-20 12:59:53', '2020-10-21 09:26:07'),
(39, '104-2020', '2020-12-28', 1, '5', '09:00', '16:00', '12:30', '13:30', '2020-12-03', '2020-12-04', '2020-12-05', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 47, NULL, '2020-10-20 13:00:42', '2020-10-21 09:26:47'),
(40, '105-2020', '2020-12-28', 1, '5', '09:00', '16:00', '12:30', '13:30', '2020-12-10', '2020-12-11', '2020-12-12', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 48, NULL, '2020-10-20 13:08:40', '2020-10-20 13:08:40'),
(41, '106-2020', '2020-12-28', 1, '5', '09:00', '16:00', '12:30', '13:30', '2020-12-17', '2020-12-18', '2020-12-19', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 49, NULL, '2020-10-20 13:09:33', '2020-10-20 13:09:33'),
(42, '107-2020', '2020-12-28', 1, '5', '09:00', '16:00', '12:30', '13:30', '2020-12-24', '2020-12-25', '2020-12-26', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 50, NULL, '2020-10-20 13:10:59', '2020-10-20 13:10:59'),
(43, NULL, NULL, 1, '5', '09:00', '16:00', '12:30', '13:30', '2021-01-07', '2021-01-08', '2021-01-09', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 51, NULL, '2020-10-20 13:12:13', '2020-10-21 09:35:45'),
(44, NULL, NULL, 1, '5', '09:00', '16:00', '12:30', '13:30', '2021-01-14', '2021-01-15', '2021-01-16', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 52, NULL, '2020-10-20 13:12:56', '2020-10-21 09:36:05'),
(45, NULL, NULL, 1, '5', '09:00', '16:00', '12:30', '13:30', '2021-01-21', '2021-01-22', '2021-01-23', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 53, NULL, '2020-10-20 13:21:18', '2020-10-21 09:36:32'),
(46, NULL, NULL, 1, '5', '09:00', '16:00', '12:30', '13:30', '2021-01-28', '2021-01-29', '2021-01-30', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 54, NULL, '2020-10-20 13:21:53', '2020-10-21 09:37:00'),
(47, '97-2020', '2020-12-28', 1, '5', '09:00', '16:00', '12:30', '13:30', '2020-11-19', '2020-11-20', '2020-11-21', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 55, NULL, '2020-10-20 14:20:31', '2020-10-20 14:20:31'),
(48, '98-2020', '2020-12-28', 1, '5', '09:00', '16:00', '12:30', '13:30', '2020-11-26', '2020-11-27', '2020-11-28', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 56, NULL, '2020-10-20 14:21:15', '2020-10-20 14:21:15'),
(49, '99-2020', '2020-12-28', 1, '5', '09:00', '16:00', '12:30', '13:30', '2020-12-04', '2020-12-05', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 57, NULL, '2020-10-20 14:22:52', '2020-10-21 08:40:51'),
(50, '100-2020', '2020-12-28', 1, '5', '09:00', '16:00', '12:30', '13:30', '2020-12-10', '2020-12-11', '2020-12-12', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 58, NULL, '2020-10-20 14:23:46', '2020-10-20 14:23:46'),
(51, '101-2020', '2020-12-28', 1, '5', '09:00', '16:00', '12:30', '13:30', '2020-12-17', '2020-12-18', '2020-12-19', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 59, NULL, '2020-10-20 14:24:26', '2020-10-20 14:24:26'),
(53, '108-2020', '2020-12-28', 1, '5', '09:00', '16:00', '12:30', '13:30', '2020-11-19', '2020-11-20', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 60, NULL, '2020-10-21 12:24:04', '2020-10-21 12:24:04'),
(54, '109-2020', '2020-12-28', 1, '5', '09:00', '16:00', '12:30', '13:30', '2020-11-21', '2020-11-26', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 61, NULL, '2020-10-21 12:24:47', '2020-10-21 12:24:47'),
(55, '110-2020', '2020-12-28', 1, '5', '09:00', '16:00', '12:30', '13:30', '2020-11-27', '2020-11-28', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 62, NULL, '2020-10-21 12:25:24', '2020-10-21 12:25:24'),
(56, '111-2020', '2020-12-28', 1, '6', '09:00', '16:00', '12:30', '13:30', '2020-12-03', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 63, NULL, '2020-10-21 12:28:05', '2020-10-21 12:28:05'),
(57, '112-2020', '2020-12-28', 1, '5', '09:00', '16:00', '12:30', '13:30', '2020-12-04', '2020-12-05', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 64, NULL, '2020-10-21 12:28:52', '2020-10-21 12:28:52'),
(58, '113-2020', '2020-12-28', 1, '5', '09:00', '16:00', '12:30', '13:30', '2020-12-10', '2020-12-11', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 65, NULL, '2020-10-21 12:29:51', '2020-10-21 12:29:51'),
(59, '114-2020', '2020-12-28', 1, '5', '09:00', '16:00', '12:30', '13:30', '2020-12-12', '2020-12-17', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 66, NULL, '2020-10-21 12:30:33', '2020-10-21 12:30:33'),
(60, '115-2020', '2020-12-28', 1, '5', '09:00', '16:00', '12:30', '13:30', '2020-12-18', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 67, NULL, '2020-10-21 12:31:45', '2020-10-21 12:31:45'),
(61, '116-2020', '2020-12-28', 1, '6', '09:00', '16:00', '12:30', '13:30', '2020-12-19', '2020-12-24', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 68, NULL, '2020-10-21 12:32:44', '2020-10-21 12:32:44'),
(62, '121-2020', '2020-12-31', 1, '6', '09:00', '16:00', '12:30', '13:30', '2020-11-19', '2020-11-20', '2020-11-21', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 69, NULL, '2020-10-21 14:25:02', '2020-10-21 14:25:02'),
(63, '122-2020', '2020-12-31', 1, '6', '09:00', '16:00', '12:30', '13:30', '2020-11-26', '2020-11-27', '2020-11-28', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 70, NULL, '2020-10-21 14:25:30', '2020-10-21 14:25:30'),
(64, '123-2020', '2020-12-31', 1, '6', '09:00', '16:00', '12:30', '13:30', '2020-12-03', '2020-12-04', '2020-12-05', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 71, NULL, '2020-10-21 14:26:11', '2020-10-21 14:26:11'),
(65, '124-2020', '2020-12-31', 1, '6', '09:00', '16:00', '12:30', '13:30', '2020-12-10', '2020-12-11', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 72, NULL, '2020-10-21 14:26:41', '2020-10-21 14:27:32'),
(66, '125-2020', '2020-12-31', 1, '6', '09:00', '16:00', '12:30', '13:30', '2020-12-12', '2020-12-17', '2020-12-18', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 73, NULL, '2020-10-21 14:28:30', '2020-10-21 14:28:30'),
(67, '126-2020', '2020-12-31', 1, '6', '09:00', '16:00', '12:30', '13:30', '2020-12-19', '2020-12-24', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 74, NULL, '2020-10-21 14:28:56', '2020-10-21 14:28:56'),
(68, '127-2020', '2020-12-31', 1, '6', '09:00', '16:00', '12:30', '13:30', '2020-12-25', '2020-12-26', '2020-12-31', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 75, NULL, '2020-10-21 14:29:28', '2020-10-21 14:29:28'),
(69, NULL, NULL, 1, '6', '09:00', '16:00', '12:30', '13:30', '2021-01-07', '2021-01-08', '2021-01-09', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 76, NULL, '2020-10-22 05:11:08', '2020-10-22 11:26:25'),
(70, NULL, NULL, 1, '6', '09:00', '16:00', '12:30', '13:30', '2021-01-14', '2021-01-15', '2021-01-16', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 77, NULL, '2020-10-22 05:11:33', '2020-10-22 11:26:48'),
(71, NULL, NULL, 1, '6', '09:00', '16:00', '12:30', '13:30', '2021-01-21', '2021-01-22', '2021-01-23', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 78, NULL, '2020-10-22 05:12:03', '2020-10-22 11:27:11'),
(72, NULL, NULL, 1, '6', '09:00', '16:00', '12:30', '13:30', '2021-01-29', '2021-01-30', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 79, NULL, '2020-10-22 05:12:25', '2020-10-22 11:27:36'),
(73, NULL, NULL, 1, '6', '09:00', '16:00', '12:30', '13:30', '2021-01-05', '2021-02-06', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 80, NULL, '2020-10-22 05:12:45', '2020-10-22 11:29:15'),
(74, NULL, NULL, 1, '6', '09:00', '16:00', '12:30', '13:30', '2021-02-11', '2021-02-12', '2021-02-13', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 81, NULL, '2020-10-22 05:13:12', '2020-10-22 11:29:37'),
(75, NULL, NULL, 1, '6', '09:00', '16:00', '12:30', '13:30', '2021-02-18', '2021-02-19', '2021-02-20', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 82, NULL, '2020-10-22 05:13:41', '2020-10-22 11:29:56'),
(76, NULL, NULL, 1, '6', '09:00', '16:00', '12:30', '13:30', '2021-02-25', '2021-02-26', '2021-02-27', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 83, NULL, '2020-10-22 05:14:09', '2020-10-22 11:30:24'),
(77, '117-2020', '2020-12-31', 1, '5', '09:00', '16:00', '12:30', '13:30', '2020-11-19', '2020-11-20', '2020-11-21', '2020-11-26', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 84, 'Facturé -accusé', '2020-10-22 06:07:58', '2021-01-22 11:26:35'),
(78, '118-2020', '2020-12-31', 1, '5', '09:00', '16:00', '12:30', '13:30', '2020-11-27', '2020-11-28', '2020-12-03', '2020-12-04', '2020-12-05', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 85, 'Facturé -accusé', '2020-10-22 06:08:44', '2021-01-22 11:27:13'),
(79, '119-2020', '2020-12-31', 1, '5', '09:00', '16:00', '12:30', '13:30', '2020-12-10', '2020-12-11', '2020-12-12', '2020-12-17', '2020-12-18', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 86, 'Facturé -accusé', '2020-10-22 06:09:34', '2021-01-22 11:27:23'),
(80, '120-2020', '2020-12-31', 1, '5', '09:00', '16:00', '12:30', '13:30', '2020-12-19', '2020-12-24', '2020-12-25', '2020-12-26', '2020-12-31', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 87, 'Facturé -accusé', '2020-10-22 06:10:30', '2021-01-22 11:27:32'),
(81, NULL, NULL, 1, '5', '09:00', '16:00', '12:30', '13:30', '2021-01-02', '2021-01-07', '2021-01-08', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 88, NULL, '2020-10-22 06:11:10', '2021-01-22 11:28:18'),
(82, NULL, NULL, 1, '5', '09:00', '16:00', '12:30', '13:30', '2021-01-09', '2021-01-14', '2021-01-15', '2021-01-16', '2021-01-21', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 89, NULL, '2020-10-22 06:12:06', '2020-10-22 06:12:06'),
(83, '71-2020', '2020-12-28', 1, '5', '09:00', '16:00', '12:30', '13:30', '2020-11-19', '2020-11-20', '2020-11-21', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 90, NULL, '2020-10-22 13:49:31', '2020-10-22 13:49:31'),
(84, '72-2020', '2020-12-28', 1, '5', '09:00', '16:00', '12:30', '13:30', '2020-11-26', '2020-11-27', '2020-11-28', '2020-12-04', '2020-12-05', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 91, NULL, '2020-10-22 13:50:20', '2020-10-22 13:50:20'),
(85, '73-2020', '2020-12-28', 1, '5', '09:00', '16:00', '12:30', '13:30', '2020-12-10', '2020-12-11', '2020-12-12', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 92, NULL, '2020-10-22 13:50:54', '2020-10-22 13:50:54'),
(86, '74-2020', '2020-12-28', 1, '5', '09:00', '16:00', '12:30', '13:30', '2020-12-17', '2020-12-18', '2020-12-19', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 93, NULL, '2020-10-22 13:52:00', '2020-10-22 13:52:00'),
(87, '75-2020', '2020-12-28', 1, '5', '09:00', '16:00', '12:30', '13:30', '2020-12-24', '2020-12-25', '2020-12-26', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 94, NULL, '2020-10-22 13:52:36', '2020-10-22 13:52:36'),
(96, '76-2020', '2020-12-28', 1, '5', '09:00', '16:00', '12:30', '13:30', '2020-11-19', '2020-11-20', '2020-11-21', '2020-11-27', '2020-11-28', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 96, NULL, '2020-10-23 08:25:42', '2020-10-23 08:25:42'),
(97, '77-2020', '2020-12-28', 1, '5', '09:00', '16:00', '12:30', '13:30', '2020-12-03', '2020-12-04', '2020-12-05', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 97, NULL, '2020-10-23 08:26:19', '2020-10-23 08:26:19'),
(98, '78-2020', '2020-12-28', 1, '5', '09:00', '16:00', '12:30', '13:30', '2020-12-10', '2020-12-11', '2020-12-12', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 98, NULL, '2020-10-23 08:26:56', '2020-10-23 08:26:56'),
(99, '79-2020', '2020-12-28', 1, '5', '09:00', '16:00', '12:30', '13:30', '2020-12-17', '2020-12-18', '2020-12-19', '2020-12-25', '2020-12-26', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 99, NULL, '2020-10-23 08:27:37', '2020-10-23 08:27:37'),
(100, NULL, NULL, 1, '5', '09:00', '16:00', '12:30', '13:30', '2021-01-07', '2021-01-08', '2021-01-09', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 100, NULL, '2020-10-23 08:28:06', '2020-10-23 08:28:06'),
(101, NULL, NULL, 1, '5', '09:00', '16:00', '12:30', '13:30', '2021-01-14', '2021-01-15', '2021-01-16', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 101, NULL, '2020-10-23 08:28:32', '2020-10-23 08:28:32'),
(102, NULL, NULL, 1, '5', '09:00', '16:00', '12:30', '13:30', '2021-01-21', '2021-01-22', '2021-01-23', '2021-01-28', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 102, NULL, '2020-10-23 08:29:11', '2020-10-23 08:29:11'),
(103, NULL, NULL, 1, '5', '09:00', '16:00', '12:30', '13:30', '2021-01-29', '2021-01-30', '2021-02-04', '2021-02-05', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 103, NULL, '2020-10-23 08:29:52', '2020-10-23 08:29:52'),
(104, '80-2020', '2020-12-28', 1, '5', '09:00', '16:00', '12:30', '13:30', '2020-11-19', '2020-11-20', '2020-11-21', '2020-11-27', '2020-11-28', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 104, NULL, '2020-10-23 08:47:54', '2020-10-23 08:47:54'),
(105, '81-2020', '2020-12-28', 1, '5', '09:00', '16:00', '12:30', '13:30', '2020-12-03', '2020-12-04', '2020-12-05', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 105, NULL, '2020-10-23 08:48:25', '2020-10-23 08:48:25'),
(106, '82-2020', '2020-12-28', 1, '5', '09:00', '16:00', '12:30', '13:30', '2020-12-10', '2020-12-11', '2020-12-12', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 106, NULL, '2020-10-23 08:48:59', '2020-10-23 08:48:59'),
(107, '83-2020', '2020-12-28', 1, '5', '09:00', '16:00', '12:30', '13:30', '2020-12-17', '2020-12-18', '2020-12-19', '2020-12-25', '2020-12-26', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 107, NULL, '2020-10-23 08:49:53', '2020-10-23 08:49:53'),
(108, NULL, NULL, 1, '5', '09:00', '16:00', '12:30', '13:30', '2021-01-07', '2021-01-08', '2021-01-09', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 108, NULL, '2020-10-23 08:52:01', '2020-10-23 08:52:01'),
(109, NULL, NULL, 1, '5', '09:00', '16:00', '12:30', '13:30', '2021-01-14', '2021-01-15', '2021-01-16', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 109, NULL, '2020-10-23 08:52:33', '2020-10-23 08:52:33'),
(110, NULL, NULL, 1, '5', '09:00', '16:00', '12:30', '13:30', '2021-01-21', '2021-01-22', '2021-01-23', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 110, NULL, '2020-10-23 08:53:07', '2020-10-23 08:53:07'),
(111, NULL, NULL, 1, '5', '09:00', '16:00', '12:30', '13:30', '2021-01-28', '2021-01-29', '2021-01-30', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 111, NULL, '2020-10-23 08:53:44', '2020-10-23 08:53:44'),
(112, '88-2020', '2020-12-28', 1, '5', '09:00', '16:00', '12:30', '13:30', '2020-11-19', '2020-11-20', '2020-11-21', '2020-11-27', '2020-11-28', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 112, NULL, '2020-10-23 10:02:04', '2020-10-23 10:02:04'),
(113, '89-2020', '2020-12-28', 1, '5', '09:00', '16:00', '12:30', '13:30', '2020-12-03', '2020-12-04', '2020-12-05', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 113, NULL, '2020-10-23 10:02:26', '2020-10-23 10:02:26'),
(114, '90-2020', '2020-12-28', 1, '5', '09:00', '16:00', '12:30', '13:30', '2020-12-10', '2020-12-11', '2020-12-12', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 114, NULL, '2020-10-23 10:02:56', '2020-10-23 10:02:56'),
(115, '91-2020', '2020-12-28', 1, '5', '09:00', '16:00', '12:30', '13:30', '2020-12-17', '2020-12-18', '2020-12-19', '2020-12-25', '2020-12-26', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 115, NULL, '2020-10-23 10:03:43', '2020-10-23 10:03:43'),
(116, NULL, NULL, 1, '5', '09:00', '16:00', '12:30', '13:30', '2020-12-31', '2021-01-07', '2021-01-08', '2021-01-09', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 116, NULL, '2020-10-23 10:04:23', '2020-10-23 10:04:23'),
(117, NULL, NULL, 1, '5', '09:00', '16:00', '12:30', '13:30', '2021-01-14', '2021-01-15', '2021-01-16', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 117, NULL, '2020-10-23 10:04:53', '2020-10-23 10:04:53'),
(118, NULL, NULL, 1, '5', '09:00', '16:00', '12:30', '13:30', '2021-01-21', '2021-01-22', '2021-01-23', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 118, NULL, '2020-10-23 10:05:21', '2020-10-23 10:05:21'),
(119, NULL, NULL, 1, '5', '09:00', '16:00', '12:30', '13:30', '2021-01-28', '2021-01-29', '2021-01-30', '2021-02-04', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 119, NULL, '2020-10-23 10:06:09', '2020-10-23 10:06:09'),
(120, NULL, NULL, 1, '5', '09:00', '16:00', '12:30', '13:30', '2021-02-05', '2021-02-06', '2021-02-11', '2021-02-12', '2021-02-13', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 120, NULL, '2020-10-23 10:06:58', '2020-10-23 10:06:58'),
(121, NULL, NULL, 1, '5', '09:00', '16:00', '12:30', '13:30', '2021-02-18', '2021-02-19', '2021-02-20', '2021-02-26', '2021-02-27', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 121, NULL, '2020-10-23 10:07:58', '2020-10-23 10:07:58'),
(122, NULL, NULL, 1, '5', '09:00', '16:00', '12:30', '13:30', '2021-03-04', '2021-03-05', '2021-03-06', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 122, NULL, '2020-10-23 10:08:27', '2020-10-23 10:08:27'),
(123, '84-2020', '2020-12-28', 1, '5', '09:00', '16:00', '12:30', '13:30', '2020-11-19', '2020-11-20', '2020-11-21', '2020-11-27', '2020-11-28', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 123, NULL, '2020-10-23 10:28:36', '2020-10-23 10:28:36'),
(124, '85-2020', '2020-12-28', 1, '5', '09:00', '16:00', '12:30', '13:30', '2020-12-03', '2020-12-04', '2020-12-05', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 124, NULL, '2020-10-23 10:29:15', '2020-10-23 10:29:15'),
(125, '86-2020', '2020-12-28', 1, '5', '09:00', '16:00', '12:30', '13:30', '2020-12-10', '2020-12-11', '2020-12-12', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 125, NULL, '2020-10-23 10:29:46', '2020-10-23 10:29:46'),
(126, '87-2020', '2020-12-28', 1, '5', '09:00', '16:00', '12:30', '13:30', '2020-12-17', '2020-12-18', '2020-12-19', '2020-12-25', '2020-12-26', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 126, NULL, '2020-10-23 10:54:56', '2020-10-23 10:54:56'),
(127, NULL, NULL, 1, '5', '09:00', '16:00', '12:30', '13:30', '2021-01-07', '2021-01-08', '2021-01-09', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 127, NULL, '2020-10-23 10:55:32', '2020-10-23 10:55:32'),
(128, NULL, NULL, 1, '5', '09:00', '16:00', '12:30', '13:30', '2021-01-14', '2021-01-15', '2021-01-16', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 128, NULL, '2020-10-23 10:56:08', '2020-10-23 10:56:08'),
(129, NULL, NULL, 1, '5', '09:00', '16:00', '12:30', '13:30', '2021-01-21', '2021-01-22', '2021-01-23', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 129, NULL, '2020-10-23 10:56:46', '2020-10-23 10:56:46'),
(130, NULL, NULL, 1, '5', '09:00', '16:00', '12:30', '13:30', '2021-01-28', '2021-01-29', '2021-01-30', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 130, NULL, '2020-10-23 10:57:35', '2020-10-23 10:57:35'),
(131, '67-2020', '2020-12-28', 1, '5', '09:00', '16:00', '12:30', '13:30', '2020-11-19', '2020-11-20', '2020-11-21', '2020-11-26', '2020-11-27', '2020-11-28', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 131, NULL, '2020-10-23 12:32:56', '2020-10-23 12:32:56'),
(132, '68-2020', '2020-12-28', 1, '5', '09:00', '16:00', '12:30', '13:30', '2020-12-03', '2020-12-04', '2020-12-05', '2020-12-10', '2020-12-11', '2020-12-12', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 132, NULL, '2020-10-23 12:34:02', '2020-10-23 12:34:02'),
(133, '69-2020', '2020-12-28', 1, '5', '09:00', '16:00', '12:30', '13:30', '2020-12-17', '2020-12-18', '2020-12-19', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 133, NULL, '2020-10-23 12:34:38', '2020-10-23 12:34:38'),
(134, '70-2020', '2020-12-28', 1, '5', '09:00', '16:00', '12:30', '13:30', '2020-12-24', '2020-12-25', '2020-12-26', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 134, NULL, '2020-10-23 12:35:31', '2020-10-23 12:35:31'),
(135, NULL, NULL, 1, '5', '09:00', '16:00', '12:30', '13:30', '2021-01-07', '2021-01-08', '2021-01-09', '2021-01-14', '2021-01-15', '2021-01-16', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 135, NULL, '2020-10-23 12:36:35', '2020-10-23 12:36:35'),
(136, NULL, NULL, 1, '5', '09:00', '16:00', '12:30', '13:30', '2021-01-21', '2021-01-22', '2021-01-23', '2021-01-28', '2021-01-29', '2021-01-30', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 136, NULL, '2020-10-23 12:37:29', '2020-10-23 12:37:29'),
(137, NULL, NULL, 1, '5', '09:00', '16:00', '12:30', '13:30', '2021-02-04', '2021-02-05', '2021-02-06', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 137, NULL, '2020-10-23 12:38:01', '2020-10-23 12:38:01'),
(138, NULL, NULL, 1, '5', '09:00', '16:00', '12:30', '13:30', '2021-02-11', '2021-02-12', '2021-02-13', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 138, NULL, '2020-10-23 12:38:48', '2020-10-23 12:38:48'),
(139, NULL, NULL, 1, '5', '09:00', '16:00', '12:30', '13:30', '2021-02-18', '2021-02-19', '2021-02-20', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 139, NULL, '2020-10-23 12:40:54', '2020-10-23 12:40:54'),
(140, NULL, NULL, 1, '5', '09:00', '16:00', '12:30', '13:30', '2021-02-25', '2021-02-26', '2021-02-27', '2021-03-04', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 140, NULL, '2020-10-23 12:41:36', '2020-10-23 12:41:36'),
(141, '63-2020', '2020-12-28', 1, '5', '09:00', '16:00', '12:30', '13:30', '2020-11-19', '2020-11-20', '2020-11-21', '2020-11-26', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 141, NULL, '2020-10-23 14:30:40', '2020-10-23 14:30:40'),
(142, '64-2020', '2020-12-28', 1, '5', '09:00', '16:00', '12:30', '13:30', '2020-11-27', '2020-11-28', '2020-12-03', '2020-12-04', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 142, NULL, '2020-10-23 14:31:15', '2020-10-23 14:31:15'),
(143, '65-2020', '2020-12-28', 1, '5', '09:00', '16:00', '12:30', '13:30', '2020-12-05', '2020-12-10', '2020-12-11', '2020-12-12', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 143, NULL, '2020-10-23 14:31:59', '2020-10-23 14:31:59'),
(144, '66-2020', '2020-12-28', 1, '5', '09:00', '16:00', '12:30', '13:30', '2020-12-17', '2020-12-18', '2020-12-19', '2020-12-24', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 144, NULL, '2020-10-23 14:33:28', '2020-10-23 14:33:28'),
(145, NULL, '2021-01-07', 1, '5', '09:00', '16:00', '12:30', '13:30', '2020-12-25', '2020-12-26', '2020-12-31', '2021-01-07', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 145, NULL, '2020-10-23 14:34:11', '2020-10-24 08:23:33'),
(146, NULL, NULL, 1, '5', '09:00', '16:00', '12:30', '13:30', '2021-01-08', '2021-01-09', '2021-01-15', '2021-01-16', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 146, NULL, '2020-10-23 14:35:43', '2020-10-24 08:24:04'),
(147, NULL, NULL, 1, '5', '09:00', '16:00', '12:30', '13:30', '2021-01-21', '2021-01-22', '2021-01-23', '2021-01-28', '2021-01-29', '2021-01-30', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 147, NULL, '2020-10-23 14:36:31', '2020-10-24 08:24:41'),
(148, NULL, NULL, 1, '5', '09:00', '16:00', '12:30', '13:30', '2021-02-04', '2021-02-05', '2021-02-06', '2021-02-11', '2021-02-12', '2021-02-13', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 148, NULL, '2020-10-23 14:37:25', '2020-10-24 08:25:19'),
(149, NULL, NULL, 1, '5', '09:00', '16:00', '12:30', '13:30', '2021-02-18', '2021-02-19', '2021-02-20', '2021-02-25', '2021-02-26', '2021-02-27', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 149, NULL, '2020-10-23 14:38:10', '2020-10-24 08:25:56'),
(150, NULL, NULL, 1, '5', '09:00', '16:00', '12:30', '13:30', '2021-03-04', '2021-03-05', '2021-03-06', '2021-03-11', '2021-03-12', '2021-03-13', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 150, NULL, '2020-10-23 14:39:05', '2020-10-24 08:26:27'),
(151, '128-2020', '2020-12-31', 1, '6', '09:00', '16:00', '12:30', '13:30', '2020-11-19', '2020-11-20', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 151, NULL, '2020-11-02 08:08:14', '2020-11-02 08:08:14'),
(152, '129-2020', '2020-12-31', 1, '5', '09:00', '16:00', '12:30', '13:30', '2020-11-21', '2020-11-26', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 152, NULL, '2020-11-02 08:08:43', '2020-12-01 14:58:54'),
(153, '130-2020', '2020-12-31', 1, '5', '09:00', '16:00', '12:30', '13:30', '2020-11-27', '2020-11-28', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 153, NULL, '2020-11-02 08:09:12', '2020-12-01 15:01:43'),
(154, '131-2020', '2020-12-31', 1, '6', '09:00', '16:00', '12:30', '13:30', '2020-12-03', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 154, NULL, '2020-11-02 08:09:44', '2020-11-02 08:09:44'),
(155, '132-2020', '2020-12-31', 1, '6', '09:00', '16:00', '12:30', '13:30', '2020-12-05', '2020-12-10', '2020-12-11', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 155, NULL, '2020-11-02 08:10:18', '2020-11-02 08:10:18'),
(156, '133-2020', '2020-12-31', 1, '6', '09:00', '16:00', '12:30', '13:30', '2020-12-12', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 156, NULL, '2020-11-02 08:10:41', '2020-11-02 08:10:41'),
(157, '134-2020', '2020-12-31', 1, '6', '09:00', '16:00', '12:30', '13:30', '2020-12-17', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 157, NULL, '2020-11-02 08:11:09', '2020-11-02 08:11:09'),
(158, '135-2020', '2020-12-31', 1, '5', '09:00', '16:00', '12:30', '13:30', '2020-12-18', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 158, NULL, '2020-11-02 08:11:31', '2020-12-01 15:34:42'),
(159, '136-2020', '2020-12-31', 1, '5', '09:00', '16:00', '12:30', '13:30', '2020-12-19', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 159, NULL, '2020-11-02 08:11:54', '2020-12-01 15:51:05'),
(160, '137-2020', '2020-12-31', 1, '6', '09:00', '16:00', '12:30', '13:30', '2020-12-24', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 160, NULL, '2020-11-02 08:12:15', '2020-11-02 08:12:15'),
(161, '138-2020', '2020-12-31', 1, '5', '09:00', '16:00', '12:30', '13:30', '2020-12-25', '2020-12-26', '2020-12-31', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 161, NULL, '2020-11-02 08:12:52', '2020-12-02 09:53:17'),
(162, NULL, NULL, 1, '6', '09:00', '16:00', '12:30', '13:30', '2021-01-07', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 162, NULL, '2020-11-02 08:13:12', '2020-12-02 10:09:39'),
(163, NULL, NULL, 1, '6', '09:00', '16:00', '12:30', '13:30', '2021-01-08', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 163, NULL, '2020-11-02 08:13:48', '2020-12-02 10:16:40'),
(164, NULL, NULL, 1, '6', '09:00', '16:00', '12:30', '13:30', '2021-01-09', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 164, NULL, '2020-11-02 08:14:15', '2021-01-12 11:10:10'),
(165, NULL, NULL, 1, '6', '09:00', '16:00', '12:30', '13:30', '2021-01-14', '2021-01-15', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 165, NULL, '2020-11-02 08:14:42', '2020-11-02 08:14:42'),
(166, NULL, NULL, 1, '5', '09:00', '16:00', '12:30', '13:30', '2021-01-16', '2021-01-21', '2021-01-22', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 166, NULL, '2020-11-02 08:15:07', '2020-12-02 10:07:03'),
(167, NULL, NULL, 1, '6', '09:00', '16:00', '12:30', '13:30', '2021-01-29', '2021-01-30', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 167, NULL, '2020-11-02 08:16:15', '2020-12-02 10:35:08');
INSERT INTO `formations` (`id_form`, `n_facture`, `dt_facture`, `groupe`, `nb_benif`, `hr_debut`, `hr_fin`, `pse_debut`, `pse_fin`, `date1`, `date2`, `date3`, `date4`, `date5`, `date6`, `date7`, `date8`, `date9`, `date10`, `date11`, `date12`, `date13`, `date14`, `date15`, `date16`, `date17`, `date18`, `date19`, `date20`, `date21`, `date22`, `date23`, `date24`, `date25`, `date26`, `date27`, `date28`, `date29`, `date30`, `n_form`, `commentaire`, `created_at`, `updated_at`) VALUES
(168, NULL, NULL, 1, '5', '09:00', '16:00', '12:30', '13:30', '2021-02-05', '2021-02-06', '2021-02-11', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 168, NULL, '2020-11-02 08:16:56', '2020-12-02 10:38:36'),
(169, NULL, NULL, 1, '6', '09:00', '16:00', '12:30', '13:30', '2021-02-12', '2021-02-13', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 169, NULL, '2020-11-02 08:17:31', '2020-12-02 10:42:23'),
(170, NULL, NULL, 1, '6', '09:00', '16:00', '12:30', '13:30', '2019-10-17', '2019-10-18', '2019-10-19', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 17, NULL, '2020-11-02 08:43:11', '2020-11-02 08:43:11'),
(172, NULL, NULL, 1, '5', '09:00', '16:00', '12:30', '13:30', '2010-01-01', '2010-01-02', '2010-01-03', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 210, NULL, '2020-11-24 08:14:18', '2020-11-24 08:14:18'),
(174, NULL, NULL, 1, '10', '09:00', '16:00', '12:30', '13:30', '2019-10-14', '2019-10-15', '2019-10-16', '2019-10-17', '2019-10-18', '2019-10-21', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 193, NULL, '2020-11-24 11:32:07', '2020-11-24 11:32:07'),
(175, NULL, NULL, 1, '6', '09:00', '16:00', '12:30', '13:30', '2019-10-22', '2019-10-23', '2019-10-24', '2019-10-25', '2019-10-28', '2019-10-29', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 199, NULL, '2020-11-24 11:36:35', '2020-11-24 11:36:35'),
(176, NULL, NULL, 1, '5', '09:00', '16:00', '12:30', '13:30', '2019-10-30', '2019-10-31', '2019-11-01', '2019-11-04', '2019-11-05', '2019-11-07', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 202, NULL, '2020-11-24 11:38:41', '2020-11-24 11:38:41'),
(177, NULL, NULL, 1, '5', '09:00', '16:00', '12:30', '13:30', '2019-11-08', '2019-11-11', '2019-11-12', '2019-11-13', '2019-11-14', '2019-11-15', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 203, NULL, '2020-11-24 11:39:53', '2020-11-24 11:39:53'),
(178, NULL, NULL, 1, '6', '09:00', '16:00', '12:30', '13:30', '2019-11-19', '2019-11-20', '2019-11-21', '2019-11-22', '2019-11-25', '2019-11-26', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 204, NULL, '2020-11-24 11:44:06', '2020-11-24 11:44:06'),
(179, NULL, NULL, 1, '10', '17:00', '20:00', '00:00', '00:00', '2019-11-26', '2019-11-29', '2019-12-06', '2019-12-10', '2019-12-13', '2019-12-31', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 211, 'A corriger dates', '2020-11-24 12:39:35', '2020-11-24 12:55:49'),
(180, NULL, NULL, 1, '15', '09:00', '16:00', '00:00', '00:00', '2019-11-26', '2019-11-28', '2019-12-02', '2019-12-03', '2019-12-05', '2019-12-09', '2019-12-10', '2019-12-12', '2019-12-31', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 212, 'A corriger dates', '2020-11-24 12:42:42', '2020-11-24 12:58:58'),
(181, NULL, NULL, 1, '12', '09:00', '16:00', '12:30', '13:30', '2020-12-04', '2020-12-05', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 213, NULL, '2020-12-02 10:34:56', '2020-12-02 10:34:56'),
(182, NULL, NULL, 1, '9', '09:00', '16:00', '12:30', '13:30', '2019-12-03', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 214, NULL, '2020-12-24 10:54:15', '2020-12-24 10:54:15'),
(183, NULL, NULL, 1, '5', '09:00', '16:00', '12:30', '13:30', '2019-12-10', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 215, NULL, '2020-12-24 10:58:53', '2020-12-24 10:58:53'),
(184, NULL, NULL, 1, '9', '09:00', '16:00', '12:30', '13:30', '2019-12-11', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 216, NULL, '2020-12-24 11:02:15', '2020-12-24 11:02:15'),
(185, NULL, NULL, 1, '9', '09:00', '16:00', '12:30', '13:30', '2019-12-13', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 217, NULL, '2020-12-24 11:03:43', '2020-12-24 11:03:43'),
(186, NULL, NULL, 1, '5', '09:00', '16:00', '12:30', '13:30', '2019-12-17', '2019-12-18', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 218, NULL, '2020-12-24 11:05:38', '2020-12-24 11:05:38'),
(187, NULL, NULL, 1, '5', '09:00', '16:00', '12:30', '13:30', '2019-12-20', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 219, NULL, '2020-12-24 11:09:10', '2020-12-24 11:09:10'),
(188, NULL, NULL, 1, '5', '09:00', '16:00', '12:30', '13:30', '2019-12-24', '2019-12-25', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 220, NULL, '2020-12-24 11:12:05', '2020-12-24 11:12:05'),
(189, '02-2021', '2021-01-20', 2, '6', '17:00', '20:00', '00:00', '00:00', '2020-12-07', '2020-12-08', '2020-12-14', '2020-12-15', '2020-12-21', '2020-12-22', '2020-12-28', '2020-12-29', '2021-01-04', '2021-01-05', '2021-01-12', '2021-01-18', '2021-01-19', '2021-01-20', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 43, NULL, '2020-12-30 14:14:22', '2020-12-30 14:17:18'),
(190, '96-2020', '2020-12-28', 2, '6', '17:00', '20:00', '00:00', '00:00', '2020-11-09', '2020-11-10', '2020-11-16', '2020-11-17', '2020-11-23', '2020-11-24', '2020-11-30', '2020-12-01', '2020-12-02', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 42, NULL, '2020-12-30 14:31:39', '2020-12-30 14:31:39');

-- --------------------------------------------------------

--
-- Structure de la table `formation_personnels`
--

CREATE TABLE `formation_personnels` (
  `cin` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_form` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `formation_personnels`
--

INSERT INTO `formation_personnels` (`cin`, `id_form`, `created_at`, `updated_at`) VALUES
('AB127499', 23, '2020-09-24 12:38:34', '2020-09-24 12:38:34'),
('AB507528', 16, '2020-10-28 14:33:37', '2020-10-28 14:33:37'),
('AB541180', 20, '2020-09-24 12:25:59', '2020-09-24 12:25:59'),
('B000001', 172, '2020-11-24 08:14:28', '2020-11-24 08:14:28'),
('B000001', 181, '2020-12-02 10:34:56', '2020-12-02 10:34:56'),
('B000002', 172, '2020-11-24 08:14:28', '2020-11-24 08:14:28'),
('B000002', 181, '2020-12-02 10:34:57', '2020-12-02 10:34:57'),
('B000003', 172, '2020-11-24 08:14:28', '2020-11-24 08:14:28'),
('B000003', 181, '2020-12-02 10:34:57', '2020-12-02 10:34:57'),
('B000004', 172, '2020-11-24 08:14:28', '2020-11-24 08:14:28'),
('B000004', 181, '2020-12-02 10:34:57', '2020-12-02 10:34:57'),
('B000005', 172, '2020-11-24 08:14:28', '2020-11-24 08:14:28'),
('B000005', 181, '2020-12-02 10:34:57', '2020-12-02 10:34:57'),
('B000006', 181, '2020-12-02 10:34:57', '2020-12-02 10:34:57'),
('BB112192', 12, '2020-11-02 12:48:59', '2020-11-02 12:48:59'),
('BB119407', 1, '2020-09-17 07:11:44', '2020-09-17 07:11:44'),
('BB128479', 9, '2020-11-03 09:05:13', '2020-11-03 09:05:13'),
('BB145767', 16, '2020-10-28 14:33:37', '2020-10-28 14:33:37'),
('BB151229', 17, '2020-09-24 11:07:30', '2020-09-24 11:07:30'),
('BB51059', 9, '2020-11-03 09:05:13', '2020-11-03 09:05:13'),
('BB74278', 16, '2020-10-28 14:33:37', '2020-10-28 14:33:37'),
('BB83566', 1, '2020-09-17 07:11:44', '2020-09-17 07:11:44'),
('BE641494', 9, '2020-11-03 09:05:13', '2020-11-03 09:05:13'),
('BE681847', 10, '2020-11-03 08:42:41', '2020-11-03 08:42:41'),
('BE760192', 182, '2020-12-24 10:54:15', '2020-12-24 10:54:15'),
('BE760192', 183, '2020-12-24 10:58:54', '2020-12-24 10:58:54'),
('BE760192', 184, '2020-12-24 11:02:15', '2020-12-24 11:02:15'),
('BE760192', 185, '2020-12-24 11:03:43', '2020-12-24 11:03:43'),
('BE760192', 186, '2020-12-24 11:05:39', '2020-12-24 11:05:39'),
('BE760192', 187, '2020-12-24 11:09:10', '2020-12-24 11:09:10'),
('BE760192', 188, '2020-12-24 11:12:05', '2020-12-24 11:12:05'),
('BE762319', 3, '2020-10-28 13:19:49', '2020-10-28 13:19:49'),
('BE789899', 182, '2020-12-24 10:54:15', '2020-12-24 10:54:15'),
('BE789899', 184, '2020-12-24 11:02:15', '2020-12-24 11:02:15'),
('BE789899', 185, '2020-12-24 11:03:43', '2020-12-24 11:03:43'),
('BE801763', 182, '2020-12-24 10:54:15', '2020-12-24 10:54:15'),
('BE801763', 183, '2020-12-24 10:58:54', '2020-12-24 10:58:54'),
('BE801763', 184, '2020-12-24 11:02:15', '2020-12-24 11:02:15'),
('BE801763', 185, '2020-12-24 11:03:43', '2020-12-24 11:03:43'),
('BE801763', 186, '2020-12-24 11:05:39', '2020-12-24 11:05:39'),
('BE801763', 187, '2020-12-24 11:09:10', '2020-12-24 11:09:10'),
('BE801763', 188, '2020-12-24 11:12:05', '2020-12-24 11:12:05'),
('BE814835', 3, '2020-10-28 13:19:49', '2020-10-28 13:19:49'),
('BE821203', 22, '2020-09-24 12:37:18', '2020-09-24 12:37:18'),
('BE833143', 27, '2020-10-16 07:30:32', '2020-10-16 07:30:32'),
('BE833143', 28, '2020-10-16 07:32:37', '2020-10-16 07:32:37'),
('BE833143', 29, '2020-12-29 11:25:52', '2020-12-29 11:25:52'),
('BE833143', 30, '2020-12-29 12:53:07', '2020-12-29 12:53:07'),
('BE833143', 174, '2020-11-24 11:34:48', '2020-11-24 11:34:48'),
('BE833143', 175, '2020-11-24 11:36:35', '2020-11-24 11:36:35'),
('BE833143', 176, '2020-11-24 11:38:41', '2020-11-24 11:38:41'),
('BE833143', 177, '2020-11-24 11:39:53', '2020-11-24 11:39:53'),
('BE833143', 178, '2020-11-24 11:44:06', '2020-11-24 11:44:06'),
('BE833143', 179, '2020-11-24 12:55:49', '2020-11-24 12:55:49'),
('BE833143', 180, '2020-11-24 12:58:58', '2020-11-24 12:58:58'),
('BE833143', 189, '2020-12-30 14:17:18', '2020-12-30 14:17:18'),
('BE833143', 190, '2020-12-30 14:31:39', '2020-12-30 14:31:39'),
('BH323130', 7, '2020-09-24 10:11:57', '2020-09-24 10:11:57'),
('BH439122', 3, '2020-10-28 13:19:49', '2020-10-28 13:19:49'),
('BH451672', 8, '2020-09-24 10:13:47', '2020-09-24 10:13:47'),
('BH571137', 2, '2020-09-16 06:03:45', '2020-09-16 06:03:45'),
('BH605368', 24, '2020-09-25 11:00:44', '2020-09-25 11:00:44'),
('BJ203687', 182, '2020-12-24 10:54:15', '2020-12-24 10:54:15'),
('BJ203687', 183, '2020-12-24 10:58:54', '2020-12-24 10:58:54'),
('BJ203687', 184, '2020-12-24 11:02:15', '2020-12-24 11:02:15'),
('BJ203687', 185, '2020-12-24 11:03:43', '2020-12-24 11:03:43'),
('BJ203687', 186, '2020-12-24 11:05:39', '2020-12-24 11:05:39'),
('BJ203687', 187, '2020-12-24 11:09:10', '2020-12-24 11:09:10'),
('BJ203687', 188, '2020-12-24 11:12:05', '2020-12-24 11:12:05'),
('BJ247304', 3, '2020-10-28 13:19:49', '2020-10-28 13:19:49'),
('BJ293996', 24, '2020-09-25 11:00:44', '2020-09-25 11:00:44'),
('BJ293996', 25, '2020-09-25 11:02:08', '2020-09-25 11:02:08'),
('BJ330251', 13, '2020-09-24 10:24:26', '2020-09-24 10:24:26'),
('BJ330251', 170, '2020-11-02 08:49:20', '2020-11-02 08:49:20'),
('BJ342701', 16, '2020-10-28 14:33:37', '2020-10-28 14:33:37'),
('BJ385454', 1, '2020-09-17 07:11:44', '2020-09-17 07:11:44'),
('BJ405709', 7, '2020-09-24 10:11:57', '2020-09-24 10:11:57'),
('BJ405794', 17, '2020-09-24 11:07:30', '2020-09-24 11:07:30'),
('BJ55520', 182, '2020-12-24 10:54:16', '2020-12-24 10:54:16'),
('BJ55520', 184, '2020-12-24 11:02:15', '2020-12-24 11:02:15'),
('BJ55520', 185, '2020-12-24 11:03:43', '2020-12-24 11:03:43'),
('BJ85820', 19, '2020-09-25 07:46:48', '2020-09-25 07:46:48'),
('BJ96498', 21, '2020-09-24 12:34:27', '2020-09-24 12:34:27'),
('BJ96498', 22, '2020-09-24 12:37:18', '2020-09-24 12:37:18'),
('BK188248', 18, '2020-09-24 11:09:05', '2020-09-24 11:09:05'),
('BK230730', 18, '2020-09-24 11:09:05', '2020-09-24 11:09:05'),
('BK271581', 22, '2020-09-24 12:37:18', '2020-09-24 12:37:18'),
('BK280839', 9, '2020-11-03 09:05:13', '2020-11-03 09:05:13'),
('BK299677', 17, '2020-09-24 11:07:30', '2020-09-24 11:07:30'),
('BK388303', 23, '2020-09-24 12:38:34', '2020-09-24 12:38:34'),
('BK47633', 7, '2020-09-24 10:11:57', '2020-09-24 10:11:57'),
('BK513184', 1, '2020-09-17 07:11:44', '2020-09-17 07:11:44'),
('BK529491', 21, '2020-09-24 12:34:27', '2020-09-24 12:34:27'),
('BK612023', 10, '2020-11-03 08:42:41', '2020-11-03 08:42:41'),
('BK629034', 17, '2020-09-24 11:07:30', '2020-09-24 11:07:30'),
('BK8069', 18, '2020-09-24 11:09:05', '2020-09-24 11:09:05'),
('BK8069', 19, '2020-09-25 07:46:48', '2020-09-25 07:46:48'),
('BL115837', 20, '2020-09-24 12:25:59', '2020-09-24 12:25:59'),
('BL52416', 12, '2020-11-02 12:48:59', '2020-11-02 12:48:59'),
('BL52416', 170, '2020-11-02 08:49:20', '2020-11-02 08:49:20'),
('BL77684', 22, '2020-09-24 12:37:18', '2020-09-24 12:37:18'),
('BW10215', 18, '2020-09-24 11:09:05', '2020-09-24 11:09:05'),
('C496236', 4, '2020-09-23 05:10:15', '2020-09-23 05:10:15'),
('C496236', 5, '2020-09-23 05:11:31', '2020-09-23 05:11:31'),
('C496236', 6, '2020-09-23 05:13:19', '2020-09-23 05:13:19'),
('C622911', 3, '2020-10-28 13:19:49', '2020-10-28 13:19:49'),
('CB97868', 20, '2020-09-24 12:25:59', '2020-09-24 12:25:59'),
('CB97868', 21, '2020-09-24 12:34:27', '2020-09-24 12:34:27'),
('CD222702', 182, '2020-12-24 10:54:16', '2020-12-24 10:54:16'),
('CD222702', 183, '2020-12-24 10:58:54', '2020-12-24 10:58:54'),
('CD222702', 184, '2020-12-24 11:02:15', '2020-12-24 11:02:15'),
('CD222702', 185, '2020-12-24 11:03:43', '2020-12-24 11:03:43'),
('CD222702', 186, '2020-12-24 11:05:39', '2020-12-24 11:05:39'),
('CD222702', 187, '2020-12-24 11:09:10', '2020-12-24 11:09:10'),
('CD222702', 188, '2020-12-24 11:12:05', '2020-12-24 11:12:05'),
('CD95441', 27, '2020-10-16 07:30:32', '2020-10-16 07:30:32'),
('CD95441', 29, '2020-12-29 11:25:52', '2020-12-29 11:25:52'),
('CD95441', 30, '2020-12-29 12:53:07', '2020-12-29 12:53:07'),
('CD95441', 31, '2020-10-16 07:56:59', '2020-10-16 07:56:59'),
('CD95441', 174, '2020-11-24 11:34:48', '2020-11-24 11:34:48'),
('CD95441', 175, '2020-11-24 11:36:35', '2020-11-24 11:36:35'),
('CD95441', 176, '2020-11-24 11:38:41', '2020-11-24 11:38:41'),
('CD95441', 177, '2020-11-24 11:39:53', '2020-11-24 11:39:53'),
('CD95441', 178, '2020-11-24 11:44:06', '2020-11-24 11:44:06'),
('CD95441', 179, '2020-11-24 12:55:49', '2020-11-24 12:55:49'),
('CD95441', 180, '2020-11-24 12:58:58', '2020-11-24 12:58:58'),
('CD95441', 189, '2020-12-30 14:17:18', '2020-12-30 14:17:18'),
('CD95441', 190, '2020-12-30 14:31:40', '2020-12-30 14:31:40'),
('D560147', 25, '2020-09-25 11:02:08', '2020-09-25 11:02:08'),
('D613363', 22, '2020-09-24 12:37:18', '2020-09-24 12:37:18'),
('D791138', 3, '2020-10-28 13:19:49', '2020-10-28 13:19:49'),
('D823680', 9, '2020-11-03 09:05:14', '2020-11-03 09:05:14'),
('E279385', 7, '2020-09-24 10:11:57', '2020-09-24 10:11:57'),
('E557828', 182, '2020-12-24 10:54:16', '2020-12-24 10:54:16'),
('E557828', 184, '2020-12-24 11:02:15', '2020-12-24 11:02:15'),
('E557828', 185, '2020-12-24 11:03:43', '2020-12-24 11:03:43'),
('E590982', 182, '2020-12-24 10:54:16', '2020-12-24 10:54:16'),
('E590982', 184, '2020-12-24 11:02:15', '2020-12-24 11:02:15'),
('E590982', 185, '2020-12-24 11:03:43', '2020-12-24 11:03:43'),
('EE351245', 27, '2020-10-16 07:30:32', '2020-10-16 07:30:32'),
('EE351245', 28, '2020-10-16 07:32:37', '2020-10-16 07:32:37'),
('EE351245', 29, '2020-12-29 11:25:52', '2020-12-29 11:25:52'),
('EE351245', 30, '2020-12-29 12:53:08', '2020-12-29 12:53:08'),
('EE351245', 31, '2020-10-16 07:56:59', '2020-10-16 07:56:59'),
('EE351245', 174, '2020-11-24 11:34:48', '2020-11-24 11:34:48'),
('EE351245', 175, '2020-11-24 11:36:35', '2020-11-24 11:36:35'),
('EE351245', 177, '2020-11-24 11:39:53', '2020-11-24 11:39:53'),
('EE351245', 178, '2020-11-24 11:44:06', '2020-11-24 11:44:06'),
('EE351245', 179, '2020-11-24 12:55:49', '2020-11-24 12:55:49'),
('EE351245', 180, '2020-11-24 12:58:59', '2020-11-24 12:58:59'),
('EE351245', 189, '2020-12-30 14:17:19', '2020-12-30 14:17:19'),
('EE351245', 190, '2020-12-30 14:31:40', '2020-12-30 14:31:40'),
('G167563', 22, '2020-09-24 12:37:18', '2020-09-24 12:37:18'),
('G370152', 4, '2020-09-23 05:10:15', '2020-09-23 05:10:15'),
('G370152', 5, '2020-09-23 05:11:31', '2020-09-23 05:11:31'),
('G370152', 6, '2020-09-23 05:13:19', '2020-09-23 05:13:19'),
('H412981', 8, '2020-09-24 10:13:47', '2020-09-24 10:13:47'),
('HA109573', 12, '2020-11-02 12:48:59', '2020-11-02 12:48:59'),
('HA109573', 170, '2020-11-02 08:49:20', '2020-11-02 08:49:20'),
('HA128737', 1, '2020-09-17 07:11:44', '2020-09-17 07:11:44'),
('HA82167', 19, '2020-09-25 07:46:48', '2020-09-25 07:46:48'),
('I291000', 18, '2020-09-24 11:09:05', '2020-09-24 11:09:05'),
('I291000', 19, '2020-09-25 07:46:48', '2020-09-25 07:46:48'),
('I374967', 10, '2020-11-03 08:42:41', '2020-11-03 08:42:41'),
('I526187', 4, '2020-09-23 05:10:15', '2020-09-23 05:10:15'),
('I526187', 5, '2020-09-23 05:11:31', '2020-09-23 05:11:31'),
('I526187', 6, '2020-09-23 05:13:19', '2020-09-23 05:13:19'),
('IB155599', 20, '2020-09-24 12:25:59', '2020-09-24 12:25:59'),
('IB155599', 21, '2020-09-24 12:34:27', '2020-09-24 12:34:27'),
('IB190762', 23, '2020-09-24 12:38:34', '2020-09-24 12:38:34'),
('IB207359', 23, '2020-09-24 12:38:34', '2020-09-24 12:38:34'),
('IB72058', 27, '2020-10-16 07:30:32', '2020-10-16 07:30:32'),
('IB72058', 28, '2020-10-16 07:32:37', '2020-10-16 07:32:37'),
('IB72058', 29, '2020-12-29 11:25:52', '2020-12-29 11:25:52'),
('IB72058', 30, '2020-12-29 12:53:08', '2020-12-29 12:53:08'),
('IB72058', 31, '2020-10-16 07:56:59', '2020-10-16 07:56:59'),
('IB72058', 174, '2020-11-24 11:34:48', '2020-11-24 11:34:48'),
('IB72058', 175, '2020-11-24 11:36:35', '2020-11-24 11:36:35'),
('IB72058', 176, '2020-11-24 11:38:41', '2020-11-24 11:38:41'),
('IB72058', 177, '2020-11-24 11:39:53', '2020-11-24 11:39:53'),
('IB72058', 178, '2020-11-24 11:44:06', '2020-11-24 11:44:06'),
('IB72058', 179, '2020-11-24 12:55:49', '2020-11-24 12:55:49'),
('IB72058', 180, '2020-11-24 12:58:59', '2020-11-24 12:58:59'),
('IB72058', 189, '2020-12-30 14:17:19', '2020-12-30 14:17:19'),
('IB72058', 190, '2020-12-30 14:31:40', '2020-12-30 14:31:40'),
('IC46156', 16, '2020-10-28 14:33:37', '2020-10-28 14:33:37'),
('J449065', 13, '2020-09-24 10:24:26', '2020-09-24 10:24:26'),
('J454140', 27, '2020-10-16 07:30:32', '2020-10-16 07:30:32'),
('J454140', 28, '2020-10-16 07:32:37', '2020-10-16 07:32:37'),
('J454140', 29, '2020-12-29 11:25:52', '2020-12-29 11:25:52'),
('J454140', 30, '2020-12-29 12:53:08', '2020-12-29 12:53:08'),
('J454140', 31, '2020-10-16 07:56:59', '2020-10-16 07:56:59'),
('J454140', 174, '2020-11-24 11:34:48', '2020-11-24 11:34:48'),
('J454140', 175, '2020-11-24 11:36:35', '2020-11-24 11:36:35'),
('J454140', 176, '2020-11-24 11:38:41', '2020-11-24 11:38:41'),
('J454140', 178, '2020-11-24 11:44:06', '2020-11-24 11:44:06'),
('J454140', 179, '2020-11-24 12:55:49', '2020-11-24 12:55:49'),
('J454140', 180, '2020-11-24 12:58:59', '2020-11-24 12:58:59'),
('J454140', 189, '2020-12-30 14:17:19', '2020-12-30 14:17:19'),
('J454140', 190, '2020-12-30 14:31:40', '2020-12-30 14:31:40'),
('JB341298', 10, '2020-11-03 08:42:41', '2020-11-03 08:42:41'),
('JC425782', 20, '2020-09-24 12:25:59', '2020-09-24 12:25:59'),
('L395928', 24, '2020-09-25 11:00:44', '2020-09-25 11:00:44'),
('L395928', 25, '2020-09-25 11:02:08', '2020-09-25 11:02:08'),
('M172900', 7, '2020-09-24 10:11:57', '2020-09-24 10:11:57'),
('M219465', 13, '2020-09-24 10:24:26', '2020-09-24 10:24:26'),
('M233802', 13, '2020-09-24 10:24:26', '2020-09-24 10:24:26'),
('M233802', 170, '2020-11-02 08:49:20', '2020-11-02 08:49:20'),
('M241888', 24, '2020-09-25 11:00:44', '2020-09-25 11:00:44'),
('M241888', 25, '2020-09-25 11:02:08', '2020-09-25 11:02:08'),
('M242948', 24, '2020-09-25 11:00:44', '2020-09-25 11:00:44'),
('M242948', 25, '2020-09-25 11:02:08', '2020-09-25 11:02:08'),
('M270432', 2, '2020-09-16 06:03:45', '2020-09-16 06:03:45'),
('M38930', 10, '2020-11-03 08:42:41', '2020-11-03 08:42:41'),
('M411895', 23, '2020-09-24 12:38:34', '2020-09-24 12:38:34'),
('M476742', 21, '2020-09-24 12:34:28', '2020-09-24 12:34:28'),
('M478162', 19, '2020-09-25 07:46:48', '2020-09-25 07:46:48'),
('M508677', 23, '2020-09-24 12:38:34', '2020-09-24 12:38:34'),
('M519739', 9, '2020-11-03 09:05:14', '2020-11-03 09:05:14'),
('M531992', 2, '2020-09-16 06:03:45', '2020-09-16 06:03:45'),
('M594130', 2, '2020-09-16 06:03:46', '2020-09-16 06:03:46'),
('MA55579', 21, '2020-09-24 12:34:28', '2020-09-24 12:34:28'),
('MA62710', 13, '2020-09-24 10:24:26', '2020-09-24 10:24:26'),
('MA62710', 170, '2020-11-02 08:49:20', '2020-11-02 08:49:20'),
('MC214323', 20, '2020-09-24 12:25:59', '2020-09-24 12:25:59'),
('MC55314', 25, '2020-09-25 11:02:08', '2020-09-25 11:02:08'),
('N392940', 4, '2020-09-23 05:10:15', '2020-09-23 05:10:15'),
('N392940', 5, '2020-09-23 05:11:31', '2020-09-23 05:11:31'),
('N392940', 6, '2020-09-23 05:13:19', '2020-09-23 05:13:19'),
('PA88709', 8, '2020-09-24 10:13:47', '2020-09-24 10:13:47'),
('PB52617', 12, '2020-11-02 12:48:59', '2020-11-02 12:48:59'),
('Q198319', 2, '2020-09-16 06:03:46', '2020-09-16 06:03:46'),
('T143550', 182, '2020-12-24 10:54:16', '2020-12-24 10:54:16'),
('T143550', 183, '2020-12-24 10:58:54', '2020-12-24 10:58:54'),
('T143550', 184, '2020-12-24 11:02:15', '2020-12-24 11:02:15'),
('T143550', 185, '2020-12-24 11:03:43', '2020-12-24 11:03:43'),
('T143550', 186, '2020-12-24 11:05:39', '2020-12-24 11:05:39'),
('T143550', 187, '2020-12-24 11:09:11', '2020-12-24 11:09:11'),
('T143550', 188, '2020-12-24 11:12:05', '2020-12-24 11:12:05'),
('TA115446', 27, '2020-10-16 07:30:32', '2020-10-16 07:30:32'),
('TA115446', 28, '2020-10-16 07:32:37', '2020-10-16 07:32:37'),
('TA115446', 29, '2020-12-29 11:25:52', '2020-12-29 11:25:52'),
('TA115446', 30, '2020-12-29 12:53:08', '2020-12-29 12:53:08'),
('TA115446', 31, '2020-10-16 07:56:59', '2020-10-16 07:56:59'),
('TA115446', 174, '2020-11-24 11:34:48', '2020-11-24 11:34:48'),
('TA115446', 175, '2020-11-24 11:36:35', '2020-11-24 11:36:35'),
('TA115446', 176, '2020-11-24 11:38:41', '2020-11-24 11:38:41'),
('TA115446', 177, '2020-11-24 11:39:53', '2020-11-24 11:39:53'),
('TA115446', 178, '2020-11-24 11:44:06', '2020-11-24 11:44:06'),
('TA115446', 179, '2020-11-24 12:55:49', '2020-11-24 12:55:49'),
('TA115446', 180, '2020-11-24 12:58:59', '2020-11-24 12:58:59'),
('TA115446', 189, '2020-12-30 14:17:19', '2020-12-30 14:17:19'),
('TA115446', 190, '2020-12-30 14:31:40', '2020-12-30 14:31:40'),
('V83603', 21, '2020-09-24 12:34:28', '2020-09-24 12:34:28'),
('W153476', 17, '2020-09-24 11:07:30', '2020-09-24 11:07:30'),
('W156266', 24, '2020-09-25 11:00:44', '2020-09-25 11:00:44'),
('W181022', 17, '2020-09-24 11:07:30', '2020-09-24 11:07:30'),
('W384220', 4, '2020-09-23 05:10:15', '2020-09-23 05:10:15'),
('W384220', 6, '2020-09-23 05:13:19', '2020-09-23 05:13:19'),
('W393427', 4, '2020-09-23 05:10:16', '2020-09-23 05:10:16'),
('W393427', 5, '2020-09-23 05:11:31', '2020-09-23 05:11:31'),
('W393427', 6, '2020-09-23 05:13:19', '2020-09-23 05:13:19'),
('W58460', 13, '2020-09-24 10:24:26', '2020-09-24 10:24:26'),
('W58460', 170, '2020-11-02 08:49:20', '2020-11-02 08:49:20'),
('WA104895', 8, '2020-09-24 10:13:47', '2020-09-24 10:13:47'),
('WA107692', 16, '2020-10-28 14:33:37', '2020-10-28 14:33:37'),
('WA123846', 1, '2020-09-17 07:11:44', '2020-09-17 07:11:44'),
('WA126801', 7, '2020-09-24 10:11:57', '2020-09-24 10:11:57'),
('WA191603', 2, '2020-09-16 06:03:46', '2020-09-16 06:03:46'),
('WA221413', 10, '2020-11-03 08:42:41', '2020-11-03 08:42:41'),
('WA239861', 12, '2020-11-02 12:48:59', '2020-11-02 12:48:59'),
('WA255072', 8, '2020-09-24 10:13:47', '2020-09-24 10:13:47'),
('WA77257', 12, '2020-11-02 12:48:59', '2020-11-02 12:48:59'),
('WA90276', 19, '2020-09-25 07:46:48', '2020-09-25 07:46:48'),
('WB77842', 8, '2020-09-24 10:13:47', '2020-09-24 10:13:47'),
('Y203956', 18, '2020-09-24 11:09:05', '2020-09-24 11:09:05');

-- --------------------------------------------------------

--
-- Structure de la table `giacs`
--

CREATE TABLE `giacs` (
  `code_giac` int(10) UNSIGNED NOT NULL,
  `libelle` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `specif` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `adlocal_1` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `adlocal_2` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tele` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fax` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `website` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nom_dg` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tel_dg` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_dg` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nom_resp` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tel_resp` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_resp` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `commentaire` varchar(5000) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `giacs`
--

INSERT INTO `giacs` (`code_giac`, `libelle`, `specif`, `adlocal_1`, `adlocal_2`, `tele`, `fax`, `email`, `website`, `nom_dg`, `tel_dg`, `email_dg`, `nom_resp`, `tel_resp`, `email_resp`, `commentaire`, `created_at`, `updated_at`) VALUES
(1, 'GIAC AGROALIMENTAIRE', 'AGROALIMENTAIRE', '710, 2ème étage, avenue AL QODS - AÏN CHOQ', 'Casablanca', '0522219186', '0522508972', 'giac.agro@gmail.com', 'http://www.giacagro.com', 'Mustapha MABKHOUT', '0522219186', 'giac.agro@gmail.com', 'Faouzi CHOUKRI', '0666895273', 'giac.agro@gmail.com', NULL, '2020-08-04 04:50:29', '2020-08-19 03:47:04'),
(2, 'GIAC TRANSLOG', 'Transport Logistique', 'Angle rue Bapaume et Provins, Immeuble Azrakia , 3ème étage', 'Roches Noires, Casablanca, 20303  Maroc', '0', '+212522319808', 'contact@giac.ma', 'http://www.giac.ma/', '0', '0', 'a-remplir@none.n', 'KAWTAR', '0522319808', 'a-remplir@none.n', NULL, '2020-09-18 09:22:55', '2020-09-18 09:29:57'),
(3, 'Giac tertiaire', 'Services, commerce et distribution', 'Adresse : 31, rue Mostapha El Manfalouti , 1er étage. Quartier Gauthier', 'Casablanca', '0675378157', '0520503000', 'Assistancegiactertiaire@gmail.com', 'https://www.giac-tertiaire.ma/', 'M. Mohamed Benkirane', 'président du Giac-Tertiaire', 'giac.tertiaire@gmail.com', 'Farah Bahtit', '0675378157', 'giac.tertiaire@gmail.com', '- Ne demande pas facture PRO-FORMAT;\r\n- 3 exemplaires du propal ;', '2020-09-18 10:39:46', '2020-11-17 09:39:01'),
(4, 'Giac Technologies', 'Giac Technologies', '2 Rue ABOU SAID ASSOUSSI, Résidence EL FARISS, 1er Étage, Appartement N° 9,', 'Bourgogne, Casablanca.', '0522 27 24 93', '0522 27 57 65', 'giactechnologies@gmail.com', 'http://www.giactechnologies.com', 'Mr Abdelhafid MEHIAOUI', '0', 'a-remplir@test.ma', 'Mlle Saâdia HILAL', '0', 'a-remplir@test.ma', NULL, '2020-10-05 08:20:25', '2020-10-05 08:20:25'),
(5, 'GIAC BTP', 'Giac  BTP', '432, rue Mustapha El Mâani  4ème Etage', 'Casablanca 20140 - Maroc', '0522472147', '0522 27 96 56', 'infos@giac-btp.com', 'http://www.giac-btp.ma/', 'Mme Souad DIBYANI', '0660 03 76 14', 's.dibyani@giac-btp.com', 'Mme Jihane ZAGHBA', '0660 36 26 14', 'infos@giac-btp.com', 'le GIAC n\'accuse pas le dépôt de l\'avis de réalisation', '2020-10-20 08:34:53', '2020-11-17 10:59:59'),
(6, 'Giac textile et cuir', 'Giac textile', '92, avenue Moulay Rachid , Q. Racine', 'CASABLANCA', '05 22 94 2084', '05 22 94 0587', 'rchadili@amith.org.ma', 'https://textile.ma', 'Mr Rachid Chadili', '05 22 94 20 84', 'rchadili@amith.org.ma', 'Mr Rachid Chadili', '05 22 94 20 84', 'rchadili@amith.org.ma', NULL, '2020-10-21 11:16:23', '2020-11-23 07:12:57'),
(7, 'GIAC 1', 'INDUSTRIE', 'KPC Business Center, Immeuble A, N°9 Bd Zerktouni-Mohammedia -Grand Casablanca', 'KPC Business Center, Immeuble A, N°9 Bd Zerktouni-Mohammedia -Grand Casablanca', '0523316121', '0523316059', 'info@giac1.ma', 'https://giac1.ma', 'M. MOUNIR Abdellhak', '0523316121', 'info@giac1.ma', 'Mme HANI Nadia', '0523316121', 'info@giac1.ma', NULL, '2021-01-13 15:19:31', '2021-01-13 15:19:31');

-- --------------------------------------------------------

--
-- Structure de la table `intervenants`
--

CREATE TABLE `intervenants` (
  `id_interv` bigint(20) UNSIGNED NOT NULL,
  `nom` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prenom` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `specif` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dom_interv` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `module` varchar(900) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tele` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `langs` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `etat` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'disponible',
  `cv` blob DEFAULT NULL,
  `nrc_c` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `commentaire` varchar(5000) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `intervenants`
--

INSERT INTO `intervenants` (`id_interv`, `nom`, `prenom`, `specif`, `dom_interv`, `module`, `tele`, `email`, `langs`, `etat`, `cv`, `nrc_c`, `commentaire`, `created_at`, `updated_at`) VALUES
(1, 'Belmokadem', 'Adil', 'Stratégie et Management', 'Stratégie et Management', 'Optimiser Les Achats', '+21261223138', 'a.belmokadem@mediexperts.ma', 'Anglais, Français, Arabe', 'occupé', 0x696d672f696e746572762d66696c65732f313539363533373531302d43562e6a7067, '171287', NULL, '2020-08-04 05:38:30', '2021-01-22 09:29:12'),
(2, 'ZADI', 'ABDELHAK', 'Management', 'Management', 'Management des Personnes et des Equipes', '0600000000', 'abdelhak@gmail.com', 'francais; arabe', 'occupé', 0x696d672f696e746572762d66696c65732f313539393134303333322d43562e646f6378, '171287', NULL, '2020-09-03 07:38:52', '2021-01-22 08:30:05'),
(3, 'Hmimou', 'Salah', 'Démarche Lean Six sigma', 'Lean Manufacturing', 'Management des personnes et des Equipes', '+212600000000', 'aremplir@aremplir.com', 'Arabe, Français et Anglais', 'occupé', 0x696d672f696e746572762d66696c65732f313630303235333537372d43562e646f6378, '171287', NULL, '2020-09-16 05:52:57', '2020-12-28 15:43:14'),
(4, 'TEST', 'TEST', 'TEST', 'TEST', 'ISO 22000 — Management de la sécurité des denrées', '+212610148484', 'TEST@TEST.COM', 'TEST TEST', 'occupé', 0x696d672f696e746572762d66696c65732f313630303334313132332d43562e6a7067, '171287', NULL, '2020-09-17 06:12:03', '2020-12-28 15:41:26'),
(5, 'TEST 2', 'TEST 2', 'TEST 2', 'TEST 2', 'TEST#', '+212650050055', 'TEST2@TEST2.COM', 'TEST 2 TEST 2', 'occupé', 0x696d672f696e746572762d66696c65732f313630303334313233362d43562e6a7067, '171287', NULL, '2020-09-17 06:13:56', '2020-12-01 14:54:23'),
(6, 'QRIBIS', 'ILYA MAKIRI', 'CONSULTANT SENIOR', 'Conseil en gestion des Organisations, stratégie, a', 'Finance pour non financiers', '+212661090218', 'i.qribis@mediexperts.ma', 'Arabe Français Anglais', 'occupé', 0x696d672f696e746572762d66696c65732f313630303334383031372d43562e706466, '171287', NULL, '2020-09-17 08:06:57', '2021-01-22 09:08:01'),
(7, 'TAHRI', 'AMINA', 'Consultant formateur', 'Conseil   en   gestion   des   Organisations, stratégie,   administration   des   Ventes   et Logist', 'SMQ et organisation d\'entreprise', '0', 'a-remplir@email.com', 'Arabe, Français, Anglais Espagnol', 'occupé', 0x696d672f696e746572762d66696c65732f313630303334393636302d43562e646f6378, '171287', 'Email et numéro télé manquants', '2020-09-17 08:34:20', '2021-01-22 08:56:29'),
(8, 'RAID', 'SOUFIANE', 'Consultant Directeur général', 'CV', 'Les exigences du SMQ', '+212661680832', 's.raid@mediexperts.ma', 'Arabe Français', 'occupé', 0x696d672f696e746572762d66696c65732f313630303335363538372d43562e646f6378, '171287', NULL, '2020-09-17 10:29:47', '2020-12-31 11:36:00'),
(9, 'LAHLOU', 'Farah', 'Ingénieur GÉNIE INDUSTRIEL', 'Management des personnes et des équipes', 'Management des Personnes et des Equipes', '06.66.81.45.6', 'lahloufarah@yahoo.fr', 'Arabe Français', 'occupé', 0x696d672f696e746572762d66696c65732f313630303432323136332d43562e646f63, '171287', NULL, '2020-09-18 04:42:43', '2021-01-21 15:43:26'),
(10, 'KOUASSIBLE KAN RONSARD', 'NATHANAEL', 'Consultant juriste et fiscaliste', 'Réglementation de travail', '', '00', 'remplir@test.ma', 'Français anglais espagnol', 'disponible', 0x696d672f696e746572762d66696c65732f313630303432323431352d43562e444f4358, '171287', NULL, '2020-09-18 04:46:55', '2020-09-18 09:08:46'),
(11, 'Mrida', 'Nordine', 'Formateur Animateur en Transport Routier et moyens de manutention', 'Formateur Animateur en Transport Routier et moyens de manutention', 'SMQ Norme 9001 V 2015', '000', 'a-remplir@test.ma', 'Arabe Français anglais', 'occupé', 0x696d672f696e746572762d66696c65732f313630303433303137382d43562e70707478, '171287', NULL, '2020-09-18 06:56:18', '2020-12-28 16:12:08'),
(12, 'MENJRA', 'Mouhcine', 'Consultant Formateur en Certification ISO, Audit et formation, Outils qualité, lean manufacturing, l', 'Gestion de la production', '', '0000', 'a-remplir@teest.ma', 'Arabe Français anglais', 'disponible', 0x696d672f696e746572762d66696c65732f313630303433303334392d43562e646f6378, '171287', NULL, '2020-09-18 06:59:09', '2020-09-18 09:13:10'),
(13, 'ESSALAM', 'Aarfan', 'Transport de marchandise dangereuse', 'Transport de marchandise dangereuse', '', '001', 'essalam.aarfan@gmail.com', 'arabe Français anglais', 'disponible', 0x696d672f696e746572762d66696c65732f313630303434313233372d43562e646f6378, '171287', NULL, '2020-09-18 09:51:51', '2020-09-18 10:00:37'),
(14, 'HAMDOUN', 'AZIZ', 'consulting et formation en sauvetage et secourisme au travail, Prévention et secours civiques, équip', 'L\'OHSAS 18001', '', '002', 'a-remplirr@test.ma', 'Arabe Français Anglais', 'disponible', 0x696d672f696e746572762d66696c65732f313630303434313435382d43562e646f6378, '171287', NULL, '2020-09-18 10:04:18', '2020-09-18 10:04:18'),
(15, 'Saloua', 'Abir', 'Professeur de l’enseignement secondaire langue Anglaise', 'Anglais', 'Anglais professionnel et commercial', '0602645114', 'SalouaAbir.English@outlook.com', 'Français  Anglais  Espagnol', 'occupé', 0x696d672f696e746572762d66696c65732f313630313937333233382d43562e646f6378, '171287', NULL, '2020-10-06 04:33:58', '2020-12-29 10:56:31'),
(16, 'Jérôme', 'BRUN', 'Consultant\r\nFrançais F.L.E. et Communication', 'Français', 'Communication professionnelle', '06.19.45.10.3', 'jeromebrunpro@gmail.com', 'Français', 'occupé', 0x696d672f696e746572762d66696c65732f313630313937333638352d43562e646f6378, '171287', NULL, '2020-10-06 04:41:25', '2021-01-22 08:49:39'),
(17, 'Abdelmounaim', 'AGGOUR', 'Consultant et Formateur', 'Supply Chain Management', 'Approche générale de la logistique', '+212 661 6869', 'aggour@gmail.com', 'Arabe / Français / Anglais', 'occupé', 0x696d672f696e746572762d66696c65732f313630323737373938372d43562e646f6378, '171287', NULL, '2020-10-15 13:06:27', '2020-12-29 11:14:00'),
(18, 'BELAMINE', 'Youssef', 'INGENIEUR CONSEIL EN FORMATION CONTINUE', 'STRATEGIE ET ORGANISATION DES ENTREPRISES', 'GESTION DE LA RELATION CLIENT', '0661335585', 'belamine8@gmail.com', 'Arabe / Français / Anglais', 'occupé', 0x696d672f696e746572762d66696c65732f313630353038363831392d43562e646f63, '171287', NULL, '2020-11-11 06:26:59', '2020-12-24 11:08:20'),
(19, 'AL KHATIB', 'AMINE', 'Management, commerce', 'Management, commerce', 'Négociation de vente', '0662337271', 'aalkhatib@valueexpertgroup.com', 'Arabe / Français / Anglais', 'occupé', 0x696d672f696e746572762d66696c65732f313630373934303339342d43562e646f6378, '171287', 'A ajouter CV', '2020-12-14 09:05:07', '2020-12-14 09:07:21');

-- --------------------------------------------------------

--
-- Structure de la table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_01_07_153625_create_clients_table', 1),
(4, '2019_01_22_083700_create_cabinets_table', 1),
(5, '2019_01_25_134341_create_giacs_table', 1),
(6, '2019_01_27_134926_create_actionnaires_table', 1),
(7, '2019_02_01_084534_create_intervenants_table', 1),
(8, '2019_02_05_091905_create_demande_financements_table', 1),
(9, '2019_02_11_160334_create_demande_remboursement_giacs', 1),
(10, '2019_02_19_104422_create_demande_remboursement_ofppts_table', 1),
(11, '2019_02_20_100147_create_domaines_table', 1),
(12, '2019_02_20_100159_create_themes_table', 1),
(13, '2019_02_27_151542_create_plans_table', 1),
(14, '2019_02_28_153839_create_plan_formations_table', 1),
(15, '2019_03_13_094432_create_mission_intervenants_table', 1),
(16, '2020_01_22_101904_create_formations_table', 1),
(17, '2020_02_10_150629_create_personnels_table', 1),
(18, '2020_05_03_224233_create_formation_personnels_table', 1),
(19, '2020_10_27_115927_after_update_clients', 1);

-- --------------------------------------------------------

--
-- Structure de la table `mission_intervenants`
--

CREATE TABLE `mission_intervenants` (
  `id_interv` bigint(20) UNSIGNED NOT NULL,
  `n_df` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `password_resets`
--

INSERT INTO `password_resets` (`email`, `token`, `created_at`) VALUES
('o.nacer@mediexperts.com', '$2y$10$jleKwzojKFCNMniYRKc3zO.8amEiZgSAwIl85dDQBBMYJgPaWVsUe', '2020-12-03 15:14:40'),
('o.nacer@mediexperts.ma', '$2y$10$hgU59PQF8cwaDEA1MXIS4uB51jgR4Xw121IDcUVb/pvhXwkwkMMLy', '2020-12-17 10:36:49');

-- --------------------------------------------------------

--
-- Structure de la table `personnels`
--

CREATE TABLE `personnels` (
  `cin` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `matricule` int(11) NOT NULL,
  `nom` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prenom` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cnss` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dt_naiss` date DEFAULT NULL,
  `dt_embch` date DEFAULT NULL,
  `dt_demiss` date DEFAULT NULL,
  `fonction` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `csp` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `etat` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nrc_e` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `personnels`
--

INSERT INTO `personnels` (`cin`, `matricule`, `nom`, `prenom`, `cnss`, `dt_naiss`, `dt_embch`, `dt_demiss`, `fonction`, `csp`, `etat`, `nrc_e`, `created_at`, `updated_at`) VALUES
('AB127499', 102351, 'HAMIDI', 'YAHYA', '142417346', '1970-01-01', '2019-10-01', '1970-01-01', 'AGENT ADM POLYVALENT', 'E', NULL, '143199', '2020-09-24 12:21:17', '2020-09-24 12:21:17'),
('AB507528', 400029, 'ELLIF', 'ABDERRAHIM', '132826169', '1970-01-01', '2013-09-25', '1970-01-01', 'AIDE MEUNIER', 'E', NULL, '286479', '2020-09-24 10:42:07', '2020-09-24 10:42:07'),
('AB541180', 101952, 'BOUSSARHANE', 'ANAS', '120672917', '1970-01-01', '2019-07-02', '1970-01-01', 'CHEF D\'AGENCE', 'C', NULL, '143199', '2020-09-24 12:21:17', '2020-09-24 12:21:17'),
('B000001', 9000001, 'LASSFAR0', 'Aymane0', '100000001', '1970-01-01', '2013-04-01', '1970-01-01', 'Chef de projet', 'C', NULL, '11111', '2020-11-09 12:26:43', '2020-11-09 12:26:43'),
('B000002', 9000002, 'AHMAD0', 'Ali0', '100000002', '1970-01-01', '2013-04-01', '1970-01-01', 'CHEF D\'EQUIPE', 'C', NULL, '11111', '2020-11-09 12:26:43', '2020-11-09 12:26:43'),
('B000003', 9000003, 'CHAKIRI0', 'Mehdi0', '100000003', '1970-01-01', '2013-05-20', '1970-01-01', 'CHEF D\'EQUIPE', 'C', NULL, '11111', '2020-11-09 12:26:43', '2020-11-09 12:26:43'),
('B000004', 9000004, 'LASSFAR1', 'Aymane1', '100000004', '1970-01-01', '2013-08-23', '1970-01-01', 'CHEF D\'EQUIPE', 'C', NULL, '11111', '2020-11-09 12:26:43', '2020-11-09 12:26:43'),
('B000005', 9000005, 'AHMAD1', 'Ali1', '100000005', '1970-01-01', '2016-05-02', '1970-01-01', 'CHEF D\'EQUIPE', 'C', NULL, '11111', '2020-11-09 12:26:43', '2020-11-09 12:26:43'),
('B000006', 9000006, 'CHAKIRI1', 'Mehdi1', '100000006', '1970-01-01', '2015-08-01', '1970-01-01', 'CHEF D\'EQUIPE', 'C', NULL, '11111', '2020-11-09 12:26:43', '2020-11-09 12:26:43'),
('B000007', 9000007, 'LASSFAR2', 'Aymane2', '100000007', '1970-01-01', '2013-04-08', '1970-01-01', 'TECHNICIEN MAINTENANCE', 'E', NULL, '11111', '2020-11-09 12:26:43', '2020-11-09 12:26:43'),
('B000008', 9000008, 'AHMAD2', 'Ali2', '100000008', '1970-01-01', '2013-05-06', '1970-01-01', 'AIDE CHEF D\'EQUIPE', 'E', NULL, '11111', '2020-11-09 12:26:43', '2020-11-09 12:26:43'),
('B000009', 9000009, 'CHAKIRI2', 'Mehdi2', '100000009', '1970-01-01', '2015-02-10', '1970-01-01', 'CARISTE', 'E', NULL, '11111', '2020-11-09 12:26:43', '2020-11-09 12:26:43'),
('B000010', 9000010, 'LASSFAR3', 'Aymane3', '100000010', '1970-01-01', '2017-06-12', '1970-01-01', 'AIDE CHEF D\'EQUIPE', 'E', NULL, '11111', '2020-11-09 12:26:43', '2020-11-09 12:26:43'),
('B000011', 9000011, 'AHMAD3', 'Ali3', '100000011', '1970-01-01', '2017-01-06', '1970-01-01', 'Développeur web', 'E', NULL, '11111', '2020-11-09 12:26:43', '2020-11-09 12:26:43'),
('B000012', 9000012, 'CHAKIRI3', 'Mehdi3', '100000012', '1970-01-01', '2017-05-15', '1970-01-01', 'AGENT DE CONDITIONNEMENT', 'E', NULL, '11111', '2020-11-09 12:26:43', '2020-11-09 12:26:43'),
('B000013', 9000013, 'LASSFAR3', 'Aymane3', '100000013', '1970-01-01', '2013-05-02', '1970-01-01', 'RESPONSABLE QUALITE', 'O', NULL, '11111', '2020-11-09 12:26:43', '2020-11-09 12:26:43'),
('B000014', 9000014, 'AHMAD3', 'Ali3', '100000014', '1970-01-01', '2014-01-07', '1970-01-01', 'RESPONSABLE DE CONDITIONNEMENT', 'O', NULL, '11111', '2020-11-09 12:26:43', '2020-11-09 12:26:43'),
('B000015', 9000015, 'CHAKIRI3', 'Mehdi3', '100000015', '1970-01-01', '2014-07-08', '1970-01-01', 'Développeur web', 'O', NULL, '11111', '2020-11-09 12:26:43', '2020-11-09 12:26:43'),
('B000016', 9000016, 'LASSFAR4', 'Aymane4', '100000016', '1970-01-01', '2015-02-09', '1970-01-01', 'RESPONSABLE SITE', 'O', NULL, '11111', '2020-11-09 12:26:43', '2020-11-09 12:26:43'),
('B000017', 9000017, 'AHMAD4', 'Ali4', '100000017', '1970-01-01', '2012-10-01', '1970-01-01', 'DIRECTEUR DE SITE', 'O', NULL, '11111', '2020-11-09 12:26:43', '2020-11-09 12:26:43'),
('B000018', 9000018, 'CHAKIRI4', 'Mehdi4', '100000018', '1970-01-01', '2014-09-01', '1970-01-01', 'Développeur web', 'C', NULL, '11111', '2020-11-09 12:26:43', '2020-11-09 12:26:43'),
('B000019', 9000019, 'LASSFAR4', 'Aymane4', '100000019', '1970-01-01', '2018-07-16', '1970-01-01', 'RESPONSABLE DE LA QUALITE', 'C', NULL, '11111', '2020-11-09 12:26:43', '2020-11-09 12:26:43'),
('BB112192', 200153, 'EL GUEDAMI', 'RACHID', '118591596', '1970-01-01', '2013-06-01', '1970-01-01', 'CHEF D\'EQUIPE', 'C', NULL, '5587', '2020-09-24 10:17:59', '2020-09-24 10:17:59'),
('BB119407', 500072, 'LABRINI', 'HAMZA', '194514794', '1970-01-01', '2016-05-02', '1970-01-01', 'CHEF D\'EQUIPE', 'C', NULL, '7077', '2020-08-05 06:35:11', '2020-08-05 06:35:11'),
('BB128479', 300264, 'KORCHI', 'YOUSSEF', '127729117', '1970-01-01', '2019-03-01', '1970-01-01', 'ADJOINT MEUNIER', 'C', NULL, '193231', '2020-09-24 10:01:41', '2020-09-24 10:01:41'),
('BB145767', 400158, 'EL ABBASSI', 'OUSSAMA', '132360908', '1970-01-01', '2019-03-01', '1970-01-01', 'TECHNICIEN MENIER', 'E', NULL, '286479', '2020-09-24 10:42:07', '2020-09-24 10:42:07'),
('BB151229', 400140, 'BOUL-ATARASS', 'ZAKARIA', '178095808', '1970-01-01', '2017-12-11', '1970-01-01', 'TECHNICIEN MENIER', 'E', NULL, '286479', '2020-09-24 10:42:07', '2020-09-24 10:42:07'),
('BB51059', 300281, 'EL GHATTASS', 'ABDELHAKIM', '190654578', '1970-01-01', '2015-01-15', '1970-01-01', 'DIRECTEUR DE SITE', 'C', NULL, '193231', '2020-09-24 10:01:41', '2020-09-24 10:01:41'),
('BB74278', 400087, 'MOUTAKHIM', 'YASSINE', '103509596', '1970-01-01', '2016-05-17', '1970-01-01', 'ADJOINT RESPONSABLE PRODUCTION', 'C', NULL, '286479', '2020-09-24 10:42:07', '2020-09-24 10:42:07'),
('BB83566', 500002, 'BAHA', ' TARIK', '120812899', '1970-01-01', '2013-04-01', '1970-01-01', 'CHEF D\'EQUIPE', 'C', NULL, '7077', '2020-08-05 06:35:11', '2020-08-05 06:35:11'),
('BE641494', 300076, 'YARZIZ', 'TAOUFIK', '133120643', '1970-01-01', '2012-08-16', '1970-01-01', 'DIRECTEUR DE SITE', 'C', NULL, '193231', '2020-09-24 10:01:41', '2020-09-24 10:01:41'),
('BE681847', 300232, 'ARICHE', 'KHALID', '171251106', '1970-01-01', '2018-08-01', '1970-01-01', 'MAGASINIER', 'E', NULL, '193231', '2020-09-24 10:01:41', '2020-09-24 10:01:41'),
('BE760192', 24, 'OUJANA ', 'BELAID', '134380569', '1970-01-01', '1970-01-01', '1970-01-01', 'DIRECTEUR EXPLOITATION', 'C', NULL, '296871', '2020-12-23 10:26:39', '2020-12-23 10:26:39'),
('BE762319', 500065, 'ANEGUER', 'KHALID', '137747253', '1970-01-01', '2014-09-01', '1970-01-01', 'RESPONSABLE DE CONDITIONNEMENT', 'C', NULL, '7077', '2020-08-05 06:35:11', '2020-08-05 06:35:11'),
('BE789899', 26, 'CHARBA', 'MOUNIR', '150884876', '1970-01-01', '1970-01-01', '1970-01-01', 'LIVREUR', 'E', NULL, '296871', '2020-12-23 10:26:39', '2020-12-23 10:26:39'),
('BE801763', 27, 'ANANI', 'ASMAA', '135149584', '1970-01-01', '1970-01-01', '1970-01-01', 'RESPONSABLE LOGISTIQUE', 'C', NULL, '296871', '2020-12-23 10:26:39', '2020-12-23 10:26:39'),
('BE814835', 500055, 'BENHAMADI', 'YASSINE', '100362377', '1970-01-01', '2012-10-01', '1970-01-01', 'DIRECTEUR DE SITE', 'C', NULL, '7077', '2020-08-05 06:35:11', '2020-08-05 06:35:11'),
('BE821203', 101549, 'BOUTAARIT', 'NOUAMANE', '108442104', '1970-01-01', '2017-04-05', '1970-01-01', 'SALES ANALYST', 'C', NULL, '143199', '2020-09-24 12:21:17', '2020-09-24 12:21:17'),
('BE833143', 1013, 'IKHLEF', 'ZAKARIA', '137297290', '1970-01-01', '2014-01-01', '1970-01-01', 'consultant fonctionnel', 'C', NULL, '254391', '2020-10-16 06:44:09', '2020-10-16 06:44:09'),
('BH323130', 600006, ' HACHMANE', 'MOHAMED', '111598367', '1970-01-01', '2006-06-01', '1970-01-01', 'RESPONSABLE EXPLOITATION', 'C', NULL, '117713', '2020-09-24 10:01:00', '2020-09-24 10:01:00'),
('BH439122', 500043, 'HAFID', 'YOUSSEF', '100985989', '1970-01-01', '2014-07-08', '1970-01-01', 'responsable fabrication', 'C', NULL, '7077', '2020-08-05 06:35:11', '2020-08-05 06:35:11'),
('BH451672', 600296, 'MOKHLISSE', 'YOUSSEF', '173131890', '1970-01-01', '2017-03-03', '1970-01-01', 'CHAUFFEUR', 'E', NULL, '117713', '2020-09-24 10:01:00', '2020-09-24 10:01:00'),
('BH571137', 500179, 'BOUGRAYN', 'KHADIJA', '132519905', '1970-01-01', '2017-05-15', '1970-01-01', 'AGENT DE CONDITIONNEMENT', 'E', NULL, '7077', '2020-08-05 06:35:11', '2020-08-05 06:35:11'),
('BH605368', 110024, 'HOUDANE', 'AYOUB', '157524392', '1970-01-01', '2016-05-02', '1970-01-01', 'RESPONSABLE EXPORT', 'C', NULL, '328729', '2020-09-25 10:32:17', '2020-09-25 10:32:17'),
('BJ203687', 6, 'JABER', 'AMAL', '108859863', '1970-01-01', '1970-01-01', '1970-01-01', 'ASSISTANTE ADV ', 'E', NULL, '296871', '2020-12-23 10:26:39', '2020-12-23 10:26:39'),
('BJ247304', 500012, 'SABRI', ' KHADIJA', '111637868', '1970-01-01', '2013-05-02', '1970-01-01', 'RESPONSABLE QUALITE', 'C', NULL, '7077', '2020-08-05 06:35:11', '2020-08-05 06:35:11'),
('BJ293996', 110009, 'BAZE', 'MOUNIR', '141533276', '1970-01-01', '2015-01-02', '1970-01-01', 'Directeur R.H ADJ Groupe', 'C', NULL, '328729', '2020-09-25 10:32:17', '2020-09-25 10:32:17'),
('BJ330251', 200004, 'EL FAKIR', 'AZIZ', '112728070', '1970-01-01', '2009-11-01', '1970-01-01', 'CHEF DE VENTE', 'E', NULL, '5587', '2020-09-24 10:17:59', '2020-09-24 10:17:59'),
('BJ342701', 400023, 'EL FAIDA', 'ABDELAZIZ', '172865078', '1970-01-01', '2013-09-16', '1970-01-01', 'RESPONSABLE PRODUCTION', 'C', NULL, '286479', '2020-09-24 10:42:07', '2020-09-24 10:42:07'),
('BJ385454', 500001, 'KARKOURI', ' MOHAMED', '199197280', '1970-01-01', '2013-04-01', '1970-01-01', 'CHEF D\'EQUIPE', 'C', NULL, '7077', '2020-08-05 06:35:11', '2020-08-05 06:35:11'),
('BJ405709', 600187, 'MANSRI', 'ABDELAZIZ', '111242980', '1970-01-01', '2014-02-01', '1970-01-01', 'AGENT EXPLOITATION TRANSPORT', 'E', NULL, '117713', '2020-09-24 10:01:00', '2020-09-24 10:01:00'),
('BJ405794', 400067, 'EL HARRASSE', 'KHADIJA', '166612790', '1970-01-01', '2014-11-01', '1970-01-01', 'Responsable laboratoir et hygi', 'C', NULL, '286479', '2020-09-24 10:42:07', '2020-09-24 10:42:07'),
('BJ55520', 28, 'BELALOUA', 'AOMAR', '185120218', '1970-01-01', '1970-01-01', '1970-01-01', 'COURSIER', 'E', NULL, '296871', '2020-12-23 10:26:39', '2020-12-23 10:26:39'),
('BJ85820', 400012, 'OUWAB EL IDRISS', 'MY HASSAN', '168896631', '1978-06-06', '2013-09-16', NULL, 'RESPONSABLE MAINTENANCE', 'E', 'Disponible', '286479', '2020-09-25 07:45:32', '2020-09-25 07:45:32'),
('BJ96498', 100727, 'CHERTI', 'JALIL', '196372132', '1970-01-01', '2006-11-01', '1970-01-01', 'CHEF D\'AGENCE', 'C', NULL, '143199', '2020-09-24 12:21:17', '2020-09-24 12:21:17'),
('BK188248', 400133, 'KASIMI', 'MOHAMED', '153228998', '1970-01-01', '2018-10-01', '1970-01-01', 'AGENT DE CONDITIONNEMENT', 'E', NULL, '286479', '2020-09-24 10:42:07', '2020-09-24 10:42:07'),
('BK230730', 400135, 'FETTOUH', 'MOHAMED', '113655751', '1970-01-01', '2018-10-01', '1970-01-01', 'AGENT DE CONDITIONNEMENT', 'E', NULL, '286479', '2020-09-24 10:42:07', '2020-09-24 10:42:07'),
('BK253044', 400131, 'EL GHICHA', 'KHALID', '112197275', '1970-01-01', '2018-10-01', '1970-01-01', 'AGENT DE CONDITIONNEMENT', 'E', NULL, '286479', '2020-09-24 10:42:07', '2020-09-24 10:42:07'),
('BK271581', 101880, 'ELJAMALI', 'CAMELIA', '146634107', '1970-01-01', '2018-06-04', '1970-01-01', 'CHEF DE PRODUIT', 'C', NULL, '143199', '2020-09-24 12:21:17', '2020-09-24 12:21:17'),
('BK280839', 300283, 'AIT BAASSI', 'AYOUB', '195953392', '1970-01-01', '2015-11-02', '1970-01-01', 'Adjoint-Chef Meunier', 'C', NULL, '193231', '2020-09-24 10:01:41', '2020-09-24 10:01:41'),
('BK299677', 400161, 'LEGHDAICH', 'ASMAA', '177625915', '1970-01-01', '2020-04-01', '1970-01-01', 'RESPONSABLE LABORATOIRE', 'C', NULL, '286479', '2020-09-24 10:42:07', '2020-09-24 10:42:07'),
('BK388303', 100688, 'BELAKKAF', ' HAJAR', '154203296', '1970-01-01', '2015-02-17', '1970-01-01', 'ASSISTANTE DE DIRECTION', 'E', NULL, '143199', '2020-09-24 12:21:17', '2020-09-24 12:21:17'),
('BK47633', 600221, 'BENFAIDA', 'MOHAMED', '121385952', '1970-01-01', '2012-10-01', '1970-01-01', 'RESPONSABLE PARC AUTO', 'E', NULL, '117713', '2020-09-24 10:01:00', '2020-09-24 10:01:00'),
('BK513184', 500032, 'BABAALI', ' MOUHCINE', '181774773', '1970-01-01', '2013-08-23', '1970-01-01', 'CHEF D\'EQUIPE', 'C', NULL, '7077', '2020-08-05 06:35:11', '2020-08-05 06:35:11'),
('BK529491', 102167, 'ZAIM', 'ZINEB', '133064317', '1970-01-01', '2019-10-01', '1970-01-01', 'CHARGE(E) QUALITE', 'C', NULL, '143199', '2020-09-24 12:21:17', '2020-09-24 12:21:17'),
('BK612023', 300268, 'RIKAOUI', 'MOUAD', '178774000', '1970-01-01', '2018-10-01', '1970-01-01', 'MAGASINIER', 'E', NULL, '193231', '2020-09-24 10:01:41', '2020-09-24 10:01:41'),
('BK629034', 400155, 'BOUTARBOUCHE', 'OTHMANE', '131911110', '1970-01-01', '2020-02-01', '1970-01-01', 'TECHNICIEN MENIER', 'E', NULL, '286479', '2020-09-24 10:42:07', '2020-09-24 10:42:07'),
('BK8069', 400013, 'BASSIDI', 'AHMED', '133393042', '1970-01-01', '2013-09-16', '1970-01-01', 'MAGASINIER', 'E', NULL, '286479', '2020-09-24 10:42:07', '2020-09-24 10:42:07'),
('BL115837', 100903, 'FATHAN', 'HAMZA', '159441693', '1970-01-01', '2015-08-01', '1970-01-01', 'CHEF D\'AGENCE', 'C', NULL, '143199', '2020-09-24 12:21:17', '2020-09-24 12:21:17'),
('BL52416', 200176, 'EL MAHREZY', 'YOUSSEF', '117713100', '1970-01-01', '2017-05-01', '1970-01-01', 'CHEF D\'EQUIPE', 'C', NULL, '5587', '2020-09-24 10:17:59', '2020-09-24 10:17:59'),
('BL77684', 100102, 'ABIR', 'AMINE', '187458777', '1970-01-01', '2010-03-04', '1970-01-01', 'CHEF DES VENTES', 'C', NULL, '143199', '2020-09-24 12:21:17', '2020-09-24 12:21:17'),
('BW10215', 400141, 'TACHFINE', 'ZAKARIA', '189549501', '1970-01-01', '2019-01-14', '1970-01-01', 'AGENT DE CONDITIONNEMENT', 'E', NULL, '286479', '2020-09-24 10:42:07', '2020-09-24 10:42:07'),
('C496236', 10001, 'RAISS EL FENNI', 'ADIL', '181048251', '1970-01-01', '1970-01-01', '1970-01-01', 'Gérant', 'C', NULL, '376161', '2020-09-23 05:08:04', '2020-09-23 05:08:04'),
('C622911', 500053, 'BENJELLOUN', 'OUSSAMA', '197263132', '1970-01-01', '2015-02-09', '1970-01-01', 'RESPONSABLE SITE', 'C', NULL, '7077', '2020-08-05 06:35:11', '2020-08-05 06:35:11'),
('CB97868', 100295, 'KHIAR', 'MORAD', '198955069', '1970-01-01', '2012-09-19', '1970-01-01', 'CHEF D\'AGENCE', 'C', NULL, '143199', '2020-09-24 12:21:17', '2020-09-24 12:21:17'),
('CD222702', 11, 'EL ABDIOUI ', 'ANAS', '133051799', '1970-01-01', '1970-01-01', '1970-01-01', 'RESPONSABLE COMMERCIAL', 'C', NULL, '296871', '2020-12-23 10:26:39', '2020-12-23 10:26:39'),
('CD95441', 1021, 'MOHAMD SAAD', 'MESKINI', '198128898', '1970-01-01', '2015-10-05', '1970-01-01', 'consultant fonctionnel', 'C', NULL, '254391', '2020-10-16 06:44:09', '2020-10-16 06:44:09'),
('D560147', 110006, 'OUARRADI', 'SAMIR', '173687372', '1970-01-01', '2013-04-01', '1970-01-01', 'DIRECTEUR INDUSTRIEL', 'C', NULL, '328729', '2020-09-25 10:32:17', '2020-09-25 10:32:17'),
('D613363', 102036, 'BEN SABIH EL AM', 'ALI', '114258661', '1970-01-01', '2018-10-01', '1970-01-01', 'DIRECTEUR COMMERCE MODERNE', 'C', NULL, '143199', '2020-09-24 12:21:17', '2020-09-24 12:21:17'),
('D791138', 500036, 'KZIBAR', 'MOHAMMED', '134766496', '1970-01-01', '2014-01-07', '1970-01-01', 'RESPONSABLE DE CONDITIONNEMENT', 'C', NULL, '7077', '2020-08-05 06:35:11', '2020-08-05 06:35:11'),
('D823680', 300126, 'ALOUI', 'JAWAD', '166624696', '1970-01-01', '2014-11-04', '1970-01-01', 'Adjoint-Chef Meunier', 'C', NULL, '193231', '2020-09-24 10:01:41', '2020-09-24 10:01:41'),
('E279385', 600303, 'LEMHADA', 'ABDELLATIF', '189157822', '1970-01-01', '2012-05-05', '1970-01-01', 'AGENT DE MAINTENANCE', 'E', NULL, '117713', '2020-09-24 10:01:00', '2020-09-24 10:01:00'),
('E557828', 15, 'AIT LHAJ', 'AHSSINE', '179335454', '1970-01-01', '1970-01-01', '1970-01-01', 'PREPARATEUR DE COMMANDE ', 'E', NULL, '296871', '2020-12-23 10:26:39', '2020-12-23 10:26:39'),
('E590982', 14, 'AIT LHAJ', 'EL HOUSSAIN', '179335355', '1970-01-01', '1970-01-01', '1970-01-01', 'PREPARATEUR DE COMMANDE ', 'E', NULL, '296871', '2020-12-23 10:26:39', '2020-12-23 10:26:39'),
('EE351245', 1018, 'ABDERRAMANE', 'AIGASS', '184685290', '1970-01-01', '2015-05-01', '1970-01-01', 'consultant fonctionnel', 'C', NULL, '254391', '2020-10-16 06:44:09', '2020-10-16 06:44:09'),
('G167563', 101794, 'KHARBOUCH', 'HASSAN', '108154841', '1970-01-01', '2018-03-01', '1970-01-01', 'RESP DEVELOPPEMENT COMMERCIAL', 'C', NULL, '143199', '2020-09-24 12:21:17', '2020-09-24 12:21:17'),
('G370152', 10002, 'ZENAI ', 'KHADIJA', '136660314', '1970-01-01', '1970-01-01', '1970-01-01', 'Directeur des fonctions support', 'C', NULL, '376161', '2020-09-23 05:08:04', '2020-09-23 05:08:04'),
('H412981', 600380, 'NAANAA', 'YOUNESS', '146843951', '1970-01-01', '2018-11-22', '1970-01-01', 'CHAUFFEUR', 'E', NULL, '117713', '2020-09-24 10:01:00', '2020-09-24 10:01:00'),
('HA109573', 200172, 'EL ADAOUI', 'YOUSSEF', '183973886', '1970-01-01', '2017-04-18', '1970-01-01', 'CHEF D\'EQUIPE', 'C', NULL, '5587', '2020-09-24 10:17:59', '2020-09-24 10:17:59'),
('HA128737', 500081, 'OUASSIF', 'RACHID', '198900288', '1970-01-01', '2015-08-01', '1970-01-01', 'CHEF D\'EQUIPE', 'C', NULL, '7077', '2020-08-05 06:35:11', '2020-08-05 06:35:11'),
('HA82167', 400100, 'EL AZZAB', 'HASSAN', '119217456', '1970-01-01', '2017-10-16', '1970-01-01', 'AGENT DE CONDITIONNEMENT', 'E', NULL, '286479', '2020-09-24 10:42:07', '2020-09-24 10:42:07'),
('I291000', 400015, 'YADIRI', 'MOULOUD', '138976140', '1970-01-01', '2013-09-16', '1970-01-01', 'MAGASINIER', 'E', NULL, '286479', '2020-09-24 10:42:07', '2020-09-24 10:42:07'),
('I374967', 300053, 'CHOUGANE', 'LAHOUCINE', '190356554', '1970-01-01', '2011-10-01', '1970-01-01', 'CARISTE', 'E', NULL, '193231', '2020-09-24 10:01:41', '2020-09-24 10:01:41'),
('I526187', 10005, 'SAKR', 'NABIL ', '149780572', '1970-01-01', '1970-01-01', '1970-01-01', 'Chef de projets', 'C', NULL, '376161', '2020-09-23 05:08:04', '2020-09-23 05:08:04'),
('IB155599', 100244, 'EL MAZAZ', 'ANOUARJALAL', '102822882', '1970-01-01', '2012-05-10', '1970-01-01', 'CHEF D\'AGENCE', 'C', NULL, '143199', '2020-09-24 12:21:17', '2020-09-24 12:21:17'),
('IB190762', 102043, 'CHAKRI', 'HASSAN', '131665016', '1970-01-01', '2019-10-01', '1970-01-01', 'Agent Administratif', 'E', NULL, '143199', '2020-09-24 12:21:17', '2020-09-24 12:21:17'),
('IB207359', 101686, 'CHAKRI', 'MEHDI', '178785104', '1970-01-01', '2017-11-13', '1970-01-01', 'CHARGE RH', 'E', NULL, '143199', '2020-09-24 12:21:17', '2020-09-24 12:21:17'),
('IB72058', 1014, 'OUHRIR', 'GHIZLANE', '144625096', '1970-01-01', '2014-03-01', '1970-01-01', 'consultant fonctionnel', 'C', NULL, '254391', '2020-10-16 06:44:09', '2020-10-16 06:44:09'),
('IC46156', 400076, 'BENIDIR', 'MOHAMED', '109983083', '1970-01-01', '2015-11-02', '1970-01-01', 'CHEF D\'EQUIPE CONDITIONNEMENT', 'C', NULL, '286479', '2020-09-24 10:42:07', '2020-09-24 10:42:07'),
('J449065', 200205, 'FELLAH', 'MOHAMMED AMINE', '134154105', '1970-01-01', '2017-05-01', '1970-01-01', 'GESTIONNAIRE RISQUE CLIENTS', 'C', NULL, '5587', '2020-09-24 10:17:59', '2020-09-24 10:17:59'),
('J454140', 1015, 'IMAN', 'AIT ALLAL', '172741690', '1970-01-01', '2014-02-10', '1970-01-01', 'consultant fonctionnel', 'C', NULL, '254391', '2020-10-16 06:44:09', '2020-10-16 06:44:09'),
('JB341298', 300040, 'MANTOURAINE', 'BRAHIM', '186385369', '1970-01-01', '2010-07-01', '1970-01-01', 'CARISTE', 'E', NULL, '193231', '2020-09-24 10:01:41', '2020-09-24 10:01:41'),
('JC425782', 101326, 'AIT SI', 'AISSA', '134766595', '1970-01-01', '2014-01-02', '1970-01-01', 'CHEF D\'AGENCE', 'C', NULL, '143199', '2020-09-24 12:21:17', '2020-09-24 12:21:17'),
('L395928', 110010, 'OUALIF', 'MOHAMED EL BACH', '134206286', '1970-01-01', '2014-02-10', '1970-01-01', 'CONTROLEUR DE GESTION', 'C', NULL, '328729', '2020-09-25 10:32:17', '2020-09-25 10:32:17'),
('M172900', 600002, 'ELABDOULI', 'ABDNNABI', '146672756', '1970-01-01', '2003-09-01', '1970-01-01', 'CHAUFFEUR', 'E', NULL, '117713', '2020-09-24 10:01:00', '2020-09-24 10:01:00'),
('M219465', 200005, 'ZINE', 'ALI', '108489868', '1970-01-01', '2011-02-01', '1970-01-01', 'Responsable Commercial', 'C', NULL, '5587', '2020-09-24 10:17:59', '2020-09-24 10:17:59'),
('M233802', 200222, 'EN-NIDAM', 'Fouad', '124781743', '1970-01-01', '2015-10-01', '1970-01-01', 'AGENT ADV', 'E', NULL, '5587', '2020-09-24 10:17:59', '2020-09-24 10:17:59'),
('M241888', 110015, 'TALALI', 'MOHAMMED', '104543866', '1970-01-01', '2003-08-01', '1970-01-01', 'MANAGER RISQUE CLIENT GROUPE', 'C', NULL, '328729', '2020-09-25 10:32:17', '2020-09-25 10:32:17'),
('M242948', 110007, 'BAIDOURI', 'EL MOSTAFA', '122938453', '1970-01-01', '2008-05-01', '1970-01-01', 'CHEF COMPTABLE', 'C', NULL, '328729', '2020-09-25 10:32:17', '2020-09-25 10:32:17'),
('M270432', 500108, 'SARHANE', 'MUSTAPHA', '163625168', '1970-01-01', '2017-01-06', '1970-01-01', 'AGENT DE CONDITIONNEMENT', 'E', NULL, '7077', '2020-08-05 06:35:11', '2020-08-05 06:35:11'),
('M38930', 300015, 'ETTAJI', 'SAID', '131793872', '1970-01-01', '2009-02-01', '1970-01-01', 'Magasinier', 'E', NULL, '193231', '2020-09-24 10:01:41', '2020-09-24 10:01:41'),
('M411895', 100146, 'BELKOUK', 'AZZEDDINE', '141340283', '1970-01-01', '2011-08-14', '1970-01-01', 'SUPERVISEUR', 'E', NULL, '143199', '2020-09-24 12:21:17', '2020-09-24 12:21:17'),
('M476742', 101526, 'LABIAD', 'SOUFIANE', '142096299', '1970-01-01', '2014-01-21', '1970-01-01', 'RESPONSABLE QUALITE', 'C', NULL, '143199', '2020-09-24 12:21:17', '2020-09-24 12:21:17'),
('M478162', 400004, ' ACHAR', 'HASSAN', '160518176', '1970-01-01', '2010-11-01', '1970-01-01', 'AIDE MEUNIER', 'E', NULL, '286479', '2020-09-24 10:42:07', '2020-09-24 10:42:07'),
('M508677', 101078, 'SEYAD', 'DOUNIA', '129702596', '1970-01-01', '2016-12-01', '1970-01-01', 'CHARGE(E) RH', 'E', NULL, '143199', '2020-09-24 12:21:17', '2020-09-24 12:21:17'),
('M519739', 300037, 'KHALISSE', 'OTMAN', '102472182', '1970-01-01', '2010-04-01', '1970-01-01', 'ADJOINT MEUNIER', 'C', NULL, '193231', '2020-09-24 10:01:41', '2020-09-24 10:01:41'),
('M531992', 500021, 'MOUNIR', ' HASSAN', '145268382', '1970-01-01', '2013-05-06', '1970-01-01', 'AIDE CHEF D\'EQUIPE', 'E', NULL, '7077', '2020-08-05 06:35:11', '2020-08-05 06:35:11'),
('M594130', 500051, 'EL ASRI', 'AZEDDINE', '173145693', '1970-01-01', '2015-02-10', '1970-01-01', 'CARISTE', 'E', NULL, '7077', '2020-08-05 06:35:11', '2020-08-05 06:35:11'),
('MA108992', 500153, 'FAIDOUL', 'IMAN', '180210299', '1970-01-01', '2018-07-16', '1970-01-01', 'RESPONSABLE DE LA QUALITE', 'C', NULL, '7077', '2020-08-05 06:35:11', '2020-08-05 06:35:11'),
('MA55579', 101143, 'CHERFAOUI', 'RACHID', '125347750', '1970-01-01', '2014-03-04', '1970-01-01', 'RESPONSABLE DE SITE', 'C', NULL, '143199', '2020-09-24 12:21:17', '2020-09-24 12:21:17'),
('MA62710', 200207, 'BOUAALIA', 'ABDERRAHIM', '146914562', '1970-01-01', '2016-06-08', '1970-01-01', 'AGENT ADV', 'E', NULL, '5587', '2020-09-24 10:17:59', '2020-09-24 10:17:59'),
('MC214323', 101327, 'ZINE', 'ABDRRAHIM', '104054590', '1970-01-01', '2013-09-01', '1970-01-01', 'CHEF D\'AGENCE', 'C', NULL, '143199', '2020-09-24 12:21:17', '2020-09-24 12:21:17'),
('MC55314', 110028, 'BAHBOUHI', 'MOHAMMED', '122650750', '1970-01-01', '2019-03-01', '1970-01-01', 'DIRECTEUR DEVELOPPEMENT', 'C', NULL, '328729', '2020-09-25 10:32:17', '2020-09-25 10:32:17'),
('N392940', 10004, 'ASKOUR', 'NEZHA', '143526814', '1970-01-01', '1970-01-01', '1970-01-01', 'Comptable', 'C', NULL, '376161', '2020-09-23 05:08:04', '2020-09-23 05:08:04'),
('PA88709', 600322, 'EL BAHJAOUI', 'MUSTAPHA', '192039653', '1970-01-01', '2018-04-05', '1970-01-01', 'CHAUFFEUR', 'E', NULL, '117713', '2020-09-24 10:01:00', '2020-09-24 10:01:00'),
('PB52617', 200008, 'TALHI', 'SMAIL', '133982184', '1970-01-01', '2011-03-01', '1970-01-01', 'CHEF DE SITE', 'C', NULL, '5587', '2020-09-24 10:17:59', '2020-09-24 10:17:59'),
('Q198319', 500006, 'EL KHAMSI', ' ABDELHADI', '148605755', '1970-01-01', '2013-04-08', '1970-01-01', 'TECHNICIEN MAINTENANCE', 'E', NULL, '7077', '2020-08-05 06:35:11', '2020-08-05 06:35:11'),
('T143550', 1, 'BENOSMANE', 'SAID', '151660647', '1970-01-01', '1970-01-01', '1970-01-01', 'DIRECTEUR GENERAL', 'C', NULL, '296871', '2020-12-23 10:26:39', '2020-12-23 10:26:39'),
('TA115446', 1025, 'BENALILOU', 'YOUNES', '134813204', '1970-01-01', '2017-03-01', '1970-01-01', 'consultant fonctionnel', 'C', NULL, '254391', '2020-10-16 06:44:09', '2020-10-16 06:44:09'),
('V83603', 100172, 'ETTAMRI', 'EL HOUCINE', '160858556', '1970-01-01', '2011-12-19', '1970-01-01', 'CHEF D\'AGENCE', 'C', NULL, '143199', '2020-09-24 12:21:17', '2020-09-24 12:21:17'),
('W153476', 400021, 'ALOUANE', 'EL MILOUDI', '154361250', '1970-01-01', '2013-09-16', '1970-01-01', 'AIDE MEUNIER', 'E', NULL, '286479', '2020-09-24 10:42:07', '2020-09-24 10:42:07'),
('W156266', 110027, 'HABIB', 'SOUAD', '183962459', '1970-01-01', '2013-02-01', '1970-01-01', 'RESPONSABLE ACHAT', 'C', NULL, '328729', '2020-09-25 10:32:17', '2020-09-25 10:32:17'),
('W181022', 400017, 'EL MOUHAOURI', ' ABDELHAK', '168500852', '1970-01-01', '2013-09-16', '1970-01-01', 'AIDE MEUNIER', 'E', NULL, '286479', '2020-09-24 10:42:07', '2020-09-24 10:42:07'),
('W384220', 10003, 'BADDAG', 'KARIMA', '178233903', '1970-01-01', '1970-01-01', '1970-01-01', 'Responsable solutions digitales', 'C', NULL, '376161', '2020-09-23 05:08:04', '2020-09-23 05:08:04'),
('W393427', 10006, 'BELAZRI', 'SAAD', '117719114', '1970-01-01', '1970-01-01', '1970-01-01', 'Sales administrator & automation manager ', 'C', NULL, '376161', '2020-09-23 05:08:04', '2020-09-23 05:08:04'),
('W58460', 200263, 'KELLANI', 'ABDERRAZAK', '118560161', '1970-01-01', '2017-10-01', '1970-01-01', 'AGENT ADV', 'E', NULL, '5587', '2020-09-24 10:17:59', '2020-09-24 10:17:59'),
('WA104895', 600385, 'EL MCHRRAG', 'JAOUAD', '176358152', '1970-01-01', '2018-11-27', '1970-01-01', 'CHAUFFEUR', 'E', NULL, '117713', '2020-09-24 10:01:00', '2020-09-24 10:01:00'),
('WA107692', 400032, ' ASSOUGHAY', 'AZIZ', '168254863', '1970-01-01', '2013-09-27', '1970-01-01', 'AGENT DE TRAITEMENT & HYGIENE', 'E', NULL, '286479', '2020-09-24 10:42:07', '2020-09-24 10:42:07'),
('WA123846', 500026, 'ELIDRISSI', ' BRAHIM', '164799368', '1970-01-01', '2013-05-20', '1970-01-01', 'CHEF D\'EQUIPE', 'C', NULL, '7077', '2020-08-05 06:35:11', '2020-08-05 06:35:11'),
('WA126801', 600406, 'EL HATIMI', 'RACHID', '174694285', '1970-01-01', '2015-07-01', '1970-01-01', 'OPERATEUR MAINTENANCE', 'E', NULL, '117713', '2020-09-24 10:01:00', '2020-09-24 10:01:00'),
('WA191603', 500098, 'ELHEMRANI', 'ABDEREZZAK', '194478081', '1970-01-01', '2017-06-12', '1970-01-01', 'AIDE CHEF D\'EQUIPE', 'E', NULL, '7077', '2020-08-05 06:35:11', '2020-08-05 06:35:11'),
('WA221413', 300171, 'ZOUIN', 'AHMED', '188942563', '1970-01-01', '2015-07-01', '1970-01-01', 'Aide magasinier', 'E', NULL, '193231', '2020-09-24 10:01:41', '2020-09-24 10:01:41'),
('WA239861', 200306, 'TAIY', 'HASNAE', '120630818', '1970-01-01', '2018-07-02', '1970-01-01', 'RESPONSABLE CONTROLE QUALITE &', 'C', NULL, '5587', '2020-09-24 10:17:59', '2020-09-24 10:17:59'),
('WA255072', 600390, 'MAHLOUB', 'MOUHCINE', '189546404', '1970-01-01', '2018-12-05', '1970-01-01', 'AGENT EXPLOITAION TRANSPORT', 'E', NULL, '117713', '2020-09-24 10:01:00', '2020-09-24 10:01:00'),
('WA77257', 200200, 'FARAJ', 'RACHID', '123226857', '1970-01-01', '2017-05-02', '1970-01-01', 'CHEF D\'EQUIPE', 'C', NULL, '5587', '2020-09-24 10:17:59', '2020-09-24 10:17:59'),
('WA90276', 400124, 'AAZAF', 'ABDELILLAH', '103843358', '1970-01-01', '2018-05-18', '1970-01-01', 'AGENT DE CONDITIONNEMENT', 'E', NULL, '286479', '2020-09-24 10:42:07', '2020-09-24 10:42:07'),
('WB77842', 600287, 'HAMI', 'ABDELGHANI', '192972184', '1970-01-01', '2017-12-21', '1970-01-01', 'CHAUFFEUR', 'E', NULL, '117713', '2020-09-24 10:01:00', '2020-09-24 10:01:00'),
('Y203956', 400132, 'BENALI', 'ABDELHADI', '170443553', '1970-01-01', '2018-10-01', '1970-01-01', 'AGENT DE CONDITIONNEMENT', 'E', NULL, '286479', '2020-09-24 10:42:07', '2020-09-24 10:42:07');

-- --------------------------------------------------------

--
-- Structure de la table `plans`
--

CREATE TABLE `plans` (
  `id_plan` bigint(20) UNSIGNED NOT NULL,
  `refpdf` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `annee` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ct_PF` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'non préparé',
  `dt_recep_ct` date DEFAULT NULL,
  `dt_contrat_PFOPT` date DEFAULT NULL,
  `l_tierpay_PF` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'non préparé',
  `at_approb_PFOPT` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'non préparé',
  `rpt_DS_PFOPT` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'non préparé',
  `rpt_IF_PFOPT` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'non préparé',
  `f2_PFOPT` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'non préparé',
  `model1_PFOPT` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'non préparé',
  `rib_PFOPT` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'non préparé',
  `f3_PFOPT` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'non préparé',
  `at_qualif_PFOPT` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'non préparé',
  `eligib_cab_PFOPT` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'non préparé',
  `accuse_PFOPT` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'non préparé',
  `dt_accuse_PFOPT` date DEFAULT NULL,
  `etat` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'aucun',
  `nrc_e` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `commentaire` varchar(5000) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `plans`
--

INSERT INTO `plans` (`id_plan`, `refpdf`, `annee`, `ct_PF`, `dt_recep_ct`, `dt_contrat_PFOPT`, `l_tierpay_PF`, `at_approb_PFOPT`, `rpt_DS_PFOPT`, `rpt_IF_PFOPT`, `f2_PFOPT`, `model1_PFOPT`, `rib_PFOPT`, `f3_PFOPT`, `at_qualif_PFOPT`, `eligib_cab_PFOPT`, `accuse_PFOPT`, `dt_accuse_PFOPT`, `etat`, `nrc_e`, `commentaire`, `created_at`, `updated_at`) VALUES
(7, 'CALZ/2019', '2019', 'client', NULL, NULL, 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'préparé', '2019-09-30', 'réalisé', '7077', NULL, '2020-09-03 07:27:47', '2020-09-03 07:27:47'),
(10, 'VIVO/2010', '2010', 'ofppt', '2020-09-16', '2020-09-16', 'préparé', 'préparé', 'préparé', 'préparé', 'préparé', 'préparé', 'préparé', 'préparé', 'préparé', 'préparé', 'préparé', '2020-09-16', 'planifié', '11111', NULL, '2020-09-17 05:53:00', '2020-09-17 05:53:00'),
(11, 'LGSZ/2019', '2019', 'client', '2020-02-01', NULL, 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'préparé', '2019-09-30', 'réalisé', '286479', NULL, '2020-09-17 07:02:31', '2020-09-17 07:02:31'),
(12, 'ZC/2019', '2019', 'client', '2020-02-01', NULL, 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'préparé', '2019-09-30', 'réalisé', '5587', 'contrat en signature (Groupe zine)', '2020-09-17 10:20:53', '2020-11-20 09:26:19'),
(13, 'CF/2019', '2019', 'client', '2020-02-01', NULL, 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', '2019-09-30', 'réalisé', '143199', NULL, '2020-09-18 04:35:24', '2020-09-18 04:35:24'),
(14, 'LGMZ/2019', '2019', 'client', '2020-02-02', NULL, 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'préparé', '2019-01-30', 'réalisé', '193231', NULL, '2020-09-18 06:45:28', '2020-09-18 06:45:28'),
(15, 'TRSD/2019', '2019', 'client', '2020-02-01', NULL, 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'préparé', '2019-01-30', 'réalisé', '117713', NULL, '2020-09-18 09:42:19', '2020-09-18 09:42:19'),
(16, 'ZCI/2019', '2019', 'client', '2020-02-01', NULL, 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'préparé', '2019-01-31', 'réalisé', '328729', NULL, '2020-09-18 11:00:48', '2020-09-18 11:00:48'),
(17, 'Uplift/2019', '2019', 'ofppt', '2020-02-01', '2020-09-16', 'non préparé', 'préparé', 'préparé', 'préparé', 'préparé', 'préparé', 'préparé', 'préparé', 'non préparé', 'préparé', 'préparé', '2019-09-30', 'réalisé', '376161', NULL, '2020-09-23 04:30:08', '2020-10-05 08:26:36'),
(18, 'VIVO/2000', '2000', 'client', NULL, '2020-09-24', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'préparé', '2020-09-24', 'planifié', '11111', 'Lorem Ipsum er ganske enkelt fyldtekst fra print- og typografiindustrien. Lorem Ipsum har været standard fyldtekst siden 1500-tallet, hvor en ukendt trykker sammensatte en tilfældig spalte for at trykke en bog til sammenligning af forskellige skrifttyper. Lorem Ipsum har ikke alene overlevet fem århundreder, men har også vundet indpas i elektronisk typografi uden væsentlige ændringer. Sætningen blev gjordt kendt i 1960\'erne med lanceringen af Letraset-ark, som indeholdt afsnit med Lorem Ipsum, og senere med layoutprogrammer som Aldus PageMaker, som også indeholdt en udgave af Lorem Ipsum.', '2020-09-25 10:08:25', '2020-11-11 08:27:40'),
(19, 'SGLOBAL/2020', '2020', 'non préparé', NULL, NULL, 'préparé', 'préparé', 'préparé', 'préparé', 'préparé', 'préparé', 'préparé', 'préparé', 'préparé', 'préparé', 'non préparé', NULL, 'réalisé', '254391', NULL, '2020-10-05 12:12:07', '2021-01-22 08:47:49'),
(20, 'HAVA/2020', '2020', 'non préparé', NULL, NULL, 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', NULL, 'réalisé', '296871', NULL, '2020-10-20 09:10:24', '2021-01-22 08:59:08'),
(21, 'SCRH/2020', '2020', 'non préparé', NULL, NULL, 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', NULL, 'planifié', '251529', NULL, '2020-10-20 12:23:08', '2020-10-20 12:23:08'),
(22, 'MATIPLAS/2020', '2020', 'non préparé', NULL, NULL, 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', NULL, 'planifié', '45307', NULL, '2020-10-21 11:55:17', '2020-10-21 11:55:17'),
(23, 'BURINTEL/2020', '2020', 'non préparé', NULL, NULL, 'préparé', 'préparé', 'préparé', 'préparé', 'préparé', 'préparé', 'préparé', 'préparé', 'préparé', 'préparé', 'non préparé', '2020-10-27', 'planifié', '103827', NULL, '2020-10-21 13:35:43', '2020-11-16 13:53:20'),
(24, 'Uplift/2020', '2020', 'non préparé', NULL, NULL, 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', NULL, 'réalisé', '376161', NULL, '2020-10-22 05:49:09', '2021-01-22 08:57:17'),
(25, 'LGMZ/2020', '2020', 'non préparé', NULL, NULL, 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', NULL, 'planifié', '193231', NULL, '2020-10-22 13:27:52', '2020-10-22 13:27:52'),
(26, 'ZC/2020', '2020', 'non préparé', NULL, NULL, 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', NULL, 'planifié', '5587', NULL, '2020-10-23 07:36:32', '2020-10-23 07:36:32'),
(27, 'CALZ/2020', '2020', 'non préparé', NULL, NULL, 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', NULL, 'planifié', '7077', NULL, '2020-10-23 08:39:30', '2020-10-23 08:39:30'),
(28, 'BMZ/2020', '2020', 'non préparé', NULL, NULL, 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', NULL, 'planifié', '10963', NULL, '2020-10-23 09:47:18', '2020-10-23 09:47:18'),
(29, 'LGSZ/2020', '2020', 'non préparé', NULL, NULL, 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', NULL, 'planifié', '286479', NULL, '2020-10-23 10:15:26', '2020-10-23 10:15:26'),
(30, 'CF/2020', '2020', 'non préparé', NULL, NULL, 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', NULL, 'planifié', '143199', NULL, '2020-10-23 12:12:04', '2020-10-23 12:12:04'),
(31, 'TRSD/2020', '2020', 'non préparé', NULL, NULL, 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', NULL, 'planifié', '117713', NULL, '2020-10-23 14:09:20', '2020-10-23 14:09:20'),
(32, 'LDF/2020', '2020', 'non préparé', NULL, NULL, 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', NULL, 'planifié', '91175', 'dossier corrigé déposé à l\'ofppt le 07/12/2020', '2020-11-02 07:40:05', '2020-12-10 13:39:35'),
(33, 'HAVA/2019', '2019', 'ofppt', '2020-02-13', '2020-03-10', 'non préparé', 'préparé', 'préparé', 'préparé', 'préparé', 'préparé', 'préparé', 'préparé', 'non préparé', 'préparé', 'préparé', '2019-09-26', 'réalisé', '296871', 'Contrat normal, une partie avec le Cabinet VALUE Experts Group', '2020-11-11 05:53:02', '2020-11-11 05:53:02'),
(34, 'SGLOBAL/2019', '2019', 'ofppt', '2020-01-29', NULL, 'préparé', 'préparé', 'préparé', 'préparé', 'préparé', 'préparé', 'préparé', 'préparé', 'préparé', 'préparé', 'préparé', '2020-09-30', 'réalisé', '254391', 'à reclasser N° TF', '2020-11-23 11:39:18', '2020-11-24 07:49:36');

-- --------------------------------------------------------

--
-- Structure de la table `plan_formations`
--

CREATE TABLE `plan_formations` (
  `n_form` bigint(20) UNSIGNED NOT NULL,
  `id_dom` varchar(300) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_thm` varchar(300) COLLATE utf8mb4_unicode_ci NOT NULL,
  `n_action` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model5` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'non préparé',
  `model3` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'non préparé',
  `f4` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'non préparé',
  `fiche_eval` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'non préparé',
  `support_form` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'non préparé',
  `cv_inv` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'non préparé',
  `avis_affich` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'non préparé',
  `dt_debut` date NOT NULL,
  `dt_fin` date NOT NULL,
  `nb_jour` int(11) NOT NULL,
  `type_form` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `organisme` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lieu` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nom_resp` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nb_grp` int(11) NOT NULL,
  `nb_partcp_total` int(11) NOT NULL,
  `nb_cadre` int(11) NOT NULL,
  `nb_employe` int(11) NOT NULL,
  `nb_ouvrier` int(11) NOT NULL,
  `bdg_jour` double NOT NULL,
  `bdg_total` double NOT NULL,
  `bdg_letter` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `etat` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'aucun',
  `id_inv` bigint(20) UNSIGNED NOT NULL,
  `id_plan` bigint(20) UNSIGNED NOT NULL,
  `commentaire` varchar(5000) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `nb_heure` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `plan_formations`
--

INSERT INTO `plan_formations` (`n_form`, `id_dom`, `id_thm`, `n_action`, `model5`, `model3`, `f4`, `fiche_eval`, `support_form`, `cv_inv`, `avis_affich`, `dt_debut`, `dt_fin`, `nb_jour`, `type_form`, `organisme`, `lieu`, `nom_resp`, `nb_grp`, `nb_partcp_total`, `nb_cadre`, `nb_employe`, `nb_ouvrier`, `bdg_jour`, `bdg_total`, `bdg_letter`, `etat`, `id_inv`, `id_plan`, `commentaire`, `created_at`, `updated_at`, `nb_heure`) VALUES
(9, '3', '4', 'TF1', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', '2019-10-17', '2019-10-19', 3, 'Intra-entreprise', 'Mediexperts', 'COMPLEXE ALIMENTAIRE ZINE', 'BAZE MOUNIR', 1, 6, 6, 0, 0, 7000, 21000, 'vingt-cinq mille deux cents', 'réalisé', 1, 7, NULL, '2020-09-16 05:30:50', '2020-11-11 08:57:46', NULL),
(10, '4', '5', 'TF2', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', '2019-10-24', '2019-10-26', 3, 'Intra-entreprise', 'Mediexperts', 'COMPLEXE ALIMENTAIRE ZINE', 'BAZE MOUNIR', 1, 6, 0, 6, 0, 7000, 21000, NULL, 'réalisé', 2, 7, NULL, '2020-09-16 05:32:44', '2020-09-16 05:32:44', NULL),
(11, '4', '6', 'TF3', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', '2019-11-05', '2019-11-19', 3, 'Intra-entreprise', 'Mediexperts', 'COMPLEXE ALIMENTAIRE ZINE', 'BAZE MOUNIR', 1, 6, 6, 0, 0, 7000, 21000, NULL, 'réalisé', 3, 7, NULL, '2020-09-16 05:37:14', '2020-09-16 06:10:33', NULL),
(13, '6', '33', 'TF1', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'préparé', 'non préparé', '2019-10-31', '2019-11-02', 3, 'Intra-entreprise', 'Mediexperts', 'LES GRANDES SEMOULERIES ZINE', 'BAZE MOUNIR', 1, 6, 3, 3, 0, 7000, 21000, NULL, 'réalisé', 2, 11, NULL, '2020-09-17 07:25:07', '2020-09-24 10:59:50', NULL),
(14, '6', '34', 'TF2', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'préparé', 'non préparé', '2019-10-17', '2019-10-19', 3, 'Intra-entreprise', 'Mediexperts', 'LES GRANDES SEMOULERIES ZINE', 'BAZE MOUNIR', 1, 6, 2, 4, 0, 7000, 21000, NULL, 'réalisé', 2, 11, NULL, '2020-09-17 07:31:34', '2020-09-24 11:05:12', NULL),
(15, '7', '11', 'TF3', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'préparé', 'non préparé', '2019-10-24', '2019-10-26', 3, 'Intra-entreprise', 'Mediexperts', 'LES GRANDES SEMOULERIES ZINE', 'BAZE MOUNIR', 1, 6, 0, 6, 0, 6000, 18000, NULL, 'réalisé', 3, 11, NULL, '2020-09-17 08:39:34', '2020-11-05 09:12:37', NULL),
(16, '4', '10', 'TF4', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', '2019-11-07', '2019-11-09', 3, 'Intra-entreprise', 'Mediexperts', 'LES GRANDES SEMOULERIES ZINE', 'BAZE MOUNIR', 1, 6, 0, 6, 0, 7000, 21000, NULL, 'réalisé', 7, 11, NULL, '2020-09-17 08:41:05', '2020-09-17 08:41:05', NULL),
(17, '8', '12', 'TF1', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'préparé', 'non préparé', '2019-10-17', '2019-10-19', 3, 'Intra-entreprise', 'Mediexperts', 'ZINE CEREALES', 'Mounir BAZE', 1, 6, 0, 6, 0, 7000, 21000, NULL, 'réalisé', 8, 12, NULL, '2020-09-17 10:31:40', '2020-11-02 08:33:35', NULL),
(18, '6', '14', 'TF2', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', '2019-11-07', '2019-11-09', 3, 'Intra-entreprise', 'Mediexperts', 'ZINE CEREALES', 'Mounir BAZE', 1, 6, 6, 0, 0, 7000, 21000, NULL, 'réalisé', 2, 12, NULL, '2020-09-17 10:35:07', '2020-09-17 10:35:07', NULL),
(19, '22', '118', 'TF3', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', '2019-10-24', '2019-10-26', 3, 'Intra-entreprise', 'Mediexperts', 'ZINE CEREALES', 'Mounir BAZE', 1, 6, 0, 6, 0, 6000, 18000, NULL, 'réalisé', 6, 12, NULL, '2020-09-17 10:36:32', '2020-11-02 11:40:04', NULL),
(20, '10', '21', 'TF1', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', '2019-10-17', '2019-10-19', 3, 'Intra-entreprise', 'Mediexperts', 'CANAL FOOD', 'Mounir BAZE', 1, 6, 6, 0, 0, 7500, 22500, NULL, 'réalisé', 9, 13, NULL, '2020-09-18 04:48:29', '2020-09-18 09:07:07', NULL),
(21, '12', '23', 'TF2', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', '2019-12-16', '2019-12-18', 3, 'Intra-entreprise', 'Mediexperts', 'CANAL FOOD', 'Mounir BAZE', 1, 7, 7, 0, 0, 7000, 21000, NULL, 'réalisé', 2, 13, NULL, '2020-09-18 04:50:06', '2020-09-18 09:07:50', NULL),
(22, '11', '22', 'TF3', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', '2019-10-24', '2019-10-26', 3, 'Intra-entreprise', 'Mediexperts', 'CANAL FOOD', 'Mounir BAZE', 1, 6, 6, 0, 0, 7000, 21000, NULL, 'réalisé', 8, 13, NULL, '2020-09-18 04:51:34', '2020-09-18 09:08:14', NULL),
(23, '13', '24', 'TF4', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', '2019-11-14', '2019-11-16', 3, 'Intra-entreprise', 'Mediexperts', 'CANAL FOOD', 'Mounir BAZE', 1, 6, 0, 6, 0, 8000, 24000, 'VINGT-HUIT MILLE HUIT CENTS', 'annulé', 8, 13, NULL, '2020-09-18 04:55:36', '2020-12-25 14:41:09', NULL),
(24, '14', '25', 'TF1', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', '2019-10-24', '2019-10-26', 3, 'Intra-entreprise', 'Mediexperts', 'LES GRANDS MOULINS ZINE', 'Mounir BAZE', 1, 6, 6, 0, 0, 7000, 21000, NULL, 'réalisé', 12, 14, NULL, '2020-09-18 07:03:58', '2020-09-18 09:13:09', NULL),
(25, '15', '26', 'TF2', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', '2019-10-17', '2019-10-19', 3, 'Intra-entreprise', 'Mediexperts', 'LES GRANDS MOULINS ZINE', 'Mounir BAZE', 1, 6, 0, 6, 0, 7000, 21000, NULL, 'réalisé', 11, 14, NULL, '2020-09-18 08:30:22', '2020-09-18 09:13:37', NULL),
(26, '12', '27', 'TF1', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', '2019-10-24', '2019-10-26', 3, 'Intra-entreprise', 'Mediexperts', 'TRANSDINE', 'Mounir baze', 1, 6, 1, 5, 0, 7000, 21000, NULL, 'réalisé', 14, 15, NULL, '2020-09-18 10:05:57', '2020-09-18 10:05:57', NULL),
(27, '15', '26', 'TF2', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', '2019-10-17', '2019-10-19', 3, 'Intra-entreprise', 'Mediexperts', 'TRANSDINE', 'Mounir baze', 1, 6, 0, 6, 0, 7000, 21000, 'vingt-cinq mille deux cents', 'réalisé', 3, 15, NULL, '2020-09-18 10:07:59', '2020-11-13 07:47:25', NULL),
(31, '11', '30', 'TF1', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', '2019-10-22', '2019-10-23', 2, 'Intra-entreprise', 'Mediexperts', 'Sales Uplift', 'ADIL RAISS EL FENNI', 1, 6, 6, 0, 0, 7000, 14000, 'SEIZE MILLE HUIT CENTS', 'réalisé', 19, 17, NULL, '2020-09-23 04:43:31', '2020-12-14 09:07:21', NULL),
(32, '16', '31', 'TF2', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', '2019-10-15', '2019-10-16', 2, 'Intra-entreprise', 'Mediexperts', 'Sales Uplift', 'ADIL RAISS EL FENNI', 1, 5, 5, 0, 0, 7000, 14000, NULL, 'réalisé', 6, 17, NULL, '2020-09-23 04:44:59', '2020-09-23 04:44:59', NULL),
(33, '10', '32', 'TF3', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', '2019-11-26', '2019-11-27', 2, 'Intra-entreprise', 'Mediexperts', 'Sales Uplift', 'ADIL RAISS EL FENNI', 1, 6, 6, 0, 0, 7000, 14000, NULL, 'réalisé', 1, 17, NULL, '2020-09-23 04:49:03', '2020-10-06 06:20:43', NULL),
(37, '16', '29', 'TF1', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', '2019-10-24', '2019-10-26', 3, 'Intra-entreprise', 'Mediexperts', 'ZINE CAPITAL INVEST', 'Mounir BAZE', 1, 6, 6, 0, 0, 7000, 21000, NULL, 'réalisé', 1, 16, NULL, '2020-09-25 10:39:01', '2020-09-25 10:39:01', NULL),
(38, '10', '28', 'TF2', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', '2019-10-17', '2019-10-19', 3, 'Intra-entreprise', 'Mediexperts', 'ZINE CAPITAL INVEST', 'Mounir BAZE', 1, 6, 6, 0, 0, 7500, 22500, NULL, 'réalisé', 6, 16, NULL, '2020-09-25 10:59:15', '2020-09-25 10:59:15', NULL),
(39, '16', '39', 'TF1', 'préparé', 'préparé', 'préparé', 'préparé', 'préparé', 'préparé', 'préparé', '2020-11-12', '2020-11-21', 6, 'Intra-entreprise', 'Mediexperts', 'SYSTEMS ADVISERS GROUP', 'MOURAD JBIHA', 1, 6, 6, 0, 0, 7000, 42000, 'CINQUANTE MILLE QUATRE CENTS', 'réalisé', 6, 19, NULL, '2020-10-15 12:16:44', '2021-01-22 08:48:46', 6),
(41, '16', '31', 'TF2', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'préparé', 'non préparé', '2020-11-26', '2020-11-28', 3, 'Intra-entreprise', 'Mediexperts', 'SYSTEMS ADVISERS GROUP', 'MOURAD JBIHA', 1, 5, 5, 0, 0, 7000, 21000, 'VINGT-CINQ MILLE DEUX CENTS', 'réalisé', 6, 19, NULL, '2020-10-15 12:25:17', '2021-01-22 08:49:02', 6),
(42, '18', '37', 'TF3', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'préparé', 'non préparé', '2020-11-09', '2020-12-02', 9, 'Intra-entreprise', 'Mediexperts', 'SYSTEMS ADVISERS GROUP', 'MOURAD JBIHA', 2, 12, 12, 0, 0, 5000, 22500, 'QUARANTE-NEUF MILLE CINQ CENTS', 'réalisé', 15, 19, NULL, '2020-10-15 12:39:02', '2021-01-22 08:49:22', 3),
(43, '18', '36', 'TF4', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', '2020-12-07', '2021-01-20', 14, 'Intra-entreprise', 'Mediexperts', 'SYSTEMS ADVISERS GROUP', 'MOURAD JBIHA', 2, 12, 12, 0, 0, 5000, 35000, 'SOIXANTE-DIX-SEPT MILLE', 'réalisé', 16, 19, 'A modifier intervenant', '2020-10-15 12:58:50', '2021-01-22 08:49:39', 3),
(44, '15', '38', 'TF5', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'préparé', 'non préparé', '2020-12-03', '2020-12-05', 3, 'Intra-entreprise', 'Mediexperts', 'SYSTEMS ADVISERS GROUP', 'MOURAD JBIHA', 1, 5, 5, 0, 0, 7000, 21000, 'VINGT-CINQ MILLE DEUX CENTS', 'réalisé', 17, 19, 'A vérifier intervenant', '2020-10-15 13:09:51', '2021-01-22 08:49:56', 6),
(45, '20', '52', 'TF1', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'préparé', 'préparé', '2020-11-19', '2020-11-21', 3, 'Intra-entreprise', 'Mediexperts', 'SCRH Group', 'FAHS MOHAMED', 1, 5, 1, 3, 1, 7000, 21000, 'VINGT-CINQ MILLE DEUX CENTS', 'planifié', 2, 21, NULL, '2020-10-20 12:36:09', '2020-12-31 11:14:08', 6),
(46, '13', '24', 'TF2', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', '2020-11-26', '2020-11-28', 3, 'Intra-entreprise', 'Mediexperts', 'SCRH Group', 'FAHS MOHAMED', 1, 5, 5, 0, 0, 8000, 24000, 'VINGT-HUIT MILLE HUIT CENTS', 'planifié', 8, 21, NULL, '2020-10-20 12:39:35', '2020-12-31 11:14:36', 6),
(47, '19', '45', 'TF3', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', '2020-12-03', '2020-12-05', 3, 'Intra-entreprise', 'Mediexperts', 'SCRH Group', 'FAHS MOHAMED', 1, 5, 2, 3, 0, 7000, 21000, 'VINGT-CINQ MILLE DEUX CENTS', 'planifié', 16, 21, NULL, '2020-10-20 12:42:45', '2020-12-31 11:14:54', 6),
(48, '11', '46', 'TF4', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', '2020-12-10', '2020-12-12', 3, 'Intra-entreprise', 'Mediexperts', 'SCRH Group', 'FAHS MOHAMED', 1, 5, 5, 0, 0, 7000, 21000, 'VINGT-CINQ MILLE DEUX CENTS', 'planifié', 6, 21, NULL, '2020-10-20 12:44:21', '2020-12-31 11:15:22', 6),
(49, '20', '47', 'TF5', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', '2020-12-17', '2020-12-19', 3, 'Intra-entreprise', 'Mediexperts', 'SCRH Group', 'FAHS MOHAMED', 1, 5, 2, 3, 0, 7000, 21000, 'VINGT-CINQ MILLE DEUX CENTS', 'planifié', 2, 21, NULL, '2020-10-20 12:45:34', '2020-12-31 11:15:45', 6),
(50, '10', '41', 'TF6', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', '2020-12-24', '2020-12-26', 3, 'Intra-entreprise', 'Mediexperts', 'SCRH Group', 'FAHS MOHAMED', 1, 5, 5, 0, 0, 7500, 22500, 'VINGT-SEPT MILLE', 'planifié', 1, 21, NULL, '2020-10-20 12:46:57', '2020-12-31 11:16:17', 6),
(51, '16', '48', 'TF7', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', '2021-01-07', '2021-01-09', 3, 'Intra-entreprise', 'Mediexperts', 'SCRH Group', 'FAHS MOHAMED', 1, 5, 5, 0, 0, 7000, 21000, 'VINGT-CINQ MILLE DEUX CENTS', 'planifié', 8, 21, NULL, '2020-10-20 12:49:01', '2020-12-31 11:16:52', 6),
(52, '10', '49', 'TF8', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', '2021-01-14', '2021-01-16', 3, 'Intra-entreprise', 'Mediexperts', 'SCRH Group', 'FAHS MOHAMED', 1, 5, 5, 0, 0, 7500, 22500, 'VINGT-SEPT MILLE', 'réalisé', 1, 21, NULL, '2020-10-20 12:50:42', '2021-01-22 09:23:34', 6),
(53, '13', '50', 'TF9', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', '2021-01-21', '2021-01-23', 3, 'Intra-entreprise', 'Mediexperts', 'SCRH Group', 'FAHS MOHAMED', 1, 5, 5, 0, 0, 8000, 24000, 'VINGT-HUIT MILLE HUIT CENTS', 'planifié', 1, 21, NULL, '2020-10-20 13:19:33', '2020-12-31 11:18:40', 6),
(54, '10', '51', 'TF10', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', '2021-01-28', '2021-01-30', 3, 'Intra-entreprise', 'Mediexperts', 'SCRH Group', 'FAHS MOHAMED', 1, 5, 5, 0, 0, 7500, 22500, 'VINGT-SEPT MILLE', 'planifié', 1, 21, NULL, '2020-10-20 13:20:36', '2020-12-31 11:19:14', 6),
(55, '10', '40', 'TF1', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', '2020-11-19', '2020-11-21', 3, 'Intra-entreprise', 'Mediexperts', 'Hava Hard Trade', 'Belaid OUJANA', 1, 5, 5, 0, 0, 7500, 22500, 'VINGT-SEPT MILLE', 'réalisé', 1, 20, 'A modifie intervenant', '2020-10-20 14:13:47', '2021-01-22 08:58:11', 6),
(56, '10', '41', 'TF2', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', '2020-11-26', '2020-11-28', 3, 'Intra-entreprise', 'Mediexperts', 'Hava Hard Trade', 'Belaid OUJANA', 1, 5, 5, 0, 0, 7500, 22500, 'VINGT-SEPT MILLE', 'réalisé', 1, 20, 'A modifie intervenant', '2020-10-20 14:14:52', '2021-01-22 08:58:20', 6),
(57, '11', '22', 'TF3', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', '2020-12-04', '2020-12-05', 2, 'Intra-entreprise', 'Mediexperts', 'Hava Hard Trade', 'Belaid OUJANA', 1, 5, 5, 0, 0, 7000, 14000, 'SEIZE MILLE HUIT CENTS', 'réalisé', 1, 20, 'A modifie intervenant', '2020-10-20 14:15:45', '2021-01-22 08:58:29', 6),
(58, '11', '42', 'TF4', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', '2020-12-10', '2020-12-12', 3, 'Intra-entreprise', 'Mediexperts', 'Hava Hard Trade', 'Belaid OUJANA', 1, 5, 5, 0, 0, 7000, 21000, 'VINGT-CINQ MILLE DEUX CENTS', 'réalisé', 1, 20, 'A modifie intervenant', '2020-10-20 14:17:28', '2021-01-22 08:58:38', 6),
(59, '11', '43', 'TF5', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', '2020-12-17', '2020-12-19', 3, 'Intra-entreprise', 'Mediexperts', 'Hava Hard Trade', 'Belaid OUJANA', 1, 5, 5, 0, 0, 7000, 21000, 'VINGT-CINQ MILLE DEUX CENTS', 'réalisé', 1, 20, 'A modifie intervenant', '2020-10-20 14:19:00', '2021-01-22 08:58:50', 6),
(60, '11', '42', 'TF1', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', '2020-11-19', '2020-11-20', 2, 'Intra-entreprise', 'Mediexperts', 'MAROC TISSUS PLASTIFIES', 'MEHDI MIYARA', 1, 5, 5, 0, 0, 7000, 14000, 'SEIZE MILLE HUIT CENTS', 'planifié', 8, 22, NULL, '2020-10-21 11:58:34', '2020-12-31 11:27:00', 6),
(61, '16', '53', 'TF2', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', '2020-11-21', '2020-11-26', 2, 'Intra-entreprise', 'Mediexperts', 'MAROC TISSUS PLASTIFIES', 'MEHDI MIYARA', 1, 5, 5, 0, 0, 7000, 14000, 'SEIZE MILLE HUIT CENTS', 'planifié', 8, 22, NULL, '2020-10-21 12:00:51', '2020-12-31 11:27:26', 6),
(62, '10', '32', 'TF3', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', '2020-11-27', '2020-11-28', 2, 'Intra-entreprise', 'Mediexperts', 'MAROC TISSUS PLASTIFIES', 'MEHDI MIYARA', 1, 5, 5, 0, 0, 7500, 15000, 'DIX-HUIT MILLE', 'planifié', 8, 22, NULL, '2020-10-21 12:01:52', '2020-12-31 11:27:53', 6),
(63, '20', '57', 'TF4', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', '2020-12-03', '2020-12-03', 1, 'Intra-entreprise', 'Mediexperts', 'MAROC TISSUS PLASTIFIES', 'MEHDI MIYARA', 1, 6, 0, 0, 6, 7000, 7000, 'HUIT MILLE QUATRE CENTS', 'planifié', 8, 22, NULL, '2020-10-21 12:06:35', '2020-12-31 11:28:50', 6),
(64, '13', '50', 'TF5', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', '2020-12-04', '2020-12-05', 2, 'Intra-entreprise', 'Mediexperts', 'MAROC TISSUS PLASTIFIES', 'MEHDI MIYARA', 1, 5, 5, 0, 0, 8000, 16000, 'DIX-NEUF MILLE DEUX CENTS', 'planifié', 8, 22, NULL, '2020-10-21 12:09:44', '2020-12-31 11:29:11', 6),
(65, '10', '55', 'TF6', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', '2020-12-10', '2020-12-11', 2, 'Intra-entreprise', 'Mediexperts', 'MAROC TISSUS PLASTIFIES', 'MEHDI MIYARA', 1, 5, 5, 0, 0, 7500, 15000, 'DIX-HUIT MILLE', 'planifié', 8, 22, NULL, '2020-10-21 12:11:43', '2020-12-31 11:30:33', 6),
(66, '14', '56', 'TF7', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', '2020-12-12', '2020-12-17', 2, 'Intra-entreprise', 'Mediexperts', 'MAROC TISSUS PLASTIFIES', 'MEHDI MIYARA', 1, 5, 5, 0, 0, 7000, 14000, 'SEIZE MILLE HUIT CENTS', 'planifié', 8, 22, NULL, '2020-10-21 12:13:18', '2020-12-31 11:34:37', 6),
(67, '14', '58', 'TF8', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', '2020-12-18', '2020-12-18', 1, 'Intra-entreprise', 'Mediexperts', 'MAROC TISSUS PLASTIFIES', 'MEHDI MIYARA', 1, 5, 5, 0, 0, 7000, 7000, 'HUIT MILLE QUATRE CENTS', 'planifié', 8, 22, NULL, '2020-10-21 12:20:04', '2020-12-31 11:35:15', 6),
(68, '12', '23', 'TF9', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', '2020-12-19', '2020-12-24', 2, 'Intra-entreprise', 'Mediexperts', 'MAROC TISSUS PLASTIFIES', 'MEHDI MIYARA', 1, 6, 6, 0, 0, 7000, 14000, 'SEIZE MILLE HUIT CENTS', 'planifié', 8, 22, NULL, '2020-10-21 12:22:24', '2020-12-31 11:36:00', 6),
(69, '10', '40', 'TF1', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', '2020-11-19', '2020-11-21', 3, 'Intra-entreprise', 'Mediexperts', 'BURINTEL', 'NAWAL BENJELLON', 1, 6, 6, 0, 0, 7500, 22500, 'VINGT-SEPT MILLE', 'réalisé', 6, 23, NULL, '2020-10-21 13:41:20', '2021-01-22 09:07:10', 6),
(70, '10', '59', 'TF2', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', '2020-11-26', '2020-11-28', 3, 'Intra-entreprise', 'Mediexperts', 'BURINTEL', 'NAWAL BENJELLON', 1, 6, 6, 0, 0, 7500, 22500, 'VINGT-SEPT MILLE', 'réalisé', 6, 23, NULL, '2020-10-21 13:48:20', '2021-01-22 09:07:25', 6),
(71, '10', '41', 'TF3', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', '2020-12-03', '2020-12-05', 3, 'Intra-entreprise', 'Mediexperts', 'BURINTEL', 'NAWAL BENJELLON', 1, 6, 6, 0, 0, 7500, 22500, 'VINGT-SEPT MILLE', 'réalisé', 6, 23, NULL, '2020-10-21 13:50:30', '2021-01-22 09:07:34', 6),
(72, '14', '58', 'TF4', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', '2020-12-10', '2020-12-11', 2, 'Intra-entreprise', 'Mediexperts', 'BURINTEL', 'NAWAL BENJELLON', 1, 6, 6, 0, 0, 7000, 14000, 'SEIZE MILLE HUIT CENTS', 'réalisé', 6, 23, NULL, '2020-10-21 13:51:35', '2021-01-22 09:03:26', 6),
(73, '10', '55', 'TF5', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', '2020-12-12', '2020-12-18', 3, 'Intra-entreprise', 'Mediexperts', 'BURINTEL', 'NAWAL BENJELLON', 1, 6, 6, 0, 0, 7500, 22500, 'VINGT-SEPT MILLE', 'réalisé', 6, 23, NULL, '2020-10-21 13:53:23', '2021-01-22 09:07:45', 6),
(74, '15', '60', 'TF6', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', '2020-12-19', '2020-12-24', 2, 'Intra-entreprise', 'Mediexperts', 'BURINTEL', 'NAWAL BENJELLON', 1, 6, 6, 0, 0, 7000, 14000, 'SEIZE MILLE HUIT CENTS', 'réalisé', 6, 23, NULL, '2020-10-21 14:01:57', '2021-01-22 09:07:53', 6),
(75, '16', '48', 'TF7', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', '2020-12-25', '2020-12-31', 3, 'Intra-entreprise', 'Mediexperts', 'BURINTEL', 'NAWAL BENJELLON', 1, 6, 6, 0, 0, 7000, 21000, 'VINGT-CINQ MILLE DEUX CENTS', 'réalisé', 6, 23, NULL, '2020-10-21 14:04:32', '2021-01-22 09:08:01', 6),
(76, '13', '50', 'TF8', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', '2021-01-07', '2021-01-09', 3, 'Intra-entreprise', 'Mediexperts', 'BURINTEL', 'NAWAL BENJELLON', 1, 6, 6, 0, 0, 8000, 24000, 'VINGT-HUIT MILLE HUIT CENTS', 'réalisé', 6, 23, NULL, '2020-10-21 14:06:00', '2021-01-22 09:04:34', 6),
(77, '16', '61', 'TF9', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', '2021-01-14', '2021-01-16', 3, 'Intra-entreprise', 'Mediexperts', 'BURINTEL', 'NAWAL BENJELLON', 1, 6, 6, 0, 0, 7000, 21000, 'VINGT-CINQ MILLE DEUX CENTS', 'réalisé', 6, 23, NULL, '2020-10-21 14:09:31', '2021-01-22 09:05:41', 6),
(78, '11', '22', 'TF10', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', '2021-01-21', '2021-01-23', 3, 'Intra-entreprise', 'Mediexperts', 'BURINTEL', 'NAWAL BENJELLON', 1, 6, 6, 0, 0, 7000, 21000, 'VINGT-CINQ MILLE DEUX CENTS', 'planifié', 6, 23, NULL, '2020-10-21 14:10:49', '2021-01-22 09:06:04', 6),
(79, '11', '42', 'TF11', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', '2021-01-29', '2021-01-30', 2, 'Intra-entreprise', 'Mediexperts', 'BURINTEL', 'NAWAL BENJELLON', 1, 6, 6, 0, 0, 7000, 14000, 'SEIZE MILLE HUIT CENTS', 'planifié', 6, 23, NULL, '2020-10-21 14:12:21', '2021-01-22 09:06:18', 6),
(80, '11', '62', 'TF12', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', '2021-01-05', '2021-01-06', 2, 'Intra-entreprise', 'Mediexperts', 'BURINTEL', 'NAWAL BENJELLON', 1, 6, 6, 0, 0, 7000, 14000, 'SEIZE MILLE HUIT CENTS', 'planifié', 6, 23, NULL, '2020-10-21 14:16:00', '2021-01-22 09:06:28', 6),
(81, '11', '43', 'TF13', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', '2021-02-11', '2021-02-13', 3, 'Intra-entreprise', 'Mediexperts', 'BURINTEL', 'NAWAL BENJELLON', 1, 6, 6, 0, 0, 7000, 21000, 'VINGT-CINQ MILLE DEUX CENTS', 'planifié', 6, 23, NULL, '2020-10-21 14:17:30', '2021-01-22 09:06:37', 6),
(82, '12', '64', 'TF14', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', '2021-02-18', '2021-02-20', 3, 'Intra-entreprise', 'Mediexperts', 'BURINTEL', 'NAWAL BENJELLON', 1, 6, 6, 0, 0, 7000, 21000, 'VINGT-CINQ MILLE DEUX CENTS', 'planifié', 6, 23, NULL, '2020-10-21 14:22:57', '2021-01-22 09:06:45', 6),
(83, '16', '63', 'TF15', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', '2021-02-25', '2021-02-27', 3, 'Intra-entreprise', 'Mediexperts', 'BURINTEL', 'NAWAL BENJELLON', 1, 6, 6, 0, 0, 7000, 21000, 'VINGT-CINQ MILLE DEUX CENTS', 'planifié', 6, 23, NULL, '2020-10-21 14:24:15', '2021-01-22 09:06:55', 6),
(84, '13', '50', 'TF1', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', '2020-11-19', '2020-11-26', 4, 'Intra-entreprise', 'Mediexperts', 'Sales Uplift', 'ADIL RAISS EL FENNI', 1, 5, 2, 3, 0, 8000, 32000, 'TRENTE-HUIT MILLE QUATRE CENTS', 'réalisé', 7, 24, 'A modifié l\'intervenant', '2020-10-22 05:57:10', '2021-01-22 08:55:31', 6),
(85, '10', '55', 'TF2', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', '2020-11-27', '2020-12-05', 5, 'Intra-entreprise', 'Mediexperts', 'Sales Uplift', 'ADIL RAISS EL FENNI', 1, 5, 2, 3, 0, 7500, 37500, 'QUARANTE-CINQ MILLE', 'réalisé', 7, 24, NULL, '2020-10-22 05:58:25', '2021-01-22 08:55:39', 6),
(86, '10', '41', 'TF3', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', '2020-12-10', '2020-12-18', 5, 'Intra-entreprise', 'Mediexperts', 'Sales Uplift', 'ADIL RAISS EL FENNI', 1, 5, 2, 3, 0, 7500, 37500, 'QUARANTE-CINQ MILLE', 'réalisé', 7, 24, NULL, '2020-10-22 05:59:21', '2021-01-22 08:55:47', 6),
(87, '11', '22', 'TF4', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', '2020-12-19', '2020-12-31', 5, 'Intra-entreprise', 'Mediexperts', 'Sales Uplift', 'ADIL RAISS EL FENNI', 1, 5, 2, 3, 0, 7000, 35000, 'QUARANTE-DEUX MILLE', 'réalisé', 7, 24, NULL, '2020-10-22 06:00:03', '2021-01-22 08:55:57', 6),
(88, '11', '42', 'TF5', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', '2021-01-02', '2021-01-08', 3, 'Intra-entreprise', 'Mediexperts', 'Sales Uplift', 'ADIL RAISS EL FENNI', 1, 5, 2, 3, 0, 7000, 21000, 'VINGT-CINQ MILLE DEUX CENTS', 'réalisé', 7, 24, NULL, '2020-10-22 06:01:04', '2021-01-22 08:56:16', 6),
(89, '12', '65', 'TF6', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', '2021-01-09', '2021-01-21', 5, 'Intra-entreprise', 'Mediexperts', 'Sales Uplift', 'ADIL RAISS EL FENNI', 1, 5, 2, 3, 0, 7000, 35000, 'QUARANTE-DEUX MILLE', 'réalisé', 7, 24, NULL, '2020-10-22 06:01:55', '2021-01-22 08:56:47', 6),
(90, '13', '66', 'TF1', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', '2020-11-19', '2020-11-21', 3, 'Intra-entreprise', 'Mediexperts', 'LES GRANDS MOULINS ZINE', 'Mounir BAZE', 1, 5, 5, 0, 0, 8000, 24000, 'VINGT-HUIT MILLE HUIT CENTS', 'planifié', 3, 25, 'A modifié l\'intervenant', '2020-10-22 13:44:04', '2020-12-28 15:39:45', NULL),
(91, '11', '42', 'TF2', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', '2020-11-26', '2020-12-05', 5, 'Intra-entreprise', 'Mediexperts', 'LES GRANDS MOULINS ZINE', 'Mounir BAZE', 1, 5, 5, 0, 0, 7000, 35000, 'QUARANTE-DEUX MILLE', 'planifié', 3, 25, NULL, '2020-10-22 13:44:58', '2020-12-28 15:40:38', NULL),
(92, '12', '67', 'TF3', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', '2020-12-10', '2020-12-12', 3, 'Intra-entreprise', 'Mediexperts', 'LES GRANDS MOULINS ZINE', 'Mounir BAZE', 1, 5, 5, 0, 0, 7000, 21000, 'VINGT-CINQ MILLE DEUX CENTS', 'planifié', 4, 25, NULL, '2020-10-22 13:46:17', '2020-12-28 15:41:26', NULL),
(93, '12', '68', 'TF4', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', '2020-12-17', '2020-12-19', 3, 'Intra-entreprise', 'Mediexperts', 'LES GRANDS MOULINS ZINE', 'Mounir BAZE', 1, 5, 5, 0, 0, 7000, 21000, 'VINGT-CINQ MILLE DEUX CENTS', 'planifié', 3, 25, NULL, '2020-10-22 13:47:03', '2020-12-28 15:42:03', NULL),
(94, '10', '21', 'TF5', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', '2020-12-24', '2020-12-26', 3, 'Intra-entreprise', 'Mediexperts', 'LES GRANDS MOULINS ZINE', 'Mounir BAZE', 1, 5, 5, 0, 0, 7500, 22500, 'VINGT-SEPT MILLE', 'planifié', 3, 25, NULL, '2020-10-22 13:48:10', '2020-12-28 15:43:14', NULL),
(96, '7', '69', 'TF1', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', '2020-11-19', '2020-11-28', 5, 'Intra-entreprise', 'Mediexperts', 'ZINE CEREALES', 'Mounir BAZE', 1, 5, 5, 0, 0, 6000, 30000, 'TRENTE-SIX MILLE', 'planifié', 9, 26, 'A modifié l\'intervenant', '2020-10-23 06:44:29', '2020-12-28 15:52:56', NULL),
(97, '9', '70', 'TF2', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', '2020-12-03', '2020-12-05', 3, 'Intra-entreprise', 'Mediexperts', 'ZINE CEREALES', 'Mounir BAZE', 1, 5, 5, 0, 0, 7000, 21000, 'VINGT-CINQ MILLE DEUX CENTS', 'planifié', 9, 26, NULL, '2020-10-23 06:45:17', '2020-12-28 15:53:29', NULL),
(98, '4', '71', 'TF3', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', '2020-12-10', '2020-12-12', 3, 'Intra-entreprise', 'Mediexperts', 'ZINE CEREALES', 'Mounir BAZE', 1, 5, 5, 0, 0, 7000, 21000, 'VINGT-CINQ MILLE DEUX CENTS', 'planifié', 9, 26, NULL, '2020-10-23 06:46:02', '2020-12-28 15:54:22', NULL),
(99, '8', '12', 'TF4', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', '2020-12-17', '2020-12-26', 5, 'Intra-entreprise', 'Mediexperts', 'ZINE CEREALES', 'Mounir BAZE', 1, 5, 5, 0, 0, 7000, 35000, 'QUARANTE-DEUX MILLE', 'planifié', 9, 26, NULL, '2020-10-23 06:47:07', '2020-12-28 15:55:13', NULL),
(100, '6', '72', 'TF5', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', '2021-01-07', '2021-01-09', 3, 'Intra-entreprise', 'Mediexperts', 'ZINE CEREALES', 'Mounir BAZE', 1, 5, 5, 0, 0, 7000, 21000, 'VINGT-CINQ MILLE DEUX CENTS', 'planifié', 9, 26, NULL, '2020-10-23 06:48:02', '2021-01-21 15:42:28', 6),
(101, '6', '79', 'TF6', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', '2021-01-14', '2021-01-16', 3, 'Intra-entreprise', 'Mediexperts', 'ZINE CEREALES', 'Mounir BAZE', 1, 5, 5, 0, 0, 7000, 21000, 'VINGT-CINQ MILLE DEUX CENTS', 'planifié', 9, 26, NULL, '2020-10-23 06:48:45', '2021-01-21 15:43:01', 6),
(102, '6', '73', 'TF7', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', '2021-01-21', '2021-01-28', 4, 'Intra-entreprise', 'Mediexperts', 'ZINE CEREALES', 'Mounir BAZE', 1, 5, 5, 0, 0, 7000, 28000, 'TRENTE-TROIS MILLE SIX CENTS', 'planifié', 9, 26, NULL, '2020-10-23 06:49:41', '2021-01-21 15:43:14', 6),
(103, '3', '74', 'TF8', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', '2021-01-29', '2021-02-05', 4, 'Intra-entreprise', 'Mediexperts', 'ZINE CEREALES', 'Mounir BAZE', 1, 5, 5, 0, 0, 7000, 28000, 'TRENTE-TROIS MILLE SIX CENTS', 'planifié', 9, 26, NULL, '2020-10-23 06:50:30', '2021-01-21 15:43:26', 6),
(104, '4', '20', 'TF1', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', '2020-11-19', '2020-11-28', 5, 'Intra-entreprise', 'Mediexperts', 'COMPLEXE ALIMENTAIRE ZINE', 'BAZE MOUNIR', 1, 5, 3, 2, 0, 7000, 35000, 'QUARANTE-DEUX MILLE', 'planifié', 11, 27, 'A modifié l\'intervenant', '2020-10-23 08:40:40', '2020-12-28 16:08:24', NULL),
(105, '9', '70', 'TF2', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', '2020-12-03', '2020-12-05', 3, 'Intra-entreprise', 'Mediexperts', 'COMPLEXE ALIMENTAIRE ZINE', 'BAZE MOUNIR', 1, 5, 3, 2, 0, 7000, 21000, 'VINGT-CINQ MILLE DEUX CENTS', 'planifié', 11, 27, NULL, '2020-10-23 08:41:31', '2020-12-28 16:09:07', NULL),
(106, '4', '10', 'TF3', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', '2020-12-10', '2020-12-12', 3, 'Intra-entreprise', 'Mediexperts', 'COMPLEXE ALIMENTAIRE ZINE', 'BAZE MOUNIR', 1, 5, 2, 3, 0, 7000, 21000, 'VINGT-CINQ MILLE DEUX CENTS', 'planifié', 11, 27, NULL, '2020-10-23 08:42:23', '2020-12-28 16:10:51', NULL),
(107, '6', '15', 'TF4', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', '2020-12-17', '2020-12-26', 5, 'Intra-entreprise', 'Mediexperts', 'COMPLEXE ALIMENTAIRE ZINE', 'BAZE MOUNIR', 1, 5, 5, 0, 0, 7000, 35000, 'QUARANTE-DEUX MILLE', 'planifié', 11, 27, NULL, '2020-10-23 08:43:14', '2020-12-28 16:12:08', NULL),
(108, '6', '72', 'TF5', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', '2021-01-07', '2021-01-09', 3, 'Intra-entreprise', 'Mediexperts', 'COMPLEXE ALIMENTAIRE ZINE', 'BAZE MOUNIR', 1, 5, 5, 0, 0, 7000, 21000, NULL, 'planifié', 11, 27, NULL, '2020-10-23 08:44:03', '2020-10-23 08:44:03', NULL),
(109, '6', '79', 'TF6', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', '2021-01-14', '2021-01-16', 3, 'Intra-entreprise', 'Mediexperts', 'COMPLEXE ALIMENTAIRE ZINE', 'BAZE MOUNIR', 1, 5, 5, 0, 0, 7000, 21000, NULL, 'planifié', 11, 27, NULL, '2020-10-23 08:44:53', '2020-10-23 08:44:53', NULL),
(110, '6', '73', 'TF7', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', '2021-01-21', '2021-01-23', 3, 'Intra-entreprise', 'Mediexperts', 'COMPLEXE ALIMENTAIRE ZINE', 'BAZE MOUNIR', 1, 5, 5, 0, 0, 7000, 21000, NULL, 'planifié', 11, 27, NULL, '2020-10-23 08:45:37', '2020-10-23 08:45:37', NULL),
(111, '3', '74', 'TF8', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', '2021-01-28', '2021-01-30', 3, 'Intra-entreprise', 'Mediexperts', 'COMPLEXE ALIMENTAIRE ZINE', 'BAZE MOUNIR', 1, 5, 5, 0, 0, 7000, 21000, NULL, 'planifié', 11, 27, NULL, '2020-10-23 08:46:16', '2020-10-23 08:46:16', NULL),
(112, '4', '75', 'TF1', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', '2020-11-19', '2020-11-28', 5, 'Intra-entreprise', 'Mediexperts', 'Biscuiterie Moderne Zine', 'MOUNIR BAZE', 1, 5, 5, 0, 0, 7000, 35000, 'QUARANTE-DEUX MILLE', 'planifié', 1, 28, NULL, '2020-10-23 09:49:01', '2020-12-29 08:47:42', NULL),
(113, '9', '77', 'TF2', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', '2020-12-03', '2020-12-05', 3, 'Intra-entreprise', 'Mediexperts', 'Biscuiterie Moderne Zine', 'MOUNIR BAZE', 1, 5, 3, 2, 0, 7000, 21000, 'VINGT-CINQ MILLE DEUX CENTS', 'planifié', 1, 28, NULL, '2020-10-23 09:49:52', '2020-12-29 08:48:41', NULL),
(114, '4', '10', 'TF3', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', '2020-12-10', '2020-12-12', 3, 'Intra-entreprise', 'Mediexperts', 'Biscuiterie Moderne Zine', 'MOUNIR BAZE', 1, 5, 3, 2, 0, 7000, 21000, 'VINGT-CINQ MILLE DEUX CENTS', 'planifié', 1, 28, NULL, '2020-10-23 09:50:44', '2020-12-29 08:49:31', NULL),
(115, '6', '78', 'TF4', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', '2020-12-17', '2020-12-26', 5, 'Intra-entreprise', 'Mediexperts', 'Biscuiterie Moderne Zine', 'MOUNIR BAZE', 1, 5, 5, 0, 0, 7000, 35000, 'QUARANTE-DEUX MILLE', 'planifié', 1, 28, NULL, '2020-10-23 09:51:39', '2020-12-29 08:50:14', NULL),
(116, '9', '70', 'TF5', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', '2020-12-31', '2021-01-09', 4, 'Intra-entreprise', 'Mediexperts', 'Biscuiterie Moderne Zine', 'MOUNIR BAZE', 1, 5, 5, 0, 0, 7000, 28000, 'TRENTE-TROIS MILLE SIX CENTS', 'planifié', 1, 28, NULL, '2020-10-23 09:52:50', '2021-01-21 15:18:52', 6),
(117, '6', '79', 'TF6', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', '2021-01-14', '2021-01-16', 3, 'Intra-entreprise', 'Mediexperts', 'Biscuiterie Moderne Zine', 'MOUNIR BAZE', 1, 5, 5, 0, 0, 7000, 21000, 'VINGT-CINQ MILLE DEUX CENTS', 'planifié', 1, 28, NULL, '2020-10-23 09:53:36', '2021-01-21 15:14:33', 6),
(118, '6', '73', 'TF7', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', '2021-01-21', '2021-01-23', 3, 'Intra-entreprise', 'Mediexperts', 'Biscuiterie Moderne Zine', 'MOUNIR BAZE', 1, 5, 5, 0, 0, 7000, 21000, 'VINGT-CINQ MILLE DEUX CENTS', 'planifié', 1, 28, NULL, '2020-10-23 09:54:24', '2021-01-21 15:14:47', 6),
(119, '3', '74', 'TF8', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', '2021-01-28', '2021-02-04', 4, 'Intra-entreprise', 'Mediexperts', 'Biscuiterie Moderne Zine', 'MOUNIR BAZE', 1, 5, 5, 0, 0, 7000, 28000, 'TRENTE-TROIS MILLE SIX CENTS', 'planifié', 1, 28, NULL, '2020-10-23 09:55:30', '2021-01-21 15:15:00', 6),
(120, '3', '80', 'TF9', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', '2021-02-05', '2021-02-13', 5, 'Intra-entreprise', 'Mediexperts', 'Biscuiterie Moderne Zine', 'MOUNIR BAZE', 1, 5, 5, 0, 0, 7000, 35000, 'QUARANTE-DEUX MILLE', 'planifié', 1, 28, NULL, '2020-10-23 09:57:39', '2021-01-21 15:15:13', 6),
(121, '4', '71', 'TF10', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', '2021-02-18', '2021-02-27', 5, 'Intra-entreprise', 'Mediexperts', 'Biscuiterie Moderne Zine', 'MOUNIR BAZE', 1, 5, 5, 0, 0, 7000, 35000, 'QUARANTE-DEUX MILLE', 'planifié', 1, 28, NULL, '2020-10-23 10:00:36', '2021-01-21 15:15:29', 6),
(122, '22', '76', 'TF11', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', '2021-03-04', '2021-03-06', 3, 'Intra-entreprise', 'Mediexperts', 'Biscuiterie Moderne Zine', 'MOUNIR BAZE', 1, 5, 5, 0, 0, 6000, 18000, 'VINGT-ET-UN MILLE SIX CENTS', 'planifié', 1, 28, NULL, '2020-10-23 10:01:18', '2021-01-21 15:15:41', 6),
(123, '3', '82', 'TF1', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', '2020-11-19', '2020-11-28', 5, 'Intra-entreprise', 'Mediexperts', 'LES GRANDES SEMOULERIES ZINE', 'BAZE MOUNIR', 1, 5, 5, 0, 0, 7000, 35000, 'QUARANTE-DEUX MILLE', 'planifié', 2, 29, 'A modifié l\'intervenant', '2020-10-23 10:20:27', '2020-12-29 07:32:28', NULL),
(124, '23', '83', 'TF2', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', '2020-12-03', '2020-12-05', 3, 'Intra-entreprise', 'Mediexperts', 'LES GRANDES SEMOULERIES ZINE', 'BAZE MOUNIR', 1, 5, 2, 3, 0, 7000, 21000, 'VINGT-CINQ MILLE DEUX CENTS', 'planifié', 2, 29, NULL, '2020-10-23 10:23:06', '2020-12-29 07:33:24', NULL),
(125, '6', '81', 'TF3', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', '2020-12-10', '2020-12-12', 3, 'Intra-entreprise', 'Mediexperts', 'LES GRANDES SEMOULERIES ZINE', 'BAZE MOUNIR', 1, 5, 5, 0, 0, 7000, 21000, 'VINGT-CINQ MILLE DEUX CENTS', 'planifié', 2, 29, NULL, '2020-10-23 10:23:45', '2020-12-29 07:33:54', NULL),
(126, '6', '15', 'TF4', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', '2020-12-17', '2020-12-26', 5, 'Intra-entreprise', 'Mediexperts', 'LES GRANDES SEMOULERIES ZINE', 'BAZE MOUNIR', 1, 5, 5, 0, 0, 7000, 35000, 'QUARANTE-DEUX MILLE', 'planifié', 2, 29, NULL, '2020-10-23 10:24:36', '2020-12-29 07:34:31', NULL),
(127, '6', '72', 'TF5', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', '2021-01-07', '2021-01-09', 3, 'Intra-entreprise', 'Mediexperts', 'LES GRANDES SEMOULERIES ZINE', 'BAZE MOUNIR', 1, 5, 5, 0, 0, 7000, 21000, 'VINGT-CINQ MILLE DEUX CENTS', 'planifié', 1, 29, NULL, '2020-10-23 10:25:17', '2021-01-22 08:28:58', 6),
(128, '6', '79', 'TF6', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', '2021-01-14', '2021-01-16', 3, 'Intra-entreprise', 'Mediexperts', 'LES GRANDES SEMOULERIES ZINE', 'BAZE MOUNIR', 1, 5, 5, 0, 0, 7000, 21000, 'VINGT-CINQ MILLE DEUX CENTS', 'planifié', 2, 29, NULL, '2020-10-23 10:26:10', '2021-01-22 08:29:20', 6),
(129, '6', '73', 'TF7', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', '2021-01-21', '2021-01-23', 3, 'Intra-entreprise', 'Mediexperts', 'LES GRANDES SEMOULERIES ZINE', 'BAZE MOUNIR', 1, 5, 5, 0, 0, 7000, 21000, 'VINGT-CINQ MILLE DEUX CENTS', 'planifié', 2, 29, NULL, '2020-10-23 10:26:55', '2021-01-22 08:29:32', 6),
(130, '3', '74', 'TF8', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', '2021-01-28', '2021-01-30', 3, 'Intra-entreprise', 'Mediexperts', 'LES GRANDES SEMOULERIES ZINE', 'BAZE MOUNIR', 1, 5, 5, 0, 0, 7000, 21000, 'VINGT-CINQ MILLE DEUX CENTS', 'planifié', 2, 29, NULL, '2020-10-23 10:27:33', '2021-01-22 08:30:05', 6),
(131, '10', '84', 'TF1', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', '2020-11-19', '2020-11-28', 6, 'Intra-entreprise', 'Mediexperts', 'CANAL FOOD', 'Mounir BAZE', 1, 5, 5, 0, 0, 7500, 45000, 'CINQUANTE-QUATRE MILLE', 'planifié', 7, 30, 'A modifié l\'intervenant', '2020-10-23 12:14:56', '2020-12-28 15:11:33', NULL),
(132, '10', '55', 'TF2', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', '2020-12-03', '2020-12-12', 6, 'Intra-entreprise', 'Mediexperts', 'CANAL FOOD', 'Mounir BAZE', 1, 5, 5, 0, 0, 7500, 45000, 'CINQUANTE-QUATRE MILLE', 'planifié', 7, 30, NULL, '2020-10-23 12:15:47', '2020-12-28 15:17:00', NULL),
(133, '20', '52', 'TF3', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', '2020-12-17', '2020-12-19', 3, 'Intra-entreprise', 'Mediexperts', 'CANAL FOOD', 'Mounir BAZE', 1, 5, 5, 0, 0, 7000, 21000, 'VINGT-CINQ MILLE DEUX CENTS', 'planifié', 7, 30, NULL, '2020-10-23 12:16:35', '2020-12-28 15:13:04', NULL),
(134, '12', '85', 'TF4', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', '2020-12-24', '2020-12-26', 3, 'Intra-entreprise', 'Mediexperts', 'CANAL FOOD', 'Mounir BAZE', 1, 5, 5, 0, 0, 7000, 21000, 'VINGT-CINQ MILLE DEUX CENTS', 'planifié', 7, 30, NULL, '2020-10-23 12:19:32', '2020-12-28 15:13:31', NULL),
(135, '12', '64', 'TF5', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', '2021-01-07', '2021-01-16', 6, 'Intra-entreprise', 'Mediexperts', 'CANAL FOOD', 'Mounir BAZE', 1, 5, 5, 0, 0, 7000, 42000, 'CINQUANTE MILLE QUATRE CENTS', 'planifié', 7, 30, NULL, '2020-10-23 12:21:07', '2021-01-21 11:20:03', 6),
(136, '12', '67', 'TF6', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', '2021-01-21', '2021-01-30', 6, 'Intra-entreprise', 'Mediexperts', 'CANAL FOOD', 'Mounir BAZE', 1, 5, 5, 0, 0, 7000, 42000, 'CINQUANTE MILLE QUATRE CENTS', 'planifié', 7, 30, NULL, '2020-10-23 12:21:49', '2021-01-21 11:20:14', 6),
(137, '12', '86', 'TF7', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', '2021-02-04', '2021-02-06', 3, 'Intra-entreprise', 'Mediexperts', 'CANAL FOOD', 'Mounir BAZE', 1, 5, 5, 0, 0, 7000, 21000, 'VINGT-CINQ MILLE DEUX CENTS', 'planifié', 7, 30, NULL, '2020-10-23 12:24:14', '2021-01-21 11:20:30', 6),
(138, '12', '68', 'TF8', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', '2021-02-11', '2021-02-13', 3, 'Intra-entreprise', 'Mediexperts', 'CANAL FOOD', 'Mounir BAZE', 1, 5, 5, 0, 0, 7000, 21000, 'VINGT-CINQ MILLE DEUX CENTS', 'planifié', 7, 30, NULL, '2020-10-23 12:25:22', '2021-01-21 11:20:43', 6),
(139, '24', '87', 'TF9', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', '2021-02-18', '2021-02-20', 3, 'Intra-entreprise', 'Mediexperts', 'CANAL FOOD', 'Mounir BAZE', 1, 5, 5, 0, 0, 5000, 15000, 'DIX-HUIT MILLE', 'planifié', 7, 30, NULL, '2020-10-23 12:29:20', '2021-01-21 11:21:32', 6),
(140, '19', '88', 'TF10', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', '2021-02-25', '2021-03-04', 4, 'Intra-entreprise', 'Mediexperts', 'CANAL FOOD', 'Mounir BAZE', 1, 5, 5, 0, 0, 7000, 28000, 'TRENTE-TROIS MILLE SIX CENTS', 'planifié', 7, 30, NULL, '2020-10-23 12:31:22', '2021-01-21 11:22:58', 6),
(141, '15', '89', 'TF1', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', '2020-11-19', '2020-11-26', 4, 'Intra-entreprise', 'Mediexperts', 'TRANSDINE', 'Mounir BAZE', 1, 5, 5, 0, 0, 7000, 28000, 'TRENTE-TROIS MILLE SIX CENTS', 'planifié', 1, 31, 'A modifié l\'intervenant', '2020-10-23 14:21:12', '2020-12-28 14:52:44', NULL),
(142, '15', '90', 'TF2', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', '2020-11-27', '2020-12-04', 4, 'Intra-entreprise', 'Mediexperts', 'TRANSDINE', 'Mounir baze', 1, 5, 5, 0, 0, 7000, 28000, 'TRENTE-TROIS MILLE SIX CENTS', 'planifié', 1, 31, NULL, '2020-10-23 14:21:54', '2020-12-28 14:54:00', NULL),
(143, '15', '91', 'TF3', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', '2020-12-05', '2020-12-12', 4, 'Intra-entreprise', 'Mediexperts', 'TRANSDINE', 'Mounir baze', 1, 5, 5, 0, 0, 7000, 28000, 'TRENTE-TROIS MILLE SIX CENTS', 'planifié', 1, 31, NULL, '2020-10-23 14:22:35', '2020-12-28 14:54:58', NULL),
(144, '15', '92', 'TF4', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', '2020-12-17', '2020-12-24', 4, 'Intra-entreprise', 'Mediexperts', 'TRANSDINE', 'Mounir baze', 1, 5, 5, 0, 0, 7000, 28000, 'TRENTE-TROIS MILLE SIX CENTS', 'planifié', 1, 31, NULL, '2020-10-23 14:23:19', '2020-12-28 14:55:45', NULL),
(145, '15', '93', 'TF5', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', '2020-12-25', '2021-01-07', 4, 'Intra-entreprise', 'Mediexperts', 'TRANSDINE', 'Mounir baze', 1, 5, 5, 0, 0, 7000, 28000, 'TRENTE-TROIS MILLE SIX CENTS', 'planifié', 1, 31, NULL, '2020-10-23 14:24:08', '2021-01-21 10:46:11', 6),
(146, '15', '94', 'TF6', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', '2021-01-08', '2021-01-16', 4, 'Intra-entreprise', 'Mediexperts', 'TRANSDINE', 'Mounir baze', 1, 5, 5, 0, 0, 7000, 28000, 'TRENTE-TROIS MILLE SIX CENTS', 'planifié', 1, 31, NULL, '2020-10-23 14:24:47', '2021-01-21 10:47:00', 6),
(147, '15', '95', 'TF7', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', '2021-01-21', '2021-01-30', 6, 'Intra-entreprise', 'Mediexperts', 'TRANSDINE', 'Mounir baze', 1, 5, 5, 0, 0, 7000, 42000, 'CINQUANTE MILLE QUATRE CENTS', 'planifié', 1, 31, NULL, '2020-10-23 14:25:36', '2021-01-21 10:47:15', 6),
(148, '15', '96', 'TF8', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', '2021-02-04', '2021-02-13', 6, 'Intra-entreprise', 'Mediexperts', 'TRANSDINE', 'Mounir baze', 1, 5, 5, 0, 0, 7000, 42000, 'CINQUANTE MILLE QUATRE CENTS', 'planifié', 1, 31, NULL, '2020-10-23 14:26:22', '2021-01-21 10:47:32', 6),
(149, '15', '98', 'TF9', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', '2021-02-18', '2021-02-27', 6, 'Intra-entreprise', 'Mediexperts', 'TRANSDINE', 'Mounir baze', 1, 5, 5, 0, 0, 7000, 42000, 'CINQUANTE MILLE QUATRE CENTS', 'planifié', 1, 31, NULL, '2020-10-23 14:29:06', '2021-01-21 10:47:57', 6),
(150, '15', '97', 'TF10', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', '2021-03-04', '2021-03-13', 6, 'Intra-entreprise', 'Mediexperts', 'TRANSDINE', 'Mounir baze', 1, 5, 5, 0, 0, 7000, 42000, 'CINQUANTE MILLE QUATRE CENTS', 'planifié', 1, 31, NULL, '2020-10-23 14:29:56', '2021-01-21 10:48:12', 6),
(151, '26', '99', 'TF1', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', '2020-11-19', '2020-11-20', 2, 'Intra-entreprise', 'Mediexperts', 'Leader Food', 'Ahmed BOUDRAA', 1, 6, 6, 0, 0, 5000, 10000, 'DOUZE MILLE', 'réalisé', 1, 32, 'A modifé l\'intervenant', '2020-11-02 07:43:41', '2021-01-22 09:27:36', 6),
(152, '14', '128', 'TF2', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', '2020-11-21', '2020-11-26', 2, 'Intra-entreprise', 'Mediexperts', 'Leader Food', 'Ahmed BOUDRAA', 1, 5, 0, 5, 0, 7000, 14000, 'SEIZE MILLE HUIT CENTS', 'réalisé', 1, 32, NULL, '2020-11-02 07:45:15', '2021-01-22 09:27:42', 6),
(153, '16', '101', 'TF3', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', '2020-11-27', '2020-11-28', 2, 'Intra-entreprise', 'Mediexperts', 'Leader Food', 'Ahmed BOUDRAA', 1, 5, 5, 0, 0, 7000, 14000, 'SEIZE MILLE HUIT CENTS', 'réalisé', 1, 32, NULL, '2020-11-02 07:46:08', '2021-01-22 09:27:49', 6),
(154, '28', '102', 'TF4', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', '2020-12-03', '2020-12-03', 1, 'Intra-entreprise', 'Mediexperts', 'Leader Food', 'Ahmed BOUDRAA', 1, 6, 6, 0, 0, 7000, 7000, 'HUIT MILLE QUATRE CENTS', 'réalisé', 1, 32, NULL, '2020-11-02 07:47:17', '2021-01-22 09:27:56', 6);
INSERT INTO `plan_formations` (`n_form`, `id_dom`, `id_thm`, `n_action`, `model5`, `model3`, `f4`, `fiche_eval`, `support_form`, `cv_inv`, `avis_affich`, `dt_debut`, `dt_fin`, `nb_jour`, `type_form`, `organisme`, `lieu`, `nom_resp`, `nb_grp`, `nb_partcp_total`, `nb_cadre`, `nb_employe`, `nb_ouvrier`, `bdg_jour`, `bdg_total`, `bdg_letter`, `etat`, `id_inv`, `id_plan`, `commentaire`, `created_at`, `updated_at`, `nb_heure`) VALUES
(155, '31', '103', 'TF5', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', '2020-12-05', '2020-12-11', 3, 'Intra-entreprise', 'Mediexperts', 'Leader Food', 'Ahmed BOUDRAA', 1, 6, 6, 0, 0, 7000, 21000, 'VINGT-CINQ MILLE DEUX CENTS', 'réalisé', 1, 32, NULL, '2020-11-02 07:48:10', '2021-01-22 09:28:03', 6),
(156, '11', '104', 'TF6', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', '2020-12-12', '2020-12-12', 1, 'Intra-entreprise', 'Mediexperts', 'Leader Food', 'Ahmed BOUDRAA', 1, 6, 6, 0, 0, 7000, 7000, 'HUIT MILLE QUATRE CENTS', 'réalisé', 1, 32, NULL, '2020-11-02 07:49:03', '2021-01-22 09:28:10', 6),
(157, '11', '105', 'TF7', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', '2020-12-17', '2020-12-17', 1, 'Intra-entreprise', 'Mediexperts', 'Leader Food', 'Ahmed BOUDRAA', 1, 6, 6, 0, 0, 7000, 7000, 'HUIT MILLE QUATRE CENTS', 'réalisé', 1, 32, NULL, '2020-11-02 07:53:25', '2021-01-22 09:28:20', 6),
(158, '14', '129', 'TF8', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', '2020-12-18', '2020-12-18', 1, 'Intra-entreprise', 'Mediexperts', 'Leader Food', 'Ahmed BOUDRAA', 1, 5, 0, 5, 0, 7000, 7000, 'HUIT MILLE QUATRE CENTS', 'réalisé', 1, 32, NULL, '2020-11-02 07:54:33', '2021-01-22 09:28:28', 6),
(159, '14', '106', 'TF9', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', '2020-12-19', '2020-12-19', 1, 'Intra-entreprise', 'Mediexperts', 'Leader Food', 'Ahmed BOUDRAA', 1, 5, 0, 5, 0, 7000, 7000, 'HUIT MILLE QUATRE CENTS', 'réalisé', 1, 32, NULL, '2020-11-02 07:55:45', '2021-01-22 09:28:39', 6),
(160, '14', '107', 'TF10', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', '2020-12-24', '2020-12-24', 1, 'Intra-entreprise', 'Mediexperts', 'Leader Food', 'Ahmed BOUDRAA', 1, 6, 6, 0, 0, 7000, 7000, 'HUIT MILLE QUATRE CENTS', 'réalisé', 1, 32, NULL, '2020-11-02 07:56:51', '2021-01-22 09:28:47', 6),
(161, '20', '47', 'TF11', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', '2020-12-25', '2020-12-31', 3, 'Intra-entreprise', 'Mediexperts', 'Leader Food', 'Ahmed BOUDRAA', 1, 5, 0, 5, 0, 7000, 21000, 'VINGT-CINQ MILLE DEUX CENTS', 'réalisé', 1, 32, NULL, '2020-11-02 07:58:04', '2021-01-22 09:28:54', 6),
(162, '20', '109', 'TF12', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', '2021-01-07', '2021-01-07', 1, 'Intra-entreprise', 'Mediexperts', 'Leader Food', 'Ahmed BOUDRAA', 1, 6, 0, 6, 0, 7000, 7000, 'HUIT MILLE QUATRE CENTS', 'réalisé', 1, 32, NULL, '2020-11-02 07:59:47', '2021-01-22 09:29:03', 6),
(163, '29', '110', 'TF13', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', '2021-01-08', '2021-01-08', 1, 'Intra-entreprise', 'Mediexperts', 'Leader Food', 'Ahmed BOUDRAA', 1, 6, 2, 4, 0, 7000, 7000, 'HUIT MILLE QUATRE CENTS', 'réalisé', 1, 32, NULL, '2020-11-02 08:01:21', '2021-01-22 09:29:12', 6),
(164, '26', '111', 'TF14', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', '2021-01-09', '2021-01-09', 1, 'Intra-entreprise', 'Mediexperts', 'Leader Food', 'Ahmed BOUDRAA', 1, 6, 0, 6, 0, 5000, 5000, 'SIX MILLE', 'réalisé', 1, 32, NULL, '2020-11-02 08:02:13', '2021-01-22 09:26:14', 6),
(165, '25', '112', 'TF15', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', '2021-01-14', '2021-01-15', 2, 'Intra-entreprise', 'Mediexperts', 'Leader Food', 'Ahmed BOUDRAA', 1, 6, 6, 0, 0, 7000, 14000, 'SEIZE MILLE HUIT CENTS', 'réalisé', 1, 32, NULL, '2020-11-02 08:03:12', '2021-01-22 09:26:25', 6),
(166, '20', '113', 'TF16', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', '2021-01-16', '2021-01-22', 3, 'Intra-entreprise', 'Mediexperts', 'Leader Food', 'Ahmed BOUDRAA', 1, 5, 0, 5, 0, 7000, 21000, 'VINGT-CINQ MILLE DEUX CENTS', 'réalisé', 1, 32, NULL, '2020-11-02 08:04:28', '2021-01-22 09:26:39', 6),
(167, '26', '115', 'TF17', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', '2021-01-29', '2021-01-30', 2, 'Intra-entreprise', 'Mediexperts', 'Leader Food', 'Ahmed BOUDRAA', 1, 6, 3, 3, 0, 5000, 10000, 'DOUZE MILLE', 'planifié', 1, 32, NULL, '2020-11-02 08:05:28', '2021-01-22 09:26:49', 6),
(168, '14', '114', 'TF18', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', '2021-02-05', '2021-02-11', 3, 'Intra-entreprise', 'Mediexperts', 'Leader Food', 'Ahmed BOUDRAA', 1, 5, 0, 5, 0, 7000, 21000, 'VINGT-CINQ MILLE DEUX CENTS', 'planifié', 1, 32, NULL, '2020-11-02 08:06:15', '2021-01-22 09:26:59', 6),
(169, '10', '108', 'TF19', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', '2021-02-12', '2021-02-13', 2, 'Intra-entreprise', 'Mediexperts', 'Leader Food', 'Ahmed BOUDRAA', 1, 6, 6, 0, 0, 7500, 15000, 'DIX-HUIT MILLE', 'planifié', 1, 32, NULL, '2020-11-02 08:07:09', '2021-01-22 09:27:12', 6),
(186, '10', '119', 'TF1', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', '2019-10-15', '2019-10-16', 2, 'Intra-entreprise', 'Mediexperts', 'Hava Hard Trade', 'Belaid OUJANA', 1, 5, 5, 0, 0, 7500, 15000, 'quinze mille', 'annulé', 1, 33, NULL, '2020-11-11 06:32:47', '2020-12-11 08:13:55', NULL),
(187, '11', '30', 'TF2', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'préparé', 'non préparé', '2019-10-22', '2019-10-22', 1, 'Intra-entreprise', 'Mediexperts', 'Hava Hard Trade', 'Belaid OUJANA', 1, 5, 5, 0, 0, 7000, 7000, 'sept mille', 'annulé', 18, 33, 'Réalisée par le cabinet VALUE', '2020-11-11 06:34:20', '2020-12-11 08:14:24', NULL),
(189, '19', '120', 'TF3', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'préparé', 'non préparé', '2019-10-23', '2019-10-23', 1, 'Intra-entreprise', 'Mediexperts', 'Hava Hard Trade', 'Belaid OUJANA', 1, 9, 2, 7, 0, 7000, 7000, 'sept mille', 'annulé', 18, 33, 'Réalisée par le cabinet VALUE', '2020-11-11 06:53:22', '2020-12-11 08:14:37', NULL),
(190, '10', '121', 'TF4', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'préparé', 'non préparé', '2019-10-29', '2019-10-30', 2, 'Intra-entreprise', 'Mediexperts', 'Hava Hard Trade', 'Belaid OUJANA', 1, 5, 5, 0, 0, 7500, 15000, 'quinze mille', 'annulé', 1, 33, 'Réalisée par le cabinet VALUE, le cout retenu est 14000 (7000/jour)', '2020-11-11 07:24:44', '2020-12-11 08:14:55', NULL),
(191, '10', '32', 'TF5', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'préparé', 'non préparé', '2019-11-04', '2019-11-05', 2, 'Intra-entreprise', 'Mediexperts', 'Hava Hard Trade', 'Belaid OUJANA', 1, 5, 5, 0, 0, 7500, 15000, 'quinze mille', 'annulé', 1, 33, 'Réalisée par le cabinet Value, le cout retenu est 14000 (7000/jour)', '2020-11-11 07:50:16', '2020-12-11 08:15:10', NULL),
(192, '11', '122', 'TF6', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'préparé', 'non préparé', '2019-11-19', '2019-11-20', 2, 'Intra-entreprise', 'Mediexperts', 'Hava Hard Trade', 'Belaid OUJANA', 1, 5, 2, 3, 0, 7000, 14000, 'quatorze mille', 'annulé', 6, 33, 'Réalisée par le cabinet Value', '2020-11-11 07:55:03', '2020-12-11 08:15:23', NULL),
(193, '16', '123', 'TF1', 'préparé', 'non préparé', 'préparé', 'non préparé', 'non préparé', 'préparé', 'non préparé', '2019-10-14', '2019-10-21', 6, 'Intra-entreprise', 'Mediexperts', 'SYSTEMS ADVISERS GROUP', 'MOURAD JBIHA', 1, 10, 10, 0, 0, 7000, 42000, 'cinquante mille quatre cents', 'réalisé', 6, 34, NULL, '2020-11-23 12:08:16', '2020-11-23 12:08:16', NULL),
(199, '16', '31', 'TF3', 'préparé', 'non préparé', 'préparé', 'non préparé', 'non préparé', 'préparé', 'non préparé', '2019-10-22', '2019-10-29', 6, 'Intra-entreprise', 'Mediexperts', 'SYSTEMS ADVISERS GROUP', 'MOURAD JBIHA', 1, 6, 6, 0, 0, 7000, 42000, 'cinquante mille quatre cents', 'réalisé', 6, 34, NULL, '2020-11-23 13:26:49', '2020-11-23 13:26:49', NULL),
(202, '13', '125', 'TF3', 'préparé', 'non préparé', 'préparé', 'non préparé', 'non préparé', 'préparé', 'non préparé', '2019-10-30', '2019-11-07', 6, 'Intra-entreprise', 'Mediexperts', 'SYSTEMS ADVISERS GROUP', 'MOURAD JBIHA', 1, 5, 5, 0, 0, 8000, 48000, 'cinquante-sept mille six cents', 'réalisé', 8, 34, NULL, '2020-11-23 13:59:13', '2020-11-23 14:34:39', NULL),
(203, '13', '126', 'TF4', 'préparé', 'non préparé', 'préparé', 'non préparé', 'non préparé', 'préparé', 'non préparé', '2019-11-08', '2019-11-15', 6, 'Intra-entreprise', 'Mediexperts', 'SYSTEMS ADVISERS GROUP', 'MOURAD JBIHA', 1, 5, 5, 0, 0, 8000, 48000, 'CINQUANTE-SEPT MILLE SIX CENTS', 'réalisé', 8, 34, NULL, '2020-11-23 14:39:46', '2020-11-23 14:39:46', NULL),
(204, '10', '55', 'TF5', 'préparé', 'non préparé', 'préparé', 'non préparé', 'préparé', 'préparé', 'non préparé', '2019-11-19', '2019-11-26', 6, 'Intra-entreprise', 'Mediexperts', 'SYSTEMS ADVISERS GROUP', 'MOURAD JBIHA', 1, 6, 6, 0, 0, 7500, 45000, 'CINQUANTE-QUATRE MILLE', 'réalisé', 1, 34, NULL, '2020-11-23 14:41:46', '2020-11-23 14:41:46', NULL),
(210, '17', '35', 'TF1', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', '2010-01-01', '2010-01-03', 3, 'Intra-entreprise', 'Mediexperts', 'TEST ENTREPRISE', 'Ahmed Karim', 3, 10, 5, 0, 0, 1000, 6000, 'QUATRE MILLE DEUX CENTS', 'réalisé', 5, 10, NULL, '2020-11-24 07:59:09', '2020-12-30 14:03:09', 12),
(211, '18', '127', 'TF6', 'préparé', 'préparé', 'préparé', 'non préparé', 'non préparé', 'préparé', 'non préparé', '2019-11-26', '2019-12-31', 6, 'Intra-entreprise', 'Mediexperts', 'SYSTEMS ADVISERS GROUP', 'MOURAD JBIHA', 1, 10, 6, 4, 0, 5000, 30000, 'TRENTE-SIX MILLE', 'réalisé', 16, 34, NULL, '2020-11-24 08:48:26', '2020-11-24 08:48:26', NULL),
(212, '18', '124', 'TF7', 'préparé', 'préparé', 'préparé', 'non préparé', 'non préparé', 'préparé', 'non préparé', '2019-11-26', '2019-12-31', 9, 'Intra-entreprise', 'Mediexperts', 'SYSTEMS ADVISERS GROUP', 'MOURAD JBIHA', 1, 15, 11, 4, 0, 5000, 45000, 'CINQUANTE-QUATRE MILLE', 'réalisé', 15, 34, NULL, '2020-11-24 08:50:44', '2020-11-24 08:50:44', NULL),
(213, '17', '35', 'TF1', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', '2020-12-04', '2020-12-06', 2, 'Intra-entreprise', 'Mediexperts', 'TEST ENTREPRISE', 'Ahmed Karim', 1, 12, 6, 6, 0, 1000, 2000, 'DEUX MILLE QUATRE CENTS', 'planifié', 5, 18, NULL, '2020-12-02 10:32:41', '2020-12-02 13:26:43', NULL),
(214, '10', '131', 'TF7', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', '2019-12-03', '2019-12-03', 1, 'Intra-entreprise', 'Mediexperts', 'Hava Hard Trade', 'Belaid OUJANA', 1, 9, 4, 5, 0, 7500, 7500, 'NEUF MILLE', 'réalisé', 18, 33, NULL, '2020-12-11 10:10:46', '2020-12-24 11:07:18', NULL),
(215, '11', '132', 'TF8', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', '2019-12-10', '2019-12-10', 1, 'Intra-entreprise', 'Mediexperts', 'Hava Hard Trade', 'Belaid OUJANA', 1, 5, 4, 1, 0, 7000, 7000, 'HUIT MILLE QUATRE CENTS', 'réalisé', 18, 33, NULL, '2020-12-11 10:18:23', '2020-12-11 10:18:23', NULL),
(216, '14', '130', 'TF9', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', '2019-12-11', '2019-12-11', 1, 'Intra-entreprise', 'Mediexperts', 'Hava Hard Trade', 'Belaid OUJANA', 1, 9, 4, 5, 0, 7000, 7000, 'HUIT MILLE QUATRE CENTS', 'réalisé', 18, 33, NULL, '2020-12-11 10:25:49', '2020-12-24 11:07:39', NULL),
(217, '10', '133', 'TF10', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', '2019-12-13', '2019-12-13', 1, 'Intra-entreprise', 'Mediexperts', 'Hava Hard Trade', 'Belaid OUJANA', 1, 9, 4, 5, 0, 7500, 7500, 'NEUF MILLE', 'réalisé', 18, 33, NULL, '2020-12-11 10:34:08', '2020-12-24 11:07:55', NULL),
(218, '15', '134', 'TF11', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', '2019-12-17', '2019-12-18', 2, 'Intra-entreprise', 'Mediexperts', 'Hava Hard Trade', 'Belaid OUJANA', 1, 5, 4, 1, 0, 7000, 14000, 'SEIZE MILLE HUIT CENTS', 'réalisé', 17, 33, NULL, '2020-12-11 10:39:11', '2020-12-24 11:07:03', NULL),
(219, '11', '135', 'TF12', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', '2019-12-20', '2019-12-20', 1, 'Intra-entreprise', 'Mediexperts', 'Hava Hard Trade', 'Belaid OUJANA', 1, 5, 4, 1, 0, 7000, 7000, 'HUIT MILLE QUATRE CENTS', 'réalisé', 18, 33, NULL, '2020-12-11 10:46:27', '2020-12-11 10:46:27', NULL),
(220, '11', '136', 'TF13', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', '2019-12-24', '2019-12-25', 2, 'Intra-entreprise', 'Mediexperts', 'Hava Hard Trade', 'Belaid OUJANA', 1, 5, 4, 1, 0, 7000, 14000, 'SEIZE MILLE HUIT CENTS', 'réalisé', 18, 33, NULL, '2020-12-11 10:54:45', '2020-12-11 10:54:45', NULL),
(221, '17', '35', 'TF2', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', 'non préparé', '2020-12-29', '2020-12-31', 5, 'Intra-entreprise', 'Mediexperts', 'TEST ENTREPRISE', 'Ahmed Karim', 1, 5, 5, 0, 0, 1000, 5000, 'SIX MILLE', 'planifié', 1, 10, NULL, '2020-12-29 13:02:21', '2020-12-29 13:05:32', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `themes`
--

CREATE TABLE `themes` (
  `id_theme` bigint(20) UNSIGNED NOT NULL,
  `nom_theme` varchar(300) COLLATE utf8mb4_unicode_ci NOT NULL,
  `objectif` varchar(5000) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contenu` varchar(5000) COLLATE utf8mb4_unicode_ci NOT NULL,
  `commentaire` varchar(5000) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id_dom` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `themes`
--

INSERT INTO `themes` (`id_theme`, `nom_theme`, `objectif`, `contenu`, `commentaire`, `id_dom`, `created_at`, `updated_at`) VALUES
(4, 'Management des équipes', '- Repérer les grandes missions du manager\r\n- Comprendre comment responsabiliser ses collaborateurs pour améliorer la performance de l’équipe', '- Identifier les 2 rôles essentiels du manager pour atteindre la performance\r\n*Cadrer l’activité\r\n*Accompagner et suivre ses collaborateurs et l’équipe\r\n- Responsabiliser ses collaborateurs\r\n*Impliquer les collaborateurs dans les décisions opérationnelles qui les concernent\r\n*Déléguer tâches, responsabilités et projets pour soutenir la motivation\r\n- Adapter son management aux collaborateurs pour entraîner l’adhésion\r\n* Repérer les besoins de ses collaborateurs pour adapter son management\r\n*Définir une stratégie d’accompagnement et un plan d’actions pour répondre aux besoins détectés\r\n-Instaurer la confiance pour faciliter cohésion de l’équipe et atteinte des résultats\r\n*Développer les compétences collectives de l’équipe\r\n*Encourager et organiser le partage des bonnes pratiques', NULL, 3, '2020-08-04 04:36:49', '2020-08-04 04:36:49'),
(5, 'Santé et sécurité au travail SST', '- Identifier et respecter les exigences essentielles pour suivre sereinement son activité\r\n- Faire le point sur l\'actualité réglementaire incontournable\r\n- Organiser sa gestion de la sécurité et santé au travail pour l\'ensemble des risques', '- Comprendre la réglementation sécurité et santé au travail\r\n*Identifier les sources de droit\r\n*Appréhender l\'articulation des textes réglementaires\r\n*La délégation de pouvoir, la responsabilité civile et pénale\r\n- Identifier les principales obligations réglementaires et les dernières exigences\r\n*Obligation générale de prévention\r\n*Obligation de résultat pour l\'employeur et ses délégataires\r\n*Évaluation des risques professionnels et Document Unique\r\n- Appliquer les obligations\r\n- Système de gestion de la sécurité et la santé au travail\r\n*Les différentes étapes de la mise en place d\'un système de management santé-sécurité\r\n*Lien entre le Code du Travail et le système de management SST\r\n*Le Document Unique et la démarche de management de la sécurité et santé au travail', NULL, 4, '2020-08-04 06:30:18', '2020-08-04 06:30:18'),
(6, 'Lean manufacturing et six sigma', '- S\'approprier les concepts du Lean Management.\r\n- Associer Lean Management et Six Sigma dans les services.\r\n- Construire et piloter une démarche Lean 6 Sigma dans l\'entreprise', 'A-  Les méthodes de management Lean\r\n- Le value stream mapping, pour définir les priorités.\r\n- La résolution de problème, pour ne rien oublier\r\n- Le 5S, pour apprendre à manager l\'amélioration continue\r\nB- Déployer le Lean 6 Sigma\r\n-Le management visuel, pour impliquer les acteurs.\r\n-Le brainstorming pour innove\r\n-La communication associée, adapter les mots à la culture.\r\n-Le reporting, le ROI, le factuel pour convaincre.', NULL, 4, '2020-09-16 05:34:17', '2020-09-16 05:34:17'),
(7, 'TEST THÈME', 'Lorem Ipsum er ganske enkelt fyldtekst fra print- og typografiindustrien. Lorem Ipsum har været standard fyldtekst siden 1500-tallet, hvor en ukendt trykker sammensatte en tilfældig spalte for at trykke en bog til sammenligning af forskellige skrifttyper. Lorem Ipsum har ikke alene overlevet fem århundreder, men har også vundet indpas i elektronisk typografi uden væsentlige ændringer. Sætningen blev gjordt kendt i 1960\'erne med lanceringen af Letraset-ark, som indeholdt afsnit med Lorem Ipsum, og senere med layoutprogrammer som Aldus PageMaker, som også indeholdt en udgave af Lorem Ipsum.', 'Lorem Ipsum er ganske enkelt fyldtekst fra print- og typografiindustrien. Lorem Ipsum har været standard fyldtekst siden 1500-tallet, hvor en ukendt trykker sammensatte en tilfældig spalte for at trykke en bog til sammenligning af forskellige skrifttyper. Lorem Ipsum har ikke alene overlevet fem århundreder, men har også vundet indpas i elektronisk typografi uden væsentlige ændringer. Sætningen blev gjordt kendt i 1960\'erne med lanceringen af Letraset-ark, som indeholdt afsnit med Lorem Ipsum, og senere med layoutprogrammer som Aldus PageMaker, som også indeholdt en udgave af Lorem Ipsum.', NULL, 5, '2020-09-17 06:09:20', '2020-09-17 06:09:20'),
(8, 'Formation SST HACCP', '- Connaître les outils documentaires à mettre en place et la méthodologie à appliquer pour respecter les exigences de la réglementation.\r\n-Prendre conscience de l’importance de la mise en place et du suivi de la démarche HACCP dans la maîtrise des risques alimentaires', 'I- Aspect réglementaire\r\n-Pourquoi la SST HACCP\r\n-La réglementation\r\nII- La méthode SST HACCP\r\n-Les différentes étapes de la méthode SST HACCP\r\nIII-La SST HACCP en cuisine collective\r\n-Réception des marchandises\r\n-Entreposage des marchandises\r\nIV-Piloter le projet SST HACCP\r\n- Participation et rôle de la direction\r\n-Participation et rôle du responsable du projet SST HACCP\r\n-Participation et rôle des opérationnels\r\nV-Mise en place documentaire\r\n-Type de documents à mettre en place.\r\n-Constituer des dossiers et tenir les registres\r\n- Exercice pratique : Mise en place et rédaction d’un système documentaire', NULL, 6, '2020-09-17 06:48:42', '2020-09-17 06:48:42'),
(9, 'Les exigences du SMQ', '- Maîtriser les exigences du SMQ\r\n-Déployer la démarche et les outils de construction d’un SMQ', 'A- Les Exigences générales\r\n-Etablir le système de management de la qualité\r\n-Documenter le SMQ\r\n-Mettre en œuvre le SMQ et tenir à jour le SMQ\r\n-Améliorer l\'efficacité du SMQ\r\n-Déterminer les processus nécessaires et leur application\r\nB- Exigences relatives à la documentation\r\n-Généralités\r\n-Manuel qualité\r\n-Maîtrise des documents\r\n-Maîtrise des enregistrements\r\nC- Les Exigences liées à la Responsabilité de la direction\r\n-Planification\r\n-Ecoute client', NULL, 6, '2020-09-17 06:49:41', '2020-09-17 06:49:41'),
(10, 'Gestion de la Maintenance', '- Maîtrise de la maintenance préventive.\r\n- Maîtrise de la maintenance curative.\r\n- Les généralités de la maintenance préventive et curative.\r\n- Les stratégies de la maintenance préventive et curative', 'A- Systèmes de gestion de la maintenance préventive et curative\r\nB - Les différentes stratégies de diagnostic des pannes\r\nC - Les méthodes et les outils de diagnostic des pannes\r\nD - Complémentarité de la maintenance préventive et curative\r\nE - Conditions nécessaires de la mise en place de la maintenance préventive\r\nF - Mise en place de la maintenance curative\r\nG - Graphe caractéristique de la maintenance curative\r\nH - Les différentes formes de la maintenance préventive', NULL, 4, '2020-09-17 06:50:39', '2020-09-17 06:50:39'),
(11, 'Gestion des stocks', 'Mettre en place une politique optimisée de gestion des stocks', 'A- Approches de la gestion des stocks\r\n- Qu’est ce qu’un stock ?\r\n- Le rôle des stocks dans l’entreprise\r\n- Standardisation des matières et des pièces\r\n- Avantages et inconvénients des stocks permanents\r\nB- Notions des stocks\r\n- Diverses catégories d’articles en stock ; - Comptabilité des stocks ; - Tenue de la comptabilité ; - Stocks physiques ; - Stocks comptables ; - Type de stock MP. TEC. PF\r\nC- Apport de l’ordinateur dans la gestion des stocks\r\n- Rappel des fonctions de base de l’ordinateur ; - Gestion des stocks et ordinateur ; - Surveillance du niveau du stock ; - Magasinage ; - Exigence de l’ordinateur ; - Nomenclature des matériels stockés ; - Exactitude des informations ; - Précision des informations ; - Rapidité de la transmission de l’information\r\nD- Les outils de gestion des stocks\r\n- Stock moyen, courbe en dents de scie ; - Stock de protection ; - Le taux de rotation ; - Le taux de couverture\r\n- Stock minimum ; - Stock de sécurité ; - Stock d’alerte ; - Méthode de la classification ABC\r\nE- Méthodes et démarches de gestion des stocks\r\n- Valorisations au prix ou/et coût unitaire moyen pondéré ; - Méthode FIFO (* First In, First Out*); - Méthode LIFO (* Last In, First Out *); - Méthode de réapprovisionnement\r\nF- Les différents types d\'inventaires\r\n- Inventaire permanent ; - Inventaire tournant ; - Inventaire de fin d\'année\r\nG- Le plan d’approvisionnement\r\n- Les nouvelles méthodes de prévision ; - Gestion des produits en stocks : modes de codification et de classement, assainissement périodique, effort de réduction des stocks', NULL, 7, '2020-09-17 06:52:11', '2020-09-17 06:52:11'),
(12, 'Techniques de vente', '- Appréhender les différentes étapes de la vente, de la préparation à la conclusion d\'un entretien commercial.\r\n- Maîtriser l\'ensemble des techniques et des outils commerciaux pour conduire efficacement un entretien de vente.', '- Savoir prendre contact \r\n*Obtenir un rendez-vous\r\n*Créer un climat favorable\r\n- Savoir découvrir les besoins et les motivations du client \r\n*Questionner efficacement\r\n*Identifier les motivations\r\n*Diriger l’entretien de découverte\r\n- Savoir argumenter ses produits/ ses services\r\n*Argumenter efficacement\r\n*Présenter et défendre son prix\r\nComprendre la signification des objections et les traiter \r\n- Savoir conclure une vente \r\n*Identifier le bon moment\r\n*Utiliser les techniques efficaces\r\n*Faire du client une référence active\r\n*Pérenniser la relation', NULL, 8, '2020-09-17 09:29:07', '2020-09-17 09:29:07'),
(13, 'Techniques de recouvrement', '- Recouvrer efficacement les sommes dues via les procédures amiables et contentieuses\r\n- Identifier les premiers symptômes de défaillance du débiteur\r\n-Connaître les enjeux et les bénéfices d’un solide recouvrement', '- Les enjeux d’une bonne maîtrise des techniques de recouvrement\r\n- Prévenir les impayés\r\n- Favoriser le recouvrement amiable\r\n-entrée en contact et précautions à prendre afin de garder le dialogue avec le débiteur\r\n-ton, termes à employer, intérêt de la mise en demeure\r\n-procédure de A à Z pour mener la transaction\r\n- Obtenir le paiement devant les tribunaux\r\n-juridictions compétentes\r\n-procédure en injonction de payer\r\n-relations avec les avocats et huissiers de justice\r\n-mise en œuvre du jugement et exécution provisoire', 'A supprimer : erreur domaine', 8, '2020-09-17 09:29:50', '2020-11-02 12:32:56'),
(14, 'Norme 9001 V 2015', '- Connaître et comprendre les exigences de la norme 2009 V 2015\r\n- Utiliser les évolutions de la norme pour améliorer et simplifier le système de management de la qualité ;', '- Présentation de la norme 2009 V 2015, principales évolutions et impacts\r\n- Réussir la transition de votre système de management de la qualité vers la norme 2009 V 2015 \r\n- Maîtrisez les outils qualité nécessaires pour la mise en place d’un système de management qualité conforme à la norme 9001 V 2015', NULL, 6, '2020-09-17 09:30:33', '2020-09-17 09:30:33'),
(15, 'SMQ Norme 9001 V 2015', '- Connaître et comprendre les exigences de la norme 2009 V 2015\r\n- Utiliser les évolutions de la norme pour améliorer et simplifier le système de management de la qualité', '- Présentation de la norme 2009 V 2015, principales évolutions et impacts\r\n- Réussir la transition de votre système de management de la qualité vers la norme 2009 V 2015 \r\n- Maîtrisez les outils qualité nécessaires pour la mise en place d’un système de management qualité conforme à la norme 9001 V 2015', NULL, 6, '2020-09-17 10:33:16', '2020-10-23 05:33:17'),
(16, 'Management des personnes et des Equipes', '- Mener une équipe en appliquant les techniques de communication efficaces\r\n-Faire passer la vision et l’inspiration aux membres de l’équipe\r\n-Fixer d’une manière claire les objectifs de l’équipe\r\n- Assurer l’efficacité de l’équipe\r\n-Gérer les situations difficiles et les situations de conflit entre les membres de l’équipe\r\n-Conduire efficacement les réunions d’équipe', '- La communication\r\n- Les styles de leadership\r\n-Le travail du personnel comme une équipe\r\n- Les étapes du développement de l’équipe.\r\n-Les caractéristiques de l’équipe efficace.\r\n-La vision et l’inspiration ; travailler pour atteindre un objectif commun\r\n-La gestion des performances\r\n-Le traitement des conflits au sein de l’équipe\r\n-La conduite des réunions d’équipe', NULL, 3, '2020-09-18 04:30:14', '2020-09-18 04:30:14'),
(17, 'Stratégie Marketing et commerciale', '- Elaborer des stratégies applicables au niveau de l\'entreprise.\r\n- Etudier les conditions de structuration et de fonctionnement d\'un système de veille.\r\n- Etre capable de mettre en œuvre une stratégie “grand compte”. \r\n- Faire le lien entre le Plan Marketing et le PAC\r\n- Bâtir et formaliser son Plan d\'Actions Commerciales.\r\n- Concevoir votre Plan d\'Actions Marketing en cohérence avec le projet stratégique de l\'entreprise', '- Considérer la stratégie d\'entreprise comme l\'indispensable préalable\r\n-  Positionner la concurrence de l\'entreprise\r\n-  Comment Choisir et simuler les hypothèses retenues \r\n- Intégrer votre Plan d\'Actions Marketing dans la stratégie de l\'entreprise \r\n- La stratégie des grands compte « Fidélisation et veille »\r\n- Elaborer le plan d\'action commercial\r\n- Etablir une organisation commerciale adaptée à la stratégie de l\'entreprise\r\n- Les fonctions du tableau de bord : pilotage et reporting\r\n- Formaliser un diagnostic, décider des actions', NULL, 8, '2020-09-18 04:32:06', '2020-09-18 04:32:06'),
(18, 'Réglementation de travail', '- Maîtriser les bases de la réglementation en droit social\r\n-Appliquer le droit du travail\r\n-Gérer efficacement les dossiers du personnel', 'Sécuriser la gestion du contrat de travail\r\n- Conclure un contrat de travail\r\n- Les obligations de l\'employeur \r\n- Les conséquences de l\'inexécution par le salarié de ses obligations\r\nGérer les conditions de travail\r\n- La durée et l\'aménagement du temps de travail.\r\n-Les congés payés et autres congés.\r\n- La gestion de la suspension du contrat de travail la maladie, la maternité, les accidents du travail\r\n-Maîtriser des règles encadrant la rupture du contrat de travail\r\n-La rupture de la période d’essai : quelles précautions à prendre ?\r\n-La rupture du contrat à l\'initiative de l\'employeur \r\n-La rupture du contrat à l\'initiative du salarié \r\n-La rupture conventionnelle.\r\n-Le régime social et fiscal des indemnités de rupture.', NULL, 9, '2020-09-18 04:33:42', '2020-09-18 04:33:42'),
(19, 'Transport des marchandises dangereuses', '- Acquérir les connaissances nécessaires au transport routier de matières dangereuses, conformément à l\'ADR en vigueur.\r\n- Assurer sa sécurité et celle de l\'environnement en assurant une conduite adaptée', '- La classification des matières dangereuses\r\n- Les étiquettes réglementaires\r\n- Les dangers et risques de la matière\r\n- Les différents types de contenants\r\n- Les véhicules, la signalisation, le placardage et les équipements\r\n- Le chargement, le calage et l’arrimage\r\n- Les règlements et des dispenses à la réglementation\r\n- La circulation et le stationnement\r\n- Les documents de bord', NULL, 7, '2020-09-18 06:43:46', '2020-09-18 06:43:46'),
(20, 'Gestion de la production', '- Assimiler les principes et aspects liés à la gestion de production.\r\n- Maîtriser les méthodes et les outils de gestion de production.\r\n- Construire et exploiter les données et résultats pour la prise de décision.', '-Introduction à la production \r\n- Les principes fondamentaux de la gestion de la production\r\n- Processus d\'ordonnancement- planification et lancement des travaux\r\n- Les outils de pilotage et de contrôle de flux\r\n- La gestion des priorités\r\n- Les systèmes de gestion de production \r\n- Méthodes et outils de gestion de la chaîne de fabrication\r\n- Gestion de ressources matérielles et humaines de la chaîne\r\n- Suivi des ordres de fabrication de la chaîne\r\n- Les méthodes du juste à temps', NULL, 4, '2020-09-18 06:44:23', '2020-09-18 06:44:23'),
(21, 'Management des personnes et des Equipes', '- Mener une équipe en appliquant les techniques de communication efficaces\r\n-Faire passer la vision et l’inspiration aux membres de l’équipe\r\n-Fixer d’une manière claire les objectifs de l’équipe\r\n- Assurer l’efficacité de l’équipe\r\n-Gérer les situations difficiles et les situations de conflit entre les membres de l’équipe\r\n-Conduire efficacement les réunions d’équipe', '- La communication\r\n- Les styles de leadership\r\n-Le travail du personnel comme une équipe\r\n- Les étapes du développement de l’équipe.\r\n-Les caractéristiques de l’équipe efficace.\r\n-La vision et l’inspiration ; travailler pour atteindre un objectif commun\r\n-La gestion des performances\r\n-Le traitement des conflits au sein de l’équipe\r\n-La conduite des réunions d’équipe', NULL, 10, '2020-09-18 08:58:51', '2020-09-18 08:58:51'),
(22, 'Stratégie Marketing et commerciale', '- Elaborer des stratégies applicables au niveau de l\'entreprise.\r\n- Etudier les conditions de structuration et de fonctionnement d\'un système de veille.\r\n- Etre capable de mettre en œuvre une stratégie “grand compte”. \r\n- Faire le lien entre le Plan Marketing et le PAC\r\n- Bâtir et formaliser son Plan d\'Actions Commerciales.\r\n- Concevoir votre Plan d\'Actions Marketing en cohérence avec le projet stratégique de l\'entreprise', '- Considérer la stratégie d\'entreprise comme l\'indispensable préalable\r\n-  Positionner la concurrence de l\'entreprise\r\n-  Comment Choisir et simuler les hypothèses retenues \r\n- Intégrer votre Plan d\'Actions Marketing dans la stratégie de l\'entreprise \r\n- La stratégie des grands compte « Fidélisation et veille »\r\n- Elaborer le plan d\'action commercial\r\n- Etablir une organisation commerciale adaptée à la stratégie de l\'entreprise\r\n- Les fonctions du tableau de bord : pilotage et reporting\r\n- Formaliser un diagnostic, décider des actions', NULL, 11, '2020-09-18 09:00:42', '2020-09-18 09:00:42'),
(23, 'Les exigences du SMQ', '- Maîtriser les exigences de la norme ISO 9001\r\n-Déployer la démarche et les outils de construction d’un SMQ', 'A- Les Exigences générales\r\n-Etablir le système de management de la qualité\r\n-Documenter le SMQ\r\n-Mettre en œuvre le SMQ et tenir à jour le SMQ\r\n-Améliorer l\'efficacité du SMQ\r\n-Déterminer les processus nécessaires et leur application\r\nB- Exigences relatives à la documentation\r\n-Généralités\r\n-Manuel qualité\r\n-Maîtrise des documents\r\n-Maîtrise des enregistrements\r\nC- Les Exigences liées à la Responsabilité de la direction\r\n-Planification\r\n-Ecoute client', NULL, 12, '2020-09-18 09:01:54', '2020-09-18 09:01:54'),
(24, 'Réglementation de travail', '- Maîtriser les bases de la réglementation en droit social\r\n-Appliquer le droit du travail\r\n-Gérer efficacement les dossiers du personnel', 'Sécuriser la gestion du contrat de travail\r\n- Conclure un contrat de travail\r\n- Les obligations de l\'employeur \r\n- Les conséquences de l\'inexécution par le salarié de ses obligations\r\nGérer les conditions de travail\r\n- La durée et l\'aménagement du temps de travail.\r\n-Les congés payés et autres congés.\r\n- La gestion de la suspension du contrat de travail la maladie, la maternité, les accidents du travail\r\n-Maîtriser des règles encadrant la rupture du contrat de travail\r\n-La rupture de la période d’essai : quelles précautions à prendre ?\r\n-La rupture du contrat à l\'initiative de l\'employeur \r\n-La rupture du contrat à l\'initiative du salarié \r\n-La rupture conventionnelle.\r\n-Le régime social et fiscal des indemnités de rupture.', NULL, 13, '2020-09-18 09:03:01', '2020-09-18 09:03:01'),
(25, 'Gestion de la production', '- Assimiler les principes et aspects liés à la gestion de production.\r\n- Maîtriser les méthodes et les outils de gestion de production.\r\n- Construire et exploiter les données et résultats pour la prise de décision', '-Introduction à la production \r\n- Les principes fondamentaux de la gestion de la production\r\n- Processus d\'ordonnancement- planification et lancement des travaux\r\n- Les outils de pilotage et de contrôle de flux\r\n- La gestion des priorités\r\n- Les systèmes de gestion de production \r\n- Méthodes et outils de gestion de la chaîne de fabrication\r\n- Gestion de ressources matérielles et humaines de la chaîne\r\n- Suivi des ordres de fabrication de la chaîne\r\n- Les méthodes du juste à temps', NULL, 14, '2020-09-18 09:10:27', '2020-09-18 09:10:27'),
(26, 'Transport des marchandises dangereuses', '- Acquérir les connaissances nécessaires au transport routier de matières dangereuses, conformément à l\'ADR en vigueur.\r\n- Assurer sa sécurité et celle de l\'environnement en assurant une conduite adaptée', '- La classification des matières dangereuses\r\n- Les étiquettes réglementaires\r\n- Les dangers et risques de la matière\r\n- Les différents types de contenants\r\n- Les véhicules, la signalisation, le placardage et les équipements\r\n- Le chargement, le calage et l’arrimage\r\n- Les règlements et des dispenses à la réglementation\r\n- La circulation et le stationnement\r\n- Les documents de bord', NULL, 15, '2020-09-18 09:12:36', '2020-09-18 09:12:36'),
(27, 'l\'OHSAS 18001', '- Être capable de construire un système de management santé sécurité au travail\r\n- Savoir appliquer des outils pratiques du management de la santé et de la sécurité\r\n- Être capable d’utiliser les convergences avec les systèmes qualité et environnement', '- Le management santé sécurité au travail \r\n*Les enjeux et les motivations  *Les principes du management de la santé et de la sécurité au travail\r\n*Le référentiel OHSAS 18001\r\nPourquoi choisir le référentiel OHSAS 18001 ?\r\n*Apports de l’OHSAS 18002  *Structure et définitions\r\nLa préparation du projet\r\n* État initial – autodiagnostic * La stratégie de déploiement  * L\'évaluation des ressources nécessaires\r\n- Mettre en œuvre les outils de planification\r\n* Identification des dangers et évaluation des risques \r\n* Identification des exigences (légales et autres) et analyse de la conformité\r\n* Politique, objectifs, programme de management santé sécurité\r\n- Mettre en œuvre les procédures de fonctionnement\r\n* Clarifier les responsabilités et autorités * Mettre en place la procédure de formation sécurité\r\n* Mettre en place une stratégie de communication et de consultation * Gérer la documentation\r\n* Garantir la maîtrise opérationnelle et la capacité à réagir\r\n- Le processus de certification OHSAS 18001\r\n* Le processus de certification OHSAS 18001  * La conduite à tenir - retours d’expérience', NULL, 12, '2020-09-18 09:41:41', '2020-09-18 09:41:41'),
(28, 'Management des risques', '-  Intégrer le management du risque au processus de décision et aux processus organisationnels\r\n-  Utiliser le management du risque comme levier du management intégré', '-Pourquoi ? Cerner l’apport d’un management du risque\r\n*S’adapter à un environnement socioéconomique incertain mais exigeant\r\n*Atteindre ses objectifs, stratégiques et opérationnels, économiques et sociétaux\r\n-Comment ? Faire du management du risque un outil d’anticipation et d’intégration\r\n*Établir une vision partagée du risque au sein de l’organisation ?\r\n-Comment pratiquer pour intégrer le risque aux processus organisationnels ?\r\n*Méthodologie d’évaluation et de cartographie des risques\r\n*Intégration du risque à la hiérarchisation des plans d’actions\r\n-Comment s’organiser pour intégrer le risque au processus de décision ?\r\n*Répartition des responsabilités, reporting et revues\r\n*Intégration du risque au pilotage quotidien de l’organisation\r\n-Ateliers : mise en situation\r\n*comment obtenir des évaluations homogènes pour une hiérarchie pertinente des actions à engager ?\r\n*comment l’intégration du risque facilite-t-elle le management des processus et allège-t-elle la tâche de leurs pilotes ?\r\n*comment utiliser l’approche du risque pour motiver les Directions à s’investir plus avant dans leur système de management\r\n*comment le management du risque contribue-t-il à améliorer l’agilité aujourd’hui nécessaire aux organisations ?', NULL, 10, '2020-09-18 10:49:22', '2020-09-18 10:49:22'),
(29, 'Techniques d’élaboration des Tableaux de bord', '- Acquérir les méthodes et outils pour réaliser des tableaux de bord financiers et de gestion\r\n- Optimiser les tableaux de bord financiers de son entreprise', 'A- Les principes généraux des tableaux de bord financiers et de gestion\r\n- Rôle et définitions des tableaux de bord financiers\r\n- Identifier les tableaux de bord indispensables\r\n- Réaliser une cartographie de vos tableaux de bord\r\nB - La construction des tableaux de bord financiers et de gestion\r\n- Clarifier la demande des destinataires\r\n- Adapter le contenu, la fréquence de diffusion des tableaux de bord\r\n- Choix des indicateurs et objectifs\r\nC - Améliorer vos tableaux de bord financiers et de gestion\r\n- Sur le fond\r\n. Connaître les principaux ratios de la fonction.\r\n. Utiliser les outils statistiques appropriés (moyenne, médiane, écart-type, etc.)\r\n- Sur la forme\r\n. Savoir utiliser à bon escient histogrammes, pictogrammes, nuages de points, etc.\r\n. Connaître les tendances actuelles de présentation\r\n. Utiliser les nouveaux outils de communication', NULL, 16, '2020-09-18 10:51:15', '2020-10-21 11:48:31'),
(30, 'Négociation de vente', 'Construire sa stratégie et sa tactique en négociation commerciale complexe.\r\nMener ses négociations en combinant souplesse et fermeté.\r\nRésister à la pression des négociations à fort enjeu.', '1/ Agir en amont de la négociation\r\nLes spécificités des négociations de haut niveau.\r\nChoisir sa posture de négociateur, repérer celle de l\'autre.\r\nIntégrer les priorités des acheteurs pour mieux y répondre.\r\n2/ Définir sa stratégie de négociation\r\nDéterminer tous les points à négocier.\r\nIdentifier ses propres intérêts et ceux probables de ses interlocuteurs.\r\nMesurer les enjeux pour chaque partie.\r\nFormuler ses propres objectifs, déterminer sa MESORE.\r\n3/ Construire sa tactique\r\nAnalyser le rapport de forces :\r\nles 6 curseurs du pouvoir.\r\nIdentifier tous les acteurs en présence.\r\nAnticiper les tactiques des acteurs :\r\nla matrice des ressources.\r\nConstruire sa propre tactique.\r\n4/ Adapter sa tactique et sa communication\r\nÉtablir la relation, donner le ton.\r\nDéfinir avec son interlocuteur l’objectif à atteindre.\r\nSortir de la négociation sur les positions.\r\nRechercher les intérêts.\r\nRééquilibrer les pouvoirs en permanence.\r\nAdapter son style de négociateur à celui du client.\r\n5/ Conduire l’entretien de négociation jusqu’à la réussite\r\nSavoir rester centré sur l’objectif.\r\nRechercher les options possibles, les évaluer :\r\nla matrice des objectifs.', NULL, 11, '2020-09-23 04:33:58', '2020-09-23 04:33:58'),
(31, 'Comptabilité Analytique', '- Maîtriser les principes et les règles de la comptabilité analytique.\r\n- Exploiter et utiliser à bon escient les différentes méthodes de calcul des coûts pour procéder à des évaluations                   - Appropriées des performances réalisées en terme d\'efficience des opérations.', '1/ Enrichir les analyses de gestion grâce à la comptabilité analytique\r\nLa comptabilité de gestion.\r\nRetraiter des charges de la comptabilité générale.\r\nRépondre au besoin d\'analyse multidimensionnelle de l\'activité.\r\n2/ Mesurer les enjeux des coûts grâce aux coûts complets\r\nDistinguer les charges directes et indirectes.\r\nDéterminer les centres analytiques (ou sections).\r\nChoisir les unités d\'œuvre et les clés de répartition.\r\nValoriser les stocks.\r\nLes utilisations : améliorer la productivité, gérer les indirects…\r\n3/ Accompagner les décisions grâce aux coûts partiels\r\nDistinguer les charges fixes et les charges variables.\r\nAnalyser les différents niveaux de marges de contribution.\r\nDéterminer le point mort ou seuil de rentabilité.\r\nLes utilisations : faire ou faire faire, négocier un prix…\r\n4/ Approfondir les analyses de gestion grâce à la méthode des coûts par activités (ABC)\r\nL\'intérêt d\'une nouvelle méthode.\r\nDéfinir et valoriser les activités.\r\nDiversifier et choisir les inducteurs d\'activités.\r\nCalculer les coûts des inducteurs et les coûts des objets de coût.\r\nLes utilisations : piloter les processus, gérer la diversité…\r\n5/ Anticiper pour faire évoluer le système de gestion\r\nLes étapes de mise en place d\'une comptabilité analytique.\r\nLes facteurs clés de succès.', NULL, 16, '2020-09-23 04:36:20', '2020-10-16 12:52:16'),
(32, 'Management opérationnel', 'Acquérir les techniques managériales fondamentales \r\nde résoudre les problématiques managériales \r\nDévelopper son aisance relationnelle\r\nCréer une dynamique d\'équipe \r\nAdopter la posture et les outils d\'un manager coach.', '1 - Se positionner dans son rôle de manager de proximité\r\nClarifier ses rôles et ses responsabilités de manager d’équipe.\r\nQuelle est la valeur ajoutée du manager de proximité ?\r\nComment se centrer sur ses rôles ?\r\n2 - Adapter ses comportements de management à chaque situation\r\nIdentifier ses styles de management préférentiels et trouver des pistes d’amélioration.\r\nAdapter son style au contexte et aux situations.\r\nDévelopper l’autonomie de ses collaborateurs.\r\n3 - Orienter l\'action de l\'équipe vers l\'atteinte des résultats attendus\r\nSe doter de repères communs en fixant des règles du jeu.\r\nFixer les objectifs et en assurer le suivi.\r\nTransformer l’évaluation des performances en plans de progrès.\r\n4 - Mobiliser les énergies individuelles\r\nDétecter les talents de ses collaborateurs pour les rendre plus performants.\r\nFavoriser l’autonomie et l’initiative.\r\nAgir sur les leviers de motivation pertinents.\r\nRepérer les niveaux pertinents d’intervention.\r\n4 - Mobiliser les énergies individuelles\r\nPratiquer des délégations responsabilisantes.\r\nAccompagner et former ses collaborateurs.\r\n6 - Développer la cohésion de son équipe\r\nComprendre le fonctionnement de son équipe.\r\nFaire passer ses collaborateurs d\'une logique individuelle à une logique collective', NULL, 10, '2020-09-23 04:38:28', '2020-09-23 04:38:28'),
(33, 'Système de Mangement Qualité (SMQ)', '- Maîtriser les exigences du SMQ\r\n-Déployer la démarche et les outils de construction d’un SMQ', 'A- Les Exigences générales\r\n-Etablir le système de management de la qualité\r\n-Documenter le SMQ\r\n-Mettre en œuvre le SMQ et tenir à jour le SMQ\r\n-Améliorer l\'efficacité du SMQ\r\n-Déterminer les processus nécessaires et leur application\r\nB- Exigences relatives à la documentation\r\n-Généralités\r\n-Manuel qualité\r\n-Maîtrise des documents\r\n-Maîtrise des enregistrements\r\nC- Les Exigences liées à la Responsabilité de la direction\r\n-Planification\r\n-Ecoute client', NULL, 6, '2020-09-24 10:58:37', '2020-09-24 10:58:37'),
(34, 'Formation SST HACCP', '- Connaître les outils documentaires à mettre en place et la méthodologie à appliquer pour respecter les exigences de la réglementation.\r\n-Prendre conscience de l’importance de la mise en place et du suivi de la démarche HACCP dans la maîtrise des risques alimentaires', 'I- Aspect réglementaire\r\n-Pourquoi la SST HACCP\r\n-La réglementation\r\nII- La méthode SST HACCP\r\n-Les différentes étapes de la méthode SST HACCP\r\nIII-La SST HACCP en cuisine collective\r\n-Réception des marchandises\r\n-Entreposage des marchandises\r\nIV-Piloter le projet SST HACCP\r\n- Participation et rôle de la direction\r\n-Participation et rôle du responsable du projet SST HACCP\r\n-Participation et rôle des opérationnels\r\nV-Mise en place documentaire\r\n-Type de documents à mettre en place.\r\n-Constituer des dossiers et tenir les registres\r\n- Exercice pratique : Mise en place et rédaction d’un système documentaire', NULL, 6, '2020-09-24 11:04:04', '2020-09-24 11:04:04'),
(35, 'TEST#', 'Le Lorem Ipsum est simplement du faux texte employé dans la composition et la mise en page avant impression. Le Lorem Ipsum est le faux texte standard de l\'imprimerie depuis les années 1500, quand un imprimeur anonyme assembla ensemble des morceaux de texte pour réaliser un livre spécimen de polices de texte. Il n\'a pas fait que survivre cinq siècles,', 'Le Lorem Ipsum est simplement du faux texte employé dans la composition et la mise en page avant impression. Le Lorem Ipsum est le faux texte standard de l\'imprimerie depuis les années 1500, quand un imprimeur anonyme assembla ensemble des morceaux de texte pour réaliser un livre spécimen de polices de texte. Il n\'a pas fait que survivre cinq siècles,', 'Le Lorem Ipsum est simplement du faux texte employé dans la composition et la mise en page avant impression. Le Lorem Ipsum est le faux texte standard de l\'imprimerie depuis les années 1500, quand un imprimeur anonyme assembla ensemble des morceaux de texte pour réaliser un livre spécimen de polices de texte. Il n\'a pas fait que survivre cinq siècles,', 17, '2020-09-25 10:11:02', '2020-09-25 10:11:02'),
(36, 'Communication professionnelle', '- Comprendre les principes de base de la communication;\r\n- Développer sa capacité d’écoute;\r\n- Communiquer efficacement avec tous types de clients;\r\n- Adapter son comportement au profil de son interlocuteur;\r\n- Savoir s’affirmer.', 'Les principes de communication :        \r\n- Accueillir le client;\r\n- Découvrir les attentes et les besoins relationnels de chaque client;\r\n- Pratiquer l’écoute active et développer la perception de l’interlocuteur;\r\n- L’écoute et le rapport de confiance à l’autre;\r\n- Les obstacles cognitifs et freins à la communication.\r\nLa communication non verbale :\r\n- Savoir décrypter les gestes que l\'on croît inconscients;\r\n- Utiliser l\'espace et ses déplacements;\r\n- Savoir utiliser à bon escient les postures, l’expression du visage, le regard et la voix;\r\n- Prendre la parole;\r\n- La maîtrise de soi : comment surmonter ses appréhensions et gérer les situations de blocage.\r\nSavoir vendre ses idées:\r\n- Evaluer la situation : écouter, reformuler;\r\n- Définir les objectifs à atteindre dans le cadre d\'une communication professionnelle;\r\n- Distinguer \"être concerné\" et \"être impliqué\";\r\n- Trouver des arguments pour convaincre et comprendre les blocages.', NULL, 18, '2020-10-06 12:18:38', '2020-10-06 12:18:38'),
(37, 'Anglais professionnel et commercial', '-Utiliser l\'anglais en réunion sans appréhension. \r\n-Se faire entendre et comprendre, mobiliser l\'attention de l\'assistance. \r\n-Développer de l\'aisance dans son expression, apprivoiser le trac.', 'Expression & compréhension orale:\r\n- Accueillir en anglais,\r\n- Savoir reformuler la demande de son interlocuteur,\r\n- Argumenter et répondre de façon concise.\r\nMise à niveau grammaticale:\r\n- Révision des bases grammaticales\r\n- Vocabulaire commercial lié au secteur d’activité;\r\nRédaction de présentation et correspondance commerciale:\r\n- Travail sur les correspondances commerciales(courrier, fax, email);\r\n- Travail sur des documents commerciaux spécifiques (offre commercial, réclamations, relance, demande d’information…).\r\nNégociation commerciale :\r\n- Identification des éléments clés de la négociation commerciale;\r\n- Suivre de façon proactive l’argumentation de son partenaire commercial;\r\n- Enrichir sa propre argumentation commerciale pour être persuasif.', NULL, 18, '2020-10-15 12:02:40', '2020-10-15 12:02:40'),
(38, 'Approche générale de la logistique', '- Maîtriser les principes fondamentaux de la logistique\r\n-Comprendre les méthodes de pilotage des flux\r\n-Comprendre le rôle du client dans la Supply Chain et l\'importance des systèmes d\'information', 'La Supply Chain Management:\r\n-Enjeux économiques actuels;\r\n-Les objectifs, les tendances;\r\n-Mondialisation des flux;\r\n-La fonction logistique au sein de l\'entreprise.\r\nLogistique des stocks et des flux:\r\n-La demande client, gestion sur prévision et sur stock;\r\n-Les approvisionnements;\r\n-La distribution vers les clients;\r\n-La rétro logistique, importance de la logistique des retours;\r\n-Les moyens de transport, comparatif des moyens de transport.\r\nSystèmes d\'information de la Supply Chain Management:\r\n-Systèmes d\'information de la supply chain;\r\n-WMS, Warehouse Management System;\r\n-TMS et préfacturation transport.', NULL, 15, '2020-10-15 12:05:44', '2020-10-15 12:05:44'),
(39, 'Fiscalité', '- Maitriser les règles de calcul de l\'IS, de la TVA et l\'application des droits à la déduction.\r\n- Etre en mesure de prévenir les risques fiscaux et être à mesure de faire face à un contrôle.\r\n- Maîtriser les risques liés aux différentes obligations déclaratives qui pèsent sur votre entreprise.', '- Impôt sur le revenu,\r\n- Impôt sur les sociétés,\r\n- TVA,\r\n- Les droits d’enregistrement,\r\n- La fiscalité locale,\r\n- Détection des risques fiscaux,\r\n- les déclarations fiscales et sociales.', NULL, 16, '2020-10-15 12:10:07', '2020-10-16 08:00:30'),
(40, 'Management organisation stratégie et pilotage', '- Mise en exergue des enjeux d’une organisation efficace pour accompagner la croissance de l’entreprise.\r\n- Apports de l’organisation pour transformer la vision stratégique en objectifs opérationnels.\r\n- L’importance des processus et des ressources humaines pour la mise en œuvre d’une organisation.\r\n- Système d’information et organisation d’entreprise', '- La vision stratégique du diagnostic stratégique des Organisations\r\n- Les nouvelles approches managériales\r\n- Gérer la mobilité interne\r\n- Superviser la gestion administrative du personnel\r\n- Comment assurer la conformité de la structure organisationnelle avec la couverture opérationnelle ?\r\n- Construire un référentiel de compétence\r\n- Evaluer les compétences \r\n- Comment élaborer vos fiches de fonction', NULL, 10, '2020-10-20 09:00:31', '2020-10-20 09:00:31'),
(41, 'Management des équipes', '- Identifier et introduire les leviers communicationnels au sein de l’équipe \r\n- Utiliser le tableau de bord en tant qu’outil de pilotage d’équipe\r\n- Intégrer la conduite de réunion dans la pratique managériale \r\n- Intégrer la délégation comme un levier d’encadrement et de motivation des équipes', '- Identifier les différents rôles du manager et les paradoxes auxquels il est soumis\r\n- Identifier les stades du développement du manager : l’Expert, le Manager, le Leader\r\n- Identifier les bases de la communication d’équipe\r\n- Identifier l’intérêt de mettre en place des tableaux de bord de suivi d’activité des équipes \r\n- Identifier les rôles de l’animateur : producteur, facilitateur, régulateur \r\n- Intégrer les techniques de conduite de réunion\r\n- Intégrer les conditions de mise en place d’une bonne délégation\r\n- Les rôles du délégant et celui du délégataire\r\n- Comprendre les principes de la dynamique d’entretien\r\n- Maîtriser les techniques de questionnements, de reformulation et de recadrage', NULL, 10, '2020-10-20 09:02:29', '2020-10-20 09:02:29'),
(42, 'Techniques de vente', '- Connaitre et maitriser les techniques de ventes et de présentation\r\n- Techniques du marketing', '- Présenter une proposition de façon claire\r\n- Obtenir la confirmation des besoins du client\r\n- Utiliser les avantages\r\n- Se différencier de la concurrence\r\n- Le Marketing opérationnel : quels sont les outils d\'aide à la vente, de communication, d\'événementiel… ?\r\n- Présenter votre prix positivement\r\n- Savoir quand et comment conclure\r\n- La maîtrise des silences\r\n- Repérer les signaux d\'achats\r\n- Reformuler la confirmation de l\'engagement du client\r\n- Le Marketing client : comment s\'organise la \" relation client \", quelles politique de fidélisation… ?', NULL, 11, '2020-10-20 09:07:02', '2021-01-20 13:04:14'),
(43, 'Accompagnement à la mise en place d’une organisation commerciale et marketing', '- Mise en place d’une organisation Commercial et Marketing\r\n- Techniques d’élaboration des offres d’hébergement et de restauration\r\n-  Les nouvelles pratiques du marketing dans le domaine hôtelier et de restauration \r\n-  Elaboration et mise en œuvre du tableau de bord Marketing et commercial\r\n- Comment réussir vos promotions des ventes et Evaluer l\'efficacité de vos campagnes de communication\r\n- Administration', '- Audit organisationnel\r\n- Vers un système de pilotage performant : utiliser vos tableaux de bord pour réaliser un diagnostic pertinent de votre activité.\r\n-Système de rémunération motivant pour l’équipe commerciale \r\n- Obtenir l\'adhésion de l\'équipe au tableau de bord commercial \r\n- Faire vivre et mettre à jour vos tableaux de bord \r\n- Faire évoluer régulièrement vos tableaux de bord \r\n- Elaborer la stratégie et la planification promotionnelle\r\n- Mesurer l\'efficacité et la rentabilité de la promotion \r\n-Les nouveaux outils de promotion \r\n- Motiver et Challenger  son Equipe', NULL, 11, '2020-10-20 09:07:47', '2020-10-20 09:07:47'),
(45, 'Techniques d’accueil', '- Maîtriser l\'accueil des appels reçus en vue d\'une réorientation vers d\'autres services/interlocuteurs.\r\n- Accueillir tous les appels dans le respect de l\'image de l\'entreprise.\r\n- Comprendre rapidement la demande et en déduire la bonne orientation.', 'A - Accueil et image :\r\n- Image voulue et image perçue\r\n- Les vecteurs d\'image\r\n- Le bon accueil\r\n\r\nB - Le téléphone :\r\n- La technologie téléphone\r\n- Les différents types de systèmes\r\n\r\nC - Les spécificités de la communication par téléphone :\r\n- L\'articulation\r\n- La formulation\r\n- La mise en attente\r\n- Le transfert\r\n- La prise de message\r\n\r\nD - Le traitement de l\'appel :\r\n- Le plan de l\'appel\r\n- Objectifs de la présentation\r\n- Principe de la découverte\r\n- Les différents types de questions\r\n- L\'apport de solution\r\n- La conclusion', NULL, 19, '2020-10-20 11:35:37', '2020-10-20 11:35:37'),
(46, 'Technique de vente et mise en place d’une organisation commerciale', '- Connaitre et Maitrisez les Techniques de ventes et de présentation\r\n- Techniques du marketing', '- Présenter une proposition de façon claire\r\n- Obtenir la confirmation des besoins du client\r\n- Utiliser les avantages\r\n- Se différencier de la concurrence\r\n- Le Marketing opérationnel : quels sont les outils d\'aide à la vente, de communication, d\'événementiel… ?\r\n- Présenter votre prix positivement\r\n- Savoir quand et comment conclure\r\n- La maîtrise des silences\r\n- Repérer les signaux d\'achats\r\n- Reformuler la confirmation de l\'engagement du client\r\n- Le Marketing client : comment s\'organise la \" relation client \", quelles politique de fidélisation… ?', NULL, 11, '2020-10-20 11:38:55', '2020-10-20 11:38:55'),
(47, 'Secourisme', '-Connaître le mécanisme de l\'accident : appréhender les concepts de danger, situation dangereuse, phénomène dangereux, dommage, risque…\r\n-Connaître les principes de base de la prévention', '-Le rôle du sauveteur secouriste du travail \r\n-Les bilans\r\n-Protection et sécurité\r\n-Urgences vitales\r\n-Malaises et affections spécifiques\r\n-Traumatismes', NULL, 20, '2020-10-20 11:42:02', '2020-10-20 11:42:02'),
(48, 'Finance pour non financiers', '-Comprendre la logique de construction du compte de résultat et du bilan. \r\n-Comprendre les mécanismes financiers de l\'entreprise. \r\n-Évaluer la santé financière d\'une entreprise à partir de l\'analyse financière. \r\n-S\'initier au tableau de flux.', '1 La logique financière des documents comptables\r\n•\"Vendre pour réaliser un bénéfice implique d\'investir et donc de financer\" Le compte de résultat, film de l\'activité d\'une période. \r\n•Le bilan, inventaire des éléments constituant le patrimoine \r\n•Logique financière du bilan en termes de ressources et d\'emplois. \r\n•Principes comptables de base \r\n•Mécanismes de l\'amortissement et des provisions. \r\n•Lien entre compte de résultat et bilan : partie double et double détermination du résultat. \r\n-Exercice \r\n\r\n2 Lire et interpréter les documents comptables\r\n•Présentation des principaux postes du compte de résultat et du bilan, en normes françaises et anglo-saxonnes. \r\n•Présentation des charges par nature ou par fonction. \r\n\r\n3 Diagnostiquer l\'activité et la profitabilité\r\n•Interpréter l\'évolution des ventes. \r\n•Évaluer la profitabilité à partir des SIG : marge commerciale, brute, valeur ajoutée, EBE, résultat d\'exploitation, courant. \r\n•Analyse à partir des charges par nature et par fonctions (approche anglo-saxonne). \r\n•Mesures et utilisation des indicateurs d\'excédent de trésorerie, EBE, CAF, MBA,… \r\n•Causes de variation du résultat : effet ciseau et effet point mort \r\n•Exercices \r\n\r\n4 Diagnostiquer les capitaux investis et la structure financière\r\n•Retraitements pour passer au bilan financier : locations financements, affacturage. \r\n•Équilibre financier du bilan fonctionnel', NULL, 16, '2020-10-20 12:07:08', '2021-01-21 09:58:11'),
(49, 'Organisation d’entreprise', 'Connaître la structure d’une organisation en entreprise\r\nApprocher les principes de fondement d’une organisation en entreprise', 'A – Différente types d’organisation d’entreprise- avantage et inconvénients\r\nB – les clés de réussite d’une organisation de l’entreprise\r\nC – L’apport du capital humain à l’organisation d’entreprise\r\nd- Zoom sur les bonnes pratiques des grandes firmes internationales\r\ne-Traitement des problèmes liés à la gestion des entreprises\r\nf- Audit organisationnel', NULL, 10, '2020-10-20 12:08:27', '2020-10-20 12:08:27'),
(50, 'Pratique de la GRH', 'Acquérir et maitriser les outilsde GRH\r\nEtre capable de gérer et optimiser l’allocation des ressources humaines \r\nPrévenir les risques réglementaires et juridiques', '- Les bases de la GRH et Management RH\r\n- La gestion prévisionnelle des emplois et des compétences\r\n- Négocier et rédiger le contrat de travail\r\n- Les techniques de recrutement\r\n- La gestion des rémunérations\r\n- La gestion de la formation et  Comment évaluer l\'efficacité de vos formations\r\n- L’évaluation du personnel et les  Techniques de gestion de carrière\r\n- Tableaux de bord social et Outils de mesure de performance Rh\r\n- Sécuriser la rupture du contrat de travail\r\n- Durée du travail : Organiser et aménager le temps de travailet la Gestion des congés et plan d’intérim\r\n-. Conformité à la législation du travailet Protections collectives', NULL, 13, '2020-10-20 13:15:37', '2020-10-20 13:15:37'),
(51, 'Management et conduites de changement', '-Comprendre les résistances au changement.\r\n-Identifier les catégories d\'acteurs et leur position face au changement.\r\n-Anticiper les risques et les conflits. \r\n-Faire face aux situations de crise engendrées par le changement.\r\n-Préparer le plan pour conduire le changement', '1- Je décrypte les mécanismes de changement\r\n-Les 3 phases de transformation.\r\n-Identifier les différents types de résistance au changement.\r\n-Les modes d\'expression des résistances au changement.\r\n-Comprendre les mécanismes, anticiper et traiter ces résistances.\r\n2- Je conduis le diagnostic humain d\'un projet de changement \r\n-Définir le périmètre et les objectifs du projet.\r\n-Identifier ses origines externes : concurrentielles, réglementaires, technologiques, sociales.\r\n-Réaliser la cartographie des acteurs.\r\n-Identifier leurs modalités de fonctionnement lors du changement. \r\n3- J\'utilise à bon escient la communication \r\n-Utiliser les différents registres de la communication.\r\n-Les besoins à prendre en compte dans un dispositif de communication.\r\n4- Je mesure le degré d\'acceptabilité du changement dans l\'entreprise\r\n5- J\'anticipe les conflits et les risques liés au changement\r\n6- Je mets en place de nouveaux systèmes de pilotage et de reconnaissance\r\nDéfinir des indicateurs de performance liés aux objectifs.\r\nConstruire un tableau de bord piloté efficacement la démarche', NULL, 10, '2020-10-20 13:16:32', '2020-10-20 13:16:32'),
(52, 'Santé et sécurité au travail', '- Identifier et respecter les exigences essentielles pour suivre sereinement son activité\r\n- Faire le point sur l\'actualité réglementaire incontournable\r\n- Organiser sa gestion de la sécurité et santé au travail pour l\'ensemble des risques', '- Comprendre la réglementation sécurité et santé au travail\r\n*Identifier les sources de droit\r\n*Appréhender l\'articulation des textes réglementaires\r\n*La délégation de pouvoir, la responsabilité civile et pénale\r\n-  Identifier les principales obligations réglementaires et les dernières exigences\r\n*Obligation générale de prévention\r\n*Obligation de résultat pour l\'employeur et ses délégataires\r\n*Évaluation des risques professionnels et Document Unique\r\n- Appliquer les obligations\r\n- Système de gestion de la sécurité et la santé au travail\r\n*Les différentes étapes de la mise en place d\'un système de management santé-sécurité\r\n*Lien entre le Code du Travail et le système de management SST\r\n*Le Document Unique et la démarche de management de la sécurité et santé au travail', NULL, 20, '2020-10-21 07:54:27', '2020-10-21 07:54:27'),
(53, 'Approche générale des finances', '-Mettre à niveau les connaissances et compétences des salariés du service comptables en matière de a gestion et l’analyse financière', '- Rappel des principes comptables.\r\n- Analyse et interprétation du bilan et CPC.\r\n- Calcul des ratios de la gestion financière et leur interprétation.\r\n- Choix des financements.\r\n- technique d’optimisation de la trésorerie.', NULL, 16, '2020-10-21 11:42:20', '2020-10-21 11:42:20');
INSERT INTO `themes` (`id_theme`, `nom_theme`, `objectif`, `contenu`, `commentaire`, `id_dom`, `created_at`, `updated_at`) VALUES
(54, 'Approche générale de la sécurité', '- Découvrir l\'approche de prévention des risques professionnels.\r\n- Connaître les contours de la réglementation', '- Cadre juridique de la sécurité \r\n- La responsabilité juridique et le droit pénal \r\n- Politique de prévention\r\n- Développement des compétences et formation\r\n- La sécurité au travail\r\n- Les obligations des employés et réglementation du travail\r\n- les réunions de sécurité\r\n- outils de préventions \r\n- secourisme et premiers soins\r\n- Test et simulation', NULL, 20, '2020-10-21 11:44:28', '2020-10-21 11:44:28'),
(55, 'Gestion de projet', '- Apporter aux ingénieurs et cadres les techniques et méthodes de base de l\'ingénierie et du management de projet.\r\n- Les entrainer à l\'utilisation des techniques et des outils pour leur permettre une mise en œuvre opérationnelle réussie.', '- Comprendre le mode projet\r\n- Connaître les acteurs du mode projet\r\n- De l\'expression du besoin au cahier des charges du projet\r\n- La construction de la logique d\'un projet\r\n- Les techniques d\'estimation\r\n- La planification des délais et des ressources d\'un projet\r\n- La planification des coûts d\'un projet\r\n- La construction du plan de développement d\'un projet : logique, structure, organisation\r\n- La prise en compte des risques dans un projet\r\n- Le processus du pilotage d\'un projet\r\n- Savoir construire un tableau de bord de suivi d\'avancement\r\n- Connaître et savoir utiliser la gestion d\'un projet par la valeur acquise\r\n- Savoir prendre des engagements', NULL, 10, '2020-10-21 11:46:20', '2020-10-21 11:46:20'),
(56, 'Planification et ordonnancement', '• Faire le point sur les différents outils et méthodes de planification de la production. \r\n• Etre capable de choisir les outils de planification en fonction du besoin en production. \r\n• S’approprier ces outils en vue d’optimiser la préparation, l’organisation et la gestion de la production.', 'Appréhender les principes de la planification et de l’ordonnancement \r\n• Approche de l’entreprise par les flux \r\n• Importance de la gestion industrielle\r\n• Les coûts et les enjeux en présence \r\n• Les différents horizons de la planification : long, moyen et court terme\r\n• Les différentes typologies industrielles\r\n\r\nIdentifier les différents modèles de la gestion de production \r\n• La place de la gestion de production dans l’entreprise\r\n• Les évolutions actuelles : le juste-à-temps (J.A.T), la flexibilité (S.M.E.D), la mesure de la performance \r\n• La GPAO, le MRP2, l’ERP et le KANBAN\r\n\r\nÉlaborer les budgets industriels par la planification\r\n• Comment maîtriser les outils pour décliner un PIC (Plan Industriel et Commercial) en PDP (Programme Directeur de Production)\r\n• Identifier et sécuriser les données d’entrée nécessaires au calcul \r\n• Les éléments de restitution du système\r\n\r\nMaîtriser les techniques d’ordonnancement\r\n• L’ordonnancement au service de la satisfaction client\r\n• Réaliser les programmes d’expédition, de production et d’approvisionnement \r\n• Maîtriser le calcul des besoins nets (CBN)\r\n• Réaliser le calcul des charges par rapport à la capacité (infinie et finie)\r\n• Équilibrer la charge par rapport à la capacité', NULL, 14, '2020-10-21 11:47:24', '2021-01-21 09:43:50'),
(57, 'Approche générale de la sécurité et de l\'hygiène', '- Découvrir l\'approche de prévention des risques professionnels.\r\n- Connaître les contours de la réglementation', '- Cadre juridique de la sécurité \r\n- La responsabilité juridique et le droit pénal \r\n- Politique de prévention\r\n- Développement des compétences et formation\r\n- La sécurité au travail\r\n- Les obligations des employés et réglementation du travail\r\n- les réunions de sécurité\r\n- outils de préventions \r\n- secourisme et premiers soins\r\n- Test et simulation', NULL, 20, '2020-10-21 12:04:58', '2020-10-21 12:04:58'),
(58, 'Techniques d\'élaboration des tableaux de bord', '- Acquérir les méthodes et outils pour réaliser des tableaux de bord financiers et de gestion\r\n- Optimiser les tableaux de bord financiers de son entreprise', 'A- Les principes généraux des tableaux de bord financiers et de gestion\r\n- Rôle et définitions des tableaux de bord financiers\r\n- Identifier les tableaux de bord indispensables\r\n- Réaliser une cartographie de vos tableaux de bord\r\n\r\nB - La construction des tableaux de bord financiers et de gestion\r\n- Clarifier la demande des destinataires\r\n- Adapter le contenu, la fréquence de diffusion des tableaux de bord\r\n- Choix des indicateurs et objectifs\r\n\r\nC - Améliorer vos tableaux de bord financiers et de gestion\r\n- Sur le fond\r\n. Connaître les principaux ratios de la fonction.\r\n. Utiliser les outils statistiques appropriés (moyenne, médiane, écart-type, etc.)\r\n- Sur la forme\r\n. Savoir utiliser à bon escient histogrammes, pictogrammes, nuages de points, etc.\r\n. Connaître les tendances actuelles de présentation\r\n. Utiliser les nouveaux outils de communication', NULL, 14, '2020-10-21 12:17:37', '2020-10-21 12:17:37'),
(59, 'Management Efficacité Personnelle et Communication', '- Apporter aux ingénieurs et cadres les techniques et méthodes de base de l\'ingénierie et du management de projet.\r\n- Les entrainer à l\'utilisation des techniques et des outils pour leur permettre une mise en œuvre opérationnelle réussie.', '- S\'automotiver\r\n- Développer en permanence ses propres talents.\r\n- Bâtir et rebâtir son projet professionnel.\r\n- S\'enthousiasmer pour atteindre ses objectifs.\r\n- Développer la confiance en soi.\r\n- Animer une réunion\r\n- La communication face à un groupe et les rôles.\r\n- Les techniques d\'animateur.\r\n- Les outils de communication face à un groupe.\r\n- Gérer les conflits\r\n- Gérer le stress\r\n- Gérer son temps', NULL, 10, '2020-10-21 13:46:51', '2020-10-21 13:46:51'),
(60, 'Distribution et logistique', '- Analyser les flux physiques et d\'information en privilégiant la cohérence entre les principaux sous-systèmes de l\'entreprise et en mettant en évidence tous les dysfonctionnements.\r\n- Synchroniser et maintenir la cohérence des opérations industrielles.\r\n- Proposer des solutions objectives permettant de retrouver une cohérence interne notamment en décloisonnant toutes les fonctions de la chaîne logistique.', '-  Généralité sur la logistique \r\n-  Stratégie et logistique\r\n- Mise en œuvre de la logistique \r\n-  Conception et développement des produits\r\n-  Gestion de la production et gestion de la distribution\r\n-  Commercialisation et distribution\r\n-  L\'après-vente et le soutien\r\n-  Méthodes et outils', NULL, 15, '2020-10-21 13:59:23', '2020-10-21 13:59:23'),
(61, 'Fiscalité des entreprise', '- Maitriser les règles de calcul de l\'IS, de la TVA et l\'application des droits à la déduction.\r\n- Etre en mesure de prévenir les risques fiscaux et être à mesure de faire face à un contrôle.\r\n- Maîtriser les risques liés aux différentes obligations déclaratives qui pèsent sur votre entreprise.', '- Impôt sur le revenu,\r\n- Impôt sur les sociétés,\r\n- TVA,\r\n- Les droits d’enregistrement,\r\n- La fiscalité locale,\r\n- Détection des risques fiscaux,\r\n- les déclarations fiscales et sociales,', NULL, 16, '2020-10-21 14:08:07', '2020-10-21 14:08:07'),
(62, 'Techniques de recouvrement', '- Recouvrer efficacement les sommes dues via les procédures amiables et contentieuses\r\n- Identifier les premiers symptômes de défaillance du débiteur\r\n-Connaître les enjeux et les bénéfices d’un solide recouvrement', '- Les enjeux d’une bonne maîtrise des techniques de recouvrement\r\n- Prévenir les impayés\r\n- Favoriser le recouvrement amiable\r\n-entrée en contact et précautions à prendre afin de garder le dialogue avec le débiteur\r\n-ton, termes à employer, intérêt de la mise en demeure\r\n-procédure de A à Z pour mener la transaction\r\n- Obtenir le paiement devant les tribunaux\r\n-juridictions compétentes\r\n-procédure en injonction de payer\r\n-relations avec les avocats et huissiers de justice\r\n-mise en œuvre du jugement et exécution provisoire', NULL, 11, '2020-10-21 14:14:57', '2020-10-21 14:14:57'),
(63, 'Comptabilité Analytique', '- Maîtriser les principes et les règles de la comptabilité analytique.\r\n- Exploiter et utiliser à bon escient les différentes méthodes de calcul des coûts pour procéder à des évaluations                   - Appropriées des performances réalisées en terme d\'efficience des opérations.', '1/ Enrichir les analyses de gestion grâce à la comptabilité analytique\r\nLa comptabilité de gestion.\r\nRetraiter des charges de la comptabilité générale.\r\nRépondre au besoin d\'analyse multidimensionnelle de l\'activité.\r\n2/ Mesurer les enjeux des coûts grâce aux coûts complets\r\nDistinguer les charges directes et indirectes.\r\nDéterminer les centres analytiques (ou sections).\r\nChoisir les unités d\'œuvre et les clés de répartition.\r\nValoriser les stocks.\r\nLes utilisations : améliorer la productivité, gérer les indirects…\r\n3/ Accompagner les décisions grâce aux coûts partiels\r\nDistinguer les charges fixes et les charges variables.\r\nAnalyser les différents niveaux de marges de contribution.\r\nDéterminer le point mort ou seuil de rentabilité.\r\nLes utilisations : faire ou faire faire, négocier un prix…\r\n4/ Approfondir les analyses de gestion grâce à la méthode des coûts par activités (ABC)\r\nL\'intérêt d\'une nouvelle méthode.\r\nDéfinir et valoriser les activités.\r\nDiversifier et choisir les inducteurs d\'activités.\r\nCalculer les coûts des inducteurs et les coûts des objets de coût.\r\nLes utilisations : piloter les processus, gérer la diversité…\r\n5/ Anticiper pour faire évoluer le système de gestion\r\nLes étapes de mise en place d\'une comptabilité analytique.\r\nLes facteurs clés de succès.', NULL, 16, '2020-10-21 14:19:46', '2020-10-22 09:01:59'),
(64, 'Présentation de la norme SMQ 9001 V 2015', '- Initiation et sensibilisation au SMQ', '- Initiation au Système de Management de la Qualité.\r\n- Démarche d\'implantation d\'un Système de Management de la Qualité \" SMQ \"\r\n-Exigences de la norme qualité (ISO9001 : 2008).\r\n- Approche processus.\r\n-Cercles de la qualité.\r\n- Traitement des COQ et des défauts de contribution.', NULL, 12, '2020-10-21 14:21:16', '2020-10-21 14:21:16'),
(65, 'SMQ et organisation d\'entreprise', 'Sensibiliser sur l’apport d’une organisation efficace pour transformer la vision stratégique en objectifs opérationnels.\r\nL’importance des processus et des ressources humaines pour la mise en œuvre d’une organisation S\'initier à L\'état d\'esprit qualité et comprendre les principes de base d\'un système de management par La qualité et les démarches de sa mise en place.\r\nAcquérir une méthodologie et maîtriser les outils et les techniques de management de la qualité et de l\'amélioration continue\r\nDéfinir les indicateurs pertinents d\'un processus et suivre les tableaux de bord efficacement', '- Tour de table\r\n- Enjeux de l’organisation\r\nLes enjeux de l’organisation.\r\nRôle de l’organisation pour la mise en œuvre des orientations stratégiques.\r\n- Préalable sur la Qualité\r\nLa notion de Qualité.\r\nLes définitions de la Qualité.\r\nL’évolution historique de la notion de Qualité.\r\n- La Qualité Totale\r\nLes trois principaux modes d’approche de la qualité. \r\nLa Qualité totale.\r\nLes étapes de la mise en place d’un système Qualité.\r\n- Normalisation & Certification\r\nLes trois types de certification.\r\nLa procédure de certification.\r\nLes normes de certification.\r\nLa norme ISO 9001 version 2008.\r\n- Le contexte de la Qualité au Maroc\r\n- Présentation d’un cas réel', NULL, 12, '2020-10-22 05:48:53', '2021-01-20 13:26:27'),
(66, 'Approche générale de la GRH', '- Acquérir et maitriser les outils de la GRH.\r\n- Etre capable de gérer et d’optimiser l’allocation des ressources humaines.\r\n- Prévenir les risques réglementaires et juridiques.', '-Les bases de la GRH et du management RH \r\n- La gestion prévisionnelle des emplois et compétences\r\n- Négocier et rédiger le contrat de travail \r\n- Les techniques de recrutement \r\n- La gestion des rémunérations \r\n- La gestion de la formation et comment évaluer l’efficacité de la formation  \r\n- L’évaluation du personnel et les techniques de gestion de carrière \r\n- Tableaux de bord social et outils de mesure de performance RH\r\n- Sécuriser la rupture du contrat de travail \r\n- Durée de travail : organiser et aménager le temps de travail et  la gestion des congés et plan d’intérim.\r\n-Conformité à la législation du travail et protections collectives', NULL, 13, '2020-10-22 13:35:03', '2020-10-22 13:35:03'),
(67, 'ISO 22000 — Management de la sécurité des denrées', '- Acquérir une méthodologie et les moyens pour développer une démarche sécurité des aliments selon une approche système de management.\r\n- Connaître la logique et la structure de la norme ISO 22000 : 2018.\r\n- Identifier et savoir répondre aux exigences de la norme ISO 22000. \r\n- Se préparer à la certification ISO 22000 : 2018.', 'A- QUELS SONT LES ENJEUX DE LA SÉCURITÉ DES ALIMENTS ?\r\n-Outil : le contexte de la sécurité des aliments.\r\n-Apports : l’état des lieux de la sécurité des aliments.\r\nB- QUELLE EST LA STRUCTURE DE LA NORME ISO 22000 : 2018 ?\r\n-Outil : la structure de la nouvelle norme ISO 22000.\r\n-Apports : la structure de haut niveau (HLS), la logique de la norme, les définitions à connaître (PRP, CCP, PRPO…), la famille des normes ISO 22000, les évolutions par rapport à la version 2005.\r\nC- QUELLES SONT LES EXIGENCES DE L’ISO 22000 ET COMMENT Y RÉPONDRE ?\r\n-Compréhension de l’organisme et de son contexte, les parties intéressées.\r\n-Actions à mettre en œuvre (risques / opportunités).\r\n-Vérification relative aux PRP et au plan de maîtrise des dangers.\r\n-Maîtrise de non-conformités produites & processus.\r\nD- COMMENT SE DÉROULE UN AUDIT DE CERTIFICATION ISO 22000 ?\r\n-Outil : le processus d’audit de certification.\r\n-Apports : la période de transition entre les 2 versions, les incontournables du plan d’audit, le classement des écarts.', NULL, 12, '2020-10-22 13:36:08', '2020-10-22 13:36:08'),
(68, 'Norme HACCP : Normes D\'hygiène de l\'agroalimentaire', '- Comprendre et maîtriser les règles d’hygiène alimentaire.\r\n- Analyser les risques et mettre en place les mesures nécessaires pour pallier aux risques alimentaires\r\n- Appliquer ces règles à son environnement professionnel.', '- Définitions des termes et concepts des bases HACCP\r\n- Le danger : identification des dangers\r\n- Le risque : analyse des risques\r\n- Les Bonnes Pratiques de Fabrication (BPF)\r\n- La démarche HACCP : maitrise du point critique et vérification', NULL, 12, '2020-10-22 13:37:10', '2020-10-22 13:37:10'),
(69, 'Gestion des approvisionnements', '-s\'approprier des méthodes concrètes et des outils pratiques pour optimiser les processus de gestion des stocks et des approvisionnements de son entreprise', 'Définir les responsabilités de l\'approvisionneur\r\n-Le rôle et l\'importance de la mission approvisionnement dans l\'entreprise\r\n-Le positionnement de la fonction approvisionnement dans la supply chain\r\n-La clarification des principales tâches et objectifs de l\'approvisionneur\r\nApprendre les grands principes de gestion des stocks\r\n-Définitions des stocks et Leur utilité\r\n-Les types de gestion des stocks\r\n-Les différentes visions d’un stock\r\n-Les différentes familles de produits stockés\r\nAssurer la tenue et le suivi des stocks\r\n-Les mouvements de stock\r\n-La fiche de suivi des stocks\r\n-Les systèmes d’information de gestion des stocks\r\n-Les inventaires\r\n-La valorisation des stocks\r\nLes indicateurs de suivi des stocks', NULL, 7, '2020-10-23 05:16:15', '2020-10-23 05:16:15'),
(70, 'Approche générale de la GRH', '- Acquérir et maitriser les outils de la GRH.\r\n- Etre capable de gérer et d’optimiser l’allocation des ressources humaines.\r\n- Prévenir les risques réglementaires et juridiques.', '-Les bases de la GRH et du management RH \r\n- La gestion prévisionnelle des emplois et compétences\r\n- Négocier et rédiger le contrat de travail \r\n- Les techniques de recrutement \r\n- La gestion des rémunérations \r\n- La gestion de la formation et comment évaluer l’efficacité de la formation  \r\n- L’évaluation du personnel et les techniques de gestion de carrière \r\n- Tableaux de bord social et outils de mesure de performance RH\r\n- Sécuriser la rupture du contrat de travail \r\n- Durée de travail : organiser et aménager le temps de travail et la gestion des congés et plan d’intérim.\r\n-Conformité à la législation du travail et protections collectives', NULL, 9, '2020-10-23 05:17:41', '2020-10-23 05:17:41'),
(71, 'Techniques d\'élaboration des tableaux de bord', '- Acquérir les méthodes et outils pour réaliser des tableaux de bord financiers et de gestion\r\n- Optimiser les tableaux de bord financiers de son entreprise', 'A- Les principes généraux des tableaux de bord financiers et de gestion\r\n- Rôle et définitions des tableaux de bord financiers\r\n- Identifier les tableaux de bord indispensables\r\n- Réaliser une cartographie de vos tableaux de bord\r\n\r\nB - La construction des tableaux de bord financiers et de gestion\r\n- Clarifier la demande des destinataires\r\n- Adapter le contenu, la fréquence de diffusion des tableaux de bord\r\n- Choix des indicateurs et objectifs\r\n\r\nC - Améliorer vos tableaux de bord financiers et de gestion\r\n- Sur le fond\r\n. Connaître les principaux ratios de la fonction.\r\n. Utiliser les outils statistiques appropriés (moyenne, médiane, écart-type, etc.)\r\n- Sur la forme\r\n. Savoir utiliser à bon escient histogrammes, pictogrammes, nuages de points, etc.\r\n. Connaître les tendances actuelles de présentation\r\n. Utiliser les nouveaux outils de communication', NULL, 4, '2020-10-23 05:21:18', '2020-10-23 05:21:18'),
(72, 'ISO 22000 Management de la sécurité des denrées', '- Acquérir une méthodologie et les moyens pour développer une démarche sécurité des aliments selon une approche système de management.\r\n- Connaître la logique et la structure de la norme ISO 22000 : 2018.\r\n- Identifier et savoir répondre aux exigences de la norme ISO 22000. \r\n- Se préparer à la certification ISO 22000 : 2018.', 'A- QUELS SONT LES ENJEUX DE LA SÉCURITÉ DES ALIMENTS ?\r\n-Outil : le contexte de la sécurité des aliments.\r\n-Apports : l’état des lieux de la sécurité des aliments.\r\nB- QUELLE EST LA STRUCTURE DE LA NORME ISO 22000 : 2018 ?\r\n-Outil : la structure de la nouvelle norme ISO 22000.\r\n-Apports : la structure de haut niveau (HLS), la logique de la norme, les définitions à connaître (PRP, CCP, PRPO…), la famille des normes ISO 22000, les évolutions par rapport à la version 2005.\r\nC- QUELLES SONT LES EXIGENCES DE L’ISO 22000 ET COMMENT Y RÉPONDRE ?\r\n-Compréhension de l’organisme et de son contexte, les parties intéressées.\r\n-Actions à mettre en œuvre (risques / opportunités).\r\n-Vérification relative aux PRP et au plan de maîtrise des dangers.\r\n-Maîtrise de non-conformités produites & processus.\r\nD- COMMENT SE DÉROULE UN AUDIT DE CERTIFICATION ISO 22000 ?\r\n-Outil : le processus d’audit de certification.\r\n-Apports : la période de transition entre les 2 versions, les incontournables du plan d’audit, le classement des écarts.', NULL, 6, '2020-10-23 05:22:58', '2020-10-23 05:22:58'),
(73, 'Norme HACCP : Normes d\'hygiène de l\'agroalimentaire', '- Comprendre et maîtriser les règles d’hygiène alimentaire.\r\n- Analyser les risques et mettre en place les mesures nécessaires pour pallier aux risques alimentaires\r\n- Appliquer ces règles à son environnement professionnel.', '- Définitions des termes et concepts des bases HACCP\r\n- Le danger : identification des dangers\r\n- Le risque : analyse des risques\r\n- Les Bonnes Pratiques de Fabrication (BPF)\r\n- La démarche HACCP : maitrise du point critique et vérification', NULL, 6, '2020-10-23 05:27:19', '2020-10-23 05:27:19'),
(74, 'Management des Personnes et des Equipes', '- Mener une équipe en appliquant les techniques de communication efficaces\r\n-Faire passer la vision et l’inspiration aux membres de l’équipe\r\n-Fixer d’une manière claire les objectifs de l’équipe\r\n- Assurer l’efficacité de l’équipe\r\n-Gérer les situations difficiles et les situations de conflit entre les membres de l’équipe\r\n-Conduire efficacement les réunions d’équipe', '- La communication\r\n- Les styles de leadership\r\n-Le travail du personnel comme une équipe\r\n- Les étapes du développement de l’équipe.\r\n-Les caractéristiques de l’équipe efficace.\r\n-La vision et l’inspiration ; travailler pour atteindre un objectif commun\r\n-La gestion des performances\r\n-Le traitement des conflits au sein de l’équipe\r\n-La conduite des réunions d’équipe', NULL, 3, '2020-10-23 05:29:24', '2020-10-23 05:29:24'),
(75, 'Planification et ordonnancement', 'Faire le point sur les différents outils et méthodes de planification des travaux. • Etre capable de choisir les outils de planification en fonction des travaux à réaliser. • S’approprier ces outils en vue d’optimiser la préparation, l’organisation et la gestion des chantiers.', 'Prise en main du dossier marché\r\n• Analyse du cahier des charges : CCTP, CCAG, … ; • Analyse des besoins et fiches de synthèse par corps d’état. ; • Mise à jour des difficultés de réalisation (marché, délais, occupants, techniques, accès, approvisionnements, …) ; • Définition des modes constructifs.\r\nEtude de chantier\r\n• Détermination du plan de découpage du chantier ; • Prise en compte du mode d’intervention des entreprises ; • Préparation et définition des tâches à planifier ; • Calculs et détermination des durées de tâches ; • Etudes des enclenchements et détermination du chemin critique.\r\n• Affectation des ressources et des effectifs aux différentes tâches ; • Vérification de la faisabilité et réflexion sur les différentes options et hypothèses prises lors de l’étude du chantier.\r\nPlanification des travaux\r\n• Ebauche de planification des travaux en fonction du plan de découpage du chantier (bâtiment, cages d’escalier, étages, …) ; • Simulation de déroulement de chantier (phases, cadences, équipes).\r\n• Tracé récapitulatif et organisation du planning ; • Détermination du chemin critique définitif et repérages des tâches le composant.\r\nMise en oeuvre des plannings\r\n• Méthodes et choix de représentation ; • Application et cas d’études et de travaux.\r\nBudgétisation des travaux\r\n• Mise en place des informations financières sur le planning ; • Synthèses des informations figurant sur les plannings (clarté, visuel) ; • Vérification de la précision et de la pertinence des informations.\r\nGestion financière des travaux\r\n• Suivi des coûts ; • Estimation du coût final de l’ouvrage\r\nRéunion de chantier\r\n• Positionnement et intervention du responsable travaux ; • Défendre ses intérêts : délais, recalage du planning.', NULL, 4, '2020-10-23 05:35:41', '2020-10-23 05:35:41'),
(76, 'Comptabilité analytique', '- Maîtriser les principes et les règles de la comptabilité analytique.\r\n- Exploiter et utiliser à bon escient les différentes méthodes de calcul des coûts pour procéder à des évaluations                   - Appropriées des performances réalisées en terme d\'efficience des opérations.', '1/ Enrichir les analyses de gestion grâce à la comptabilité analytique\r\nLa comptabilité de gestion.\r\nRetraiter des charges de la comptabilité générale.\r\nRépondre au besoin d\'analyse multidimensionnelle de l\'activité.\r\n2/ Mesurer les enjeux des coûts grâce aux coûts complets\r\nDistinguer les charges directes et indirectes.\r\nDéterminer les centres analytiques (ou sections).\r\nChoisir les unités d\'œuvre et les clés de répartition.\r\nValoriser les stocks.\r\nLes utilisations : améliorer la productivité, gérer les indirects…\r\n3/ Accompagner les décisions grâce aux coûts partiels\r\nDistinguer les charges fixes et les charges variables.\r\nAnalyser les différents niveaux de marges de contribution.\r\nDéterminer le point mort ou seuil de rentabilité.\r\nLes utilisations : faire ou faire faire, négocier un prix…\r\n4/ Approfondir les analyses de gestion grâce à la méthode des coûts par activités (ABC)\r\nL\'intérêt d\'une nouvelle méthode.\r\nDéfinir et valoriser les activités.\r\nDiversifier et choisir les inducteurs d\'activités.\r\nCalculer les coûts des inducteurs et les coûts des objets de coût.\r\nLes utilisations : piloter les processus, gérer la diversité…\r\n5/ Anticiper pour faire évoluer le système de gestion\r\nLes étapes de mise en place d\'une comptabilité analytique.\r\nLes facteurs clés de succès.', NULL, 22, '2020-10-23 05:40:57', '2020-10-23 05:40:57'),
(77, 'Législation du travail', '- Maîtriser les bases de la réglementation en droit social\r\n-Appliquer le droit du travail\r\n-Gérer efficacement les dossiers du personnel', 'Code du travail\r\n- Conventions et accords collectifs\r\n- Les usages d’entreprise.\r\n- Les obligations légales liées à l’embauche\r\n- Les différents contrats de travail\r\n- La durée du travail\r\n- Le bulletin de paie\r\n- Les compléments du salaire\r\n- Les principales absences\r\n- Les sanctions\r\n- La rupture du contrat de travail\r\n- La formation professionnelle : le point sur la réforme', NULL, 9, '2020-10-23 06:04:57', '2020-10-23 06:04:57'),
(78, 'Audit interne selon ISO 9001 V2015', 'Evaluer un Système de Management de la Qualité (SMQ) selon l\'ISO 9001 version 2015\r\nAcquérir des outils pour conduire efficacement ses audits internes ISO 9001\r\nFaire de l\'audit interne qualité un outil d\'amélioration continue', '1. Exigences des normes ISO\r\nrappels sur l’ISO 9001:2015/définition et objectifs d’un audit interne\r\nrôles et responsabilités des auditeurs et audités/étapes de l’audit\r\nplanning d\'audits : programmation et déclenchement de l\'audit\r\n2. Préparation de l\'audit \r\ndésignation de l\'équipe d\'auditeurs : qui peut auditer quoi ?\r\ndétermination du périmètre et du champ de l\'audit : qu\'audite-t-on ?\r\ncollecte et analyse des documents/préparation du plan d\'audit\r\nélaboration des documents d\'aide à l\'audit et questionnaires spécifiques\r\n3. Réalisation de l\'audit interne ISO 9001\r\nanimer la réunion d\'ouverture/se répartir les tâches de l\'audit\r\nconduire les entretiens/identifier les écarts/préparer et animer la réunion de clôture\r\n4. Auditeurs et audités, les comportements efficaces\r\nbien communiquer sur son rôle et sa mission/développer sa capacité d\'écoute\r\nfavoriser la coopération par ses attitudes/adapter son langage à ses interlocuteurs et savoir réagir face à des comportements de méfiance, diversions, rétention d\'informations\r\nprévenir et désamorcer les conflits\r\n5. L\'audit, source d\'amélioration continue \r\nmesurer et formaliser les écarts/rapport d\'audit : contenu, rédaction, enregistrement et diffusion\r\ndéfinition et planification des actions correctives/suivi de leur mise en œuvre\r\nprendre du recul sur sa méthode d\'audit interne : indicateurs, mesure de la satisfaction et exploitation des retours d\'expériences', NULL, 6, '2020-10-23 06:06:07', '2020-10-23 06:06:07'),
(79, 'ISO 14000 — Management environnemental', 'Fournir les connaissances relatives aux normes environnementales ISO 14000 ainsi qu\'à leur application.', '-	Connaissances de base en sciences de l\'environnement, développement durable et industries ;\r\n-	Contexte, historique et introduction aux normes environnementales en général et plus spécifiquement aux normes ISO 14000 ;\r\n-	Planification stratégique d\'un programme de gestion environnementale ISO 14000 vs ISO 9000 ;\r\n-	Description générale des normes ISO 14000 (système de management environnemental, vérification (audit) d\'environnement, étiquetage, cycle de vie des matières premières et des produits finis, performance environnementale) ; \r\n-	Implantation et certification de ISO 14000.', NULL, 6, '2020-10-23 07:29:12', '2020-10-23 07:29:12'),
(80, 'Lean manufacturing et six sigma', '- S\'approprier les concepts du Lean Management.\r\n- Associer Lean Management et Six Sigma dans les services.\r\n- Construire et piloter une démarche Lean 6 Sigma dans l\'entreprise', 'A-  Les méthodes de management Lean\r\n- Le value stream mapping, pour définir les priorités.\r\n- La résolution de problème, pour ne rien oublier\r\n- Le 5S, pour apprendre à manager l\'amélioration continue\r\nB- Déployer le Lean 6 Sigma\r\n-Le management visuel, pour impliquer les acteurs.\r\n-Le brainstorming pour innove\r\n-La communication associée, adapter les mots à la culture.\r\n-Le reporting, le ROI, le factuel pour convaincre.', NULL, 3, '2020-10-23 09:56:51', '2020-10-23 09:56:51'),
(81, 'IFS Norme Internationale pour la sécurité des Aliments', '•	Etablir un référentiel commun, avec un système d\'évaluation uniforme,\r\n•	Assurer la transparence et la possibilité de comparaisons tout au long de la chaîne d\'approvisionnements,\r\n•	Réduire les coûts et le temps liés aux audits, tant pour les distributeurs que pour les fournisseurs.', '•	Identifier les processus nécessaires pour le système de management de la qualité et de la sécurité des aliments,\r\n•	Déterminer la séquence et l\'interaction de ces processus,\r\n•	Déterminer les critères et les méthodes nécessaires pour assurer le fonctionnement efficace et la maîtrise de ces processus,\r\n•	Assurer la disponibilité des informations nécessaires pour encourager le fonctionnement et la surveillance de ces processus,\r\n•	Mesurer, surveiller et analyser ces processus, et mettre en place les actions nécessaires pour atteindre les résultats prévus et une amélioration continue.', NULL, 6, '2020-10-23 10:16:16', '2020-10-23 10:16:16'),
(82, 'Gestion de Projet', '- Apporter aux ingénieurs et cadres les techniques et méthodes de base de l\'ingénierie et du management de projet.\r\n- Les entrainer à l\'utilisation des techniques et des outils pour leur permettre une mise en œuvre opérationnelle réussie.', '- Comprendre le mode projet\r\n- Connaître les acteurs du mode projet\r\n- De l\'expression du besoin au cahier des charges du projet\r\n- La construction de la logique d\'un projet\r\n- Les techniques d\'estimation\r\n- La planification des délais et des ressources d\'un projet\r\n- La planification des coûts d\'un projet\r\n- La construction du plan de développement d\'un projet : logique, structure, organisation\r\n- La prise en compte des risques dans un projet\r\n- Le processus du pilotage d\'un projet\r\n- Savoir construire un tableau de bord de suivi d\'avancement\r\n- Connaître et savoir utiliser la gestion d\'un projet par la valeur acquise\r\n- Savoir prendre des engagements', NULL, 3, '2020-10-23 10:19:03', '2020-10-23 10:19:03'),
(83, 'Santé sécurité au travail', '- Identifier et respecter les exigences essentielles pour suivre sereinement son activité\r\n- Faire le point sur l\'actualité réglementaire incontournable\r\n- Organiser sa gestion de la sécurité et santé au travail pour l\'ensemble des risques', '- Comprendre la réglementation sécurité et santé au travail\r\n*Identifier les sources de droit\r\n*Appréhender l\'articulation des textes réglementaires\r\n*La délégation de pouvoir, la responsabilité civile et pénale\r\n- Identifier les principales obligations réglementaires et les dernières exigences\r\n*Obligation générale de prévention\r\n*Obligation de résultat pour l\'employeur et ses délégataires\r\n*Évaluation des risques professionnels et Document Unique\r\n- Appliquer les obligations\r\n- Système de gestion de la sécurité et la santé au travail\r\n*Les différentes étapes de la mise en place d\'un système de management santé-sécurité\r\n*Lien entre le Code du Travail et le système de management SST\r\n*Le Document Unique et la démarche de management de la sécurité et santé au travail', NULL, 23, '2020-10-23 10:22:23', '2020-10-23 10:22:23'),
(84, 'Démarche d\'audit interne', '- Maîtriser toutes les étapes pour réaliser un audit qualité interne.', '- Identifier les points clés du processus d’audit\r\n*Objectifs de l’audit qualité interne\r\n*Le déroulement des différentes phases\r\n*Rôle et règles de déontologie de l’auditeur\r\n- Préparer l’audit qualité interne\r\n*Mandatement : objectifs, référentiel et champs de l’audit\r\n*Analyse préliminaire de l’entité à auditer\r\n*Élaboration d’un plan d’audit et d’un guide d’audit\r\n- Réaliser l’audit qualité interne\r\n*Animation de la réunion d’ouverture\r\n*Conduire des entretiens\r\n*Observations et collecte des données\r\n*Détection et mise en évidence des écarts\r\n- Conclure l’audit qualité interne\r\n*Synthèse et formalisation des écarts\r\n*Préparation et animation de la réunion de clôture\r\n*Rédaction du rapport d’audit\r\n*Clôture de l’audit', NULL, 10, '2020-10-23 12:13:28', '2020-10-23 12:13:28'),
(85, 'IFS Norme Internationale pour la sécurité des Aliments', '•Etablir un référentiel commun, avec un système d\'évaluation uniforme,\r\n•Assurer la transparence et la possibilité de comparaisons tout au long de la chaîne d\'approvisionnements,\r\n•Réduire les coûts et le temps liés aux audits, tant pour les distributeurs que pour les fournisseurs.', '•Identifier les processus nécessaires pour le système de management de la qualité et de la sécurité des aliments,\r\n•Déterminer la séquence et l\'interaction de ces processus,\r\n•Déterminer les critères et les méthodes nécessaires pour assurer le fonctionnement efficace et la maîtrise de ces processus,\r\n•Assurer la disponibilité des informations nécessaires pour encourager le fonctionnement et la surveillance de ces processus,\r\n•Mesurer, surveiller et analyser ces processus, et mettre en place les actions nécessaires pour atteindre les résultats prévus et une amélioration continue.', NULL, 12, '2020-10-23 12:18:50', '2021-01-20 12:41:13'),
(86, 'ISO 14000 - Management environnemental', 'Fournir les connaissances relatives aux normes environnementales ISO 14000 ainsi qu\'à leur application.', '- Connaissances de base en sciences de l\'environnement, développement durable et industries ;\r\n- Contexte, historique et introduction aux normes environnementales en général et plus spécifiquement aux normes ISO 14000 ;\r\n- Planification stratégique d\'un programme de gestion environnementale ISO 14000 vs ISO 9000 ;\r\n- Description générale des normes ISO 14000 (système de management environnemental, vérification (audit) d\'environnement, étiquetage, cycle de vie des matières premières et des produits finis, performance environnementale) ; \r\n- Implantation et certification de ISO 14000.', NULL, 12, '2020-10-23 12:23:20', '2021-01-20 12:44:19'),
(87, 'Excel avancé', '-Utiliser Excel pour gagner du temps \r\n-Importer et organiser ses données \r\n-Automatiser et fiabiliser les calculs  \r\n-Maîtriser les fonctionnalités importantes et utiles d’Excel', '1/- Optimiser les outils gains de temps \r\n2/- Construire des formules de calculs simples et élaborées \r\n3/- Exploiter une liste de données\r\n4/- Mettre en place des tableaux dynamiques croisés dynamiques \r\n5/- Lier et consolider les données  \r\n6/- Préparer, organiser et contrôler les données\r\n7/- Optimiser, automatiser et fiabiliser les calculs : formules complexes et imbriquées, calculs matriciels \r\n8/- Automatiser la présentation des tableaux \r\n9/- Faire des simulations, Etablir des prévisions', NULL, 24, '2020-10-23 12:28:16', '2020-10-23 12:28:16'),
(88, 'Techniques et outils de communication', '- Comprendre les mécanismes de base de communication interpersonnelle\r\n- Rédiger des comptes rendus utiles et efficaces\r\n- Rédiger des courriels efficaces', '- La communication au sein de l’entreprise \r\n-La communication dans l’entreprise \r\n-Forme de communication, réseaux et outils de la communication \r\n- Rédiger des courriels efficaces\r\n-Principes de la communication par courriel \r\n-Analyse de la demande : comprendre les attentes du destinataire \r\n-Processus de rédaction : les étapes de l’écriture \r\n-Techniques pour rédiger un objet efficace \r\n-Liste des critères de lisibilité : conception d’un message concis et clair\r\n- Prendre des notes et rédiger des comptes rendus   \r\n- Exploration de différentes méthodes de prises de notes : linéaire, synoptique, en arborescence \r\n-Préparation de la prise de notes \r\n-Techniques pour repérer l’essentiel d’un propos \r\n-Enjeux du compte rendu et attentes du destinataire \r\n-Mise en page d’un compte rendu \r\n-Liste des critères de lisibilité : conception d’un message clair et concis \r\n-8 étapes incontournables pour réussir un compte rendu', NULL, 19, '2020-10-23 12:30:22', '2020-10-23 12:30:22'),
(89, 'Formation Non logisticien', '•Intégrer les principes fondamentaux d\'une organisation logistique\r\n•Identifier les parties prenantes à la chaîne logistique et leurs interactions\r\n•Comprendre les techniques et méthodes utilisées en logistique\r\n•Assurer la satisfaction client et contribuer au bon fonctionnement de l\'entreprise', '•Le rôle de la logistique dans l\'entreprise. Les besoins en logistique.\r\n•Les principes de gestion des stocks.\r\n•Les objectifs de la logistique.\r\n•Les enjeux économiques, juridiques, financiers, l\'image de marque, etc.\r\n•Le périmètre couvert par la logistique.\r\n•Les coûts logistiques.\r\n•Les principaux acteurs dans la logistique.\r\n•Les différents types de transport utilisés par la logistique (routier, maritime, aérien).\r\n•Les caractéristiques des marchandises influencent le choix des moyens de transport. Choisir les transports appropriés.\r\n•Les quantités de marchandises. La prise en compte des délais. La gestion des coûts.', NULL, 15, '2020-10-23 14:10:34', '2021-01-20 12:04:17'),
(90, 'Préparation des Commandes', 'Connaître et comprendre les différentes méthodes de préparation de commande', '1. DÉFINITION DE LA FONCTION PRÉPARATION DE COMMANDE\r\n•Importance dans la logistique de distribution\r\n•Les objectifs\r\n•Le traitement\r\n2. LES SYSTÈMES PHYSIQUES DE PRÉPARATION\r\n•La préparation physique\r\n•Les systèmes de collecte\r\n•L’optimisation\r\n•La préparation et la palettisation\r\n•Les recommandations ergonomiques\r\n3. LES GRANDS SYSTÈMES DE PRÉPARATION DES COMMANDES\r\n•Principe général\r\n•Les méthodes\r\n•Les matériels de préparation\r\n•Le traitement de l’information :\r\nles différents supports\r\nles documents administratifs\r\nle traitement\r\nles codes à barre\r\nles lecteurs et la préparation\r\n•Les règles d’organisation :\r\norganisation linéaire et circuit\r\ndéroulement de l’activité\r\nles moyens humains\r\n4. LA PRÉPARATION ET SES ENJEUX LOGISTIQUES DANS L’ENTREPRISE\r\n•Les compromis\r\n•Les paramètres à prendre en considération', NULL, 15, '2020-10-23 14:11:29', '2021-01-20 12:07:17'),
(91, 'Gestion des approvisionnements', '-s\'approprier des méthodes concrètes et des outils pratiques pour optimiser les processus de gestion des stocks et des approvisionnements de son entreprise', 'Définir les responsabilités de l\'approvisionneur\r\n-Le rôle et l\'importance de la mission approvisionnement dans l\'entreprise\r\n-Le positionnement de la fonction approvisionnement dans la supply chain\r\n-La clarification des principales tâches et objectifs de l\'approvisionneur\r\nApprendre les grands principes de gestion des stocks\r\n-Définitions des stocks et Leur utilité\r\n-Les types de gestion des stocks\r\n-Les différentes visions d’un stock\r\n-Les différentes familles de produits stockés\r\nAssurer la tenue et le suivi des stocks\r\n-Les mouvements de stock\r\n-La fiche de suivi des stocks\r\n-Les systèmes d’information de gestion des stocks\r\n-Les inventaires\r\n-La valorisation des stocks\r\nLes indicateurs de suivi des stocks', NULL, 15, '2020-10-23 14:13:36', '2020-10-23 14:13:36'),
(92, 'Planification logistique', '• Avoir une vision complète de la chaîne logistique\r\n• Posséder une connaissance des bonnes pratiques et des principales actions à mener pour améliorer les performances de son entreprise ainsi que de l’ensemble de la chaîne logistique\r\n• S\'approprier les méthodes et outils de la planification et de la gestion des flux (PIC, PDP, MRP, CRP, Lean, etc.)', 'LES RELATIONS AVEC LES CLIENTS ET LES FOURNISSEURS\r\n•Les bases des relations logistiques\r\n•L’organisation des réseaux logistiques\r\n•La gestion des transports et des entrepôts\r\nLA LOGISTIQUE AVAL (CLIENTS)\r\n•La gestion de la demande\r\n•Le calcul et la gestion des prévisions\r\n•Le calcul des stocks de sécurité\r\n•L’enregistrement des commandes\r\n•La planification de la distribution (DRP)\r\n LA LOGISTIQUE AMONT (FOURNISSEURS)\r\n•Les critères de sélection des fournisseurs\r\n•Les niveaux de relations avec les fournisseurs\r\n•Partenariat\r\n•VMI (Vendor Managed Inventory)\r\n•La gestion collaborative', NULL, 15, '2020-10-23 14:15:06', '2021-01-20 12:15:37'),
(93, 'Lean Logistique', '•Eliminer les gaspillages dans l\'entrepôt, réduire la surface actuelle occupée et le lead time, simplifier les flux, améliorer la productivité.\r\n•Augmenter le taux de remplissage des camions.', '1 - S\'approprier le concept du Lean\r\n•Les origines du Lean Manufacturing.\r\n•Un système global d\'amélioration des performances.\r\n•L\'extension du modèle au processus logistique et administratif.\r\n2 - Construire un projet de maîtrise des flux\r\n•Utiliser le VSM (Value Stream Mapping).\r\n•Établir un schéma de la circulation des flux sur le site.\r\n3 - Transposer les 7 mudas (gaspillages) à l\'entrepôt\r\n•Rappel des 7 gaspillages fondamentaux.\r\n•Adaptation au contexte de l\'entrepôt.\r\n•Cas concret : présentation d\'une démarche réussie.\r\n4 - Clarifier et simplifier les flux dans l\'entrepôt\r\n•Réduire la complexité et recentrer les flux sur la création de valeur pour le client.\r\n•Définir le fonctionnement cible de la chaîne logistique de l\'entrepôt : réceptions ; mises en stock ; méthodes de préparation de commandes ; méthodes de réapprovisionnement ; expéditions ; chargement des camions.\r\n5 - Méthodes et outils du Lean pour la logistique\r\n•Travailler sur les zones d\'amélioration prioritaires : complexité des produits et des process ; modes de pilotage des flux ; postes de travail ; maîtrise de la qualité ; pilotage de la maintenance ; flexibilité : polyvalence des équipes ; implantations : plans d\'entrepôt…', NULL, 15, '2020-10-23 14:15:59', '2021-01-20 12:18:29'),
(94, 'Indicateurs logistiques', '- Apprendre à mesurer les performances de son process (organisation, flux et équipe)\r\n- Amener des solutions pour répondre aux objectifs et problématiques\r\n- Manager ses équipes\r\n- Maîtriser et Optimiser son organisation', 'Enjeux économiques de la fonction logistique dans l\'entreprise\r\n•La logistique, outil et enjeu du management des entreprises\r\n•Une fonction liée à l\'internationalisation des marchés\r\n•la logistique domaine essentiel de l\'activité économique\r\n•La logistique, une conception \"transversale\" de l\'entreprise\r\n•Une nouvelle forme de l\'activité industrielle et de services\r\nComment mesurer les performances de son organisation logistique\r\n•Audit de l\'organisation et des moyens\r\n•Lean\r\n•Indicateurs de Performances KPI\'s\r\nLes différents Indicateurs logistiques\r\n•Indicateurs Logistiques\r\n- Gestion de la Supply Chain\r\n- Indicateurs Entrepôts\r\n- Indicateurs Stocks\r\n- Indicateurs Transport\r\n•Indicateurs sur les objectifs\r\n•Indicateurs d\'alerte, efficacité et suivi de l\'organisation\r\n•Indicateurs d\'anticipation', NULL, 15, '2020-10-23 14:16:38', '2021-01-20 12:20:25'),
(95, 'Transport maritime', '> Acquérir les connaissances nécessaires  à l\'utilisation du transport maritime.\r\n> Maîtriser les principes de la négociation et de la gestion d’une expédition maritime.', '1. L’Organisation du Transport Maritime CARGO dans son environnement :\r\n• Transport Maritime et l’Organisation des flux\r\n• Modes de Transports Maritimes \r\n• Types de Terminaux, Navires Cargo et Marchandises à Transporter \r\n• Les Types, Dimensions et Plan de chargement des Conteneurs maritimes\r\n2. L’Exploitation du Transport Maritime CARGO :\r\n• Les documents usuels en Transport Maritime\r\n• Calcul du Fret en Transport Maritime & leurs Frais Annexes\r\n• Exercices d’application\r\n3. Mise en situation Pratique : \r\n• Etude de cas réels en Transport Maritime\r\n• Etude de cas réels pour l’entreprise en Transport Maritime\r\n• Diagnostic du cas, Analyse des flux, identification des dysfonctionnements y afférents', NULL, 15, '2020-10-23 14:18:03', '2020-10-24 10:35:49'),
(96, 'Transport routier', '• Connaître la législation propre au transport\r\n• Établir un cahier des charges\r\n• Suivre les coûts de transport', '1. L’Organisation du Transport Routier National et International :\r\n• Présentation de l’organisation du Transport Routier\r\n• Classification du Matériels Roulants Routiers \r\n• Spécificités du Matériels et Organisation des opérations de transport (Dimensions et Poids)\r\n2. L’Exploitation du Transport Routier de Marchandises :\r\n• Organisation des Tournées de Transport Routier & Optimisation des Couts logistiques\r\n• Réglementation juridique & Les documents administratives : CMR\r\n• Calcul du FRET en Transport ROUTIER + Frais Annexes\r\n3. Mise en situation Pratique : \r\n• Etude de cas réels en Transport Routier National et International\r\n• Etude de cas réels pour l’entreprise en Transport Routier International\r\n• Diagnostic du cas, Analyse des flux, identification des dysfonctionnements y afférents', NULL, 15, '2020-10-23 14:18:39', '2021-01-20 12:22:42'),
(97, 'Transport international', 'Traitement des marchandises \r\nLa maitrise des conditions prévues : délais, prix et sécurité ? \r\nla bonne exécution des opérations de manutention  ? satisfaction de la clientèle ;\r\nLa maîtrise de la chaîne logistique dès la préparation jusqu\'à la livraison.', '1. L\'environnement du secteur du transport :\r\n• Positionnement du Transport International en tant que maillon dans l’environnement économique\r\n• Processus Général du Transport International avec les différents intermédiaires\r\n• Les acteurs du secteur & Les prestations proposées par les prestataires \r\n• Les critères de choix d\'une solution transport et Le compromis et le ratio coût / délai.\r\n2. Comprendre les aspects techniques et contractuels :\r\n• Processus Général de fonctionnement d’un commissionnaire au Transport et les flux y afférents\r\n• Les documents de transport & Assurances de TI\r\n3. Mise en Situation en contexte réel de l’entreprise :\r\n• Diagnostic rapide du flux de fonctionnement de l’entreprise\r\n• Identification des flux et des intermédiaires de transports Internationaux \r\n• Définition d’axes de progrès et de chantiers d’amélioration', NULL, 15, '2020-10-23 14:19:58', '2020-10-24 10:31:35'),
(98, 'Transport multi modal', 'Permettre aux responsables décisionnels et opérationnels de mettre en place des techniques ou modes opératoires logistiques dans le cadre d’opérations de transport multimodal.', '1. L’Organisation du Transport Multimodal :\r\n• Les concepts-clés du transport multimodal : le ferroutage (transport combiné rail-route), la route roulante, le Trans roulage (RO-RO),\r\nLa consolidation (groupage), le transbordement...\r\n• La chaîne et les acteurs du transport combiné : le chargeur (expéditeur, exportateur), le transitaire, l’agent de transport, le\r\nTransporteur et le destinataire (importateur). L’Entrepreneur de transport multimodal\r\n• Les unités de transport multimodal (UTI) & Les unités de chargement multimodal (UCI)\r\n• Les infrastructures et les équipements multimodaux : le terminal intermodal, la plateforme multimodale, le point nodal (HUB), le port\r\nSec, les grues\r\n• L’assurance et le frais du transport multimodal\r\n• La Convention des Nations Unies sur le transport multimodal international de marchandises de 1980\r\n2. Mise en situation Pratique : \r\n• Etude de cas réels en Transport Multimodal International\r\n• Etude de cas réels pour l’entreprise en Transport Multimodal.', NULL, 15, '2020-10-23 14:27:42', '2020-10-24 10:42:23'),
(99, 'Excel Perfectionnement', '-Développer des tableaux plus complets (tableau croisé dynamique Excel)\r\n-Gérer les données sous Excel\r\n-Réaliser des graphiques plus poussés sur Excel\r\n-Simuler des calculs et réaliser une synthèse complète entre différents tableaux\r\n-Adopter des outils adaptés à votre quotidien', '-Maîtriser l\'intégration de la valeur absolue \r\n-Maîtriser l\'intégration de la fonction si simple\r\n-Gérer l\'imbrication des fonctions SI \r\n-Gérer l\'utilisation des fonctions statistiques (somme, moyenne, max, min et nb.si)\r\n-Utiliser la fonction recherche\r\n-Maîtriser la fonction financière VPM et la valeur cible\r\n-Maîtriser les fonctions de calculs sur les dates\r\n-Assurer la manipulation de chaînes de caractères\r\n-Créer, trier et filtrer une liste de données\r\n-Appliquer un filtre élaboré sur Excel \r\n-Afficher des sous-totaux\r\n-Gérer une liste avec un formulaire', NULL, 26, '2020-11-02 06:36:38', '2020-12-02 13:45:00');
INSERT INTO `themes` (`id_theme`, `nom_theme`, `objectif`, `contenu`, `commentaire`, `id_dom`, `created_at`, `updated_at`) VALUES
(100, 'Gestion Des Projets De Développement', '-M\'approprier une méthode de gestion de projet\r\n-Identifier et maîtriser les principaux outils de conduite de projet\r\n-Réussir le projet dans le respect des objectifs fixés', '1. Fondamentaux de la gestion de projet\r\n•	connaître les concepts clés d\'un projet\r\n•	comprendre le fonctionnement en mode projet\r\n•	analyser les attentes du client\r\n•	rédiger un cahier des charges et contractualiser les objectifs\r\n Atelier fil rouge - Étape 1 : choisir le projet à étudier\r\n2. Identifier les besoins et les ressources pour réaliser le projet\r\n•	découper le projet en tâches cohérentes\r\n•	identifier les contenus des tâches à exécuter\r\n•	identifier les ressources nécessaires à chaque tâche\r\n•	construire l\'organigramme des tâches\r\n Atelier fil rouge - Étape 2 : élaborer l\'organigramme projet\r\n3. Organiser le projet\r\n•	constituer l\'équipe projet\r\n•	définir les procédures de prise de décision\r\n•	contractualiser les relations entre les différents services et intervenants\r\n•	écrire un plan de management\r\n•	susciter et entretenir l\'implication de l\'équipe\r\n Atelier fil rouge - Étape 3 : organiser le projet dans le respect de l\'organigramme\r\n4. Contrôler le déroulement du projet\r\n•	mettre en place une logique de déroulement\r\n•	définir les phases principales et leur contenu\r\n•	organiser les revues entre phases\r\n Atelier fil rouge - Étape 4 : définir les phases du projet\r\n5. Maîtriser les coûts et les délais\r\n•	estimer les coûts\r\n•	établir un budget prévisionnel\r\n•	estimer les durées\r\n•	établir un calendrier prévisionnel\r\n•	suivre les coûts et le calendrier avec les plannings PERT et Gantt (jalons, chemin critique, suivi…)\r\n Atelier fil rouge - Étape 5 : calculer le budget et élaborer le calendrier du projet\r\n6. Assurer le succès du projet\r\n•	gérer les risques inhérents au projet\r\n•	intégrer aléas et changements en cours de projet\r\n•	constituer la documentation du projet\r\n•	assurer la qualité des prestations\r\n•	accompagner les changements induits par le projet', NULL, 27, '2020-11-02 06:38:38', '2020-11-02 07:06:36'),
(101, 'Techniques De Reporting & D\'élaboration & D\'analyse Des TDB', '- Effectuer un diagnostic et identifier les activités critiques et les facteurs de performance\r\n- Etudier et choisir les éléments nécessaires, les variables d’action et définir des indicateurs pertinents\r\n- Analyser les différentes phases de la mise en œuvre du tableau de bord opérationnel dans l\'entreprise\r\n- Maîtriser les risques et piloter les axes de progrès\r\n- Savoir exploiter les tableaux de bords et les indicateurs clés', 'Le tableau de bord outil de synthèse et d\'aide à la décision\r\n• Un instrument essentiel de la gestion de l\'entreprise\r\n• Principes de conception, de production et d\'exploitation des tableaux de bord\r\n• Caractéristiques, périodicité et critères d\'évaluation des tableaux de bord\r\n• Typologie des indicateurs : taux, ratio, indice, mérite et démérite\r\n• Les familles d’indicateurs : stratégiques et de pilotage, unilatéraux et bilatéraux, de qualité et de performance\r\nLes méthodes de construction d\'indicateurs pertinents\r\n• Définition du champ de mesure: délimiter le ou les périmètres couverts en adéquation avec l\'organigramme de la société\r\n• Définition des objectifs opérationnels et des plans d\'actions\r\n• Sélectionner les indicateurs les plus pertinents par rapport aux objectifs et pour mesurer les résultats\r\n• Analyser les écarts entre les objectifs opérationnels et les résultats constatés\r\n• Réagir pour réajuster les décisions initiales et fixer de nouvelles prévisions\r\n• Visualisation des tableaux de bord et exemples de tableaux de bord\r\nLes étapes de déploiement d\'un système de tableaux de bord\r\n• Identification des éléments du plan stratégique\r\n• Cerner les leviers d\'action\r\n• Déterminer les facteurs-clés de succès\r\n• Construire les indicateurs opérationnels\r\nL’exploitation efficace des tableaux de bords et des indicateurs clés\r\n• Articulation entre les différents tableaux de bord mis en place\r\n• Communication des résultats et analyse\r\n• Faire vivre le système d’indicateurs et de tableaux de bord', NULL, 16, '2020-11-02 06:39:24', '2021-01-20 14:52:30'),
(102, 'Elaboration Des Stratégies \"COMARKETING\"', '-Acquérir une vision complète et actuelle du marketing stratégique et de son influence sur l’entreprise.\r\n-Intégrer les nouvelles pratiques digitales.\r\n-S’approprier les modèles d’aide à la décision.', 'Définir la stratégie marketing à partir de la stratégie d’entreprise \r\n•Étapes et champs du marketing stratégique.\r\n•Les différentes stratégies marketing.\r\n•Replacer le Marketing stratégique dans la demande globale du marketing.\r\n•Le projet, la mission et les objectifs de l’entreprise.\r\n•Choix stratégiques et orientations de l’entreprise : cohérence, cadre de référence, indicateurs de résultats.\r\n•Rôles et missions du marketing.\r\n•Les 5 forces de Porter : identifier la concurrence.\r\n•Les différentes segmentations des activités.\r\nQuel est le diagnostic stratégique de l’entreprise             \r\n•Le diagnostic de situation : démarche, principes clés.\r\n•Identification de l’environnement : analyse interne et externe.\r\n•Les Domaines d’Activités Stratégiques (DAS)\r\n•Conduite de l’analyse externe (Porter, PESTEL…).\r\n•Conduite de l’analyse interne (profil concurrentiel, chaîne de valeur).\r\n•La matrice SWOT\r\n•Diagnostic des forces et des faiblesses.\r\n•Diagnostic des opportunités et des menaces.\r\n•L’importance du digital.', NULL, 28, '2020-11-02 06:40:04', '2021-01-20 15:02:38'),
(103, 'Technique De Pré-Vente', '• Comprendre les différents processus de vente\r\n• Etre capable de créer un argumentaire adapté à chaque client\r\n• Maitriser les fondamentaux de la vente\r\n• Comprendre les axes stratégiques de la négociation\r\n• Etre capable de traiter les objections des clients', '•	Le processus de vente\r\nLe cycle de vente\r\nLa démarche commerciale et l’analyse du besoin\r\nLes techniques de vente\r\nS\'approprier les différentes situations de vente\r\nLa prospection téléphonique\r\nLes objections du client\r\n•	Le processus de négociation\r\nLes différentes méthodes\r\nPréparer sa stratégie\r\nConduire, accompagner et clôturer\r\nL’argumentation et l’influence\r\n•	Les outils pour vendre\r\nPrise de parole en public\r\nStory Telling\r\n•	Gestion d’un CRM', NULL, 31, '2020-11-02 06:42:50', '2020-12-02 14:10:29'),
(104, 'Mener Une Campagne Digitale', '-Comprendre les spécificités des campagnes publicitaires online par rapport aux campagnes sur médias classiques\r\n-Elaborer étape par étape une campagne publicitaire digitale\r\n-Bâtir un plan média et mettre en place un médiaplanning efficace', '-Définir le rôle du digital dans une stratégie de communication publicitaire\r\n-Définir les objectifs et les attentes d\'une campagne digitale publicitaire.\r\n-Comprendre la complémentarité du \"on\" et du \"off\" line.\r\n-Evaluer les atouts des différents leviers e-marketing : display, SEM, affiliation, emailing...\r\n-Connaître les nouvelles opportunités publicitaires liées aux réseaux sociaux et les enjeux du multiplateforme.\r\n-Focus sur le média mobile.\r\n-Brainstorming sur les atouts et les limites du display.\r\n-Connaître les principaux acteurs de la publicité digitale :\r\nLes annonceurs.\r\nLes agences médias.\r\nLes éditeurs et les régies.\r\n-Les nouveaux outils d\'achats d\'espaces : plateformes Ad Exchanges et Real Time Bidding.', NULL, 11, '2020-11-02 06:44:57', '2021-01-20 15:05:44'),
(105, 'Techniques Du Trade Marketing', '• Construire et mettre en place une stratégie trade marketing performante.\r\n• Définir les KPI’s et piloter la mise en oeuvre des plans.', '• S’approprier les enjeux du Trade marketing\r\n• Faire le diagnostic à 360° de son marché pour identifier les sources de croissance pour ses marques \r\n• Analyser le parcours shopper et son arbre de décision pour déterminer ses freins et déclencheurs d’achat.\r\n• Du marketing client à la stratégie trade marketing shopper.\r\n• Prendre en compte la politique commerciale de son entreprise, les stratégies enseigne et le cadre légal pour valider sa stratégie trade marketing et limiter les risques.\r\n• Définir ses objectifs et indicateurs de performance trade marketing par canal pour évaluer le succès.\r\nConstruire le plan d\'action trade marketing multicanal\r\n• Piloter la mise en œuvre de sa stratégie trade marketing multicanal.', NULL, 11, '2020-11-02 06:45:43', '2020-12-03 14:44:50'),
(106, 'Gestion De La Maintenance', '- Maîtrise de la maintenance préventive.\r\n- Maîtrise de la maintenance curative.\r\n- Les généralités de la maintenance préventive et curative.\r\n- Les stratégies de la maintenance préventive et curative', 'A- Systèmes de gestion de la maintenance préventive et curative\r\nB - Les différentes stratégies de diagnostic des pannes\r\nC - Les méthodes et les outils de diagnostic des pannes\r\nD - Complémentarité de la maintenance préventive et curative\r\nE - Conditions nécessaires de la mise en place de la maintenance préventive\r\nF - Mise en place de la maintenance curative\r\nG - Graphe caractéristique de la maintenance curative\r\nH - Les différentes formes de la maintenance préventive', NULL, 14, '2020-11-02 06:47:56', '2020-12-03 14:56:16'),
(107, 'AUTOCAD', 'Apprendre à maitriser le logiciel AutoCad pour faire des permis de construire.', '• Généralités\r\n• Positionnement du produit sur le marché CAO\r\n• Nouveautés de la dernière version\r\nPrésentation de l\'interface\r\n• La barre de menu\r\n• Le Ruban\r\n• La zone graphique\r\n• Fenêtre de commande\r\nL\'environnement\r\n• Création d\'un nouveau document\r\n• L\'espace de travail\r\n• Configuration des unités et conventions\r\n• Définition des limites du plan de travail\r\n• Navigation dans le plan de travail\r\n• Fonctionnement des modes de sélection\r\n• Réglage de la grille et affichage\r\n• Mode Résolu : magnétisme de la grille\r\n• Repérage : Orthogonal / Polaire / Objet, accroche d\'objets', NULL, 14, '2020-11-02 06:48:41', '2020-12-02 14:30:32'),
(108, 'Techniques De Management', '-Développer son identité managériale et son leadership\r\n-Adopter une posture de manager dans ses actes de management\r\n-Développer la coopération dans son équipe\r\n-Développer l’autonomie et la responsabilisation de ses collaborateurs au quotidien\r\n-Adapter son style de management en fonction de ses collaborateurs', '•Les rôles et missions du responsable d’équipe\r\n•Comprendre les 3 principes de base du management : structurer et définir un cadre de travail, fixer des objectifs, communiquer\r\n•Les principes de base et les objectifs des différents styles de management\r\n- Identifier son style : études de cas \r\n- Améliorer et adapter son style aux situations, contextes et collaborateurs\r\n•Le pouvoir du manager d’équipe\r\n•Piloter, mobiliser et motiver son équipe\r\n- Identifier les critères de performance de son équipe\r\n- Engager son équipe autour d’objectifs\r\n- Développer et évaluer l’autonomie des collaborateurs\r\n- Comprendre les moteurs de la motivation et de l’implication', NULL, 10, '2020-11-02 06:49:22', '2020-12-03 15:52:55'),
(109, 'Risque Sécurité', '-Maîtriser la sécurité et protéger la santé des travailleurs\r\n-Savoir définir et mettre en œuvre un programme de prévention', '•	La réglementation santé sécurité au travail\r\n•	Démarche d’évaluation des risques\r\n•	Le suivi de paramètres de sécurité prospectifs et rétrospectifs\r\n•	Exploiter les données pour améliorer les résultats\r\n•	Rédiger un document unique\r\n•	Elaboration du plan d\'actions et le suivre', NULL, 20, '2020-11-02 06:50:45', '2020-11-02 06:50:45'),
(110, 'Optimiser Les Achats', '-Savoir évaluer les enjeux pour identifier les priorités\r\n-Etre capable de faire évoluer son organisation\r\n-Connaître les coûts et savoir les réduire\r\n-Savoir piloter la performance achat/approvisionnement', 'L\'organisation des achats et des approvisionnements en PME\r\n•	Cartographier les personnes impliquées dans les achats.\r\n•	Etablir le périmètre de la fonction : achat et /ou approvisionnement.\r\n•	Mesurer les enjeux : économiques, environnementaux et sociétaux.\r\n•	Comprendre le rôle transversal de la fonction et ses conséquences sur l\'organisation.\r\n•	Identifier et organiser les grandes familles d\'achats selon les enjeux : achats de production, hors production...\r\nDéployer les cinq étapes de la démarche achat\r\n•	Analyser les besoins et formaliser le cahier des charges.\r\n•	Connaître le marché et rechercher de nouveaux fournisseurs.\r\n•	Organiser la consultation et évaluer les offres.\r\n•	Préparer sa matrice de négociation.\r\n•	Contractualiser : cadre juridique et les différents types de contrats, clauses générales et particulières.\r\n•	Gérer les conflits possibles entre Conditions Générales de Vente et Conditions Générales d\'Achat.', NULL, 29, '2020-11-02 06:52:58', '2020-11-02 07:11:19'),
(111, 'Excel (Initiation)', 'Apprendre à exploiter les fonctionnalités de base du tableur Excel de Microsoft pour une utilisation en entreprise (conception de tableaux de calcul fiables, construire des représentations graphiques).', '• Présentation de l’interface d’Excel (Les rubans, les onglets)\r\n• Personnalisation de l’interface d’Excel\r\n◦ Insérer / retirer des boutons de fonctionnalités dans les onglets\r\n• Gestion des classeurs (Création, Enregistrement, Fermeture)\r\n• Gestion des feuilles\r\n◦ Création / Insertion / Déplacement / Suppression\r\n◦ Renommer une feuille\r\n◦ Dupliquer une feuille\r\n• Les cellules\r\n◦ Repérer une cellule\r\n◦ Format de cellule\r\n◦ Mise en forme de cellule\r\n◦ Modification de plusieurs cellules contiguës ou dispersées sur une feuille où\r\nPlusieurs feuillent\r\n• Concevoir et mettre en forme un tableau\r\n◦ Saisir des données efficacement (touches fléchées, Tab, Retour)\r\n◦ Insertion / Suppression de lignes et de colonnes\r\n◦ Utilisation de la recopie incrémentielle (poignée de recopie)\r\n◦ Générer des séries grâce à la recopie incrémentielle\r\n◦ Appliquer un style à un tableau', NULL, 26, '2020-11-02 06:53:39', '2020-11-02 07:11:50'),
(112, 'Techniques d\'analyse sensorielle des produits alimentaires', '-Appréhender les potentialités de l’évaluation sensorielle en vue de la réalisation des tests sensoriels internes (Services qualité et R&D) ou externes (tests consommateurs),\r\n-Intégrer les bases neurophysiologiques et statistiques,\r\n-Définir les éléments importants pour la mise en place, dans la pratique, un laboratoire d’évaluation sensorielle.\r\n-Connaitre les principaux tests sensoriels, dans quel cas les utiliser, mise en place et analyse des résultats', '-Neurosciences sensorielles,\r\n-Informatique et statistiques appliquées à l\'analyse sensorielle,\r\n-Métrologie sensorielle,\r\n-Stratégies sensorielles des industriels,\r\n-Technologie, techniques d\'analyse et de caractérisation,\r\n-Anglais / communication et veille,\r\n-Sociologie et marketing,\r\n-Le sensoriel comme outil scientifique et industriel,\r\n-Législation – qualité dans l\'industrie agroalimentaire.', NULL, 25, '2020-11-02 06:55:06', '2020-11-02 06:55:06'),
(113, 'FORMATION PRÉVENTION INCENDIE/EVACUATION', 'La consigne de sécurité incendie prévoit des exercices au cours desquels les travailleurs apprennent à reconnaître les caractéristiques du signal sonore d’alarme générale,\r\nA se servir des moyens de premier secours,\r\nA exécuter les diverses manœuvres nécessaires.', '•	La règlementation en vigueur\r\n•	Les causes et effets de l’incendie\r\n•	Le triangle du feu\r\n•	Les modes de propagation\r\n•	Donner l’alarme et/ou l’alerte\r\n•	Les classes de feux\r\n•	Les modes d’extinction\r\n•	Les agents extincteurs, leurs efficacités\r\n•	Les précautions d’intervention\r\n•	Les distances d’attaque', NULL, 20, '2020-11-02 06:55:50', '2020-12-01 15:54:28'),
(114, 'Habilitation électrique', 'A l\'issue de la formation, les participants seront en mesure d\'évaluer les risques électriques relatifs aux ouvrages électriques à basse tension, et connaîtront les règles de sécurité leur permettant de réaliser en toute sécurité des interventions d\'entretien et de dépannage sur des installations et équipements électriques.', '1- Sensibilisation aux risques électriques\r\n•Effets du courant sur le corps humain : électrisation, électrocution, brulure\r\n•Ouvrage ou installations : domaines de tension, limites et reconnaissance des matériels\r\n2- Habilitation : principe, symboles, limites et formalisation\r\n•Analyse des risques et mise en œuvre des principes généraux de prévention\r\n•Mise en sécurité d’un circuit \r\n•Equipements de protection collective et individuelle \r\n•Equipements de travail utilises : risques et mise en œuvre\r\n•Incendies et accidents sur ou près des ouvrages et installations électriques\r\n3- Thèmes spécifiques BR\r\n•Fonction des matériels électriques \r\n•Equipements de travail utilises \r\n•Documents applicables lors d’une intervention \r\n•Mesures de prévention à appliquer lors d’une intervention BT générale', NULL, 14, '2020-11-02 06:56:38', '2020-12-03 15:45:41'),
(115, 'Navision', 'Utiliser les fonctionnalités de base et naviguer dans l’interface de Microsoft Dynamics NAV.', '- Présentation générale\r\n- Concepts de base, environnement\r\n- Démarrage et arrêt de Microsoft Dynamics NAV\r\n- Barre d’outil, barre de menu, barre d’état et Menu suite\r\n- Les différentes fenêtres\r\n- Les recherches, les tris, les filtres simples, les filtres étendus\r\n- Ergonomie et facilités de saisies\r\n- Personnalisation des écrans\r\n- Microsoft Dynamics NAV et la suite Microsoft Office\r\n- Intégration avec Microsoft Excel\r\n- Intégration avec Microsoft WORD\r\n- Concevoir une feuille de style WORD pour un publipostage\r\n- Relier des documents bureautiques avec Microsoft Dynamics NAV', NULL, 26, '2020-11-02 06:59:53', '2021-01-20 15:24:59'),
(116, 'Gestion De Projets', '•	M\'approprier une methode de gestion de projet\r\n•	Identifier et maitriser les principaux outils de conduite de projet\r\n•	Reussir le projet dans le respect des objectifs fixes', '1. Fondamentaux de la gestion de projet\r\n•	connaître les concepts clés d\'un projet\r\n•	comprendre le fonctionnement en mode projet\r\n•	Analyser les attentes du client\r\n•	Rédiger un cahier des charges et contractualiser les objectifs\r\n Atelier fil rouge - Étape 1 : choisir le projet à étudier\r\n2. Identifier les besoins et les ressources pour réaliser le projet\r\n•	Découper le projet en tâches cohérentes\r\n•	Identifier les contenus des tâches à exécuter\r\n•	Identifier les ressources nécessaires à chaque tâche\r\n•	Construire l\'organigramme des tâches\r\n Atelier fil rouge - Étape 2 : élaborer l\'organigramme projet\r\n3. Organiser le projet\r\n•	Constituer l\'équipe projet\r\n•	Définir les procédures de prise de décision\r\n•	Contractualiser les relations entre les différents services et intervenants\r\n•	Écrire un plan de management\r\n•	Susciter et entretenir l\'implication de l\'équipe\r\n Atelier fil rouge - Étape 3 : organiser le projet dans le respect de l\'organigramme\r\n4. Contrôler le déroulement du projet\r\n•	Mettre en place une logique de déroulement\r\n•	Définir les phases principales et leur contenu\r\n•	Organiser les revues entre phases\r\n Atelier fil rouge - Étape 4 : définir les phases du projet\r\n5. Maîtriser les coûts et les délais\r\n•	Estimer les coûts\r\n•	Établir un budget prévisionnel\r\n•	Estimer les durées\r\n•	Établir un calendrier prévisionnel\r\n•	Suivre les coûts et le calendrier avec les plannings PERT et Gantt (jalons, chemin critique, suivi…)\r\n Atelier fil rouge - Étape 5 : calculer le budget et élaborer le calendrier du projet\r\n6. Assurer le succès du projet\r\n•	Gérer les risques inhérents au projet\r\n•	Intégrer aléas et changements en cours de projet\r\n•	Constituer la documentation du projet\r\n•	Assurer la qualité des prestations\r\n•	Accompagner les changements induits par le projet', NULL, 27, '2020-11-02 07:10:26', '2020-11-02 07:10:26'),
(117, 'Secourisme', '•	Maîtriser les préventions et les gestes qui sauvent\r\n•	Connaître les bons réflexes à adopter en cas de danger\r\n•	Intervenir rapidement et efficacement lors d\'une situation d\'accident du travail', '•	Qu\'est-ce que le secourisme ?\r\n•	Que faire en cas d\'accident du travail ?\r\n•	Les premiers secours\r\n•	Les premiers secours avec matériel\r\n•	La réanimation cardiorespiratoire\r\n•	Le secourisme d\'urgence\r\n•	Les premiers secours en équipe\r\n•	Les secours nautiques\r\n•	Comment protéger et prévenir ?', NULL, 30, '2020-11-02 07:13:35', '2020-11-02 07:13:35'),
(118, 'Techniques de recouvrement', 'Recouvrer efficacement les sommes dues via les procédures amiables et contentieuses\r\n- Identifier les premiers symptômes de défaillance du débiteur\r\n-Connaître les enjeux et les bénéfices d’un solide recouvrement', '- Les enjeux d’une bonne maîtrise des techniques de recouvrement\r\n- Prévenir les impayés\r\n- Favoriser le recouvrement amiable\r\n-entrée en contact et précautions à prendre afin de garder le dialogue avec le débiteur\r\n-ton, termes à employer, intérêt de la mise en demeure\r\n-procédure de A à Z pour mener la transaction\r\n- Obtenir le paiement devant les tribunaux\r\n-juridictions compétentes\r\n-procédure en injonction de payer\r\n-relations avec les avocats et huissiers de justice\r\n-mise en œuvre du jugement et exécution provisoire', NULL, 22, '2020-11-02 11:21:32', '2020-11-02 11:21:32'),
(119, 'Leadership et management de la performance collective', 'Oser exercer son leadership.\r\nFaire mieux fonctionner son équipe.\r\nDévelopper son impact auprès des différents acteurs de l\'entreprise.\r\nAccroître la responsabilisation des collaborateurs.\r\nCréer un climat de confiance dans l\'équipe.\r\nFavoriser l\'adhésion sur les projets.\r\nDécider mieux.', '1 - Assumer sa fonction de leader\r\nDistinguer leadership et management.\r\nCe qu\'on attend d\'un leader.\r\nLes fonctions et compétences clés du leadership.\r\n2 - S\'approprier les principes de la confiance\r\nConnaissance de soi et lucidité.\r\nDialogue ouvert et authenticité.\r\nResponsabilité et détermination personnelle.\r\nEngagement et implication.\r\n3 - Développer ses capacités de leader\r\nComprendre ses comportements et ceux des autres.\r\nFluidifier la relation grâce aux émotions.\r\nAssumer son pouvoir personnel.\r\nAnalyser ses expériences de leader et en extraire les qualités.\r\nDévelopper la performance en équipe\r\n4 - Créer une équipe confiante et performante\r\nClarifier les rôles et les missions.\r\nDéfinir les relations fonctionnelles productives.\r\nCréer un climat facilitant l\'adhésion, la responsabilisation et la confiance.\r\n5 - Développer la coopération dans l\'équipe et gérer les conflits\r\nApprécier les résultats de l\'équipe au fil de l\'eau.\r\nDonner et recevoir des feed-back de manière constructive.\r\nIdentifier les mécanismes défensifs à l\'œuvre dans l\'équipe.\r\nSe doter d\'outils pour résoudre durablement les conflits.\r\n6 - Prendre les décisions appliquées et non sabotées\r\nÉvaluer les méthodes classiques de prise de décision.\r\nImpliquer et responsabiliser chacun dans les décisions grâce à la méthode de la concordance', NULL, 10, '2020-11-11 05:58:22', '2020-11-11 05:58:22'),
(120, 'Communication à l\'oral', 'Surmonter son trac.\r\nPrendre la parole à l\'improviste.\r\nExprimer clairement ses idées.\r\nGérer son temps de parole.\r\nGagner en clarté.\r\nSe centrer sur son auditoire.\r\nUtiliser les techniques efficaces de présentation.\r\nAdopter un comportement efficace dans les échanges.\r\nS\'affirmer dans ses interventions.', '1 - Mieux se connaître à l\'oral : le préalable indispensable\r\nApprivoiser son trac : ne plus le subir, savoir l\'utiliser.\r\nMieux cerner ses qualités et ses points de progrès grâce à la vidéo.\r\nTransformer le feed-back des autres en pistes de progrès.\r\nValoriser sa personnalité en affinant son style.\r\n2 - Se préparer à la prise de parole en public\r\nSe libérer des inhibitions psychologiques et des tensions physiques pour être présent.\r\nTravailler sa voix, ses gestes, son regard, sa respiration, les silences.\r\nLaisser parler ses émotions, développer son charisme.\r\n3 - Structurer clairement son intervention\r\nIdentifier les caractéristiques et les attentes de son auditoire pour adapter son message.\r\nAnalyser objectivement le contexte dans lequel chacun intervient.\r\nOrganiser ses idées.\r\n4 - Renforcer ses qualités d\'écoute et d\'adaptation\r\nDécoder le vrai message de son interlocuteur.\r\nPratiquer l\'art du questionnement et de la reformulation pour une communication constructive.\r\nTrouver l\'attitude, le ton et les mots qui facilitent les échanges.\r\n5 - Découvrir les pièges de la communication pour les éviter\r\nRepérer les pièges des questions.\r\nIdentifier ce qu\'il y a derrière les mots.\r\nRester maître de ses émotions.\r\n6 - S\'affirmer dans ses interventions\r\nAsseoir sa présence.\r\nDévelopper son sens de la répartie.\r\nCanaliser et maîtriser les échanges.', NULL, 19, '2020-11-11 06:49:36', '2020-11-11 06:49:36'),
(121, 'Management Organisationnel', 'Asseoir sa légitimité de manager transversal.\r\nMettre en œuvre les conditions d\'un management transversal efficace.\r\nMobiliser tous les acteurs concernés par la mission transversale.\r\nAugmenter son pouvoir de persuasion pour manager et impliquer sans lien hiérarchique.\r\nDévelopper une coopération durable en situation de management fonctionnel.', '1 - Se positionner dans son rôle de manager transversal et trouver sa légitimité\r\nSituer son rôle de manager transversal dans l\'organisation.\r\nDévelopper la posture et les compétences spécifiques du management transversal.\r\nClarifier les responsabilités de sa mission avec sa hiérarchie.\r\nPrendre en compte les enjeux de sa mission pour définir sa stratégie d\'intervention.\r\nValoriser les résultats de sa mission transversale.\r\n2 - Développer son influence pour mobiliser sans autorité hiérarchique\r\nAnticiper les comportements des différents partenaires impliqués dans la mission transversale.\r\nDéfinir et mettre en œuvre une stratégie adaptée au positionnement des différentes catégories d\'acteurs.\r\nAgir sur les leviers de l\'influence sans autorité statutaire.\r\nMobiliser les énergies autour d\'objectifs communs.\r\nAdapter sa stratégie d\'influence au cadre de référence de ses interlocuteurs.\r\n3 - Assurer la coordination d\'une activité fonctionnelle\r\nUtiliser le mode de coordination le plus adapté à chaque situation.\r\nVarier les outils pour obtenir la coordination recherchée.\r\nPratiquer l\'ajustement mutuel pour rendre la coordination plus efficace.\r\nUtiliser la confrontation des expertises et le transfert d\'expérience.\r\nDonner du sens à la coordination pour faire adhérer les acteurs.\r\n4 - Développer des comportements de coopération\r\nCréer les conditions de la coopération : pouvoir, vouloir et savoir coopérer.\r\nRéunir ses interlocuteurs autour de la mission transversale.\r\nDévelopper des relations de confiance avec la ligne hiérarchique.\r\nMaintenir l\'engagement durable des acteurs.\r\nFaire face aux résistances et gérer les situations difficiles.', NULL, 10, '2020-11-11 06:57:42', '2020-11-11 06:57:42'),
(122, 'Métier des achats', 'Acquérir les réflexes des meilleurs acheteurs :analyser le besoin d\'achat et l\'exprimer clairement ;\r\nsélectionner et suivre ses fournisseurs ;\r\noptimiser les coûts d\'achat ;\r\nsatisfaire les clients internes ;\r\npiloter la performance des achats ;\r\ndémontrer la valeur ajoutée des achats.', '1 - Repérer les étapes clés en achat\r\nOrganiser sa fonction d\'acheteur du besoin au suivi.\r\nIdentifier les interlocuteurs des achats.\r\n2 - Cerner tous les besoins en achats\r\nRecenser les besoins des clients internes.\r\nClasser les produits, les prestations, les fournisseurs et sous-traitants.\r\n3 - Analyser un besoin d\'achat\r\nObtenir le descriptif du besoin auprès d\'un client interne.\r\nFormaliser sous forme d\'un cahier des charges.\r\n4 - Analyser le marché pour effectuer un sourcing fournisseurs\r\nTrouver des sources d\'information achats pertinentes.\r\nUtiliser un tableau d\'analyse de marché.\r\nDécouvrir les notions de risques et d\'opportunités.\r\n5 - Lancer une consultation fournisseurs\r\nPréparer une grille de comparaison des offres techniques et commerciales des fournisseurs.\r\nDécomposer un prix en postes de coûts.\r\nRaisonner en coût total.\r\n6 - Préparer la négociation contractuelle\r\nStructurer un entretien grâce à la grille de négociation achats.\r\nDistinguer commandes ponctuelles, ouvertes et contrat-cadre.\r\nRepérer les points essentiels d\'un contrat d\'achat.\r\n7 - Piloter la performance en achats\r\nOptimiser le tableau de bord achat.', NULL, 11, '2020-11-11 07:53:23', '2020-11-11 07:53:23'),
(123, 'Comptabilité approfondie', '- Maîtriser les difficultés de la comptabilité approfondie.\r\n- Etre en mesure d\'étudier une situation et d\'en tirer les conséquences comptables grâce à une analyse fondée sur les principes comptables.\r\n- Connaître les aspects comptables essentiels des opérations de rapprochement d\'entreprises et de consolidation des comptes.', 'A- Le cadre de la comptabilité :\r\n- Les sources du droit comptable\r\n. Textes légaux et réglementaires\r\n. Jurisprudence\r\n. Doctrine nationale et internationale\r\n- La théorie comptable\r\n. Objectifs de la comptabilité\r\n. Principes comptables\r\n. Notion de cadre conceptuel\r\n- Les dispositions relatives à l\'organisation de la comptabilité\r\n. Obligations comptables\r\n. Comptabilité et fiscalité\r\n. Supports comptables\r\n. Procédures de traitement\r\n. Principes du contrôle interne\r\n- Les principales caractéristiques des comptabilités non commerciales communes, associations, professions libérales, entreprises agricoles\r\n\r\nB - Technique comptable approfondie :\r\n- Evaluation du patrimoine de l\'entreprise\r\n. Règles générales d\'évaluation : valeur d\'entrée, valeur actuelle, valeur d\'inventaire\r\n. Application des règles générales d\'évaluation : évaluation des éléments d\'actif, du passif externe, des éléments actifs et passifs dont la valeur dépend des fluctuations du cours des monnaies étrangères\r\n. Engagements financiers\r\n- Le rattachement des charges et des produits au résultat de l\'exercice\r\n. Rattachements obligatoires et rattachements résultant d\'une décision de gestion, charges fiscales et sociales, participation des salariés, opérations de recherche et de développement, opérations à long terme, opérations effectuées dans le cadre d\'une société en participation, abonnement des charges et des produits\r\n- Les capitaux permanents\r\n. Le capital (création et variations)\r\n. Le résultat (son imposition et son affectation)\r\n. Les provisions réglementées\r\n. Les emprunts\r\n- Les opérations de restructuration\r\n. Evaluation des sociétés et de leurs titres : méthodes d\'évaluation, application à des problèmes comptables\r\n. Fusions, scissions, apports partiels d\'actifs, dissolutions et liquidations\r\n- Les opérations de groupe\r\n. Etablissement de comptes combinés et de comptes consolidés (cas simples dans lesquels les problèmes fiscaux seront supposés résolus)', NULL, 16, '2020-11-23 12:03:37', '2020-11-23 12:03:37'),
(124, 'Anglais', '-Utiliser l\'anglais en réunion sans appréhension. \r\n-Se faire entendre et comprendre, mobiliser l\'attention de l\'assistance. \r\n-Développer de l\'aisance dans son expression, apprivoiser le trac.', '- Les bases de la communication orale en anglais\r\n1 Vaincre ses appréhensions \r\n2 S\'entraîner à comprendre \r\n3 S\'entraîner à s\'exprimer \r\n4 Être à l\'aise dans les différentes situations \r\n•Conduire une réunion. \r\n•Participer activement à une réunion. \r\n•Faire une présentation devant une assemblée. \r\n•Prendre la parole en public en anglais \r\nB. Bien rédiger les écrits professionnels en anglais\r\n1 Revoir les bases de la langue anglaise \r\n2 S\'entraîner à la rédaction \r\n3 Maîtriser les documents professionnels types \r\n4 Soigner le fond et la forme', NULL, 18, '2020-11-23 12:14:59', '2020-11-23 12:14:59'),
(125, 'Accompagnement à la mise en place des bonnes pratiques GRH', '- Acquérir et maitriser les outils de la GRH.\r\n- Etre capable de gérer et d’optimiser l’allocation des ressources humaines.\r\n- Prévenir les risques réglementaires et juridiques.', '-Les bases de la GRH et du management RH \r\n- La gestion prévisionnelle des emplois et compétences\r\n- Négocier et rédiger le contrat de travail \r\n- Les techniques de recrutement \r\n- La gestion des rémunérations \r\n- La gestion de la formation et comment évaluer l’efficacité de la formation  \r\n- L’évaluation du personnel et les techniques de gestion de carrière \r\n- Tableaux de bord social et outils de mesure de performance RH\r\n- Sécuriser la rupture du contrat de travail \r\n- Durée de travail : organiser et aménager le temps de travail et  la gestion des congés et plan d’intérim.\r\n-Conformité à la législation du travail et protections collectives.', NULL, 13, '2020-11-23 13:33:01', '2020-11-23 13:33:01'),
(126, 'GPEC', '- Comprendre les enjeux et les défis du développement de la gestion des compétences et des talents Construire et faire vivre une démarche de gestion des compétences et des talents opérationnelle\r\n Construire le dispositif d’évaluation des compétences et des talents Introduire de nouveaux outils RH pour attirer, développer et retenir les talents', 'Comprendre les enjeux et les défis du développement de la gestion des compétences et des talents dans le contexte actuel\r\n • Définir les notions de compétences et de talents \r\n• Identifier les enjeux pour l\'entreprise, pour les managers et pour les salariés \r\n• Appréhender les défis à relever \r\n• Prendre conscience de l\'impact de l\'organisation et du contexte dans la définition de la notion de talent\r\nConstruire et faire vivre une démarche de gestion des compétences et des talents \r\n• Clarifier les concepts clés de compétence, talent, performance\r\n • Acquérir une méthodologie pour articuler gestion des compétences et gestion des Talents \r\n• Détecter les métiers sensibles et les priorités d’action RH \r\n• Identifier les différentes approches pour construire les référentiels de compétences.\r\n • Définir les processus de la gestion des compétences et des talents \r\n• Elaborer un plan d’action RH\r\nConstruire le dispositif d’évaluation des compétences et des talents\r\n • Identifier les différents outils d’évaluation et leurs objectifs \r\n• Déterminer des critères pour apprécier les talents et les potentiels\r\n • Identifier les talents actuels et futurs: Le talent mapping\r\n • La matrice des talents. \r\nIntroduire de nouveaux outils RH pour attirer, développer et retenir les talents \r\n• Déterminer les leviers de développement des compétences et des talents\r\n • Attirer des Talents\r\n • Développer et fidéliser des Talents.', NULL, 13, '2020-11-23 14:38:30', '2020-11-23 14:38:30'),
(127, 'Techniques de la communication en Français', '- Rédiger avec aisance et précision, maîtriser les principaux types d\'écrits professionnels\r\n- Approfondir ses connaissances grammaticales et orthographiques\r\n- Enrichir son vocabulaire', 'Approfondissement de l\'orthographe et de la grammaire\r\n-Révision des conjugaisons, concordance des temps\r\n-Les principaux accords et les cas difficiles\r\n-Les homophones grammaticaux\r\n-L\'orthographe d\'usage\r\nLa communication écrite en entreprise\r\n-Les diverses situations de communication : demande d\'information, commande, réclamation?\r\n-Les éléments de l\'argumentation\r\n-L\'organisation de ces éléments (plan d\'une lettre)\r\n-La présentation d\'une lettre (mentions obligatoires)\r\n-Les formules-types\r\n-Rédaction de lettres à partir de situations diverses\r\n-La note de service\r\n-Le compte rendu de réunion\r\n-L\'e-mail et ses caractéristiques\r\nVocabulaire et techniques d\'expression\r\n-Synonymes et recherche du mot juste\r\n-Les mots de liaison\r\n-Alléger la phrase, éviter incorrections, répétitions et pléonasmes\r\n-La ponctuation et les règles de ponctuation', NULL, 18, '2020-11-23 14:48:07', '2020-11-23 14:48:07'),
(128, 'Electricité', '-Comprendre les grands principes de l’électricité\r\n-Apprendre également à lire des schémas, à effectuer des contrôles, à localiser des éléments électriques défectueux et à dépanner des installations électriques domestiques.', '- Les fondements de l\'électricité\r\n- Les schémas et les circuits électriques\r\n- Les dangers du courant électrique et les protections\r\n- Les schémas et l\'éclairage électrique\r\n- Les mesures électriques\r\n- Le courant alternatif et le circuit RC\r\n- Les circuits de puissance\r\n- L\'appareillage électrique\r\n- L\'électromagnétisme et les machines électriques\r\n- Réalisez votre installation électrique', NULL, 14, '2020-12-01 14:40:12', '2020-12-01 14:40:12'),
(129, 'Mécanique', '• Savoir lire un plan mécanique,\r\n• Connaître les rudiments technologiques nécessaires au démontage-remontage des sous ensembles mécaniques simples,\r\n• Analyser la technologie d\'un mécanisme,\r\n• Vérifier le bon fonctionnement d\'un système mécanique ou de le modifier,\r\n• Connaître les méthodes de graissage et lubrification,\r\n• Maîtriser l’outillage.', '1 - Rappels sur la lecture de plan, les tolérances et ajustements\r\n2 - Technologie et maintenance des mécanismes\r\nEtude technologique de :\r\nTransmission de puissance\r\nGuidage en rotation\r\nTransformation de mouvements\r\nModification de vitesse et de couple\r\n2- La lubrification :\r\nLes huiles et les graisses\r\nLes différents principes de lubrification (constitution, caractéristiques et emplois)\r\n3- Les opérations de contrôle et de renouvellement (périodicité, précautions, etc...)\r\n4- Métrologie : contrôles dimensionnelles conventionnels.', NULL, 14, '2020-12-01 15:32:59', '2021-01-20 15:12:24'),
(130, 'Les 5S AMELIORER SON ENVIRONNEMENT DE TRAVAIL', '- Comprendre l\'importance des 5S comme préalable à tous les projets d\'amélioration.\r\n- Identifier les points clés et la méthodologie de la mise en œuvre des 5S.\r\n- Intégrer les dimensions nécessaires à la pérennisation de la démarche.', '1/ Identifier les points forts du 5S et les gains attendus\r\n2/ Connaître chaque \"S\", par la mise en situation\r\n- SEIRI : rangement, débarras.\r\n- SEITON : ordre et méthode.\r\n- SEISO : nettoyage, propreté.\r\n- SEIKETSU : standardiser.\r\n- SHITSUKE : état d\'esprit, rigueur.\r\n3/ Conduire ou s\'intégrer dans un projet 5S : les clés de succès pour pérenniser les résultats : \r\n- Identifier le rôle des différents acteurs.\r\n- Passer du projet à l\'obtention des premiers résultats.\r\n- Réussir la communication tout au long du projet. \r\n- Afficher et faire vivre les indicateurs.\r\n- Systématiser la pratique de l\'audit.', NULL, 14, '2020-12-11 09:47:21', '2020-12-11 09:47:21'),
(131, 'GESTION DES SITUATIONS DIFFICILES', '- Identifier les enjeux et cerner sa marge de manœuvre.\r\n- Définir ses priorités.\r\n- Passer d\'un langage réactif à un langage proactif.\r\n- S\'affirmer sans agressivité.\r\n- Adopter les comportements efficaces en face-à-face.', '1 - Faire face aux situations où la parole est difficile\r\n2 - Les pouvoirs du langage, le langage du pouvoir\r\n- Creuser le besoin de son interlocuteur.\r\n- Faire préciser pour comprendre le point de vue de l\'autre, se taire jusqu\'au bout.\r\n- Choisir la bonne technique de reformulation.\r\n- Passer du langage réactif au langage proactif.\r\n3 - Adopter les comportements efficaces\r\n- Repérer vos différents registres de communicant.\r\n- Formuler une demande.\r\n- Savoir Dire NON.\r\n- Faire une critique et la recevoir.\r\n- Reconnaître les côtés positifs d\'une personne même en situation de tension \r\n- Déjouer les jeux psychologiques et démasquer les joueurs dans une relation constructive.', NULL, 10, '2020-12-11 10:07:45', '2020-12-11 10:07:45'),
(132, 'MERCHANDISING', '- Connaître les différentes applications du Merchandising, \r\n- Maîtriser les techniques d\'application pour exercer une pression continue sur les linéaires,\r\n- Diminuer les ruptures, \r\n- Renforcer l\'argumentation Marketing et Commerciale.', 'A - Comprendre le fonctionnement du Merchandising\r\nB - Maîtriser les critères de base du Merchandising\r\n - La zone de chalandise du point de vente \r\n-  La vie du produit et les implications du Merchandising \r\n-  Comment définir, caractériser et gérer un assortiment ? \r\nC - Connaître les paramètres d\'implantation et de présentation marchandes\r\n - Les grandes règles d\'organisation d\'une surface de vente \r\n - La valorisation zonale d\'une gondole \r\n - Les règles d\'implantation des produits et l\'attribution des facing\r\n - Le double placement : quand et comment le préconiser ? \r\nD - Comment se servir du Merchandising comme levier de rentabilité ?\r\nE - Utiliser les moyens d\'action du Merchandising pour animer les linéaires', NULL, 11, '2020-12-11 10:15:40', '2020-12-11 10:17:19'),
(133, 'MAITRISE DU TEMPS ET GESTION DES PRIORITES', 'Acquérir les méthodes et outils de gestion du temps nécessaires, permettant d\'anticiper et s\'organiser au quotidien.', '1 - Mettre le temps au service de ses priorités\r\n2 - Maîtriser l\'art d\'une organisation efficace\r\n3 - Agir sur la relation pour gagner du temps collectivement\r\n4 - Gérer son temps et son énergie pour être efficace dans la durée', NULL, 10, '2020-12-11 10:33:02', '2020-12-11 10:33:02'),
(134, 'FONDAMENTAUX DE LA SUPPLY CHAIN', '- Acquérir des outils et méthodes pour améliorer la logistique de son entreprise. \r\n- Comprendre les leviers d\'optimisation des flux de l\'entreprise. \r\n- Comprendre les règles de planification des ressources.', '1/ Globaliser les actes logistiques du fournisseur au client : la \"Supply Chain\" \r\n2/ Maîtriser le système d\'information de gestion logistique \r\n3/ Gérer le stock, les éléments de base pour éviter les ruptures \r\n4/ Livrer le client : de la commande à la livraison \r\n5/ Gérer la relation client \r\n6/ Comprendre l\'importance du transport dans la logistique \r\n7/ Collaborer avec les fournisseurs \r\n8/ Construire son tableau de bord : Mettre en place les indicateurs clés.', NULL, 15, '2020-12-11 10:38:02', '2020-12-11 10:38:02'),
(135, 'GESTION DE LA RELATION CLIENT', '- Intégrer l\'approche relation client à son activité métier\r\n- Maîtriser les étapes et les techniques de la communication relation client\r\n- Valoriser l\'image qualité de son service et de son entreprise', '1- Faire de chaque réclamation l\'opportunité de fidéliser le client\r\n2- Construire et argumenter une solution satisfaisante\r\n3- Faire la différence par ses comportements relationnels\r\n4- Optimiser la qualité des réponses écrites à la réclamation\r\n5- Contribuer à l\'amélioration de la qualité de service', NULL, 11, '2020-12-11 10:45:16', '2020-12-11 10:45:16'),
(136, 'COMMERCE INTERNATIONAL', 'Acquérir les notions fondamentales des techniques du commerce international, produire les bons documents et s’adapter à la dématérialisation, et optimiser la gestion des commandes export.', '1/ Comprendre le mécanisme des opérations internationales \r\nComprendre l\'organisation des marchés internationaux. \r\n2/ Organiser la commercialisation de ses produits ou services \r\n3/ Connaître et limiter les risques d’une offre à l’international \r\n4/ Maîtriser le risque douanier et comprendre les mécanismes logistiques \r\n5/ Maîtriser les risques de non paiement', NULL, 11, '2020-12-11 10:53:17', '2020-12-11 10:53:17');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `firstname` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `photo` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type_user` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'user',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `name`, `firstname`, `email`, `email_verified_at`, `password`, `photo`, `type_user`, `remember_token`, `created_at`, `updated_at`) VALUES
(2, 'Lassfar', 'Aymane', 'aymanelassfar@outlook.com', '2020-07-24 05:02:21', '$2y$10$l2zkC0V1VwMHS90Zfq6GHuzP5ZfePDgHifsm5bLCmyLGj7kkFdARq', 'img/user/1595584919-photo.png', 'admin', 'Jfny3LVcEz230iB1Sm5LbebWQ6ErUTTaVmgJhHSi3Qul0uxqbfcbqhsN1OJW', '2020-07-24 05:01:59', '2020-07-24 05:02:21'),
(4, 'MESSAOUDI', 'Nadia', 'n.messaoudi@mediexperts.ma', '2020-10-05 08:02:45', '$2y$10$3vtq2pVzMQuY/YhKPqYXIejMQMbIkZH4M0zowiv5cMR5kDL9d9KtG', 'img/user/1601899238-photo.PNG', 'user', NULL, '2020-10-05 08:00:38', '2020-10-05 08:02:45'),
(5, 'Ezzohry', 'Mohamed', 'm.ezzohry@mediexperts.ma', NULL, '$2y$10$E.oWgL5Mbi4F0WTEY2tnbOQyBBrLH1Ra6Q4FKDZpunn6OgIJGIea2', 'img/user/1603723490-photo.png', 'comptable', NULL, '2020-10-26 11:44:50', '2020-10-26 11:44:50'),
(10, 'Nacer', 'Oumaima', 'o.nacer@mediexperts.ma', '2020-12-17 10:40:48', '$2y$10$sTMj3n.ST6Ucwu8jsdab7uQLMU9k6Yj84W5KQntGm7gXabO2zvwc2', 'img/user/1608205235-photo.jpg', 'user', 'HEGLUPMDZHOIKLKHg4plYdA64gQzkbaPzoaiFhk9FNovHfFVsegEpcn5FYOt', '2020-12-17 10:40:35', '2020-12-17 10:40:48');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `actionnaires`
--
ALTER TABLE `actionnaires`
  ADD PRIMARY KEY (`id_act`),
  ADD KEY `actionnaires_nrc_e_foreign` (`nrc_e`);

--
-- Index pour la table `cabinets`
--
ALTER TABLE `cabinets`
  ADD PRIMARY KEY (`nrc_cab`),
  ADD UNIQUE KEY `cabinets_raisoci_unique` (`raisoci`),
  ADD UNIQUE KEY `cabinets_id_fiscal_unique` (`id_fiscal`),
  ADD UNIQUE KEY `cabinets_ncnss_unique` (`ncnss`),
  ADD UNIQUE KEY `cabinets_npatente_unique` (`npatente`),
  ADD UNIQUE KEY `cabinets_tele_unique` (`tele`),
  ADD UNIQUE KEY `cabinets_fax_unique` (`fax`),
  ADD UNIQUE KEY `cabinets_email_unique` (`email`),
  ADD UNIQUE KEY `cabinets_website_unique` (`website`);

--
-- Index pour la table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`nrc_entrp`),
  ADD UNIQUE KEY `clients_raisoci_unique` (`raisoci`),
  ADD UNIQUE KEY `clients_rais_abrev_unique` (`rais_abrev`),
  ADD UNIQUE KEY `clients_ice_unique` (`ice`),
  ADD UNIQUE KEY `clients_id_fiscal_unique` (`id_fiscal`),
  ADD UNIQUE KEY `clients_ncnss_unique` (`ncnss`),
  ADD UNIQUE KEY `clients_npatente_unique` (`npatente`);

--
-- Index pour la table `demande_financements`
--
ALTER TABLE `demande_financements`
  ADD PRIMARY KEY (`n_df`),
  ADD KEY `demande_financements_nrc_e_foreign` (`nrc_e`);

--
-- Index pour la table `demande_remboursement_giacs`
--
ALTER TABLE `demande_remboursement_giacs`
  ADD PRIMARY KEY (`n_drb`),
  ADD KEY `demande_remboursement_giacs_n_df_foreign` (`n_df`);

--
-- Index pour la table `demande_remboursement_ofppts`
--
ALTER TABLE `demande_remboursement_ofppts`
  ADD PRIMARY KEY (`n_drb`),
  ADD KEY `demande_remboursement_ofppts_nrc_e_foreign` (`nrc_e`);

--
-- Index pour la table `domaines`
--
ALTER TABLE `domaines`
  ADD PRIMARY KEY (`id_domain`);

--
-- Index pour la table `formations`
--
ALTER TABLE `formations`
  ADD PRIMARY KEY (`id_form`),
  ADD KEY `formations_n_form_foreign` (`n_form`);

--
-- Index pour la table `formation_personnels`
--
ALTER TABLE `formation_personnels`
  ADD PRIMARY KEY (`cin`,`id_form`),
  ADD KEY `formation_personnels_id_form_foreign` (`id_form`);

--
-- Index pour la table `giacs`
--
ALTER TABLE `giacs`
  ADD PRIMARY KEY (`code_giac`),
  ADD UNIQUE KEY `giacs_libelle_unique` (`libelle`),
  ADD UNIQUE KEY `giacs_email_unique` (`email`),
  ADD UNIQUE KEY `giacs_website_unique` (`website`);

--
-- Index pour la table `intervenants`
--
ALTER TABLE `intervenants`
  ADD PRIMARY KEY (`id_interv`),
  ADD KEY `intervenants_nrc_c_foreign` (`nrc_c`);

--
-- Index pour la table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `mission_intervenants`
--
ALTER TABLE `mission_intervenants`
  ADD PRIMARY KEY (`id_interv`,`n_df`),
  ADD KEY `mission_intervenants_n_df_foreign` (`n_df`);

--
-- Index pour la table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Index pour la table `personnels`
--
ALTER TABLE `personnels`
  ADD PRIMARY KEY (`cin`),
  ADD UNIQUE KEY `personnels_matricule_unique` (`matricule`),
  ADD UNIQUE KEY `personnels_cnss_unique` (`cnss`),
  ADD KEY `personnels_nrc_e_foreign` (`nrc_e`);

--
-- Index pour la table `plans`
--
ALTER TABLE `plans`
  ADD PRIMARY KEY (`id_plan`),
  ADD KEY `plans_nrc_e_foreign` (`nrc_e`);

--
-- Index pour la table `plan_formations`
--
ALTER TABLE `plan_formations`
  ADD PRIMARY KEY (`n_form`),
  ADD KEY `plan_formations_id_inv_foreign` (`id_inv`),
  ADD KEY `plan_formations_id_plan_foreign` (`id_plan`);

--
-- Index pour la table `themes`
--
ALTER TABLE `themes`
  ADD PRIMARY KEY (`id_theme`),
  ADD KEY `themes_id_dom_foreign` (`id_dom`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `actionnaires`
--
ALTER TABLE `actionnaires`
  MODIFY `id_act` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `demande_financements`
--
ALTER TABLE `demande_financements`
  MODIFY `n_df` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT pour la table `demande_remboursement_giacs`
--
ALTER TABLE `demande_remboursement_giacs`
  MODIFY `n_drb` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT pour la table `demande_remboursement_ofppts`
--
ALTER TABLE `demande_remboursement_ofppts`
  MODIFY `n_drb` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `domaines`
--
ALTER TABLE `domaines`
  MODIFY `id_domain` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT pour la table `formations`
--
ALTER TABLE `formations`
  MODIFY `id_form` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=191;

--
-- AUTO_INCREMENT pour la table `giacs`
--
ALTER TABLE `giacs`
  MODIFY `code_giac` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pour la table `intervenants`
--
ALTER TABLE `intervenants`
  MODIFY `id_interv` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT pour la table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT pour la table `plans`
--
ALTER TABLE `plans`
  MODIFY `id_plan` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT pour la table `plan_formations`
--
ALTER TABLE `plan_formations`
  MODIFY `n_form` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=222;

--
-- AUTO_INCREMENT pour la table `themes`
--
ALTER TABLE `themes`
  MODIFY `id_theme` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=137;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `actionnaires`
--
ALTER TABLE `actionnaires`
  ADD CONSTRAINT `actionnaires_nrc_e_foreign` FOREIGN KEY (`nrc_e`) REFERENCES `clients` (`nrc_entrp`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `demande_financements`
--
ALTER TABLE `demande_financements`
  ADD CONSTRAINT `demande_financements_nrc_e_foreign` FOREIGN KEY (`nrc_e`) REFERENCES `clients` (`nrc_entrp`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `demande_remboursement_giacs`
--
ALTER TABLE `demande_remboursement_giacs`
  ADD CONSTRAINT `demande_remboursement_giacs_n_df_foreign` FOREIGN KEY (`n_df`) REFERENCES `demande_financements` (`n_df`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `demande_remboursement_ofppts`
--
ALTER TABLE `demande_remboursement_ofppts`
  ADD CONSTRAINT `demande_remboursement_ofppts_nrc_e_foreign` FOREIGN KEY (`nrc_e`) REFERENCES `clients` (`nrc_entrp`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `formations`
--
ALTER TABLE `formations`
  ADD CONSTRAINT `formations_n_form_foreign` FOREIGN KEY (`n_form`) REFERENCES `plan_formations` (`n_form`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `formation_personnels`
--
ALTER TABLE `formation_personnels`
  ADD CONSTRAINT `formation_personnels_cin_foreign` FOREIGN KEY (`cin`) REFERENCES `personnels` (`cin`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `formation_personnels_id_form_foreign` FOREIGN KEY (`id_form`) REFERENCES `formations` (`id_form`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `intervenants`
--
ALTER TABLE `intervenants`
  ADD CONSTRAINT `intervenants_nrc_c_foreign` FOREIGN KEY (`nrc_c`) REFERENCES `cabinets` (`nrc_cab`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `mission_intervenants`
--
ALTER TABLE `mission_intervenants`
  ADD CONSTRAINT `mission_intervenants_id_interv_foreign` FOREIGN KEY (`id_interv`) REFERENCES `intervenants` (`id_interv`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `mission_intervenants_n_df_foreign` FOREIGN KEY (`n_df`) REFERENCES `demande_financements` (`n_df`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `personnels`
--
ALTER TABLE `personnels`
  ADD CONSTRAINT `personnels_nrc_e_foreign` FOREIGN KEY (`nrc_e`) REFERENCES `clients` (`nrc_entrp`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `plans`
--
ALTER TABLE `plans`
  ADD CONSTRAINT `plans_nrc_e_foreign` FOREIGN KEY (`nrc_e`) REFERENCES `clients` (`nrc_entrp`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `plan_formations`
--
ALTER TABLE `plan_formations`
  ADD CONSTRAINT `plan_formations_id_inv_foreign` FOREIGN KEY (`id_inv`) REFERENCES `intervenants` (`id_interv`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `plan_formations_id_plan_foreign` FOREIGN KEY (`id_plan`) REFERENCES `plans` (`id_plan`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `themes`
--
ALTER TABLE `themes`
  ADD CONSTRAINT `themes_id_dom_foreign` FOREIGN KEY (`id_dom`) REFERENCES `domaines` (`id_domain`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
