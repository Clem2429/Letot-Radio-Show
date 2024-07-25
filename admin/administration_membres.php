<?php
session_start();
require_once "../systeme/config.php";

// Vérifiez si l'utilisateur est un administrateur
check_admin();

$sql = "SELECT * FROM membres";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../css/insertion.css">
    <link rel="icon" href="img/logo_lrs.png"/>
    <title>Administration des Membres</title>
</head>
<body>
    <h1>Administration des Membres</h1>
    <a href="insertion_membres.php">Ajouter un nouveau membre</a>
    <table border="1">
        <tr>
            <th>Nom</th>
            <th>Âge</th>
            <th>Statut</th>
            <th>Classe</th>
            <th>Avatar</th>
            <th>Actions</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()) { ?>
            <tr>
                <td><?php echo htmlspecialchars($row['nom']); ?></td>
                <td><?php echo htmlspecialchars($row['age']); ?></td>
                <td><?php echo htmlspecialchars($row['statut']); ?></td>
                <td><?php echo htmlspecialchars($row['classe']); ?></td>
                <td><img src="../equipe/avatars/<?php echo htmlspecialchars($row['avatar']); ?>" alt="Avatar" width="50"></td>
                <td>
                    <a href="modification_membre.php?id=<?php echo $row['id']; ?>">Modifier</a>
                    <a href="suppression_membre.php?id=<?php echo $row['id']; ?>" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce membre ?');">Supprimer</a>
                </td>
            </tr>
        <?php } ?>
    </table>
</body>
</html>
