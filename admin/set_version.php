<?php
include_once "../systeme/config.php";

check_dev();

$message = "";
$message_type = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $version = $_POST['version'];

    // Mettre à jour la version actuelle dans la base de données
    $stmt = $conn->prepare("UPDATE version SET version = ? WHERE id = 1");
    $stmt->bind_param('s', $version);

    if ($stmt->execute()) {
        $message = "La version a été mise à jour avec succès.";
        $message_type = "success";
    } else {
        $message = "Erreur : " . $stmt->error;
        $message_type = "error";
    }

    $stmt->close();
}

// Récupérer la version actuelle de la base de données
$query = "SELECT version FROM version WHERE id = 1";
$result = $conn->query($query);
$current_version = "1.0.0"; // Version par défaut

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $current_version = $row['version'];
}

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
<link rel="icon" href="img/logo_lrs.png"/>
    <title>Mettre à jour la version</title>
    <style>
        .message {
            padding: 10px;
            margin-bottom: 20px;
            border-radius: 5px;
        }
        .message.success {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }
        .message.error {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }
    </style>
</head>
<body>
    <h1>Mettre à jour la version</h1>
    <p>Version actuelle : <strong><?php echo htmlspecialchars($current_version); ?></strong></p>
    <?php if (!empty($message)): ?>
        <div class="message <?php echo $message_type; ?>">
            <?php echo htmlspecialchars($message); ?>
        </div>
    <?php endif; ?>
    <form action="set_version.php" method="post">
        <label for="version">Nouvelle version:</label>
        <input type="text" id="version" name="version" value="<?php echo htmlspecialchars($current_version); ?>" required>
        <input type="submit" value="Mettre à jour">
    </form>
</body>
</html>
