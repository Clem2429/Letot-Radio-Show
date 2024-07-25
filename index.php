<?php
session_start();
include_once 'systeme/config.php';

if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true && isset($_SESSION['pseudo'])) {
  $pseudo = $_SESSION['pseudo'];
  $profil_link = "https://letotradioshow.fr/compte/profil.php?pseudo=" . urlencode($pseudo);
}

// Vérifiez si l'utilisateur est connecté
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
  // Récupérez le pseudo de l'utilisateur connecté
  $pseudo = $_SESSION['pseudo'];
  
  // Requête pour obtenir les informations de l'utilisateur
  $stmt = $conn->prepare("SELECT pdp FROM users WHERE pseudo = ?");
  $stmt->bind_param("s", $pseudo);
  $stmt->execute();
  $result = $stmt->get_result();
  $user = $result->fetch_assoc();

  if ($user && !empty($user['pdp'])) {
      // Chemin de la photo de profil
      $pdpPath = $user['pdp'];
  } else {
      // Chemin par défaut si l'utilisateur n'a pas de photo de profil
      $pdpPath = "img/utilisateur.png";
  }

  // Fermer la requête
  $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="fr">
     <head>
        <meta charset="utf-8">
        <link rel="icon" href="img/logo_lrs.png"/>
        <script src='js/global.js' async></script>
        <script src='js/timer.js' async></script>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Accueil</title>
        <link rel="stylesheet" href="css/accueil.css">
        <link rel="stylesheet" href="css/site.css">
        <link rel="stylesheet" href="css/footer.css">
        <link rel="stylesheet" href="css/countdown.css">
    </head>
    <body class="Accueil">
    <header>
    <p class="header-text">Vous avez désormais la possibilité de vous inscrire sur notre site en vous créant un compte. N'attendez pas !</p>
    <!-- <div class="buttons-header-box"> -->
    <a href="https://letotradioshow.fr/compte/inscription.php"> <button>Créer mon Compte</button> </a>
    <!-- </div> -->
  </header>
  
  <nav>
  
    <a href="https://letotradioshow.fr" class="nav-icon" aria-label="go to homepage" aria-current="page">
      <img src="https://letotradioshow.fr/img/logo_lrs.png" alt="Logo LRS">
      <span>Letot Radio Show</span>
    </a>
  
    <div class="menu-links">
      <ul>
        <li class="nav-links"><a href="https://letotradioshow.fr/index.php">Accueil<sup></sup></a></li>
        <li class="nav-links"><a href="https://letotradioshow.fr/news/actualites.php">Actualités<sup></sup><sup class="icon_new">●</sup></a></li>
        <li class="li-dropdown">
          <a href="#">Emissions<sup class="icon_new">●</sup> &ensp;▼</a>
          
          <ul class="dropdown">
            <li><a href="https://letotradioshow.fr/emissions/nos_emissions.php">Nos Emissions<sup></sup></a></li>
            <li><a href="https://letotradioshow.fr/emissions/emissions.php?annee=2024">Emissions 2023-2024<sup></sup></a></li>
            <li><a href="https://letotradioshow.fr/emissions/emissions.php?annee=2023">Emissions 2022-2023<sup></sup></a></li>
          </ul>
        </li>
        <li class="li-dropdown">
          <a href="#">À Propos<sup></sup> &ensp;▼</a>
          <ul class="dropdown">
            <li><a href="https://letotradioshow.fr/about/la_lrs.php">La LRS</a></li>
            <li><a href="https://letotradioshow.fr/equipe/membres.php">Notre Equipe</a></li>
            <li><a href="https://letotradioshow.fr/page_indispo.php">Nos Récompenses</a></li>
            <li><a href="https://letotradioshow.fr/about/nous_contacter.php">Nous Contacter</a></li>
          </ul>
        </li>
        <li class="li-dropdown">
          <a href="#">Le Site<sup></sup> &ensp;▼</a>
          <ul class="dropdown">
            <li><a href="http://localhost/letotradioshow/site/mises_a_jour.php">Mises à Jour</a></li>
            <li><a href="http://localhost/letotradioshow/site/plan_du_site.php">Plan du Site</a></li>
            <li><a href="https://letotradioshow.fr/page_indispo.php">CGU</a></li>
            <li><a href="https://letotradioshow.fr/page_indispo.php">Mentions Légales</a></li>
          </ul>
        </li>
        
        <li class="li-dropdown">
          <a class="nvimg" href="#"><img class="nav_icon" alt="Compte" src="<?php echo $pdpPath; ?>"><sup></sup> &ensp;▼</a>
          <ul class="dropdown">
            <li><a href="https://letotradioshow.fr/compte/connexion.php">Se Connecter</a></li>
            <li><a href="<?php echo $profil_link; ?>">Voir mon profil</a></li>
            <li><a href="https://letotradioshow.fr/compte/inscription.php">S'Inscrire</a></li>
            <li><a class="link-nav-logout" href="https://letotradioshow.fr/compte/deconnexion.php">Se Déconnecter</a></li>
          </ul>
          <li class="nav-links"><a class="nvimg" href="https://letotradioshow.fr/admin/dashboard_admin.php"><img class="nav_icon" alt="Mon Compte" src="https://letotradioshow.fr/img/cadenas.png"></a></li>
        </li>
      </ul>
    </div>
  
  </nav>

  <!-- <p style="color: grey; text-align: right; font-size: 0.9em"><?php include('visiteurs.php'); ?></p> -->
  
  <details class="nav-mobile">
    <summary class="principal-summary">
      <span class="flex-menu-line">
      <img class="mobile-logo" src="https://letotradioshow.fr/img/logo_lrs.png" alt="Logo Webradio">
      Letot Radio Show
      <img class="icon-nav-mobile icon-menu-burger" src="https://letotradioshow.fr/img/menu.png" alt="Menu Burger">
      <img class="icon-nav-mobile icon-menu-close" src="https://letotradioshow.fr/img/menuclose.png" alt="Fermer Menu">
    </span>
  </summary>
    <summary class="summary-mobile">&emsp;</summary>
    <summary class="first-sous-summary"><a href="https://letotradioshow.fr">Accueil</a></summary>
    <summary class="first-sous-summary"><a href="https://letotradioshow.fr/news/actualites.php">Actualités</a></summary>
        <details class="sous-nav-mobile">
          <summary class="first-sous-summary icon-summary">Mon Compte</summary>
          <summary class="sous-summary-mobile"><a href="https://letotradioshow.fr/compte/inscription.php">S'Inscrire</a></summary>
          <summary class="sous-summary-mobile"><a href="https://letotradioshow.fr/compte/connexion.php">Se Connecter</a></summary>
          <summary class="sous-summary-mobile"><a href="https://letotradioshow.fr/compte/connexion.php">Voir mon profil</a></summary>
          <summary class="sous-summary-mobile"><a href="https://letotradioshow.fr/compte/deconnexion.php">Se Déconnecter</a></summary>
        </details>
        <details class="sous-nav-mobile">
          <summary class="first-sous-summary icon-summary">Nos Émissions</summary>
          <summary class="sous-summary-mobile"><a href="https://letotradioshow.fr/emissions/nos_emissions.php">Toutes nos émissions</a></summary>
          <summary class="sous-summary-mobile"><a href="https://letotradioshow.fr/emissions/emissions.php?annee=2024">Année 2023-2024</a></summary>
          <summary class="sous-summary-mobile"><a href="https://letotradioshow.fr/emissions/emissions.php?annee=2023">Année 2022-2023</a></summary>
        </details>
        <details class="sous-nav-mobile">
          <summary class="first-sous-summary icon-summary">À Propos</summary>
          <summary class="sous-summary-mobile"><a href="https://letotradioshow.fr/about/la_lrs.php">La LRS</a></summary>
          <summary class="sous-summary-mobile"><a href="https://letotradioshow.fr/equipe/membres.php">Nos Membres</a></summary>
          <summary class="sous-summary-mobile"><a href="https://letotradioshow.fr/page_indispo.php">Nos Récompenses</a></summary>
          <summary class="sous-summary-mobile"><a href="https://letotradioshow.fr/about/nous_contacter.php">Nous Contacter</a></summary>
        </details>
        <details class="sous-nav-mobile">
          <summary class="first-sous-summary icon-summary">Le Site</summary>
          <summary class="sous-summary-mobile"><a href="https://letotradioshow.fr/about/la_lrs.php">Mises à Jour</a></summary>
          <summary class="sous-summary-mobile"><a href="https://letotradioshow.fr/equipe/membres.php">Plan du Site</a></summary>
          <summary class="sous-summary-mobile"><a href="https://letotradioshow.fr/page_indispo.php">CGU</a></summary>
          <summary class="sous-summary-mobile"><a href="https://letotradioshow.fr/about/nous_contacter.php">Mentions Légales</a></summary>
        </details>
        <summary class="first-sous-summary"><a href="https://letotradioshow.fr/admin/dashboard_admin.php">Administration</a></summary>

        <!-- <summary class="first-sous-summary"><?php include('visiteurs.php'); ?></summary> -->
  </details>

  

    <!-- GO TOP -->

    <button aria-label="Remonter tout en haut de la page" id="back-to-top">
        <img src="https://letotradioshow.fr/img/go-top.png" alt="Remonter en haut de la page, icone fléchée.">
      </button>
    <main>
    <br><br>
      <div class="info-ww-box">
        <p class="ww">Veuillez nous excuser mais la <i>Letot Radio Show</i> a récemment fait <u>évoluer son site</u> comme vous l'avez sûrement constater. 
        <br>Cependant, il n'a pas été amélioré que pour les visiteurs. Ainsi, les émissions, les membres et les articles sont encore en cours d'ajout.
          <br><strong>Ces opérations devraient prendre fin début août.</strong> <i>Merci à vous.</i></p>
