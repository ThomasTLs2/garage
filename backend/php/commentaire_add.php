<?php
    include 'config.php'; 

    $critique = $_POST['critique'];
    $note = $_POST['note'];
    $comment = $_POST['comment'];

    $sql_insert_commentaire = "INSERT INTO commentaire (critique, note, comment) VALUES (:critique, :note, :comment)";
    $stmt = $conn->prepare($sql_insert_commentaire);
    $stmt->bindParam(':critique', $critique);
    $stmt->bindParam(':note', $note);
    $stmt->bindParam(':comment', $comment);
    $stmt->execute();
    $conn = null;
    header("Location: ../votre_page.php");
exit();
?>