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
    <div class="title">Editar órden</div>
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

    <div id="device-section-container">
      <div class="device-section">
        <h3>Dispositivo 1</h3>

        <label for="tipo_equipo">Tipo de Equipo:</label>
        <input type="text" id="tipo_equipo0" name="tipo_equipo" maxlength="245">

        <label for="marca">Marca:</label>
        <input type="text" id="marca0" name="marca" maxlength="245">

        <label for="modelo">Modelo:</label>
        <input type="text" id="modelo0" name="modelo" maxlength="245">

        <label for="serie">Serie:</label>
        <input type="text" id="serie0" name="serie" maxlength="245">

        <label for="descripcion">Descripción de la Falla:</label>
        <textarea id="descripcion" name="descripcion" rows="4" oninput="autoExpand(this)" maxlength="245"></textarea>
      </div>
      <!-- ---------------------------------------------------------------- -->
      <div class="device-section" id="section2" style="display: none;">
        <h3>Dispositivo 2</h3>

        <label for="tipo_equipo">Tipo de Equipo:</label>
        <input type="text" id="tipo_equipo2" name="tipo_equipo2" maxlength="245">

        <label for="marca">Marca:</label>
        <input type="text" id="marca2" name="marca2" maxlength="245">

        <label for="modelo">Modelo:</label>
        <input type="text" id="modelo2" name="modelo2" maxlength="245">

        <label for="serie">Serie:</label>
        <input type="text" id="serie2" name="serie2" maxlength="245">

        <label for="descripcion">Descripción de la Falla:</label>
        <textarea id="descripcion2" name="descripcion2" rows="4" oninput="autoExpand(this)" maxlength="245"></textarea>
      </div>
      <!-- ---------------------------------------------------------------- -->
      <div class="device-section" id="section3" style="display: none;">
        <h3>Dispositivo 3</h3>

        <label for="tipo_equipo">Tipo de Equipo:</label>
        <input type="text" id="tipo_equipo3" name="tipo_equipo3" maxlength="245">

        <label for="marca">Marca:</label>
        <input type="text" id="marca3" name="marca3" maxlength="245">

        <label for="modelo">Modelo:</label>
        <input type="text" id="modelo3" name="modelo3" maxlength="245">

        <label for="serie">Serie:</label>
        <input type="text" id="serie3" name="serie3" maxlength="245">

        <label for="descripcion">Descripción de la Falla:</label>
        <textarea id="descripcion3" name="descripcion3" rows="4" oninput="autoExpand(this)" maxlength="245"></textarea>
      </div>
    </div>


    <!-- Add more devices -->
    <div class="button-container">
      <button type="button" id="addBtn" onclick="addDeviceSection()">Agregar otro dispositivo</button>
    </div>

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
    <input type="hidden" name="action" value="update">
    <div class="button-container">
      <button type="submit">Guardar Orden</button>
    </div>
  </form>
</body>

