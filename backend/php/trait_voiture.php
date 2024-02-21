<?php
include 'config.php';
error_reporting(E_ALL);
ini_set('display_errors', 1);
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les données du formulaire pour la voiture
    $marque = $_POST['marque'];
    $modele = $_POST['modele'];
    $year = $_POST['year'];
    $kilometre = $_POST['kilometre'];
    $prix = $_POST['prix'];
    $description = $_POST['description'];

    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = "INSERT INTO voiture (marque, modele, year, kilometre, prix, description) 
                VALUES (:marque, :modele, :year, :kilometre, :prix, :description)";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':marque', $marque);
        $stmt->bindParam(':modele', $modele);
        $stmt->bindParam(':year', $year);
        $stmt->bindParam(':kilometre', $kilometre);
        $stmt->bindParam(':prix', $prix);
        $stmt->bindParam(':description', $description);

        $stmt->execute();
        $voitureId = $conn->lastInsertId(); 

        // image
        if (!empty($_FILES['images']['name'][0])) {
            foreach ($_FILES['images']['tmp_name'] as $key => $tmp_name) {
                $imageName = $_FILES['images']['name'][$key];
                $imagePath = "uploads/" . $voitureId . "_" . $imageName;
                move_uploaded_file($tmp_name, $imagePath);

                // le chemin de l'image 
                $sqlImage = "INSERT INTO photo_voiture (voiture_id, image_path) VALUES (:voitureId, :imagePath)";
                $stmtImage = $conn->prepare($sqlImage);
                $stmtImage->bindParam(':voitureId', $voitureId);
                $stmtImage->bindParam(':imagePath', $imagePath);
                $stmtImage->execute();
            }
        }

        echo "Voiture ajoutée avec succès!";
    } catch (PDOException $e) {
        echo "Erreur : " . $e->getMessage();
    }

    $conn = null;
}
?>