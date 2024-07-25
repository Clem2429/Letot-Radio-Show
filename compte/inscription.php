<!DOCTYPE html>
<html>
<head>
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="../css/inscription.css">
    <title>Inscription</title>
    <link rel="icon" href="img/logo_lrs.png"/>
</head>
<body>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data">
    <h2>Inscrivez-vous :</h2>

    <div class="box-form"><br>
        <label for="prenom">Prénom :</label><br>
        <input type="text" id="prenom" name="prenom" placeholder="Ex: Harry" required><br><br>
        
        <label for="nom">Nom :</label><br>
        <input type="text" id="nom" name="nom" placeholder="Ex: Potter" required><br><br>
        
        <label for="pseudo">Pseudo :</label><br>
        <input type="text" id="pseudo" name="pseudo" placeholder="Ex: Harry / Harry12 / Etc." required><br><br>
        
        <label for="email">Email :</label><br>
        <input type="email" id="email" name="email" placeholder="Ex: harry.potter@gmail.com" required><br><br>
        
        <label for="age">Âge:</label><br>
        <input type="number" id="age" name="age" placeholder="Entrez votre âge"required><br><br>

        <label hidden for="statut">Statut :</label><br>
        <input hidden type="text" id="statut" name="statut" value="Membre" readonly><br><br>
    </div>
    <div class="box-form"><br>    
        <label for="classe">Vous êtes (en/un) :</label><br>
        <select id="classe" name="classe">
            <option value="">Cliquez pour sélectionner</option>
            <option value="6e">6e</option>
            <option value="5e">5e</option>
            <option value="4e">4e</option>
            <option value="3e">3e</option>
            <option value="2nde">2nde</option>
            <option value="1re">1re</option>
            <option value="Term">Term</option>
            <option value="Parent">Parent</option>
            <option value="Prof">Prof</option>
            <option value="Personnel">Personnel</option>
            <option value="Autre">Autre</option>
        </select><br><br>
        
        <!-- <label hidden for="statut">Statut :</label><br>
        <input hidden type="text" id="statut" name="statut" value="Membre" readonly><br><br> -->
        
        <label for="description">Description:</label><br>
        <textarea id="description" name="description" rows="8" maxlength="255" placeholder="Vous avez la possibilité d'entrer une description de vous - 255 caractères maximum"></textarea><br><br>
        
        <label for="pdp">Photo de profil :</label><br>
        <input type="file" id="pdp" name="pdp"><br><br>
</div>
<div class="box-form"><br>
        <label for="liens">Mettez en avant des sites :</label><br>
        <input type="url" id="lien1" name="liens[]" placeholder="https://"><br>
        <input type="url" id="lien2" name="liens[]" placeholder="https://"><br>
        <input type="url" id="lien3" name="liens[]" placeholder="https://"><br>
        <input type="url" id="lien4" name="liens[]" placeholder="https://"><br>
        <input type="url" id="lien5" name="liens[]" placeholder="https://"><br>
        <input type="url" id="lien6" name="liens[]" placeholder="https://"><br>
        <input type="url" id="lien7" name="liens[]" placeholder="https://"><br><br>
        
        <label for="mot_de_passe">Mot de passe <span style="color: red;">(8 caractères minimum)</span></label><br>
        <input type="password" id="mot_de_passe" name="mot_de_passe" placeholder="Entrez un mot de passe" minlength="8" required><br><br>
        
        <label for="confirm_mot_de_passe">Confirmation du mot de passe:</label><br>
        <input type="password" id="confirm_mot_de_passe" name="confirm_mot_de_passe" placeholder="Confirmez votre mot de passe" required><br><br>
        
        <input type="submit" name="submit" value="S'inscrire">
        <br><br>
        <p>Vous avez déjà un compte ? - <a href="connexion.php">Connectez-vous !</a></p>
</div>

<a class="home-link" href="../index.php">↩ Revenir à l'Accueil</a>
    </form>

    <?php

    require_once "../systeme/config.php";

    // Traitement du formulaire d'inscription
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Récupérer les données du formulaire
        $prenom = $_POST['prenom'];
        $nom = $_POST['nom'];
        $pseudo = $_POST['pseudo'];
        $email = $_POST['email'];
        $age = $_POST['age'];
        $classe = $_POST['classe'];
        $statut = $_POST['statut'];
        $description = $_POST['description'];
        $mot_de_passe = $_POST['mot_de_passe'];
        $confirm_mot_de_passe = $_POST['confirm_mot_de_passe'];
        
        // Valider et traiter l'upload de la photo de profil
        $uploadDir = '../uploads/compte/pdp/';
        // A CHANGER EN LOCAL
        $uploadFile = $uploadDir . basename($_FILES['pdp']['name']);
        move_uploaded_file($_FILES['pdp']['tmp_name'], $uploadFile);
        $pdp = $uploadFile;

        // Valider et traiter les liens
        $liens = array_filter($_POST['liens']); // Supprimer les entrées vides
        $liens = array_slice($liens, 0, 7); // Limiter à 7 liens au maximum
        $liens = implode(', ', $liens); // Convertir en chaîne pour enregistrement

        // Vérifier si l'email est déjà utilisé
        $stmt = $conn->prepare("SELECT id FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            echo "<p>L'email est déjà utilisé. Veuillez en choisir un autre.</p>";
        } elseif ($mot_de_passe !== $confirm_mot_de_passe) {
            echo "<p>Les mots de passe ne correspondent pas.</p>";
        } else {
            // Hasher le mot de passe avant de l'enregistrer
            $hashed_password = password_hash($mot_de_passe, PASSWORD_DEFAULT);
            
            // Préparer et exécuter la requête d'insertion
            $stmt = $conn->prepare("INSERT INTO users (prenom, nom, pseudo, email, age, classe, statut, description, pdp, liens, password, date_creation) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW())");
            $stmt->bind_param("ssssissssss", $prenom, $nom, $pseudo, $email, $age, $classe, $statut, $description, $pdp, $liens, $hashed_password);
            
            if ($stmt->execute()) {
                echo "<p style='color: green; position absolute; top: 1%; left: 50%: transform: translate(-50%); font-size: 2em;'>Inscription réussie !</p>";
                header("Location: connexion.php");
                exit();
            } else {
                echo "<p>Erreur lors de l'inscription. Veuillez réessayer.</p>";
            }
        }

        $stmt->close();
        $conn->close();
    }
    ?>
</body>
</html>