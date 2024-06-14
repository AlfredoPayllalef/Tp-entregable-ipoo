<?php
include_once("pasajero.php");
class pasajerosNecesidadesEsp extends pasajero{
    private $problemaMovilidad;
    private $comidaEspecial;
    private $asistencia;
    public function  __construct(){
        parent::  __construct();
        $this->problemaMovilidad="";
        $this->comidaEspecial="";
        $this->asistencia="";
    }
    //metodos de acceso
    public function getProblemaMovilidad(){
        return $this->problemaMovilidad;
    }
    public function getComidaEspecial(){
        return $this->comidaEspecial;
    }
    public function getAsistencia(){
        return $this->asistencia;
    }
    //modificadores
    public function setProblemaMovilidad($eMovilidad){
        $this->problemaMovilidad=$eMovilidad;
    }
    public function setComidaEspecial($eComida){
        $this->comidaEspecial=$eComida;
    }
    public function setAsistencia($eAsistencia){
        $this->asistencia=$eAsistencia;
    }
    public function __toString(){
        $cadena= parent:: __toString();
        $cadena.="Tiene Problemas de movilidad: ". $this->getProblemaMovilidad()."\n";
        $cadena.="Necesita comida especial: ". $this->getComidaEspecial()."\n";
        $cadena.="Necesita asistencia especial: ". $this->getAsistencia();
        return $cadena;
    }
    public function darPorcentajeIncremento(){
       $movilidad=$this->getProblemaMovilidad();
       $comida=$this->getComidaEspecial();
       $asistencia=$this->getAsistencia();
       $acum=0;
       $porcentaje=1.15;
        if ($movilidad=="no" || $movilidad=="No" || $movilidad=="NO") {
            $acum+=1;
        }
        if ($comida=="no" || $comida=="No" || $comida=="NO") {
            $acum+=1;
        }
        if ($asistencia=="no" || $asistencia=="No" || $asistencia=="NO") {
            $acum+=1;
        }
        if ($acum>1) {
            $porcentaje=1.3;
        }
        return $porcentaje;
    }

}