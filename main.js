let dataTable;
let dataTableIsInitialized = false;

const dataTableOptions = {
    lengthMenu: [5, 10, 15, 20],
    columnDefs: [
        { className: "centered", targets: "_all" },
        { orderable: false, targets: [8] }, // La columna "Options" no será ordenable
    ],
    pageLength: 5,
    destroy: true,
    language: {
        lengthMenu: "Mostrar _MENU_ registros por página",
        zeroRecords: "No se encontraron productos",
        info: "Mostrando de _START_ a _END_ de _TOTAL_ productos",
        infoEmpty: "No hay productos disponibles",
        infoFiltered: "(filtrado de _MAX_ registros totales)",
        search: "Buscar:",
        paginate: {
            first: "Primero",
            last: "Último",
            next: "Siguiente",
            previous: "Anterior",
        },
    },
};

const initDataTable = async () => {
    if (dataTableIsInitialized) {
        dataTable.destroy(); // Destruir la tabla si ya está inicializada
    }

    await loadProducts(); // Cargar los datos desde el servidor

    dataTable = $("#datatable_users").DataTable(dataTableOptions); // Inicializar DataTable

    dataTableIsInitialized = true;
};

const loadProducts = async () => {
    try {
        const response = await fetch("getProducts.php"); // Endpoint PHP
        const products = await response.json();

        // Verificar si hay error en la respuesta
        if (products.error) {
            console.error("Error al cargar los productos:", products.error);
            document.getElementById("tableBody_users").innerHTML = `
                <tr>
                    <td colspan="9">Error al cargar los productos.</td>
                </tr>`;
            return;
        }

        if (products.length === 0) {
            document.getElementById("tableBody_users").innerHTML = `
                <tr>
                    <td colspan="9">No hay productos en la base de datos.</td>
                </tr>`;
            return;
        }

        let content = ``;
        products.forEach((product, index) => {
            content += `
                <tr>
                    <td>${index + 1}</td>
                    <td>${product.Tipo_Productos || "No disponible"}</td>
                    <td>${product.Nombre_producto || "No disponible"}</td>
                    <td>${product.Marca || "No disponible"}</td>
                    <td>${product.Descripcion_Productos || "No disponible"}</td>
                    <td>${product.Cantidad_Productos || "No disponible"}</td>
                    <td>${product.Precio || "No disponible"}</td>
                    <td>${product.status === 1 ? "Activo" : "Inactivo"}</td>
                    <td>
                        <!-- Botón para abrir el modal de actualización -->
                        <button 
                            type="button" 
                            class="btn btn-sm btn-success update-button" 
                            data-bs-toggle="modal" 
                            data-bs-target="#updateModal" 
                            data-product='${JSON.stringify(product)}'>
                            <i class="fa-solid fa-pencil"></i> Actualizar
                        </button>

                        <!-- Botón para eliminar -->
                        <button type="button" onclick="enviarFormulario('EliminarProductos.php', ${product.idProductos})" class="btn btn-sm btn-danger">
                            <i class="fa-solid fa-trash-can"></i> Eliminar
                        </button>
                    </td>
                </tr>`;
        });

        document.getElementById("tableBody_users").innerHTML = content; // Rellenar tabla con los datos
    } catch (error) {
        console.error("Error al cargar los productos:", error);
        document.getElementById("tableBody_users").innerHTML = `
            <tr>
                <td colspan="9">Error al cargar los productos.</td>
            </tr>`;
    }
};

window.addEventListener("load", async () => {
    await initDataTable();
});
