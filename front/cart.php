<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once "./inc/init.php";
require_once RACINE_SITE . "inc/message.php";


?>

<?php $titlePage = 'carte'; ?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>cart</title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
	<link rel="stylesheet" href="./css/style_cart.css">
	<link rel="stylesheet" href="./css/style_header.css">
	<link rel="stylesheet" href="./css/style_footer.css">
</head>
<body>
	<div class="page-entiere">
	<header>
		<?php include_once 'header.php'; ?>
	</header>


	<!-- Menu/Plats SECTION -->

	<section>
		<div class="width-section-1">
		<?php
			//connexion a la bdd
			$conn = mysqli_connect("localhost", "root", "", "restaurant_db");
			if (!$conn) {
				die("erreur de connexion a la bdd :" . mysqli_connect_error());
			}

			//requete pour recup les categories
			$result = mysqli_query($conn,"SELECT id,nom from cat");
			if(!$result){
				die("erreur lors de l'execution de la requete :" . mysqli_error($conn));
			}

			//verif si il y a des enregistrements
			if(mysqli_num_rows($result) > 0){
		?>
		<div class="container-products">
			<?php
				//parcours des categories
				while($row = mysqli_fetch_assoc($result)){ 
				$nom = htmlspecialchars($row['nom']);
			?>
			<div class="food-proposition">
				<div class="title-cat">
					<h2><?php echo $nom; ?></h2>
				</div>
				<?php
					//recup des plats et liés aux categorie
					$result2 = mysqli_query($conn,"SELECT titre, nom, description, prix,id_categorie FROM plat, cat WHERE plat.id_categorie='{$row['id']}' And cat.nom='{$row['nom']}'");
					if(!$result2){
						die("erreur lors de l'execution de la requete :" . mysqli_error($conn));
					}

					//verif si il y a des enregistrements
					if(mysqli_num_rows($result2) > 0){
				?>
				<div class="plats">
					<?php
						//parcours des plats
						while($row2 = mysqli_fetch_assoc($result2)){ 
							$titre = htmlspecialchars($row2['titre']);
							$prix = htmlspecialchars($row2['prix']);
							$description = htmlspecialchars($row2['description']);
					?>
					<div class="plat-content">
						<div class="plat-title-price">
							<h3><?php echo $titre; ?></h3>
							<p>........ <span>$ <?php echo $prix; ?> </span></p>
						</div>
						<div class="plat-description">
							<p><?php echo $description; ?></p>
						</div>
					</div>
					<?php } ?>
				</div>
			</div>
			<?php
						} else {
							echo "no records found !";
						}
					} 
				}else{
					echo "no records found !";
				}

				//fermeture de la co a la bdd
				mysqli_close($conn);
			?>
		</div>
			</div>
	</section>

	<!-- FORMULE MENU -->

	<section>
		<div class="container-menu-formule">
			<?php
				//connexion a la bdd
				$conn = mysqli_connect("localhost", "root", "", "restaurant_db");
				if (!$conn) {
					die("erreur de connexion a la bdd :" . mysqli_connect_error());
				}

				//requete pour recup les formules
				$result = mysqli_query($conn,"SELECT id, name, content, price from menu_formule");
				if(!$result){
					die("erreur lors de l'execution de la requete :" . mysqli_error($conn));
				}

				//verif si il y a des enregistrements
				if(mysqli_num_rows($result) > 0){
					//parcours des categories
					while($row = mysqli_fetch_assoc($result)){ 
					$name = htmlspecialchars($row['name']);
					$content = htmlspecialchars($row['content']);
					$price = htmlspecialchars($row['price']);

			?>
			<div class="menu-formule">
				<div class="menu-formul-content">
					<p>
						<span> <?php echo $name ?> : </span> <?php echo $content . ' ' . ':' . ' ' . $price . '€' ?>
					</p>
				</div>
			</div>
			<?php 
					}
				} else { 
					echo "no records found !"; 
				}
				
				//fermeture de la co a la bdd
				mysqli_close($conn);
			?>
		</div>
	</section>
	
	<footer>
		<?php include_once './footer.php'; ?>
	</footer>

	</div>

	<script type="text/javascript" language="javascript">

		$(document).ready(function() {
		    // ouverture menu hamburger
			$(document).on('click', '.hamburger', function() {
                $('#nav').addClass('active');
            });

            // fermeture du menu hamburger
            $(document).on('click', '.close-btn', function() {
                $('#nav').removeClass('active');
            });
		});
	</script>
</body>
</html>