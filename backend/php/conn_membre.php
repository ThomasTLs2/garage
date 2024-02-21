<?php
include 'config.php';

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "SELECT id, prenom, nom, email, last_login FROM connexion";
    $stmt = $conn->prepare($sql);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        echo "<h2>Membres et Dernière Connexion</h2>";
        echo "<table border='1'>";
        echo "<tr><th>ID</th><th>Prénom</th><th>Nom</th><th>Email</th><th>Dernière Connexion</th></tr>";

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo "<tr>";
            echo "<td>" . $row['id'] . "</td>";
            echo "<td>" . $row['prenom'] . "</td>";
            echo "<td>" . $row['nom'] . "</td>";
            echo "<td>" . $row['email'] . "</td>";
            echo "<td>" . $row['last_login'] . "</td>";
            echo "</tr>";
        }

        echo "</table>";
    } else {
        echo "personnel trouvé.";
    }
} catch (PDOException $e) {
    echo "Erreur : " . $e->getMessage();
}

$conn = null;
?>