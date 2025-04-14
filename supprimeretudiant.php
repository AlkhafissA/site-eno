<?php

session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit;
}
require 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $ine = $_POST['ine']; 

    
    $stmt = $pdo->prepare("DELETE FROM etudiant WHERE ine = ?");
    if ($stmt->execute([$ine])) {
        header("Location: etudiants.php?message=Étudiant supprimé avec succès.");
        exit;
    } else {
        header("Location: etudiants.php?message=Erreur lors de la suppression de l'étudiant.");
        exit;
    }
}
?>