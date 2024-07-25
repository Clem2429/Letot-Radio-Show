<?php
require_once "../systeme/config.php";

// Vérifier si un ID d'utilisateur est passé dans l'URL
if (!isset($_GET['id'])) {
    die('ID utilisateur non spécifié.');
}

$id = $_GET['id'];

// Vérifier si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les données du formulaire
    $prenom = $_POST['prenom'];
    $nom = $_POST['nom'];
    $email = $_POST['email'];
    $age = $_POST['age'];
    $classe = $_POST['classe'];
    $statuts = $_POST['statuts'];
    $description = $_POST['description'];
    $liens = $_POST['liens'];
    $admin = isset($_POST['admin']) ? 1 : 0;
    $dev = isset($_POST['dev']) ? 1 : 0;

    // Préparer la requête SQL pour mettre à jour l'utilisateur
    $sql = "UPDATE users SET prenom=?, nom=?, email=?, age=?, classe=?, statuts=?, description=?, liens=?, admin=?, dev=? WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssisssssii", $prenom, $nom, $email, $age, $classe, $statuts, $description, $liens, $admin, $dev, $id);

    // Exécuter la requête
    if ($stmt->execute()) {
        echo "Utilisateur mis à jour avec succès.";
    } else {
        echo "Erreur lors de la mise à jour de l'utilisateur : " . $stmt->error;
    }

    // Fermer la requête préparée
    $stmt->close();
}

// Récupérer les informations de l'utilisateur à partir de l'ID
$sql_select = "SELECT * FROM users WHERE id=?";
$stmt_select = $conn->prepare($sql_select);
$stmt_select->bind_param("i", $id);
$stmt_select->execute();
$result = $stmt_select->get_result();

if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();
} else {
    die('Utilisateur non trouvé.');
}

// Fermer la requête préparée
$stmt_select->close();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Modification de l'utilisateur <?php echo htmlspecialchars($user['pseudo']); ?></title>
</head>
<body>
    <h2>Modification de l'utilisateur <?php echo htmlspecialchars($user['pseudo']); ?></h2>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) . "?id=" . $id; ?>">
        <label for="prenom">Prénom:</label><br>
        <input type="text" id="prenom" name="prenom" value="<?php echo htmlspecialchars($user['prenom']); ?>"><br><br>

        <label for="nom">Nom:</label><br>
        <input type="text" id="nom" name="nom" value="<?php echo htmlspecialchars($user['nom']); ?>"><br><br>

        <label for="email">Email:</label><br>
        <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>"><br><br>

        <label for="age">Âge:</label><br>
        <input type="number" id="age" name="age" value="<?php echo htmlspecialchars($user['age']); ?>"><br><br>

        <label for="classe">Classe:</label><br>
        <select id="classe" name="classe">
            <option value="6e" <?php if ($user['classe'] === '6e') echo 'selected'; ?>>6e</option>
            <option value="5e" <?php if ($user['classe'] === '5e') echo 'selected'; ?>>5e</option>
            <option value="4e" <?php if ($user['classe'] === '4e') echo 'selected'; ?>>4e</option>
            <option value="3e" <?php if ($user['classe'] === '3e') echo 'selected'; ?>>3e</option>
            <option value="2nde" <?php if ($user['classe'] === '2nde') echo 'selected'; ?>>2nde</option>
            <option value="1re" <?php if ($user['classe'] === '1re') echo 'selected'; ?>>1re</option>
            <option value="Term" <?php if ($user['classe'] === 'Term') echo 'selected'; ?>>Term</option>
            <option value="Parent" <?php if ($user['classe'] === 'Parent') echo 'selected'; ?>>Parent</option>
            <option value="Prof" <?php if ($user['classe'] === 'Prof') echo 'selected'; ?>>Prof</option>
            <option value="Personnel" <?php if ($user['classe'] === 'Personnel') echo 'selected'; ?>>Personnel</option>
            <option value="Autre" <?php if ($user['classe'] === 'Autre') echo 'selected'; ?>>Autre</option>
        </select><br><br>

        <label for="statuts">Statuts:</label><br>
        <input type="text" id="statuts" name="statuts" value="<?php echo htmlspecialchars($user['statuts']); ?>"><br><br>

        <label for="description">Description:</label><br>
        <textarea id="description" name="description"><?php echo htmlspecialchars($user['description']); ?></textarea><br><br>

        <label for="liens">Liens (séparés par des virgules):</label><br>
        <input type="text" id="liens" name="liens" value="<?php echo htmlspecialchars($user['liens']); ?>"><br><br>

        <label for="admin">Admin:</label>
        <input type="checkbox" id="admin" name="admin" value="1" <?php if ($user['admin'] == 1) echo 'checked'; ?>><br><br>

        <label for="dev">Dev:</label>
        <input type="checkbox" id="dev" name="dev" value="1" <?php if ($user['dev'] == 1) echo 'checked'; ?>><br><br>

        <input type="submit" value="Enregistrer">
    </form>
</body>
</html>

<?php
// Fermer la connexion à la base de données
$conn->close();
?>