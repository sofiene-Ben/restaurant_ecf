
            <div class="container-header">
                <div class="space"></div>
                <div class="title">
                    <h1> <?php echo $titlePage; ?> </h1>
                </div>
                <div class="logo">
                    <div>Le quaie antique</div>
                </div>

                <nav id="nav" class="navigation">
                    <div class="hamburger">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="18" viewbox="0 0 26 30" fill="none">
                            <path d="M0 5.625C0 4.58789 0.829911 3.75 1.85714 3.75H24.1429C25.1701 3.75 26 4.58789 26 5.625C26 6.66211 25.1701 7.5 24.1429 7.5H1.85714C0.829911 7.5 0 6.66211 0 5.625ZM0 15C0 13.9629 0.829911 13.125 1.85714 13.125H24.1429C25.1701 13.125 26 13.9629 26 15C26 16.0371 25.1701 16.875 24.1429 16.875H1.85714C0.829911 16.875 0 16.0371 0 15ZM26 24.375C26 25.4121 25.1701 26.25 24.1429 26.25H1.85714C0.829911 26.25 0 25.4121 0 24.375C0 23.3379 0.829911 22.5 1.85714 22.5H24.1429C25.1701 22.5 26 23.3379 26 24.375Z" fill="white"/>
                        </svg>
                    </div>
                    <div class="close-menu">
                        <button type="button" class="close-btn">&times;</button>
                    </div>
                    <ul class="menu-items">
                        <li class="item">
                            <a class="item-link" href="<?= URL ?>index.php">acceuil</a>
                        </li>
                        <li class="item">
                            <a class="item-link" href="<?= URL ?>cart.php">carte</a>
                        </li>      
                        <?php if(!isConnected()) { ?>              
                        <li class="item">
                            <a class="item-link" href="<?= URL ?>autentification.php">connexion</a>
                        </li>  
                        <?php } ?>   
                        <?php if(isConnected()) { ?>              
                        <li class="item">
                            <a class="item-link" href="<?php echo URL; ?>deconnexion.php">deconnexion <?php echo $_SESSION['nom']; ?> </a>
                        </li>  
                        <?php } ?>   
                        <?php if(isAdmin()) { ?>              
                        <li class="item" id="openModalBtn" >
                            <a class="item-link" id="openModalBtn" href="#">Admin</a>
                        </li>  
                        <?php } ?>   
                        <li class="item">
                            <a class="item-link" href="<?= URL ?>index.php">reserver</a>
                        </li>
                    </ul>
                </nav>
            </div>

            <!-- modal menu admin -->
            <div id="modal-admin" class="modal-admin">
            <div class="modal-admin-content">
                <span class="close-modal-admin">&times;</span>
                <h2>Menu Admin</h2>
                <ul class="admin-menu">
                <li><a href="<?= URL ?>../../../../ecf_test/back/gestion_galerie/index.php">Gestion galerie</a></li>
                <li><a href="<?= URL ?>../../../../ecf_test/back/gestion_categorie/index.php">Gestion catégorie</a></li>
                <li><a href="<?= URL ?>../../../../ecf_test/back/gestion_plats/index.php">Gestion plats</a></li>
                <li><a href="<?= URL ?>../../../../ecf_test/back/gestion_formule/index.php">Gestion formule</a></li>
                <li><a href="<?= URL ?>../../../../ecf_test/back/gestion_horaire_ouverture/index.php">Gestion horaire ouverture</a></li>
                <li><a href="<?= URL ?>../../../../ecf_test/back/gestion_horaire_resa/index.php">Gestion horaire réservation</a></li>
                <li><a href="<?= URL ?>../../../../ecf_test/back/gestion_table/index.php">Gestion table</a></li>
                </ul>
            </div>
            </div>