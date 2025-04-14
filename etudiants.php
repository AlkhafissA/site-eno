<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit;
}
require 'config.php';

$search = isset($_GET['search']) ? $_GET['search'] : '';
$stmt = $pdo->prepare("SELECT * FROM etudiant WHERE prenom LIKE ? OR nom LIKE ? OR email LIKE ?");
$stmt->execute(["%$search%", "%$search%", "%$search%"]);
$etudiants = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Liste des Étudiants</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
            min-height: 100vh;
        }
        header {
            width: 100%;
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 10px 20px;
            background: linear-gradient(to right, #4facfe, #00c6ff);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            color: #fff;
        }
        header .buttons {
            display: flex;
            gap: 10px;
            justify-content: center;
            margin-bottom: 10px;
        }
        header .buttons a {
            text-decoration: none;
            color: #fff;
            background: #4facfe;
            padding: 10px 15px;
            border-radius: 5px;
            font-size: 14px;
            font-weight: bold;
            transition: background 0.3s;
        }
        header .buttons a:hover {
            background: #00c6ff;
        }
        header form {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 100%;
            max-width: 500px;
        }
        header form input[type="text"] {
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 14px;
            flex: 1;
        }
        header form button {
            padding: 8px 12px;
            margin-left: 5px;
            background: #4facfe;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 14px;
        }
        header form button:hover {
            background: #00c6ff;
        }
        h1 {
            margin: 20px 0;
            color: #fff;
        }
        table {
            border-collapse: collapse;
            width: 90%;
            margin: 20px 0;
            background: #fff;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }
        table th, table td {
            padding: 15px;
            text-align: left;
        }
        table th {
            background: #4facfe;
            color: #fff;
        }
        table tr:nth-child(even) {
            background: #f2f2f2;
        }
        table tr:hover {
            background: #e0f7fa;
        }
       
        .btn-delete {
           background: none;
           border: none;
           cursor: pointer;
           color: #ff4d4d;
           font-size: 18px;
           padding: 5px;
           border-radius: 5px;
           transition: color 0.3s;
        }

       .btn-delete:hover {
       color: #ff1a1a;
        }
    </style>
</head>
<body>
    <header>
        <div class="buttons">
            <a href="accueil.php"><i class="fas fa-home">Accueil</i></a>
            <a href="ajoutetudiant.php"><i class="fas fa-user-plus"></i>Ajouter Étudiant </a>
        </div>
        <form action="etudiants.php" method="get">
            <input type="text" name="search" placeholder="Rechercher un étudiant..." value="<?php echo htmlspecialchars($search); ?>">
            <button type="submit">Rechercher</button>
        </form>
    </header>
    <h1>Liste des étudiants</h1>
    <?php if (isset($_GET['message'])): ?>
        <p style="color: green;"><?php echo htmlspecialchars($_GET['message']); ?></p>
    <?php endif; ?>
    <table>
        <thead>
            <tr>
                <th>INE</th>
                <th>Prénom</th>
                <th>Nom</th>
                <th>Email</th>
                <th>Téléphone</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php if (count($etudiants) > 0): ?>
                <?php foreach ($etudiants as $etudiant): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($etudiant['ine']); ?></td>
                        <td><?php echo htmlspecialchars($etudiant['prenom']); ?></td>
                        <td><?php echo htmlspecialchars($etudiant['nom']); ?></td>
                        <td><?php echo htmlspecialchars($etudiant['email']); ?></td>
                        <td><?php echo htmlspecialchars($etudiant['telephone']); ?></td>
                        <td>
                            <form action="supprimeretudiant.php" method="post" style="display:inline;">
                                <input type="hidden" name="ine" value="<?php echo htmlspecialchars($etudiant['ine']); ?>">
                                <button type="submit" class="btn-delete">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                            <a href="modifieretudiant.php?ine=<?php echo htmlspecialchars($etudiant['ine']); ?>" class="btn-edit">
                                <i class="fas fa-edit"></i>
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="6">Aucun étudiant trouvé.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</body>
</html>