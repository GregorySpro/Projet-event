<?php
session_start();
?>


<header>
        <div class="container">
            <a href="index.html" id="logo-home">
                <img src="images/logo.png" alt="Logo de la plateforme" />
            </a>
            <div id="menu-toggle">☰</div> <!--Bouton hamburger pour téléphone-->
            <nav>
                <ul>
                    <li><a href="index.php">Accueil</a></li>
                    <li><a href="events.html">Événements</a></li>
                    
                    <?php if (isset($_SESSION['user_id'])): ?>
                    <li><a href="create.html">Créer un Événement</a></li>
                    <li><a href="profile.html">Mon Profil</a></li>
                    <li><a href="logout.php">Déconnexion</a></li>

                    <?php else: ?>
                    <li><a href="login.html">Connexion</a></li>
                    <?php endif; ?>

                </ul>
            </nav>
        </div>
</header>