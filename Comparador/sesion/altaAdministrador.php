<?php 
session_start();

require "../modelo/administrador.php";
require "../modelo/Bd.php";

$mensaje = ""; 
$mensajeClass = "";

if (!isset($_SESSION['usuario'])) {
    // Redirigir al usuario a la página de inicio de sesión
    header("Location: loginAdmin.php");
    exit();
}


if (isset($_POST) && !empty($_POST)) {
    $usuario = $_POST['usuario'];
    $pass = md5($_POST['pass']);
    $mail = $_POST['mail'];
    $permiso = 2;
    unset($_POST["pass2"]);


    $bd = new Bd();
    $resultado = $bd->insertarAdministrador($usuario, $pass, $mail, $permiso);

    if ($resultado) {
        $mensaje = "El administrador se agregó correctamente.";
        $mensajeClass = "mensaje4";
    } else {
        $mensaje = "No se pudo agregar el administrador.";
        $mensajeClass = "mensaje-error4";
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
    <title>Alta administrador</title>
    <script>

function enviarFormu(){

    let pass1 = document.getElementsByName("pass")[0];
    let pass2 = document.getElementsByName("pass2")[0];

    if(pass1.value == pass2.value){
        document.getElementsByName("resgistro")[0].submit();
    }else{
        alert("Tus contraseñas no coinciden.")
    }

}


window.onload = function (){
    document.getElementById("boton").addEventListener("click", enviarFormu);
}

</script>
</head>
    <body>
      
      <a href="Admin.php"><img class="logo" src="../fotos/LogoFut.png"
        title="index"></a>
        <h1>Alta de Administrador</h1>
        <h2 class="<?php echo $mensajeClass; ?>"><?php echo $mensaje; ?></h2>
        <form name="resgistro" action="altaAdministrador.php" method="post">
        <ul>
        <li><label>Usuario: </label><input type="text" name="usuario" > </li>
        <li><label>Contraseña: </label><input type="password" name="pass" > </li>
        <li><label>Confirmar contraseña: </label><input type="password" name="pass2" > </li>
        <li><label>E-mail:</label><input type="email" name="mail" > </li>
        <li><input type="button" id="boton" value="Enviar"> </li>
    </ul>
          </form>
    </body>
    </html>
