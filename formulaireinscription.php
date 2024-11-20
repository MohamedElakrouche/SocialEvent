<?php
require 'connection.php'; // Inclure la configuration de la connexion à la BDD

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Récupération des données du formulaire
    $user_name = htmlspecialchars($_POST['user_name']);
    $user_firstname = htmlspecialchars($_POST['user_firstname']);
    $user_birthdate = htmlspecialchars($_POST['user_birthdate']);
    $user_mail = htmlspecialchars($_POST['user_mail']);
    $password = $_POST['password'];
    $password_confirm = $_POST['password_confirm'];

    // Vérification des mots de passe
    if ($password !== $password_confirm) {
        echo "<p style='color: red;'>Les mots de passe ne correspondent pas.</p>";
    } else {
        // Hachage du mot de passe pour plus de sécurité
        $hashed_password = password_hash($password, PASSWORD_BCRYPT);

        try {
            // Préparer et exécuter l'insertion dans la base de données
            $stmt = $pdo->prepare("INSERT INTO user (user_name, user_lastname, user_birthdate, user_mail, user_password) 
                                   VALUES (:user_name, :user_firstname, :user_birthdate, :user_mail, :user_password)");
            $stmt->execute([
                ':user_name' => $user_name,
                ':user_firstname' => $user_firstname,
                ':user_birthdate' => $user_birthdate,
                ':user_mail' => $user_mail,
                ':user_password' => $hashed_password,
            ]);
            echo "<p style='color: green;'>Inscription réussie !</p>";
            header("location: socialeventlogin.php");
        } catch (PDOException $e) {
            // Gérer les erreurs (comme un email déjà utilisé)
            echo "<p style='color: red;'>Erreur lors de l'inscription : " . $e->getMessage() . "</p>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
    <link rel="stylesheet" href="formulairestyle.css">
</head>

<body>
    <span class="logo"><img src="Design_sans_titre__5_-removebg-preview.png" alt="socialevents"></span>

<div class="form-container">
    <form method="post">
            <h2>Inscription</h2>
            <p>Entrez vos informations pour créer un compte</p>

            <label for="user_name">Nom:</label>
            <input type="text" id="user_name" name="user_name" placeholder="Entrez votre nom" required>

            <label for="user_firstname">Prénom:</label>
            <input type="text" id="user_firstname" name="user_firstname" placeholder="Entrez votre prénom" required>

            <label for="birthdate">Date de naissance:</label>
            <input type="date" id="birthdate" name="user_birthdate" placeholder="Entrez votre date de naissance" required>

            <label for="user_mail">Mail:</label>
            <input type="mail" id="user_mail" name="user_mail" placeholder="Entrez votre mail" required>

            <label for="user_password">Mot de passe:</label>
            <input type="password" id="user_password" name="password" placeholder="Entrez votre mot de passe" required>

            <label for="user_password_confirm">Confirmer le mot de passe:</label>
            <input type="password" id="user_password_confirm" name="password_confirm" placeholder="Confirmez votre mot de passe" required>
            <button type="submit">S'inscrire</button>

    </div>
    </form>

    </div>
</body>

</html>