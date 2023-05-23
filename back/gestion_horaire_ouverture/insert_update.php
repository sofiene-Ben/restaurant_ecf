<?php
include('db.php');
include('fonction.php');
if(isset($_POST["operation"]))
{
	if($_POST["operation"] == "Add")
	{
		
		$statement = $connection->prepare("
			INSERT INTO `jours_open` (jour, horaire_opne_days) 
			VALUES (:jour, :horaire_opne_days)
		");
		
		$resultat = $statement->execute(
			array(
				':jour'	=>	$_POST["jour"],
				':horaire_opne_days'	=>	$_POST["horaire_opne_days"],
			)
		);
		if(!empty($resultat))
		{
			echo 'formule entré avec succès !';
		}
	}
	if($_POST["operation"] == "Edit")
	{
		
		$statement = $connection->prepare(
			"UPDATE jours_open 
			SET `jour` = :jour, `horaire_opne_days` = :horaire_opne_days
			WHERE id = :id
			"
		);
		$resultat = $statement->execute(
			array(
				':jour'	=>	$_POST["jour"],
				':horaire_opne_days'	=>	$_POST["horaire_opne_days"],
				':id'=>	$_POST["id"]
			)
		);
		if(!empty($resultat))
		{
			echo 'jours - horaires modifiée avec succès !';
		}
	}
}

?>