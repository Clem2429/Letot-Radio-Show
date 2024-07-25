<?php
session_start();
include_once "../systeme/config.php";

check_admin();

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['id'])) {
    $id = $_POST['id'];
    $titre = $_POST['titre'];
    $intro = $_POST['intro'];
    $contenu = $_POST['contenu'];
    $date = $_POST['date'];
    $auteur = $_POST['auteur'];
    $temps = $_POST['temps'];
    $images = $_FILES['images'];

    if ($images['name'][0]) {
        $image_paths = [];
        foreach ($images['tmp_name'] as $key => $tmp_name) {
            $file_name = basename($images['name'][$key]);
            $target_file = "../uploads/" . $file_name;
            move_uploaded_file($tmp_name, $target_file);
            $image_paths[] = $target_file;
        }
        $images_str = implode(',', $image_paths);

        $stmt = $conn->prepare("UPDATE articles SET titre = ?, intro = ?, contenu = ?, date = ?, auteur = ?, temps = ?, images = ? WHERE id = ?");
        $stmt->bind_param("sssssssi", $titre, $intro, $contenu, $date, $auteur, $temps, $images_str, $id);
    } else {
        $stmt = $conn->prepare("UPDATE articles SET titre = ?, intro = ?, contenu = ?, date = ?, auteur = ?, temps = ? WHERE id = ?");
        $stmt->bind_param("ssssssi", $titre, $intro, $contenu, $date, $auteur, $temps, $id);
    }

    if ($stmt->execute()) {
        $_SESSION['message'] = "Article modifié avec succès.";
    } else {
        $_SESSION['error'] = "Une erreur s'est produite.";
    }

    $stmt->close();
    $conn->close();

    header('Location: administration_articles.php');
    exit;
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $stmt = $conn->prepare("SELECT * FROM articles WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $article = $result->fetch_assoc();

    if (!$article) {
        $_SESSION['error'] = "Article non trouvé.";
        header('Location: administration_articles.php');
        exit;
    }
    $stmt->close();
} else {
    $_SESSION['error'] = "Aucun ID d'article fourni.";
    header('Location: administration_articles.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../css/insertion.css">
    <title>Modification d'Article</title>
</head>
<body>
    <h2>Modification de l'article</h2>
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
        <input type="hidden" name="id" value="<?php echo $article['id']; ?>">

        <label for="titre">Titre :</label><br>
        <input type="text" id="titre" name="titre" value="<?php echo $article['titre']; ?>" required><br><br>

        <label for="intro">Introduction:</label><br>
        <textarea id="intro" name="intro" required><?php echo $article['intro']; ?></textarea><br><br>


        <label for="contenu">Contenu :</label><br>
        <textarea id="contenu" name="contenu" required><?php echo $article['contenu']; ?></textarea><br><br>

        <label for="date">Date de publication :</label><br>
        <input type="date" id="date" name="date" value="<?php echo $article['date']; ?>" required><br><br>

        <label for="auteur">Auteur :</label><br>
        <input type="text" id="auteur" name="auteur" value="<?php echo $article['auteur']; ?>" required><br><br>

        <label for="temps">Temps de lecture :</label><br>
        <input type="text" id="temps" name="temps" value="<?php echo $article['temps']; ?>" required><br><br>

        <label for="images">Sélectionnez une image :</label><br>
        <input type="file" id="images" name="images[]" multiple><br><br>

        <input type="submit" value="Modifier">
    </form>
</body>
</html>

