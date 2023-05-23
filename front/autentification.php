<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once "./inc/init.php";
require_once RACINE_SITE . "inc/message.php";

$titlePage = 'inscription / connexion';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <title>Document</title>
    <link rel="stylesheet" href="./css/style_autentification.css">
    <link rel="stylesheet" href="./css/style_footer.css">
    <link rel="stylesheet" href="./css/style_header.css">
</head>
<body>
    <div class="all">

    
        <header>
            <?php include_once './header.php' ?>
        </header>

        <section>
            <div class="container">
                <div class="box">
                    <div class="title-box">
                        <h2>se connecter</h2>
                    </div>
                    <form id="se_connecter_form" method="post" enctype="multipart/form-data">
                        <div class="input-div">
                            <input 
                                type="email"
                                name="email"
                                class="form-input"
                                id="email"
                                placeholder="Email"
                            >
                        </div>
                        <div class="input-div">
                            <input 
                                type="password"
                                name="mdp"
                                class="form-input"
                                id="password"
                                placeholder="Password"
                            >
                        </div>
                        <div class="btn-div">
                            <input 
                                type="submit"
                                name="Se_connecter"
                                class="btn-input"
                                id="Se_connecter"
                                value="Se connecter"
                            >
                        </div>
                    </form>
                </div>

                <div class="box">
                    <div class="title-box">
                        <h2>s'inscrire</h2>
                    </div>
                    <form id="s_inscrire_form" method="post" enctype="multipart/form-data">
                        <div class="input-div">
                            <input 
                                type="text"
                                name="nom"
                                class="form-input"
                                placeholder="Nom"
                            >
                        </div>
                        <div class="input-div">
                            <input 
                                type="email"
                                name="email_"
                                class="form-input"
                                id="email_"
                                placeholder="Email"
                            >
                        </div>
                        <div class="input-div">
                            <input 
                                type="password"
                                name="mdp_"
                                class="form-input"
                                id="mdp_"
                                placeholder="Password"
                            >
                        </div>
                        <div class="textarea-div">
                            <textarea 
                                row="8"
                                name="message"
                                class="form-input textarea-form"
                                id="message"
                                placeholder="Veuillez nous indiquer vos alergies ici :"
                            ></textarea>
                        </div>
                        <div class="select-div">
                            <select name="" id="" class="select-form">
                                <option selected>Nombre de convive habituel :</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                            </select>
                        </div>
                        <div class="btn-div">
                            <input 
                                type="submit"
                                name="submit"
                                class="btn-input"
                                id="submit"
                                value="S'inscrire"
                            >
                        </div>
                    </form>
                </div>

            </div>
        </section>
        <footer>
          <?php  include_once './footer.php' ?>
        </footer>
    </div>

    <script type="text/javascript" language="javascript">
        $(document).ready(function() {

            $(document).on('submit', '#s_inscrire_form', function(event) {
                event.preventDefault();
                var email = $('#email_').val();
                var mdp = $('#mdp_').val();
                var nom = $('#nom').val();

                if(email != '' && mdp != '' && nom != '') {
                    $.ajax({
                        url:'inscription.php',
                        method:'POST',
                        data:new FormData(this),
                        contentType:false,
                        processData:false,
                        success:function(data){
                            alert(data);
                            window.location.href = './index.php';
                        }
                    });
                } else {
                    alert('Obligation de remplir tout le formulaire');
                }
            });

            $(document).on('submit', '#se_connecter_form', function(event) {
                event.preventDefault();
                var email = $('#email').val();
                var mdp = $('#mdp').val();

                if(email != '' && mdp != '') {
                    $.ajax({
                        url:'connexion.php',
                        method:'POST',
                        data:new FormData(this),
                        contentType:false,
                        processData:false,
                        success:function(data) {
                            alert(data);
                            window.location.href = './index.php';
                        }
                    });
                } else {
                    alert('obligation de remplire tous le formulaire');
                }
            });

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