<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil</title>
    

</head>
<body>
<?php
session_start(); // Démarre la session

// Vérifiez si l'utilisateur est connecté
if (!isset($_SESSION['user_id'])) {
    // Si l'utilisateur n'est pas connecté, redirigez-le vers la page de connexion
    header('Location: socialeventlogin.php');
    exit;
}

// Inclure la connexion à la base de données
require 'connection.php';

// Récupérer l'ID de l'utilisateur connecté
$user_id = $_SESSION['user_id'];

// Préparer la requête pour récupérer les informations de l'utilisateur
$stmt = $pdo->prepare("SELECT user_name, user_lastname, user_mail FROM user WHERE user_id = :user_id");
$stmt->execute(['user_id' => $user_id]);

// Récupérer les informations de l'utilisateur
$user = $stmt->fetch(PDO::FETCH_ASSOC);

// Vérifier si l'utilisateur existe
if ($user) {
    $user_name = $user['user_name'];
    $user_lastname = $user['user_lastname'];
    $user_mail = $user['user_mail'];
} else {
    // Si l'utilisateur n'existe pas, rediriger vers la page de connexion
    header('Location: socialeventlogin.php');
    exit;
}
?>

</body>
</html>