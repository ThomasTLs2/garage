<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);
include 'config.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: ../html/login.php");
    exit();
}

$user_id = $_SESSION['user_id'];


if (isset($_SESSION['user_info'])) {
    $user_info = $_SESSION['user_info'];
    $nom = $user_info['nom'];
    $prenom = $user_info['prenom'];
    $email = $user_info['email'];
    $role = $user_info['role'];
} else {

    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = "SELECT id, prenom, nom, email, role FROM connexion WHERE id = :user_id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $user_info = $stmt->fetch(PDO::FETCH_ASSOC);
            $user_id = $user_info['id'];
            $nom = $user_info['nom'];
            $prenom = $user_info['prenom'];
            $email = $user_info['email'];
            $role = $user_info['role'];

            $_SESSION['user_info'] = $user_info;
        } else {
            $nom = "Nom inconnu";
            $prenom = "Prénom inconnu";
            $email = "Email inconnu";
            $role = "Role inconnu";
        }
    } catch (PDOException $e) {
        echo "Erreur : " . $e->getMessage();
    }

    $conn = null;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tableau de Bord</title>
    <link rel="stylesheet" href="../css/dashboard.css">
    <link rel="stylesheet" href="../css/header_b.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

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
                <li><a href="message.php"><i class="fas fa-envelope"></i> </a></li>

            </ul>
        </nav>
</header>
<body>
    <section class="main-content">
        <h2>Bienvenue, Utilisateur ID : <?php echo $user_id; ?></h2>
        
        <div class="widget">
            <h3>Vos Informations</h3>
            <p>Nom : <?php echo $nom; ?></p>
            <p>Prénom : <?php echo $prenom; ?></p>
            <p>Email : <?php echo $email; ?></p>
            <p>Droit : <?php echo $role; ?></p>
        </div>
        
    </section>

    

<?php
    include 'config.php';

    try {
        //état actuel du garage
        $sql_select_garage = "SELECT etat_garage, ouvert FROM garage";
        $result_garage = $conn->query($sql_select_garage);

        if ($result_garage !== false) {
            $row_garage = $result_garage->fetch(PDO::FETCH_ASSOC);

            if (is_array($row_garage)) {
                $etat_garage = $row_garage['etat_garage'];
                $ouvert = ($row_garage['ouvert'] === null) ? false : $row_garage['ouvert'];

                // aff etat du garage
                echo '<div class="garage">';
                echo "<p>État du garage : $etat_garage</p>";
                echo "<p>Le garage est actuellement " . ($ouvert ? "ouvert" : "fermé") . "</p>";

                // etat garage
                echo '<form method="post" action="ouverture_garage.php">';
                echo '<label for="nouvel_etat_garage">Nouvel état du garage :</label>';
                echo '<select id="nouvel_etat_garage" name="nouvel_etat_garage">';
                echo '<option value="ouvert">Ouvert</option>';
                echo '<option value="ferme">Fermé</option>';
                echo '</select>';
                echo '<input type="submit" value="Modifier État Garage">';
                echo '</form>';

                echo '</div>';
            } else {
                echo '<p>Aucune donnée de garage trouvée.</p>';
            }
        } else {
            echo '<p>Erreur lors de l\'exécution de la requête SQL.</p>';
        }
    } catch (PDOException $e) {
        echo "Erreur : " . $e->getMessage();
    }
?>
</body>
</html>