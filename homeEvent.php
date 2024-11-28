<?php
// Démarrer la session
session_start();

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['user_id'])) {
    // Si l'utilisateur n'est pas connecté, rediriger vers la page de connexion
    header('Location: socialeventlogin.php');
    exit;
}

// Inclure la connexion à la base de données
include "connection.php";

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

    <!-- Barre de navigation -->
    <div class="nav">
        <ul>
            <a href="homeEvent.php">
                <li>Accueil</li>
            </a>
            <a href="myEvents.php">
                <li>Mes évènements</li>
            </a>
            <a href="createEvent.php">
                <li>Création</li>
            </a>
            <a href="profile.php">
                <li>Profil</li>
            </a>
        </ul>
        <form action="" method="POST">
            <input type="hidden" name="action" value="logout">
            <button id="logout" type="submit">Se déconnecter</button>
            <?php 
            if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["action"]) && $_POST["action"] === "logout") {
                session_unset();
                session_destroy();
                header("Location:socialeventlogin.php");
                exit();
            }
            ?>
        </form>
    </div>

    <!-- Affichage du profil utilisateur connecté -->
    <div class="profile-container">
        <h2>Bienvenue, <?php echo htmlspecialchars($user['user_name']) . ' ' . htmlspecialchars($user['user_lastname']); ?> !</h2>
       
    </div>

    <h1 style="text-align: center;">Événements en cours</h1>

    <div class="carousel-container">
        <!-- Compteur d'événements -->
        <div id="event-counter"> 
            1/<?php echo $totalEvents; ?>
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
                <?php endforeach;
            else: ?>
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
