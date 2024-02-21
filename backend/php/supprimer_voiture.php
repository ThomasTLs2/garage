<?php
include 'config.php';


if(isset($_POST['supprimer_voiture']) && isset($_POST['voiture_id'])) {
    $voiture_id = $_POST['voiture_id'];

    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = "DELETE FROM voiture WHERE id = :voiture_id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':voiture_id', $voiture_id, PDO::PARAM_INT);
        $stmt->execute();
        echo json_encode(['success' => true]);
    } catch (PDOException $e) {
        echo json_encode(['error' => $e->getMessage()]);
    }
    $conn = null;
} else {
    echo json_encode(['error' => 'ID de voiture non défini']);
}
?>