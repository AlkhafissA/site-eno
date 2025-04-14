<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit;
}
require 'config.php';

$search = isset($_GET['search']) ? $_GET['search'] : '';
$stmt = $pdo->prepare("SELECT * FROM matiere WHERE libelle LIKE ?");
$stmt->execute(["%$search%"]);
$matieres = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Liste des matières</title>
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
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }
        h1 {
            margin-bottom: 20px;
            color: #fff;
        }
        .search-bar {
            margin-bottom: 20px;
            display: flex;
            justify-content: center;
            width: 100%;
            max-width: 500px;
        }
        .search-bar input[type="text"] {
            width: 80%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px 0 0 5px;
            font-size: 14px;
        }
        .search-bar button {
            padding: 10px 15px;
            background: #4facfe;
            color: #fff;
            border: none;
            border-radius: 0 5px 5px 0;
            cursor: pointer;
            font-size: 14px;
        }
        .search-bar button:hover {
            background: #00c6ff;
        }
        table {
            border-collapse: collapse;
            width: 80%;
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
        .btn {
            display: inline-block;
            padding: 10px 20px;
            background: #4facfe;
            color: #fff;
            border: none;
            border-radius: 5px;
            text-decoration: none;
            font-size: 16px;
            cursor: pointer;
            margin-top: 20px;
        }
        .btn:hover {
            background: #00c6ff;
        }
        footer {
            background: #4facfe;
            color: #fff;
            text-align: center;
            padding: 10px 0;
            margin-top: auto;
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
        .btn-edit {
         background: none;
          border: none;
          cursor: pointer;
          color: #4facfe;
          font-size: 18px;
          padding: 5px;
          border-radius: 5px;
          text-decoration: none;
          transition: color 0.3s;
        }

        .btn-edit:hover {
         color: #007acc;
        }
    </style>
</head>
<body>
    <header>
        <div class="logo">Université ENO</div>
        <nav>
            <ul>
                <li><a href="accueil.php"><i class="fas fa-home"></i> Accueil</a></li>
                <li><a href="ajoutetudiant.php"><i class="fas fa-user-plus"></i> Ajouter étudiant</a></li>
                <li><a href="etudiants.php"><i class="fas fa-users"></i> Tous les étudiants</a></li>
                <li><a href="ajoutmatiere.php"><i class="fas fa-book"></i> Ajouter matière</a></li>
                <li><a href="logout.php"><i class="fas fa-sign-out-alt"></i> Déconnexion</a></li>
            </ul>
        </nav>
    </header>
    <main>
        <h1>Liste des matières</h1>
        <form class="search-bar" action="matieres.php" method="get">
            <input type="text" name="search" placeholder="Rechercher une matière..." value="<?php echo htmlspecialchars($search); ?>">
            <button type="submit">Rechercher</button>
        </form>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Libellé</th>
                </tr>
            </thead>
            <tbody>
                <?php if (count($matieres) > 0): ?>
                    <?php foreach ($matieres as $matiere): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($matiere['id']); ?></td>
                            <td><?php echo htmlspecialchars($matiere['libelle']); ?></td>
                            <td>
                                <form action="supprimermatiere.php" method="post" style="display:inline;">
                                    <input type="hidden" name="id" value="<?php echo htmlspecialchars($matiere['id']); ?>">
                                    <button type="submit" class="btn-delete">
                                    <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                                <a href="modifiermatiere.php?id=<?php echo htmlspecialchars($matiere['id']); ?>" class="btn-edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                            </td>   
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                    <td colspan="2">Aucune matière trouvée.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
        <a href="ajoutmatiere.php" class="btn">Ajouter une matière</a>
    </main>
    <footer>
        &copy; 2025 Université ENO. Tous droits réservés.
    </footer>
</body>
</html>