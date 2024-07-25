<?php
session_start();
include_once "../systeme/config.php";

// Vérification de l'authentification de l'administrateur
check_admin();

// Vérification si un ID d'article est passé en paramètre
if (isset($_GET['id'])) {
    $article_id = $_GET['id'];

    // Préparation et exécution de la requête de suppression
    $stmt = $conn->prepare("DELETE FROM articles WHERE id = ?");
    $stmt->bind_param("i", $article_id);

    if ($stmt->execute()) {
        $_SESSION['message'] = "L'article a été supprimé avec succès.";
    } else {
        $_SESSION['error'] = "Une erreur s'est produite lors de la suppression de l'article.";
    }

    $stmt->close();
    $conn->close();

    header('Location: administration_articles.php');
    exit;
} else {
    $_SESSION['error'] = "Aucun ID d'article fourni.";
    header('Location: administration_articles.php');
    exit;
}
?>
