<?php
// Inclure les fichiers nécessaires
require_once '../config/database.php';
require_once '../controller/TopicController.php';

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

// Créer une instance du contrôleur Topic
$topicController = new TopicController($db);

// Vérifier si un ID de topic est fourni dans l'URL
if (isset($_GET['topic_id'])) {
    $topic_id = $_GET['topic_id'];

    // Supprimer le topic
    if ($topicController->deleteTopic($topic_id)) {
        // Rediriger l'utilisateur vers la page des topics après suppression
        header("Location: ../views/topics.php"); 
        exit();
    } else {
        echo "Erreur lors de la suppression du topic.";
    }
} else {
    echo "Aucun topic spécifié.";
}
