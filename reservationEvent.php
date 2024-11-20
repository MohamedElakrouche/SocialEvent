<?php
// Récupérer l'ID de l'événement (ou d'autres informations) envoyé depuis la page homeEvent
$eventId = isset($_GET['event_id']) ? htmlspecialchars($_GET['event_id']) : null;
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Réserver un Événement</title>
    <link rel="stylesheet" href="css/style_reservations.css"> <!-- Ajouter le fichier CSS -->
</head>

<body>
    <div class="reservation-container">
        <h1>Réserver l'Événement</h1>

        <?php if ($eventId): ?>
            <p>Vous êtes en train de réserver l'événement ID : <strong><?php echo $eventId; ?></strong></p>
        <?php else: ?>
            <p>Erreur : Aucun événement sélectionné.</p>
        <?php endif; ?>

        <form action="processReservation.php" method="POST">
            <input type="hidden" name="event_id" value="<?php echo $eventId; ?>">

            <label for="name">Nom complet :</label>
            <input type="text" id="name" name="name" required>

            <label for="email">Email :</label>
            <input type="email" id="email" name="email" required>

            <label for="phone">Téléphone :</label>
            <input type="text" id="phone" name="phone" required>

            <label for="guests">Nombre d'invités :</label>
            <input type="number" id="guests" name="guests" min="1" required>

            <button type="submit">Confirmer la Réservation</button>
        </form>
    </div>
</body>

</html>