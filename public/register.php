<?php
require_once __DIR__ . ('/config/db_connection.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $confirm_password = trim($_POST['confirm_password']);

    // Validation des champs
    if (empty($username) || empty($email) || empty($password) || empty($confirm_password)) {
        echo "Tous les champs sont obligatoires.";
        exit;
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Adresse email invalide.";
        exit;
    }

    if ($password !== $confirm_password) {
        echo "Les mots de passe ne correspondent pas.";
        exit;
    }

    if (strlen($password) < 8) {
        echo "Le mot de passe doit contenir au moins 8 caractères.";
        exit;
    }

    // Hachage du mot de passe
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    try {
        // Vérifie si l'email existe déjà
        $checkEmailStmt = $pdo->prepare('SELECT id FROM users WHERE email = :email');
        $checkEmailStmt->bindParam(':email', $email, PDO::PARAM_STR);
        $checkEmailStmt->execute();

        if ($checkEmailStmt->fetch()) {
            echo "Cet email est déjà utilisé.";
            exit;
        }

        // Insère le nouvel utilisateur dans la base de données
        $stmt = $pdo->prepare('INSERT INTO users (username, email, password, created_at) VALUES (:username, :email, :password, NOW())');
        $stmt->bindParam(':username', $username, PDO::PARAM_STR);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->bindParam(':password', $hashed_password, PDO::PARAM_STR);
        $stmt->execute();

        echo "Inscription réussie. Vous pouvez maintenant vous connecter.";
        header('Location: login.html');
        exit;
    } catch (PDOException $e) {
        die("Erreur lors de l'inscription : " . $e->getMessage());
    }
}
?>
