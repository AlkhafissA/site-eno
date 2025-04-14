<?php

session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit;
}
require 'config.php';


if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $stmt = $pdo->prepare("SELECT * FROM matiere WHERE id = ?");
    $stmt->execute([$id]);
    $matiere = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$matiere) {
        header("Location: matieres.php?message=Matière introuvable.");
        exit;
    }
}


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $libelle = $_POST['libelle'];

    $stmt = $pdo->prepare("UPDATE matiere SET libelle = ? WHERE id = ?");
    if ($stmt->execute([$libelle, $id])) {
        header("Location: matieres.php?message=Matière modifiée avec succès.");
        exit;
    } else {
        $message = "Erreur lors de la modification de la matière.";
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Modifier Matière</title>
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
            align-items: center;
            justify-content: center;
            min-height: 100vh;
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
    </style>
</head>
<body>
    <div class="form-container">
        <h1>Modifier une matière</h1>
        <?php if (isset($message)) { echo "<p>$message</p>"; } ?>
        <form action="modifiermatiere.php" method="post">
            <input type="hidden" name="id" value="<?php echo htmlspecialchars($matiere['id']); ?>">
            <div class="form-group">
                <label for="libelle">Libellé de la matière :</label>
                <input type="text" name="libelle" value="<?php echo htmlspecialchars($matiere['libelle']); ?>" required>
            </div>
            <button type="submit">Modifier</button>
        </form>
    </div>
</body>
</html>