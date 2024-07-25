<?php
require_once "../systeme/config.php";
require_once "../vendor/autoload.php"; // Chemin vers le fichier autoload.php de PHPMailer

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];

    try {
        // Vérifier si l'email existe dans la base de données
        $stmt = $conn->prepare("SELECT id FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        $user = $result->fetch_assoc();

        if ($user) {
            // Générer un token unique
            $token = bin2hex(random_bytes(32)); // Génération d'un token aléatoire

            // Mettre à jour le token dans la table users
            $stmt = $conn->prepare("UPDATE users SET reset_token = ? WHERE id = ?");
            $stmt->bind_param("si", $token, $user['id']);
            $stmt->execute();

            // Envoi de l'email avec PHPMailer
            $mail = new PHPMailer(true);

            // Paramètres SMTP
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'clement.legoube@gmail.com'; // Remplacez par votre email Gmail
            $mail->Password = 'zrmz jpmy stma czib'; // Remplacez par votre mot de passe d'application
            $mail->SMTPSecure = 'tls';
            $mail->Port = 587;

            // Destinataire
            $mail->setFrom('noreply@letotradioshow.fr', 'Letot Radio Show');
            $mail->addAddress($email);

            // Contenu de l'email
            $mail->isHTML(true);
            $mail->Subject = 'Reinitialisation de mot de passe';
            $mail->Body = "Bonjour,<br><br>Pour reinitialiser votre mot de passe, cliquez sur le lien suivant : <br><br><a href='http://localhost/letotradioshow/compte/mdp_reset.php?reset_token=$token'>Reinitialiser le mot de passe</a><br><br>Ce lien expirera dans 1 heure.<br><br>Cordialement,<br>L'Equipe de la Letot Radio Show";

            $mail->send();
            $success_message = 'Un email de réinitialisation a été envoyé à votre adresse. Veuillez vérifier votre boîte de réception.';
        } else {
            $error_message = 'Aucun utilisateur trouvé avec cet email.';
        }
    } catch (mysqli_sql_exception $e) {
        $error_message = "Erreur de base de données : " . $e->getMessage();
    } catch (Exception $e) {
        $error_message = "Erreur d'envoi d'email : " . $mail->ErrorInfo;
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <link rel="stylesheet" href="../css/mdp_email.css">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta charset="UTF-8">
    <title>Réinitialisation de mot de passe</title>
</head>
<body>
    
    
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <h2>Réinitialisation de mot de passe</h2>

        <?php if (isset($error_message)) : ?>
        <div style="color: red;"><?php echo $error_message; ?></div>
        <?php endif; ?>
        <?php if (isset($success_message)) : ?>
            <div style="color: green;"><?php echo $success_message; ?></div>
        <?php endif; ?>
        <label for="email">Entrez votre email :</label><br>
        <input type="email" id="email" name="email" placeholder="Ex: harry.potter@gmail.com" required><br><br>

        <input type="submit" value="Envoyer l'email">
                <br><br>
                <p>OU</p>
                <br>
                <a class="login-link" href="connexion.php">Connectez-vous</a>
                <br><br>
        <p>Vous n'avez pas de compte ? - <a href="inscription.php">Inscrivez-vous !</a></p>
        <a class="home-link" href="../index.php">↩ Revenir à l'Accueil</a>
    </form>
</body>
</html>