</html>
<script>
  // Añadir dispositivos en el
  let clickCount = 1;
  function addDeviceSection() {
    if (document.getElementById('section2').style.display === 'none') {
      document.getElementById('section2').style.display = 'block';
    } else if (document.getElementById('section3').style.display === 'none') {
      document.getElementById('section3').style.display = 'block';
      document.getElementById('addBtn').style.display = 'none';
    }
    if (document.getElementById('section3').style.display === 'block' && document.getElementById('section2').style.display === 'block') {
      document.getElementById('addBtn').style.display = 'none';
    }
  }
  function autoExpand(textarea) {
    textarea.style.height = 'auto';
    textarea.style.height = textarea.scrollHeight + 'px';
  }

  function validarFormulario() {
    const fields = [
      { id: 'fecha', message: 'Por favor, seleccione una fecha.' },
      { id: 'contacto', message: 'Por favor, complete el contacto.' },
      { id: 'cliente', message: 'Por favor, complete el nombre del cliente.' },
      { id: 'telefono', message: 'Por favor, complete el teléfono del cliente.' },
      { id: 'celular', message: 'Por favor, complete el celular del cliente.' },
      { id: 'tipo_equipo0', message: 'Por favor, complete el tipo de equipo del dispositivo 1.' },
      { id: 'marca0', message: 'Por favor, complete la marca del dispositivo 1.' },
      { id: 'modelo0', message: 'Por favor, complete el modelo del dispositivo 1.' },
      { id: 'serie0', message: 'Por favor, complete la serie del dispositivo 1.' },
      { id: 'descripcion', message: 'Por favor, complete la descripción de la falla del dispositivo 1.' }
    ];

    for (let field of fields) {
      let element = document.getElementById(field.id);
      if (!element || element.value.trim() === '') {
        alert(field.message);
        return false;
      }
    }
    setTimeout(() => {
      location.href = "/pages/ordenes.php";

    }, 2000);
    return true;
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
$deviceCount = 1;
$fila = mysqli_fetch_assoc($resultado);
$telefono = str_replace(' ', '', $fila['telefono']);
$celular = str_replace(' ', '', $fila['celular']);
echo '<script>document.getElementById("no-orden").value = ' . $aidi . '</script>';
echo '<script>document.getElementById("contacto").value = ' . json_encode($fila['contacto']) . '</script>';
echo '<script>document.getElementById("cliente").value = ' . json_encode($fila['cliente']) . '</script>';
echo '<script>document.getElementById("telefono").value = ' . $telefono . '</script>';
echo '<script>document.getElementById("celular").value = ' . $celular . '</script>';
echo '<script>document.getElementById("ingeniero").value = ' . json_encode($fila['ingeniero']) . '</script>';
echo '<script>document.getElementById("accesorios").value = ' . json_encode($fila['accsesorios']) . '</script>';

echo '<script>document.getElementById("descripcion").value = ' . json_encode($fila['descripcion']) . '</script>';
echo '<script>document.getElementById("tipo_equipo0").value = ' . json_encode($fila['equipo']) . '</script>';
echo '<script>document.getElementById("marca0").value = ' . json_encode($fila['marca']) . '</script>';
echo '<script>document.getElementById("modelo0").value = ' . json_encode($fila['modelo']) . '</script>';
echo '<script>document.getElementById("serie0").value = ' . json_encode($fila['serie']) . '</script>';

if ($fila['marca2'] != null || $fila['modelo2'] != null || $fila['serie2'] != null || $fila['descripcion2'] != null) {
  $deviceCount++;
  echo '<script>document.getElementById("section2").style.display = "block";</script>';
  echo '<script>document.getElementById("tipo_equipo2").value = ' . json_encode($fila['equipo2']) . '</script>';
  echo '<script>document.getElementById("marca2").value = ' . json_encode($fila['marca2']) . '</script>';
  echo '<script>document.getElementById("modelo2").value = ' . json_encode($fila['modelo2']) . '</script>';
  echo '<script>document.getElementById("serie2").value = ' . json_encode($fila['serie2']) . '</script>';
  echo '<script>document.getElementById("descripcion2").value = ' . json_encode($fila['descripcion2']) . '</script>';
}
if ($fila['marca3'] != null || $fila['modelo3'] != null || $fila['serie3'] != null || $fila['descripcion3'] != null) {
  $deviceCount++;
  echo '<script>document.getElementById("section3").style.display = "block";</script>';
  echo '<script>document.getElementById("tipo_equipo3").value = ' . json_encode($fila['equipo3']) . '</script>';
  echo '<script>document.getElementById("marca3").value = ' . json_encode($fila['marca3']) . '</script>';
  echo '<script>document.getElementById("modelo3").value = ' . json_encode($fila['modelo3']) . '</script>';
  echo '<script>document.getElementById("serie3").value = ' . json_encode($fila['serie3']) . '</script>';
  echo '<script>document.getElementById("descripcion3").value = ' . json_encode($fila['descripcion3']) . '</script>';
}
if ($deviceCount >= 3) {
  echo '<script>document.getElementById("addBtn").style.display = "none";</script>';
}


;

mysqli_close($conexion);
?>