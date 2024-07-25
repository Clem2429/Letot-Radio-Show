<?php
session_start();
require_once "../systeme/config.php";

// Vérifiez si l'utilisateur est un administrateur
check_admin();

$id = $_GET['id'];
$sql = "SELECT * FROM membres WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$membre = $result->fetch_assoc();
$stmt->close();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom = $_POST['nom'];
    $age = $_POST['age'];
    $statut = implode(', ', $_POST['statut']);
    $classe = $_POST['classe'];
    $description = $_POST['description'];
    
    if ($_FILES['avatar']['name']) {
        $target_dir = "../equipe/avatars/";
        $avatar = basename($_FILES["avatar"]["name"]);
        $target_file = $target_dir . $avatar;
        move_uploaded_file($_FILES["avatar"]["tmp_name"], $target_file);
    } else {
        $avatar = $membre['avatar'];
    }

    $sql = "UPDATE membres SET nom = ?, age = ?, statut = ?, classe = ?, description = ?, avatar = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sissssi", $nom, $age, $statut, $classe, $description, $avatar, $id);
    $stmt->execute();
    $stmt->close();

    header("Location: administration_membres.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../css/insertion.css">
    <title>Modification de Membre</title>
</head>
<body>
    <h2>Modification de Membre</h2>

    <a href="dashboard_admin.php"><button class="dashboard-go">Revenir au Dashboard</button></a>

    <div class="warning-admin-two">
            <p>
                <h2>Attention</h2>
                <br>
                Assurez-vous, <b><u>avant de valider</u></b> une quelconque action, qu'il s'agit <b><i>des bonnes informations</i></b>, de la bonne émission, du bon article, etc. Cela évitera <i>un surplus d'actions</i> qui auraient pu être évité...
            </p>
        </div>


    <form action="modification_membre.php?id=<?php echo $id; ?>" method="post" enctype="multipart/form-data">
        <label for="nom">Prénom :</label><br>
        <input type="text" id="nom" name="nom" value="<?php echo htmlspecialchars($membre['nom']); ?>" required><br><br>
        
        <label for="age">Âge :</label><br>
        <input type="number" id="age" name="age" value="<?php echo htmlspecialchars($membre['age']); ?>" required><br><br>
        
        <label for="statut">Statuts :</label><br><br>
        <?php
        $statuts = ["Développeur", "Webmaster", "Assistant Webmaster", "Assistante Webmaster", "Administrateur", "Administratrice", "Fondatrice LRS", "Responsable", "Responsable Studio", "Reporter", "Technicien", "Technicienne"];
        $membre_statuts = explode(', ', $membre['statut']);
        foreach ($statuts as $statut) {
            $checked = in_array($statut, $membre_statuts) ? 'checked' : '';
            echo "<input type='checkbox' name='statut[]' value='$statut' $checked> $statut<br>";
        }
        ?><br>
        
        <label for="classe">Classe :</label><br>
        <input type="text" id="classe" name="classe" value="<?php echo htmlspecialchars($membre['classe']); ?>" required><br><br>
        
        <label for="description">Description :</label><br>
        <textarea id="description" name="description"><?php echo htmlspecialchars($membre['description']); ?></textarea><br><br>
        
        <label for="avatar">Avatar :</label><br>
        <input type="file" id="avatar" name="avatar" accept="image/*"><br>
        <img src="../equipe/avatars/<?php echo htmlspecialchars($membre['avatar']); ?>" alt="Avatar" width="100"><br><br>
        
        <input type="submit" value="Modifier">
    </form>
</body>
</html>
