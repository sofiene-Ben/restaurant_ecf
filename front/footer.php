<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

?>


<div class="footer-center">
            <div class="footer-title">
                <h2>nos horaire d'ouverture</h2>
            </div>
            <div class="horaire">
                <?php 
                    //connexion a la bdd
                    $conn = mysqli_connect("localhost", "root", "", "restaurant_db");
                    if (!$conn) {
                        die("erreur de connexion a la bdd :" . mysqli_connect_error());
                    }

                    // requete pour recup les horaires et jours 
                    $result = mysqli_query($conn, 'SELECT * FROM jours_open');
                    if(!$result) {
                        die('erreur lors de l\'execution de la requete :' . mysqli_error($conn));
                    }

                    // verif s'il y a des enregistrements 
                    if(mysqli_num_rows($result) > 0) {

                        // recup des jours et horaires
                        while($row = mysqli_fetch_assoc($result)) {
                            $jour = htmlspecialchars($row['jour']);
                            $horaire = htmlspecialchars($row['horaire_opne_days']);
                ?>

                <div class="horaire-group">
                    <div class="horaire-day"> <?php echo $jour ?> </div>
                    <div class="horaire-heure"> <?php echo $horaire ?> </div>    
                </div>
                <?php
                    }
                            } else {
                                echo 'no records found !';
                            }
                            //fermeture de la co a la bdd
                            mysqli_close($conn);  
                ?> 
                <!-- <div class="horaire-group">
                    <div class="horaire-day">Lundi</div>
                    <div class="horaire-heure">12:00 - 14:00 | 19:00 - 20:00</div>    
                </div>
            
                <div class="horaire-group">
                    <div class="horaire-day">Lundi</div>
                    <div class="horaire-heure">12:00 - 14:00 | 19:00 - 20:00</div>    
                </div>
            
                <div class="horaire-group">
                    <div class="horaire-day">Lundi</div>
                    <div class="horaire-heure">12:00 - 14:00 | 19:00 - 20:00</div>    
                </div>
             -->
            </div>
        </div>
        <div class="line"></div>
        <div class="footer-center">
            <div class="metion-legal">
                <p>@2023 - All Right Reserved.</p>
                <p>Designed and Developed by Sofiene Benamar</p>
            </div>
        </div>