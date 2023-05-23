<?php
include('db.php');
include('fonction.php');
$query = '';
$saida = array();
$query .= "SELECT * FROM galerie";


	// if(isset($_POST["search"]["value"]))
	// {
	// 	$query .= 'WHERE titre_galerie LIKE "%'.$_POST["search"]["value"].'%" ';
	// 	$query .= 'OR marque LIKE "%'.$_POST["search"]["value"].'%" ';
	// 	$query .= 'OR modele LIKE "%'.$_POST["search"]["value"].'%" ';
	// 	$query .= 'OR description_galerie LIKE "%'.$_POST["search"]["value"].'%" ';
	// 	$query .= 'OR image LIKE "%'.$_POST["search"]["value"].'%" ';
	// 	$query .= 'OR prix_journalier LIKE "%'.$_POST["search"]["value"].'%" ';
	// 	$query .= 'OR id_agence LIKE "%'.$_POST["search"]["value"].'%" ';
	// 	$query .= 'OR date_enregistrement LIKE "%'.$_POST["search"]["value"].'%" ';
	// }	
	// if(isset($_POST["order"]))
	// {
	// 	$query .= 'ORDER BY '.$_POST['order']['0']['column'].' '.$_POST['order']['0']['dir'].' ';
	// }
	// else
	// {
	// $query .= 'ORDER BY id_galerie DESC ';
	// }
	// if($_POST["length"] != -1)
	// {
	// 	$query .= 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
	// }	


	$statement = $connection->prepare($query);
	$statement->execute();	
	$resultat = $statement->fetchAll();
	
	

	$data = array();
	$contar_rows = $statement->rowCount();
	
	foreach($resultat as $row)
	{
		$image = '';
		if($row["image"] != '')
		{
			$image = '<img src="upload/'.$row["image"].'" class="img-thumbnail" width="50" height="35" />';
		}
		else
		{
			$image = '';
		}
		$sub_array = array();
		$sub_array[] = $row["id"];
		$sub_array[] = $row["titre"];
		$sub_array[] = $image;
		$sub_array[] = '<button type="button" name="update" id="'.$row["id"].'" class="btn-update btn update">Update</button>';
		$sub_array[] = '<button type="button" name="delete" id="'.$row["id"].'" class="btn-delete btn delete">Delete</button>';
		$data[] = $sub_array;
		
	}


	$saida = array(
	 	"draw"				=>	intval(isset($_POST["draw"])),
		"recordsTotal"		=> 	$contar_rows,
		"recordsFiltered"	=>	get_total_records(),
		"data"				=>	$data
	);
	echo json_encode($saida);
?>