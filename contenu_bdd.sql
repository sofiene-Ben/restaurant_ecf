USE restaurant_db;

UPDATE `membre` SET `role` = 'admin' WHERE id = 1;


INSERT INTO `cat` (`nom`) VALUES 
('nos entrées'),
('nos plats'),
('nos burger'),
('nos desserts');


INSERT INTO `menu_formule` (`name`, `content`, `price`) VALUES
('menu grand gourmand', 'petite entrée/plat ou plat/dessert', '29'),
('menu special midi', 'petite entrée/plat', '18');


INSERT INTO `plat` (`titre`, `description`, `prix`, `id_categorie`) VALUES
('Salde Cesar ', 'Poulet / Salade', 13, 1),
('Tartar Avocats ', 'Avocats / Crevette / Crème', 15, 1),
('Lemon-Rosemary Vegetable ', 'Poulet / Creme / Champigion', 24, 2),
('Lemon-Rosemary Vegetable ', 'Poulet / Creme / Champigion', 24, 2),
('Big Burger ', 'Boeuf / Oignons / Salade', 24, 3),
('Hamburger ', 'Poulet / Salade / Fromage', 24, 3),
('Tiramissu', 'Speculos / Oreo', 7, 4),
('Chees Cake', 'framboise', 8.99, 4);


INSERT INTO `horaire_ouverture` (`horaire`, `midi`) VALUES
('12:00', 1),
('13:00', 1),
('14:00', 1),
('19:00', 0),
('20:00', 0),
('21:00', 0),
('22:00', 0);


INSERT INTO `jours_open` (`jour`, `horaire_opne_days`) VALUES
('Lundi', '12:00 - 14:00 / 19:00 - 22:00'),
('Mardi', '12:00 - 14:00 / 19:00 - 22:00'),
('Mercredi', '12:00 - 14:00 / 19:00 - 22:00'),
('Jeudi', '12:00 - 14:00 / 19:00 - 22:00'),
('Vendredi', '12:00 - 14:00 / 19:00 - 22:00'),
('Samedi', '12:00 - 14:00 / 19:00 - 22:00'),
('Dimanche', '12:00 - 14:00 / 19:00 - 22:00');


INSERT INTO `galerie` (`titre`, `image`) VALUES 
('Burger', '269082757.png'),
('Salade', '591621117.png');
