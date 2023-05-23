<?php
include('db.php');
include('fonction.php');
if(isset($_POST["operation"]))
{
	if($_POST["operation"] == "Add")
	{
		
		$statement = $connection->prepare("
			INSERT INTO `menu_formule` (name, content, price) 
			VALUES (:name, :content, :price)
		");
		
		$resultat = $statement->execute(
			array(
				':name'	=>	$_POST["name"],
				':content'	=>	$_POST["content"],
				':price'	=>	$_POST["price"]
			)
		);
		if(!empty($resultat))
		{
			echo 'formule entré avec succès !';
		}
	}
	if($_POST["operation"] == "Edit")
	{
		
		$statement = $connection->prepare(
			"UPDATE menu_formule 
			SET `name` = :name, `content` = :content , `price` = :price
			WHERE id = :id
			"
		);
		$resultat = $statement->execute(
			array(
				':name'	=>	$_POST["name"],
				':content'	=>	$_POST["content"],
				':price'	=>	$_POST["price"],
				':id'=>	$_POST["id"]
			)
		);
		if(!empty($resultat))
		{
			echo 'formule modifiée avec succès !';
		}
	}
}

?>