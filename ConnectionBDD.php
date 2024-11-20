<?php
// Connexion à la base de données
$host = 'localhost';
$dbname = 'socialevents';
$username = 'root';
$password = 'root'; // À ajuster selon votre configuration

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erreur de connexion : " . $e->getMessage());
}
