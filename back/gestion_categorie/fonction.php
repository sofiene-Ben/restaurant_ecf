<?php

function get_total_records()
{
	include('db.php');
	$statement = $connection->prepare("SELECT * FROM cat");
	$statement->execute();
	$resultat = $statement->fetchAll();
	return $statement->rowCount();
}

?>