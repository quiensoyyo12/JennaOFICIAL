$(document).ready(function() {
    // Evitar que el formulario se envíe de manera tradicional
    $('.agregar-al-carrito-btn').click(function(e) {
        e.preventDefault(); // Prevenir la acción predeterminada del formulario
        
        var form = $(this).closest('.agregar-al-carrito-form');
        var formData = form.serialize(); // Serializa los datos del formulario
        
        $.ajax({
            type: 'POST',
            url: 'agregar_al_carrito.php', // Asegúrate de que este archivo sea el que recibe los datos
            data: formData,
            success: function(response) {
                var data = JSON.parse(response); // Parseamos la respuesta JSON
                if (data.success) {
                    alert(data.message); // Mostrar mensaje de éxito
                } else {
                    alert(data.message); // Mostrar mensaje de error
                }
            },
            error: function() {
                alert('Error al agregar el producto al carrito.');
            }
        });
    });
});





