-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : lun. 20 mai 2024 à 21:40
-- Version du serveur : 10.4.32-MariaDB
-- Version de PHP : 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `blog_db`
--

-- --------------------------------------------------------

--
-- Structure de la table `articles`
--

CREATE TABLE `articles` (
  `id` int(11) NOT NULL,
  `images` blob NOT NULL,
  `texte` text NOT NULL,
  `auteur` text NOT NULL,
  `date` datetime NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `articles`
--

INSERT INTO `articles` (`id`, `images`, `texte`, `auteur`, `date`, `image`, `user_id`, `title`) VALUES
(1, '', 'Une année au couleur de l\'Afrique', '3', '2024-05-18 14:11:47', 'uploads/photo_2021-05-11_05-27-49.jpg', NULL, NULL),
(2, '', 'Toute profession rapporte profit à celui qui l\'exerce: salaire benéfice ou traitement. Il en resulte que nous sommes tenus d\'en donner toute son argent à cxelui qui l\'exercelhklhmljflefhmkklklkl jk,;jk   nfkhk kh.', '3', '2024-05-18 14:15:23', 'uploads/2429_transautomobile-hyundai-tucson-facelift-2429-504343.jpg', NULL, NULL),
(3, '', 'Toute profession rapporte profit à celui qui l\'exerce: salaire benéfice ou traitement. Il en resulte que nous sommes tenus d\'en donner toute son argent à cxelui qui l\'exercelhklhmljflefhmkklklkl jk,;jk   nfkhk kh.', '0', '2024-05-18 14:50:21', 'uploads/2429_transautomobile-hyundai-tucson-facelift-2429-504343.jpg', 3, NULL),
(7, '', 'jkspîpîoô.Z%IKPÏ¨GKPGDKJLHSFKHKLSJmlmùlqmùkmlehklznr;gvfnklvjksw,c.!s<MLKsmùl!aq,clndl', '0', '2024-05-18 15:28:02', 'uploads/HOMME.jpg', 3, 'jklihoujmomùl'),
(9, '', 'Je donne des formations en trading. Je suis unréférent digital.Je donne des formations en trading. Je suis unréférent digital.Je donne des formations en trading. Je suis unréférent digital.Je donne des formations en trading. Je suis unréférent digital.Je donne des formations en trading. Je suis unréférent digital.Je donne des formations en trading. Je suis unréférent digital.Je donne des formations en trading. Je suis unréférent digital.Je donne des formations en trading. Je suis unréférent digital.Je donne des formations en trading. Je suis unréférent digital.', '0', '2024-05-19 18:44:17', 'uploads/MetaTrader 5.png', 3, 'Je donne des formations en trading. Je suis unréférent digital'),
(10, '', 'Mon premier projet de developpement web. Ma reconversion se fait plutot bien..Mon premier projet de developpement web. Ma reconversion se fait plutot bien..Mon premier projet de developpement web. Ma reconversion se fait plutot bien..Mon premier projet de developpement web. Ma reconversion se fait plutot bien..Mon premier projet de developpement web. Ma reconversion se fait plutot bien..Mon premier projet de developpement web. Ma reconversion se fait plutot bien..Mon premier projet de developpement web. Ma reconversion se fait plutot bien..Mon premier projet de developpement web. Ma reconversion se fait plutot bien..Mon premier projet de developpement web. Ma reconversion se fait plutot bien..Mon premier projet de developpement web. Ma reconversion se fait plutot bien..Mon premier projet de developpement web. Ma reconversion se fait plutot bien..Mon premier projet de developpement web. Ma reconversion se fait plutot bien..Mon premier projet de developpement web. Ma reconversion se fait plutot bien..Mon premier projet de developpement web. Ma reconversion se fait plutot bien..Mon premier projet de developpement web. Ma reconversion se fait plutot bien..0Mon premier projet de developpement web. Ma reconversion se fait plutot bien..', '0', '2024-05-19 18:47:36', 'uploads/UL-TOGO.png', 3, 'Mon premier projet de developpement web'),
(11, '', 'knhkhkljlkmdf;ùdn;wv,:w,l,:f,;:sd,:b,g:,;b:,:n,:,;khqsknknhkhkljlkmdf;ùdn;wv,:w,l,:f,;:sd,:b,g:,;b:,:n,:,;khqsknknhkhkljlkmdf;ùdn;wv,:w,l,:f,;:sd,:b,g:,;b:,:n,:,;khqsknknhkhkljlkmdf;ùdn;wv,:w,l,:f,;:sd,:b,g:,;b:,:n,:,;khqskn', '', '0000-00-00 00:00:00', 'uploads/wascal.jpeg', 3, 'klhsmljmkmùklmùlùlf!ù:w'),
(13, '', 'ijokpl', '', '0000-00-00 00:00:00', 'uploads/port-en-eau-profonde-togo-port.jpg', 3, 'lkkpkpmkpm'),
(15, '', 'lljolloio', '', '0000-00-00 00:00:00', 'uploads/position-strategique-pal-1.jpg', 3, 'dghtjuk');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `Nom` text NOT NULL,
  `Email` text NOT NULL,
  `Mot_de_passe` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `Nom`, `Email`, `Mot_de_passe`) VALUES
(1, 'Jacques', 'jacquesagbavor@gmail.com', '$2y$10$pGvXChgQREf9AhMG7PJ5SO7YykVeo70seFKmtItCTmxRvNhUAVyc2'),
(2, 'Jacques', 'jacquesagbavor@gmail.com', '$2y$10$GXpDnuSL16rFgq4hxAIQveHkjuxnPP9Td/BwSA9.fNmlZLaDo294q'),
(3, 'Kodjo', 'kodjoagbavor@gmail.com', '$2y$10$NiTWHaNMTazugwLct6jbIOxVPv75mQLwRFNc3kAl3166qdOPx8knG'),
(4, 'Jacques', 'jacques@gmail.com', '$2y$10$3J1DyF4B/.AF6iDZb01GNePQpFb4yKgRDvsHneY/YdWj3d03yB3Zy'),
(5, 'Komi', 'komi@gmail.com', '$2y$10$mKiwuKT0h3BIVX26GDOB0.H8ZVDcyQsZwETkvFRcXwQuBq0kZxRra'),
(6, 'Komi', 'komi98@gmail.com', '$2y$10$YPzCAiL25lQ6KkXjKNCmx.5STUsVBQ5m1iVA6x7aybt9rq/272VIC'),
(7, 'Jacques', 'james@gmail.com', '$2y$10$kbLUHfapxnegI1hR.U0JLuLFA3X9N2t94Ux4e9Iy1OhdgCBfHUrc2');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `articles`
--
ALTER TABLE `articles`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `articles`
--
ALTER TABLE `articles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
