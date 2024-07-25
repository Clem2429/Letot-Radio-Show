<?php
session_start();
include_once "../systeme/config.php";

check_admin();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/dashboard_admin.css">
    <link rel="icon" href="img/logo_lrs.png"/>
    <title>Tableau de Bord - Admin</title>
</head>
<body>
    <nav>
        <!-- <br> -->
        <h1>Tableau de Bord</h1>

        <div class="link-home"><a href="../index.php">Accueil</a></div>
        <!--  -->
        <details>
            <summary class="summary-to-open">Admin | Emissions</summary>
            <summary class="summary-link-case"><a href="insertion_emissions.php">Insérer des Emissions</a></summary>
            <!-- <summary class="summary-link-case"><a href="administration_articles.php">Modification & Suppression</a></summary> -->
            <summary class="summary-link-case"><a href="../emissions/nos_emissions.php">Nos Emissions</a></summary>
            <summary class="summary-link-case"><a href="../emissions/emissions.php?annee=2024">Emissions | 2023 - 2024</a></summary>
            <summary class="summary-link-case"><a href="../emissions/emissions.php?annee=2023">Emissions | 2022 - 2023</a></summary>

        </details>
        <!--  -->
        <details>
            <summary class="summary-to-open">Admin | Emission Star</summary>
            <summary class="summary-link-case"><a href="insertion_emission_star.php">Insérer l'Emission Star</a></summary>        </details>
        <!--  -->
        <details>
            <summary class="summary-to-open">Admin | Articles</summary>
            <summary class="summary-link-case"><a href="insertion_articles.php">Insérer des Articles</a></summary>
            <summary class="summary-link-case"><a href="administration_articles.php">Modification & Suppression</a></summary>
            <summary class="summary-link-case"><a href="../news/actualites.php">Actualités</a></summary>
        </details>
        <!--  -->
        <details>
            <summary class="summary-to-open">Admin | Utilisateurs</summary>
            <summary class="summary-link-case"><a href="administration_utilisateurs.php">Modification & Suppression</a></summary>
        </details>
        <!--  -->
        <details>
            <summary class="summary-to-open">Admin | Membres</summary>
            <summary class="summary-link-case"><a href="insertion_membres.php">Insérer des Membres</a></summary>
            <summary class="summary-link-case"><a href="administration_membres.php">Modification & Suppression</a></summary>
            <summary class="summary-link-case"><a href="../equipe/membres.php">Nos Membres</a></summary>
        </details>

        <details>
            <summary class="summary-to-open">Dev</summary>
            <summary class="summary-link-case"><a href="set_version.php">Versions</a></summary>
        </details>

        <br>

        <?php
session_start();

// Afficher le nom du membre connecté
$statut = isset($_SESSION['statut']) ? $_SESSION['statut'] : '';
?>

    <p class="connected-name">Connecté en tant que <?php echo $_SESSION['prenom']; ?>&ensp; </p>
    <br>
    <a href="../compte/deconnexion.php"><button class="logout-button">Se Déconnecter</button></a>


    </nav>
    <main>

        <br>
        <div class="warning-admin-one">
            <p>
                <b>Cette page est réservée aux Admins.</b>
                    <br>
                <u>Vos codes sont personnels</u>, veuillez <i>ne pas les divulguer</i> à toute personne étrangère à l'Administration.
            </p>
        </div>

        <br><br>

        <div class="info-box">
            <p>
                <h2>Bienvenue sur le tableau de bord des Admins !</h2>
                <br>
                Si vous souhaitez accéder à une fonctionnalité, sélectionnez la page qui correspond à votre besoin dans le menu ci-joint.
                <br>
                Ces pages vous permettent l'insertion des articles, des émissions, de l'émission star et des membres de la LRS. Vous avez aussi la possibilité de les modifier ou de les supprimer. 
            </p>
        </div>

        <br><br>

        <div class="warning-admin-two">
            <p>
                <h2>Attention</h2>
                <br>
                Assurez-vous, <b><u>avant de valider</u></b> une quelconque action, qu'il s'agit <b><i>des bonnes informations</i></b>, de la bonne émission, du bon article, etc. Cela évitera <i>un surplus d'actions</i> qui auraient pu être évité...
            </p>
        </div>

    </main>
</body>
</html>


























<?php
$stmt->close();
$conn->close();
?>
