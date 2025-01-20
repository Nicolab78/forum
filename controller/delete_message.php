<?php
require_once '../config/database.php';
require_once '../models/Message.php';
require_once '../controller/MessageController.php';

$database = new Database();
$db = $database->getConnection();
$messageController = new MessageController($db);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $message_id = $_POST['message_id'];

    if ($messageController->deleteMessage($message_id)) {
        header('Location: ../views/topic.php?topic_id=' . $_POST['topic_id']);
        exit();
    } else {
        echo "Erreur lors de la suppression du message.";
    }
}
?>
