<?php
include_once '../systeme/config.php';
?>
<!DOCTYPE html>
<html lang="fr">
     <head>
        <meta charset="utf-8">
        <link rel="icon" href="../img/logo_lrs.png"/>
        <script src='../js/global.js' async></script>
        <script src='../js/mises_a_jour.js' async></script>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Accueil</title>
        <link rel="stylesheet" href="../css/mises_a_jour.css">
        <link rel="stylesheet" href="../css/site.css">
        <link rel="stylesheet" href="../css/footer.css">
        <link rel="stylesheet" href="../css/countdown.css">
    </head>
    <body class="Accueil">
        <?php include('../includes/nav.php'); ?>

    <main>
        <div class="tab">
            <button class="tablinks" onclick="openTab(event, 'Tab1')">Version Actuelle</button><br>
            <button class="tablinks" onclick="openTab(event, 'Tab2')">Versions à Venir</button>
            <!-- <button class="tablinks" onclick="openTab(event, 'Tab3')">2004</button> -->
          </div>
          
          <div id="Tab1" class="tabcontent">

          <div class="version_box">
                <h2>Version 1.0.0</h2>

                <br><br>

                <h3>Fonctionnalités Actuelles :</h3>

                <br>

                <ul>
                  <li>Ecouter nos émissions</li>
                  <li>Accéder à nos actualités</li>
                  <li>Ecouter notre Emission Star</li>
                  <li>Télécharger notre émission Star</li>
                  <li>Copier le lien de notre Emission Star</li>
                  <li>Partager notre site sur différents réseaux sociaux</li>
                  <li>Nous contacter</li>
                  <li>Voir le temps qui nous sépare du 6 Juin 2024</li>
                  <li>Découvrir la LRS</li>
                  <li>Découvrir notre équipe</li>
                </ul>
                
                <br><br>
                <br><br>
              
                    <h3>Pages Actuelles :</h3>

                    <br>

                      <ul>
                        <li><a href="index.php">Accueil</a></li>
                        <li><a href="actualites.php">Actualités</a></li>
                        <li><a href="new_article.php">Article 1</a></li>
                        <li><a href="emissions.php">Nos Emissions</a></li>
                        <li><a href="emission_star.php">Notre Emission Star</a></li>
                        <li><a href="annee_22-23.php">Emissions 2022-2023</a></li>
                        <li><a href="annee_23-24.php">Emissions 2023-2024</a></li>
                        <li><a href="la_lrs.php">La LRS</a></li>
                        <li><a href="nos_membres.php">Notre Equipe</a></li>
                        <li><a href="nous_contacter.php">Nous Contacter</a></li>
                        <li><a href="plan_du_site.php">Plan du Site</a></li>
                        <li><a href="mises_a_jour">Mises à Jour - Encore Incomplètes</a></li>
                        <li><a href="page_indispo.php">Page d'Indisponibilité</a></li>
                        <li><a href="service_indisponible.php">Page Service Indisponible</a></li>
                      </ul>

                <br>
                <p class="date_publication">Version publiée le 26/04/2024.</p>
              </div>


          </div>

<!-- MODIFICATIONS A VENIR -->
          
          <div id="Tab2" class="tabcontent">

          <div class="version_box">
                <h2>Version à Venir</h2>

                <br><br>

                <h3>Modifications qui seront Apportées :</h3>

                <br>

                <ul>
                  <li></li>
                  <li></li>
                  <li></li>
                  <li></li>
                  <li></li>
                  <li></li>
                  <li></li>
                  <li></li>
                  <li></li>
                  <li></li>
                </ul>
                
                <br><br>
<br><br>
                <div class="container">

                  <div class="box">

                    <h3>Pages qui seront Ajoutées :</h3>

                    <br>

                      <ul>
                        <li></li>
                        <li></li>
                        <li></li>
                        <li></li>
                        <li></li>
                        <li></li>
                        <li></li>
                        <li></li>
                        <li></li>
                        <li></li>
                      </ul>

                  </div>
                  <div class="box">

                  <h3>Pages qui seront Supprimées :</h3>

                  <br>

                      <ul>
                        <li></li>
                        <li></li>
                        <li></li>
                        <li></li>
                        <li></li>
                        <li></li>
                        <li></li>
                        <li></li>
                        <li></li>
                        <li></li>
                      </ul>

                  </div>

                </div>
<br><br>
                <div class="container">

                  <div class="box">

                    <h3>Fonctionnalités qui seront Ajoutées :</h3>

                    <br>

                      <ul>
                        <li></li>
                        <li></li>
                        <li></li>
                        <li></li>
                        <li></li>
                        <li></li>
                        <li></li>
                        <li></li>
                        <li></li>
                        <li></li>
                      </ul>

                  </div>
                  <div class="box">

                  <h3>Fonctionnalités qui seront Supprimées :</h3>

                  <br>

                      <ul>
                        <li></li>
                        <li></li>
                        <li></li>
                        <li></li>
                        <li></li>
                        <li></li>
                        <li></li>
                        <li></li>
                        <li></li>
                        <li></li>
                      </ul>

                  </div>

                </div>

                <br>
                <p class="date_publication">Cette version devrait être publiée le 26/04/2024.</p>
              </div>

          </div>
          
          <!-- <div id="Tab3" class="tabcontent"></div> -->








</main>
    <?php include('../includes/footer.php'); ?>
       </body>
</html>
