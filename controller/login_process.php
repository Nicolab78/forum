<!-- login_process.php -->
<?php
// Inclure le contrôleur UserController
require_once '../controller/usercontroller.php';

// Inclure le fichier de configuration pour la base de données
require_once '../config/database.php';

// Créer une instance de la connexion à la base de données
$database = new Database();
$db = $database->getConnection();

// Créer une instance du contrôleur UserController
$userController = new UserController($db);

// Vérifier que le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = htmlspecialchars(strip_tags($_POST['username']));
    $password = htmlspecialchars(strip_tags($_POST['password']));

    // Tenter de se connecter
$user = $userController->readByUsername($username);
if ($user && password_verify($password, $user['password'])) {
    // Démarrer la session et enregistrer les informations de l'utilisateur
    session_start();
    $_SESSION['user_id'] = $user['user_id'];
    $_SESSION['username'] = $user['username'];

    // Rediriger vers la page d'accueil
    header('Location: ../views/home.php');
    exit();
} else {
    echo "<p>Échec de la connexion. Veuillez vérifier vos identifiants.</p>";
}

}
?>
