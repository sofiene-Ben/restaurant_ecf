<?php
include('db.php');
include('fonction.php');

if(isset($_POST["id"]))
{
	$saida = array();
	
	$statement = $connection->prepare(
		"SELECT * FROM `horaire_ouverture` 
		WHERE id = '".$_POST["id"]."' 
		LIMIT 1"
	);
	
	$statement->execute();
	$resultat = $statement->fetchAll();
	
	foreach($resultat as $linha)
	{
		$saida["horaire"] = $linha["horaire"];
		// $saida["midi"] = $linha["midi"];
		$saida["midi"] = 
			'<label for="midi">plage horaire</label>
			<select name="midi" id="midi">
				<option selected value="1">midi</option>
				<option  value="0">soir</option>
			</select>';

	}
	echo json_encode($saida);
}
?>