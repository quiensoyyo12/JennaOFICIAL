<?php

session_start();

if (!isset($_SESSION['id'])) {
    header("Location: login.php");
    exit();
}

// Ahora puedes acceder al ID del usuario logueado
$id = $_SESSION['id'];

include 'conexion.php'; // Asegúrate de que la ruta sea correcta

$consulta_ciudadanos = "SELECT * FROM usuario where id = '$id'";
$resultado_ciudadanos = mysqli_query($conexion, $consulta_ciudadanos) or die(mysqli_error($conexion));
$fila_ciudadano = mysqli_fetch_assoc($resultado_ciudadanos);
?>
<?php
    include 'conexion.php'; // Asegúrate de que la ruta sea correcta



?>


<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="login/styleB.css">
    <link rel="stylesheet" href="css/css/bootstrap.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <script src="js/bootstrap.min.js"></script>
    <title>Detalle Productos</title>
    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>

</head>

<body>
    <header>
        <div class="logo">
            <img src="images/logoJenna-removebg-preview.png" alt="Logo de la Empresa" class="logo-img">
        </div>
        <div class="bars">
            <div class="line"></div>
            <div class="line"></div>
            <div class="line"></div>
        </div>
        <nav class="nav-bar">
            <ul>
                <li>
                    <a href="inicio.php" class="">inicio</a>
                </li>
                <li>
                    <a href="carrito.php" class="">Carrito</a>
                </li>
                <li>
                    <a href="Mostrar_Productos.php" class="">Productos</a>
                </li>
                <li>
                    <a href="#" class=""></a>
                </li>
                <h5 style="color: white; font-size: 1.2rem; font-weight: bold;">
                    <?php
                    echo htmlspecialchars($fila_ciudadano['Nombre']);
                    ?>
                    --
                </h5>

                <!-- Button trigger modal -->
                <a data-bs-toggle="modal" data-bs-target="#exampleModal"><img src="images/salir-alt (2).png" alt="cerrar sesion" width="40" height="32"></a>

                <!-- Modal -->
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5 lemon-regular" id="exampleModalLabel">¿Estas Seguro?</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <p style="color: black;">Estas a Punto de Cerrar Sesión</p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Continuar</button>
                                <a type="button" class="btn btn-primary" href="cerrarSesion.php">Cerrar Sesión</a>
                            </div>
                        </div>
                    </div>
                </div>
                </div>
            </ul>
        </nav>
    </header>
    <script src="script2.js"></script>

    <?php
    // Conexión a la base de datos
    include 'conexion.php'; // Asegúrate de que la ruta sea correcta
    // Obtener el ID del producto de la URL
    $id_producto = isset($_GET['id']) ? intval($_GET['id']) : 0;

    // Consulta para obtener los datos del producto
    $consultaProducto = "SELECT * FROM productos WHERE idProductos = $id_producto";
    $resultado = mysqli_query($conexion, $consultaProducto);
    $producto = mysqli_fetch_assoc($resultado);

    // Cerrar conexión
    mysqli_close($conexion);
    ?>
    <style>
        body {
            background-color: #e4d3fd;
            /* Lavanda claro */
            color: #333;
            /* Gris oscuro */
            font-family: Arial, sans-serif;
            /* Fuente principal */
        }

        .product-img {
            max-width: 100%;
            height: auto;
            object-fit: cover;
        }

        .details-container {
            background: #f9f9f9;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
        }

        .btn-container {
            margin-top: 20px;
        }/* Quitar subrayado de los enlaces en el menú */
.nav-bar a {
    text-decoration: none !important; /* Quita cualquier subrayado */
}

/* Opcional: Cambiar el color del texto al pasar el mouse */
.nav-bar a:hover {
    text-decoration: none; /* Asegura que no se subraye al pasar el mouse */
    color: #000; /* Cambia el color del texto si deseas un efecto */
}

    </style>
    </head>

    <div class="container my-5">
        <?php if ($producto): ?>
            <div class="row">
                <!-- Imagen del producto -->
                <div class="col-md-6">
                    <img data-src="data:image/jpeg;base64,<?php echo base64_encode($producto['imagen']); ?>"
                        class="card-img-top lazy-load"
                        alt="<?php echo htmlspecialchars($producto['Nombre_producto']); ?>"
                        style="height: 500px; object-fit: cover;">

                </div>
                <!-- Detalles del producto -->
                <div class="col-md-6">
                    <div class="details-container">
                        <h1><?php echo htmlspecialchars($producto['Nombre_producto']); ?></h1>
                        <p><strong>Categoría:</strong> <?php echo htmlspecialchars($producto['Tipo_Productos']); ?></p>
                        <p><strong>Marca:</strong> <?php echo htmlspecialchars($producto['Marca']); ?></p>
                        <p><strong>Precio:</strong> $<?php echo number_format($producto['Precio'], 2); ?></p>
                        <p><strong>Descripción:</strong> <?php echo htmlspecialchars($producto['Descripcion_Productos']); ?></p>
                        <p><strong>Cantidad disponible:</strong> <?php echo intval($producto['Cantidad_Productos']); ?></p>
                        <div class="btn-container">
                            <!-- Botón Comprar -->
                            <button type="button"
                                class="btn btn-success btn-lg btn-comprar"
                                data-id="<?php echo intval($producto['idProductos']); ?>"
                                data-nombre="<?php echo htmlspecialchars($producto['Nombre_producto']); ?>"
                                data-precio="<?php echo htmlspecialchars($producto['Precio']); ?>">
                                Comprar
                            </button>

                            <!-- Botón Agregar al carrito -->
                            <button type="button"
                                class="btn btn-primary btn-lg agregar-carrito-btn"
                                data-id="<?php echo intval($producto['idProductos']); ?>"
                                data-nombre="<?php echo htmlspecialchars($producto['Nombre_producto']); ?>"
                                data-precio="<?php echo htmlspecialchars($producto['Precio']); ?>"
                                data-imagen="data:image/jpeg;base64,<?php echo base64_encode($producto['imagen']); ?>">
                                Agregar al carrito
                            </button>

                        </div>
                    </div>
                </div>
            </div>
        <?php else: ?>
            <p class="text-center">El producto solicitado no existe.</p>
        <?php endif; ?>
    </div>
