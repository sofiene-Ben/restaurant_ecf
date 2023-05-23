<?php
include('db.php');
include("fonction.php");

if(isset($_POST["id"]))
{
	
	
	$statement = $connection->prepare(
		"DELETE FROM `jours_open` WHERE `id` = :id"
	);
	$resultat = $statement->execute(
		array(
			':id'	=>	$_POST["id"]
		)
	);
	
	if(!empty($resultat))
	{
		echo 'jour - horaire supprimé';
	}
}


?>