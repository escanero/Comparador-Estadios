
    $(document).ready(function() {
        // Función para obtener los valores seleccionados
        function obtenerEstadiosSeleccionados() {
            return $('input[name="estadio[]"]:checked').map(function() {
                return $(this).val();
            }).get();
        }

        // Función para realizar la solicitud AJAX y actualizar los resultados
        function actualizarResultados() {
            // Obtener los valores de los checkbox marcados
            let estadiosSeleccionados = obtenerEstadiosSeleccionados();

            // Enviar una solicitud AJAX al servidor
            $.ajax({
                url: 'obtenerEstadios.php',
                type: 'POST',
                data: { estadios: estadiosSeleccionados },
                dataType: 'json',
                success: function(response) {
                    // Crear una variable para almacenar el contenido HTML de los estadios
                    var estadiosHTML = '';

                    // Encontrar el estadio con mayor capacidad
                    var maxCapacidad = 0;
                    for (var i = 0; i < response.length; i++) {
                        var estadio = response[i];
                        if (estadio.capacidad > maxCapacidad) {
                            maxCapacidad = estadio.capacidad;
                        }
                    }

                    // Recorrer los datos de los estadios
                    for (var i = 0; i < response.length; i++) {
                        var estadio = response[i];

                        // Construir el contenido HTML del estadio
                        estadiosHTML += '<div class="estadio';
                        if (estadio.capacidad === maxCapacidad) {
                            estadiosHTML += ' mayor-capacidad';
                        }
                        estadiosHTML += '">';
                        estadiosHTML += '<h3>' + estadio.nombre + '</h3>';
                        estadiosHTML += '<p><strong>Capacidad:</strong> ' + estadio.capacidad + '</p>';
                        estadiosHTML += '<p><strong>Ciudad:</strong> ' + estadio.ciudad + '</p>';
                        estadiosHTML += '<p><strong>País:</strong> ' + estadio.nombrePais + '</p>';
                        estadiosHTML += '<p><strong>Fecha de inauguración:</strong> ' + estadio.f_inauguracion + '</p>';
                        estadiosHTML += '<p><strong>Equipos:</strong> ' + estadio.equipos + '</p>';
                        estadiosHTML += '<img src="./fotos/' + estadio.ruta + '" alt="' + estadio.nombre + '" />';

                        estadiosHTML += '</div>';
                    }

                    // Actualizar la sección de resultados con el contenido HTML de los estadios
                    $('#resultados').html(estadiosHTML);
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        }

        // Manejar el evento change de los checkboxes
        $('input[name="estadio[]"]').change(function() {
            actualizarResultados();
        });

        // Inicializar el slider
        var sliderRange = $("#slider-range");
        var capacityRange = $("#capacity-range");
        var selectedRange = $("#selected-range");
        sliderRange.slider({
            range: true,
            min: 0,
            max: 100000,
            step: 10000,
            values: [0, 100000],
            slide: function (event, ui) {
                capacityRange.val(ui.values[0] + "-" + ui.values[1]);
                selectedRange.text("Capacidad: " + ui.values[0] + " - " + ui.values[1]);
                actualizarResultados(); // Actualizar los resultados al deslizar el slider
            }
        });

        // Obtener los valores iniciales del slider y mostrarlos en el campo de texto
        capacityRange.val(sliderRange.slider("values", 0) +
            "-" + sliderRange.slider("values", 1));
        selectedRange.text("Capacidad seleccionada: " + sliderRange.slider("values", 0) + " - " + sliderRange.slider("values", 1));

        // Actualizar los resultados al cargar la página
        actualizarResultados();
    });

