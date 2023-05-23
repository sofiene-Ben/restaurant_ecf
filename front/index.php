<?php

require_once "./inc/init.php";
require_once RACINE_SITE . "inc/message.php";
$titlePage = 'acceuil';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link rel="stylesheet" href="../front/css/style_index.css">
    <link rel="stylesheet" href="./css/style_footer.css">
    <link rel="stylesheet" href="./css/style_header.css">

</head>
<body>
    <div class="page-entiere">
        <header>
            <!-- <div class="top-bar-sizing">
                <div class="top-bar">
                    <div class="logo">le quai antique</div>
                    <nav>
                        <svg xmlns="http://www.w3.org/2000/svg" width="26" height="30" viewbox="0 0 26 30" fill="none">
                            <path d="M0 5.625C0 4.58789 0.829911 3.75 1.85714 3.75H24.1429C25.1701 3.75 26 4.58789 26 5.625C26 6.66211 25.1701 7.5 24.1429 7.5H1.85714C0.829911 7.5 0 6.66211 0 5.625ZM0 15C0 13.9629 0.829911 13.125 1.85714 13.125H24.1429C25.1701 13.125 26 13.9629 26 15C26 16.0371 25.1701 16.875 24.1429 16.875H1.85714C0.829911 16.875 0 16.0371 0 15ZM26 24.375C26 25.4121 25.1701 26.25 24.1429 26.25H1.85714C0.829911 26.25 0 25.4121 0 24.375C0 23.3379 0.829911 22.5 1.85714 22.5H24.1429C25.1701 22.5 26 23.3379 26 24.375Z" fill="white"/>
                            </svg>
                    </nav>
                </div>    
            </div> -->
            <div class="top-bar-sizing">
                <?php include_once './header.php' ?>
            </div>
        </header>

        <section class="gal-section">
            <div class="main-section">
                <div class="title-gal">
                    <h2>Gallery</h2>
                </div>
                <div class="box-main">
                    <?php 
                        //connexion a la bdd
                        $conn = mysqli_connect("localhost", "root", "", "restaurant_db");
                        if (!$conn) {
                            die("erreur de connexion a la bdd :" . mysqli_connect_error());
                        }

                        // Recup des image en bdd
                        $result = mysqli_query($conn,"SELECT titre, image from galerie");
                        if(!$result){
                            die("erreur lors de l'execution de la requete :" . mysqli_error($conn));
                        }

                        //verif si il y a des enregistrements
                        if(mysqli_num_rows($result) > 0){

                            //parcours des images
                            while($row = mysqli_fetch_assoc($result)){
                                $image = $row['image'];
                                $title = $row['titre'];
                    ?>
                    <div class="picture-siz">
                    <div class="picture">
                        <img src="../back/gestion_galerie/upload/<?php echo $image; ?>" alt="">
                        <div class="title-picture"><?php echo $title; ?></div>
                    </div>
                    </div>
                    <?php }
                             } else {
                                echo "no records found !";
                            }
                        //fermeture de la co a la bdd
                        mysqli_close($conn);
                    ?>

                </div>
                <div class="reservation">
                    <div class="btn-resa">
                        <button id="open-modal">make reservation !</button>
                    </div>
                </div>
            </div>
        </section>

        <div class="modal-overlay">
            <div class="modal">
                <div class="close">
                <button id="close-modal" class="close-modal">x</button>

                </div>
				<div class="title-modal">
					<h2>reservation</h2>
				</div> 
                <form id="make_resa_form" class="form-resa" method="post" enctype="multipart/form-data">
					<div class="header-resa">
                        <div class="header-resa-items">
                            <select id="liste_couverts" name="liste_couverts" class="form-select form-control">
                                <option selected value="2">2 couverts</option>
                                <option value="1">1 couvert </option>
                                <option value="2">2 couverts </option>
                                <option value="3">3 couverts </option>
                                <option value="4">4 couverts </option>
                            </select>
                        </div>
                        <div class="header-resa-items">
						    <input type="date" name="date_reservation" id="date_reservation" class="form-control">  
                        </div>
					</div>
					<div class="body-resa">
						<div class="title-time">
							<h2>midi</h2>
						</div>
						<div class="radio-resa">
                            <!-- --------------- -->
                            <?php 
                                // Connexion à la base de données
                                $conn = mysqli_connect("localhost", "root", "", "restaurant_db");
                                if (!$conn) {
                                    die("Erreur de connexion à la base de données : " . mysqli_connect_error());
                                }

                                // Récupération des horaires d'ouverture depuis la base de données
                                $result = mysqli_query($conn, "SELECT `id`, `horaire`, `midi` FROM `horaire_ouverture` WHERE midi = '1'");
                                if (!$result) {
                                    die("Erreur lors de l'exécution de la requête : " . mysqli_error($conn));
                                }

                                // Vérification s'il y a des enregistrements
                                if (mysqli_num_rows($result) > 0) {
                                    // Parcours des horaires d'ouverture
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        $id_horaire = $row['id'];
                                        $horaire = $row['horaire'];
                                        ?>
                                        <!-- affichage des donnée grace a la boucle -->
                                        <label for="<?php echo $id_horaire ?>">
                                            <input type="radio" name="choix" id="<?php echo $id_horaire ?>" value="<?php echo $id_horaire ?>" class="form-check-input">
                                            <?php echo $horaire ?>
                                        </label>
                                        <?php
                                    }
                                } else {
                                    echo "Aucun enregistrement trouvé !";
                                }

                                // Fermeture de la connexion à la base de données
                                mysqli_close($conn);
                            ?>

						</div>
						<div class="title-time">
							<h2>soire</h2>
						</div>
						<div class="radio-resa">
                        <?php 
                                // Connexion à la base de données
                                $conn = mysqli_connect("localhost", "root", "", "restaurant_db");
                                if (!$conn) {
                                    die("Erreur de connexion à la base de données : " . mysqli_connect_error());
                                }

                                // Récupération des horaires d'ouverture depuis la base de données
                                $result = mysqli_query($conn, "SELECT `id`, `horaire`, `midi` FROM `horaire_ouverture` WHERE midi = '0'");
                                if (!$result) {
                                    die("Erreur lors de l'exécution de la requête : " . mysqli_error($conn));
                                }

                                // Vérification s'il y a des enregistrements
                                if (mysqli_num_rows($result) > 0) {
                                    // Parcours des horaires d'ouverture
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        $id_horaire = $row['id'];
                                        $horaire = $row['horaire'];
                                        ?>
                                        <!-- affichage des donnée grace a la boucle -->
                                        <label for="<?php echo $id_horaire ?>">
                                            <input type="radio" name="choix" id="<?php echo $id_horaire ?>" value="<?php echo $id_horaire ?>" class="form-check-input">
                                            <?php echo $horaire ?>
                                        </label>
                                        <?php
                                    }
                                } else {
                                    echo "Aucun enregistrement trouvé !";
                                }

                                // Fermeture de la connexion à la base de données
                                mysqli_close($conn);
                            ?>

						</div>
						<div class="alergie">
                            <label for="mention_des_allergie">Veuillez nous indiquez vos allergies ici :</label>
							<textarea name="mention_des_allergie" id="mention_des_allergie" cols="30" rows="10"></textarea>
						</div>
					</div>
                    <?php if(isConnected()){ ?>
                        <input type="hidden" name="id_membre" id="id_membre" value="<?php isConnected() ? $_SESSION['id'] : '' ?>" />
                    <?php } ?>
                    <input 
                    type="hidden" 
                    name="type_reservation" 
                    id="type_reservation" 
                    value="<?= isConnected() ? $_SESSION['role'] : 'visitor' ?>"
                    />
                    <div class="btn-save-div">
                        <button type="submit" id="reservation" name="reservation" class="btn-save">Save </button>
                    </div>
                </form>
            </div>
        </div>
        
        <footer>
            <?php include_once './footer.php'; ?>
        </footer>
    </div>

    <script type="text/javascript" language="javascript">

        $(document).ready(function() {

            $(document).on('submit', '#make_resa_form', function(event){
                event.preventDefault();
                var dater = $('#date_reservation').val();
                var listec = $('#liste_couverts').val();
                var heure_prévue = $('input[name=choix]:checked').attr('id');
            
                if(dater != '' && listec != '' && heure_prévue != '' )
                {
                    $.ajax({
                    url:"reservation.php",
                    method:'POST',
                    data:new FormData(this),
                    contentType:false,
                    processData:false,
                    success:function(data)
                    {
                        alert(data);
                        $('#make_resa_form')[0].reset();
                        // $('#reservation_Modal').modal('hide');
                        window.location.href = './index.php';
                    }
                    });
                }
                else
                {
                alert("Obligatoire de remplir tout le formulaire");
                }
            });
            
            // modal resa
            $('#open-modal').click(function() {
                $('.modal-overlay').fadeIn();
            });
            
            $('#close-modal').click(function() {
                $('.modal-overlay').fadeOut();
            });

            // date actuelle au format YYYY-MM-DD
            var currentDate = new Date().toISOString().split("T")[0];

            // Sélection de input type date
            var dateInput = $("#date_reservation");

            // Définissez l'attribut min sur la date actuelle
            dateInput.attr("min", currentDate);


            // ouverture menu hamburger
            $(document).on('click', '.hamburger', function() {
                $('#nav').addClass('active');
            });

            // fermeture du menu hamburger
            $(document).on('click', '.close-btn', function() {
                $('#nav').removeClass('active');
            });

            $("#openModalBtn").click(function() {
                $("#modal-admin").css("display", "block");
            });

            $(".close-modal-admin").click(function() {
                $("#modal-admin").css("display", "none");
            });

            $(window).click(function(event) {
                if (event.target.id === "modal-admin") {
                $("#modal-admin").css("display", "none");
                }
            });
        });


    </script>
</body>
</html>
