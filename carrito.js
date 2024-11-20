$(document).ready(function () {
    $('.agregar-al-carrito-btn').click(function (e) {
        e.preventDefault(); // Prevenir el envío tradicional

        var form = $(this).closest('.agregar-al-carrito-form');
        var cantidad = parseInt(form.closest('.card-body').find('.cantidad').text(), 10) || 1; // Obtener cantidad seleccionada
        form.find('.cantidad-input').val(cantidad); // Establecer cantidad en el campo oculto

        var formData = form.serialize(); // Serializar los datos del formulario

        $.ajax({
            type: 'POST',
            url: 'agregar_al_carrito.php', // Enviar datos al carrito
            data: formData,
            success: function (response) {
                var data = JSON.parse(response);
                if (data.success) {
                    alert(data.message); // Mostrar mensaje de éxito
                    // Actualizar la cantidad en el inventario
                    actualizarCantidadInventario(data.idProductos, cantidad);
                } else {
                    alert(data.message); // Mostrar mensaje de error
                }
            },
            error: function () {
                alert('Error al agregar el producto al carrito.');
            }
        });
    });

    function actualizarCantidadInventario(idProducto, cantidad) {
        // Llamada para actualizar el inventario
        $.ajax({
            type: 'POST',
            url: 'actualizar_cantidad.php', // Ruta del archivo PHP que actualiza el inventario
            contentType: 'application/json',
            data: JSON.stringify({
                idProducto: idProducto,
                nuevaCantidad: cantidad,
            }),
            success: function (response) {
                var data = JSON.parse(response);
                if (data.success) {
                    console.log(`Inventario actualizado para el producto ${idProducto}`);
                } else {
                    console.error(`Error al actualizar inventario: ${data.error}`);
                }
            },
            error: function () {
                console.error('Error en la actualización del inventario.');
            }
        });
    }
});


