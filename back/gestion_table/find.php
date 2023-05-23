<?php
include('db.php');
include('fonction.php');

$query = "SELECT table_.id, table_.nb_couverts, table_.date, table_.mention_des_allergie, horaire_ouverture.horaire
          FROM table_
          INNER JOIN horaire_ouverture ON table_.id_horaire = horaire_ouverture.id";

	$statement = $connection->prepare($query);
	$statement->execute();	
	$resultat = $statement->fetchAll();

	$dados = array();
	$contar_rows = $statement->rowCount();
	
	foreach($resultat as $row)
	{
		$sub_array = array();
		$sub_array[] = $row["id"];
		$sub_array[] = $row["nb_couverts"];
		$sub_array[] = $row["date"];
		$sub_array[] = $row["mention_des_allergie"];
		$sub_array[] = $row["horaire"];
		$sub_array[] = '<button type="button" name="update" id="'.$row["id"].'" class="btn btn-warning btn-xs update">Update</button>';
		$sub_array[] = '<button type="button" name="delete" id="'.$row["id"].'" class="btn btn-danger btn-xs delete">Delete</button>';
		$dados[] = $sub_array;
	}


	$saida = array(
	 	"draw"				=>	intval(isset($_POST["draw"])),
		"recordsTotal"		=> 	$contar_rows,
		"recordsFiltered"	=>	get_total_records(),
		"data"				=>	$dados
	);
	echo json_encode($saida);
?>