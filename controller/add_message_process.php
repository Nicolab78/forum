<?php

require_once '../config/database.php';
require_once '../models/Message.php';
require_once '../controller/MessageController.php';

// Démarrer la session 
session_start();

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Vérifier la méthode de requête
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Récupérer les données nécessaires
    $content = htmlspecialchars(strip_tags($_POST['content']));
    $user_id = $_SESSION['user_id'];
    $topic_id = htmlspecialchars(strip_tags($_POST['topic_id']));

    // Créer une instance de la base de données et du contrôleur
    $database = new Database();
    $db = $database->getConnection();
    $messageController = new MessageController($db);

    // Ajouter le message
    if ($messageController->createMessage($content, $user_id, $topic_id)) {
        header('Location: ../views/topic.php?topic_id=' . $topic_id); // Redirection vers le topic après ajout
        exit();
    } else {
        echo "Erreur lors de l'ajout du message.";
    }
}
?>
