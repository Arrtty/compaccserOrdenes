<?php

//use const Users\Arturo\Desktop\InteliJ\compaccserOrdenes\tc;

require_once ('../TCPDF-main/tcpdf.php');

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

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
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




  // Obtén los datos del formulario
  $fecha = date('Y-m-d', strtotime($_POST['fecha']));
  $no_Orden = $_POST['no_orden'];
  $cliente = $_POST['cliente'];
  $contacto = $_POST['contacto'];
  $telefono = $_POST['telefono'];
  $celular = $_POST['celular'];
  $descripcion = $_POST['descripcion'];
  $tipo_equipo = $_POST['tipo_equipo'];
  $marca = $_POST['marca'];
  $modelo = $_POST['modelo'];
  $serie = $_POST['serie'];
  $accesorios = $_POST['accesorios'];
  $ingeniero = $_POST['ingeniero'];




  if (!$cliente) {
    $cliente = ' ';
  }


  if (!$contacto) {
    $contacto = ' ';
  }
  if (!$telefono) {
    $telefono = 'S/N';
  }

  if (!$celular) {
    $celular = 'S/N';
  }

  if (!$descripcion) {
    $descripcion = 'NO SE ESCRIBIO DESCRIPCION DEL ERROR';
  }

  if (!$contacto) {
    $contacto = ' ';
  }

  try {


    $pdo->beginTransaction();
    $stmt = $pdo->prepare("INSERT INTO ordenes (fecha, cliente, telefono, celular, descripcion, equipo, marca, modelo, serie, accsesorios, ingeniero, contacto) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?,?)");
    $stmt->execute([$fecha, $cliente, $telefono, $celular, $descripcion, $tipo_equipo, $marca, $modelo, $serie, $accesorios, $ingeniero, $contacto]);
    $pdo->commit();

    // Redirigir a otra página después de guardar el registro

  } catch (PDOException $e) {
    $pdo->rollBack();
    die("Error al guardar el registro: " . $e->getMessage());
  }
}
$fecha = $_POST['fecha'];
$no_Orden = $_POST['no_orden'];
$cliente = $_POST['cliente'];

$contacto = $_POST['contacto'];
$telefono = $_POST['telefono'];
$celular = $_POST['celular'];
$descripcion = $_POST['descripcion'];
$tipo_equipo = $_POST['tipo_equipo'];
$marca = $_POST['marca'];
$modelo = $_POST['modelo'];
$serie = $_POST['serie'];
$accesorios = $_POST['accesorios'];
$ingeniero = $_POST['ingeniero'];

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
$pdf->Cell(0, 10, 'Celular: ' . $telefono, 0, 1, 'R');

$pdf->MultiCell(180, 10, $descripcion, 0, 'L');

//...Altura de las celdas por la altura del texto que contengan
$altTexto = 0;

$altTextoTE = $pdf->getStringHeight(45, $tipo_equipo);
$altTextoM = $pdf->getStringHeight(45, $marca);
$altTextoMD = $pdf->getStringHeight(45, $modelo);
$altTextoS = $pdf->getStringHeight(45, $serie);

if ($altTexto < $altTextoTE) {
  $altTexto = $altTextoTE;
}

if ($altTexto < $altTextoM) {
  $altTexto = $altTextoM;
}

if ($altTexto < $altTextoMD) {
  $altTexto = $altTextoMD;
}

if ($altTexto < $altTextoS) {
  $altTexto = $altTextoS;
}

//Fin...

$pdf->Cell(0, 10, 'Equipos', 1, 1, 'C');
$pdf->MultiCell(45, $altTexto, $tipo_equipo, 1, 'C', 0, 0);
$pdf->MultiCell(45, $altTexto, $marca, 1, 'C', 0, 0);
$pdf->MultiCell(45, $altTexto, $modelo, 1, 'C', 0, 0);
$pdf->MultiCell(45, $altTexto, $serie, 1, 'C', 0, 1);

$pdf->Ln(5); // Salto de línea para dejar espacio vacío

$pdf->Cell(0, 10, 'Accesorios adicionales: ' . $accesorios, 0, 1);
$pdf->Cell(180, 5, 'Observaciones en el procedimiento', 1, 1, 'C');
$pdf->Ln(50); // Salto de línea para dejar espacio vacío

// Agregar celda vacía para firma
$pdf->Cell(0, 10, '', 0, 1);

// Texto indicativo de firma

$pdf->Cell(80, 10, 'Nombre y firma del cliente', 'T', 0, 'C');

$pdf->Cell(20, 10, '', 0, 0);

$pdf->Cell(80, 10, $ingeniero, 'T', 1, 'C');

$pdf->SetFont('times', '', 8);
try {
  $stmt = $pdo->query("SELECT pieP FROM formato ORDER BY ver desc LIMIT 1");
  $ultimoPiePagina = $stmt->fetch(PDO::FETCH_ASSOC)['pieP'];
  $pdf->MultiCell(0, 10, $ultimoPiePagina, 0, 'L');

} catch (PDOException $e) {
  die("Error al obtener el pie de página, pruebe a reiniciar el equipo o el sistema" . $e->getMessage());
}

$pdf->Ln(20);


// ...
$pdf->setMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->setFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
$pdf->setAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);


// Generar el PDF y descargarlo
$pdfPath = __DIR__ . 'pdf/orden.pdf';
$pdf->Output($pdfPath, 'I');

?>