<?php
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        foreach ($_POST as $jour => $horaire) {
            $sql_update_horaires = "UPDATE horaires SET horaire_ouverture = :horaire_ouverture WHERE jour_semaine = :jour";
            $stmt_update = $conn->prepare($sql_update_horaires);
            $stmt_update->bindParam(':horaire_ouverture', $horaire);
            $stmt_update->bindParam(':jour', $jour);
            $stmt_update->execute();
        }

        header("Location: dashboard.php");
        exit();
    } catch (PDOException $e) {
        echo "Erreur SQL : " . $e->getMessage();
    }
}

$conn = null;
?>