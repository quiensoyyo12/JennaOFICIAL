<?php
// Conexión a la base de datos
include 'conexion.php'; // Asegúrate de que la ruta sea correcta

// Obtener respaldos
$queryRespaldos = "SELECT * FROM respaldo ORDER BY fecha_generacion DESC";
$resultadoRespaldos = mysqli_query($conexion, $queryRespaldos);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Respaldos</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container my-4">
        <h1>Respaldos Generados</h1>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre del Reporte</th>
                    <th>Fecha de Generación</th>
                    <th>Archivo</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($respaldo = mysqli_fetch_assoc($resultadoRespaldos)): ?>
                    <tr>
                        <td><?php echo $respaldo['id']; ?></td>
                        <td><?php echo htmlspecialchars($respaldo['nombre_reporte']); ?></td>
                        <td><?php echo $respaldo['fecha_generacion']; ?></td>
                        <td><a href="<?php echo $respaldo['ruta_archivo']; ?>" target="_blank">Descargar</a></td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
