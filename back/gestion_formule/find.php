<?php
include('db.php');
include('fonction.php');

$query = '';
$saida = array();
$query .= "SELECT * FROM menu_formule";

	$statement = $connection->prepare($query);
	$statement->execute();	
	$resultat = $statement->fetchAll();
	
	

	$dados = array();
	$contar_rows = $statement->rowCount();
	
	foreach($resultat as $row)
	{
		$sub_array = array();
		$sub_array[] = $row["id"];
		$sub_array[] = $row["name"];
		$sub_array[] = $row["content"];
		$sub_array[] = $row["price"];
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