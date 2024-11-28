<link rel="stylesheet" href="style_reservations.css">


<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $eventId = $_POST['event_id'];
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $phone = htmlspecialchars($_POST['phone']);
    $guests = (int)$_POST['guests'];

    // Exemple d'insertion dans une base de données (utiliser PDO pour plus de sécurité)
    // Connexion à la base
    try {
        $pdo = new PDO("mysql:host=localhost;dbname=socialevent", "root", "");
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $stmt = $pdo->prepare("INSERT INTO reservation (event_id, name, email, phone, guests) VALUES (?, ?, ?, ?, ?)");
        $stmt->execute([$eventId, $name, $email, $phone, $guests]);

        echo "Réservation réussie pour l'événement ID : $eventId";
    } catch (PDOException $e) {
        echo "Erreur : " . $e->getMessage();
    }
}
