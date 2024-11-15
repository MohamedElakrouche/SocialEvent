<!DOCTYPE html>
<html lang="fr">
<head>
    <title>Connexion</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/loginstyle.css"> <!-- Link to your CSS file -->
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
   
    <title>Login</title>
   
<link href="https://fonts.googleapis.com/css2?family=Yellowtail&display=swap" rel="stylesheet">
    
<link rel="stylesheet" href="css/loginstyle.css"> 

</head>
<body>
<img src="Design_sans_titre__5_-removebg-preview.png" alt="socialevents" class="logo">
    <div class="login-container">
    <form action="authenticate.php" method="post">
        <h2>Connexion à mon espace</h2>
        <p>Entrez vos identifiants pour commencer l'aventure</p>
                <label for="username">Mail:</label>
                <input type="text" id="username" name="username" placeholder="Entrez votre mail" required>
                <label for="password">Password:</label> 
                <input type="password" id="password" name="password" placeholder="Entrez votre mot de passe"required>
            <button type="submit">c'est partis</button>
        </form>
    </div>
</body>
</html>