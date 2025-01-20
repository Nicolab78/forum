<?php
// Inclure la configuration de la base de données et le contrôleur MessageController
require_once '../config/database.php';
require_once '../models/Message.php';
require_once '../controller/MessageController.php';

// Démarrer la session pour vérifier si l'utilisateur est connecté
session_start();

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Vérifier la méthode de requête
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Récupérer les données nécessaires
    $message_id = htmlspecialchars(strip_tags($_POST['message_id']));
    $content = htmlspecialchars(strip_tags($_POST['content']));
    $topic_id = htmlspecialchars(strip_tags($_POST['topic_id']));

    // Créer une instance de la base de données et du contrôleur
    $database = new Database();
    $db = $database->getConnection();
    $messageController = new MessageController($db);

    // Mettre à jour le message
    if ($messageController->updateMessage($message_id, $content)) {
        header('Location: ../views/topic.php?topic_id=' . $topic_id); // Redirection vers le topic après modification
        exit();
    } else {
        echo "Erreur lors de la mise à jour du message.";
    }
}
?>