</div>
<section>
                    <div class="first_container_accueil">
                        <div class="box_first_container_accueil">
                              <div class="number_presentation_accueil">31</div> 
                              <div class="text_presentation_first_accueil">Membres</div>   
                              <br><br>
                              <a href="equipe/membres.php"><button class="button_presentation_first_accueil">Découvrez notre équipe</button></a>            
                        </div>
                        <div class="box_first_container_accueil">
                              <div class="number_presentation_accueil">21</div> 
                              <div class="text_presentation_first_accueil">Emissions</div>   
                              <br><br>
                              <a href="emissions/emissions.php"><button class="button_presentation_first_accueil">Ecoutez nos émissions</button></a>            
                        </div>
                        <div class="box_first_container_accueil">
                              <div class="number_presentation_accueil">3 ans</div> 
                              <div class="text_presentation_first_accueil">de Radio</div>   
                              <br><br>
                              <a href="about/la_lrs.php"><button class="button_presentation_first_accueil">Apprenez-en plus</button></a>            
                        </div>
                    </div>
                    <section class="diagonale">
                        <h2>Découvrez notre Emission Star !</h2>
                        <a href="emissions/nos_emissions.php"><input type="button" value="Ecouter l'émission Star"></a>
                    </section>


                    <h1 class="title_bienvenue">Bienvenue !</h1>
                        <p class="text_bienvenue" >La Letot Radio Show vous souhaite la bienvenue sur son site. <br>
                            N'hésitez pas à découvrir notre site depuis notre menu !</p>
                            <br>
                    <div class="second_container_accueil">
                        <div class="box_second_container_accueil">
                                <div class="text_second_container">N'hésitez pas à découvrir nos actualités !</div>
                                <div class="paratext_second_container">Vous en apprendrez davantage sur ce que fait la LRS...</div>
                                <br><br>
                                <a href="actualites.php"><button class="button_second_container">Découvrir nos actus</button></a>
                        </div>
                        <div class="box_second_container_accueil">
                                <div class="text_second_container">N'hésitez pas à écouter notre Emission Star</div>
                                <div class="paratext_second_container">Nous y parlons sûrement des sujets actuels</div>
                                <br><br>
                                <a href="emissions/nos_emissions.php"><button class="button_second_container">Ecouter notre Emission Star</button></a>
                        </div>
                    </div>

                    <div class="third_container_accueil">
                            <h5 class="text_help_accueil" >Si vous avez une question, ou que vous rencontrez un problème, vous pouvez :</h5>
                            <br>
                        <div class="box_button_third_container">
                            <a href="nous_contacter.php"><button class="button_second_container">Nous contacter</button></a>
                          <span class="ou">ou</span>
                            <a href="page_indispo.php"><button disabled style="cursor: no-drop;" class="button_second_container">Consulter la page d'Aide</button></a>
                        </div>
                    </div>
             </main>
             <br>
    </div>    
    </body>
    <?php 
    $query = "SELECT version FROM version WHERE id = 1";
    $result = $conn->query($query);
    $current_version = "1.0.0";
    
    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $current_version = $row['version'];
    }
    
    $conn->close();
    ?>
    <footer>
      <div class="container_footer">
          <div class="box_footer">
              <h3 class="title_box_footer">Nos Dernières Emissions</h3>
                      <a class="link_last_emissions" href="https://podeduc.apps.education.fr/video/43753-ca-decolle-au-college-les-fusees/">3, 2, 1 : Mise à feu des fusées !</a>
                      <a class="link_last_emissions" href="https://podeduc.apps.education.fr/video/43768-tekitoi-les-professeurs-de-francais-allemands/">Rencontre avec les professeurs allemands</a>
                      <a class="link_last_emissions" href="https://podeduc.apps.education.fr/video/41571-ascension-mont-blanc-pour-la-lutte-contre-le-cancer/?">Gravir le Mont Blanc pour la lutte contre le cancer</a>
                      <a class="link_last_emissions" href="https://podeduc.apps.education.fr/video/41146-lrs-portes-ouvertes-2024mp3/">Les Portes Ouvertes 2024</a>
                      <a class="link_last_emissions" href="https://podeduc.apps.education.fr/video/40670-edition-speciale-de-lemission-tekitoi-noubliez-jamais-le-sergent-chef-louis-ricardou-1910-1944-compagnon-de-la-liberation/">Hommage au Sergent-Chef Louis Ricardou</a>
                    </div>
          <div class="box_footer">
              <h3 class="title_box_footer">Des Questions ?</h3>
                <div class="box_help">
                  <button class="contact_us_button"><a class="contact_us_link" href="#">Contactez-nous</a></button>
                  <button class="contact_us_button" style="cursor: no-drop;" disabled><a class="contact_us_link" style="cursor: no-drop;" href="">Page d'Aide</a></button>
                </div>
                <hr class="hr-footer">
                <h3 class="title_box_footer">Partagez le site !</h3>
                <div class="box_share">
                    <a href="https://www.facebook.com/sharer/sharer.php?u=https%3A%2F%2Fletotradioshow.fr"><img class="icons_share_footer" src="https://letotradioshow.fr/img/footer/facebook.png" alt="Facebook"></a>
                    <a href="https://twitter.com/intent/tweet?url=https%3A%2F%2Fletotradioshow.fr&text=D%C3%A9couvrez%20d%C3%A8s%20maintenant%20toutes%20les%20%C3%A9missions%20et%20les%20actualit%C3%A9s%20de%20la%20Letot%20Radio%20Show%20%C3%A0%20travers%20son%20site%20%21"><img class="icons_share_footer" src="https://letotradioshow.fr/img/footer/x.png" alt="X - Anciennement Twitter"></a>
                    <a href="https://www.linkedin.com/sharing/share-offsite/?url=https%3A%2F%2Fletotradioshow.fr"><img class="icons_share_footer" src="https://letotradioshow.fr/img/footer/linkedin.png" alt="LinkedIn"></a>
                    <a href="whatsapp://send?text=D%C3%A9couvrez%20d%C3%A8s%20maintenant%20toutes%20les%20%C3%A9missions%20et%20les%20actualit%C3%A9s%20de%20la%20Letot%20Radio%20Show%20%C3%A0%20travers%20son%20site%20%21%20%20https%3A%2F%2Fletotradioshow.fr"><img class="icons_share_footer" src="https://letotradioshow.fr/img/footer/whatsapp.png" alt="Whats'App"></a>
                    <a href="fb-messenger://share/?link=https%3A%2F%2Fletotradioshow.fr"><img class="icons_share_footer" src="https://letotradioshow.fr/img/footer/messenger.png" alt="Messenger"></a>
                    <a href="mailto:?subject=D%C3%A9couvrez%20la%20Letot%20Radio%20Show&body=D%C3%A9couvrez%20d%C3%A8s%20maintenant%20toutes%20les%20%C3%A9missions%20et%20les%20actualit%C3%A9s%20de%20la%20Letot%20Radio%20Show%20%C3%A0%20travers%20son%20site%20%21%20%20https%3A%2F%2Fletotradioshow.fr"><img class="icons_share_footer" src="https://letotradioshow.fr/img/footer/email.png" alt="Email"></a>
                    <img class="icons_share_footer  icon_display_none" id="copyButton" src="https://letotradioshow.fr/img/footer/copier.png" style="cursor: pointer;" onclick="copyText()" alt="Copier">
