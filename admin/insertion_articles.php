<?php
session_start();
include_once "../systeme/config.php";

check_admin();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $titre = $_POST['titre'];
    $intro = $_POST['intro'];
    $contenu = $_POST['contenu'];
    $date = $_POST['date'];
    $auteur = $_POST['auteur'];
    $temps = $_POST['temps'];
    $images = $_FILES['images'];

    $image_paths = [];
    foreach ($images['tmp_name'] as $key => $tmp_name) {
        $file_name = basename($images['name'][$key]);
        $target_file = "../uploads/" . $file_name;
        move_uploaded_file($tmp_name, $target_file);
        $image_paths[] = $target_file;
    }

    $images_str = implode(',', $image_paths);

    $stmt = $conn->prepare("INSERT INTO articles (titre, intro, contenu, date, auteur, temps, images) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssss", $titre, $intro, $contenu, $date, $auteur, $temps, $images_str);

    if ($stmt->execute()) {
        $_SESSION['message'] = "Article inséré avec succès.";
    } else {
        $_SESSION['error'] = "Une erreur s'est produite.";
    }

    $stmt->close();
    $conn->close();

    header('Location: insertion_articles.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <link rel="icon" href="img/logo_lrs.png"/>
    <link rel="stylesheet" href="../css/insertion.css">
    <title>Insertion d'Article</title>
</head>
<body>
    <h2>Insertion d'un nouvel article</h2>
    <?php
    if (isset($_SESSION['error'])) { echo "<p style='color: red;'>".$_SESSION['error']."</p>"; unset($_SESSION['error']); }
    if (isset($_SESSION['message'])) { echo "<p style='color: green;'>".$_SESSION['message']."</p>"; unset($_SESSION['message']); }
    ?>

    <a href="dashboard_admin.php"><button class="dashboard-go">Revenir au Dashboard</button></a>

    <div class="warning-admin-two">
            <p>
                <h2>Attention</h2>
                <br>
                Assurez-vous, <b><u>avant de valider</u></b> une quelconque action, qu'il s'agit <b><i>des bonnes informations</i></b>, de la bonne émission, du bon article, etc. Cela évitera <i>un surplus d'actions</i> qui auraient pu être évité...
            </p>
        </div>






    <form method="post" enctype="multipart/form-data">
        <label for="titre">Titre :</label><br>
        <input type="text" id="titre" name="titre" placeholder="Un titre court d'une dizaine de mots" required><br><br>

        <label for="intro">Introduction :</label><br>
        <textarea id="intro" name="intro" placeholder="Entrez l'introduction de l'article ici. 50 mots maximum, de préférence" required></textarea><br><br>

        <label for="contenu">Contenu :</label><br>
        <textarea id="contenu" name="contenu" placeholder="Entrez l'article ici" required></textarea><br><br>

        <label for="date">Date de publication :</label><br>
        <input type="date" id="date" name="date" required><br><br>

        <label for="auteur">Auteur :</label><br>
        <input type="text" id="auteur" name="auteur" value="Letot Radio Show" placeholder="Qui sont les auteurs ? / L'auteur ? / Par défaut : Letot Radio Show" required><br><br>

        <label for="temps">Temps de lecture :</label><br>
        <input type="text" id="temps" name="temps" placeholder="Juste mettre un nombre entier (ex: 12 / 15 / 5)" required><br><br>

        <label for="images">Sélectionnez une image :</label><br>
        <input type="file" id="images" name="images[]" multiple><br><br>

        <input type="submit" value="Insérer">
    </form>
</body>
</html>
