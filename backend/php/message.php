<?php
include 'config.php';
try {
    $sql = "SELECT * FROM contact_info";
    $result = $conn->query($sql);

    $messages = $result->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Erreur : " . $e->getMessage();
}
?>
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
    <link rel="stylesheet" href="../css/message.css">
    <link rel="stylesheet" href="../css/header_b.css">
    <title>Messages</title>
</head>
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

    <h1>Messages</h1>

    <?php if (isset($messages) && !empty($messages)) : ?>
        <table border="1">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Prénom</th>
                    <th>Email</th>
                    <th>Téléphone</th>
                    <th>Message</th>
                    <th>Date</th>
                    <th>Actions</th> 
                </tr>
            </thead>
            <tbody>
                <?php foreach ($messages as $message) : ?>
                    <tr>
                        <td><?php echo $message['id']; ?></td>
                        <td><?php echo $message['prenom']; ?></td>
                        <td><?php echo $message['email']; ?></td>
                        <td><?php echo $message['telephone']; ?></td>
                        <td><?php echo $message['message']; ?></td>
                        <td><?php echo $message['created_at']; ?></td>
                        <td>
                            <form method="post" action="supprimer_message.php">
                                <input type="hidden" name="message_id" value="<?php echo $message['id']; ?>">
                                <input type="submit" value="Supprimer">
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else : ?>
        <p>Aucun message trouvé.</p>
    <?php endif; ?>

</body>
</html>