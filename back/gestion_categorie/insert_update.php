<?php
include('db.php');
include('fonction.php');
if(isset($_POST["operation"]))
{
	if($_POST["operation"] == "Add")
	{
		
		$statement = $connection->prepare("
			INSERT INTO cat (nom) 
			VALUES (:nom)
		");
		
		$resultat = $statement->execute(
			array(
				':nom'	=>	$_POST["nom"],
			)
		);
		if(!empty($resultat))
		{
			echo 'le plat entré avec succès !';
		}
	}
	if($_POST["operation"] == "Edit")
	{
		
		$statement = $connection->prepare(
			"UPDATE cat 
			SET nom = :nom
			WHERE id = :id
			"
		);
		$resultat = $statement->execute(
			array(
				':nom'	=>	$_POST["nom"],
				':id'=>	$_POST["id"]
			)
		);
		if(!empty($resultat))
		{
			echo 'la cat a été modifié avec succès !';
		}
	}
}

?>