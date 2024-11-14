<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Création d'évènements</title>
    <link href="https://fonts.googleapis.com/css2?family=Yellowtail&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/style_createEvent.css">

    <?php include "connection.php"; ?>
</head>
<body>
<img src="socialeventsweb/Design_sans_titre__5_-removebg-preview.png" alt="socialevents" class="logo">

    <h1>Créer votre évènement </h1>

    <div class="create_container">
<form action="" method="post">

<label for="type_event"> Séléctionnez le type d'évènement :</label>
<select name="type_event" id="type_event">
<option value="type_event">Randonée</option>
<option value="type_event">Anniversaire</option>
<option value="type_event">Sport</option>
<option value="type_event">Restaurant</option>
<option value="type_event">Groupe de lecture</option>
</select>
<br/>
<p>
    <label for="location">Localité : </label>
<input type="text" name="location" id="location" size="15">

</p>
<br/> 
<label for="describe">Description de l'évènement </label> <br/> <br/> 
<textarea name="event_describe" id="event_describe" rows="10" cols ="62"></textarea>


<p>
<label for="event_date_begin">Date début</label>
<input type="date" name=event_date_begin>

<label for="event_date_end">Date fin</label>
<input type="date" name=event_date_end>
</p>
<p>
<label for="event_number_place_total">Nombre de places mis à disposition</label>
<input type="number" name="event_number_place_total" > 
</p>

<p>
    <label for="event_stuff">Equipement necessaire ? </label> <br/> <br/>
    <textarea name="event_stuff" id="event_stuff" rows="8" cols="20"></textarea>

</p>

<button>Valider</button>
</form>
</div>



</body>
</html>