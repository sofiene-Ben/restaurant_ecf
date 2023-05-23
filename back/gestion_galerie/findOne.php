<?php
include('db.php');
include('fonction.php');
if(isset($_POST["id"]))
{
	$saida = array();
	
	$statement = $connection->prepare(
		"SELECT * FROM galerie 
		WHERE id = '".$_POST["id"]."' 
		LIMIT 1"
	);
	
	$statement->execute();
	$resultat = $statement->fetchAll();
	
	foreach($resultat as $row)
	{
		$saida["titre"] = $row["titre"];
		if($row["image"] != '')
		{
			$saida['image'] = '<img src="upload/'.$row["image"].'" class="img-thumbnail" width="50" height="35" /><input type="hidden" name="hidden_galerie_image" value="'.$row["image"].'" />';
		}
		else
		{
			$saida['image'] = '<input type="hidden" name="hidden_galerie_image" value="" />';
		}
	
	}
	echo json_encode($saida);
}
?>