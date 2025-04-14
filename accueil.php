<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Accueil</title>
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
            text-align: center;
            padding: 20px;
        }
        main h1 {
            font-size: 36px;
            color: #fff;
            margin-bottom: 20px;
        }
        main p {
            font-size: 18px;
            color: #fff;
            margin-bottom: 30px;
        }
        .cards {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 20px;
        }
        .card {
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            padding: 20px;
            width: 250px;
            text-align: center;
            transition: transform 0.3s;
        }
        .card:hover {
            transform: translateY(-5px);
        }
        .card i {
            font-size: 40px;
            color: #4facfe;
            margin-bottom: 10px;
        }
        .card h3 {
            font-size: 20px;
            margin-bottom: 10px;
        }
        .card p {
            font-size: 14px;
            color: #666;
        }
        footer {
            background: #4facfe;
            color: #fff;
            text-align: center;
            padding: 10px 0;
            margin-top: auto;
        }
        .cards a {
         text-decoration: none;
         color: inherit; 
         }

         .card {
         background: #fff;
         border-radius: 10px;
         box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
         padding: 20px;
         width: 250px;
         text-align: center;
         transition: transform 0.3s, box-shadow 0.3s;
        }
    </style>
</head>
<body>
    <header>
        <div class="logo">Université ENO</div>
        <nav>
            <ul>
                <li><a href="ajoutetudiant.php"><i class="fas fa-user-plus"></i> Ajouter étudiant</a></li>
                <li><a href="etudiants.php"><i class="fas fa-users"></i> Tous les étudiants</a></li>
                <li><a href="ajoutmatiere.php"><i class="fas fa-book"></i> Ajouter matière</a></li>
                <li><a href="matieres.php"><i class="fas fa-list"></i> Toutes les matières</a></li>
                <li><a href="logout.php"><i class="fas fa-sign-out-alt"></i> Déconnexion</a></li>
            </ul>
        </nav>
    </header>
    <main>
        <h1>Bienvenue à l'Université ENO</h1>
        <p>Gérez facilement les étudiants et les matières grâce à notre application.</p>
        <div class="cards">
            <a href="ajoutetudiant.php" class="card">    
                <i class="fas fa-user-plus"></i>
                <h3>Ajouter un étudiant</h3>
                <p>Ajoutez de nouveaux étudiants à votre base de données.</p>
            </a>    
            <a href="etudiants.php" class="card">    
                <i class="fas fa-users"></i>
                <h3>Voir les étudiants</h3>
                <p>Consultez la liste complète des étudiants inscrits.</p>
            </a>    
            <a href="ajoutmatiere.php" class="card">    
                <i class="fas fa-book"></i>
                <h3>Ajouter une matière</h3>
                <p>Ajoutez de nouvelles matières pour les étudiants.</p>
            </a>
            <a href="matieres.php" class="card">
                <i class="fas fa-list"></i>
                <h3>Voir les matières</h3>
                <p>Consultez la liste des matières disponibles.</p>
            </a>
        </div>
    </main>
    <footer>
        &copy; 2025 Université ENO. Tous droits réservés.
    </footer>
</body>
</html>