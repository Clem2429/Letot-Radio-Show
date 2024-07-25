<?php
include_once '../systeme/config.php';

check_admin();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $titre = $conn->real_escape_string($_POST['titre']);
    $description = $conn->real_escape_string($_POST['description']);
    $langues = isset($_POST['langues']) ? implode(',', $_POST['langues']) : '';
    $duree = $conn->real_escape_string($_POST['duree']);
    $date = $conn->real_escape_string($_POST['date']);
    $lien = $conn->real_escape_string($_POST['lien']);
    $invites = $conn->real_escape_string($_POST['invites']);
    $sons = $conn->real_escape_string($_POST['sons']);
    $traduction = isset($_POST['traduction']) ? 'Traduite' : 'Non Traduite';
    $new = isset($_POST['new']) ? 'New' : 'Non';
    $annee = (int)$_POST['annee'];

    $query = "INSERT INTO emissions (titre, description, langues, duree, date, lien, invites, sons, traduction, new, annee) 
              VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($query);
    if (!$stmt) {
        die('Erreur de préparation : ' . $conn->error);
    }
    $stmt->bind_param('ssssssssssi', $titre, $description, $langues, $duree, $date, $lien, $invites, $sons, $traduction, $new, $annee);

    if ($stmt->execute()) {
        echo "Émission ajoutée avec succès.";
    } else {
        echo "Erreur lors de l'ajout de l'émission: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
    exit;
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <link rel="icon" href="img/logo_lrs.png"/>
    <link rel="stylesheet" href="../css/insertion.css">
    <title>Ajouter une émission</title>
</head>
<body>
    <h2>Ajouter une émission</h2>

    <a href="dashboard_admin.php"><button class="dashboard-go">Revenir au Dashboard</button></a>

    <div class="warning-admin-two">
            <p>
                <h2>Attention</h2>
                <br>
                Assurez-vous, <b><u>avant de valider</u></b> une quelconque action, qu'il s'agit <b><i>des bonnes informations</i></b>, de la bonne émission, du bon article, etc. Cela évitera <i>un surplus d'actions</i> qui auraient pu être évité...
            </p>
        </div>


    <form method="post">
        <label for="titre">Titre :</label><br>
        <input type="text" name="titre" id="titre" placeholder="Entrez le titre de l'émission - 10 mots max" required><br><br>
        
        <label for="description">Description :</label><br>
        <textarea name="description" id="description" placeholder="Entrez la description de l'émission" required></textarea><br><br>
        
        <label for="langues">Sélectionnez les langues présentes dans l'émission :</label><br>
        <input type="checkbox" name="langues[]" value="français"> Français<br>
        <input type="checkbox" name="langues[]" value="anglais"> Anglais<br>
        <input type="checkbox" name="langues[]" value="espagnol"> Espagnol<br>
        <input type="checkbox" name="langues[]" value="italien"> Italien<br>
        <input type="checkbox" name="langues[]" value="allemand"> Allemand<br>
        <input type="checkbox" name="langues[]" value="ukrainien"> Ukrainien<br><br>
        
        <label for="duree">Durée (hh:mm) :</label><br>
        <input type="text" name="duree" id="duree" placeholder="Sous forme minutes:secondes" required><br><br>
        
        <label for="date">Date de sortie :</label><br>
        <input type="date" name="date" id="date" required><br><br>
        
        <label for="annee">Année :</label><br>
        <input type="number" name="annee" id="annee" placeholder="2024 = 2023-2024 / 2025 = 2024/2025" required><br><br>
        
        <label for="lien">Lien :</label><br>
        <input type="url" name="lien" id="lien" placeholder="Lien menant vers l'émission sur le Pod" required><br><br>
        
        <label for="invites">Invités :</label><br>
        <textarea name="invites" id="invites" placeholder="Qui sont nos invités ? M./Mme Nom Prénom (Profession)"></textarea><br><br>
        
        <label for="sons">Sons :</label><br>
        <textarea name="sons" id="sons" placeholder="Quels sont les sons utilisés lors de cette émission ? Pas de lien."></textarea><br><br>
        
        <label for="traduction">Traduction :</label>
        <input type="checkbox" name="traduction" value="Traduite"> Traduite<br><br>
        
        <label for="new">New :</label>
        <input type="checkbox" name="new" value="New"> New<br><br>
        
        <button type="submit">Ajouter l'émission</button>
    </form>
</body>
</html>
