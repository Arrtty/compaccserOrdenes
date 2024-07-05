<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tabla de Datos</title>
  <style>
    body {
      background-color: #292929;
      font-family: Arial, sans-serif;
      color: white;
      margin: 0;
      padding: 0;
      padding-top: 90px;
      /* Añade espacio para la barra de navegación fija */
    }

    .download-btn {
      padding: 6px 12px;
      background-color: #4CAF50;
      color: #fff;
      border: none;
      border-radius: 4px;
      text-decoration: none;
      display: inline-flex;
      word-wrap: break-word;
    }

    .download-btn:hover {
      background-color: #45a049;
    }

    .logo.logo1 img {
      width: auto;
      height: 60px;
      display: inline-flex;
    }

    .navbar {
      background-color: #f8f8f8;
      height: 70px;
      padding: 0 20px;
      position: fixed;
      /* Cambiado a fixed para que siempre esté visible */
      top: 0;
      left: 0;
      width: 100%;
      z-index: 1;
      display: flex;
      align-items: center;
      justify-content: space-between;
      /* Asegura el espacio entre los elementos */
      box-sizing: border-box;
      margin-bottom: 20px;
    }

    .navbar .title {
      flex: 1;
      /* Permite que el título ocupe el espacio disponible */
      text-align: center;
      /* Centra el título horizontalmente */
    }

    .navbar form {
      flex: 0 0 auto;
      /* Evita que el formulario se estire */
      display: flex;
      align-items: center;
    }

    .navbar form input[type="text"] {
      padding: 5px;
      font-size: 16px;
    }

    .navbar form input[type="submit"] {
      padding: 5px 10px;
      font-size: 16px;
      margin-left: 5px;
    }

    .title {
      margin-left: 435px;
      font-family: "Arial Black", sans-serif;
      font-size: 28px;
      display: flex;
      color: black;
    }

    form {
      margin-left: auto;
      margin-right: 40px;
    }

    .table-wrapper {
      overflow-x: auto;
      /* Añadido para permitir desplazamiento horizontal */
      margin: 20px;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      margin: 20px 0;
      font-size: 18px;
      text-align: left;
      table-layout: fixed;
      /* Añadido para que las columnas tengan un ancho fijo */
    }

    table th,
    table td {
      padding: 12px;
      border: 1px solid #ddd;
      word-wrap: break-word;
      /* Permite el ajuste de palabras largas */
      overflow: hidden;
      text-overflow: ellipsis;
      /* Trunca el texto con puntos suspensivos */
      white-space: nowrap;
      /* Evita que el texto se envuelva en varias líneas */
    }

    table th {
      background-color: #454545;
      color: white;
    }

    h1 {
      text-align: center;
      margin-top: 20px;
    }

    @media (max-width: 600px) {
      .navbar {
        flex-direction: column;
        align-items: flex-start;
        height: auto;
      }

      .navbar .title {
        text-align: left;
        margin: 10px 0;
      }

      table {
        font-size: 14px;
      }

      table th,
      table td {
        font-size: 12px;
      }
    }
  </style>
</head>

<body>
  <div class="navbar">
    <div class="logo logo1">
      <a href="index.html">
        <img src="logo.JPEG" alt="Logo 1">
      </a>
    </div>
    <div class="title">Órdenes</div>
    <form action="" method="get">
      <input type="text" name="buscar" placeholder="Buscar...">
      <input type="submit" value="Buscar">
    </form>
  </div>

  <h1>Tabla de Datos</h1>
  <div class="table-wrapper">
    <table>
      <thead>
        <tr>
          <th>Número de Orden</th>
          <th>Fecha</th>
          <th>Cliente</th>
          <th>Marca</th>
          <th>Equipo</th>
          <th>Falla</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        <?php
        // Conectar a la base de datos
        $conexion = mysqli_connect('localhost', 'root', '', 'compaccser', 3306, '');

        // Verificar la conexión
        if (!$conexion) {
          die('Error de conexión a la base de datos: ');
        }
        if ($conexion) {
          echo 'Conexión exitosa';
        }
        if (isset($_GET['buscar']) && !empty($_GET['buscar'])) {
          $buscar = $_GET['buscar'];

          // Construir la consulta SQL con la cláusula WHERE para filtrar los registros
          $consulta = "SELECT * FROM ordenes
                         WHERE no_Orden LIKE '%$buscar%'
                         OR fecha LIKE '%$buscar%'
                         OR cliente LIKE '%$buscar%'
                         OR equipo LIKE '%$buscar%'
                         OR modelo LIKE '%$buscar%'
                         OR descripcion LIKE '%$buscar%'
                         ORDER BY no_Orden DESC";
        } else {
          // Consulta sin filtro si no se ingresó un término de búsqueda
          $consulta = "SELECT * FROM ordenes ORDER BY no_Orden DESC";
        }

        // Realizar la consulta SQL
        $resultado = mysqli_query($conexion, $consulta);

        // Mostrar los datos en la tabla
        while ($fila = mysqli_fetch_assoc($resultado)) {
          echo '<tr>';
          echo '<td>' . $fila['no_Orden'] . '</td>';
          echo '<td>' . $fila['fecha'] . '</td>';
          echo '<td>' . $fila['cliente'] . '</td>';

          $maxLineLength = 30;
          $equipo = $fila['equipo'];
          $wrappedEquipo = wordwrap($equipo, $maxLineLength, "\n", true);
          echo '<td>' . nl2br($wrappedEquipo) . '</td>';

          echo '<td>' . $fila['modelo'] . '</td>';

          $maxLineLength = 50;
          $descripcion = $fila['descripcion'];
          $wrappedDescripcion = wordwrap($descripcion, $maxLineLength, "\n", true);
          echo '<td>' . nl2br($wrappedDescripcion) . '</td>';

          echo '<td><a class="download-btn" href="generar-pdfSQL.php?id=' . $fila['no_Orden'] . '">Descargar PDF</a></td>';
          echo '</tr>';
        }

        // Cerrar la conexión a la base de datos
        mysqli_close($conexion);
        ?>
      </tbody>
    </table>
  </div>
</body>

</html>