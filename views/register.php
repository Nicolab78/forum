<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Inscrivez-vous pour rejoindre la communauté du forum et participer aux discussions.">
    <meta name="keywords" content="inscription, forum, créer un compte, communauté">
    <meta name="robots" content="index, follow">
    <meta property="og:title" content="Inscription - Forum de discussion">
    <meta property="og:description" content="Rejoignez notre forum en créant un compte pour partager vos idées et échanger avec la communauté.">
    <meta property="og:type" content="website">
    <meta property="og:url" content="https://ton-site.com/register">
    <meta property="og:image" content="https://ton-site.com/assets/register-banner.jpg">

    <link rel="stylesheet" href="../css/register.css">
    <title>Inscription - Forum</title>
</head>
<body>
    <div class="register-container">
    <h2>Inscription</h2>
    <form action="../controller/register_process.php" method="POST">
        <label for="username">Nom d'utilisateur :</label>
        <input type="text" id="username" name="username" required><br>

        <label for="email">Email :</label>
        <input type="email" id="email" name="email" required><br>

        <label for="password">Mot de passe :</label>
        <input type="password" id="password" name="password" required><br>

        <button type="submit">S'inscrire</button>
    </form>
    <p>Vous avez déjà un compte ? <a href="login.php">Se connecter</a></p>
    </div>
</body>
</html>
