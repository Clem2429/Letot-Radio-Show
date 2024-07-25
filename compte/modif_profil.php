<?php
session_start();
require_once "../systeme/config.php";

if (!isset($_SESSION['id'])) {
    header("Location: connexion.php");
    exit();
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $prenom = $_POST['prenom'];
    $nom = $_POST['nom'];
    $pseudo = $_POST['pseudo'];
    $email = $_POST['email'];
    $age = $_POST['age'];
    $classe = $_POST['classe'];
    $description = $_POST['description'];
    $liens = implode(',', array_filter($_POST['liens']));

    // Gérer l'upload de la photo de profil
    if ($_FILES["pdp"]["name"]) {
        $target_dir = "https://letotradioshow.fr/uploads/compte/pdp/";
        $target_file = $target_dir . basename($_FILES["pdp"]["name"]);
        if (move_uploaded_file($_FILES["pdp"]["tmp_name"], $target_file)) {
            $pdp = $target_file;
        }
    } else {
        $pdp = $_POST['current_pdp'];
    }

    $stmt = $conn->prepare("UPDATE users SET prenom = ?, nom = ?, pseudo = ?, email = ?, age = ?, classe = ?, description = ?, pdp = ?, liens = ? WHERE id = ?");
    $stmt->bind_param("ssssissssi", $prenom, $nom, $pseudo, $email, $age, $classe, $description, $pdp, $liens, $_SESSION['id']);
    if ($stmt->execute()) {
        echo "Profil mis à jour avec succès.";
    } else {
        echo "Erreur: " . $stmt->error;
    }
    $stmt->close();
}

$stmt = $conn->prepare("SELECT prenom, nom, pseudo, email, age, classe, description, pdp, liens FROM users WHERE id = ?");
$stmt->bind_param("i", $_SESSION['id']);
$stmt->execute();
$stmt->bind_result($prenom, $nom, $pseudo, $email, $age, $classe, $description, $pdp, $liens);
$stmt->fetch();
$stmt->close();
$conn->close();

$liensArray = explode(',', $liens);
?>

<!DOCTYPE html>
<html>
<head>
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="../css/modif_profil.css">
    <meta charset="utf-8">
    <link rel="icon" href="img/logo_lrs.png"/>
    <title>Modifier Profil</title>
</head>
<body>
    <form action="modif_profil.php" method="post" enctype="multipart/form-data">
        <h2>Modifier votre profil</h2>
        Prénom :<br>
        <input type="text" name="prenom" value="<?php echo htmlspecialchars($prenom); ?>" required><br><br>
        Nom :<br>
        <input type="text" name="nom" value="<?php echo htmlspecialchars($nom); ?>" required><br><br>
        Pseudo :<br>
        <input type="text" name="pseudo" value="<?php echo htmlspecialchars($pseudo); ?>" required><br><br>
        Email :<br>
        <input type="email" name="email" value="<?php echo htmlspecialchars($email); ?>" required><br><br>
        Âge :<br>
        <input type="number" name="age" value="<?php echo htmlspecialchars($age); ?>" required><br><br>
        Classe : <br>
        <select name="classe" required>
            <option value="6e" <?php if($classe == '6e') echo 'selected'; ?>>6e</option>
            <option value="5e" <?php if($classe == '5e') echo 'selected'; ?>>5e</option>
            <option value="4e" <?php if($classe == '4e') echo 'selected'; ?>>4e</option>
            <option value="3e" <?php if($classe == '3e') echo 'selected'; ?>>3e</option>
            <option value="2nde" <?php if($classe == '2nde') echo 'selected'; ?>>2nde</option>
            <option value="1re" <?php if($classe == '1re') echo 'selected'; ?>>1re</option>
            <option value="Term" <?php if($classe == 'Term') echo 'selected'; ?>>Term</option>
            <option value="Parent" <?php if($classe == 'Parent') echo 'selected'; ?>>Parent</option>
            <option value="Prof" <?php if($classe == 'Prof') echo 'selected'; ?>>Prof</option>
            <option value="Personnel" <?php if($classe == 'Personnel') echo 'selected'; ?>>Personnel</option>
            <option value="Autre" <?php if($classe == 'Autre') echo 'selected'; ?>>Autre</option>
        </select><br><br>

        Description :<br>
        <textarea name="description" rows="7"><?php echo htmlspecialchars($description); ?></textarea><br><br>
        Photo de profil :<br>
        <input type="file" name="pdp" accept="image/*"><br><br>
        <input type="hidden" name="current_pdp" value="<?php echo htmlspecialchars($pdp); ?>">

        Liens :<br>
        <?php for ($i = 0; $i < 7; $i++): ?>
            <input type="url" name="liens[]" value="<?php echo isset($liensArray[$i]) ? htmlspecialchars($liensArray[$i]) : ''; ?>" placeholder="Lien <?php echo $i + 1; ?>"><br>
        <?php endfor; ?><br>
        <input type="submit" value="Mettre à jour">

    </form>
</body>
</html>
