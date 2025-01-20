<?php
session_start(); // Démarrer la session

// Verifier la connection
if (!isset($_SESSION['user_id'])) {
    echo "Accès refusé. Veuillez vous connecter d'abord.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/navbar.css">
    <link rel="stylesheet" href="../css/home.css">
    <title>Accueil</title>
</head>
<body>

<?php include 'navbar.php'; ?>

    <h1>Bienvenue sur la page d'accueil, <?php echo htmlspecialchars($_SESSION['username']); ?>!</h1>
    <p>Ceci est la page principale de votre forum.</p>
    
</body>
</html>