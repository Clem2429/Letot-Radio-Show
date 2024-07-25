<?php
require_once "../systeme/config.php";

$result = $conn->query("SELECT * FROM emission_star LIMIT 1");
$emission_star = $result->fetch_assoc();

$sql = "SELECT lien FROM emission_star LIMIT 1";
if ($result = $conn->query($sql)) {
    if ($row = $result->fetch_assoc()) {
        $lienEmissionStar = $row['lien'];
    } else {
        $lienEmissionStar = "Aucune émission star trouvée.";
    }
    $result->free();
} else {
    echo "Erreur de requête : " . $conn->error;
    exit;
}



// Fonction pour formater la date en français
function formatDateToFrench($date) {
    setlocale(LC_TIME, 'fr_FR.UTF-8');
    return strftime('%d/%m/%Y', strtotime($date));
}

$sql = "SELECT COUNT(*) as total_2024 FROM emissions WHERE annee = 2024";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
$total_2024 = $row['total_2024'];

$sql = "SELECT COUNT(*) as total_2023 FROM emissions WHERE annee = 2023";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
$total_2023 = $row['total_2023'];

$conn->close();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
<script src='../js/global.js' async></script>
    <link rel="stylesheet" href="../css/site.css">
    <link rel="stylesheet" href="../css/footer.css">
    <link rel="icon" href="../img/logo_lrs.png"/>
    
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/nos-emissions.css">
    <title>Nos Emissions</title>
</head>
<body>

    <?php include('../includes/nav.php'); ?>
    <main>


        <section class="section_diagonale">
            <h1><?php echo htmlspecialchars($emission_star['titre']); ?></h1>
            <div class="container_infos">

                <div class="box_info">
                </div>
                <div class="box_info">
                    <span class="line_info"><img src="../img/chronometre.png" height="25" width="25" alt="Durée"><?php echo htmlspecialchars($emission_star['duree']); ?>&nbsp;min</span>
                </div>
                <div class="box_info">
                    <span class="line_info"><img src="../img/date.png" height="25" width="25" alt="Date"><?php echo htmlspecialchars(formatDateToFrench($emission_star['date'])); ?></span>
                </div>
                <div class="box_info">
                    <span class="line_info"><img src="../img/langue.png" height="25" width="25" alt="Langue"><?php echo htmlspecialchars($emission_star['langue']); ?></span>
                </div>
                <div class="box_info">
                </div>
            </div>

            <a href="<?php echo htmlspecialchars($lienEmissionStar); ?>"><button>Ecouter l'Emission Star</button></a>
        </section>






        <section>

            <!-- Box 2023-2024  -->

            <div class="container_emissions_presentation">
                <div class="box_presentation">
                    <br>
                    <div class="section_logo section_2324"><img class="logo_lrs" src="../img/logo_lrs.png" alt="logo LRS"></div>
                    <p class="list_details_pages">
                        <br>
                        ↪ <strong><?php echo $total_2024; ?></strong> Emissions disponibles <br>
                    </p>
                    <a href="emissions.php?annee=2024"><button class="button_box_present_emission button_2324">Année 2023-2024</button></a>
                </div>

            <!-- Box 2022-2023 -->

            <div class="box_presentation">
                <br>
                    <div class="section_logo"><img class="logo_lrs" src="../img/logo_lrs.png" alt="logo LRS"></div>
                    <p class="list_details_pages list_2223">
                        <br>
                        ↪ <strong><?php echo $total_2023; ?></strong> Emissions disponibles <br>
                    </p>
                    <a href="emissions.php?annee=2023"><button class="button_box_present_emission button_2223">Année 2022-2023</button></a>
                </div>
                
            <!-- Box 2021-2022 -->
                
                <div class="box_presentation">
                    <br>
                    <div class="section_logo"><img class="logo_lrs" src="../img/logo_lrs.png" alt="logo LRS"></div>
                    <p class="list_details_pages list_2122">
                        <br>
                        ↪ <strong>0</strong> Emissions disponibles<sup class="case_info" title="Aucune émission n'est disponible pour le moment">?</sup> <br>
                    </p>
                    <a href="emissions.php?annee=2022"><button disabled title="Aucune émission n'est actuellement disponible" class="button_box_present_emission button_2122">Année 2021-2022</button></a>
                </div>
            </div>



<br><br>


    </section>
    </main>

    <?php include('../includes/footer.php'); ?>
    
</body>
</html>