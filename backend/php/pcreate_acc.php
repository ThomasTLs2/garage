<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include 'config.php';
session_start();

if (isset($_POST['create_account'])) {
    $prenom = $_POST['prenom'];
    $nom = $_POST['nom'];
    $email = $_POST['email'];
    $mot_de_passe = $_POST['mot_de_passe'];

    // Vérifiez rôle a été choisi
    if (isset($_POST['role_admin'])) {
        $role = 'administrateur';
    } elseif (isset($_POST['role_personnel'])) {
        $role = 'personnel';
    } else {
        echo "Veuillez sélectionner un rôle.";
        exit();
    }

    try {
        $sql = "INSERT INTO connexion (prenom, nom, email, mot_de_passe, role) VALUES (:prenom, :nom, :email, :mot_de_passe, :role)";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':prenom', $prenom, PDO::PARAM_STR);
        $stmt->bindParam(':nom', $nom, PDO::PARAM_STR);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->bindParam(':mot_de_passe', $mot_de_passe, PDO::PARAM_STR);
        $stmt->bindParam(':role', $role, PDO::PARAM_STR);
        $stmt->execute();

        header("Location: success.php");
        exit();
    } catch (PDOException $e) {
        echo "Erreur lors de la création du compte : " . $e->getMessage();
    }
}
?>