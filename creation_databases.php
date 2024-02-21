<?php
include 'config.php';
$servername = "localhost";
$username = "root";
$password = "";

try {
    $conn = new PDO("mysql:host=$servername", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Requête pour créer la base de données
    $sql = "CREATE DATABASE IF NOT EXISTS databases_garage";
    $conn->exec($sql);

    echo "Base de données créée avec succès";
} catch(PDOException $e) {
    echo "Erreur lors de la création de la base de données : " . $e->getMessage();
}

$conn = null;

?>