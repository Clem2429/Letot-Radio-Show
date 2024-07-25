<?php
require_once "../systeme/config.php";

// Vérifier si le token est présent dans l'URL
if (!isset($_GET['reset_token'])) {
    die('Token invalide.');
}

$token = $_GET['reset_token'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];

    // Vérifier que les mots de passe correspondent
    if ($new_password !== $confirm_password) {
        $error_message = 'Les mots de passe ne correspondent pas.';
    } else {
        try {
            // Vérifier si le token est valide et n'a pas expiré
            $stmt = $conn->prepare("SELECT id FROM users WHERE reset_token = ?");
            $stmt->bind_param("s", $token);
            $stmt->execute();
            $result = $stmt->get_result();
            $user = $result->fetch_assoc();

            if ($user) {
                // Mettre à jour le mot de passe
                $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
                $stmt = $conn->prepare("UPDATE users SET password = ?, reset_token = NULL WHERE id = ?");
                $stmt->bind_param("si", $hashed_password, $user['id']);
                $stmt->execute();

                // Rediriger vers la page de connexion
                header("Location: connexion.php");
                exit();
            } else {
                $error_message = 'Token invalide ou expiré.';
            }
        } catch (mysqli_sql_exception $e) {
            $error_message = "Erreur de base de données : " . $e->getMessage();
        }
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
    <link rel="icon" href="img/logo_lrs.png"/>
</head>
<body>
    <h2>Réinitialisation de mot de passe</h2>
    <?php if (isset($error_message)) : ?>
        <div style="color: red;"><?php echo $error_message; ?></div>
    <?php endif; ?>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) . '?reset_token=' . $token; ?>" method="post">
        <label for="new_password">Nouveau mot de passe :</label><br>
        <input type="password" id="new_password" name="new_password" required><br><br>
        <label for="confirm_password">Confirmer le nouveau mot de passe :</label><br>
        <input type="password" id="confirm_password" name="confirm_password" required><br><br>
        <input type="submit" value="Réinitialiser le mot de passe">
    </form>
</body>
</html>
