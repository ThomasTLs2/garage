<?php
include '../backend/php/config.php';
include '../backend/php/afficher_commentaires.php';
?>
<!DOCTYPE html>
<html>
<html lang="en">  
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Garage</title>    <link rel="stylesheet" href="../css/index.css">

    <link rel="stylesheet" href="../css/header.css">
    <link rel="stylesheet" href="../css/footer.css">
    <link rel="stylesheet" href="../css/index.css">
    <link rel="stylesheet" href="../css/pastille-ouverture.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    
  </head>
  <!-----------------------------------------------HEADER------------------------------------------------------->
<header>
    <nav>
        <div class="header">
          <a href="index.php">
            <img class="logo" src="../images/Logo.png" alt="Logo">
          </a>
          <?php
            include 'config.php';
            $sql_select_garage = "SELECT ouvert FROM garage";
            $result_garage = $conn->query($sql_select_garage);

            if ($result_garage !== false) {
                $row_garage = $result_garage->fetch(PDO::FETCH_ASSOC);

                if (is_array($row_garage)) {
                    $ouvert = ($row_garage['ouvert'] === null) ? false : $row_garage['ouvert'];
                    $pastille_class = ($ouvert) ? 'pastille pastille-ouverte' : 'pastille pastille-fermee';
                    echo '<div class="' . $pastille_class . '"></div>';
                }
            }
            ?>
         <div class="pastille <?php echo ($ouvert) ? 'pastille-ouverte' : 'pastille-fermee'; ?>"></div>
              <div class="menu">
              <a href="index.php" class="accueil" >Accueil</a>
              <a href="vehicule-occas.php" class="vehicule-occas">Véhicules D'occasion</a>
              <a href="rep-caro.html" class="rep-caro" >Réparation Carrosserie</a>
              <a href="rep-meca.html" class="rep-meca">Réparation Mecanique</a>
              <a href="login.php" class="apropos" >A Propos</a>
              <a href="login.php" class="apropos" >A Propos</a>
              <a href="contact.html" class="contact">contact</a>
            </div>
        </div>
        <img class="bannière" src="../images/PARROT.png" alt="bannière">
      </nav>
</header>

  <!-----------------------------------------------BODY------------------------------------------------------->
<body>
<script>
    // Ajoutez ce script pour activer l'accordéon
    document.addEventListener('DOMContentLoaded', function () {
      const accordions = document.querySelectorAll('.accordion');

      accordions.forEach(accordion => {
        accordion.addEventListener('click', function () {
          this.classList.toggle('active');
          const panel = this.nextElementSibling;
          if (panel.style.maxHeight) {
            panel.style.maxHeight = null;
          } else {
            panel.style.maxHeight = panel.scrollHeight + 'px';
          }
        });
      });
    });
  </script>
  <h1>FAQ - Garage V.Parrot</h1>
  </div>
  <div class="faq">
    <button class="accordion">
      Quels types de services proposez-vous ?
      <i class="fa-solid fa-chevron-down"></i>
    </button>
    <div class="pannel">
      <p>
        Lorem ipsum dolor, sit amet consectetur adipisicing elit. Facilis
        saepe molestiae distinctio asperiores cupiditate consequuntur dolor
        ullam, iure eligendi harum eaque hic corporis debitis porro
        consectetur voluptate rem officiis architecto.
      </p>
    </div>
  </div>

  <div class="faq">
    <button class="accordion">
      Offrez-vous une garantie sur vos réparations ?
      <i class="fa-solid fa-chevron-down"></i>
    </button>
    <div class="pannel">
      <p>
        Lorem ipsum dolor, sit amet consectetur adipisicing elit. Facilis
        saepe molestiae distinctio asperiores cupiditate consequuntur dolor
        ullam, iure eligendi harum eaque hic corporis debitis porro
        consectetur voluptate rem officiis architecto.
      </p>
    </div>
  </div>

  <div class="faq">
    <button class="accordion">
      Comment puis-je vendre ma voiture par votre intermédiaire ?
      <i class="fa-solid fa-chevron-down"></i>
    </button>
    <div class="pannel">
      <p>
        Lorem ipsum dolor, sit amet consectetur adipisicing elit. Facilis
        saepe molestiae distinctio asperiores cupiditate consequuntur dolor
        ullam, iure eligendi harum eaque hic corporis debitis porro
        consectetur voluptate rem officiis architecto.
      </p>
    </div>
  </div>

  <div class="faq">
    <button class="accordion">
    Fournissez-vous des services d'urgence ?
      <i class="fa-solid fa-chevron-down"></i>
    </button>
    <div class="pannel">
      <p>
        Lorem ipsum dolor, sit amet consectetur adipisicing elit. Facilis
        saepe molestiae distinctio asperiores cupiditate consequuntur dolor
        ullam, iure eligendi harum eaque hic corporis debitis porro
        consectetur voluptate rem officiis architecto.
      </p>
    </div>
  </div>
