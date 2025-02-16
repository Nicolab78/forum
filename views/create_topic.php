<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Créez un nouveau sujet de discussion sur notre forum et échangez avec la communauté.">
    <meta name="keywords" content="forum, discussion, créer un topic, sujet, communauté, vélo">
    <meta name="robots" content="index, follow">
    <meta property="og:title" content="Créer un Topic - Forum Vélo">
    <meta property="og:description" content="Participez aux discussions en créant un nouveau sujet sur notre forum dédié aux passionnés de vélo.">
    <meta property="og:type" content="website">
    <meta property="og:url" content="https://ton-site.com/create_topic.php">
    <meta property="og:image" content="https://ton-site.com/assets/forum-image.jpg">

    <link rel="stylesheet" href="../css/navbar.css">
    <link rel="stylesheet" href="../css/create_topic.css">
    <title>Créer un Topic - Forum Vélo</title>
</head>

<body>

<?php include 'navbar.php'; ?>

    <h2>Créer un Nouveau Topic</h2>
    <form action="../controller/create_topic_process.php" method="POST">
        <label for="title">Titre :</label>
        <input type="text" id="title" name="title" required aria-label="Titre du topic" placeholder="Entrez le titre de votre sujet"><br>

        <label for="content">Contenu :</label>
        <textarea id="content" name="content" required aria-label="Contenu du topic" placeholder="Décrivez votre sujet ici..."></textarea><br>

        <button type="submit">Créer le Topic</button>
    </form>
    <div class="link-wrapper">
    <p><a href="topics.php">Voir tous les Topics</a></p>
    </div>
</body>
</html>
