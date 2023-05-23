<?php
include('db.php');
include('fonction.php');
if(isset($_POST["id"]))
{
	$saida = array();
	
	$statement = $connection->prepare(
		"SELECT * FROM table_ 
		WHERE id = '".$_POST["id"]."' 
		LIMIT 1"
	);
	
	$statement->execute();
	$resultat = $statement->fetchAll();
	
	foreach($resultat as $linha)
	{
		$saida["nb_couverts"] = $linha["nb_couverts"];
		$saida["date"] = $linha["date"];
		$saida["id_horaire"] = $linha["id_horaire"];
		$saida["mention_des_allergie"] = $linha["mention_des_allergie"];
	
	}
	echo json_encode($saida);
}
?>