<!DOCTYPE html>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
<link href='/css/ordenes.css' rel='stylesheet' type='text/css' />
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
          <th>Equipo</th>
          <th>modelo</th>
          <th>Serie</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        <?php
        // Conectar a la base de datos
        $conexion = mysqli_connect('localhost', 'root', '', 'compaccser', 3306, '');

        if (!$conexion) {
          die('Error de conexión a la base de datos: ');
        }
        if ($conexion) {
          echo 'Conexión exitosa';
        }
        if (isset($_GET['buscar']) && !empty($_GET['buscar'])) {
          $buscar = $_GET['buscar'];

          $consulta = "SELECT * FROM ordenes
                         WHERE no_Orden LIKE '%$buscar%'
                         OR cliente LIKE '%$buscar%'
                         OR equipo LIKE '%$buscar%'
                         OR modelo LIKE '%$buscar%'
                         OR serie LIKE '%$buscar%'
                         ORDER BY no_Orden DESC";
        } else {
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
          $serie = $fila['serie'];
          $wrappedSerie = wordwrap($serie, $maxLineLength, "\n", true);
          echo '<td>' . nl2br($wrappedSerie) . '</td>';

          echo '<td>
          <a class="download-btn" href="/php/generar-pdfSQL.php?id=' . $fila['no_Orden'] . '"><i class="fas fa-file-download"></i></a>
          <a class="edit-btn" href="#" data-id="' . $fila['no_Orden'] . '"><i class="fas fa-edit"></i></a>
          <a class="delete-btn" href="#" data-id="' . $fila['no_Orden'] . '"><i class="fas fa-trash"></i></a></td>';
          echo '</tr>';


        }


        // Cerrar la conexión a la base de datos
        mysqli_close($conexion);
        ?>
        <script>
          document.querySelectorAll('.delete-btn').forEach(button => {
            button.addEventListener('click', (event) => {
              event.preventDefault();

              // Mostrar el cuadro de confirmación
              const confirmDelete = window.confirm('¿Estás seguro de que quieres eliminar la orden ' + button.getAttribute('data-id') + '?');

              if (confirmDelete) {
                const id = button.getAttribute('data-id');

                // Si el usuario confirma, se abre la ventana
                window.open(`/php/delete.php?id=${id}`, '_blank');
                setTimeout(location.reload(), 1000);
              }
            });
          });
        </script>
        <script>
          document.querySelectorAll('.edit-btn').forEach(boton => {
            boton.addEventListener('click', (event) => {
              event.preventDefault();
              id = boton.getAttribute('data-id');
              window.open(`/pages/editar.php?id=${id}`, '_blank');
              setTimeout(location.reload(), 1000);
            });
          });
        </script>

      </tbody>
    </table>
  </div>

</body>

</html>