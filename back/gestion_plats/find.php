<?php
include('db.php');
include('fonction.php');

// $query = '';
// $saida = array();
// $query .= "SELECT * FROM plat";

// 	$statement = $connection->prepare($query);
// 	$statement->execute();	
// 	$resultat = $statement->fetchAll();
	
$query = "SELECT plat.id, plat.titre, plat.description, plat.prix, cat.nom
          FROM plat
          INNER JOIN cat ON plat.id_categorie = cat.id";

$statement = $connection->prepare($query);
$statement->execute();	
$resultat = $statement->fetchAll();
	

	$dados = array();
	$contar_rows = $statement->rowCount();
	
	foreach($resultat as $row)
	{
		// $id_cat = $row["id_categorie"];
		// $query2 = "SELECT id, nom FROM cat WHERE id = :id_cat";
		// $statement2 = $connection->prepare($query2);
		// $statement2->bindParam(':id_cat', $id_cat, PDO::PARAM_INT);
		// $statement2->execute();
		// $cat = $statement2->fetch();


		$sub_array = array();
		$sub_array[] = $row["id"];
		$sub_array[] = $row["titre"];
		$sub_array[] = $row["description"];
		$sub_array[] = $row["prix"];
		$sub_array[] = $row["nom"];
		// $sub_array[] = $cat["nom"];
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