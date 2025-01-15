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

    <!-- Other form fields -->
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

    <!-- Container for device sections -->
    <div id="device-section-container">
      <div class="device-section">
        <h3>Dispositivo 1</h3>

        <label for="tipo_equipo">Tipo de Equipo:</label>
        <input type="text" id="tipo_equipo0" name="tipo_equipo" required>

        <label for="marca">Marca:</label>
        <input type="text" id="marca0" name="marca" required>

        <label for="modelo">Modelo:</label>
        <input type="text" id="modelo0" name="modelo" required>

        <label for="serie">Serie:</label>
        <input type="text" id="serie0" name="serie" required>

        <label for="descripcion">Descripción de la Falla:</label>
        <textarea id="descripcion" name="descripcion" rows="4" oninput="autoExpand(this)" required></textarea>
      </div>
      <!-- ---------------------------------------------------------------- -->
      <div class="device-section" id="section2" style="display: none;">
        <h3>Dispositivo 2</h3>

        <label for="tipo_equipo">Tipo de Equipo:</label>
        <input type="text" id="tipo_equipo2" name="tipo_equipo2">

        <label for="marca">Marca:</label>
        <input type="text" id="marca2" name="marca2">

        <label for="modelo">Modelo:</label>
        <input type="text" id="modelo2" name="modelo2">

        <label for="serie">Serie:</label>
        <input type="text" id="serie2" name="serie2">

        <label for="descripcion">Descripción de la Falla:</label>
        <textarea id="descripcion2" name="descripcion2" rows="4" oninput="autoExpand(this)"></textarea>
      </div>
      <!-- ---------------------------------------------------------------- -->
      <div class="device-section" id="section3" style="display: none;">
        <h3>Dispositivo 3</h3>

        <label for="tipo_equipo">Tipo de Equipo:</label>
        <input type="text" id="tipo_equipo3" name="tipo_equipo3">

        <label for="marca">Marca:</label>
        <input type="text" id="marca3" name="marca3">

        <label for="modelo">Modelo:</label>
        <input type="text" id="modelo3" name="modelo3">

        <label for="serie">Serie:</label>
        <input type="text" id="serie3" name="serie3">

        <label for="descripcion">Descripción de la Falla:</label>
        <textarea id="descripcion3" name="descripcion3" rows="4" oninput="autoExpand(this)"></textarea>
      </div>
    </div>


    <!-- Button to add another device -->
    <div class="button-container">
      <button type="button" id="addBtn" onclick="addDeviceSection()">Agregar otro dispositivo</button>
    </div>

    <!-- Non-repeated fields -->
    <label for="accesorios">Accesorios Recibidos:</label>
    <textarea id="accesorios" name="accesorios" rows="4" oninput="autoExpand(this)"
      onblur="convertToList(this)"></textarea>

    <label for="ingeniero">Ingeniero de Soporte:</label>
    <input type="text" id="ingeniero" name="ingeniero" list="lista_ingenieros" required>
    <datalist id="lista_ingenieros">
      <option value="Estanislao Santiago Francisco">
      <option value="Ingeniero 2">
      <option value="Ingeniero 3">
    </datalist>

    <div class="button-container">
      <button type="submit">Guardar Orden</button>
    </div>
  </form>
</body>

</html>

<!-- Add section script -->
<script>
  let clickCount = 1;

  function addDeviceSection() {
    clickCount++;
    let sectioncount = "section" + clickCount;
    console.log(sectioncount);
    document.getElementById(sectioncount).style.display = 'block';
    if (clickCount >= 3) {
      document.getElementById('addBtn').style.display = 'none';

    }
    /*
          let container = document.getElementById('device-section-container');
          let newSection = document.createElement('div');
          newSection.className = 'device-section';
          newSection.innerHTML = `
            <h3>Dispositivo ${deviceCount + 1}</h3>
    
            <label for="tipo_equipo${deviceCount}">Tipo de Equipo:</label>
            <input type="text" id="tipo_equipo${deviceCount}" name="tipo_equipo" required>
    
            <label for="marca${deviceCount}">Marca:</label>
            <input type="text" id="marca${deviceCount}" name="marca" required>
    
            <label for="modelo${deviceCount}">Modelo:</label>
            <input type="text" id="modelo${deviceCount}" name="modelo" required>
    
            <label for="serie${deviceCount}">Serie:</label>
            <input type="text" id="serie${deviceCount}" name="serie" required>
    
            <label for="descripcion${deviceCount}">Descripción de la Falla:</label>
            <textarea id="descripcion${deviceCount}" name="descripcion" rows="4" oninput="autoExpand(this)" required></textarea>
          `;
          container.appendChild(newSection);
          */
    deviceCount++;
  }

</script>
<script>

  // Text area auto expand
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



</script>
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

// Obtener el último número de orden de la base de datos y sumarle 1
try {
  $pdo->beginTransaction();
  $stmt = $pdo->query("SELECT MAX(no_Orden) AS last_order FROM ordenes");
  $lastOrder = $stmt->fetch(PDO::FETCH_ASSOC)['last_order'];
  $nextOrder = $lastOrder + 1;

  // Actualizar el campo "No. de Orden" en el formulario
  echo '<script>document.getElementById("no-orden").value = ' . $nextOrder . ';</script>';

  $pdo->commit();
} catch (PDOException $e) {
  $pdo->rollBack();
  die("Error al obtener el número de orden: " . $e->getMessage());
}


