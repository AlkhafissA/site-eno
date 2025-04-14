<?php

session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit;
}
require 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];

    
    $stmt = $pdo->prepare("DELETE FROM matiere WHERE id = ?");
    if ($stmt->execute([$id])) {
        header("Location: matieres.php?message=Matière supprimée avec succès.");
        exit;
    } else {
        header("Location: matieres.php?message=Erreur lors de la suppression de la matière.");
        exit;
    }
}
?>