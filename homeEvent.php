<?php
include "connection.php"; 
include_once "nav.php";


// Récupération des événements depuis la base de données
$sql = "SELECT event_title, event_image, event_describe, event_number_place_total FROM event";
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
</head>
<body>

<h1 style="text-align: center;">Événements en cours</h1>

<div class="carousel-container">
    <!-- Compteur d'événements -->
    <div id="event-counter">
        <!-- Initialisé à 1/total au chargement avant maj en javascript -->
        1/<?php echo $totalEvents; ?>
    </div>
    
    <div class="carousel">
        <?php if ($events): foreach ($events as $event): ?>
            <div class="carousel-item">
                <img src="<?php echo htmlspecialchars($event['event_image']); ?>" alt="Image de l'événement">
                <h3><?php echo htmlspecialchars($event['event_title']); ?></h3>
                <p><?php echo htmlspecialchars($event['event_describe']); ?></p>
                <p><?php echo htmlspecialchars($event['event_number_place_total']) . ' places au total !'; ?></p>
            </div>
        <?php endforeach; else: ?>
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
    const totalEvents = <?php echo $totalEvents; ?>; // Récupère le nombre total d'événements
    let currentIndex = 0;

    // Fonction pour mettre à jour le carousel et le compteur
    function updateCarousel() {
        const offset = -currentIndex * 100;
        carousel.style.transform = `translateX(${offset}%)`;
        updateCounter();
    }

    // Fonction pour mettre à jour le compteur
    function updateCounter() {
        const counter = document.getElementById('event-counter');
        counter.textContent = `${currentIndex + 1}/${totalEvents}`;
    }

    // Défilement vers la gauche
    function scrollCarouselLeft() {
    currentIndex = (currentIndex > 0) ? currentIndex - 1 : carouselItems.length - 1;
    updateCarousel();
}


    // Défilement vers la droite
    function scrollRight() {
        currentIndex = (currentIndex < carouselItems.length - 1) ? currentIndex + 1 : 0;
        updateCarousel();
    }

    // Initialise le compteur lors du chargement de la page
    updateCounter();
</script>

</body>
</html>
