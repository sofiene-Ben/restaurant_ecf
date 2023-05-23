<?php

require_once "./inc/init.php";
include('db.php');



if (isset($_POST['liste_couverts']) && isset($_POST["date_reservation"]) && isset($_POST["choix"])) {

    $date_resa = htmlspecialchars($_POST["date_reservation"]);
    $heure_resa = htmlspecialchars($_POST["choix"]);
    $liste_couverts = htmlspecialchars($_POST['liste_couverts']);
    $mention_allergies = htmlspecialchars($_POST["mention_des_allergie"]);

    $conn = mysqli_connect("localhost", "root", "", "restaurant_db");
    if (!$conn) {
        die("Erreur de connexion à la base de données : " . mysqli_connect_error());
    }

    // Requête SQL pour compter le nombre de lignes avec des données similaires
    $query = "SELECT COUNT(*) AS count FROM `table_` WHERE `date` = '$date_resa' AND `id_horaire` = '$heure_resa'";
    $result = mysqli_query($conn, $query);

    if ($result) {
        // Récupération du nombre de lignes trouvées
        $row = mysqli_fetch_assoc($result);
        $count = $row['count'];

        if ($count < 3) {
            // Requête préparée pour l'insertion des données
            $statement = $connection->prepare("
                INSERT INTO table_ (nb_couverts, date, id_horaire, mention_des_allergie) 
                VALUES (:nb_couverts, :date, :id_horaire, :mention_des_allergie)
            ");

            $resultat = $statement->execute(
                array(
                    ':nb_couverts' => $liste_couverts,
                    ':date' => $date_resa,
                    ':id_horaire' => $heure_resa,
                    ':mention_des_allergie' => $mention_allergies
                )
            );

            $id_table = $connection->lastInsertId();

            if (!empty($resultat)) {
                echo 'La table a été réservée avec succès pour la table N° ' . $id_table;
            }

            if (!empty($_POST['id_membre'])) {
                $id_membre = htmlspecialchars($_POST['id_membre']);

                // Requête préparée pour l'insertion de la réservation
                $statement = $connection->prepare("
                    INSERT INTO reservation (id_membre, id_table, role)
                    VALUES (:id_membre, :id_table, :role)
                ");

                $resultat = $statement->execute(
                    array(
                        ':id_membre' => $id_membre,
                        ':id_table' => $id_table,
                        ':role' => $role
                    )
                );

                if (!empty($resultat)) {
                    echo 'La réservation a été prise en compte pour ' . $role . ' ' . $id_membre;
                }
            } else {
                // Requête préparée pour l'insertion de la réservation (invité)
                $statement = $connection->prepare("
                    INSERT INTO reservation (id_table, role)
                    VALUES (:id_table, :role)
                ");

                $resultat = $statement->execute(
                    array(
                        ':id_table' => $id_table,
                        ':role' => 'guest'
                    )
                );

                if (!empty($resultat)) {
                    echo 'La réservation a été prise en compte pour la table N° ' . $id_table;
                } else {
                    echo 'La réservation a échoué';
                }
            }
        } else {
            // Message d'erreur si trois lignes ou plus trouvées
            echo "Erreur : Il n'y a plus de disponibilité pour cette date.";
        }
    } else {
        // Message d'erreur si la requête échoue
        echo "Erreur lors de l'exécution de la requête : " . mysqli_error($conn);
    }

    // Fermeture de la connexion à la base de données
    mysqli_close($conn);
} else {
    echo 'il faut remplir tous le formulaire';
}






?>
