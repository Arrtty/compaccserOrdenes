<!DOCTYPE html>
<link rel='stylesheet' type='text/css' href='/css/ordenes.css' />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tabla de Datos</title>
  <link rel="icon" href="/img/logo.png">
</head>
<body>
  <div class="navbar">
    <div class="logo logo1">
      <a href="/">
        <img src="/img/logo.png" alt="Logo 1">
      </a>
    </div>
    <div class="title">Órdenes</div>
    <form action="" method="get">
      <input type="text" name="buscar" placeholder="Buscar...">
      <input type="submit" value="Buscar">
    </form>
  </div>
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

          echo '<td>
          <a class="download-btn" href="/php/generar-pdfSQL.php?id=' . $fila['no_Orden'] . '"><i class="fas fa-file-download"></i></a>
          <a class="edit-btn" href="#" data-id="' . $fila['no_Orden'] . '"><i class="fas fa-edit"></i></a>
          <a class="delete-btn" href="generar-pdfSQL.php?id=' . $fila['no_Orden'] . '"><i class="fas fa-trash"></i></a></td>';
          echo '</tr>';


        }


        // Cerrar la conexión a la base de datos
        mysqli_close($conexion);
        ?>
        <script>
          document.querySelectorAll('.edit-btn').forEach(button => {
            button.addEventListener('click', (event) => {
              event.preventDefault();
              const id = button.getAttribute('data-id');
              // Abrir en una nueva pestaña
              window.open(`/pages/editar.php?id=${id}`, '_blank');
              // Recargar la página actual
              location.reload();
            });
          });
        </script>

      </tbody>
    </table>
  </div>

</body>

</html>