<?php
include 'backend/php/config.php';

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "databases_garage";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql_users = "CREATE TABLE connexion (
        id INT AUTO_INCREMENT PRIMARY KEY,
        prenom VARCHAR(50) NOT NULL,
        nom VARCHAR(50) NOT NULL,
        email VARCHAR(100) NOT NULL UNIQUE,
        role ENUM('administrateur', 'personnel') DEFAULT 'personnel',
        mot_de_passe VARCHAR(255) NOT NULL,
        date_creation TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        date_modification TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    )";
    
    $conn->exec($sql_users);
    // Création de la table des voitures
    $sql_voiture = "CREATE TABLE voiture (
        id INT AUTO_INCREMENT PRIMARY KEY,
        marque VARCHAR(255) NOT NULL,
        modele VARCHAR(255) NOT NULL,
        year INT NOT NULL,
        kilometre INT NOT NULL,
        prix DECIMAL(10, 2) NOT NULL,
        description TEXT,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    )";
    $conn->exec($sql_voiture);

    // Création de la table des images des voitures
    $sql_photo_voiture = "CREATE TABLE photo_voiture (
        id INT AUTO_INCREMENT PRIMARY KEY,
        voiture_id INT,
        image_path VARCHAR(255) NOT NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        FOREIGN KEY (voiture_id) REFERENCES voiture(id) ON DELETE CASCADE ON UPDATE CASCADE
    )";
    $conn->exec($sql_photo_voiture);

    // Création de la table des commentaires
    $sql_commentaire = "CREATE TABLE commentaire (
        id INT AUTO_INCREMENT PRIMARY KEY,
        critique VARCHAR(255) NOT NULL,
        note INT NOT NULL,
        comment TEXT NOT NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    )";
    $conn->exec($sql_commentaire);

    $sql_garage = "CREATE TABLE garage (
        id INT AUTO_INCREMENT PRIMARY KEY,
        etat_garage VARCHAR(10) DEFAULT 'ferme',
        date_creation TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        date_modification TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    )";
    $conn->exec($sql_garage);

    // Création de la table "horaires"
    $sql_horaires = "CREATE TABLE horaires (
        id INT AUTO_INCREMENT PRIMARY KEY,
        jour_semaine VARCHAR(20) NOT NULL,
        horaire_ouverture TIME NOT NULL,
        horaire_fermeture TIME NOT NULL,
        date_creation TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        date_modification TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    )";
    $conn->exec($sql_horaires);

    echo "Base de données et tables créées avec succès";
} catch(PDOException $e) {
    echo "Erreur lors de la création de la base de données et des tables : " . $e->getMessage();
}

$conn = null;
?>


