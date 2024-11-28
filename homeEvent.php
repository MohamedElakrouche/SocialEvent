<?php
session_start();
require 'connection.php'; // Inclure la configuration de la connexion à la BDD
include_once "nav.php";
// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['user_id'])) {
    // Si l'utilisateur n'est pas connecté, rediriger vers la page de connexion
    header('Location: socialeventlogin.php');
    exit;
}

// Récupérer l'ID de l'utilisateur connecté
$user_id = $_SESSION['user_id'];

// Récupérer les informations de l'utilisateur depuis la base de données
$stmt = $pdo->prepare("SELECT user_name, user_lastname, user_mail FROM user WHERE user_id = :user_id");
$stmt->execute(['user_id' => $user_id]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

// Récupérer les événements depuis la base de données
$sql = "SELECT event_id, event_title, event_image, event_describe, event_number_place_total, event_location FROM event"; 
$stmt = $pdo->query($sql);
$events = $stmt->fetchAll(PDO::FETCH_ASSOC);
$totalEvents = count($events); // Nombre total d'événements
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Événements</title>
    <link rel="stylesheet" href="css/style_homeEvent.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="css/nav.css?v=<?php echo time(); ?>"> <!-- Intégration de la barre de navigation -->
</head>

<body>

    </div>

    <!-- Affichage du profil utilisateur connecté -->
    <div class="profile-container">
        <h2>Bienvenue, <?php echo htmlspecialchars($user['user_lastname']); ?> !</h2>
    </div>

    <h1 style="text-align: center;">Événements en cours</h1>

    <div class="carousel-container">
        <div id="event-counter"> 
            <?php echo $totalEvents; ?>
        </div>

        <div class="carousel">
            <?php if ($events): foreach ($events as $event): ?>
                    <div class="carousel-item">
                        <img src="<?php echo htmlspecialchars($event['event_image']); ?>" alt="Image de l'événement">
                        <h3><?php echo htmlspecialchars($event['event_title']); ?></h3>
                        <p><?php echo htmlspecialchars($event['event_describe']); ?></p>
                        <p><?php echo htmlspecialchars($event['event_number_place_total']) . ' places au total !'; ?></p>
                        <p><?php echo "Ville : " . htmlspecialchars($event['event_location']); ?></p>
                        <!-- Bouton Réserver -->
                        <a href="reservationEvent.php?event_id=<?php echo $event['event_id']; ?>" class="reserve-button">Réserver</a>
                    </div>
                <?php endforeach; ?>
                <p>Aucun événement trouvé dans la base de données.</p>
            <?php endif; ?>
        </div>

        <!-- Boutons de contrôle -->
        <div class="carousel-controls">
            <button onclick="scrollCarouselLeft()">&#10094; Précédent</button>
            <button onclick="scrollRight()">Suivant &#10095;</button>
        </div>
    </div>

    <script>
        const carousel = document.querySelector('.carousel');
        const carouselItems = document.querySelectorAll('.carousel-item');
        const totalEvents = <?php echo $totalEvents; ?>;
        let currentIndex = 0;

        function updateCarousel() {
            const offset = -currentIndex * 100;
            carousel.style.transform = `translateX(${offset}%)`;
            updateCounter();
        }

        function updateCounter() {
            const counter = document.getElementById('event-counter');
            counter.textContent = `${currentIndex + 1}/${totalEvents}`;
        }

        function scrollCarouselLeft() {
            currentIndex = (currentIndex > 0) ? currentIndex - 1 : carouselItems.length - 1;
            updateCarousel();
        }

        function scrollRight() {
            currentIndex = (currentIndex < carouselItems.length - 1) ? currentIndex + 1 : 0;
            updateCarousel();
        }

        updateCounter();
    </script>

</body>

</html>
