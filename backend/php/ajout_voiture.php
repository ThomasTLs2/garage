<?php
include 'config.php';
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "databases_garage";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Récupération du rôle depuis la session
    $role = isset($_SESSION['user_info']['role']) ? $_SESSION['user_info']['role'] : null;
} catch(PDOException $e) {
    echo "Erreur de connexion à la base de données : " . $e->getMessage();
}

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "SELECT id, marque, modele FROM voiture";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
} catch (PDOException $e) {
    echo "Erreur : " . $e->getMessage();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Affichage et Supression Voiture</title>
    <link rel="stylesheet" href="../css/ajout_voiture.css">
    <link rel="stylesheet" href="../css/header_b.css">

</head>
<header>
    <h1>Tableau de Bord</h1>
        <nav>
            <ul>
                <li><a href="dashboard.php">Accueil</a></li>
                <li><a href="ajout_voiture.php">Ajout Voiture</a></li>
                <li><a href="commentaire.php">Commentaire</a></li>
                <li><a href="deconnexion.php">Déconnexion</a></li>
                <?php if ($role === 'administrateur') : ?>
                    <li>
                        <a href="create_acc.php">Créer un compte personnel</a>
                    </li> 
                    <li>
                        <a href="conn_membre.php">Personnel</a>
                    </li> 
                <?php endif; ?>

            </ul>
        </nav>
</header>
<body>

    <h2>Ajout de Voiture</h2>

    <form action="trait_voiture.php" method="post" enctype="multipart/form-data">
        <label for="marque">Marque :</label>
        <input type="text" id="marque" name="marque" required>

        <label for="modele">Modèle :</label>
        <input type="text" id="modele" name="modele" required>

        <label for="year">Année :</label>
        <input type="number" id="year" name="year" required>

        <label for="kilometre">Kilométrage :</label>
        <input type="number" id="kilometre" name="kilometre" required>

        <label for="prix">Prix :</label>
        <input type="text" id="prix" name="prix" required>

        <label for="description">Description :</label>
        <textarea id="description" name="description" rows="4" required></textarea>

        <label for="images">Images (sélectionnez plusieurs) :</label>
        <input type="file" id="images" name="images[]" multiple accept="image/*">

        <button type="submit">Ajouter Voiture</button>
    </form>

    <h2>Affichage et Suppression de Voitures</h2>

    <?php
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    echo "<div class='voiture'>";
    echo "<h3>" . $row['marque'] . " " . $row['modele'] . "</h3>";

    echo "<form action='supprimer_voiture.php' method='post'>";
    echo "<input type='hidden' name='voiture_id' value='" . $row['id'] . "'>";
    echo "<button type='submit' name='supprimer_voiture'>Supprimer Voiture</button>";
    echo "</form>";

    echo "</div>";
}
?>
</body>

</html>

