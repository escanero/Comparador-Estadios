<?php

class administrador{

private $id_admin;
private $usuario;
private $mail;
private $permiso;


function __construct($usuario = "",$mail = "",$permiso = ""){
   
    $this-> usuario = $usuario;
    $this-> mail = $mail;
    $this-> permiso = $permiso;

}




/**
 * Get the value of id_admin
 */ 
public function getId_admin()
{
return $this->id_admin;
}

/**
 * Set the value of id_admin
 *
 * 
 */ 
public function setId_admin($id_admin)
{
$this->id_admin = $id_admin;


}

/**
 * Get the value of usuario
 */ 
public function getUsuario()
{
return $this->usuario;
}

/**
 * Set the value of usuario
 *
 * 
 */ 
public function setUsuario($usuario)
{
$this->usuario = $usuario;


}

/**
 * Get the value of email
 */ 
public function getMail()
{
return $this->mail;
}

/**
 * Set the value of email
 *
 * 
 */ 
public function setMail($mail)
{
$this->mail = $mail;


}

/**
 * Get the value of contraseña
 */ 
public function getPermiso()
{
return $this->permiso;
}

/**
 * Set the value of contraseña
 *
 * 
 */ 
public function setPermiso($permiso)
{
$this->permiso = $permiso;
}



public function insertar($datos){
    $conexion = new Bd();
    $conexion->insertarElemento("administrador",$datos);
        
}

public function validar($usuario, $pass) {
    $conexion = new Bd();
    $usuario = addslashes($usuario);
    $pass = md5($pass);

    // Consulta SQL para verificar las credenciales del administrador
    $sql = "SELECT * FROM administrador WHERE usuario = '$usuario' AND pass = '$pass'";
    $resultado = $conexion->consulta($sql);

    // Comprobar si se encontró un administrador con las credenciales proporcionadas
    if ($resultado->num_rows === 1) {
        return true;  // Las credenciales son válidas
    } else {
        return false;  // Las credenciales son inválidas
    }
}

public function obtenerPermiso($usuario) {
    $conexion = new Bd();
    $usuario = addslashes($usuario);

    // Consulta SQL para obtener el nivel de permiso del administrador
    $sql = "SELECT permiso FROM administrador WHERE usuario = '$usuario'";
    $resultado = $conexion->consulta($sql);

    // Verificar si se obtuvo algún resultado
    if ($resultado->num_rows === 1) {
        $fila = $resultado->fetch_assoc();
        $permiso = $fila['permiso'];

        return $permiso; // Devolver el nivel de permiso del administrador
    } else {
        return 0; // Si no se encontró el administrador, devolver un valor predeterminado o manejarlo según tus necesidades
    }
}
}





?>