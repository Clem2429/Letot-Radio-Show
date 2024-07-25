<?php
session_start();
require_once "../systeme/config.php";

// Vérifiez si l'utilisateur est un administrateur
check_admin();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom = $_POST['nom'];
    $age = $_POST['age'];
    $statut = implode(', ', $_POST['statut']);
    $classe = $_POST['classe'];
    $description = $_POST['description'];
    
    $target_dir = "../equipe/avatars/";
    $avatar = basename($_FILES["avatar"]["name"]);
    $target_file = $target_dir . $avatar;
    move_uploaded_file($_FILES["avatar"]["tmp_name"], $target_file);

    $sql = "INSERT INTO membres (nom, age, statut, classe, description, avatar) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sissss", $nom, $age, $statut, $classe, $description, $avatar);
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
    <title>Insertion de Membre</title>
</head>
<body>
    <h2>Insertion de Membre</h2>

    <a href="dashboard_admin.php"><button class="dashboard-go">Revenir au Dashboard</button></a>

    <div class="warning-admin-two">
            <p>
                <h2>Attention</h2>
                <br>
                Assurez-vous, <b><u>avant de valider</u></b> une quelconque action, qu'il s'agit <b><i>des bonnes informations</i></b>, de la bonne émission, du bon article, etc. Cela évitera <i>un surplus d'actions</i> qui auraient pu être évité...
            </p>
        </div>

        
    <form action="insertion_membres.php" method="post" enctype="multipart/form-data">
        <label for="nom">Nom:</label><br>
        <input type="text" id="nom" name="nom" placeholder="Entrez le prénom du membre" required><br><br>
        
        <label for="age">Âge:</label><br>
        <input type="number" id="age" name="age" placeholder="Entrez l'âge du membre" required><br><br>
        
        <label for="statut">Statut:</label><br>
        <input type="checkbox" name="statut[]" value="Développeur"> Développeur<br>
        <input type="checkbox" name="statut[]" value="Webmaster"> Webmaster<br>
        <input type="checkbox" name="statut[]" value="Assistant Webmaster"> Assistant Webmaster<br>
        <input type="checkbox" name="statut[]" value="Assistante Webmaster"> Assistante Webmaster<br>
        <input type="checkbox" name="statut[]" value="Administrateur"> Administrateur<br>
        <input type="checkbox" name="statut[]" value="Administratrice"> Administratrice<br>
        <input type="checkbox" name="statut[]" value="Fondatrice LRS"> Fondatrice LRS<br>
        <input type="checkbox" name="statut[]" value="Responsable"> Responsable<br>
        <input type="checkbox" name="statut[]" value="Responsable Studio"> Responsable Studio<br>
        <input type="checkbox" name="statut[]" value="Reporter"> Reporter<br>
        <input type="checkbox" name="statut[]" value="Technicien"> Technicien<br>
        <input type="checkbox" name="statut[]" value="Technicienne"> Technicienne<br><br>
        
        <label for="classe">Classe:</label><br>
        <input type="text" id="classe" name="classe" placeholder="6e / 5e / 4e / 3e / Prof..." required><br><br>
        
        <label for="description">Description:</label>
        <textarea id="description" name="description" placeholder="Entrez la description du membre"></textarea><br><br>
        
        <label for="avatar">Avatar:</label>
        <input type="file" id="avatar" name="avatar" accept="image/*"><br><br>
        
        <input type="submit" value="Insérer">
    </form>
</body>
</html>
