<?php
require_once "../systeme/config.php";

if (!isset($_GET['pseudo'])) {
    die('Pseudo invalide.');
}

$current_user_pseudo = $_SESSION['pseudo'];

$pseudo = $_GET['pseudo'];

$stmt = $conn->prepare("SELECT * FROM users WHERE pseudo = ?");
$stmt->bind_param("s", $pseudo);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

if (!$user) {
    echo "Utilisateur non trouvé.";
    exit();
}

$is_owner = $current_user_pseudo === $pseudo || $_SESSION['admin'] == 1;
?>

<!DOCTYPE html>
<html lang="fr">
<head>
<meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="../css/profil.css">
    <meta charset="UTF-8">
    <link rel="icon" href="img/logo_lrs.png"/>
    <title>Profil de <?php echo htmlspecialchars($user['pseudo']); ?></title>
</head>
<body>
<a class="link-house" href="../index.php">Revenir à l'Accueil</a>
<?php if ($is_owner): ?>
        <div class="profile-actions">
            <h2>Gérer mon Compte</h2>
            <a href="modif_profil.php">Modifier mon profil</a>
            <br>
            <a href="modif_profil_mdp.php">Modifier mon Mot de Passe</a>
            <br>
            <a href="suppression.php">Supprimer mon profil</a>
            <br>
            <a href="deconnexion.php">Déconnexion</a>
            <br>
        </div>
        <?php endif; ?>
    <div class="profil">
        <img width="100px" height="100px" src="<?php echo htmlspecialchars($user['pdp']); ?>" alt="Photo de profil">
        <h1 class="pseudo"><?php echo htmlspecialchars($user['pseudo']); ?></strong></h1>
        <hr>
        <br>
        <p><strong><?php echo htmlspecialchars($user['statuts']); ?></strong></p>
        <br><br>
        <p><strong>Âge :</strong> <?php echo htmlspecialchars($user['age']); ?> ans</p>
        <p><strong>Classe :</strong> <?php echo htmlspecialchars($user['classe']); ?></p>
        <br>
        <p><strong>Description :</strong><br></p><br>
         <p class="block-description"><?php echo nl2br(htmlspecialchars($user['description'])); ?></p>
    </div>
    <aside>
        <h2>Liens</h2>
            <?php
            $liens = explode(",", $user['liens']);
            if (!empty($liens[0])) {
                echo "<ul>";
                foreach ($liens as $lien) {
                    echo "<li><a href=\"" . htmlspecialchars($lien) . "\">" . htmlspecialchars($lien) . "</a></li>";
                }
                echo "</ul>";
            } else {
                echo "<p>Aucun lien fourni.</p>";
            }
            ?>
    </aside>
</body>
</html>

<?php
$stmt->close();
$conn->close();
?>