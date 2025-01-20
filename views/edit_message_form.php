<?php
// Inclure la configuration de la base de données
require_once '../config/database.php';

// Démarrer la session
session_start();

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['user_id'])) {
    echo "Accès refusé. Veuillez vous connecter d'abord.";
    exit();
}

// Créer une instance de la connexion à la base de données
$database = new Database();
$db = $database->getConnection();

// Vérifier si un ID de message est fourni
if (isset($_GET['message_id'])) {
    $message_id = $_GET['message_id'];

    // Récupérer le message à éditer
    $query = "SELECT * FROM messages WHERE message_id = :message_id";
    $stmt = $db->prepare($query);
    $stmt->bindParam(':message_id', $message_id, PDO::PARAM_INT);
    $stmt->execute();
    $message = $stmt->fetch(PDO::FETCH_ASSOC);

    // Vérifier si le message existe et si l'utilisateur est bien l'auteur
    if ($message && $message['user_id'] == $_SESSION['user_id']) {
        ?>
        <!DOCTYPE html>
        <html lang="fr">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <link rel="stylesheet" href="../css/navbar.css">
            <title>Modifier le Message</title>
        </head>
        <body>
            <h2>Modifier le Message</h2>
            <form action="../controller/edit_message_process.php" method="POST">
                <input type="hidden" name="message_id" value="<?= $message_id ?>">
                <input type="hidden" name="topic_id" value="<?= $message['topic_id'] ?>"> <!-- Ajout du topic_id -->
                <label for="content">Message :</label><br>
                <textarea id="content" name="content" rows="4" cols="50" required><?= htmlspecialchars($message['content']) ?></textarea><br><br>
                <button type="submit">Enregistrer les modifications</button>
            </form>
            <a href="../views/topic.php?topic_id=<?= $message['topic_id'] ?>">Annuler</a>
        </body>
        </html>
        <?php
    } else {
        echo "Message introuvable ou vous n'êtes pas autorisé à le modifier.";
    }
} else {
    echo "Aucun message spécifié.";
}
?>
