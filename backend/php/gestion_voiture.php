<?php
include '../backend/php/config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['supprimer_voiture_id'])) {
    $voitureIdToDelete = $_POST['supprimer_voiture_id'];

    $stmt = $conn->prepare("DELETE FROM voiture WHERE id = :id");
    $stmt->bindParam(':id', $voitureIdToDelete, PDO::PARAM_INT);

    if ($stmt->execute()) {

        header("Location: gestion_voitures.php");
        exit();
    } else {

        $errorDelete = "Erreur lors de la suppression de la voiture.";
    }
}

$stmt = $conn->query("SELECT id, marque, modele FROM voiture");
$voitures = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des Voitures</title>
</head>
<body>
    
    <h2>Gestion des Voitures</h2>

    <?php if (isset($errorDelete)) : ?>
        <p style="color: red;"><?php echo $errorDelete; ?></p>
    <?php endif; ?>


    <ul>
        <?php foreach ($voitures as $voiture) : ?>
            <li>
                <?php echo $voiture['marque'] . " " . $voiture['modele']; ?>
                <form action="gestion_voitures.php" method="post" style="display:inline;">
                    <input type="hidden" name="supprimer_voiture_id" value="<?php echo $voiture['id']; ?>">
                    <button type="submit">Supprimer</button>
                </form>
                <a href="modifier_voiture.php?id=<?php echo $voiture['id']; ?>">Modifier</a>
            </li>
        <?php endforeach; ?>
    </ul>

    <a href="ajout_voiture.php">Ajouter une Nouvelle Voiture</a>

</body>
</html>