<?php
require('fpdf186/fpdf.php');

// Conexión a la base de datos
include 'conexion.php'; // Asegúrate de que la ruta sea correcta

// Consulta para obtener los datos
$consulta = "SELECT * FROM detalle_venta";
$resultado = mysqli_query($conexion, $consulta);

// Clase para crear el PDF
class PDF extends FPDF
{
    // Encabezado del documento
    function Header()
    {
        $this->SetFont('Arial', 'B', 14);
        $this->Cell(0, 10, 'Reporte de Detalle de Ventas', 0, 1, 'C');
        $this->Ln(10);
        $this->SetFont('Arial', 'B', 10);
        $this->Cell(30, 10, 'ID', 1, 0, 'C');
        $this->Cell(40, 10, 'ID Venta', 1, 0, 'C');
        $this->Cell(50, 10, 'ID Productos', 1, 0, 'C');
        $this->Cell(30, 10, 'Cantidad', 1, 1, 'C');
    }

    // Pie de página
    function Footer()
    {
        $this->SetY(-15);
        $this->SetFont('Arial', 'I', 8);
        $this->Cell(0, 10, 'Pagina ' . $this->PageNo() . '/{nb}', 0, 0, 'C');
    }
}

// Crear instancia de PDF
$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Arial', '', 10);

// Llenar el PDF con los datos
if (mysqli_num_rows($resultado) > 0) {
    while ($row = mysqli_fetch_assoc($resultado)) {
        $pdf->Cell(30, 10, $row['idDetalle_venta'], 1, 0, 'C');
        $pdf->Cell(40, 10, $row['idVenta'], 1, 0, 'C');
        $pdf->Cell(50, 10, $row['idProductos'], 1, 0, 'C');
        $pdf->Cell(30, 10, $row['Cantidad'], 1, 1, 'C');
    }
} else {
    $pdf->Cell(0, 10, 'No hay datos disponibles.', 1, 1, 'C');
}

// Cerrar conexión
mysqli_close($conexion);

// Generar PDF
$pdf->Output();
?>
