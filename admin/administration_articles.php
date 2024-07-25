<?php
session_start();
include_once "../systeme/config.php";

// Vérification de l'authentification de l'administrateur
check_admin();

$stmt = $conn->prepare("SELECT *, DATE_FORMAT(date, '%d/%m/%y') AS date FROM articles");
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
<link rel="icon" href="img/logo_lrs.png"/>
    <meta charset="UTF-8">
    <title>Administration des Articles</title>
</head>
<body>
    <h2>Administration des Articles</h2>
    <?php
    if (isset($_SESSION['message'])) { echo "<p style='color: green;'>".$_SESSION['message']."</p>"; unset($_SESSION['message']); }
    if (isset($_SESSION['error'])) { echo "<p style='color: red;'>".$_SESSION['error']."</p>"; unset($_SESSION['error']); }
    ?>
    <table>
        <tr>
            <th>Titre</th>
            <th>Auteur</th>
            <th>Date</th>
            <th>Actions</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()): ?>
        <tr>
            <td><?php echo $row['titre']; ?></td>
            <td><?php echo $row['auteur']; ?></td>
            <td><?php echo $row['date']; ?></td>
            <td>
                <a href="modification_article.php?id=<?php echo $row['id']; ?>">Modifier</a>
                <a href="suppression_article.php?id=<?php echo $row['id']; ?>" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet article?');">Supprimer</a>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>
    <a href="insertion_article.php">Ajouter un nouvel article</a>
</body>
</html>

<?php
$stmt->close();
$conn->close();
?>
