<!DOCTYPE html>
<html lang="EN">

<head>
    <title>Formulario de Orden</title>
    <meta charset="utf-8">
    <style>
        body {
            background-color: #292929;
            padding-bottom: 20px;
            margin: 0;
        }

        .formulario {
            font-family: Arial, sans-serif;
            max-width: 600px;
            margin: 0 auto;
            background-color: rgb(255, 255, 255);
            border: 1px solid #ccc;
            padding: 20px;
            border-radius: 5px;
            height: auto;
        }

        h2 {
            text-align: center;
        }

        label {
            display: block;
            margin-top: 10px;
            font-weight: bold;
        }

        input[type="text"],
        input[type="tel"],
        textarea,
        select {
            width: 585px;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 3px;
            background-color: #ffffff;
        }

        textarea {
            height: 100px;
            width: 585px;
            background-color: #ffffff;
            resize: none;
        }

        .button-container {
            text-align: center;
            margin-top: 20px;
            background-color: #ffffff;
            padding-top: 20px;
        }

        .button-container button {
            padding: 10px 20px;
            background-color: steelblue;
            color: #fff;
            border: none;
            border-radius: 3px;
            cursor: pointer;
            font-size: 16px;

        }

        .navbar {
            background-color: #f8f8f8;
            height: 70px;
            padding: 0 20px;
            margin-bottom: 100px;
            display: flex;
            align-items: center;

        }

        .title {
            margin-left: 435px;
            font-family: "Arial Black", sans-serif;
            font-size: 28px;
        }

        .logo.logo1 img {
            width: auto;
            height: 60px;
            display: inline-flex;

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
        <div class="title">Generar órden</div>
    </div>

    <form class="formulario" method="POST" action="generar-pdf.php" onsubmit="return validarFormulario()">

        <h2>Formulario de Orden</h2>

        <label for="fecha">Fecha:</label>
        <input type="date" id="fecha" name="fecha" value="<?php echo date('Y-m-d'); ?>" />

        <label for="no-orden">No. de Orden:</label>
        <input type="text" id="no-orden" name="no_orden" value="<?php
        $id = $_GET['id'];
        $conexion = mysqli_connect('localhost', 'root', '', 'compaccser', 3306, '');
        $consulta = "SELECT FROM ordenes
                         WHERE no_Orden LIKE '%$id%'";
        $resultado = mysqli_query($conexion, $consulta);
        $dato = mysqli_fetch_assoc($resultado);
        echo $dato['no_Orden'];
        ?>
  " readonly>

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
            <option value="Ingeniero 2">
            <option value="Ingeniero 3">
                <!-- Puedes agregar más opciones de ingenieros aquí si lo deseas -->
        </datalist>

        <div class="button-container">
            <button type="submit">Guardar Orden</button>
        </div>
    </form>
</body>

</html>

<script>

    function autoExpand(textarea) {
        // Ajustar el tamaño del área de texto para adaptarse al contenido
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
            contacto === '' ||
            telefono === '' ||
            celular === '' ||
            descripcion === '' ||
            tipoEquipo === '' ||
            marca === '' ||
            modelo === '' ||
            serie === '' ||
            accesorios === '' ||
            ingeniero === '' ||
            noOrden === ' ' ||
            cliente === ' ' ||
            contacto === ' ' ||
            telefono === ' ' ||
            celular === ' ' ||
            descripcion === ' ' ||
            tipoEquipo === ' ' ||
            marca === ' ' ||
            modelo === ' ' ||
            serie === ' ' ||
            accesorios === ' ' ||
            ingeniero === ' '
        ) {
            alert('Por favor, completa todos los campos obligatorios.');
            return false; // Detener el envío del formulario
        }

        // Si todos los campos requeridos están llenos, permitir el envío del formulario
        return true;
    }

    function autoExpand(textarea) {
        // Ajustar el tamaño del área de texto para adaptarse al contenido
        textarea.style.height = 'auto';
        textarea.style.height = textarea.scrollHeight + 'px';
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


