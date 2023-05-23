<?php
include('db.php');
include('fonction.php');
if(isset($_POST["operation"]))
{
	if($_POST["operation"] == "Add")
	{
		
		$statement = $connection->prepare("
			INSERT INTO table_ (nb_couverts,date,id_horaire,mention_des_allergie) 
			VALUES (:nb_couverts,:date,:id_horaire,:mention_des_allergie)
		");
		
		$resultat = $statement->execute(
			array(
				':nb_couverts'	=>	$_POST["nb_couverts"],
				':date'	=>	$_POST["date"],
				':id_horaire'	=>	$_POST["id_horaire"],
				':mention_des_allergie'	=>	$_POST["mention_des_allergie"],
			)
		);
		if(!empty($resultat))
		{
			echo 'le table_ entré avec succès !';
		}
	}
	if($_POST["operation"] == "Edit")
	{
		
		$statement = $connection->prepare(
			"UPDATE table_ 
			SET nb_couverts = :nb_couverts, date = :date, id_horaire = :id_horaire, mention_des_allergie = :mention_des_allergie
			WHERE id = :id
			"
		);
		$resultat = $statement->execute(
			array(
				':nb_couverts'	=>	$_POST["nb_couverts"],
				':date'	=>	$_POST["date"],
				':id_horaire'	=>	$_POST["id_horaire"],
				':mention_des_allergie'	=>	$_POST["mention_des_allergie"],
				':id'=>	$_POST["id"]
			)
		);
		if(!empty($resultat))
		{
			echo 'le table_ a été modifié avec succès !';
		}
	}
}

?>