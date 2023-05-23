<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include('db.php');
include('fonction.php');
if(isset($_POST["operation"]))
{
	if($_POST["operation"] == "Add")
	{
		$image = '';
		if($_FILES["image"]["name"] != '')
		{
			$image = upload_image();
		}
		
		$statement = $connection->prepare("
			INSERT INTO galerie (titre,image) 
			VALUES (:titre,:image)
		");
		
		$resultat = $statement->execute(
			array(
				':titre'	=>	$_POST["titre"],
				':image'		=>	$image,
			)
		);
		if(!empty($resultat))
		{
			echo 'galerie entré avec succès !';
		}
	}
	if($_POST["operation"] == "Edit")
	{
		$image = '';

		if($_FILES["image"]["name"] != '')
		{
			$image = upload_image();
		}
		else
		{
			$image = $_POST["hidden_galerie_image"];
		}
		$statement = $connection->prepare(
			"UPDATE galerie 
			SET titre = :titre,
			 image = :image
			WHERE id= :id
			"
		);
		$resultat = $statement->execute(
			array(
				':titre'	=>	$_POST["titre"],
				':image'		=>	$image,
				':id'=>	$_POST["id"]
			)
		);
		if(!empty($resultat))
		{
			echo 'galerie a été modifié avec succès !';
		}
	}
}

?>