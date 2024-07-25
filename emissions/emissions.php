<?php
include_once '../systeme/config.php';

// Get the year from the URL, default to the current year if not set
$annee = isset($_GET['annee']) ? (int)$_GET['annee'] : date('Y');

// Fetch emissions from the database for the specific year
$query = "SELECT * FROM emissions WHERE annee = ? ORDER BY date DESC";
$stmt = $conn->prepare($query);
$stmt->bind_param('i', $annee);
$stmt->execute();
$result = $stmt->get_result();
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
    <link rel="stylesheet" href="../css/emissions.css">
    <title>Émissions <?php echo htmlspecialchars($annee); ?></title>
</head>
<body>
<?php include('../includes/nav.php'); ?>
<main>
<details class="info-page-box" open>
    <summary class="summary-info-page" >Découvrez nos émissions !</summary>
    <br>
    <summary class="summary-info-page">Grâce à cette page, vous avez accès à nos émissions.
        <br>
        Il vous est possible de les écouter en cliquant sur "<strong><u></u>Ecouter l'émission</strong>". De même, vous pouvez avoir accès aux détails de l'émission comme nos invités ou encore la description depuis le bouton "<strong><u>En Savoir +</u></strong>".
        <br>
        Pour écouter les émissions, le bouton cité ci-dessus vous mènera vers le Pod de l'Académie de Normandie, ce site ne comporte aucun risque et les liens présents sur cette page sont sécurisés. 
        <br><br>
        <strong>Nos émissions restent disponibles 24h/24h, 7j/7j ! Bonne écoute !</strong>
    </summary>
</details>
<div class="container">
    <?php while ($row = $result->fetch_assoc()) :
        $duree = substr($row['duree'], 0, 5); // Truncate duration to hh:mm
        $date_formatee = date('d/m/Y', strtotime($row['date'])); // Format the date in French style
        $langues = explode(',', $row['langues']);
    ?>


        <div class="box">
            <!-- DEBUT en-tête box -->
            <span class="line-tags">
                <div class="duree-box">
                    <p class="duree"><?php echo htmlspecialchars($duree); ?>&nbsp;min</p>
                </div>
                <div class="info-tags">
                    <?php if ($row['traduction'] === 'Traduite'): ?>
                        <p class="traduction">Traduite</p>
                    <?php endif; ?>
                    <?php if ($row['new'] === 'New'): ?>
                        <p class="new">New</p>
                    <?php endif; ?>
                </div>
            </span>
            <!-- FIN en-tête box -->

            <!-- DEBUT date -->
            <p class="date">Publiée le <?php echo htmlspecialchars($date_formatee); ?></p>
            <!-- FIN date -->

            <!-- DEBUT image -->
            <img src="../img/letot.jpg" alt="image" height="auto" width="100%">
            <!-- FIN image -->

            <!-- DEBUT case titre + hr + langues -->
            <h3 class="titre"><?php echo htmlspecialchars($row['titre']); ?></h3>
            <hr class="line-title">
            <br>
            <p class="langues"><strong>Langues :</strong><br>
                <?php foreach ($langues as $langue) : ?>
                    <img class="drapeau" src="../img/<?php echo htmlspecialchars($langue); ?>.png" alt="<?php echo htmlspecialchars($langue); ?>">
                <?php endforeach; ?>
            </p><br><br>
            <!-- FIN case titre + langues -->

            <!-- DEBUT case buttons -->
            <div class="buttons-case">
            <button class="listen-emission"><a href="<?php echo htmlspecialchars($row['lien']); ?>">Écouter l'émission</a></button>
            <button class="open-modal" data-modal="modal<?php echo ($row['id']); ?>">En Savoir +</button>
        </div>
            <!-- FIN case buttons -->
            
            <!-- DEBUT modal -->
            
            <div id="modal<?php echo ($row['id']) ; ?>" class="modal">
                <div class="modal-content" style="position: relative; top: -20%;">
                    <span class="close" data-modal="modal<?php echo ($row['id']) ; ?>">&times; Fermer</span>
                    <div class="tags-case-modal">
                    <?php if ($row['traduction'] === 'Traduite'): ?>
                        <p class="traduction-modal">Traduite</p>
                    <?php endif; ?>
                    <?php if ($row['new'] === 'New'): ?>
                        <p class="new-modal">New</p>
                    <?php endif; ?>
                    </div>
                    <br>
                    
                    <h2 class="titre-modal"><?php echo htmlspecialchars($row['titre']); ?></h2>
                    <br>
                    <div class="container-flex-modal">
                        <div class="box-flex-modal">
                            <p class="description-modal"><?php echo ($row['description']); ?></p>
                        </div>
                        <div class="box-flex-modal">
                        <p class="duree-modal">Écoutez cette émission en<br><strong><?php echo htmlspecialchars($duree); ?>&nbsp;min</strong></p>
                        <br>
                        <p class="langues-modal">Cette émission est parlée en :<br>
                            <?php foreach ($langues as $langue) : ?>
                                <img class="drapeau-modal" src="../img/<?php echo htmlspecialchars($langue); ?>.png" alt="<?php echo htmlspecialchars($langue); ?>">
                            <?php endforeach; ?>
                        </p>
                        <br>
                        <p class="invites-modal"><strong>Nos invités sont :</strong><br>
                         <?php echo ($row['invites']); ?></p>
                         <br>
                        <p class="sons-modal"><strong>Crédits :</strong><br>
                         <?php echo ($row['sons']); ?></p>
                    </div>
                            </div>
                </div>
            </div>


            <!-- FIN modal -->
            
            
        </div>

    
        
   






    <?php endwhile; ?>

</div>
</main>
<?php include('../includes/footer.php'); ?>
</body>
<script src="../js/modal-emission.js"></script>
</html>

<?php
$stmt->close();
$conn->close();
?>