<!-- Modal para confirmar la compra -->
<div class="modal fade" id="modalCompra" tabindex="-1" aria-labelledby="modalCompraLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalCompraLabel">Confirmar Compra</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <!-- Información del producto -->
                    <div class="col-6">
                        <h6>Detalles del producto</h6>
                        <p><strong>Nombre:</strong> <span id="modalNombre"></span></p>
                        <p><strong>Precio:</strong> $<span id="modalPrecio"></span></p>
                    </div>
                    <!-- Resumen de compra -->
                    <div class="col-6">
                        <h6>Resumen</h6>
                        <p><strong>Subtotal:</strong> $<span id="modalSubtotal"></span></p>
                        <p><strong>Envío:</strong> $20.00</p>
                        <p><strong>Total:</strong> $<span id="modalTotal"></span></p>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-success" id="confirmarCompra">Confirmar Compra</button>
            </div>
        </div>
    </div>
</div>
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            document.querySelectorAll("img[data-src]").forEach(img => {
                img.src = img.dataset.src;
            });
        });
    </script>
    <script>
        // Manejar el evento de clic en los botones "Agregar al carrito"
        document.querySelectorAll(".agregar-carrito-btn").forEach(boton => {
            boton.addEventListener("click", function() {
                // Obtener los datos del producto del botón o del contenedor del producto
                const idProducto = this.getAttribute("data-id");
                const nombreProducto = this.getAttribute("data-nombre");
                const precioProducto = this.getAttribute("data-precio");
                const cantidadProducto = 1; // Cantidad inicial (puedes permitir al usuario modificar esto si lo deseas)
                const imagenProducto = this.getAttribute("data-imagen"); // Imagen codificada en base64

                // Crear el cuerpo de la solicitud
                const formData = new URLSearchParams();
                formData.append("idProductos", idProducto);
                formData.append("Nombre_producto", nombreProducto);
                formData.append("Precio", precioProducto);
                formData.append("Cantidad_Productos", cantidadProducto);
                formData.append("imagen", imagenProducto);

                // Enviar solicitud AJAX al archivo agregar_al_carrito.php
                fetch("agregar_al_carrito.php", {
                        method: "POST",
                        headers: {
                            "Content-Type": "application/x-www-form-urlencoded",
                        },
                        body: formData.toString(),
                    })
                    .then(response => response.json())
                    .then(data => {
                        // Mostrar mensaje basado en la respuesta del servidor
                        if (data.success) {
                            alert(data.message); // Mensaje de éxito
                        } else {
                            alert(data.message); // Mensaje de error
                        }
                    })
                    .catch(error => {
                        console.error("Error al enviar el producto al carrito:", error);
                        alert("Ocurrió un error al agregar el producto al carrito.");
                    });
            });
        });
    </script>
    <!-- Script para manejar el clic en "Comprar" -->
    <script>
document.querySelectorAll('.btn-comprar').forEach(button => {
    button.addEventListener('click', function () {
        const idProducto = this.dataset.id;
        const nombreProducto = this.dataset.nombre;
        const precio = parseFloat(this.dataset.precio);

        // Calcular subtotal, envío y total
        const envio = 20.0;
        const subtotal = precio;
        const total = subtotal + envio;

        // Actualizar los campos del modal
        document.getElementById('modalNombre').textContent = nombreProducto;
        document.getElementById('modalPrecio').textContent = subtotal.toFixed(2);
        document.getElementById('modalSubtotal').textContent = subtotal.toFixed(2);
        document.getElementById('modalTotal').textContent = total.toFixed(2);

        // Guardar los datos necesarios para confirmar la compra
        document.getElementById('confirmarCompra').dataset.id = idProducto;
        document.getElementById('confirmarCompra').dataset.total = total.toFixed(2);

        // Mostrar el modal
        new bootstrap.Modal(document.getElementById('modalCompra')).show();
    });
});

// Confirmar la compra
document.getElementById('confirmarCompra').addEventListener('click', function () {
    const idProducto = this.dataset.id;
    const total = this.dataset.total;

    // Enviar datos al servidor mediante fetch
    fetch('procesar_compra2.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({
            idProducto: idProducto,
            total: total
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert('Compra realizada exitosamente.');
            window.location.href = 'Mostrar_Productos.php'; // Redirigir a la página deseada
        } else {
            alert('Error al realizar la compra: ' + data.message);
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Ocurrió un error inesperado.');
    });
});
</script>


</body>

</html>