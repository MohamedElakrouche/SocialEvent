<?php
require 'connection.php'; // Inclure la configuration de la connexion à la BDD





?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Création d'évènements</title>
    <link href="https://fonts.googleapis.com/css2?family=Yellowtail&display=swap" rel="stylesheet">
    <!--<link rel="stylesheet" href="css/style_createEvent.css">-->

    <?php include "connection.php";


    ?>
</head>

<body>
    <!--<img src="socialeventsweb/Design_sans_titre__5_-removebg-preview.png" alt="socialevents" class="logo">-->

    <h1>Créer votre évènement </h1>

    <div class="create_container">
        <form action="" method="post" enctype="multipart/form-data">

            <label for="type_event"> Séléctionnez le type d'évènement :</label>
            <select name="type_event" id="type_event">
                <option value="Randonée">Randonée</option>
                <option value="Anniversaire">Anniversaire</option>
                <option value="Sport">Sport</option>
                <option value="Restaurant">Restaurant</option>
                <option value="Groupe de lecture">Groupe de lecture</option>
            </select>
            <br />
            <p>
                <label for="event_location">Localité : </label>
                <input type="text" name="event_location" id="event_location" size="15">

            </p>
            <br />
            <label for="describe">Description de l'évènement </label> <br /> <br />
            <textarea name="event_describe" id="event_describe" rows="10" cols="62"><?php echo isset($_POST['event_describe']) ? htmlspecialchars($_POST['event_describe']) : ''; ?></textarea>


            <p>
                <label for="event_date_begin">Date début</label>
                <input type="date" name=event_date_begin>

                <label for="event_date_end">Date fin</label>
                <input type="date" name=event_date_end>
            </p>
            <p>
                <label for="event_number_place_total">Nombre de places mis à disposition</label>
                <input type="number" name="event_number_place_total">
            </p>

            <p>
                <label for="event_stuff">Equipement necessaire ? </label> <br /> <br />
                <textarea name="event_stuff" id="event_stuff" rows="8" cols="20"></textarea>

            </p>

            <p>
                <label for="image">Choisissez une image :</label>
                <input type="file" name="image" id="image" accept="image/*" required>
            </p>

            <button>Valider</button>


        </form>

    </div>


    <?php

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {


        // Récupérer les données du formulaire
        $type_event = $_POST['type_event'];
        $event_location = $_POST['event_location'];
        $event_describe = $_POST['event_describe'];
        $event_date_begin = $_POST['event_date_begin'];
        $event_date_end = $_POST['event_date_end'];
        $event_number_place_total = $_POST['event_number_place_total'];
        $event_stuff = $_POST['event_stuff'];

        // Traiter l'upload de l'image
        $uploadDir = 'uploads/';

        $file = $_FILES['image'];
        $fileName = basename($file['name']);
        $fileTmpName = $file['tmp_name'];
        $fileExt = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
        $allowed = ['jpg', 'jpeg', 'png', 'gif', 'jfif'];
        $fileNewName = uniqid('', true) . "." . $fileExt;
        $fileDestination = $uploadDir . $fileNewName;

        if (in_array($fileExt, $allowed) && move_uploaded_file($fileTmpName, $fileDestination)) {
            // Insérer les données dans la base de données
            $sql = "INSERT INTO event (event_title, event_describe, event_date_begin, event_date_end, event_duration, event_type, event_number_place_available, event_number_place_total, event_number_place_remaining_, event_stuff, event_image,event_location) 
                VALUES (:event_title, :event_describe, :event_date_begin, :event_date_end, DATEDIFF(:event_date_end, :event_date_begin), :event_type, :event_number_place_total, :event_number_place_total, :event_number_place_total, :event_stuff, :event_image,:event_location)";

            $stmt = $pdo->prepare($sql);
            $stmt->execute([
                ':event_title' => $type_event,
                ':event_describe' => $event_describe,
                ':event_date_begin' => $event_date_begin,
                ':event_date_end' => $event_date_end,
                ':event_type' => $type_event,
                ':event_number_place_total' => $event_number_place_total,
                ':event_stuff' => $event_stuff,
                ':event_image' => $fileDestination,
                ':event_location' => $event_location
            ]);

            // Rediriger vers la page d'accueil
            header("Location: homeEvent.php");
            exit;
        } else {
            echo "Erreur : le fichier image n'a pas pu être téléversé ou le format n'est pas autorisé.";
        }
    }
    ?>

</body>

</html>