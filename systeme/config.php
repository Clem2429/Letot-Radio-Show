<?php
session_start();

// $servername = 'db5015914538.hosting-data.io';
// $dbname = 'dbs12971234';
// $username = 'dbu2324470';
// $password = 'LRS1944@2024-clgletot14#';

$servername = 'localhost';
$dbname = 'letotradioshow';
$username = 'root';
$password = 'root';

// Création de la connexion
$conn = new mysqli($servername, $username, $password, $dbname);

// Vérification de la connexion
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


function check_admin() {
    // Vérifier si l'utilisateur est connecté et administrateur
    if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true || $_SESSION['admin'] !== 1) {
        // Rediriger vers une page d'erreur 403 si les conditions ne sont pas remplies
        header('Location: https://letotradioshow.fr/erreurs/Erreur_403.html');
        exit; // Arrêter l'exécution du script
    }
}

function check_dev() {
    // Vérifier si l'utilisateur est connecté et administrateur
    if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true || $_SESSION['dev'] !== 1) {
        // Rediriger vers une page d'erreur 403 si les conditions ne sont pas remplies
        header('Location: https://letotradioshow.fr/erreurs/Erreur_403.html');
        exit; // Arrêter l'exécution du script
    }
}
?>
