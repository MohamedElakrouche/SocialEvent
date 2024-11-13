<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="loginstyle.css"> <!-- Link to your CSS file -->
</head>
<body>
<span class="logo" ><img src="Design_sans_titre__5_-removebg-preview.png" alt="socialevents"> 
</span>

    <div class="login-container">
        <form action="authenticate.php" method="post">
        <h2>Connexion à mon espace</h2>
        <p>Entrez vos identifiants pour accéder à votre espace personnel</p>
                <label for="username">Mail:</label>
                <input type="text" id="username" name="username" placeholder="Entrez votre mail" required>
                <label for="password">Password:</label> 
                <input type="password" id="password" name="password" placeholder="Entrez votre mot de passe"required>
            <button type="submit">Login</button>
        </form>
    </div>
</body>
</html>