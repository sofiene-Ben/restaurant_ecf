<?php
include('db.php');
include('fonction.php');
if(isset($_POST["operation"]))
{
	if($_POST["operation"] == "Add")
	{
		
		$statement = $connection->prepare("
			INSERT INTO plat (titre,description,prix,id_categorie) 
			VALUES (:titre,:description,:prix,:id_categorie)
		");
		
		$resultat = $statement->execute(
			array(
				':titre'	=>	$_POST["titre"],
				':description'	=>	$_POST["description"],
				':prix'	=>	$_POST["prix"],
				':id_categorie'	=>	$_POST["id_categorie"],
			)
		);
		if(!empty($resultat))
		{
			echo 'le plat entré avec succès !';
		}
	}
	if($_POST["operation"] == "Edit")
	{
		
		$statement = $connection->prepare(
			"UPDATE plat 
			SET titre = :titre, description = :description, prix = :prix, id_categorie = :id_categorie
			WHERE id = :id
			"
		);
		$resultat = $statement->execute(
			array(
				':titre'	=>	$_POST["titre"],
				':description'	=>	$_POST["description"],
				':prix'	=>	$_POST["prix"],
				':id_categorie'	=>	$_POST["id_categorie"],
				':id'=>	$_POST["id"]
			)
		);
		if(!empty($resultat))
		{
			echo 'le plat a été modifié avec succès !';
		}
	}
}

?>