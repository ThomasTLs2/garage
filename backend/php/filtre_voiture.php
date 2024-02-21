<?php
include 'config.php';

// Récupérer les valeurs des filtres depuis l'URL
$marque = isset($_GET['marque']) ? $_GET['marque'] : '';
$modele = isset($_GET['modele']) ? $_GET['modele'] : '';
$kilo = isset($_GET['kilometre']) ? $_GET['kilometre'] : '';
$prix = isset($_GET['prix']) ? $_GET['prix'] : '';

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "SELECT v.id, v.marque, v.modele, v.year, v.kilometre, v.prix, v.description, pv.image_path FROM voiture v
            LEFT JOIN photo_voiture pv ON v.id = pv.voiture_id
            WHERE v.marque LIKE :marque AND v.modele LIKE :modele
            AND v.kilometre <= :kilometre AND v.prix <= :prix";

    $stmt = $conn->prepare($sql);
    
    $stmt->bindParam(':marque', $marque, PDO::PARAM_STR);
    $stmt->bindParam(':modele', $modele, PDO::PARAM_STR);
    $stmt->bindParam(':kilometre', $kilo, PDO::PARAM_INT);
    $stmt->bindParam(':prix', $prix, PDO::PARAM_INT);

    $stmt->execute();

    //  informations
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo "<div class='voiture'>";
        echo "<h3>" . $row['marque'] . " " . $row['modele'] . "</h3>";
        echo "<p>Année: " . $row['year'] . "</p>";
        echo "<p>Kilométrage: " . $row['kilometre'] . "</p>";
        echo "<p>Prix: " . $row['prix'] . "</p>";
        echo "<p>Description: " . $row['description'] . "</p>";

        // info photo
        if (!empty($row['image_path'])) {
            echo "<p>Images:</p>";
            $images = explode(',', $row['image_path']);
            echo "<div class='images'>";
            foreach ($images as $image) {
                $imageUrl = "../backend/php/$image";
                echo "<img src='$imageUrl' alt='Voiture Image'>";
            }
            echo "</div>";
        }

        echo "</div>";
    }
} catch (PDOException $e) {
    echo "Erreur : " . $e->getMessage();
}

$conn = null;
?>