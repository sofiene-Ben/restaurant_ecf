<?php
include('db.php');
include('fonction.php');
if(isset($_POST["operation"]))
{
	if($_POST["operation"] == "Add")
	{
		
		$statement = $connection->prepare("
			INSERT INTO `horaire_ouverture` (horaire, midi) 
			VALUES (:horaire, :midi)
		");
		
		$resultat = $statement->execute(
			array(
				':horaire'	=>	$_POST["horaire"],
				':midi'	=>	$_POST["midi"],
			)
		);
		if(!empty($resultat))
		{
			echo 'horaire entré avec succès !';
		}
	}
	if($_POST["operation"] == "Edit")
	{
		
		$statement = $connection->prepare(
			"UPDATE horaire_ouverture 
			SET `horaire` = :horaire, `midi` = :midi
			WHERE id = :id
			"
		);
		$resultat = $statement->execute(
			array(
				':horaire'	=>	$_POST["horaire"],
				':midi'	=>	$_POST["midi"],
				':id'=>	$_POST["id"]
			)
		);
		if(!empty($resultat))
		{
			echo 'horaires modifiée avec succès !';
		}
	}
}

?>