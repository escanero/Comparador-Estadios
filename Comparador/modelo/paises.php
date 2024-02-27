<?php
class paises{
    //atributos
    private $id_pais;
    private $nombrePais;


    function __construct($id_pais = "",$nombrePais = ""){
        $this->id_pais = $id_pais;
        $this->nombrePais = $nombrePais;
    }

    //Getters and setters

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
     * Get the value of nombre
     */ 
    public function getNombrePais()
    {
        return $this->nombrePais;
    }

    /**
     * Set the value of nombre
     *
     * 
     */ 
    public function setNombre($nombrePais)
    {
        $this->nombrePais = $nombrePais;

        
    }
}
?>