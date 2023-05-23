<?php

include('db.php');
require_once "./inc/init.php";

unset($_SESSION['user']);

if (!empty($_POST)) {

    $mdp = $_POST["mdp_"]; // Récupération du mot de passe depuis le formulaire
    $mdp = trim($mdp); // Supprime les espaces en début et fin de mot de passe
    $mdp = stripslashes($mdp); // Supprime les antislashes éventuellement ajoutés
    
    $email = filter_var($_POST["email_"], FILTER_VALIDATE_EMAIL);
    $nom = filter_var($_POST["nom"], FILTER_SANITIZE_STRING);


    if (empty($email) || empty($mdp) || empty($nom)) {
        echo "Veuillez remplir tous les champs du formulaire.";
        // Gérer l'erreur de champs vides selon vos besoins
      } elseif ($email === false) {
        echo "L'adresse e-mail n'est pas valide.";
        // Gérer l'erreur de validation de l'e-mail selon vos besoins
      } else {
        // Hashage du mot de passe
        $hash = password_hash($mdp, PASSWORD_DEFAULT);
    
        $statement = $connection->prepare("
            INSERT INTO membre (email, mdp, role, nom) 
            VALUES (:email, :mdp, :role, :nom)
        ");
        
        $statement->bindValue(':email', $email);
        $statement->bindValue(':mdp', $hash); // Utilisation du mot de passe hashé
        $statement->bindValue(':role', "user");
        $statement->bindValue(':nom', $nom);
    
        $resultat = $statement->execute();
    
        if ($resultat) {
            echo "Bravo vous êtes inscrit. Vous pouvez maintenant vous connecter !";
        } else {
            echo "Une erreur s'est produite lors de l'enregistrement.";
        }
      }
    }
    
?>


