<?php
session_start();
require_once "../systeme/config.php";

check_admin();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['delete_user'])) {
        $user_id = $_POST['user_id'];
        $stmt = $conn->prepare("DELETE FROM users WHERE id = ?");
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
    } elseif (isset($_POST['promote_user'])) {
        $user_id = $_POST['user_id'];
        $stmt = $conn->prepare("UPDATE users SET admin = 1 WHERE id = ?");
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
    } elseif (isset($_POST['demote_user'])) {
        $user_id = $_POST['user_id'];
        $stmt = $conn->prepare("UPDATE users SET admin = 0 WHERE id = ?");
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
    }
}

$result = $conn->query("SELECT id, prenom, nom, pseudo, email, age, classe, statut, description, pdp, liens, admin, dev, date_creation FROM users");

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
<link rel="icon" href="img/logo_lrs.png"/>
    <title>Administration des Utilisateurs</title>
</head>
<body>
    <h1>Administration des Utilisateurs</h1>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Prénom</th>
            <th>Nom</th>
            <th>Pseudo</th>
            <th>Email</th>
            <th>Âge</th>
            <th>Classe</th>
            <th>Statut</th>
            <th>Description</th>
            <th>Photo de Profil</th>
            <th>Liens</th>
            <th>Admin</th>
            <th>Dev</th>
            <th>Date de Création</th>
            <th>Actions</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?php echo $row['id']; ?></td>
                <td><?php echo htmlspecialchars($row['prenom']); ?></td>
                <td><?php echo htmlspecialchars($row['nom']); ?></td>
                <td><?php echo htmlspecialchars($row['pseudo']); ?></td>
                <td><?php echo htmlspecialchars($row['email']); ?></td>
                <td><?php echo htmlspecialchars($row['age']); ?></td>
                <td><?php echo htmlspecialchars($row['classe']); ?></td>
                <td><?php echo htmlspecialchars($row['statut']); ?></td>
                <td><?php echo htmlspecialchars($row['description']); ?></td>
                <td><img src="<?php echo htmlspecialchars($row['pdp']); ?>" alt="Photo de profil" width="50" height="50"></td>
                <td><?php echo htmlspecialchars($row['liens']); ?></td>
                <td><?php echo $row['admin'] == 1 ? 'Oui' : 'Non'; ?></td>
                <td><?php echo $row['dev'] == 1 ? 'Oui' : 'Non'; ?></td>
                <td><?php echo htmlspecialchars($row['date_creation']); ?></td>
                <td>
                    <form action="administration_utilisateurs.php" method="post">
                        <input type="hidden" name="user_id" value="<?php echo $row['id']; ?>">
                        <input type="submit" name="delete_user" value="Supprimer">
                        <?php if ($row['admin'] == 0): ?>
                            <input type="submit" name="promote_user" value="Promouvoir">
                        <?php else: ?>
                            <input type="submit" name="demote_user" value="Rétrograder">
                        <?php endif; ?>
                    </form>
                </td>
            </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>