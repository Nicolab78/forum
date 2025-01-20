<?php
// Inclure la configuration de la base de données et la classe Topic
require_once '../config/database.php';
require_once '../models/topic.php';

session_start();

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['user_id'])) {
    echo "Accès refusé. Veuillez vous connecter d'abord.";
    exit();
}

// Créer une instance de la connexion à la base de données
$database = new Database();
$db = $database->getConnection();

// Vérifier que la requête est une requête POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Nettoyer les entrées
    $title = htmlspecialchars(strip_tags($_POST['title']));
    $content = htmlspecialchars(strip_tags($_POST['content']));
    $user_id = $_SESSION['user_id'];

    // Créer une instance de Topic
    $topic = new Topic($db);
    $topic->title = $title;
    $topic->content = $content;
    $topic->user_id = $user_id;

    // Créer le topic
    if ($topic->create()) {
        header('Location: ../views/topics.php'); // Redirection après création réussie
        exit();
    } else {
        echo "Erreur lors de la création du topic.";
    }
}
?>
