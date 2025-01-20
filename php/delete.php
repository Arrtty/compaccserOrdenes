<?php

// Establecer conexión a la base de datos (usando PDO)
$host = 'localhost';
$dbName = 'compaccser';
$username = 'root';
$password = '';
$aidi = $_GET['id'];

try {
  $pdo = new PDO("mysql:host=$host;dbname=$dbName", $username, $password);
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
  die("Error de conexión a la base de datos: " . $e->getMessage());
}

// Obtener el último número de orden de la base de datos y sumarle 1
try {
  $pdo->beginTransaction();
  $stmt = $pdo->query("DELETE from ordenes where no_Orden=$aidi");


  $pdo->commit();
} catch (PDOException $e) {
  $pdo->rollBack();
  die("Error al obtener el número de orden: " . $e->getMessage());
}
echo "<script>window.close();</script>";