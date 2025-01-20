<?php
class MessageController {
    private $db;             // Connexion à la base de données
    private $messageModel;   // Instance du modèle Message

    public function __construct($db) {
        $this->db = $db;
        $this->messageModel = new Message($this->db);
    }

    // Méthode pour créer un message
    public function createMessage($content, $user_id, $topic_id) {
        $this->messageModel->content = $content;
        $this->messageModel->user_id = $user_id;
        $this->messageModel->topic_id = $topic_id;

        return $this->messageModel->create();
    }

    // Méthode pour lire un message par ID
    public function readMessageById($message_id) {
        return $this->messageModel->readById($message_id);
    }

    // Méthode pour lire tous les messages d'un topic
    public function readAllMessagesByTopic($topic_id) {
        return $this->messageModel->readAllByTopic($topic_id);
    }

    // Méthode pour mettre à jour un message
    public function updateMessage($message_id, $content) {
        return $this->messageModel->update($message_id, $content);
    }

    // Méthode pour supprimer un message
    public function deleteMessage($message_id) {
        return $this->messageModel->delete($message_id);
    }
}
