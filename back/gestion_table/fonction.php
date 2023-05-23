<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


function upload_image()
{
	if(isset($_FILES["image"]))
	{
		$extension = explode('.', $_FILES['image']['name']);
		$new_name = rand() . '.' . $extension[1];
		$destination = './upload/' . $new_name;
		move_uploaded_file($_FILES['image']['tmp_name'], $destination);
		return $new_name;
	}
}

function get_image_name($id_galerie)
{
	include('db.php');
	$statement = $connection->prepare("SELECT image FROM galerie WHERE id = '$id_galerie'");
	$statement->execute();
	$resultat = $statement->fetchAll();
	foreach($resultat as $row)
	{
		return $row["image"];
	}
}

function get_total_records()
{
	include('db.php');
	$statement = $connection->prepare("SELECT * FROM galerie");
	$statement->execute();
	$resultat = $statement->fetchAll();
	return $statement->rowCount();
}

?>