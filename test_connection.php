<?php
// Inclure la configuration de la base de données
require_once 'config/Database.php';

// Créer une instance de la classe Database
$database = new Database();
$db = $database->getConnection();

// Vérifier la connexion
if ($db) {
    echo "Connexion réussie à la base de données.";
} else {
    echo "Échec de la connexion.";
}
?>
