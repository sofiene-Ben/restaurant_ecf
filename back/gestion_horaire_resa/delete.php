<?php
include('db.php');
include("fonction.php");

if(isset($_POST["id"]))
{
	
	
	$statement = $connection->prepare(
		"DELETE FROM `horaire_ouverture` WHERE `id` = :id"
	);
	$resultat = $statement->execute(
		array(
			':id'	=>	$_POST["id"]
		)
	);
	
	if(!empty($resultat))
	{
		echo 'horaire supprimé';
	}
}


?>