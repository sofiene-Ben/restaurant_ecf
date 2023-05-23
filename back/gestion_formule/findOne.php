<?php
include('db.php');
include('fonction.php');
if(isset($_POST["id"]))
{
	$saida = array();
	
	$statement = $connection->prepare(
		"SELECT * FROM `menu_formule` 
		WHERE id = '".$_POST["id"]."' 
		LIMIT 1"
	);
	
	$statement->execute();
	$resultat = $statement->fetchAll();
	
	foreach($resultat as $linha)
	{
		$saida["name"] = $linha["name"];
		$saida["content"] = $linha["content"];
		$saida["price"] = $linha["price"];
	}
	echo json_encode($saida);
}
?>