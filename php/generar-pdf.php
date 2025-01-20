<?php

require_once('../TCPDF-main/tcpdf.php');

class MYPDF extends TCPDF
{

  //Page header
  public function Header()
  {
    // Logo
    $image_file = K_PATH_IMAGES . 'logoC.jpg';
    $this->Image($image_file, 10, 10, 15, '', 'JPG', '', 'T', false, 300, '', false, false, 0, false, false, false);
    // Set font
    $this->setFont('helvetica', 'B', 20);
    // Title
    $this->Cell(0, 15, '<< TCPDF Example 003 >>', 0, false, 'C', 0, '', 0, false, 'M', 'M');
  }

  // Page footer
  public function Footer()
  {
    // Position at 15 mm from bottom
    $this->SetY(-15);
    // Set font
    $this->SetFont('helvetica', 'I', 8);
    // Page number
    $this->Cell(0, 10, 'Page ' . $this->getAliasNumPage() . '/' . $this->getAliasNbPages(), 0, false, 'C', 0, '', 0, false, 'T', 'M');
  }
}

$fecha = date('Y-m-d', strtotime($_POST['fecha']));
$no_Orden = !empty($_POST['no_orden']) ? $_POST['no_orden'] : 00000;
$cliente = !empty($_POST['cliente']) ? $_POST['cliente'] : "";
$contacto = !empty($_POST['contacto']) ? $_POST['contacto'] : "";
$telefono = !empty($_POST['telefono']) ? $_POST['telefono'] : "";
$celular = !empty($_POST['celular']) ? $_POST['celular'] : "";
$ingeniero = !empty($_POST['ingeniero']) ? $_POST['ingeniero'] : "";
$accesorios = !empty($_POST['accesorios']) ? $_POST['accesorios'] : "";

// Validar y asignar "" si no hay informacion en la sección 1
$descripcion = !empty($_POST['descripcion']) ? $_POST['descripcion'] : "";
$tipo_equipo = !empty($_POST['tipo_equipo']) ? $_POST['tipo_equipo'] : "";
$marca = !empty($_POST['marca']) ? $_POST['marca'] : "";
$modelo = !empty($_POST['modelo']) ? $_POST['modelo'] : "";
$serie = !empty($_POST['serie']) ? $_POST['serie'] : "";

// Validar y asignar "" si no hay informacion en la sección 2
$descripcion2 = !empty($_POST['descripcion2']) ? $_POST['descripcion2'] : "";
$tipo_equipo2 = !empty($_POST['tipo_equipo2']) ? $_POST['tipo_equipo2'] : "";
$marca2 = !empty($_POST['marca2']) ? $_POST['marca2'] : "";
$modelo2 = !empty($_POST['modelo2']) ? $_POST['modelo2'] : "";
$serie2 = !empty($_POST['serie2']) ? $_POST['serie2'] : "";

// Validar y asignar "" si no hay informacion en la seccion 3
$descripcion3 = !empty($_POST['descripcion3']) ? $_POST['descripcion3'] : "";
$tipo_equipo3 = !empty($_POST['tipo_equipo3']) ? $_POST['tipo_equipo3'] : "";
$marca3 = !empty($_POST['marca3']) ? $_POST['marca3'] : "";
$modelo3 = !empty($_POST['modelo3']) ? $_POST['modelo3'] : "";
$serie3 = !empty($_POST['serie3']) ? $_POST['serie3'] : "";


// Establecer conexión a la base de datos (usando PDO)
$host = 'localhost';
$dbName = 'compaccser';
$username = 'root';
$password = '';
/*
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbName", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  } catch (PDOException $e) {
    die("Error de conexión a la base de datos: " . $e->getMessage());
  }
  // Obtén los datos del formulario

  try {

    $pdo->beginTransaction();
    $stmt = $pdo->prepare("INSERT INTO ordenes 
    (fecha, cliente, telefono, celular, descripcion, equipo, marca, modelo, serie, accsesorios, ingeniero, contacto,
     descripcion2, marca2, equipo2, modelo2, serie2,
    descripcion3, marca3, equipo3, modelo3, serie3) 
     VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?,?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->execute([
      $fecha,
      $cliente,
      $telefono,
      $celular,
      $descripcion,
      $tipo_equipo,
      $marca,
      $modelo,
      $serie,
      $accesorios,
      $ingeniero,
      $contacto,
      $descripcion2,
      $marca2,
      $tipo_equipo2,
      $modelo2,
      $serie2,
      $descripcion3,
      $marca3,
      $tipo_equipo3,
      $modelo3,
      $serie3
    ]);
    $pdo->commit();

  } catch (PDOException $e) {
    $pdo->rollBack();
    die("Error al guardar el registro: " . $e->getMessage());
  }
}*/
// Database connection
$action = $_POST['action'];
echo '<script>console.log($action)</script>;';
$conn = new mysqli($host, $username, $password, $dbName);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

