<?php
class pasajoEstandar extends Pasajero{

    public function  __construct(){
        parent:: __construct();
    }
    public function darPorcentajeIncremento(){
        $porcentaje=1.1;
        return $porcentaje;
    }
    public function __toStrig(){
        $cadena= parent:: __toStrig();
        return $cadena;
    }
}