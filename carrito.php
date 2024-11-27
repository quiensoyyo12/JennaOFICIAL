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
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="login/styleB.css">
    <link rel="stylesheet" href="css/css/bootstrap.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <script src="js/bootstrap.min.js"></script>
    <title>Carrito</title>
    <link rel="stylesheet" href="styleCarrito.css">
</head>

<body>
    <style>
        /* Quitar subrayado de los enlaces en el menú */
.nav-bar a {
    text-decoration: none !important; /* Quita cualquier subrayado */
}

/* Opcional: Cambiar el color del texto al pasar el mouse */
.nav-bar a:hover {
    text-decoration: none; /* Asegura que no se subraye al pasar el mouse */
    color: #000; /* Cambia el color del texto si deseas un efecto */
}

    </style>
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
                    <a href="inicio.php" class="">Inicio</a>
                </li>
                <li>
                    <a href="Mostrar_Productos.php" class="">Productos</a>
                </li>
                <li>
                    <a href="" class=""></a>
                </li>
                <li>
                    <a href="" class=""></a>
                </li>
                <div class="d-flex">
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

    <div class='container my-5'>
        <h2 class='text-center mb-4'>Carrito de Compras</h2>

        <div class="row">
            <?php
            include 'conexion.php';

            $query = "SELECT * FROM carrito";
            $resultado = mysqli_query($conexion, $query);

            $total = 0;

            if (mysqli_num_rows($resultado) > 0): ?>
                <!-- Contenedor principal -->
                <div class="col-md-8">
                    <!-- Lado izquierdo: Lista de productos -->
                    <?php while ($producto = mysqli_fetch_assoc($resultado)):
                        // Calcular subtotal y total
                        $subtotal = $producto['Precio'] * $producto['Cantidad_Productos'];
                        $total += $subtotal;
                    ?>
                        <div class="card mb-3" data-id="<?php echo $producto['idProductos']; ?>">
                            <div class="row g-0">
                                <!-- Imagen del producto -->
                                <div class="col-md-4">
                                    <?php if (!empty($producto['imagen'])): ?>
                                        <img src="data:image/jpeg;base64,<?php echo base64_encode($producto['imagen']); ?>"
                                            class="img-fluid rounded-start"
                                            alt="<?php echo htmlspecialchars($producto['Nombre_producto']); ?>">
                                    <?php else: ?>
                                        <img src="images/default.png"
                                            class="img-fluid rounded-start"
                                            alt="Imagen no disponible">
                                    <?php endif; ?>
                                </div>

                                <div class="col-md-8">
                                    <div class="card-body">
                                        <h5 class="card-title"><?php echo htmlspecialchars($producto['Nombre_producto']); ?></h5>
                                        <p class="card-text">
                                            <strong>Precio:</strong> $<?php echo number_format($producto['Precio'], 2); ?>
                                        </p>
                                        <p class="card-text">
                                            <strong>Cantidad:</strong>
                                            <button class="btn btn-sm btn-secondary btn-decrement"
                                                data-id="<?php echo intval($producto['idProductos']); ?>">-</button>
                                            <span class="cantidad"><?php echo intval($producto['Cantidad_Productos']); ?></span>
                                            <button class="btn btn-sm btn-secondary btn-increment"
                                                data-id="<?php echo intval($producto['idProductos']); ?>">+</button>
                                        </p>
                                        <p class="card-text">
                                            <strong>Subtotal:</strong> $<span class="subtotal"><?php echo number_format($subtotal, 2); ?></span>
                                        </p>
                                        <!-- Botón para eliminar producto -->
                                        <form method="post" action="eliminar_del_carrito.php" class="d-inline">
                                            <input type="hidden" name="idProductos" value="<?php echo intval($producto['idProductos']); ?>">
                                            <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endwhile; ?>
                </div>

                <!-- Lado derecho: Resumen -->
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Resumen</h4>
                            <p class="card-text">
                                <strong>Total:</strong> $<span id="total"><?php echo number_format($total, 2); ?></span>
                            </p>
                            <form method="post" action="procesar_compra.php">
                                <button type="submit" class="btn btn-success w-100">Finalizar compra</button>
                            </form>

                        </div>
                    </div>
                </div>
            <?php else: ?>
                <div class="alert alert-warning text-center">No hay productos en el carrito.</div>
            <?php endif; ?>
        </div>
    </div>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const updateQuantity = async (productId, action) => {
                try {
                    const response = await fetch("actualizar_carrito.php", {
                        method: "POST",
                        headers: {
                            "Content-Type": "application/json",
                        },
                        body: JSON.stringify({
                            idProductos: productId,
                            action: action
                        }),
                    });
                    const data = await response.json();
                    if (data.success) {
                        // Actualizar cantidades y precios dinámicamente
                        const card = document.querySelector(`.card[data-id='${productId}']`);
                        if (card) {
                            card.querySelector(".cantidad").textContent = data.newQuantity;
                            card.querySelector(".subtotal").textContent = data.newSubtotal.toFixed(2);
                        }
                        document.getElementById("total").textContent = data.newTotal.toFixed(2);
                    } else {
                        alert(data.message || "Error al actualizar el carrito");
                    }
                } catch (error) {
                    console.error("Error en la solicitud:", error);
                }
            };

            // Incrementar cantidad
            document.querySelectorAll(".btn-increment").forEach((button) => {
                button.addEventListener("click", () => {
                    const productId = button.getAttribute("data-id");
                    updateQuantity(productId, "increment");
                });
            });

            // Decrementar cantidad
            document.querySelectorAll(".btn-decrement").forEach((button) => {
                button.addEventListener("click", () => {
                    const productId = button.getAttribute("data-id");
                    updateQuantity(productId, "decrement");
                });
            });
        });
    </script>

</body>

</html>