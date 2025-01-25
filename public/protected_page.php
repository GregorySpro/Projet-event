<?php
session_start();

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['user_id'])) {
    // Si non connecté, redirection vers la page de connexion
    header('Location: login.html');
    exit;
}

// Récupérer les informations de l'utilisateur connecté
$username = $_SESSION['username'];

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page protégée</title>
</head>
<body>
    <header>
        <h1>Bienvenue sur la page protégée, <?= htmlspecialchars($username); ?> !</h1>
    </header>
    <main>
        <p>Cette page est accessible uniquement aux utilisateurs connectés.</p>
        <p>Voici une vue personnalisée pour votre expérience :</p>
        <ul>
            <li><a href="create.html">Créer un événement</a></li>
            <li><a href="events.html">Voir les événements disponibles</a></li>
            <li><a href="profile.html">Gérer mon profil</a></li>
        </ul>
        <p><a href="logout.php">Se déconnecter</a></p>
    </main>
</body>
</html>
