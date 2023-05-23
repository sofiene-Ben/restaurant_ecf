<?php
require_once "./inc/init.php";
/**
 * Fonction DEV qui permet un affichage clair des données
 */
function debug($variable){
    echo "<pre>";
        print_r($variable);
    echo "</pre>";
}



// Vérification de la connexion de l'utilisateur 
function isConnected(){
    return isset($_SESSION['user']) ? TRUE : FALSE;
}

// Vérification de la connexion et du status "admin"
function isAdmin(){

    return (isConnected() && $_SESSION['user']['role'] == 'admin') ? TRUE : FALSE;


}
