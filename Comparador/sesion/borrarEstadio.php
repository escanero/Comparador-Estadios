<?php

session_start();
require_once("../modelo/Bd.php");

$mensaje = "";
$mensajeClass = "";

if (!isset($_SESSION['usuario'])) {
    // Redirigir al usuario a la página de inicio de sesión
    header("Location: loginAdmin.php");
    exit();
}


if(isset($_POST["eliminar"])){
    $bd = new Bd();
    $estadiosSeleccionados = $_POST["estadio"];

    foreach ($estadiosSeleccionados as $nombreEstadio) {
        $condicion = array("nombre" => $nombreEstadio);
        $estadios = $bd->obtenerElementos("estadios", $condicion);

        if (count($estadios) > 0) {
            $estadioEliminado = $bd->eliminarElemento("estadios", $condicion);

            if ($estadioEliminado) {
                $mensaje = "Los estadios se eliminaron correctamente.";
                $mensajeClass = "mensaje5";
            } else {
                $mensaje = "No se pudieron eliminar todos los estadios. Verifica los nombres de los estadios.";
                $mensajeClass = "mensaje-error5";
            }
        } else {
            $mensaje = "No se encontraron los estadios con los nombres proporcionados.";
            $mensajeClass = "mensaje-error5";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style2.css">
    <title>Borrar Estadio</title>
    <style>
    /* Estilo personalizado para los switches */
    .filtro {
        display: grid;
        grid-template-columns: repeat(2, 1fr); /* Cambiar el número para ajustar la cantidad de columnas */
        grid-gap: 10px; /* Espacio entre los elementos */
    }

    #filtro2{
        width:600px;
    }

    .filtro input[type="checkbox"] {
        display: none; /* Ocultar el checkbox original */
    }

    .filtro label {
        display: block;
        position: relative;
        padding: 8px;
        cursor: pointer;
        font-size: 18px;
        user-select: none;
    }

    /* Estilo del switch cuando está en posición "OFF" */
    .filtro label:before {
        content: "";
        position: absolute;
        top: 0;
        left: 0;
        width: 50px;
        height: 28px;
        border-radius: 20px;
        background-color: #ccc;
        transition: background-color 0.3s;
    }

    /* Estilo del switch cuando está en posición "ON" */
    .filtro input[type="checkbox"]:checked + label:before {
        background-color: #2196F3;
    }

    /* Estilo del círculo del switch */
    .filtro label:after {
        content: "";
        position: absolute;
        top: 4px;
        left: 4px;
        width: 20px;
        height: 20px;
        border-radius: 50%;
        background-color: #fff;
        transition: transform 0.3s;
    }

    /* Estilo del círculo del switch cuando está en posición "OFF" */
    .filtro input[type="checkbox"]:checked + label:after {
        transform: translateX(22px);
    }

    /* Estilo del texto del switch */
    .filtro label span {
        margin-left: 60px;
    }
</style>
</head>
<body>
    <a href="Admin.php"><img class="logo" src="../fotos/LogoFut.png" title="index"></a>
    <?php
    if (!empty($mensaje)) {
        echo '<p class="' . $mensajeClass . '">' . $mensaje . '</p>';
    }
    ?>
  <form class="filtro" id="filtro2" method="POST">
    <?php
    require_once "../modelo/Bd.php";
    $bd = new Bd();
    $sql = "SELECT nombre FROM estadios";
    $result = $bd->consulta($sql);
    $estadiosFiltrados = array();
    while ($row = $result->fetch_assoc()) {
        $nombreEstadio = $row["nombre"];
        $estadiosFiltrados[] = $nombreEstadio;
    }
    foreach ($estadiosFiltrados as $estadio) {
        echo '<input type="checkbox" name="estadio[]" id="' . $estadio . '" value="' . $estadio . '">';
        echo '<label for="' . $estadio . '"><span>' . $estadio . '</span></label>';
    }
    ?>
    <input type="submit" name="eliminar" value="Eliminar" id="eliminar-btn">
</form>
<div id="resultados"></div>
</body>
</html>
