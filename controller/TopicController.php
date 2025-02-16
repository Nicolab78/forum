<?php
require_once '../models/Topic.php';

class TopicController {
    private $db;
    private $topicModel;

    public function __construct($db) {
        $this->db = $db;
        $this->topicModel = new Topic($this->db);
    }

    // Créer un nouveau topic
    public function createTopic($title, $content, $user_id) {
        $this->topicModel->title = $title;
        $this->topicModel->content = $content;
        $this->topicModel->user_id = $user_id;

        return $this->topicModel->create();
    }

    // Lire un topic par ID
    public function readById($id) {
        return $this->topicModel->readById($id);
    }

    // Lire tous les topics
    public function readAll() {
        return $this->topicModel->readAll();
    }

    // Supprimer un topic par ID
    public function deleteTopic($id) {
        return $this->topicModel->delete($id);
    }
}
