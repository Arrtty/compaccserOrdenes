<?php

// Establecer conexión a la base de datos (usando PDO)
$host = 'localhost';
$dbName = 'compaccser';
$username = 'root';
$password = '';

try {
  $pdo = new PDO("mysql:host=$host;dbname=$dbName", $username, $password);
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
  die("Error de conexión a la base de datos: " . $e->getMessage());
}
