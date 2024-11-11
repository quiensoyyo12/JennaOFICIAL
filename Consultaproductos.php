<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="login/styleB.css">
    <link rel="stylesheet" href="css/css/bootstrap.css">
    <title>Listado de productos</title>

    <!-- Bootstrap-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css"
        integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous" />
    <!-- DataTable -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css" />
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css"
        integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Custom CSS -->
    <link rel="stylesheet" href="styleTabla.css" />
</head>

<body>
    <header>
        <div class="logo">logo</div>
        <div class="bars">
            <div class="line"></div>
            <div class="line"></div>
            <div class="line"></div>
        </div>
        <nav class="nav-bar">
            <ul>
                <li>
                    <a href="" class="active">inicio</a>
                </li>
                <li>
                    <a href="" class="">Blog</a>
                </li>
                <li>
                    <a href="" class="">Portafolio</a>
                </li>
                <li>
                    <a href="" class="">Contacto</a>
                </li>
            </ul>
        </nav>
    </header>
    <script src="script2.js"></script>

    <div class="container my-4">
        <div class="row">
            <div class="col-12">
                <div class="table-responsive">
                    <table id="datatable_users" class="table table-striped table-bordered">
                        <caption>Listado de Productos</caption>
                        <thead>
                            <tr>
                                <th class="centered">#</th>
                                <th class="centered">Categoría</th>
                                <th class="centered">Nombre</th>
                                <th class="centered">Marca</th>
                                <th class="centered">Descripción</th>
                                <th class="centered">Cantidad</th>
                                <th class="centered">Precio</th>
                                <th class="centered">Status</th>
                                <th class="centered">Opciones</th>
                            </tr>
                        </thead>
                        <tbody id="tableBody_users"></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
<script>
    $(document).ready(function () {
    $('#datatable_users').DataTable({
        responsive: true,
        autoWidth: false,
        language: {
            url: "//cdn.datatables.net/plug-ins/1.12.1/i18n/Spanish.json", // Traducción
        },
    });
});

</script>    

    <!-- Modal para Actualizar Producto -->
    <div class="modal fade" id="updateModal" tabindex="-1" aria-labelledby="updateModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="updateModalLabel">Actualizar Producto</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                </div>
                <form id="updateForm">
                    <div class="modal-body">
                        <input id="idProductos" name="idProductos" type="hidden">
                        <div class="mb-3">
                            <label for="Tipo_Productos" class="form-label">Tipo de Producto</label>
                            <input type="text" class="form-control" id="Tipo_Productos" name="Tipo_Productos" >
                        </div>
                        <div class="mb-3">
                            <label for="Nombre_Producto" class="form-label">Nombre</label>
                            <input type="text" class="form-control" id="Nombre_Producto" name="Nombre_Producto"
                                >
                        </div>
                        <div class="mb-3">
                            <label for="Marca" class="form-label">Marca</label>
                            <input type="text" class="form-control" id="Marca" name="Marca" >
                        </div>
                        <div class="mb-3">
                            <label for="Descripcion_Productos" class="form-label">Descripción</label>
                            <textarea class="form-control" id="Descripcion_Productos" name="Descripcion_Productos"
                                ></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="Cantidad_Productos" class="form-label">Cantidad</label>
                            <input type="number" class="form-control" id="Cantidad_Productos" name="Cantidad_Productos"
                                >
                        </div>
                        <div class="mb-3">
                            <label for="Precio" class="form-label">Precio</label>
                            <input type="number" step="0.01" class="form-control" id="Precio" name="Precio" >
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-primary">Actualizar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Bootstrap-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3"
        crossorigin="anonymous"></script>
    <!-- jQuery -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <!-- DataTable -->
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
    <!-- Custom JS -->
    <script src="main.js"></script>

    <script>
        function enviarFormulario(url, idProductos) {
            // Crear un formulario dinámico
            const form = document.createElement("form");
            form.method = "POST";
            form.action = url;

            // Agregar el ID del producto como un campo oculto
            const inputId = document.createElement("input");
            inputId.type = "hidden";
            inputId.name = "idProductos";
            inputId.value = idProductos;

            form.appendChild(inputId);

            // Agregar el formulario al documento y enviarlo
            document.body.appendChild(form);
            form.submit();
        }

        // Asignar a los botones de eliminar
        document.addEventListener('DOMContentLoaded', () => {
            const deleteButtons = document.querySelectorAll('.delete-button');
            deleteButtons.forEach((button) => {
                button.addEventListener('click', () => {
                    const id = button.getAttribute('data-id'); // Obtén el ID del producto
                    const url = 'EliminarProducto.php'; // URL de eliminación
                    if (confirm('¿Estás seguro de que deseas eliminar este producto?')) {
                        enviarFormulario(url, id);
                    }
                });
            });
        });

    </script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
    // Captura todos los botones de actualización
    const updateButtons = document.querySelectorAll('.update-button');
    
    updateButtons.forEach((button) => {
        button.addEventListener('click', () => {
            // Obtén los datos del producto del atributo data-product
            const product = JSON.parse(button.getAttribute('data-product'));

            // Llena los campos del modal con los datos del producto
            document.getElementById('idProductos').value = product.idProductos;
            document.getElementById('Tipo_Productos').value = product.Tipo_Productos;
            document.getElementById('Nombre_Producto').value = product.Nombre_Producto;
            document.getElementById('Marca').value = product.Marca;
            document.getElementById('Descripcion_Productos').value = product.Descripcion_Productos;
            document.getElementById('Cantidad_Productos').value = product.Cantidad_Productos;
            document.getElementById('Precio').value = product.Precio;
        });
    });

    // Maneja el envío del formulario desde el modal
    const updateForm = document.getElementById('updateForm');
    updateForm.addEventListener('submit', (event) => {
        event.preventDefault(); // Evita el comportamiento predeterminado del formulario
        const formData = new FormData(updateForm);

        fetch('Updateproductos.php', {
            method: 'POST',
            body: formData,
        })
        .then(response => response.text())
        .then(data => {
            // Muestra un mensaje o refresca la tabla
            alert('Producto actualizado exitosamente');
            location.reload(); // Refresca la página para mostrar los cambios
        })
        .catch(error => {
            console.error('Error al actualizar el producto:', error);
            alert('Error al actualizar el producto');
        });
    });
});

    </script>

</body>

</html>