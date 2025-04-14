<?php
session_start();
require 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $mot_de_passe = $_POST['mot_de_passe'];
    
    
    $stmt = $pdo->prepare("SELECT * FROM utilisateur WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    
    if (!$user) {
        die("Utilisateur non trouvé avec cet email.");
    }

    
    if (!password_verify($mot_de_passe, $user['mot_de_passe'])) {
        die("Mot de passe incorrect. Mot de passe attendu : " . $user['mot_de_passe']);
    }

    
    $_SESSION['user_id'] = $user['id'];
    header("Location: accueil.php");
    exit;
} else {
    header("Location: index.php");
    exit;
}
?>