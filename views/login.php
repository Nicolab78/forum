<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/login.css">

    <title>Connexion</title>
</head>
<body>
    <div class="login-container">
    <h2>Connexion</h2>
    <form action="../controller/login_process.php" method="POST">
        <label for="username">Nom d'utilisateur :</label>
        <input type="text" id="username" name="username" required><br>

        <label for="password">Mot de passe :</label>
        <input type="password" id="password" name="password" required><br>

        <button type="submit">Se connecter</button>
    </form>
    <p>Vous n'avez pas de compte ? <a href="register.php">S'inscrire</a></p>
    </div>
</body>
</html>