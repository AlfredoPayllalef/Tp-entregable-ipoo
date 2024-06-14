<?php
class Pasajero extends Persona{
    private $numPasajero;
    
    public function __construct() {
        parent:: __construct();
        $this->numPasajero ="";
    }

    //metodo de acceso
    public function getNumPasajero(){
        return $this->numPasajero;
    }
    public function getmensajeoperacion(){
		return $this->mensajeoperacion ;
	}
    //modificador
    public function setNumPasajero($eNumPasajero){
        $this-> numPasajero=$eNumPasajero;
    }
    public function setmensajeoperacion($mensajeoperacion){
		$this->mensajeoperacion=$mensajeoperacion;
	}
    // funcino toString()
    public function __toString(){
        $cadena=parent:: __toString();
    }
	public function darPorcentajeIncremento(){
        $porcentaje=1;
        return $porcentaje;
    }

    //funcion cargar
    public function cargar($NroD,$Nom,$Ape,$Tel,$Npas){
        parent:: cargar($NroD,$Nom,$Ape,$Tel);
        $this-> setNumPasajero($Npas);
    }
    // funcion buscar 
    public function Buscar($dni){
		$base=new BaseDatos();
		$consultaPasajero="Select * from pasajero where nrodoc=".$dni;
		$resp= false;
		if($base->Iniciar()){
			if($base->Ejecutar($consultaPasajero)){
				if($row2=$base->Registro()){					
				    parent:: Buscar($dni);
                    $this->setNumPasajero($row2['Npasajero']);
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
    //funcino listar
    public function listar($condicion=""){
	    $arreglo = null;
		$base=new BaseDatos();
		$consulta="Select * from pasajero ";
		if ($condicion!=""){
		    $consulta=$consulta.' where '.$condicion;
		}
		$consulta.=" order by Npasajero ";
		//echo $consultaPersonas;
		if($base->Iniciar()){
		    if($base->Ejecutar($consulta)){				
			    $arreglo= array();
				while($row2=$base->Registro()){
					$obj=new Pasajero();
					$obj->Buscar($row2['nrodoc']);
					array_push($arreglo,$obj);
				}
		 	}	else {
                $this->setmensajeoperacion($base->getError());
			}
		 }	else {
                 $this->setmensajeoperacion($base->getError());
		 }	
		 return $arreglo;
	}	

    //insertar
    public function insertar(){
		$base=new BaseDatos();
		$resp= false;
		if(parent::insertar()){
		    $consultaInsertar="INSERT INTO pasajero(nrodoc, Npasajero)
				VALUES (".$this->getNrodoc().",'".$this->getNumPasajero()."')";
		    if($base->Iniciar()){
		        if($base->Ejecutar($consultaInsertar)){
		            $resp=  true;
		        }	else {
		            $this->setmensajeoperacion($base->getError());
		        }
		    } else {
		        $this->setmensajeoperacion($base->getError());
		    }
		 }
		return $resp;
	}
    // funcion modificar
    public function modificar(){
	    $resp =false; 
	    $base=new BaseDatos();
	    if(parent::modificar()){
	        $consultaModifica="UPDATE pasajero SET Npasajero='".$this->getNumPasajero()."' WHERE nrodoc=". $this->getNrodoc();
	        if($base->Iniciar()){
	            if($base->Ejecutar($consultaModifica)){
	                $resp=  true;
	            }else{
	                $this->setmensajeoperacion($base->getError());
	                
	            }
	        }else{
	            $this->setmensajeoperacion($base->getError());
	            
	        }
	    }
		
		return $resp;
	}
    // eliminar
    public function eliminar(){
		$base=new BaseDatos();
		$resp=false;
		if($base->Iniciar()){
				$consultaBorra="DELETE FROM pasajero WHERE nrodoc=".$this->getNrodoc();
				if($base->Ejecutar($consultaBorra)){
				    if(parent::eliminar()){
				        $resp=  true;
				    }
				}else{
						$this->setmensajeoperacion($base->getError());
					
				}
		}else{
				$this->setmensajeoperacion($base->getError());
			
		}
		return $resp; 
	}
}