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

  <form target="_blank" class="formulario" method="POST" action="/php/generar-pdf.php" onsubmit="return validarFormulario()">

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

    <!-- Container for device sections -->
    <div id="device-section-container">
      <div class="device-section">
        <h3>Dispositivo 1</h3>

        <label for="tipo_equipo">Tipo de Equipo:</label>
        <input type="text" id="tipo_equipo0" name="tipo_equipo">

        <label for="marca">Marca:</label>
        <input type="text" id="marca0" name="marca">

        <label for="modelo">Modelo:</label>
        <input type="text" id="modelo0" name="modelo">

        <label for="serie">Serie:</label>
        <input type="text" id="serie0" name="serie">

        <label for="descripcion">Descripción de la Falla:</label>
        <textarea id="descripcion" name="descripcion" rows="4" oninput="autoExpand(this)"></textarea>
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


    <!-- Add more devices -->
    <div class="button-container">
      <button type="button" id="addBtn" onclick="addDeviceSection()">Agregar otro dispositivo</button>
    </div>

    <!-- Non-repeated fields -->
    <label for="accesorios">Accesorios Recibidos:</label>
    <textarea id="accesorios" name="accesorios" rows="4" oninput="autoExpand(this)"></textarea>

    <label for="ingeniero">Ingeniero de Soporte:</label>
    <input type="text" id="ingeniero" name="ingeniero" list="lista_ingenieros">
    <datalist id="lista_ingenieros">
      <option value="Estanislao Santiago Francisco">
      <option value="Diana Laura Contreras V.">
      <option value="Rocío Gpe. López Navarro">
    </datalist>

    <div class="button-container">
      <button type="submit">Guardar Orden</button>
    </div>
  </form>
</body>

</html>
<script>

  let clickCount = 1;

  function addDeviceSection() {
    clickCount++;
    let sectioncount = "section" + clickCount;
    document.getElementById(sectioncount).style.display = 'block';
    if (clickCount >= 3) {
      document.getElementById('addBtn').style.display = 'none';

    }
  }
  // Text area auto expand
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


