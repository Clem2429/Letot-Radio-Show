<?php
session_start();
include_once '../systeme/config.php';

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
      $pdpPath = "https://letotradioshow.fr/img/utilisateur.png";
  }

  // Fermer la requête
  $stmt->close();
}
?>

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
            <li><a href="https://letotradioshow.fr/site/mises_a_jour.php">Mises à Jour</a></li>
            <li><a href="https://letotradioshow.fr/site/plan_du_site.php">Plan du Site</a></li>
            <li><a href="https://letotradioshow.fr/page_indispo.php">CGU</a></li>
            <li><a href="https://letotradioshow.fr/page_indispo.php">Mentions Légales</a></li>
          </ul>
        </li>
        
        <li class="li-dropdown">
          <a class="nvimg" href="#"><img class="nav_icon" alt="<?php echo $pseudo; ?>" src="<?php echo $pdpPath; ?>"><sup></sup> &ensp;▼</a>
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

  </details>

  

    <!-- GO TOP -->

    <button aria-label="Remonter tout en haut de la page" id="back-to-top">
        <img src="https://letotradioshow.fr/img/go-top.png" alt="Remonter en haut de la page, icone fléchée.">
      </button>
