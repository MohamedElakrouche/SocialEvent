<link rel="stylesheet" href="css/nav.css">
<?php session_start(); ?>
<div class="nav">

    <ul>
        <a href="homeEvent.php">
            <li>Accueil</li>
        </a>
        <a>
            <li>Mes évènements</li>
        </a>
        <a href="createEvent.php">
            <li>Création</li>
        </a>
        </a>
        <a href="profile.php">
            <li>Profil</li>
        </a>
    </ul>
    <form action="" method="POST">
        <button id="logout" type="submit">Se déconnecter</button>
    </form>

</div>
<?php 
if ($_SERVER["REQUEST_METHOD"]==="POST"){
    if (session_status()=== PHP_SESSION_ACTIVE) {

    session_unset();
    session_destroy();
    header("Location:socialeventlogin.php");
    exit();
    }
    else{
    header("Location:socialeventlogin.php");
    exit();
    }

}
?>