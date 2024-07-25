<?php
include_once '../systeme/config.php';

// Récupérer la version actuelle de la base de données
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