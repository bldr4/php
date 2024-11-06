DROP TABLE IF EXISTS `categories`;
CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) NOT NULL,
  `parent` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

INSERT INTO `categories` (`id`, `nom`, `parent`) VALUES
(1, 'smartphone', 0),
(2, 'ios', 1),
(3, 'android', 1),
(4, 'Ordinateurs', 0),
(5, 'Bureau', 4),
(6, 'Portabe', 4),
(7, 'Composants ', 4);

DROP TABLE IF EXISTS `panier`;
CREATE TABLE IF NOT EXISTS `panier` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `produit_id` int(11) NOT NULL,
  `qte` int(11) NOT NULL,
  `prixTotal` int(11) NOT NULL,
  `date` datetime NOT NULL,
  `userTemp` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `status` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=30 DEFAULT CHARSET=utf8;



DROP TABLE IF EXISTS `produits`;
CREATE TABLE IF NOT EXISTS `produits` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `prix` decimal(10,0) NOT NULL,
  `qte` int(11) NOT NULL,
  `img` varchar(255) NOT NULL,
  `categorie_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=20 DEFAULT CHARSET=utf8;

INSERT INTO `produits` (`id`, `nom`, `description`, `prix`, `qte`, `img`, `categorie_id`) VALUES
(1, 'Dell XPS', 'Ultrabook haute performance avec écran InfinityEdge', '1300', 7, 'DellXPS.jpg', 5),
(2, 'Dell XPS 13', 'Convertible polyvalent avec écran tactile 13 pouces', '1500', 2, 'DellXPS13.png', 6),
(3, 'Google Pixel 7A', 'Smartphone performant avec Android pur', '650', 18, 'GooglePixel7A.png', 3),
(4, 'HP Pavilion', 'Ordinateur de bureau polyvalent pour le travail et le jeu', '750', 15, 'HPPavilion.jpg', 5),
(5, 'Intel Core i9', 'Processeur puissant pour le gaming et le multitasking', '550', 24, 'i9.jpg', 7),
(6, 'iPhone 13', 'Le dernier modèle de smartphone par Apple', '910', 29, 'iphone13.png', 2),
(7, 'iPhone 14', 'Smartphone Apple avec une caméra améliorée et un nouveau design', '1000', 31, 'iphone14.png', 2),
(8, 'iPhone 14 Pro', 'Version Pro avec des caractéristiques haut de gamme', '1160', 24, 'iphone14pro.jpg', 2),
(9, 'Lenovo IdeaCentre', 'Ordinateur de bureau compact avec performances solides', '600', 19, 'LenovoIdeaCentre.png', 5),
(10, 'Lenovo ThinkPad', 'Ordinateur portable d\'entreprise avec sécurité renforcée', '1400', 10, 'LenovoThinkPad.png', 6),
(11, 'MacBook Pro', 'Portable puissant pour les créateurs avec puce M1', '2500', 8, 'MacBookPro.png', 6),
(12, 'OnePlus 11', 'Smartphone avec charge rapide et écran AMOLED', '800', 15, 'OnePlus11.png', 3),
(13, 'NVIDIA GeForce RTX', 'Carte graphique pour une expérience de jeu ultime', '1500', 10, 'RTX40490.png', 7),
(14, 'Samsung Galaxy A54', 'Smartphone milieu de gamme avec excellentes caractéristiques', '360', 50, 'SamsungGalaxyA54.jpg', 3),
(15, 'Samsung EVO SSD', 'Disque dur SSD fiable et rapide', '110', 100, 'SSD.png', 7);



DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) NOT NULL,
  `mail` varchar(255) NOT NULL,
  `mdp` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

