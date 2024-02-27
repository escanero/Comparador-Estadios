<?php
require_once '../modelo/administrador.php';
require_once '../modelo/Bd.php';

// Iniciar la sesión
session_start();

// Crear una instancia de la clase Bd para establecer la conexión a la base de datos
$bd = new Bd();

if(isset($_POST) && !empty($_POST)){
    $usuario = ($_POST['usuario']);
    $pass = ($_POST['pass']);

    // Crear una instancia de la clase Administrador
    $administrador = new administrador();

    // Verificar las credenciales
    if ($administrador->validar($usuario, $pass)) {
        // Obtener el nivel de permiso del usuario
        $nivelPermiso = $administrador->obtenerPermiso($usuario);
    
        // Las credenciales son válidas, almacenar el usuario y el nivel de permiso en la variable de sesión
        $_SESSION['usuario'] = $usuario;
        $_SESSION['permiso'] = $nivelPermiso;
    
        // Redirigir al usuario a una página de administrador
        header("Location: Admin.php");
        exit(); // Importante: detener la ejecució
    } else {
        // Las credenciales son inválidas
        $mensaje = "Usuario o contraseña incorrectos";
        echo '<script>alert("' . $mensaje . '");</script>';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <title>Log-in</title>
</head>
<body>
    <a href="../index.html"><img class="logo" src="../fotos/LogoFut.png" title="index"></a>
    
    <form name="login" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
        <label for="username">Usuario:</label>
        <input type="text" id="username" name="usuario">
        <label for="password">Contraseña:</label>
        <input type="password" id="password" name="pass">
        <div class="remember">
            <input class="checkbox" type="checkbox" name="Recuérdame">Recuérdame
        </div>
        <button type="submit" class="boton">Iniciar</button>
    </form>
</body>
</html>
