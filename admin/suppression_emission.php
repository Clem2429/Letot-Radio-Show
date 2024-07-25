<?php
include_once '../systeme/config.php';
check_admin();

$id = $_GET['id'];

$sql = "DELETE FROM emissions WHERE id=$id";

if ($conn->query($sql) === TRUE) {
    echo "Émission supprimée avec succès";
} else {
    echo "Erreur: " . $conn->error;
}

$conn->close();
?>
