<?php
class estadios
{

    private $id_estadio;
    private $nombre;
    private $capacidad;
    private $ciudad;
    private $id_pais;
    private $f_inauguracion;
    private $equipos;
    private $ruta;

    function __construct($nombre = "", $capacidad = "", $ciudad = "", $id_pais = "", $f_inauguracion = "", $equipos = "", $ruta = "")
    {
        $this->nombre = $nombre;
        $this->capacidad = $capacidad;
        $this->ciudad = $ciudad;
        $this->id_pais = $id_pais;
        $this->f_inauguracion = $f_inauguracion;
        $this->equipos = $equipos;
        $this->ruta = $ruta;
    }



    //Getters and Setters



    /**
     * Get the value of id_estadio
     */
    public function getId_estadio()
    {
        return $this->id_estadio;
    }

    /**
     * Set the value of id_estadio
     * 
     * 
     */
    public function setId_estadio($id_estadio)
    {
        $this->id_estadio = $id_estadio;


    }

    /**
     * Get the value of nombre
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Set the value of nombre
     *
     *
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;


    }

    /**
     * Get the value of capacidad
     */
    public function getCapacidad()
    {
        return $this->capacidad;
    }

    /**
     * Set the value of capacidad
     *
     * 
     */
    public function setCapacidad($capacidad)
    {
        $this->capacidad = $capacidad;


    }

    /**
     * Get the value of ciudad
     */
    public function getCiudad()
    {
        return $this->ciudad;
    }

    /**
     * Set the value of ciudad
     *
     * 
     */
    public function setCiudad($ciudad)
    {
        $this->ciudad = $ciudad;


    }

    /**
     * Get the value of id_pais
     */
    public function getId_pais()
    {
        return $this->id_pais;
    }

    /**
     * Set the value of id_pais
     *
     * 
     */
    public function setId_pais($id_pais)
    {
        $this->id_pais = $id_pais;


    }

    /**
     * Get the value of f_inauguración
     */
    public function getF_inauguracion()
    {
        return $this->f_inauguracion;
    }

    /**
     * Set the value of f_inauguración
     *
     * 
     */
    public function setF_inauguracion($f_inauguracion)
    {
        $this->f_inauguracion = $f_inauguracion;


    }

    /**
     * Get the value of equipos
     */
    public function getEquipos()
    {
        return $this->equipos;
    }

    /**
     * Set the value of equipos
     *
     * 
     * 
     * */
    public function setEquipos($equipos)
    {
        $this->equipos = $equipos;


    }
    public function getRuta()
    {
        return $this->ruta;
    }
    public function setRuta($ruta)
    {
        $this->ruta = $ruta;
    }

    public function insertar($datos,$foto=""){
        $conexion = new Bd();
        if($foto==""){
            $conexion->insertarElemento("estadios",$datos);
        }else{
            $conexion->insertarElemento("estadios",$datos,"fotos/",$foto);
        }
    }
}











?>