<?php
session_start();
require_once "../systeme/config.php";

if (!isset($_SESSION['id'])) {
    header("Location: connexion.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $ancien_password = $_POST['ancien_password'];
    $nouveau_password = password_hash($_POST['nouveau_password'], PASSWORD_BCRYPT);

    $stmt = $conn->prepare("SELECT password FROM users WHERE id = ?");
    $stmt->bind_param("i", $_SESSION['id']);
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($hash);
    $stmt->fetch();

    if (password_verify($ancien_password, $hash)) {
        $stmt->close();
        $stmt = $conn->prepare("UPDATE users SET password = ? WHERE id = ?");
        $stmt->bind_param("si", $nouveau_password, $_SESSION['id']);
        $stmt->execute();
        echo "Mot de passe mis à jour avec succès.";
    } else {
        echo "Ancien mot de passe incorrect.";
    }
    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="../css/mdp_email.css">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta charset="UTF-8">
    <link rel="icon" href="img/logo_lrs.png"/>
    <title>Modifier le mot de passe</title>
</head>
<body>
    <form action="modif_profil_mdp.php" method="post">
        Ancien mot de passe: <input type="password" name="ancien_password" placeholder="Votre ancien mot de passe" required><br><br>
        Nouveau mot de passe: <input type="password" name="nouveau_password" placeholder="Votre nouveau mot de passe" required><br><br>
        Confirmation du nouveau mot de passe: <input type="password" name="confirmation" placeholder="Confirmer le nouveau mot de passe"><br><br>
        <input type="submit" value="Mettre à jour">
    </form>
</body>
</html>