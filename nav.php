<link rel="stylesheet" href="nav.css">
<?php 
session_start();

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['user_id'])) {
    // Si l'utilisateur n'est pas connecté, rediriger vers la page de connexion
    header('Location: socialeventlogin.php');
    exit;
}
?>

<div class="nav">
    <ul>
        <li><a href="homeEvent.php">Accueil</a></li>
        <li><a href="myEvents.php">Mes réservations</a></li>
        <li><a href="myCreatedEvents.php">Mes évènements</a></li>
        <li><a href="createEvent.php">Création</a></li>
        <li><a href="profile.php">Profil</a></li>
    </ul>

    <!-- Formulaire de déconnexion -->
    <form action="" method="POST">
        <input type="hidden" name="action" value="logout">
        <button id="logout" type="submit">Se déconnecter</button>
    </form>
    
    <?php 
    // Traitement du formulaire de déconnexion
    if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["action"]) && $_POST["action"] === "logout") {
        // Détruire la session
        session_unset();
        session_destroy();
        header("Location:socialeventlogin.php"); // Redirection vers la page de connexion
        exit();
    }
    ?>
</div>
