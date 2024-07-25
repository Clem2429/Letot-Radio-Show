<?php
include_once "../systeme/config.php";

// Récupération de tous les articles du plus récent au plus ancien
$result = mysqli_query($conn, "SELECT id, titre, intro, auteur, temps, DATE_FORMAT(date, '%d/%m/%y') AS date FROM articles ORDER BY date DESC");

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
    <link rel="stylesheet" href="../css/actualites.css">
    <title>Actualités</title>
</head>
<body>
    <?php include('../includes/nav.php'); ?>
    <main>
    
    <details class="info-page-box" open>
    <summary class="summary-info-page">Découvrez nos actualités !</summary>
    <br>
    <summary class="summary-info-page">
        Vous avez accès depuis cette page à tous nos articles. Certains détaillent des évènements marquants qu'il y a eu    à   Bayeux où en France et d'autres, la plupart, sont là pour vous présenter les différents projets que nous avons menés, que nous menons et que nous mènerons. 
        <br>
        Vous pourrez ainsi en apprendre plus sur l'organisation de la LRS, sur ce qui s'y passe et sur la façon dont nos Reporters et nos techiciens travaillent et se partagent les tâches. 
        <br><br>
        <b>Si vous souhaitez <i>lire un article</i>, il vous suffit de cliquer sur "<u>Lire l'Article →</u>".</b>
    </summary>
</details>


    <div class="container-articles">
        <?php while ($row = mysqli_fetch_assoc($result)) { ?>

            <div class="box-article">
                <span class="flex-line">
                    <p class="read-time">5 min</p>
                    <p class="space"></p>
                    <p class="new">NOUVEAU</p>
                </span>
                <h2 class="titre-article-box"><?php echo $row['titre']; ?></h2>
                <hr>
                <br>
                <p class="intro"><?php echo $row['intro']; ?></p>
                <br>
                <a href="article.php?id=<?php echo $row['id']; ?>"><button>Lire l'Article →</button></a>
                <br><br>
                <p class="info-text">Publié le <?php echo $row['date']; ?> par <?php echo $row['auteur']; ?></p>
  </div>

        <?php } ?>
    </div>
        </main>
</body>
<?php include('../includes/footer.php'); ?>
</html>