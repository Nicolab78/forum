<?php
class Message {
    private $conn;
    private $table = 'messages';

    public $message_id;
    public $content;
    public $user_id;
    public $topic_id;
    public $created_at;

    public function __construct($db) {
        $this->conn = $db;
    }

    // Créer un message
    public function create() {
        $query = "INSERT INTO " . $this->table . " (content, user_id, topic_id) VALUES (:content, :user_id, :topic_id)";
        $stmt = $this->conn->prepare($query);

        // Filtrer
        $this->content = htmlspecialchars(strip_tags($this->content));

    
        $stmt->bindParam(':content', $this->content);
        $stmt->bindParam(':user_id', $this->user_id);
        $stmt->bindParam(':topic_id', $this->topic_id);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    // Afficher un message par son ID
    public function readById($message_id) {
        $query = "SELECT * FROM " . $this->table . " WHERE message_id = :message_id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':message_id', $message_id, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Afficher tout les messages
    public function readAllByTopic($topic_id) {
        $query = "SELECT * FROM " . $this->table . " WHERE topic_id = :topic_id ORDER BY created_at ASC";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':topic_id', $topic_id, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Mettre à jour
    public function update($message_id, $content) {
        $query = "UPDATE " . $this->table . " SET content = :content WHERE message_id = :message_id";
        $stmt = $this->conn->prepare($query);
    
        // Filtrer
        $content = htmlspecialchars(strip_tags($content));
    
        // Liaison des paramètres
        $stmt->bindParam(':content', $content);
        $stmt->bindParam(':message_id', $message_id, PDO::PARAM_INT);
    
        if ($stmt->execute()) {
            return true;
        }
    
        return false;
    }

    // Supprimer un message
    public function delete($message_id) {
        $query = "DELETE FROM " . $this->table . " WHERE message_id = :message_id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':message_id', $message_id, PDO::PARAM_INT);
    
        if ($stmt->execute()) {
            return true;
        }
    
        return false;
    }
}
