<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
  // Obtener el texto del pie de página enviado por el formulario
  $textoPiePagina = $_POST["texto"];

  // Validar que el texto no esté vacío
  if (empty($textoPiePagina)) {
    echo '<script>alert("Error: Debes ingresar el pie de página.");</script>';
  } else {
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

      echo '<script>alert("El pie de página se ha guardado correctamente.");</script>';
    } catch (PDOException $e) {
      die("Error al guardar el pie de página: " . $e->getMessage());
    }
  }
}
?>
<?php


$host = 'localhost';
$dbName = 'compaccser';
$username = 'root';
$password = '';
// Obtener el último pie de página almacenado en la tabla 'formato'
try {
  $pdo = new PDO("mysql:host=$host;dbname=$dbName", $username, $password);
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  $stmt = $pdo->query("SELECT pieP FROM formato ORDER BY ver DESC LIMIT 1");
  $ultimoPiePagina = $stmt->fetch(PDO::FETCH_ASSOC)['pieP'];
} catch (PDOException $e) {
  die("Error al obtener el pie de página: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<link rel="stylesheet" href="/css/formato.css">
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Ingresar Pie de Página</title>
  <link rel="icon" href="/img/logo.png">
</head>

<body>
  <div class="navbar">
    <div class="logo logo1">
      <a href="/">
        <img src="/img/logo.png" alt="Logo 1">
      </a>
    </div>
    <div class="title">Formato</div>
  </div>

  <div class="formulario-container">
    <h2>Nuevo pie de página</h2>
    <form class="formulario" method="post">
      <label for="texto">Texto del pie de página:</label>
      <textarea id="texto" name="texto"
        placeholder="Ingrese el pie de página"><?php echo $ultimoPiePagina; ?></textarea>
      <button id="boton" type="submit">Guardar</button>
    </form>
  </div>
</body>

</html>