<?php
require_once "./inc/init.php";


if (isset($_POST["mdp"]) && isset($_POST["email"])) {
  $mdp = $_POST["mdp"];
  $email = $_POST["email"];

  $email = filter_var($email, FILTER_VALIDATE_EMAIL);
  $mdp = trim($mdp); // Supprime les espaces en début et fin de mot de passe
  $mdp = stripslashes($mdp); // Supprime les antislashes éventuellement ajoutés


  $requete = $bdd->prepare("SELECT * FROM membre WHERE email = :email");
  $requete->execute([':email' => $email]);

  if ($requete->rowCount() == 1) {
      $membre = $requete->fetch(PDO::FETCH_ASSOC);
      //debug($membre);

      $dbpwd = $membre['mdp'];

      if (password_verify($mdp, $dbpwd)) {
          $_SESSION['user'] = $membre;
          $_SESSION['nom'] = $membre['nom'];
          $_SESSION['id'] = $membre['id'];
          $_SESSION['role'] = $membre['role'];
          echo "Vous êtes connecté, Monsieur " . htmlspecialchars($membre['nom']) . " en tant que " . htmlspecialchars($membre['role']);
      } else {
          echo "Identifiants incorrects";
      }
  } else {
      echo "Identifiants incorrects";
  }
}



?>
