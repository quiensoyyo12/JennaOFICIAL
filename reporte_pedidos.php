<?php
require('fpdf186/fpdf.php');

// Conexión a la base de datos
$conexion = mysqli_connect("localhost", "root", "", "jennawork") or die("Error de conexión de BD");

// Consulta para obtener los datos de pedidos
$consulta = "SELECT * FROM pedidos";
$resultado = mysqli_query($conexion, $consulta);

// Clase personalizada para generar el PDF
class PDF extends FPDF
{
    // Encabezado del documento
    function Header()
    {
        $this->SetFont('Arial', 'B', 14);
        $this->Cell(0, 10, 'Reporte de Pedidos', 0, 1, 'C');
        $this->Ln(10);
        $this->SetFont('Arial', 'B', 10);
        $this->Cell(30, 10, 'ID Pedido', 1, 0, 'C');
        $this->Cell(50, 10, 'Cantidad Productos', 1, 0, 'C');
        $this->Cell(50, 10, 'Fecha Entrega', 1, 0, 'C');
        $this->Cell(30, 10, 'Total', 1, 0, 'C');
        $this->Cell(30, 10, 'ID Proveedor', 1, 1, 'C');
    }

    // Pie de página del documento
    function Footer()
    {
        $this->SetY(-15);
        $this->SetFont('Arial', 'I', 8);
        $this->Cell(0, 10, 'Pagina ' . $this->PageNo() . '/{nb}', 0, 0, 'C');
    }
}

// Crear instancia de la clase PDF
$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Arial', '', 10);

// Llenar el PDF con los datos
if (mysqli_num_rows($resultado) > 0) {
    while ($row = mysqli_fetch_assoc($resultado)) {
        $pdf->Cell(30, 10, $row['idPedidos'], 1, 0, 'C');
        $pdf->Cell(50, 10, $row['Cantidad_Pedidos'], 1, 0, 'C');
        $pdf->Cell(50, 10, $row['FechaEntrega_Pedidos'], 1, 0, 'C');
        $pdf->Cell(30, 10, $row['Total'], 1, 0, 'C');
        $pdf->Cell(30, 10, $row['idProveedor'], 1, 1, 'C');
    }
} else {
    $pdf->Cell(0, 10, 'No hay datos disponibles.', 1, 1, 'C');
}

// Cerrar conexión
mysqli_close($conexion);

// Generar el archivo PDF
$pdf->Output();
?>
