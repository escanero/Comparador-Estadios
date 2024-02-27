<?php
require_once "./modelo/Bd.php";

$bd = new Bd();

if (isset($_POST['estadios'])) {
    $estadiosSeleccionados = $_POST['estadios'];

    // Construir la cadena de valores para la cláusula IN
    $estadiosFiltrados = implode(',', array_map(function($estadio) {
        return "'" . $estadio . "'";
    }, $estadiosSeleccionados));

    // Modificar la consulta SQL para filtrar los estadios seleccionados
    $sql = "SELECT e.*, p.nombrePais 
    FROM estadios e 
    JOIN paises p ON e.id_pais = p.id_pais 
    WHERE e.nombre IN ($estadiosFiltrados)";


    // Ejecutar la consulta y obtener los resultados
    $result = $bd->consulta($sql);

    // Crear un arreglo para almacenar los estadios
    $estadios = [];

    // Recorrer los resultados y agregar cada estadio al arreglo
    while ($row = $result->fetch_assoc()) {
        $estadios[] = $row;
    }

    // Devolver los estadios en formato JSON
    echo json_encode($estadios);
} else {
    // Manejar el caso en que 'estadios' no esté definido
    // Por ejemplo, asignar un valor por defecto o mostrar un mensaje de error
}

?>
