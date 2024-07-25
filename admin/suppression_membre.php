<?php
session_start();
require_once "../systeme/config.php";

// Vérifiez si l'utilisateur est un administrateur
check_admin();

$id = $_GET['id'];
$sql = "DELETE FROM membres WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$stmt->close();

header("Location: administration_membres.php");
exit();
?>
