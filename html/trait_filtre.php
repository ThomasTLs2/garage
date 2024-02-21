<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Résultats de Filtrage</title>
    <link rel="stylesheet" href="../css/voiture_occ.css">
</head>
<body>

<div class="resultats-filtrage">
    <?php
    include '../backend/php/config.php';

    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Récupérer les valeurs du formulaire de filtrage
        $minYear = isset($_GET['minYear']) ? intval($_GET['minYear']) : 0;
        $maxKilometers = isset($_GET['maxKilometers']) ? intval($_GET['maxKilometers']) : PHP_INT_MAX;
        $maxPrice = isset($_GET['maxPrice']) ? intval($_GET['maxPrice']) : PHP_INT_MAX;

        // Construire la requête SQL avec les conditions de filtrage
        $sql = "SELECT v.id, v.marque, v.modele, v.year, v.kilometre, v.prix, v.description, pv.image_path 
                FROM voiture v
                LEFT JOIN photo_voiture pv ON v.id = pv.voiture_id
                WHERE v.year >= :minYear AND v.kilometre <= :maxKilometers AND v.prix <= :maxPrice";

        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':minYear', $minYear, PDO::PARAM_INT);
        $stmt->bindParam(':maxKilometers', $maxKilometers, PDO::PARAM_INT);
        $stmt->bindParam(':maxPrice', $maxPrice, PDO::PARAM_INT);
        $stmt->execute();

        // Afficher les informations
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo "<div class='voiture'>";
            // Afficher les informations spécifiques à la photo
            if (!empty($row['image_path'])) {
                echo "<div class='images'>";
                $images = explode(',', $row['image_path']);
                foreach ($images as $image) {
                    // Construisez l'URL complète en ajoutant le chemin de base à l'image
                    $imageUrl = "../backend/php/$image";
                    echo "<div class='image-item'>";
                    echo "<img src='$imageUrl' alt='Voiture Image'>";
                    echo "</div>";
                }
                echo "</div>";
            }
            // Afficher le texte après les images
            echo "<div class='text'>";
            echo "<h3>" . $row['marque'] . " " . $row['modele'] . "</h3>";
            echo "<p class='annee'>Année: " . $row['year'] . "</p>";
            echo "<p class='kilometrage'>Kilométrage: " . $row['kilometre'] . "</p>";
            echo "<p class='description'>Description: " . $row['description'] . "</p>";
            echo "</div>";
            echo "</div>";
        }
    } catch (PDOException $e) {
        echo "Erreur : " . $e->getMessage();
    }

    $conn = null;
    ?>
</div>
</body>
</html>