<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulaire de Connexion</title>
    <link rel="stylesheet" href="../css/login.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <div class="login-container">
        <i class="fas fa-user-circle login-icon"></i>
        <h2>Connexion</h2>
        <?php
        include '../backend/php/config.php';
        session_start();

        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "databases_garage"; // Remplacez par le nom de votre base de données

        try {
            $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            if (isset($_POST['formconnexion'])) {
                $email = $_POST['email'];
                $password = $_POST['password'];

                $sql = "SELECT * FROM connexion WHERE email = :email AND mot_de_passe = :password";
                $stmt = $conn->prepare($sql);
                $stmt->bindParam(':email', $email, PDO::PARAM_STR);
                $stmt->bindParam(':password', $password, PDO::PARAM_STR);
                $stmt->execute();

                if ($stmt->rowCount() > 0) {
                    $row = $stmt->fetch(PDO::FETCH_ASSOC);
                    $_SESSION['user_id'] = $row['id']; 
                    header("Location: ../backend/php/dashboard.php");
                    exit();
                } else {
                    echo "Identifiants incorrects";
                }
            }
        } catch (PDOException $e) {
            echo "Erreur : " . $e->getMessage();
        }

        $conn = null;
?>


        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <label for="email">Email :</label>
            <input type="email" name="email" required><br>
            
            <label for="password">Mot de passe :</label>
            <input type="password" name="password" required><br>
            
            <input type="submit" name="formconnexion" value="Se connecter">
        </form>
    </div>
</body>
</html>