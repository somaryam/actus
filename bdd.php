<?php
// Informations de connexion à la base de données
$servername = "localhost";
$username = "mglsi_user";
$password = "passer";
$dbname = "mglsi_news";

try {
    // Création d'une nouvelle connexion PDO
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);

    // Définir le mode d'erreur PDO sur Exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    //echo "Connexion réussie à la base de données.";
    
} 
catch(PDOException $e) {
    die("La connexion à la base de données a échoué : " . $e->getMessage());
}
?>