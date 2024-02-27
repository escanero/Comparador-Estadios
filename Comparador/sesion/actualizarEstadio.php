<?php
session_start();
require_once("../modelo/Bd.php");
require_once("../modelo/funciones.php");

$nombreEstadio = "";
$capacidadEstadio = "";
$ciudadEstadio = "";
$idPaisEstadio = "";
$fechaInauguracion = "";
$equiposEstadio = "";
$rutaEstadio = "";
$mensajeError = "";
$mensajeExito = "";

if (!isset($_SESSION['usuario'])) {
    // Redirigir al usuario a la página de inicio de sesión
    header("Location: loginAdmin.php");
    exit();
}


if (isset($_POST["nombreEstadio"])) {
    $nombreEstadio = $_POST["nombreEstadio"];

    $bd = new Bd();
    $condicion = array("nombre" => $nombreEstadio);
    $estadio = $bd->obtenerElementos("estadios", $condicion);

    if (count($estadio) > 0) {
        $estadio = $estadio[0];
        $capacidadEstadio = $estadio["capacidad"];
        $ciudadEstadio = $estadio["ciudad"];
        $idPaisEstadio = $estadio["id_pais"];
        $fechaInauguracion = $estadio["f_inauguracion"];
        $equiposEstadio = $estadio["equipos"];
        $rutaEstadio = $estadio["ruta"];
    } else {
        $mensajeError = "No se encontró el estadio con el nombre proporcionado.";
    }
}

if (isset($_POST["actualizar"]) && empty($mensajeError)) {
    $nuevoNombreEstadio = $_POST["nuevoNombreEstadio"];
    $capacidadEstadio = $_POST["capacidad"];
    $ciudadEstadio = $_POST["ciudad"];
    $idPaisEstadio = $_POST["id_pais"];
    $fechaInauguracion = $_POST["f_inauguracion"];
    $equiposEstadio = $_POST["equipos"];

    $bd = new Bd();
    $condicion = array("nombre" => $nombreEstadio);
    $estadio = $bd->obtenerElementos("estadios", $condicion);

    if (count($estadio) > 0) {
        $datos = array(
            "nombre" => $nuevoNombreEstadio,
            "capacidad" => $capacidadEstadio,
            "ciudad" => $ciudadEstadio,
            "id_pais" => $idPaisEstadio,
            "f_inauguracion" => $fechaInauguracion,
            "equipos" => $equiposEstadio
        );

        // Subida de la foto
        if (!empty($_FILES["fotoEstadio"]["name"])) {
            $rutaEstadio = "../fotos/" . $_FILES["fotoEstadio"]["name"];
            move_uploaded_file($_FILES["fotoEstadio"]["tmp_name"], $rutaEstadio);
            $datos["ruta"] = $rutaEstadio;
        }

        $bd->actualizarElemento("estadios", $datos, $condicion);

        $mensajeExito = "El estadio se ha actualizado correctamente.";

     
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
    <title>Actualizar Estadio</title>
</head>
<body>
    <a href="Admin.php"><img class="logo" src="../fotos/LogoFut.png" title="index"></a>

    <?php if (empty($nombreEstadio) || !empty($mensajeError)) : ?>
        
        <form method="post" enctype="multipart/form-data">
            <label>Nombre del estadio:</label>
            <input type="text" name="nombreEstadio">
            <input type="submit" name="buscar" value="Buscar">
        </form>
        <?php if (!empty($mensajeError)) : ?>
            <p class="error"><?php echo $mensajeError; ?></p>
        <?php endif; ?>
    <?php else : ?>
        <?php if (!empty($mensajeExito)) : ?>
            <p class="exito"><?php echo $mensajeExito; ?></p>
        <?php endif; ?>
        <form method="post" enctype="multipart/form-data">
            <label>Nombre del estadio:</label>
            <input type="text" name="nombreEstadio" value="<?php echo $nombreEstadio; ?>" readonly>
            <label>Nuevo nombre:</label>
            <input type="text" name="nuevoNombreEstadio" value="<?php echo $nombreEstadio; ?>" required>
            <label>Nueva capacidad:</label>
            <input type="text" name="capacidad" value="<?php echo $capacidadEstadio; ?>" required>
            <label>Nueva ciudad:</label>
            <input type="text" name="ciudad" value="<?php echo $ciudadEstadio; ?>" required>
            <label>Nuevo ID de país:</label>
            <input type="text" name="id_pais" value="<?php echo $idPaisEstadio; ?>" required>
            <label>Nueva fecha de inauguración:</label>
            <input type="text" name="f_inauguracion" value="<?php echo $fechaInauguracion; ?>" required>
            <label>Nuevos equipos:</label>
            <input type="text" name="equipos" value="<?php echo $equiposEstadio; ?>" required>
            <label>Nueva foto:</label>
            <input type="file" name="fotoEstadio">
            <input type="submit" name="actualizar" value="Actualizar">
        </form>
    <?php endif; ?>
</body>
</html>
