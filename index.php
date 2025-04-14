<?php
session_start();
if(isset($_SESSION['user_id'])){
    header("Location: accueil.php"); 
    exit;
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Connexion Administrateur</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Page de connexion pour l'administrateur.">
    <style>
        
body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    background: linear-gradient(to right, #4facfe, #00f2fe);
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    color: #333;
}


.login-container {
    background: #fff;
    padding: 20px 30px;
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    text-align: center;
    width: 100%;
    max-width: 400px;
}


.login-container h1 {
    margin-bottom: 20px;
    color: #333;
}


.login-form .form-group {
    margin-bottom: 15px;
    text-align: left;
}

.login-form label {
    display: block;
    margin-bottom: 5px;
    font-weight: bold;
}

.login-form input {
    width: 100%;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
    box-sizing: border-box;
}


.btn {
    background-color: #4facfe;
    color: white;
    padding: 10px 15px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    width: 100%;
    font-size: 16px;
}

.btn:hover {
    background-color: #00c6ff;
    transition: 0.3s;
}
    </style>
</head>
<body>
    <div class="login-container">
        <h1>Bienvenue à l'UNCHK</h1>
        <form action="login.php" method="post" class="login-form">
            <div class="form-group">
                <label for="email">Email :</label>
                <input type="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="mot_de_passe">Mot de passe :</label>
                <input type="password" name="mot_de_passe" required>
            </div>
            <button type="submit" class="btn">Se connecter</button>
        </form>
    </div>
</body>
</html>