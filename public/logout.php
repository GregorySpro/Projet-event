<?php
session_start();

// Détruire la session
session_unset();
session_destroy();

// Redirection vers la page de connexion
header('Location: index.php');
exit;
?>
