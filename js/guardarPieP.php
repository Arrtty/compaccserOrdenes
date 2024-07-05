<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
  // Obtener el texto del pie de página enviado por el formulario
  $textoPiePagina = $_POST["texto"];

  // Validar que el texto no esté vacío
  if (empty($textoPiePagina)) {
    die("Error: Debes ingresar el pie de página.");
  }

  // Establecer conexión a la base de datos (usando PDO)
  $host = 'localhost';
  $dbName = 'compaccser';
  $username = 'root';
  $password = '';

  try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbName", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Insertar el pie de página en la tabla 'formato'
    $stmt = $pdo->prepare("INSERT INTO formato (fecha, pieP) VALUES (CURRENT_DATE(), :pieP)");
    $stmt->bindParam(':pieP', $textoPiePagina);
    $stmt->execute();

    echo "El pie de página se ha guardado correctamente.";
  } catch (PDOException $e) {
    die("Error al guardar el pie de página: " . $e->getMessage());
  }
}
