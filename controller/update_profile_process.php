<?php
// Inclure la configuration de la base de données
require_once '../config/database.php';

// Démarrer la session
session_start();

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['user_id'])) {
    header("Location: ../views/login.php");
    exit();
}

// Créer une instance de la connexion à la base de données
$database = new Database();
$db = $database->getConnection();

// Vérifier que le formulaire a été soumis avec les données nécessaires
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['username'])) {
    $user_id = $_SESSION['user_id'];
    $username = htmlspecialchars(strip_tags($_POST['username']));
    $password = isset($_POST['password']) ? password_hash($_POST['password'], PASSWORD_DEFAULT) : null;

    // Mettre à jour le nom d'utilisateur et le mot de passe si fourni
    $query = "UPDATE users SET username = :username";
    if (!empty($password)) {
        $query .= ", password = :password";
    }
    $query .= " WHERE user_id = :user_id";

    $stmt = $db->prepare($query);
    $stmt->bindParam(':username', $username);
    if (!empty($password)) {
        $stmt->bindParam(':password', $password);
    }
    $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);

    if ($stmt->execute()) {
        // Rediriger vers la page de profil après la mise à jour
        header("Location: ../views/profile.php");
        exit();
    } else {
        echo "Erreur lors de la mise à jour du profil.";
    }
} else {
    echo "Données invalides.";
}
?>
