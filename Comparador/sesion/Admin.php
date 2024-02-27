<?php
session_start();

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['usuario'])) {
    // El usuario no ha iniciado sesión, redirigir al formulario de inicio de sesión
    header("Location: loginAdmin.php");
    exit();
}

// Obtener el nombre de usuario almacenado en la sesión
$usuario = $_SESSION['usuario'];
if (isset($_SESSION['permiso'])) {
    $permiso = $_SESSION['permiso'];
} else {
    // El nivel de permiso no está definido, mostrar un mensaje de error o redirigir a una página de acceso denegado
    echo "Acceso denegado";
    exit();
}

// Cerrar sesión si se envió el formulario de cierre de sesión
if (isset($_POST['cerrar_sesion'])) {
    // Destruir todas las variables de sesión
    session_destroy();

    // Redirigir al formulario de inicio de sesión
    header("Location: loginAdmin.php");
    exit();
}

// Cerrar sesión si se envió el formulario de cierre de sesión
if (isset($_POST['cerrar_sesion'])) {
    // Destruir todas las variables de sesión
    session_destroy();

    // Redirigir al formulario de inicio de sesión
    header("Location: loginAdmin.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style1.css">
    <title>Portal Administrador</title>
    <style>
        .cerrarSesion {
  /* Estilos de fondo */
  background-color: #ff0000; /* Color de fondo */
  color: #fff; /* Color del texto */
  background-image: url('../fotos/cerrarSesion.png');
  background-repeat: no-repeat;
  background-position: center center;
  background-size: cover;
  
  /* Estilos de borde */
  border: none; /* Sin borde */
  border-radius: 4px; /* Bordes redondeados */
  
  /* Estilos de tamaño y espacio */
  padding: 10px 20px; /* Espacio interno */
 
  
 width: 150px;
 
  
  /* Efecto de cursor */
  cursor: pointer;
  
  /* Otros estilos opcionales */
  box-shadow: 1px 1px 3px rgba(0, 0, 0, 0.5);  /* Sombra */
  
  float: right;
  margin-right: 50px;
  margin-top: -200px;


}


h4{

  color: white;
  margin-left: 55px;
  
}
    </style>
</head>

<body>
    <a href=""><img class="logo" src="../fotos/LogoFut.png" title="index"></a>

    <h4>Bienvenido <?php echo $usuario; ?></h4>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
    <button type="submit" name="cerrar_sesion" class="cerrarSesion"></button>

    </form>

    <div id="archivo3">
        <h2>Estadios</h2>
        <a href="altaEstadio.php">
            <img class="icon2" src="../fotos/add_1pixel.png" alt="Agregar estadio" title="Agregar Estadio"> </a>
        <a href="actualizarEstadio.php">
            <img class="icon2" src="../fotos/lapiz.png" alt="Editar estadio" title="Editar Estadio"></a>
        <a href="borrarEstadio.php"><img class="icon2" src="../fotos/papelera.png" alt="Eliminar estadio"
                title="Eliminar Estadio">
        </a>
    </div>

    <?php if ($permiso == 3) : ?>

<div id="archivo3">
    <h2>Administrador</h2>
    <a href="altaAdministrador.php">
        <img class="icon1" src="../fotos/add_1pixel.png" alt="Agregar Admin" title="Agregar Admin"> </a>
    <a href="borrarAdmin.php"><img class="icon" src="../fotos/papelera.png" alt="Eliminar Admin"
            title="Eliminar Administrador">
    </a>
</div>
<?php endif; ?>

  
</body>

</html>