if ($action == 'insert') {
  $sql = "INSERT INTO ordenes (fecha, cliente, contacto, telefono, celular, ingeniero, accsesorios, descripcion, equipo, marca, modelo, serie, descripcion2, equipo2, marca2, modelo2, serie2, descripcion3, equipo3, marca3, modelo3, serie3)
          VALUES ('$fecha', '$cliente', '$contacto', '$telefono', '$celular', '$ingeniero', '$accesorios', '$descripcion', '$tipo_equipo', '$marca', '$modelo', '$serie', '$descripcion2', '$tipo_equipo2', '$marca2', '$modelo2', '$serie2', '$descripcion3', '$tipo_equipo3', '$marca3', '$modelo3', '$serie3')";
}
if ($action == 'update') {
  $sql = "UPDATE ordenes SET fecha='$fecha', cliente='$cliente', contacto='$contacto', telefono='$telefono', celular='$celular', ingeniero='$ingeniero', accsesorios='$accesorios', descripcion='$descripcion', equipo='$tipo_equipo', marca='$marca', modelo='$modelo', serie='$serie', descripcion2='$descripcion2', equipo2='$tipo_equipo2', marca2='$marca2', modelo2='$modelo2', serie2='$serie2', descripcion3='$descripcion3', equipo3='$tipo_equipo3', marca3='$marca3', modelo3='$modelo3', serie3='$serie3' WHERE no_Orden='$no_Orden'";
}

if ($conn->query($sql) === TRUE) {
  echo "Record updated/inserted successfully";
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();

$fecha = date('d/m/Y');
// Crear una instancia de TCPDF
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// Configurar el encabezado y pie de página
$headerPDF = "COMPACCSER Computadoras, Accesorios, consumibles y servicios";

$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, $headerPDF, "AV 18 DE OCTUBRE 133-C COL. Chapala TEL 922 224 0084 MINATITLAN VERACRUZ", array(0, 0, 180), array(0, 0, 0));
$pdf->setFooterData(array(0, 64, 0), array(0, 64, 128));

// Establecer el formato de la página
$pdf->SetCreator('Compaccser');
$pdf->SetAuthor('Compacsser');
$pdf->SetTitle('Orden');
$pdf->SetSubject('Orden');
$pdf->SetKeywords('PDF, Orden de servicio');
$pdf->setMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP);
$pdf->setHeaderMargin(PDF_MARGIN_HEADER);

// Agregar una página
$pdf->AddPage();

// Agregar contenido al PDF
$pdf->SetFont('times', '', 12);
$pdf->Cell(100, 5, 'Minatitlán, Ver. A ' . $fecha, 0, 0);
$pdf->SetTextColor(255, 0, 0);
$pdf->Cell(0, 5, 'Orden No. ' . $no_Orden, 0, 1, 'R');
$pdf->SetTextColor(0, 0, 0);
$pdf->Cell(100, 5, 'Cliente: ' . $cliente, 0, 0);
$pdf->Cell(0, 5, 'Telefono: ' . $telefono, 0, 1, 'R');
$pdf->Cell(100, 5, 'Contacto: ' . $contacto, 0, 0);
$pdf->Cell(0, 10, 'Celular: ' . $telefono, 0, 1, 'R');
//...Altura de las celdas por la altura del texto que contengan
$altTexto = 0;
$altTexto2 = 0;
$altTexto3 = 0;

