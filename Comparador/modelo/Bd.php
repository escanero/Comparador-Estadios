<?php
class Bd{
    private $server = "localhost:3306";
    private $usuario = "user";
    private $pass = "";
    private $basedatos = "EstadiosComparador";

    private $conexion;
    private $resultado;

    public function __construct(){
        $this->conexion = new mysqli($this->server, $this->usuario, $this->pass, $this->basedatos);
        $this->conexion->select_db($this->basedatos);
        $this->conexion->query("SET NAMES 'utf8'");
    }

    

    public function consulta($sql){
        $this->resultado = $this->conexion->query($sql);
        $res = $this->resultado;
        return $res;
    }

    public function obtenerElementos($tabla, $condicion) {
        $sql = "SELECT * FROM $tabla WHERE ";
        foreach ($condicion as $campo => $valor) {
            $sql .= "$campo = '$valor' AND ";
        }
        $sql = rtrim($sql, "AND ");
        
        $result = $this->conexion->query($sql);
        $elementos = array();
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $elementos[] = $row;
            }
        }
        
        return $elementos;
    }
    

    public function insertarElemento($tabla, $datos,$carpeta="",$foto=""){
        $claves  = array();
        $valores = array();

        foreach ($datos as $clave => $valor){
            if($clave != "id") {
                $claves[] = $clave;
                $valores[] = "'" . $valor . "'";
            }
        }
        if($foto != ""){

            $ruta = subirFoto($foto,$carpeta);

            $claves[] = "ruta";
            $valores[] = "'".$ruta."'";
        }
        $sql = "INSERT INTO ".$tabla." (".implode(',', $claves).") VALUES (".implode(',', $valores).")";
      

        $this->resultado =   $this->conexion->query($sql);
        $res = $this->resultado;
        return $res;
    }


    public function eliminarElemento($tabla, $condicion){
        $sql = "DELETE FROM ".$tabla." WHERE ";
        foreach($condicion as $key => $value){
            $sql .= $key . "='" . $value . "' AND ";
        }
        $sql = rtrim($sql, "AND ");
    
        $this->resultado = $this->conexion->query($sql);
        $filasAfectadas = $this->conexion->affected_rows;
        
        if ($filasAfectadas > 0) {
            return true; // El estadio se eliminó correctamente
        } else {
            return false; // No se pudo eliminar el estadio
        }
    }
    
    public function actualizarElemento($tabla, $datos, $condicion) {
        $campos = array();
    
        foreach ($datos as $clave => $valor) {
            $campos[] = $clave . "='" . $valor . "'";
        }
    
        $condiciones = array();
    
        foreach ($condicion as $clave => $valor) {
            $condiciones[] = $clave . "='" . $valor . "'";
        }
    
        $sql = "UPDATE " . $tabla . " SET " . implode(',', $campos) . " WHERE " . implode(' AND ', $condiciones);
    
        $this->resultado = $this->conexion->query($sql);
        $res = $this->resultado;
        return $res;
    }
    

    
    public function obtenerEstadios(){
        $sql = "SELECT * FROM estadios";
        $result = $this->conexion->query($sql);

        $estadios = array();
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $estadios[] = $row["nombre"];
            }
        }

        return json_encode($estadios);
    }

    
public function validar($usuario, $pass) {
    $conexion = new Bd();
    $usuario = addslashes($usuario);
    $contrasena = addslashes($pass);

    // Consulta SQL para verificar las credenciales del administrador
    $sql = "SELECT * FROM administrador WHERE usuario = '$usuario' AND pass = '$contrasena'";
    $resultado = $conexion->consulta($sql);

    // Comprobar si se encontró un administrador con las credenciales proporcionadas
    if ($resultado->num_rows === 1) {
        return true;  // Las credenciales son válidas
    } else {
        return false;  // Las credenciales son inválidas
    }
}

public function insertarAdministrador($usuario, $pass, $mail, $permiso) {
    $datos = array(
        'usuario' => $usuario,
        'pass' => $pass,
        'mail' => $mail,
        'permiso' => $permiso
    );

    $resultado = $this->insertarElemento('administrador', $datos);
    return $resultado;
}


    
    



}
