<?php
session_start();
require_once("../modelo/Bd.php");

$mensaje = "";

if (!isset($_SESSION['usuario'])) {
    // Redirigir al usuario a la página de inicio de sesión
    header("Location: loginAdmin.php");
    exit();
}

if(isset($_POST["eliminar"])){
    $usuario = $_POST["usuario"];

    $bd = new Bd();
    $datos = array("usuario" => $usuario);
    $administradorElminado = $bd->eliminarElemento("administrador", $datos);

    if ($administradorElminado) {
        $mensaje = "El administrador se eliminó correctamente.";
    } else {
        $mensaje = "No se pudo eliminar el administrador. Verifica el nombre del administrador.";
        $mensajeClass = "mensaje-error3";
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
</head>
<body>
<a href="Admin.php"><img class="logo" src="../fotos/LogoFut.png" title="index"></a>
<form method="post">
    <label>Nombre del administrador a eliminar:</label>
    <input type="text" name="usuario">
    <input type="submit" name="eliminar" value="Eliminar">
</form>

<?php if($mensaje): ?>
    <p class="mensaje3 <?php echo $mensajeClass; ?>"><?php echo $mensaje; ?></p>
<?php endif; ?>

</body>
</html>
