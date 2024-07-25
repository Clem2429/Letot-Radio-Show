<?php
session_start();
require_once "../systeme/config.php";

// Vérifiez si l'utilisateur est connecté et a les permissions nécessaires
check_admin();

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "DELETE FROM users WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->close();

    header("Location: administration_utilisateurs.php");
    exit();
} else {
    header("Location: administration_utilisateurs.php");
    exit();
}
?>
