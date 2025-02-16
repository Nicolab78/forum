<?php

require_once '../config/database.php';

// Démarrer la session
session_start();

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Créer une instance de la connexion à la base de données
$database = new Database();
$db = $database->getConnection();

// Récupéreration des données de l'utilisateur
$user_id = $_SESSION['user_id'];
$query = "SELECT * FROM users WHERE user_id = :user_id";
$stmt = $db->prepare($query);
$stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
$stmt->execute();
$user = $stmt->fetch(PDO::FETCH_ASSOC);

// Vérifier si l'utilisateur existe
if (!$user) {
    echo "Utilisateur introuvable.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/profile.css">
    <link rel="stylesheet" href="../css/navbar.css">
    <title>Profil de <?= htmlspecialchars($user['username']) ?></title>
</head>
<body>

    <?php include 'navbar.php'; ?>

    <h2>Profil de <?= htmlspecialchars($user['username']) ?></h2>
    
    <!-- Modification du profil -->
    <h3>Modifier le profil :</h3>
    <form action="../controller/update_profile_process.php" method="POST">
        <label for="username">Nom d'utilisateur :</label><br>
        <input type="text" id="username" name="username" value="<?= htmlspecialchars($user['username']) ?>" required><br><br>

        <label for="password">Nouveau mot de passe :</label><br>
        <input type="password" id="password" name="password"><br><br>

        <button type="submit">Mettre à jour le profil</button>
    </form>

    <!-- Afficher les topics de l'utilisateur-->
    <h3>Vos Topics :</h3>
    <?php
    $query = "SELECT * FROM topics WHERE user_id = :user_id ORDER BY created_at DESC";
    $stmt = $db->prepare($query);
    $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
    $stmt->execute();
    $topics = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if ($topics) {
        foreach ($topics as $topic) {
            echo "<div>";
            echo "<a href='topic.php?topic_id=" . $topic['topic_id'] . "'>" . htmlspecialchars($topic['title']) . "</a>";
            echo "<p>Créé le : " . $topic['created_at'] . "</p>";
            // Lien pour supprimer un topic
            echo "<a href='../controller/delete_topic.php?topic_id=" . $topic['topic_id'] . "' onclick='return confirm(\"Êtes-vous sûr de vouloir supprimer ce topic ?\")'>Supprimer</a>";

            echo "</div><hr>";
        }
    } else {
        echo "<p>Vous n'avez créé aucun topic.</p>";
    }
    ?>

    <!-- Afficher les messages envoyés par l'utilisateur -->
    <h3>Vos Messages :</h3>
    <?php
    $query = "SELECT messages.*, topics.title AS topic_title FROM messages
              JOIN topics ON messages.topic_id = topics.topic_id
              WHERE messages.user_id = :user_id
              ORDER BY messages.created_at DESC";
    $stmt = $db->prepare($query);
    $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
    $stmt->execute();
    $messages = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if ($messages) {
        foreach ($messages as $message) {
            echo "<div>";
            echo "<p><strong>Topic :</strong> <a href='topic.php?topic_id=" . $message['topic_id'] . "'>" . htmlspecialchars($message['topic_title']) . "</a></p>";
            echo "<p><strong>Message :</strong> " . htmlspecialchars($message['content']) . "</p>";
            echo "<p><small>Posté le : " . $message['created_at'] . "</small></p>";
            echo "</div><hr>";
        }
    } else {
        echo "<p>Vous n'avez envoyé aucun message.</p>";
    }
    ?>
</body>
</html>
