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
    <meta name="description" content="Bienvenue sur notre forum dédié aux passionnés de vélo. Partagez vos expériences et échangez avec la communauté.">
    <meta name="keywords" content="forum, discussion, vélo, VTT, cyclisme, communauté">
    <meta name="robots" content="index, follow">
    <meta property="og:title" content="Accueil - Forum Vélo">
    <meta property="og:description" content="Découvrez notre forum et échangez sur votre passion pour le vélo avec d'autres passionnés.">
    <meta property="og:type" content="website">
    <meta property="og:url" content="https://ton-site.com/">
    <meta property="og:image" content="https://ton-site.com/assets/forum-banner.jpg">

    <link rel="stylesheet" href="../css/navbar.css">
    <link rel="stylesheet" href="../css/home.css">
    <title>Accueil - Forum Vélo</title>
</head>
<body>

<?php include 'navbar.php'; ?>

<h1>Bienvenue sur la page d'accueil!</h1>
<p>Ceci est la page principale de votre forum.</p>

</body>
</html>