<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Connectez-vous pour accéder à votre compte et participer aux discussions du forum.">
    <meta name="keywords" content="connexion, login, forum, compte utilisateur">
    <meta name="robots" content="index, follow">
    <meta property="og:title" content="Connexion - Forum de discussion">
    <meta property="og:description" content="Accédez à votre compte sur le forum pour échanger avec la communauté.">
    <meta property="og:type" content="website">
    <meta property="og:url" content="https://ton-site.com/login">
    <meta property="og:image" content="https://ton-site.com/assets/login-banner.jpg">

    <link rel="stylesheet" href="../css/login.css">
    <title>Connexion - Forum</title>
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