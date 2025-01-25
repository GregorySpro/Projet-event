<?php
require_once __DIR__ . ('/config/db_connection.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    // Vérification des champs
    if (empty($email) || empty($password)) {
        echo "Veuillez remplir tous les champs.";
        exit;
    }

    try {
        // Récupérer l'utilisateur avec l'email fourni
        $stmt = $pdo->prepare('SELECT id, username, password FROM users WHERE email = :email');
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->execute();

        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password'])) {
            // Mot de passe valide, démarrage de la session
            session_start();
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];

            echo "Connexion réussie !";
            header('Location: index.php'); // Redirection vers la page d'accueil
            exit;
        } else {
            echo "Email ou mot de passe incorrect.";
        }
    } catch (PDOException $e) {
        die("Erreur lors de la connexion : " . $e->getMessage());
    }
}
?>
