-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : mar. 08 sep. 2020 à 14:27
-- Version du serveur :  10.4.13-MariaDB
-- Version de PHP : 7.4.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `immobilier`
--

-- --------------------------------------------------------

--
-- Structure de la table `logement`
--

CREATE TABLE `logement` (
  `id_logement` int(11) NOT NULL,
  `titre` varchar(50) NOT NULL,
  `adresse` varchar(255) NOT NULL,
  `ville` varchar(50) NOT NULL,
  `cp` int(10) NOT NULL,
  `surface` int(5) NOT NULL,
  `prix` int(8) NOT NULL,
  `photo` varchar(55) NOT NULL,
  `type` enum('vente','location') NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `logement`
--

INSERT INTO `logement` (`id_logement`, `titre`, `adresse`, `ville`, `cp`, `surface`, `prix`, `photo`, `type`, `description`) VALUES
(10, 'Grande maison', '78 rue maurepas', 'Le bourget', 93350, 250, 450000, 'photos/maison.jpg', 'vente', 'Grande maison'),
(11, 'Appartement', '72 rue Mirabeau', 'Boulogne', 92750, 75, 520000, 'photos/photo2.jpg', 'vente', 'Appartement'),
(29, 'Appartement', '17 Avenue Clémenceau', 'Drancy', 93352, 150, 800000, 'photos/photo1.jpg', 'vente', 'igbjerbgierbgerbgierbgibertgbertzigertizgiretzgiperztirgigiretbgirebvcerfbvezrtigiertzgertg'),
(30, 'Appartement', '17 Avenue Clémenceau', 'Drancy', 93352, 150, 450000, 'photos/photo9.jpg', 'vente', 'hgfirebgeribgerigberigerhgiergiergerbgiertgeriger'),
(41, 'Grande maison', '43 rue Brochant', 'Paris 17eme', 75017, 150, 700000, 'photos/photo5.jpeg', 'vente', ''),
(42, 'Appartement', '7 rue Grande', 'La courneuve', 93352, 140, 260000, 'photos/photo4.jpg', 'vente', 'ibgiprgpiregherogeoerhgoerhgohgoehgorehgorhgorthgorthgorhgoehgoerhgorehgoerthgeorhgoerhgoerhg'),
(43, 'Appartement', '17 Avenue Clémenceau', 'Drancy', 93352, 150, 235000, 'photos/photo8.jpg', 'vente', 'giergiugoirtgoithgohgohgogohohgohoghh('),
(44, 'Appartement', '43 rue Brochant', 'Paris 17eme', 75017, 150, 700000, 'logement1599561387', 'vente', 'rthtyjetyyuyuyujkyu,y&#039;ujyu,yu,ryuntyjtyt,'),
(45, 'Appartement', '32 rue des plantes', 'Le bourget', 93350, 90, 254000, 'logement1599562000', 'vente', 'tyjytferifiergierhgeirhgiregiregigergirgregregergeg'),
(47, 'Appartement', '17 Avenue Clémenceau', 'Drancy', 93352, 150, 250000, 'photos/logement1599563198', 'vente', '');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `logement`
--
ALTER TABLE `logement`
  ADD PRIMARY KEY (`id_logement`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `logement`
--
ALTER TABLE `logement`
  MODIFY `id_logement` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
