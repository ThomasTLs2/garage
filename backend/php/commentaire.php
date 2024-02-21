<?php
session_start();
include 'config.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Commentaire</title>
    <link rel="stylesheet" href="../css/comm.css">
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
<?php
include 'config.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = isset($_POST['action']) ? $_POST['action'] : null;
    if ($action === 'modifier') {

        $comment_id = isset($_POST['comment_id']) ? $_POST['comment_id'] : null;
        $nouvelle_critique = $_POST['nouvelle_critique'];
        $nouvelle_note = $_POST['nouvelle_note'];
        $nouveau_comment = $_POST['nouveau_comment'];

        $sql_modifier_commentaire = "UPDATE commentaire SET critique = :critique, note = :note, comment = :comment WHERE id = :comment_id";
        $stmt = $conn->prepare($sql_modifier_commentaire);
        $stmt->bindParam(':critique', $nouvelle_critique);
        $stmt->bindParam(':note', $nouvelle_note);
        $stmt->bindParam(':comment', $nouveau_comment);
        $stmt->bindParam(':comment_id', $comment_id);
        $stmt->execute();

        header("Location: commentaire.php");
        exit();
    } elseif ($action === 'supprimer') {
        $comment_id = isset($_POST['comment_id']) ? $_POST['comment_id'] : null;

        $sql_supprimer_commentaire = "DELETE FROM commentaire WHERE id = :comment_id";
        $stmt = $conn->prepare($sql_supprimer_commentaire);
        $stmt->bindParam(':comment_id', $comment_id);
        $stmt->execute();

        header("Location: commentaire.php");
        exit();
    } elseif ($action === 'ajouter') {
        // ajout commentaire
        $nouvelle_critique = $_POST['nouvelle_critique'];
        $nouvelle_note = $_POST['nouvelle_note'];
        $nouveau_comment = $_POST['nouveau_comment'];


        $sql_ajouter_commentaire = "INSERT INTO commentaire (critique, note, comment) VALUES (:critique, :note, :comment)";
        $stmt = $conn->prepare($sql_ajouter_commentaire);
        $stmt->bindParam(':critique', $nouvelle_critique);
        $stmt->bindParam(':note', $nouvelle_note);
        $stmt->bindParam(':comment', $nouveau_comment);
        $stmt->execute();

        header("Location: commentaire.php");
        exit();
    }
}

// Affichage des commentaires
$sql_select_commentaires = "SELECT * FROM commentaire";
$result = $conn->query($sql_select_commentaires);

// Afficher les commentaires
while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
    echo '<div class="review">';
    echo '<p class="reviewer">' . $row['critique'] . '</p>';
    echo '<div class="rating">' . str_repeat('★', $row['note']) . '</div>';
    echo '<p class="comment">' . $row['comment'] . '</p>';

    //modif un commentaire
    echo '<form action="commentaire.php" method="post">';
    echo '<input type="hidden" name="action" value="modifier">';
    echo '<input type="hidden" name="comment_id" value="' . $row['id'] . '">';

    echo '<label for="nouvelle_critique">Nouvelle Critique :</label>';
    echo '<input type="text" id="nouvelle_critique" name="nouvelle_critique" required value="' . $row['critique'] . '">';

    echo '<label for="nouvelle_note">Nouvelle Note :</label>';
    echo '<select id="nouvelle_note" name="nouvelle_note" required>';
    for ($i = 1; $i <= 5; $i++) {
        echo '<option value="' . $i . '"' . ($i == $row['note'] ? ' selected' : '') . '>' . $i . '</option>';
    }
    echo '</select>';

    echo '<label for="nouveau_comment">Nouveau Commentaire :</label>';
    echo '<textarea id="nouveau_comment" name="nouveau_comment" rows="4" required>' . $row['comment'] . '</textarea>';

    echo '<button type="submit">Modifier Commentaire</button>';
    echo '</form>';

    // supprime un commentaire
    echo '<form action="commentaire.php" method="post">';
    echo '<input type="hidden" name="action" value="supprimer">';
    echo '<input type="hidden" name="comment_id" value="' . $row['id'] . '">';
    echo '<button type="submit">Supprimer Commentaire</button>';
    echo '</form>';

    echo '</div>';
}

//ajoute commentaire
echo '<form action="commentaire.php" method="post">';
echo '<input type="hidden" name="action" value="ajouter">';

echo '<label for="nouvelle_critique">Critique :</label>';
echo '<input type="text" id="nouvelle_critique" name="nouvelle_critique" required>';

echo '<label for="nouvelle_note">Note :</label>';
echo '<select id="nouvelle_note" name="nouvelle_note" required>';
echo '<option value="1">1</option>';
echo '<option value="2">2</option>';
echo '<option value="3">3</option>';
echo '<option value="4">4</option>';
echo '<option value="5">5</option>';
echo '</select>';

echo '<label for="nouveau_comment">Commentaire :</label>';
echo '<textarea id="nouveau_comment" name="nouveau_comment" rows="4" required></textarea>';

echo '<button type="submit">Ajouter Commentaire</button>';
echo '</form>';

$conn = null;
?>
</body>
</html>