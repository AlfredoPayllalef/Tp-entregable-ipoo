<?php
class Viaje{
    private $idviaje;
    private $destino;
    private $cantmaxpasajeros;
    private $colObjPasajeros;
    private $objResponsable;
    private $importe;

    public function __construct() {
        $this->idviaje ="";
        $this->destino="";
        $this->cantmaxpasajeros="";
        $this->colObjPasajeros="";
        $this->objResponsable="";
        $this->importe="";
    }
    //metodos de acceso
    public function getIdViaje(){
        return $this->idviaje;
    }
    public function getDestino(){
        return $this->destino;
    }
    public function getCanMaxPasajeros(){
        return $this->cantMaxPasajeros;
    }
    public function getColObjPasajeros(){
        return $this->colObjPasajeros;
    }
    public function getObjResponsable(){
        return $this->objResponsable;
    }
    public function getImporte(){
        return $this->importe;
    }
    //modificadores
    public function setIdViaje($eId){
        $this->idviaje=$eId;
    }
    public function setDestino($eDestino){
        $this->destino=$eDestino;
    }
    public function setCantMaxPasajeros($cantPasajeros){
        $this->cantMaxPasajeros=$cantPasajeros;
    }
    public function setColObjPasajeros($ePasajeros){
        $this->colObjPasajeros=$ePasajeros;
    }
    public function setObjResponsable($eObjResponsable){
        $this->objResponsable=$eObjResponsable;
    }
    public function setImporte($eImporte){
        $this->importe=$eImporte;
    }
    //mostrar pasajeros:
    public function mostrarPasajeros(){
        $colPasajeros=$this->getColObjPasajeros();
        $cadena="=======================\n";
        for ($i=0; $i <count($colPasajeros) ; $i++) { 
            $cadena.="|N°".$i."|".$colPasajeros[$i]->__toString()."\n";
        }
        $cadena.="=======================\n";
        return $cadena;
    }
    //metodo toString()
    
    public function __toString(){
        $cadena="El Id del Viaje es: ". $this->getIdViaje()."\n";
        $cadena.="El destino del viaje es: ". $this->getDestino()."\n";
        $cadena.="La cantidad maxima de pasajeros es:". $this->getCanMaxPasajeros();
        $cadena.="Los pasajeros del viaje son: ". $this->mostrarPasajeros();
        $cadena.="[\n Informacion del responsable del viaje: ". $this->getObjResponsable()."]\n";
        $cadena.="El Importe del viaje es: ". $this->getImporte()."\n";
        return $cadena;
    }

    public function cargar($id,$des,$cMax,$colPas,$resp,$imp){
        $this->setIdViaje($id);
        $this->setDestino($des);
        $this->setCantMaxPasajeros($cMax);
        $this->setColObjPasajeros($colPas);
        $this->setObjResponsable($resp);
        $this->setImporte($imp);
    }
    //funcion buscar
    public function Buscar($idviaje){
        $base=new BaseDatos();
        $consultaViaje="Select * from viaje where idviaje=".$idviaje;
        $resp= false;
        if($base->Iniciar()){
            if($base->Ejecutar($consultaViaje)){
                if($row2=$base->Registro()){	
                    $this->setIdViaje($idviaje);				
                    $this->setDestino($row2['vdestino']);
                    $this->setCantMaxPasajeros($row2['vcantmaxpasajeros']);
                    $this->setImporte($row2['vimporte']);
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
		$consultaViaje="Select * from viaje ";
		if ($condicion!=""){
		    $consultaViaje=$consultaViaje.' where '.$condicion;
		}
		$consultaViaje.=" order by destino ";
		if($base->Iniciar()){
			if($base->Ejecutar($consultaViaje)){				
				$arregloViaje= array();
				while($row2=$base->Registro()){
					$objViaje=new Viaje();
					$id=$row2['idviaje'];
					$destino=$row2['vdestino'];
					$canMax=$row2['vcantmaxpasajeros'];
					$importe=$row2['vimporte'];
					$objViaje->cargar($id,$destino,$canMax,$importe);
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
    //insertar viaje
    public function insertar(){
		$base=new BaseDatos();
		$resp= false;
		$consultaInsertar="INSERT INTO viaje(idviaje, vdestino, vcantmaxpasajeros,  vimporte) 
				VALUES (".$this->getIdViaje().",'".$this->getDestino()."','".$this->getCanMaxPasajeros()."','".$this->getImporte()."')";
		
		if($base->Iniciar()){

			if($base->Ejecutar($consultaInsertar)){

			    $resp=  true;

			}	else {
					$this->setmensajeoperacion($base->getError());
					
			}

		} else {
				$this->setmensajeoperacion($base->getError());
			
		}
		return $resp;
	}
    // modificar viaje
    public function modificar(){
	    $resp =false; 
	    $base=new BaseDatos();
		$consultaModifica="UPDATE viaje SET vdestino='".$this->getDestino()."',vcantmaxpasajeros='".$this->getCanMaxPasajeros()."'
                           ,vimporte='".$this->getImporte()."' WHERE idviaje=". $this->getIdViaje();
		if($base->Iniciar()){
			if($base->Ejecutar($consultaModifica)){
			    $resp=  true;
			}else{
				$this->setmensajeoperacion($base->getError());
				
			}
		}else{
				$this->setmensajeoperacion($base->getError());
			
		}
		return $resp;
	}
    // eliminar viaje
    public function eliminar(){
		$base=new BaseDatos();
		$resp=false;
		if($base->Iniciar()){
				$consultaBorra="DELETE FROM viaje WHERE idViaje=".$this->getIdViaje();
				if($base->Ejecutar($consultaBorra)){
				    $resp=  true;
				}else{
						$this->setmensajeoperacion($base->getError());
					
				}
		}else{
				$this->setmensajeoperacion($base->getError());
			
		}
		return $resp; 
	}


}