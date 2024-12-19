<!DOCTYPE html>
<html lang="EN">

<head>
  <title>Formulario de Orden</title>
  <meta charset="utf-8">
  <link rel="icon" href="/img/logo.png">
  <link rel="stylesheet" href="/css/generar-orden.css">
</head>

<body>
  <div class="navbar">
    <div class="logo logo1">
      <a href="/">
        <img src="/img/logo.png" alt="Logo 1">
      </a>
    </div>
    <div class="title">Generar órden</div>
  </div>

  <form target="_blank" class="formulario" method="POST" action="/php/generar-pdf.php"
    onsubmit="return validarFormulario()">

    <h2>Formulario de Orden</h2>

    <label for="fecha">Fecha:</label>
    <input type="date" id="fecha" name="fecha" value="<?php echo date('Y-m-d'); ?>" />

    <label for="no-orden">No. de Orden:</label>
    <input type="text" id="no-orden" name="no_orden" readonly>

    <label for="contacto">Contacto:</label>
    <input type="text" id="contacto" name="contacto">

    <label for="cliente">Cliente:</label>
    <input type="text" id="cliente" name="cliente">

    <label for="telefono">Teléfono:</label>
    <input type="number" id="telefono" name="telefono">

    <label for="celular">Celular:</label>
    <input type="number" id="celular" name="celular">

    <label for="descripcion">Descripción de la Falla:</label>
    <textarea id="descripcion" name="descripcion" rows="4" oninput="autoExpand(this)"></textarea>

    <label for="tipo_equipo">Tipo de Equipo:</label>
    <input type="text" id="tipo_equipo" name="tipo_equipo">

    <label for="marca">Marca:</label>
    <input type="text" id="marca" name="marca">

    <label for="modelo">Modelo:</label>
    <input type="text" id="modelo" name="modelo">

    <label for="serie">Serie:</label>
    <input type="text" id="serie" name="serie">

    <label for="accesorios">Accesorios Recibidos:</label>
    <textarea id="accesorios" name="accesorios" rows="4" oninput="autoExpand(this)"
      onblur="convertToList(this)"></textarea>


    <label for="ingeniero">Ingeniero de Soporte:</label>
    <input type="text" id="ingeniero" name="ingeniero" list="lista_ingenieros">
    <datalist id="lista_ingenieros">
      <option value="Estanislao Santiago Francisco">
      <option value="Rocío Gpe. López Navarro">
      <option value="Diana Laura Contreras V.">

    </datalist>

    <div class="button-container">
      <button type="submit">Guardar Orden</button>
    </div>
  </form>
</body>

</html>


<script>

  function autoExpand(textarea) {

    textarea.style.height = 'auto';
    textarea.style.height = textarea.scrollHeight + 'px';
  }

  function validarFormulario() {
    var noOrden = document.getElementById('no-orden').value;
    var cliente = document.getElementById('cliente').value;
    var contacto = document.getElementById('contacto').value;
    var telefono = document.getElementById('telefono').value;
    var celular = document.getElementById('celular').value;
    var descripcion = document.getElementById('descripcion').value;
    var tipoEquipo = document.getElementById('tipo_equipo').value;
    var marca = document.getElementById('marca').value;
    var modelo = document.getElementById('modelo').value;
    var serie = document.getElementById('serie').value;
    var accesorios = document.getElementById('accesorios').value;
    var ingeniero = document.getElementById('ingeniero').value;

    // Verificar si algún campo requerido está vacío
    if (
      noOrden === '' ||
      cliente === '' ||
      celular === '' ||
      descripcion === '' ||
      tipoEquipo === '' ||
      marca === '' ||
      modelo === '' ||
      serie === '' ||
      accesorios === '' ||
      ingeniero === ''
    ) {
      alert('Por favor, completa todos los campos obligatorios.');
      return false; // Detener el envío del formulario
    } else {
      window.location.href = '/pages/ordenes.php';
      return true; // Permitir el envío del formulario
    }
  }

  function autoExpand(textarea) {
    // Ajustar el tamaño del área de texto para adaptarse al contenido
    textarea.style.height = 'auto';
    textarea.style.height = textarea.scrollHeight + 'px';
  }
</script>
<?php
        $aidi = $_GET['id'];
        $conexion = mysqli_connect('localhost', 'root', '', 'compaccser', 3306, '');

        if (!$conexion) {
          die('Error de conexión a la base de datos: ');
        }

          $consulta = "SELECT * FROM ordenes WHERE no_Orden=$aidi";

        // Realizar la consulta SQL
        $resultado = mysqli_query($conexion, $consulta);

        // Mostrar los datos en la tabla
        $fila = mysqli_fetch_assoc($resultado);
        $telefono = str_replace(' ', '', $fila['telefono']);
        $celular = str_replace(' ', '', $fila['celular']);
        echo '<script>document.getElementById("no-orden").value = ' . $aidi . '</script>';
        echo '<script>document.getElementById("contacto").value = '.json_encode($fila['contacto']).'</script>';
        echo '<script>document.getElementById("cliente").value = '.json_encode($fila['cliente']).'</script>';
        echo '<script>document.getElementById("telefono").value = '.$telefono.'</script>';
        echo '<script>document.getElementById("celular").value = '.$celular.'</script>';
        echo '<script>document.getElementById("descripcion").value = '.json_encode($fila['descripcion']).'</script>';
        echo '<script>document.getElementById("tipo_equipo").value = '.json_encode($fila['contacto']).'</script>';
        echo '<script>document.getElementById("marca").value = '.json_encode($fila['marca']).'</script>';
        echo '<script>document.getElementById("modelo").value = '.json_encode($fila['modelo']).'</script>';
        echo '<script>document.getElementById("serie").value = '.json_encode($fila['serie']).'</script>';
        echo '<script>document.getElementById("ingeniero").value = '.json_encode($fila['ingeniero']).'</script>';
        echo '<script>document.getElementById("accesorios").value = '.json_encode($fila['accsesorios']).'</script>';
        
        
  ;
          
        mysqli_close($conexion);
        ?>