<?php 


$host = 'localhost';
$port = '3306';
$dbname = 'socialevents';
$username = 'root';
$password = '';

try {
    
    $pdo = new PDO("mysql:host=$host;port=$port;dbname=$dbname;charset=utf8mb4", $username, $password);
    
    
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    
    echo "Connexion réussie à la base de données.";
} catch (PDOException $e) {
    
    echo "Erreur de connexion : " . $e->getMessage();
}





?>