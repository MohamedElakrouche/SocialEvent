<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil</title>
    <?php session_start(); 
    include "connection.php";
    ?>

</head>
<body>
    <?php if ($_SESSION["user_id"]) {

        $requete="SELECT * FROM event WHERE user_id=:user_id ";
        $stmt=$pdo->prepare($requete);
        $user_id=$_SESSION["user_id"];
        $stmt->bindParam(":user_id",$user_id,PDO::PARAM_INT);
        $stmt->execute();
        $events=$stmt->fetchAll(PDO::FETCH_ASSOC);

        // Affichage des évènements crées par l'utilisateur
    
    if (!empty($events)){

        foreach ($events as $event){

            echo htmlspecialchars($event["event_title"]);
        }
    }
    else {
        echo " Aucun évènement crée";
    }

   
    
    
    
    
    }


    else {

        header("Location:socialeventlogin.php");
        exit();
    }

    ?>
</body>
</html>