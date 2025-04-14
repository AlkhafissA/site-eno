<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit;
}
require 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $libelle = $_POST['libelle'];
    
    $stmt = $pdo->prepare("INSERT INTO matiere (libelle) VALUES (?)");
    
    if ($stmt->execute([$libelle])) {
        $message = "Matière ajoutée avec succès.";
    } else {
        $message = "Erreur lors de l'ajout de la matière.";
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Ajouter Matière</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background: linear-gradient(to right, #4facfe, #00f2fe);
            color: #333;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }
        header {
            width: 100%;
            background: #4facfe;
            color: #fff;
            padding: 15px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        header .logo {
            font-size: 24px;
            font-weight: bold;
        }
        header nav ul {
            list-style: none;
            display: flex;
            gap: 15px;
            margin: 0;
            padding: 0;
        }
        header nav ul li {
            margin: 0;
        }
        header nav ul li a {
            text-decoration: none;
            color: #fff;
            background: #00c6ff;
            padding: 10px 15px;
            border-radius: 5px;
            font-size: 14px;
            font-weight: bold;
            transition: background 0.3s;
        }
        header nav ul li a:hover {
            background: #007acc;
        }
        main {
            flex: 1;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }
        .form-container {
            background: #fff;
            padding: 20px 30px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            text-align: center;
            width: 100%;
            max-width: 400px;
        }
        h1 {
            margin-bottom: 20px;
            color: #333;
        }
        form .form-group {
            margin-bottom: 15px;
            text-align: left;
        }
        form label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }
        form input {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }
        button {
            background-color: #4facfe;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            width: 100%;
            font-size: 16px;
        }
        button:hover {
            background-color: #00c6ff;
            transition: 0.3s;
        }
        footer {
            background: #4facfe;
            color: #fff;
            text-align: center;
            padding: 10px 0;
            margin-top: auto;
        }
    </style>
</head>
<body>
    <header>
        <div class="logo">Université ENO</div>
        <nav>
            <ul>
                <li><a href="accueil.php"><i class="fas fa-home"></i> Accueil</a></li>
                <li><a href="etudiants.php"><i class="fas fa-users"></i> Tous les étudiants</a></li>
                <li><a href="ajoutetudiant.php"><i class="fas fa-user-plus"></i> Ajouter étudiant</a></li>
                <li><a href="matieres.php"><i class="fas fa-list"></i> Toutes les matières</a></li>
                <li><a href="logout.php"><i class="fas fa-sign-out-alt"></i> Déconnexion</a></li>
            </ul>
        </nav>
    </header>
    <main>
        <div class="form-container">
            <h1>Ajouter une matière</h1>
            <?php if (isset($message)) { echo "<p>$message</p>"; } ?>
            <form action="ajoutmatiere.php" method="post">
                <div class="form-group">
                    <label for="libelle">Libellé de la matière :</label>
                    <input type="text" name="libelle" required>
                </div>
                <button type="submit">Ajouter</button>
            </form>
        </div>
    </main>
    <footer>
        &copy; 2025 Université ENO. Tous droits réservés.
    </footer>
</body>
</html>