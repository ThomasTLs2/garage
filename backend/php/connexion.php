<?php
session_start();
include 'config.php';
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "databases_garage";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if(isset($_POST['formconnexion'])) {
        $email = $_POST['email'];
        $password = $_POST['password'];

        $sql = "SELECT * FROM clients WHERE email = '$email' AND password = '$password'";
        $stmt = $conn->prepare($sql);
        $stmt->execute();

        if($stmt->rowCount() > 0) {
            echo "Connexion réussie";
            // action a faire
        } else {
            echo "Identifiants incorrects";
        }
    }
} catch(PDOException $e) {
    echo "Erreur : " . $e->getMessage();
}

$conn = null;
?>
