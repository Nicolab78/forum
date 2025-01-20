<!-- register_process.php -->
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
    // Nettoyer les entrées utilisateurs
    $username = htmlspecialchars(strip_tags($_POST['username']));
    $email = htmlspecialchars(strip_tags($_POST['email']));
    $password = htmlspecialchars(strip_tags($_POST['password']));
    
    // Validation du formulaire
    $errors = [];

    // Vérification de la validité de l'email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Adresse email invalide.";
    }

    // Vérification de la longueur du mot de passe
    if (strlen($password) < 8) {
        $errors[] = "Le mot de passe doit contenir au moins 8 caractères.";
    }

    // Vérifier si l'utilisateur ou l'email existe déjà
    if ($userController->usernameExists($username)) {
        $errors[] = "Le nom d'utilisateur est déjà pris. Veuillez en choisir un autre.";
    }

    if ($userController->emailExists($email)) {
        $errors[] = "L'email est déjà utilisé. Veuillez en choisir un autre.";
    }

    // Si tout est bon, on tente l'inscription
    if (empty($errors)) {
        $result = $userController->register($username, $password, $email);
        
        // Affichage du résultat de l'inscription
        if ($result === true) {
            // Rediriger vers la page de connexion si l'inscription a réussi
            header('Location: ../views/login.php');
            exit();
        } else {
            echo "Échec de l'inscription.";
        }
    } else {
        // Afficher les erreurs
        foreach ($errors as $error) {
            echo "<p>" . $error . "</p>";
        }
    }
}
?>


