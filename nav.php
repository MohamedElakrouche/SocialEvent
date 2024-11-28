<link rel="stylesheet" href="css/nav.css">
<?php 

session_start();
if (!isset($_SESSION['user_id'])) {
    
    header('Location: socialeventlogin.php');
    exit;
}
?>
<div class="nav">

    <ul>
        <a href="homeEvent.php">
            <li>Accueil</li>
        </a>
        <li>
            <ul>
                <li>
            <a href="myEvents.php"> Mes réservations </a>
                </li>
                <li>
<a href="myCreatedEvents.php">Mes évènements </a>

                </li>
        
            </ul>
        </li>
        <a href="createEvent.php">
            <li>Création</li>
        </a>
        </a>
        <a href="profile.php">
            <li>Profil</li>
        </a>

        
    </ul>
    <form action="" method="POST">
        <input type="hidden" name="action" value="logout">
        <button id="logout" type="submit">Se déconnecter</button>
        
       <?php 
       
       if ($_SERVER["REQUEST_METHOD"]==="POST" && isset($_POST["action"]) && $_POST["action"]==="logout")
        {
     
    
    

    session_unset();
    session_destroy();
    header("Location:socialeventlogin.php");
    exit();
    
    
        }
      
        ?>
    </form>
    
    
   

</div>
