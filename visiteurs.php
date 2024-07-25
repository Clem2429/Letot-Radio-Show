<?php
session_start();
require_once "systeme/config.php";

// Nettoyer les sessions expirées (inactives depuis plus de 5 minutes)
$sql = "DELETE FROM active_sessions WHERE last_activity < NOW() - INTERVAL 5 MINUTE";
$conn->query($sql);

// Insérer ou mettre à jour la session active
$session_id = session_id();
$user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : NULL;
$sql = "INSERT INTO active_sessions (session_id, user_id, last_activity) VALUES (?, ?, NOW())
        ON DUPLICATE KEY UPDATE user_id = VALUES(user_id), last_activity = NOW()";
$stmt = $conn->prepare($sql);
$stmt->bind_param("si", $session_id, $user_id);
$stmt->execute();
$stmt->close();

// Compter le nombre de sessions actives
$sql = "SELECT COUNT(*) as online_users FROM active_sessions";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
$online_users = $row['online_users'];

// Compter le nombre de sessions actives avec user_id non NULL (utilisateurs inscrits)
$sql = "SELECT COUNT(*) as registered_online_users FROM active_sessions WHERE user_id IS NOT NULL";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
$registered_online_users = $row['registered_online_users'];
?>

    <p style="color: grey; text-align: right; font-size: 0.9em"><?php echo $online_users; ?> Visiteur(s)&emsp;</p>
