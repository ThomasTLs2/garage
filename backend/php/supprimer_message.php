<?php
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['message_id'])) {
    $message_id = $_POST['message_id'];

    try {
        $sql = "DELETE FROM contact_info WHERE id = :message_id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':message_id', $message_id, PDO::PARAM_INT);
        $stmt->execute();

        header("Location: message.php");
        exit();
    } catch (PDOException $e) {
        echo "Erreur lors de la suppression du message : " . $e->getMessage();
    }
}
?>