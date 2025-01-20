<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/navbar.css">
    <link rel="stylesheet" href="../css/create_topic.css">
    <title>Créer un Topic</title>
</head>
<body>

<?php include 'navbar.php'; ?>

    <h2>Créer un Nouveau Topic</h2>
    <form action="../controller/create_topic_process.php" method="POST">
        <label for="title">Titre :</label>
        <input type="text" id="title" name="title" required><br>

        <label for="content">Contenu :</label>
        <textarea id="content" name="content" required></textarea><br>

        <button type="submit">Créer le Topic</button>
    </form>
    <div class="link-wrapper">
    <p><a href="topics.php">Voir tous les Topics</a></p>
    </div>
</body>
</html>
