<?php
session_start();
require 'connection.php'; // Inclure la configuration de la connexion à la BDD

// Initialiser le message d'erreur
$error_message = '';

// Vérifier si le formulaire est soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") 
{


    if (isset($_POST['user_mail']) && isset($_POST['user_password'])) {
        // Récupérer les données du formulaire
        $email = $_POST['user_mail'];
        $password = $_POST['user_password'];

        // Préparer la requête pour vérifier si l'utilisateur existe
        $stmt = $pdo->prepare("SELECT * FROM user WHERE user_mail = :user_mail");

        // Exécuter la requête avec le paramètre
        $stmt->execute(['user_mail' => $email]);
        $user = $stmt->fetch();


        // Comparer directement le mot de passe (en supposant que `user_password` soit en clair)
        if ($user)
        {
        if (password_verify($password, $user['user_password'])) 
            {
                // Authentification réussie
                
            
                $_SESSION["user_id"]=$user["user_id"];

                header("Location:homeEvent.php"); // Redirection vers l'espace personnel
                exit();
            } 
            
            else
             
            {
            //Mot de passe incorrect
            echo "identifiants incorrects";
            }
        } 
        else {
        $error_message = "Identifiants incorrects";
    }
    }
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="Login.css"> <!-- Lien vers le fichier CSS-->
</head>

<body>
    <!--<span class="logo"><img src="Design_sans_titre__5_-removebg-preview.png" alt="socialevents"></span>-->

    <div class="login-container">
        <form action="" method="post">
            <h2>Connexion à mon espace</h2>
            <p>Entrez vos identifiants pour accéder à votre espace personnel</p>

            <?php
            // Afficher le message d'erreur s'il y en a un, en le protégeant contre les attaques XSS
            if (!empty($error_message)) {
                echo "<p class='error'>" . htmlspecialchars($error_message) . "</p>";
            }
            ?>

            <label for="user_mail">Mail:</label>
            <input type="email" id="user_mail" name="user_mail" placeholder="Entrez votre mail" required></br></br>

            <label for="password">Mot de passe:</label>
            <input type="password" id="user_password" name="user_password" placeholder="Entrez votre mot de passe" required></br></br>

            <button type="submit">Login</button></br></br>
             Pas encore Membre ?  <a href="formulaireinscription.php">inscrivez-vous </a>
        </form>

    </div>
</body>

</html>