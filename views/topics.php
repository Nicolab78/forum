<?php
require_once '../config/database.php';

$database = new Database();
$db = $database->getConnection();

// Montre les topics
$query = "SELECT topics.*, users.username FROM topics JOIN users ON topics.user_id = users.user_id ORDER BY created_at DESC";
$stmt = $db->prepare($query);
$stmt->execute();
$topics = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/navbar.css">
    <link rel="stylesheet" href="../css/create_topic.css">
    <title>Liste des Topics</title>
</head>
<body>

    <?php include 'navbar.php'; ?>

    <h2>Liste des Topics</h2>
    <a href="create_topic.php" class="create-topic">Créer un nouveau Topic</a><br><br>

    <?php foreach ($topics as $topic): ?>
        <div class="topic">
            <h3><a href="topic.php?topic_id=<?= $topic['topic_id'] ?>"><?= htmlspecialchars($topic['title']) ?></a></h3>
            <p>Créé par : <?= htmlspecialchars($topic['username']) ?> le <?= $topic['created_at'] ?></p>
        </div>
    <?php endforeach; ?>

</body>
</html>