<div id="textToCopy" style="display:none;">Découvrez dès maintenant toutes les émissions et les actualités de la Letot Radio Show à travers son site : https://letotradioshow.fr</div>


                </div>
          </div>
      </div>
      <div class="box_buttons_site">
        <a href="https://letotradioshow.fr/emissions.php?annee=2024"><button class="button_site_footer display_none">Ecouter nos Emissions</button></a>
        <a href="https://letotradioshow.fr/mises_a_jour.php"><button class="button_version_footer">Version <?php echo htmlspecialchars($current_version); ?> - © 2024 Letot Radio Show</button></a>
        <a href="https://letotradioshow.fr/la_lrs.php"><button class="button_site_footer display_none">Qui Sommes-nous ?</button></a>
      </div>
      <div class="box_link_site_footer">
        <a class="links_site_footer" href="https://letotradioshow.fr/index.php">Accueil</a> | 
        <a class="links_site_footer" href="https://letotradioshow.fr/page_indispo.php">Mentions Légales</a> | 
        <a class="links_site_footer" href="https://letotradioshow.fr/page_indispo.php">CGU</a> | 
        <a class="links_site_footer" href="https://letotradioshow.fr/eee">Plan du Site</a> | 
        <a class="links_site_footer" href="https://letot.college.ac-normandie.fr">Site du Collège</a>
      </div>
      <div class="box_text_info_footer">
        Conçu & Designé par Clément Legoubé
      </div>
  </footer>
</html>
