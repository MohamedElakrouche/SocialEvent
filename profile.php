<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil</title>
    <?php session_start(); ?>
</head>
<body>
    <?php if ($_SESSION["user_id"]) {

        echo "Bonjour toi";
    }
    else {

        header("Location:socialeventlogin.php");
    }

    ?>
</body>
</html>