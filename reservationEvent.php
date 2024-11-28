<?php
include_once "nav.php";
require 'connection.php'; // Inclure votre fichier de connexion à la base de données

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php"); // Redirigez vers la page de connexion si l'utilisateur n'est pas connecté
    exit();
}

// Vérifier si l'event_id est défini dans la session
if (isset($_GET['event_id'])) {
    $_SESSION['event_id'] = (int)$_GET['event_id']; // Stocker l'ID de l'événement dans la session
}

if (!isset($_SESSION['event_id'])) {
    die("Aucun événement sélectionné. Veuillez revenir à la liste des événements.");
}

// Initialiser un message pour afficher le statut
$message = "";

// Traitement de la réservation
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_SESSION['event_id'])) {
        $event_id = $_SESSION['event_id'];
        $user_id = $_SESSION['user_id'];
        $reservation_date = date('Y-m-d'); // Date actuelle pour la réservation
        $reservation_status = 'Confirmée'; // Statut par défaut de la réservation

        try {
            // Insérer la réservation dans la base de données
            $stmt = $pdo->prepare("
                INSERT INTO reservations (event_id, user_id, reservation_date, reservation_status)
                VALUES (:event_id, :user_id, :reservation_date, :reservation_status)
            ");
            $stmt->execute([
                ':event_id' => $event_id,
                ':user_id' => $user_id,
                ':reservation_date' => $reservation_date,
                ':reservation_status' => $reservation_status,
            ]);

            $message = "Réservation confirmée avec succès pour l'événement ID : $event_id";
            unset($_SESSION['event_id']); // Supprimer l'event_id de la session après confirmation
        } catch (PDOException $e) {
            $message = "Erreur lors de la réservation : " . htmlspecialchars($e->getMessage());
        }
    } else {
        $message = "Impossible de confirmer la réservation. Aucun événement sélectionné.";
    }
}
 


// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Vérifier si l'event_id est défini dans la session ou via GET
if (isset($_GET['event_id'])) {
    $_SESSION['event_id'] = (int)$_GET['event_id'];
}

if (!isset($_SESSION['event_id'])) {
    die("Aucun événement sélectionné. Veuillez revenir à la liste des événements.");
}

// Récupérer les détails de l'événement
$event_id = $_SESSION['event_id'];

try {
    // Préparer une requête pour récupérer les détails de l'événement
    $stmt = $pdo->prepare("SELECT event_title, event_describe, event_image FROM event WHERE event_id = :event_id");
    $stmt->execute(['event_id' => $event_id]);
    $event = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$event) {
        die("Événement non trouvé.");
    }
} catch (PDOException $e) {
    die("Erreur lors de la récupération des détails de l'événement : " . htmlspecialchars($e->getMessage()));
}

// Initialiser un message pour afficher le statut de la réservation
$message = "";

// Traitement de la réservation
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id = $_SESSION['user_id'];
    $reservation_date = date('Y-m-d'); 
    $reservation_status = 'Confirmée'; 
    try {
        // Insérer la réservation dans la base de données
        $stmt = $pdo->prepare("
            INSERT INTO reservation (event_id, user_id, reservation_date, reservation_status)
            VALUES (:event_id, :user_id, :reservation_date, :reservation_status)
        ");
        $stmt->execute([
            ':event_id' => $event_id,
            ':user_id' => $user_id,
            ':reservation_date' => $reservation_date,
            ':reservation_status' => $reservation_status,
        ]);

        // CSS interne pour l'affichage du message de confirmation de réservation car déjà trop de fichiers CSS
echo "
         <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
        }
        .message-container {
            text-align: center;
            font-size: 24px;
            color: #333;
            padding: 20px;
            border: 2px solid #ddd;
            border-radius: 10px;
            background-color: #fff;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }
    </style>


    <div class='message-container'>
        <p>Réservation confirmée avec succès !</p>
        <p>Vous serez redirigé vers la page d'accueil des événements dans 5 secondes...</p>
    </div>
    <script>
        setTimeout(function() {
            window.location.href = 'homeEvent.php';
        }, 5000); // 5000 millisecondes = 5 secondes
    </script>
";
exit();
    } catch (PDOException $e) {
        $message = "Erreur lors de la réservation : " . htmlspecialchars($e->getMessage());
    }
}
?>




<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmation de réservation</title>
    <style>
        .event-container {
            max-width: 600px;
            margin: 0 auto;
            text-align: center;
        }

        .event-image {
            max-width: 100%;
            height: auto;
        }

        .event-description {
            font-size: 16px;
            margin: 15px 0;
        }

        .confirmation-form {
            margin-top: 20px;
        }

        .message {
            color: green;
            font-weight: bold;
        }
    </style>
</head>

<body>
    <div class="event-container">
        <h1>Confirmer votre réservation</h1>

        <?php
        // Afficher le message de confirmation ou d'erreur
        if (!empty($message)) {
            echo "<p class='message'>" . htmlspecialchars($message) . "</p>";
        }
        ?>

        <!-- Détails de l'événement -->
        <h2><?php echo htmlspecialchars($event['event_title']); ?></h2>
        <img src="<?php echo htmlspecialchars($event['event_image']); ?>" alt="Image de l'événement" class="event-image">
        <p class="event-description"><?php echo htmlspecialchars($event['event_describe']); ?></p>

        <!-- Formulaire de confirmation -->
        <form action="" method="POST" class="confirmation-form">
            <p>Êtes-vous sûr de vouloir confirmer votre réservation pour cet événement ?</p>
            <button type="submit">Confirmer</button>
        </form>
    </div>
</body>

</html>
