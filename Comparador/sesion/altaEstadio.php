<?php
session_start();
require "../modelo/estadios.php";
require "../modelo/Bd.php";
require "../modelo/funciones.php";

$mensaje = ""; // Variable para almacenar el mensaje
$mensajeClass = ""; // Variable para almacenar la clase del mensaje (si es un mensaje de error)

if (!isset($_SESSION['usuario'])) {
    // Redirigir al usuario a la página de inicio de sesión
    header("Location: loginAdmin.php");
    exit();
}

if (isset($_POST) && !empty($_POST)) {
    $nombre = addslashes($_POST['nombre']);
    $capacidad = addslashes($_POST['capacidad']);
    $ciudad = addslashes($_POST['ciudad']);
    $pais = addslashes($_POST['id_pais']);
    $f_inauguracion = addslashes($_POST['f_inauguracion']);
    $equipos = addslashes($_POST['equipos']);
    $ruta = $_FILES['ruta'];

    $estadios = new estadios($nombre, $capacidad, $ciudad, $pais, $f_inauguracion, $equipos);

    if ($_FILES['ruta']['name'] != "") {
        // Modificar la ruta del directorio
        $directorio = "./fotos";
        if (isSessionPrivada()) {
            $directorio = "../fotos";
        }

        $estadios->insertar($_POST, $_FILES['ruta']);
    } else {
        $estadios->insertar($_POST);
    }

    if ($estadios) {
        $mensaje = "El estadio se agregó correctamente.";
        $mensajeClass = "mensaje";
    } else {
        $mensaje = "No se pudo agregar el estadio.";
        $mensajeClass = "mensaje-error";
    }
}

function isSessionPrivada() {
    // Aquí puedes agregar tu lógica para determinar si la sesión es privada o no
    // Por ejemplo, si tienes una variable de sesión llamada 'privada' que es verdadera en una sesión privada, puedes usarla en la condición
    if (isset($_SESSION['privada']) && $_SESSION['privada'] === true) {
        return true;
    } else {
        return false;
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
    <title>Alta Estadio</title>
</head>

<body>
    <script src="js/script.js"></script>
    <a href="Admin.php"><img class="logo" src="../fotos/LogoFut.png" title="index"></a>
    <h1>Alta de Estadios</h1>
    <h2 class="<?php echo $mensajeClass; ?>"><?php echo $mensaje; ?></h2>
    <form name="altaEstadio" id="formularioRegistro" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post" enctype="multipart/form-data">
        <ul>
            <li>
                <label for="nombre">Nombre del Estadio:</label>
                <input type="text" id="nombre" name="nombre" required>
            </li>
            <li>
                <label for="capacidad">Capacidad:</label>
                <input type="number" id="capacidad" name="capacidad" required>
            </li>
            <li>
                <label for="ciudad">Ciudad:</label>
                <input type="text" id="ciudad" name="ciudad" required>
            </li>
            <li>
                <label for="pais">País:</label>
                <select id="pais" name="id_pais" required>
                    <option value="">Seleccione un país</option>
                    <option value="1">España</option>
                    <option value="2">Inglaterra</option>
                    <option value="3">Italia</option>
                    <option value="4">Alemania</option>
                    <option value="5">Francia</option>

                </select>
            </li>
            <li>
                <label for="f_inauguracion">Fecha de Inauguración:</label>
                <input type="text" id="f_inauguracion" name="f_inauguracion">
            </li>
            <li>
                <label for="equipos">Equipos:</label>
                <input type="text" id="equipos" name="equipos">
            </li>
            <li>
                <label for="foto">Foto:</label>
                <input type="file" id="foto" name="ruta">
            </li>
        </ul>
        <input type="submit" value="Enviar" id="boton">
    </form>

</body>

</html>
