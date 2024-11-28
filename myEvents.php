<?php

include_once "nav.php";
include_once "connection.php";



$user_id = $_SESSION['user_id']; 



try {
    // Préparer la requête pour récupérer les événements réservés par l'utilisateur
    $stmt = $pdo->prepare("
        SELECT e.event_id, e.event_title, e.event_describe, e.event_date_begin
        FROM event e
        INNER JOIN reservation r ON e.event_id = r.event_id
        WHERE r.user_id = :user_id
        ORDER BY e.event_date_begin DESC
    ");
    $stmt->execute([':user_id' => $user_id]);

    $events = $stmt->fetchAll();

} catch (PDOException $e) {
    echo "Erreur lors de la récupération des événements : " . htmlspecialchars($e->getMessage());
    exit;
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Mes Réservations</title>
    <style>
        /* Styles CSS pour une meilleure présentation */
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
        }
        .container {
            width: 80%;
            margin: 30px auto;
        }
        h1 {
            text-align: center;
        }
        .event {
            background-color: #fff;
            padding: 20px;
            margin-bottom: 15px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        .event h2 {
            margin-top: 0;
        }
        .event p {
            margin: 10px 0;
        }
        .event-date {
            color: #555;
            font-size: 14px;
        }
        .no-events {
            text-align: center;
            margin-top: 50px;
            font-size: 18px;
            color: #777;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Mes Événements Réservés</h1>

        <?php if (empty($events)): ?>
            <p class="no-events">Vous n'avez réservé aucun événement pour le moment.</p>
        <?php else: ?>
            <?php foreach ($events as $event): ?>
                <div class="event">
                    <h2><?php echo htmlspecialchars($event['event_title']); ?></h2>
                    <p class="event-date">Date de l'événement : <?php echo htmlspecialchars($event['event_date_begin']); ?></p>
                    <p><?php echo nl2br(htmlspecialchars($event['event_describe'])); ?></p>
                    <!-- Vous pouvez ajouter des liens pour plus de détails sur l'événement -->
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</body>
</html>
