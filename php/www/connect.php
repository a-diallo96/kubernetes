<?php

$host = getenv("DB_HOST") ?: "localhost";
$db = getenv("DB_NAME") ?: "gestion_produits";
$username = getenv("DB_USER") ?: "root";
$password = getenv("DB_PASSWORD") ?: "root";

// Connexion avec pdo mysql
$db = new PDO("mysql:host=$host;dbname=$db", $username, $password);
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

?>