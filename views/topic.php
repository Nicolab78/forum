<?php
// Inclure la configuration de la base de données
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

// Vérifier si un ID de topic est fourni dans l'URL
if (isset($_GET['topic_id'])) {
    $topic_id = $_GET['topic_id'];

    // Récupérer le topic avec l'ID fourni
    $query = "SELECT topics.*, users.username FROM topics JOIN users ON topics.user_id = users.user_id WHERE topics.topic_id = :topic_id";
    $stmt = $db->prepare($query);
    $stmt->bindParam(':topic_id', $topic_id, PDO::PARAM_INT);
    $stmt->execute();
    $topic = $stmt->fetch(PDO::FETCH_ASSOC);

    // Vérifier si le topic existe
    if ($topic) {
        // Afficher les détails du topic
        ?>
        <!DOCTYPE html>
        <html lang="fr">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <link rel="stylesheet" href="../css/navbar.css">
            <link rel="stylesheet" href="../css/topic.css">
            <title><?= htmlspecialchars($topic['title']) ?></title>
        </head>
        <body>

            <?php include 'navbar.php'; ?>

            <h2><?= htmlspecialchars($topic['title']) ?></h2>
            <p><?= htmlspecialchars($topic['content']) ?></p>
            <p>Créé par : <?= htmlspecialchars($topic['username']) ?> le <?= htmlspecialchars($topic['created_at']) ?></p>
            <a href="topics.php">Retour à la liste des topics</a>

            <!-- Formulaire pour ajouter un message -->
            <h3>Ajouter un message :</h3>
            <form action="../controller/add_message_process.php" method="POST">
                <input type="hidden" name="topic_id" value="<?= $topic_id ?>">
                <label for="content">Message :</label><br>
                <textarea id="content" name="content" rows="4" cols="50" required></textarea><br><br>
                <button type="submit">Poster le message</button>
            </form>

            <!-- Afficher les messages sous le topic-->
            <h3>Messages :</h3>
            <?php
            $query = "SELECT messages.*, users.username FROM messages
                      JOIN users ON messages.user_id = users.user_id
                      WHERE topic_id = :topic_id
                      ORDER BY created_at ASC";
            $stmt = $db->prepare($query);
            $stmt->bindParam(':topic_id', $topic_id, PDO::PARAM_INT);
            $stmt->execute();
            $messages = $stmt->fetchAll(PDO::FETCH_ASSOC);

            foreach ($messages as $message) {
                echo "<div>";
                echo "<p><strong>" . htmlspecialchars($message['username']) . ":</strong> " . htmlspecialchars($message['content']) . "</p>";
                echo "<p><small>Posté le " . $message['created_at'] . "</small></p>";
                
                // Modifier et supprimer
                if ($message['user_id'] == $_SESSION['user_id']) {
                    echo "<a href='../views/edit_message_form.php?message_id=" . $message['message_id'] . "&topic_id=" . $topic_id . "'>Modifier</a> | ";

                    echo "<form action='../controller/delete_message.php' method='POST' style='display:inline;'>";
                    echo "<input type='hidden' name='message_id' value='" . $message['message_id'] . "'>";
                    echo "<input type='hidden' name='topic_id' value='" . $topic_id . "'>";
                    echo "<button type='submit'>Supprimer</button>";
                    echo "</form>";
                }

                echo "</div><hr>";
            }
            ?>
        </body>
        </html>
        <?php
    } else {
        echo "<p>Topic introuvable. <a href='topics.php'>Retour à la liste des topics</a></p>";
    }
} else {
    echo "<p>Aucun topic spécifié. <a href='topics.php'>Retour à la liste des topics</a></p>";
}
?>
