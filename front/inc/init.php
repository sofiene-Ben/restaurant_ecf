<?php

session_start();

try {
$sgbd = "mysql";
$host = "localhost";
$dbname = "restaurant_db";
$username = "root";
$password = "";
$options = [ 
    PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING, ];


 $bdd = new PDO("$sgbd:host=$host;dbname=$dbname", $username, $password, $options);}

 catch (Exception $e) {
    die("ERREUR CONNEXION BDD : " . $e->getMessage());
}


$errorMessage = "";
$successMessage = "";


require_once "functions.php";


define( "RACINE_SITE", str_replace( "\\", "/", str_replace( "inc", "", __DIR__ ) ) );

define("URL", "http://$_SERVER[HTTP_HOST]".str_replace($_SERVER['DOCUMENT_ROOT'], "", RACINE_SITE));
