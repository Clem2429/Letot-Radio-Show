<?php
session_start();
include_once "../systeme/config.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $identifiant = $_POST['identifiant'];
    $password = $_POST['password'];

    // Préparation de la requête SQL pour rechercher l'utilisateur par pseudo ou email
    $stmt = $conn->prepare("SELECT id, pseudo, dev, admin, email, prenom, nom, pdp, password FROM users WHERE pseudo = ? OR email = ?");
    $stmt->bind_param("ss", $identifiant, $identifiant);
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($id, $pseudo, $dev, $admin, $email, $prenom, $nom, $pdp, $hashed_password);
    $stmt->fetch();

    // Vérification du mot de passe
    if ($stmt->num_rows > 0 && password_verify($password, $hashed_password)) {
        // Initialisation des variables de session pour l'utilisateur connecté
        $_SESSION['loggedin'] = true;
        $_SESSION['id'] = $id;
        $_SESSION['pseudo'] = $pseudo;
        $_SESSION['dev'] = $dev;
        $_SESSION['admin'] = $admin;
        $_SESSION['email'] = $email; 
        $_SESSION['prenom'] = $prenom;
        $_SESSION['nom'] = $nom;
        $_SESSION['pdp'] = $pdp;


        // Redirection vers la page d'accueil après connexion réussie
        header('Location: ../index.php');
        exit();
    } else {
        // Message d'erreur en cas de pseudo/email ou mot de passe incorrect
        $_SESSION['error'] = "Pseudo/adresse mail ou mot de passe incorrect.";
        header('Location: connexion.php');
        exit();
    }

    // Fermeture de la connexion
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
    <link rel="stylesheet" href="../css/connexion.css">
    <meta charset="utf-8">
    <title>Connexion</title>
</head>
<body>
    <form method="post" action="connexion.php">
        <h2>Connectez-vous :</h2>
        <br>
        
        <label class="label-align" for="identifiant">Pseudo ou adresse mail :</label><br>
        <input type="text" id="identifiant" name="identifiant" placeholder="John12 ou john.example@mail.com" required><br>

        <br>

        <label for="password">Mot de passe :</label><br>
        <input type="password" id="password" name="password" placeholder="Entrez votre mot de passe" required><br>
        <br>
        <input type="submit" value="Se connecter">
        <br><br>
        <a class="forgot-mdp" href="mdp_email.php">Mot de Passe oublié ?</a>
        <br><br>
        <p>Vous n'avez pas de compte ? - <a href="inscription.php">Inscrivez-vous !</a></p>
        <a class="home-link" href="../index.php">↩ Revenir à l'Accueil</a>
    </form>
</body>
</html>