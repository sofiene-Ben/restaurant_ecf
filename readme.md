Bonjour, 

Bienvenu sur mon ECF, je vais vous expliquer comment exécuter mon site web en local ainsi que la façon de l'utiliser.
Vous verrez c'est assez simple :) 

1. copier le dossier 'ecf_test' dans votre dossier 'htdocs' sur xampp.
2. ouvrer votre navigateur a l'addresse 'localhost'.
3. cliquez sur 'phpMyAdmin'.
4. cliquez sur 'importez'.
5. selectionnez le fichier 'ecf_test_db.sql' situer dans 'ecf_test' et importer la base de donnée.
6. maintenant vous pouvez acceder a votre site web depuis laddresse : 'localhost/ecf_test/font.

<!-- composition du site -->

le site est composer de :

1. une barre de navigation avec un menu contenant les champs suivant : 'acceuil', 'cart', 'connexion', 'reserver'.
2. une galerie d'image avec un effet sur image lorsque la sourie passe au dessus.
3. un bouton de reservation avec une modal de reservation qui s'affiche lors du click. (il n'y a que 3 reservation dispo par crenau horaire)
4. un footer contenant toute les horaire d'ouverture .


<!-- creation d'un administrateur -->

<!-- via l'interface phpMyAdmin -->
1. cliquez sur connexion et crée un compte.
2. retournez sur phpMyAdmin
3. selectionnez la base 'db_restaurant'
4. selectionnez la table membre
5. selectionner la ligne de votre compte et cliquer sur 'editer'.
6. dans le champs 'role' modifier 'user' en 'admin'

<!-- via SQL -->

1. cliquez sur connexion et crée un compte.
2. retournez sur phpMyAdmin
3. selectionnez la base 'db_restaurant'
4. selectionnez la table membre
5. selectionnez l'ongler 'SQL'
6. executez cette ligne en remplaçant les valeurs : INSERT INTO `membre`(`email`, `mdp`, `role`, `nom`) VALUES ('value-1','value-2','value-3','value-4');

<!-- gestion admin -->

lorsque l'administrateur est connecter il a acces a un menu 'admin situer sur la barre de navigation.
il permet a l'admin d'etre rediriger sur le module de gestion de son choix :

1. Gestion galerie
2. Gestion catégorie
3. Gestion plats
4. Gestion formule
5. Gestion horaire ouverture
6. Gestion horaire réservation
7. Gestion table

les modules de gestion se presentes sous forme de tableau contenant :

1. un bouton 'update' pour les modification,
2. un bouton 'delete' pour les suppression,
3. un bouton 'add' pour les ajout.

lors du click sur 'update' ou 'add' une modal s'affiche avec les paramettre de modiffication ou d'ajout.