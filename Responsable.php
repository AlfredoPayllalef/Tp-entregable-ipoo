<?php
class Responsable extends Persona{
    private $numEmpleado;
    private $numLicencia;

    public function __construct(){
        parent:: __construct();
        $this->numEmpleado="";
        $this->numLicencia="";

    }
    //Metodos de acceos
    public function getNumEmpleado(){
        return $this->numEmpleado;
    }
    public function getNumLicencia(){
        return $this->numLicencia;
    }
    public function getmensajeoperacion(){
		return $this->mensajeoperacion ;
	}
    //metodos modificadores
    public function setNumEmpleado($eNumEmpleado){
        $this->numEmpleado=$eNumEmpleado;
    }
    public function setNumLicencia($eNumLicencia){
        $this->numLicencia=$eNumLicencia;
    } 
    public function setmensajeoperacion($mensajeoperacion){
		$this->mensajeoperacion=$mensajeoperacion;
	}
    
    // funcion toString
    public function __toString(){
        $cadena="Numero de Empleado: ". $this->getNumEmpleado()."\n";
        $cadena.="Numero de Licencia: ". $this->getNumLicencia()."\n";
        return $cadena;
    }
    //funcion cargar
    public function cargar($NroD,$Nom,$Ape,$Tel,$Nemp,$Nlic){
        parent:: cargar($NroD,$Nom,$Ape,$Tel);
        $this-> setNumEmpleado($Nemp);
        $this-> setNumLicencia($Nlic);
    }
    //funcion buscar
    public function Buscar($dni){
		$base=new BaseDatos();
		$consultaResponsable="Select * from responsable where nrodoc=".$dni;
		$resp= false;
		if($base->Iniciar()){
			if($base->Ejecutar($consultaResponsable)){
				if($row2=$base->Registro()){					
				    parent:: Buscar($dni);
                    $this->setNumEmpleado($row2['Nempleado']);
                    $this->setNumLicencia($row2['Nlicencia']);
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
		$consulta="Select * from responsable ";
		if ($condicion!=""){
		    $consulta=$consulta.' where '.$condicion;
		}
		$consulta.=" order by Nempleado ";
		if($base->Iniciar()){
		    if($base->Ejecutar($consulta)){				
			    $arreglo= array();
				while($row2=$base->Registro()){
					$obj=new Responsable();
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
		    $consultaInsertar="INSERT INTO responsable(nrodoc,Nempleado,Nlicencia)
				VALUES (".$this->getNrodoc().",'".$this->getNumEmpleado()."','".$this->getNumLicencia()."')";
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
	        $consultaModifica="UPDATE responsable SET Nempleado='".$this->getNumEmpleado()."',Nlicencia='".$this->getNumLicencia()."' WHERE nrodoc=". $this->getNrodoc();
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
				$consultaBorra="DELETE FROM responsable WHERE nrodoc=".$this->getNrodoc();
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