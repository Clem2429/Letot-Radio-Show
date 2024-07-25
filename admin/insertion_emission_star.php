<?php
require_once '../systeme/config.php';

// Vérifiez si l'utilisateur est connecté
session_start();
check_admin();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $titre = $_POST['titre'];
    $description = $_POST['description'];
    $langue = $_POST['langue'];
    $duree = $_POST['duree'];
    $date = $_POST['date'];
    $lien = $_POST['lien'];
    $annee = $_POST['annee'];
    $membres = implode(', ', $_POST['membres']);
    $sons = $_POST['sons'];
    $invites = $_POST['invites'];
    $new = isset($_POST['new']) ? 'new' : 'non';
    $traduction = isset($_POST['traduction']) ? 'traduite' : 'non';

    // Supprimer l'ancienne émission star
    $deleteSql = "DELETE FROM emission_star";
    $conn->query($deleteSql);

    // Insérer la nouvelle émission star
    $insertSql = "INSERT INTO emission_star (titre, description, langue, duree, date, lien, annee, membres, sons, invites, new, traduction) 
                  VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($insertSql);
    $stmt->bind_param("ssssssisssss", $titre, $description, $langue, $duree, $date, $lien, $annee, $membres, $sons, $invites, $new, $traduction);

    if ($stmt->execute()) {
        echo "Nouvelle émission star insérée avec succès!";
    } else {
        echo "Erreur lors de l'insertion de l'émission star : " . $conn->error;
    }

    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../css/insertion.css">
    <link rel="icon" href="img/logo_lrs.png"/>
    <title>Insertion Émission Star</title>
</head>
<body>
    <h2>Insertion Émission Star</h2>

    <a href="dashboard_admin.php"><button class="dashboard-go">Revenir au Dashboard</button></a>

    <div class="warning-admin-two">
            <p>
                <h2>Attention</h2>
                <br>
                Assurez-vous, <b><u>avant de valider</u></b> une quelconque action, qu'il s'agit <b><i>des bonnes informations</i></b>, de la bonne émission, du bon article, etc. Cela évitera <i>un surplus d'actions</i> qui auraient pu être évité...
            </p>
        </div>
    <form method="post">
        <label>Titre :</label><br>
        <input type="text" name="titre" required><br><br>
        <label>Description :</label><br>
        <textarea name="description"></textarea><br>
        <label>Langue: 
            <input type="checkbox" name="langue" value="français" checked> Français
        </label><br><br>
        <label>Durée : <br><input type="text" name="duree"></label><br><br>
        <label>Date :<br> <input type="date" name="date"></label><br><br>
        <label>Lien :<br> <input type="text" name="lien"></label><br><br>
        <label>Année :<br> <input type="text" name="annee"></label><br><br>
        <label>Membres: <br>
            <!-- Afficher les membres sous forme de checkboxes -->
            <?php
            $result = $conn->query("SELECT id, nom FROM membres");
            while ($row = $result->fetch_assoc()) {
                echo '<input type="checkbox" name="membres[]" value="'.$row['nom'].'"> '.$row['nom'].'<br>';
            }
            ?>
        </label><br><br>
        <label>Sons : <br><textarea name="sons"></textarea></label><br><br>
        <label>Invités :<br> <textarea name="invites"></textarea></label><br><br>
        <label>New : <input type="checkbox" name="new"></label><br><br>
        <label>Traduction : <input type="checkbox" name="traduction"></label><br><br>
        <button type="submit">Insérer l'émission star</button>
    </form>
</body>
</html>
