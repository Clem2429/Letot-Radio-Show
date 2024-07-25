<?php
session_start();
check_admin();

include_once '../systeme/config.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "SELECT * FROM emissions WHERE id = ?";
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows == 1) {
            $emission = $result->fetch_assoc();
        } else {
            echo "Émission non trouvée.";
            exit;
        }
    } else {
        echo "Erreur de préparation de la requête : " . $conn->error;
        exit;
    }
} else {
    echo "ID d'émission manquant.";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $titre = $_POST['titre'];
    $description = $_POST['description'];
    $langue = isset($_POST['langue']) ? implode(', ', $_POST['langue']) : '';
    $duree = $_POST['duree'];
    $sons = $_POST['sons'];
    $invites = $_POST['invites'];
    $traduction = isset($_POST['traduction']) ? 'Traduite' : 'Non Traduite';
    $new = isset($_POST['new']) ? 'New' : 'Non';
    $date = $_POST['date'];
    $lien = $_POST['lien'];
    $annee = $_POST['annee'];

    $sql = "UPDATE emissions SET titre = ?, description = ?, langue = ?, duree = ?, sons = ?, invites = ?, traduction = ?, new = ?, date = ?, lien = ?, annee = ? WHERE id = ?";
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("sssssssssssi", $titre, $description, $langue, $duree, $sons, $invites, $traduction, $new, $date, $lien, $annee, $id);
        if ($stmt->execute()) {
            header("location: administration_emissions.php");
            exit;
        } else {
            echo "Erreur lors de la mise à jour : " . $stmt->error;
        }
    } else {
        echo "Erreur de préparation de la requête : " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../css/insertion.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modification d'une émission</title>
</head>
<body>
    <h2>Modifier l'émission</h2>
    <form action="" method="post">
        <label for="titre">Titre:</label>
        <input type="text" id="titre" name="titre" value="<?php echo htmlspecialchars($emission['titre']); ?>" required><br>

        <label for="description">Description:</label>
        <textarea id="description" name="description" required><?php echo htmlspecialchars($emission['description']); ?></textarea><br>

        <label>Langue:</label><br>
        <?php
        $langues = ['Français', 'Anglais', 'Espagnol', 'Italien', 'Allemand'];
        $langueArray = explode(', ', $emission['langue']);
        foreach ($langues as $langue) {
            $checked = in_array($langue, $langueArray) ? 'checked' : '';
            echo '<input type="checkbox" name="langue[]" value="' . $langue . '" ' . $checked . '> ' . $langue . '<br>';
        }
        ?><br>

        <label for="duree">Durée (HH:MM):</label>
        <input type="time" id="duree" name="duree" value="<?php echo htmlspecialchars($emission['duree']); ?>" required><br>

        <label for="sons">Sons:</label>
        <textarea id="sons" name="sons" required><?php echo htmlspecialchars($emission['sons']); ?></textarea><br>

        <label for="invites">Invités:</label>
        <textarea id="invites" name="invites" required><?php echo htmlspecialchars($emission['invites']); ?></textarea><br>

        <label for="traduction">Traduction:</label>
        <input type="checkbox" id="traduction" name="traduction" <?php echo $emission['traduction'] === 'Traduite' ? 'checked' : ''; ?>><br>

        <label for="new">New:</label>
        <input type="checkbox" id="new" name="new" <?php echo $emission['new'] === 'New' ? 'checked' : ''; ?>><br>

        <label for="date">Date:</label>
        <input type="date" id="date" name="date" value="<?php echo htmlspecialchars($emission['date']); ?>" required><br>

        <label for="lien">Lien:</label>
        <input type="url" id="lien" name="lien" value="<?php echo htmlspecialchars($emission['lien']); ?>" required><br>

        <label for="annee">Année:</label>
        <input type="number" id="annee" name="annee" value="<?php echo htmlspecialchars($emission['annee']); ?>" required><br>

        <input type="submit" value="Modifier l'émission">
    </form>
</body>
</html>
