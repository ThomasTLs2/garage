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
    <link rel="stylesheet" href="../css/create.css">
    <link rel="stylesheet" href="../css/header_b.css">
    <title>Création de Compte</title>
</head>
<body>
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
    <div class="create-account-container">
        <h2>Création de Compte</h2>

        <form action="pcreate_acc.php" method="post">
            <label for="prenom">Prénom :</label>
            <input type="text" name="prenom" required><br>

            <label for="nom">Nom :</label>
            <input type="text" name="nom" required><br>

            <label for="email">Email :</label>
            <input type="email" name="email" required><br>

            <label for="role">Rôle :</label>
            <input type="checkbox" name="role_admin" value="administrateur"> Administrateur
            <input type="checkbox" name="role_personnel" value="personnel"> Personnel<br>

            <label for="mot_de_passe">Mot de passe :</label>
            <input type="password" name="mot_de_passe" required><br>

            <input type="submit" name="create_account" value="Créer le compte">
        </form>
    </div>
</body>
</html>