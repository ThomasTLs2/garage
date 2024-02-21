<?php
include 'config.php';

try {
    $nouvel_etat_garage = $_POST['nouvel_etat_garage'];
    $sql_update_garage = "UPDATE garage SET etat_garage = '$nouvel_etat_garage', ouvert = " . ($nouvel_etat_garage == 'ouvert' ? 1 : 0);
    $conn->exec($sql_update_garage);

    header("Location: dashboard.php");
    exit();
} catch (PDOException $e) {
    echo "Erreur : " . $e->getMessage();
}
?>