</div>
<div class="container">
    <h2>Nos Clients nous recommandent</h2>

    <?php
    include '../backend/php/config.php';

    // Affichage des commentaires
    $sql_select_commentaires = "SELECT * FROM commentaire";
    $result = $conn->query($sql_select_commentaires);

    // Afficher les commentaires
    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        echo '<div class="review">';
        echo '<p class="reviewer">' . $row['critique'] . '</p>';
        echo '<div class="rating">' . str_repeat('★', $row['note']) . '</div>';
        echo '<p class="comment">' . $row['comment'] . '</p>';
        echo '</div>';
    }
    ?>

    <!-- Formulaire pour ajouter un commentaire -->
    <form action="index.php" method="post">
        <label for="critique">Nom / Prenom :</label>
        <input type="text" id="critique" name="critique" required>

        <label for="note">Note :</label>
        <select id="note" name="note" required>
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
        </select>

        <label for="comment">Commentaire :</label>
        <textarea id="comment" name="comment" rows="4" required></textarea>

        <button type="submit">Ajouter Commentaire</button>
    </form>

    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $critique = $_POST['critique'];
        $note = $_POST['note'];
        $comment = $_POST['comment'];

        $sql_ajouter_commentaire = "INSERT INTO commentaire (critique, note, comment) VALUES (:critique, :note, :comment)";
        $stmt = $conn->prepare($sql_ajouter_commentaire);
        $stmt->bindParam(':critique', $critique);
        $stmt->bindParam(':note', $note);
        $stmt->bindParam(':comment', $comment);
        $stmt->execute();

        header("Location: index.php");
        exit();
    }
    $conn = null;
    ?>
</div>
  <!-----------------------------------------------FOOTER------------------------------------------------------->
  <footer>
    
    <div class="footer">
      <div class="info">
        <h3><img src="info.png" alt=""></h3>
        <a href="index.html" class="accueil-footer" >Accueil</a>
        <a href="vehicule-occas.html" class="vehicule-occas-footer">Véhicules D'occasion</a>
        <a href="rep-caro.html" class="rep-caro-footer" >Réparation Carrosserie</a>
        <a href="rep-meca.html" class="rep-meca-footer">Réparation Mecanique</a>
        <a href="apropos.html" class="apropos-footer" >A Propos</a>
     </div>
      <div class="horaires">
       <ul>
          <li>Lundi : 9h00 - 19h00</li>
          <li>Mardi : 9h00 - 19h00</li>
          <li>Mercredi : 9h00 - 19h00</li>
          <li>Jeudi : 9h00 - 19h00</li>
          <li>Vendredi : 9h00 - 19h00</li>
          <li>Samedi - Dimanche : Fermé</li>
       </ul>
      </div>
     <div class="contact">
       <ul>
          <li>Tel : + 33 (0)4 56 85 96 87</li>
          <li>Fix : + 33 (0)4 56 85 96 87</li>
        </ul>
      </div>
      <div class="loc">
        <ul>
           <li>Viarmes</li>
           <li>33 Rue de la gare</li>
           <li>95270</li>
         </ul>
       </div>
       <div class="word-foot"><ul><li>Site par Thomas © 2024 Garage V. Parrot</li></ul>
       </div>
      <hr class="footer-line line-1">
      <hr class="footer-line line-2">
      <hr class="footer-line line-3">

 
      <a href="index.html">
        <img class="snapchat" src="../images/snapchat 2.png" alt="snap">
      </a>
      <a href="index.html">
        <img class="insta" src="../images/instagram 2.png" alt="snap">
      </a>
      <a href="index.html">
        <img class="twitter" src="../images/twitter 2.png" alt="snap">
      </a>
      <a href="contact.html">
        <img class="van" src="../images/van 2.png" alt="snap">
      </a>
      <a href="index.html">
        <img class="voiture" src="../images/voiture 2.png" alt="snap">
      </a>
      <a href="index.html">
        <img class="facebook" src="../images/facebook 2.png" alt="snap">
      </a>
      <img class="rota-horaire" src="../images/rotation-horaire.png" alt="rota-horaire">
      <img class="carte-drapeaux" src="../images/cartes-et-drapeaux.png" alt="cartes-drapeaux">
      <img class="info" src="../images/info.png" alt="info">
      
     <div class="map">
      <img src="../images/map.png" alt="" class="map">
   </div>
   <div class="rectangle-17"></div>
   <a href="mentions-legales.html" class="mentions-legales" >Mentions Legales</a>
   <a href="termesetconditions.html" class="termesetconditions">Termes et Conditions</a>
   <a href="politiquedeconf.html" class="politiquedeconf" >Politique de Confidentialité</a>
    </div>
  </footer>
  </body>
</html>