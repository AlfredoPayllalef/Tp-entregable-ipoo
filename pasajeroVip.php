<?php
include_once("pasajero.php");
class pasajeroVip extends pasajero{
    private $numViajeroFrecuente;
    private $cantMillasAcum;
    public function  __construct(){
        parent:: __construct();
        $this->numViajeroFrecuente="";
        $this->cantMillasAcum="";
    }
    //metodos de acceso
    public function getNumViajeroFrecuente(){
        return $this->numViajeroFrecuente;
    }
    public function getCantMillas(){
        return $this->cantMillasAcum;
    }
    //modificadores
    public function setNumViajeFrecuente($eNumVfrecuente){
        $this->numViajeroFrecuente=$eNumVfrecuente;
    }
    public function setCantMillas($eMillas){
        $this->cantMillasAcum=$eMillas;
    }
    //toSrtring()
    public function __toString(){
        $cadena= parent:: __toString();
        $cadena.="Numero de pasajero frecuente: ". $this->getNumViajeroFrecuente()."\n";
        $cadena.="Cantidad de Millas Acumuladas: ". $this->getCantMillas()."\n";
        return $cadena;
    }
    public function darPorcentajeIncremento(){
        $millas=$this->getCantMillas();
        $porcentaje=1.35;
        if ($millas>300) {
            $porcentaje=300;
        }
        return $porcentaje;
    }
}