<?php
include '../backend/php/config.php';
?>
<!DOCTYPE html>
<html>
<html lang="en">  
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Garage</title>
    <link rel="stylesheet" href="../css/header.css">
    <link rel="stylesheet" href="voiture.css">
    <link rel="stylesheet" href="../css/footer.css">
</head>
  <!-----------------------------------------------HEADER------------------------------------------------------->
<header>
    <nav>
        <div class="header">
          <a href="index.html">
            <img class="logo" src="../images/Logo.png" alt="Logo">
          </a>
            <div class="menu">
              <a href="index.php" class="accueil" >Accueil</a>
              <a href="vehicule-occas.php" class="vehicule-occas">Véhicules D'occasion</a>
              <a href="rep-caro.html" class="rep-caro" >Réparation Carrosserie</a>
              <a href="rep-meca.html" class="rep-meca">Réparation Mecanique</a>
              <a href="apropos.html" class="apropos" >A Propos</a>
              <a href="contact.html" class="contact">contact</a>
            </div>
        </div>
      </nav>
</header>

  <!-----------------------------------------------BODY------------------------------------------------------->
  <body>
      <div class="filtre">
        <form id="filterForm">
              <label for="minYear">Année minimal :</label>
              <input type="number" name="minYear" id="minYear">

              <label for="maxKilometers">Kilométrage max :</label>
              <input type="number" name="maxKilometers" id="maxKilometers">

              <label for="maxPrice">Prix max :</label>
              <input type="number" name="maxPrice" id="maxPrice">

              <button type="button" id="filterButton">Filtrer</button>
          </form>
        <style>
          
        </style>
      </div>
  <div class="box">
        <div class="voitures-section">
          
           
        </div>
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
  <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
  <script>
  $(document).ready(function() {
      function updateAnnonces() {
          var minYear = $('#minYear').val();
          var maxKilometers = $('#maxKilometers').val();
          var maxPrice = $('#maxPrice').val();

          if (minYear === "" && maxKilometers === "" && maxPrice === "") {
              minYear = 0;
              maxKilometers = 999999;
              maxPrice = 999999; 
          }

          $.ajax({
              type: 'GET',
              url: 'trait_filtre.php',
              data: {
                  minYear: minYear,
                  maxKilometers: maxKilometers,
                  maxPrice: maxPrice
              },
              success: function(response) {
                  $('.voitures-section').html(response);
              },
              error: function(error) {
                  console.log('Erreur AJAX : ', error);
              }
          });
      }
      $('#filterButton').click(function() {
          updateAnnonces();
      });
      updateAnnonces();
  });
</script>
</html>