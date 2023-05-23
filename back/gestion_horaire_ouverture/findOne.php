<?php
include('db.php');
include('fonction.php');
if(isset($_POST["id"]))
{
	$saida = array();
	
	$statement = $connection->prepare(
		"SELECT * FROM `jours_open` 
		WHERE id = '".$_POST["id"]."' 
		LIMIT 1"
	);
	
	$statement->execute();
	$resultat = $statement->fetchAll();
	
	foreach($resultat as $linha)
	{
		$saida["jour"] = $linha["jour"];
		$saida["horaire_opne_days"] = $linha["horaire_opne_days"];

	}
	echo json_encode($saida);
}
?>