<?php
session_start();
require_once "../systeme/config.php";

$sql = "SELECT * FROM membres";
$result = $conn->query($sql);

// Nombre de membres
$member_count = $result->num_rows;
?>

<!DOCTYPE html>
<html lang="fr">
<head>
<script src='../js/global.js' async></script>
    <link rel="stylesheet" href="../css/site.css">
    <link rel="stylesheet" href="../css/footer.css">
    <link rel="icon" href="../img/logo_lrs.png"/>
  
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../css/membres.css">
    <title>Membres</title>
</head>
<body>
    <?php include('../includes/nav.php'); ?>
  <main>
    <details open>
    <summary>Découvrez notre équipe !</summary>
    <br>
    <summary>
    Grâce à cette page, vous avez la possibilité de découvrir nos membres au complet !
            <br>
            Vous trouverez quelques informations dont une description en passant votre souris sur le point d'interrogation... 
            <br><br>
            <b>Si vous souhaitez nous rejoindre</b>, n'hésitez pas ! <br>
            <u><b><i>Rendez-vous le mardi, de 12h à 13h au CDI</i></b></u> ;)
    </summary>
</details>
    <div class="container_box">
        <?php while ($row = $result->fetch_assoc()) { ?>
            <div class="box">
                <div class="see-more_case">
        
                        <div class="btn-tooltip">
                            <button>?</button>
                            <div class="tooltip">

                                <u><?php echo htmlspecialchars($row['nom']); ?></u>
                                <br>
                                <i><?php echo htmlspecialchars($row['age']); ?> ans | <?php echo htmlspecialchars($row['classe']); ?> </i>
                                <br><br>
                                <?php echo htmlspecialchars($row['description']); ?>
                            </div>
                        </div>

                </div>
                <div class="avatar_case prenom_avatar">

                <img src="avatars/<?php echo htmlspecialchars($row['avatar']); ?>" alt="<?php echo htmlspecialchars($row['nom']); ?>" height="100%" width="auto">

                </div>
                <div class="name_case">
                <?php echo htmlspecialchars($row['nom']); ?>
                </div>
                <div class="role_case">
                <?php echo htmlspecialchars($row['statut']); ?>     
                </div>
                <hr>
                <div class="info_case info_classe">
                    <span class="classe_span"><img class="img_info" src="../img/graduation.png" alt="User" height="25px" width="auto">&nbsp;<?php echo htmlspecialchars($row['classe']); ?></span>
                </div>
                <div class="separation_point_case">
                    ●
                </div>
                <div class="info_case info_age">

                    <span class="age_span"><img class="img_info" src="../img/anniversaire.png" alt="User" height="25px" width="auto">&nbsp;<?php echo htmlspecialchars($row['age']); ?> ans</span>
                </div>
            </div>
        <?php } ?>
    </div>
<br><br><br>
</main>
<?php include('../includes/footer.php'); ?>
</body>

</html>