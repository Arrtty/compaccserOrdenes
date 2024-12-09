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
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Ingresar Pie de Página</title>
  <link rel="icon" href="/img/logo.png">

  <style>
    body {
      font-family: Arial, sans-serif;
      max-width: 600px;
      margin: 0 auto;
      padding: 20px;
      text-align: center;
      background-color: #f8f8f8;
      background-color: #292929;
    }

    .formulario-container {
      display: flex;
      width: 100%;

      flex-direction: column;
      align-items: center;
      width: auto;
    }

    .formulario {
      font-family: Arial, sans-serif;
      width: 100%;
      height: 100%;

      margin: 0 auto;
      background-color: rgb(255, 255, 255);
      border: 1px solid #ccc;
      padding: 20px;
      border-radius: 5px;
      height: auto;
      text-align: left;
    }

    .formulario. label {
      display: block;
      font-weight: bold;
      margin-top: 10px;
    }


    textarea {
      width: 100%;
      /* Hacemos el textarea ocupar todo el ancho del formulario */
      height: 400px;
      resize: none;
    }

    button {
      margin-top: 20px;
      padding: 10px 20px;
      background-color: steelblue;
      color: #fff;
      border: none;
      border-radius: 3px;
      cursor: pointer;
      font-size: 16px;
      align-self: center;
    }

    .mensaje {
      text-align: center;
      font-weight: bold;
      margin-top: 20px;
      border: 1px solid #ccc;
      padding: 10px;
      width: 500px;
      word-wrap: break-word;
      color: lightgray;
    }

    .navbar {
    width: 100%;
    background-color: #f8f8f8;
    position: sticky;
    height: 10vmin;
    padding: 0;
    margin-bottom: 10px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
}

.logo.logo1 img {
    width: auto;
    height: 8vmin;
    display: inline-flex;
    background: 0%;
    position: absolute;
    top: 8%;
    left: 2%;

}
.title {
    font-family: "Arial Black", sans-serif;
    font-size: 3vmin;
    justify-content: center;
}
  </style>
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