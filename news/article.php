<?php
include_once "../systeme/config.php";

// Vérification de la présence de l'identifiant de l'article dans l'URL
if(isset($_GET['id'])){
    // Récupération de l'identifiant de l'article depuis l'URL
    $article_id = $_GET['id'];

    // Récupération des détails de l'article à partir de la base de données
    $query = "SELECT *, DATE_FORMAT(date, '%d/%m/%y') AS date FROM articles WHERE id = $article_id";
    $result = mysqli_query($conn, $query);

    // Vérification si l'article existe dans la base de données
    if(mysqli_num_rows($result) == 1){
        // Récupération des données de l'article
        $row = mysqli_fetch_assoc($result);
        $titre = $row['titre'];
        $intro = $row['intro'];
        $contenu = $row['contenu'];
        $date = $row['date'];
        $auteur = $row['auteur'];
        $temps = $row['temps'];
        $images = explode(",", $row['images']); // Si les images sont stockées sous forme de liste de noms de fichiers séparés par des virgules

        // Affichage des détails de l'article
?>

<!DOCTYPE html>
<html lang="fr">
<head>
<script src='../js/global.js' async></script>
    <link rel="stylesheet" href="../css/site.css">
    <link rel="stylesheet" href="../css/footer.css">
    <link rel="icon" href="../img/logo_lrs.png"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../css/article.css">
    <title><?php echo $titre; ?></title>
</head>
<body>
    <?php include('../includes/nav.php'); ?>
    <main>
        
        
        <div class="buttons_box">
            <a href="actualites.php"><button>↩ Revenir aux Actualités</button></a>
            <a href="../index.php"><button>Retourner à l'Accueil</button></a>
        </div>
        <div class="title">
            <h4><?php echo $titre; ?></h4>
        </div>
        <div class="infos_box">
            <span class="text_no_show">Lisez-le en</span> <b><?php echo $temps; ?> min</b> ● Publié le <b><?php echo $date; ?></b> par <b><?php echo $auteur; ?></b>
        </div>
        <div class="article_box">
            
            <p class="intro_article">
                <?php echo $intro; ?>
            </p>
        <br>
                <p class="article">
            <?php echo $contenu; ?>
            </p>
            <?php foreach($images as $image){ ?>
                <img class="article-image" src="../images/<?php echo $image; ?>" alt="Image">
            <?php } ?>
        </div>
        
    </main>
</body>
<?php include('../includes/footer.php'); ?>
</html>

<?php
    } else {
        echo "Article non trouvé.";
    }
} else {
    echo "Identifiant d'article non spécifié.";
}
?>