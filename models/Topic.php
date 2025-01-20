<?php
class Topic {
    private $conn;
    private $table = 'topics';

    public $id;
    public $title;
    public $content;
    public $user_id;
    public $created_at;

    public function __construct($db) {
        $this->conn = $db;
    }

    // Créer un topic
    public function create() {
        $query = "INSERT INTO " . $this->table . " (title, content, user_id) VALUES (:title, :content, :user_id)";
        $stmt = $this->conn->prepare($query);

        // Filtrer
        $this->title = htmlspecialchars(strip_tags($this->title));
        $this->content = htmlspecialchars(strip_tags($this->content));

        $stmt->bindParam(':title', $this->title);
        $stmt->bindParam(':content', $this->content);
        $stmt->bindParam(':user_id', $this->user_id);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    // Afficher un topic par son ID
    public function readById($id) {
        $query = "SELECT * FROM " . $this->table . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Afficher tous les topics
    public function readAll() {
        $query = "SELECT * FROM " . $this->table . " ORDER BY created_at DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
