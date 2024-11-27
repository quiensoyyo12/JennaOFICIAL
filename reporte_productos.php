<?php
require('fpdf186/fpdf.php');

// Conexión a la base de datos
include 'conexion.php'; // Asegúrate de que la ruta sea correcta

// Obtener productos para el reporte
$consultaProductos = "SELECT * FROM productos";
$resultadoProductos = mysqli_query($conexion, $consultaProductos);

// Crear una nueva instancia de FPDF
$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial', 'B', 12);

// Título del reporte
$pdf->Cell(0, 10, 'Reporte de Productos', 0, 1, 'C');
$pdf->Ln(5);

// Encabezados de la tabla
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(20, 10, 'ID', 1);
$pdf->Cell(30, 10, 'Tipo', 1);
$pdf->Cell(40, 10, 'Nombre', 1);
$pdf->Cell(30, 10, 'Marca', 1);
$pdf->Cell(50, 10, 'Descripcion', 1);
$pdf->Cell(20, 10, 'Precio', 1);
$pdf->Ln();

// Datos de la tabla
$pdf->SetFont('Arial', '', 10);

while ($row = mysqli_fetch_assoc($resultadoProductos)) {
    $pdf->Cell(20, 10, $row['idProductos'], 1);
    $pdf->Cell(30, 10, $row['Tipo_Productos'], 1);
    $pdf->Cell(40, 10, $row['Nombre_producto'], 1);
    $pdf->Cell(30, 10, $row['Marca'], 1);
    $pdf->Cell(50, 10, substr($row['Descripcion_Productos'], 0, 30), 1); // Limitar a 30 caracteres
    $pdf->Cell(20, 10, '$' . number_format($row['Precio'], 2), 1);
    $pdf->Ln();
}

// Guardar el archivo PDF en el servidor
$nombreReporte = 'Reporte_Productos_' . date('Ymd_His') . '.pdf'; // Nombre único basado en la fecha
$rutaArchivo = 'reportes/' . $nombreReporte; // Carpeta para almacenar reportes
$pdf->Output('F', $rutaArchivo); // Guardar en el servidor

// Insertar un respaldo en la tabla "respaldo"
$fechaGeneracion = date('Y-m-d H:i:s');
$queryInsertRespaldo = "INSERT INTO respaldo (nombre_reporte, fecha_generacion, ruta_archivo) VALUES ('$nombreReporte', '$fechaGeneracion', '$rutaArchivo')";
mysqli_query($conexion, $queryInsertRespaldo);

// Cerrar la conexión a la base de datos
mysqli_close($conexion);

// Redirigir al usuario a respaldos.php
header('Location: respaldos.php');
exit;
?>
