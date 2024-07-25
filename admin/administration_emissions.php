<?php
include_once '../systeme/config.php';

check_admin();

$query = "SELECT * FROM emissions ORDER BY STR_TO_DATE(date, '%d/%m/%Y') DESC";
$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../css/insertion.css">
    <link rel="icon" href="img/logo_lrs.png"/>
    <title>Administration des Émissions</title>
    <style>
        .box {
            border: 1px solid #ccc;
            padding: 15px;
            margin-bottom: 15px;
        }
    </style>
</head>
<body>
    <h1>Administration des Émissions</h1>
    <?php while ($row = $result->fetch_assoc()) : ?>
        <div class="box">
            <h2><?php echo htmlspecialchars($row['titre']); ?></h2>
            <p><strong>Description:</strong> <?php echo htmlspecialchars($row['description']); ?></p>
            <p><strong>Langue:</strong> <?php echo htmlspecialchars($row['langue']); ?></p>
            <p><strong>Durée:</strong> <?php echo htmlspecialchars($row['duree']); ?></p>
            <p><strong>Sons:</strong> <?php echo htmlspecialchars($row['sons']); ?></p>
            <p><strong>Invités:</strong> <?php echo htmlspecialchars($row['invites']); ?></p>
            <p><strong>Traduction:</strong> <?php echo ($row['traduction'] == 'Traduite') ? 'Traduite' : ''; ?></p>
            <p><strong>New:</strong> <?php echo ($row['new'] == 'New') ? 'New' : ''; ?></p>
            <p><strong>Date:</strong> <?php echo htmlspecialchars($row['date']); ?></p>
            <p><strong>Lien:</strong> <a href="<?php echo htmlspecialchars($row['lien']); ?>"><?php echo htmlspecialchars($row['lien']); ?></a></p>
            <a href="modification_emission.php?id=<?php echo $row['id']; ?>">Modifier</a> | 
            <a href="suppression_emission.php?id=<?php echo $row['id']; ?>" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette émission ?');">Supprimer</a>
        </div>
    <?php endwhile; ?>
</body>
</html>

<?php
$conn->close();
?>
