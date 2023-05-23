<?php
include('db.php');
include('fonction.php');
if(isset($_POST["id"]))
{
	$saida = array();
	
	$statement = $connection->prepare(
		"SELECT * FROM plat 
		WHERE id = '".$_POST["id"]."' 
		LIMIT 1"
	);
	
	$statement->execute();
	$resultat = $statement->fetchAll();
	
	foreach($resultat as $linha)
	{
		$saida["titre"] = $linha["titre"];
		$saida["description"] = $linha["description"];
		$saida["prix"] = $linha["prix"];
		$saida["id_categorie"] = $linha["id_categorie"];
	
	}
	echo json_encode($saida);
}
?>