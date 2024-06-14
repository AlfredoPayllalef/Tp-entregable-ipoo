<?php
class empresa{
    private $idEmpresa;
    private $nombre;
    private $direccion;
    private $colViajes;

    public function __construct() {
        $this->idEmpresa="";
        $this->nombre="";
        $this->direccion="";
        $this->colViajes;
    }
    //metodos de acceso
    public function getIdEmpresa(){
        return $this->idEmpresa;
    }
    public function getNombre(){
        return $this->nombre;
    }
    public function getDireccion(){
        return $this->direccion;
    }
    public function getColViajes(){
        return $this->colViajes;
    }
    //modificadores
    public function setIdEmpresa($eId){
        $this->idEmpresa=$eId;
    }
    public function setNombre($eNombre){
        $this-> nombre=$eNombre;
    }
    public function setDireccion($eDireccion){
        $this->direccion=$eDireccion;
    }
    public function setColViajes($eViajes){
        $this->colViajes=$eViajes;
    }
    //mostrar Viajes:
    public function mostrarViajes(){
        $colViajes=$this->getColViajes();
        $cadena="=======================\n";
        for ($i=0; $i <count($colViajes) ; $i++) { 
            $cadena.="|N°".$i."|".$colViajes[$i]->__toString()."\n";
        }
        $cadena.="=======================\n";
        return $cadena;
    }
    //metodo toString()
    public function __toString(){
        $cadena="[El Id de la empresa es:". $this->getIdEmpresa()."]\n";
        $cadena.="[El nombre de la empresa es: ". $this->getNombre()."]\n";
        $cadena.="[La direccion es: ". $this->getDireccion()."]\n";
        $cadena.="La Coleccion de viajes son: ". $this->mostrarViajes();
        return $cadena;
    }
    //funccion cargar
    public function cargar($id,$nom,$dir,$colVia){
        $this->setIdEmpresa($id);
        $this->setNombre($nom);
        $this->setDireccion($dir);
        $this->setColViajes($colVia);
    }
    // funcion buscar empresa
    public function Buscar($idEmpresa){
		$base=new BaseDatos();
		$consultaEmpresa="Select * from empresa where idempresa=".$idEmpresa;
		$resp= false;
		if($base->Iniciar()){
			if($base->Ejecutar($consultaEmpresa)){
				if($row2=$base->Registro()){					
				    $this->setIdEmpresa($idEmpresa);
					$this->setNombre($row2['enombre']);
					$this->setDireccion($row2['edireccion']);
					// $this->setColViajes($row2['cViajes']);
					$resp= true;
				}				
			
		 	}	else {
		 			$this->setmensajeoperacion($base->getError());
		 		
			}
		 }	else {
		 		$this->setmensajeoperacion($base->getError());
		 	
		 }		
		 return $resp;
	}
    //listar viajes
    public function listar($condicion=""){
	    $arregloPersona = null;
		$base=new BaseDatos();
		$consultaEmpresa="Select * from empresa ";
		if ($condicion!=""){
		    $consultaEmpresa=$consultaEmpresa.' where '.$condicion;
		}
		$consultaEmpresa.=" order by enombre ";
		if($base->Iniciar()){
			if($base->Ejecutar($consultaEmpresa)){				
				$arregloViaje= array();
				while($row2=$base->Registro()){
					$objEmpresa=new empresa();
					$id=$row2['idempresa'];
					$nombre=$row2['enombre'];
					$dir=$row2['edireccion'];
					$objViaje->cargar($id,$destino,$canMax,);
					array_push($arregloViaje,$objViaje);
	
				}
			
		 	}	else {
				$this->setmensajeoperacion($base->getError());
			}
		 }	else {
				$this->setmensajeoperacion($base->getError());
		 }	
		 return $arregloViaje;
	}
}