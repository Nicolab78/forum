<?php
// Inclure le modèle User
require_once '../models/user.php';

class UserController {
    private $db;             // Connexion à la base de données
    private $userModel;     // Instance du modèle User

    public function __construct($db) {
        $this->db = $db;                         // Initialiser la connexion à la base de données
        $this->userModel = new User($this->db); // Créer une instance du modèle User
    }

    // Méthode pour inscrire un nouvel utilisateur
    public function register($username, $password, $email) {
        // Vérifier si le nom d'utilisateur ou l'email existe déjà
        if ($this->usernameExists($username)) {
            return "Le nom d'utilisateur est déjà pris. Veuillez en choisir un autre.";
        }

        if ($this->emailExists($email)) {
            return "L'email est déjà utilisé. Veuillez en choisir un autre.";
        }

        // Assigner les valeurs aux propriétés de l'utilisateur
        $this->userModel->username = $username;
        $this->userModel->password = $password;
        $this->userModel->email = $email;

        if ($this->userModel->create()) {
            return true; // Succès
        } else {
            return false; // Échec
        }
    }

    // Méthode pour vérifier si le nom d'utilisateur existe
    public function usernameExists($username) {
        return $this->userModel->existsByUsername($username);
    }

    // Méthode pour vérifier si l'email existe
    public function emailExists($email) {
        return $this->userModel->existsByEmail($email);
    }

    // Méthode pour se connecter
    public function login($username, $password) {
        $user = $this->userModel->readByUsername($username);
        if ($user && password_verify($password, $user['password'])) {
            return $user; // Retourne les informations de l'utilisateur si la connexion est réussie
        } else {
            return false; // Échec de la connexion
        }
    }

    // Méthode pour mettre à jour un utilisateur
    public function updateUser($user_id, $username, $password, $email) {
        // Assigner les valeurs aux propriétés de l'utilisateur
        $this->userModel->id = $user_id;
        $this->userModel->username = $username;
        $this->userModel->password = $password;
        $this->userModel->email = $email;

        // Appeler la méthode update du modèle User
        if ($this->userModel->update()) {
            return "Informations mises à jour.";
        } else {
            return "Échec de la mise à jour.";
        }
    }

    // Méthode pour supprimer un utilisateur
    public function deleteUser($user_id) {
        if ($this->userModel->delete($user_id)) {
            return "Utilisateur supprimé.";
        } else {
            return "Échec de la suppression de l'utilisateur.";
        }
    }

    public function readByUsername($username) {
        return $this->userModel->readByUsername($username);
    }
}
