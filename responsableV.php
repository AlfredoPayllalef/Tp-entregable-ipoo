<?php
class responsableV{
    private $numEmpleado;
    private $numLicencia;
    private $apellido;

    public function __construct($eNumEmpleado,$eNumLicencia,$eApellido){
        $this->numEmpleado=$eNumEmpleado;
        $this->numLicencia=$eNumLicencia;
        $this->apellido=$eApellido;
    }
    //Metodos de acceos
    public function getNumEmpleado(){
        return $this->numEmpleado;
    }
    public function getNumLicencia(){
        return $this->numLicencia;
    }
    public function getApellido(){
        return $this->apellido;
    }
    //metodos modificadores
    public function setNumEmpleado($eNumEmpleado){
        $this->numEmpleado=$eNumEmpleado;
    }
    public function setNumLicencia($eNumLicencia){
        $this->numLicencia=$eNumLicencia;
    } 
    public function setApellido($eApellido){
        $this->apellido=$eApellido;
    }
    // funcion toString
    public function __toString(){
        $cadena="Numero de Empleado: ". $this->getNumEmpleado()."\n";
        $cadena.="Numero de Licencia: ". $this->getNumLicencia()."\n";
        $cadena.="Apellido: ". $this->getApellido()."\n";
        return $cadena;
    }
}