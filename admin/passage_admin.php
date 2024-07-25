<?php
session_start();
require_once "../systeme/config.php";

// Vérifiez si l'utilisateur est connecté et a les permissions nécessaires
check_admin();

if (isset($_GET['id']) && isset($_GET['status'])) {
    $id = $_GET['id'];
    $status = $_GET['status'];
    $sql = "UPDATE users SET is_admin = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $status, $id);
    $stmt->execute();
    $stmt->close();

    header("Location: administration_utilisateurs.php");
    exit();
} else {
    header("Location: administration_utilisateurs.php");
    exit();
}
?>
