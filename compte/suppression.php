<?php
session_start();
require_once "../systeme/config.php";


if (!isset($_SESSION['id'])) {
    header("Location: connexion.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT password FROM users WHERE id = ?");
    $stmt->bind_param("i", $_SESSION['id']);
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($hash);
    $stmt->fetch();

    if (password_verify($password, $hash)) {
        $stmt->close();
        $stmt = $conn->prepare("DELETE FROM users WHERE id = ?");
        $stmt->bind_param("i", $_SESSION['id']);
        $stmt->execute();
        session_destroy();
        header("Location: inscription.php");
        exit();
    } else {
        echo "Mot de passe incorrect.";
    }
    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html>
<head>
<link rel="icon" href="img/logo_lrs.png"/>
<meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="../css/suppression.css">
    <meta charset="UTF-8">
    <title>Suppression de compte</title>
</head>
<body>
    <form action="suppression.php" method="post">
    <h2>Supprimer mon Compte</h2>

    <p class="info">La suppression de votre compte est définitive est ne peut être annulée après validation de celle-ci.
        <br>
        Toutes vos données seront supprimées, et aucune ne sera sauvegardée à l'exception de l'email si nous vous avons déjà envoyé un email.
    </p>
<br><br>
        <p class="info-label">Entrez votre mot de passe</p>
        <input type="password" name="password" placeholder="Votre mot de passe actuel" required><br><br>
        <input type="submit" value="Supprimer le compte">
        <br><br>
        <a class="link-mdp" href="mdp_email.php">Mot de passe oublié ?</a>
    </form>
    
</body>
</html>