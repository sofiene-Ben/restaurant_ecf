<?php

// include('db.php');
// include("fonction.php");

// if(isset($_POST["id"]))
// {
// 	$image = get_image_name($_POST["id"]);
	
// 	if($image != '')
// 	{
// 		unlink("upload/" . $image);
// 	}
	
// 	$statement = $connection->prepare(
// 		"DELETE FROM galerie WHERE id = :id"
// 	);
// 	$resultat = $statement->execute(
// 		array(
// 			':id'	=>	$_POST["id"]
// 		)
// 	);
	
// 	if(!empty($resultat))
// 	{
// 		echo 'galerie supprimé';
// 	}
// }




include('db.php');
include("fonction.php");

// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);

if(isset($_POST["id"]))
{
	$id = $_POST["id"];
	$image = get_image_name($id);
	
	if($image != '')
	{
		$cheminImage = "upload/" . $image;
		
		if(file_exists($cheminImage))
		{
			unlink($cheminImage);
		}
		else
		{
			echo "Le fichier image n'existe pas.";
			exit;
		}
	}
	
	$statement = $connection->prepare(
		"DELETE FROM galerie WHERE id = :id"
	);
	$resultat = $statement->execute(
		array(
			':id'	=>	$id
		)
	);
	
	if($resultat)
	{
		echo 'La galerie a été supprimée.';
	}
	else
	{
		echo 'Erreur lors de la suppression de la galerie.';
	}
}


?>