$heights = [
  $pdf->getStringHeight(45, $tipo_equipo),
  $pdf->getStringHeight(45, $marca),
  $pdf->getStringHeight(45, $modelo),
  $pdf->getStringHeight(45, $serie)
];
$heights2 = [
  $pdf->getStringHeight(45, $tipo_equipo2),
  $pdf->getStringHeight(45, $marca2),
  $pdf->getStringHeight(45, $modelo2),
  $pdf->getStringHeight(45, $serie2)
];
$heights3 = [
  $pdf->getStringHeight(45, $tipo_equipo3),
  $pdf->getStringHeight(45, $marca3),
  $pdf->getStringHeight(45, $modelo3),
  $pdf->getStringHeight(45, $serie3)
];

$altTexto = max($altTexto, ...$heights);
$altTexto2 = max($altTexto2, ...$heights2);
$altTexto3 = max($altTexto3, ...$heights3);

//Fin...

$pdf->Cell(0, 10, 'Equipo', 1, 1, 'C');
$pdf->MultiCell(45, $altTexto, $tipo_equipo, 1, 'C', 0, 0);
$pdf->MultiCell(45, $altTexto, $marca, 1, 'C', 0, 0);
$pdf->MultiCell(45, $altTexto, $modelo, 1, 'C', 0, 0);
$pdf->MultiCell(45, $altTexto, $serie, 1, 'C', 0, 1);

$pdf->Cell(0, 5, 'Descripcion de la falla', 1, 1, 'C');
$pdf->MultiCell(180, 10, $descripcion, 0, 1);

if ($marca2 != null && $modelo2 != null && $serie2 != null && $tipo_equipo2 != null && $descripcion2 != null) {
  $pdf->Cell(0, 10, 'Equipo', 1, 1, 'C');
  $pdf->MultiCell(45, $altTexto2, $tipo_equipo2, 1, 'C', 0, 0);
  $pdf->MultiCell(45, $altTexto2, $marca2, 1, 'C', 0, 0);
  $pdf->MultiCell(45, $altTexto2, $modelo2, 1, 'C', 0, 0);
  $pdf->MultiCell(45, $altTexto2, $serie2, 1, 'C', 0, 1);

  $pdf->Cell(0, 5, 'Descripcion de la falla', 1, 1, 'C');
  $pdf->MultiCell(180, 10, $descripcion2, 0, 1);
}

if ($marca3 != null && $modelo3 != null && $serie3 != null && $tipo_equipo3 != null && $descripcion3 != null) {
  $pdf->Cell(0, 10, 'Equipo', 1, 1, 'C');
  $pdf->MultiCell(45, $altTexto3, $tipo_equipo3, 1, 'C', 0, 0);
  $pdf->MultiCell(45, $altTexto3, $marca3, 1, 'C', 0, 0);
  $pdf->MultiCell(45, $altTexto3, $modelo3, 1, 'C', 0, 0);
  $pdf->MultiCell(45, $altTexto3, $serie3, 1, 'C', 0, 1);

  $pdf->Cell(0, 5, 'Descripcion de la falla', 1, 1, 'C');
  $pdf->MultiCell(180, 10, $descripcion3, 0, 1);
}

$pdf->Cell(0, 5, 'Accsesorios adicionales', 1, 1, 'C');
$pdf->MultiCell(0, 10, $accesorios, 0, 1);
$pdf->Cell(180, 5, 'Observaciones en el procedimiento', 1, 1, 'C');
$pdf->Ln(30); // Salto de línea para dejar espacio vacío

// Agregar celda vacía para firma
$pdf->Cell(0, 10, '', 0, 1);

// Texto indicativo de firma
$pdf->Cell(80, 10, 'Nombre y firma del cliente', 'T', 0, 'C');

$pdf->Cell(20, 10, '', 0, 0);

$pdf->Cell(80, 10, $ingeniero, 'T', 1, 'C');

$pdf->SetFont('times', '', 8);
// Pie de pagina
$conn = new mysqli($host, $username, $password, $dbName);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT pieP FROM formato ORDER BY ver DESC LIMIT 1";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  $row = $result->fetch_assoc();
  $ultimoPiePagina = $row['pieP'];
  $pdf->MultiCell(0, 10, $ultimoPiePagina, 0, 'L');
} else {
  die("Error al obtener el pie de página, pruebe a reiniciar el equipo o el sistema");
}

$conn->close();

$pdf->Ln(20);

$pdf->setMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->setFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
$pdf->setAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
// Generar el PDF
$pdfPath = __DIR__ . 'pdf/orden.pdf';
ob_end_clean();
$pdf->Output($pdfPath, 'I');

?>