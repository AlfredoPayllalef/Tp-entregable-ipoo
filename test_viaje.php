<?php
include_once("viaje.php");
include_once("responsableV.php");
include_once("pasajero.php");
include_once("pasajeroVip.php");
include_once("pasajerosNecesidadesEsp.php");
$objpasajero1=new pasajero("Juan", "Perez",36472788,"2995299299","D-21","CCN-034");
$objpasajero2=new pasajeroVip("Maria", "Ortiz",35572788,"299886330","D-24","CCN-064","434567-4",400);
$objpasajero3=new pasajero("Pablo", "Manquez",37338112,"299623299","I-34","CCN-090");
$objpasajero4=new pasajeroVip("Pepe", "Mujica",30338117,"2994220345","D-3","CCN-032","004780-6",50);
$objpasajero5=new pasajerosNecesidadesEsp("Ines", "Becerra",30822955,"2996694822","I-9","CCN-077","No","Comida sin Tacc","No");
$objpasajero6=new pasajero("Jonas", "Ramirez",36472788,"2995293457","D21","CCN-354");
$objpasajero7=new pasajpasajerosNecesidadesEspero("Lucas", "Perez",43444552,"2994568932","I-4","CCN-043","Silla de ruedas","Comida Vegana","No");

$colPasajeros=[$objpasajero1,$objpasajero2,$objpasajero3,$objpasajero4,$objpasajero5,$objpasajero6,$objpasajero7];
$objResponsable=new responsableV("AL3-045","002-45322","Pereyra");
$objViaje=new viaje("0034-ML","Cancun",20,$colPasajeros,$objResponsable,80,3648);

echo "======================Bienvenido====================== \nIngrese una de las opciones deseadas\n";

do {
    echo "Ingrese (1) para modificar los datos de un pasajero \n";
    echo "Ingrese (2) para Vender pasaje \n";
    echo "Ingrese (3) para ver la coleccion de pasajeros \n";
    echo "Ingrese (4) para salir \n";
    $valor=trim(fgets(STDIN));
    if ($valor==1) {
        echo "echo ingrese el DNI del pasajero \n";
        $dniPasajero=trim(fgets(STDIN));
        $objPasajero= $objViaje->buscarPersonaPorDni($dniPasajero);
        if ($objPasajero!=null) {
            echo "=============\n".$objPasajero->__toString()."=============\n";
            echo "ingrese (1) para modificar el nombre \n";
            echo "ingrese (2) para modificar el apellido \n";
            echo "ingrese (3) para modificar el telefono \n";
            $cambio=trim(fgets(STDIN));
            if ($cambio==1) {
                echo "ingrese el nuevo Nombre: ";
                $eNombre=trim(fgets(STDIN));
                $objPasajero->setNombre("$eNombre");
                echo $objPasajero->__toString();
            }
            if ($cambio==2) {
                echo "ingrese el nuevo Apellido: ";
                $eApellido=trim(fgets(STDIN));
                $objPasajero->setApellido("$eApellido");
                echo $objPasajero->__toString();
            }
            if ($cambio==3) {
                echo "ingrese el nuevo Telefono: ";
                $eTelefono=trim(fgets(STDIN));
                $objPasajero->setTelefono("$eTelefono");
                echo $objPasajero->__toString();
            }
        }
        else {
            echo "No se encontro el pasajero con el dni:". $dniPasajero;
        }
    }
    if ($valor==2) {
        if ($objViaje->hayPasajesDisponible()) {
            echo "ingrese (1) si es un pasajero estándar \n";
            echo "ingrese (2) si es un pasajero Vip \n";
            echo "ingrese (3) si es un pasajero con alguna necesidad especial \n";
            $tipoPasajero=trim(fgets(STDIN));
            echo "Ingrese el solo Nombre: \n";
            $eNombre=trim(fgets(STDIN));
            echo "Ingrese el apellido: \n";
            $eApellido=trim(fgets(STDIN));
            echo "ingrese el DNI del pasajero: \n";
            $eDni=trim(fgets(STDIN));
            echo "ingrese el numero de telefono: \n";
            $eTelefono=trim(fgets(STDIN));
            echo "ingrese el numero de asiento: \n";
            $eNumAsiento=trim(fgets(STDIN));
            echo "ingrese el numero de Tiket: \n";
            $eNumTiket=trim(fgets(STDIN));
            if ($tipoPasajero==1) { //ingresa pasajero estandar
                $objPasajeroAgregar=new pasajero("$eNombre","$eApellido",$eDni,"$eTelefono","$eNumAsiento","$eNumTiket");
                if ($objViaje->venderPasaje($objPasajeroAgregar)) {
                    echo "********Se agrego correctamente a:********\n ";
                    echo $objPasajeroAgregar->__toString(); 
                }
                else {
                    echo "No se pudo vender el pasaje";
                }
            }
            if ($tipoPasajero==2) {//ingresa pasajero Vip
                echo "ingrese el numero de Viajero Frecuente: \n";
                $numFrecuente=trim(fgets(STDIN));
                echo "ingrese la cantidad de Millas Acumuladas: \n";
                $millas=trim(fgets(STDIN));
                $objPasajeroAgregar=new pasajeroVip("$eNombre","$eApellido",$eDni,"$eTelefono","$eNumAsiento","$eNumTiket","$numFrecuente",$millas);
                if ($objViaje->venderPasaje($objPasajeroAgregar)) {
                    echo "********Se agrego correctamente a:********\n ";
                    echo $objPasajeroAgregar->__toString(); 
                }
                else {
                    echo "No se pudo vender el pasaje";
                }
            }
            if ($tipoPasajero==3) {//pasajero con necesidades especiales
                echo "¿El pasajero necesita ayuda con su movilidad? [afirmativo especifique, en caso contrario ponga (No)] \n";
                $eMovilidad=trim(fgets(STDIN));
                echo "¿El pasajero necesita alguna comida especial? [afirmativo especifique, en caso contrario ponga (No)] \n";
                $eComida=trim(fgets(STDIN));
                echo "¿El pasajero necesita alguna Asistencia particular? [afirmativo especifique, en caso contrario ponga (No)] \n";
                $eAsistencia=trim(fgets(STDIN));
                $objPasajeroAgregar=new pasajerosNecesidadesEsp("$eNombre","$eApellido",$eDni,"$eTelefono","$eNumAsiento","$eNumTiket","$numFrecuente",$eMovilidad,$eComida,$eAsistencia);
                if ($objViaje->venderPasaje($objPasajeroAgregar)) {
                    echo "********Se agrego correctamente a:********\n ";
                    echo $objPasajeroAgregar->__toString(); 
                }
                else {
                    echo "No se pudo vender el pasaje";
                }
            }
            else {
                echo"no se encontro una opcion valida";
            }

        }
        else {
            echo"El viaje no cuenta con disponibilidad";
        }
    }
    if ($valor==3) {
        echo $objViaje->mostrarPasajeros();
    }
} while ($valor==1 || $valor==2 ||$valor==3);



echo "Ingrese el solo Nombre: \n";
$eNombre=trim(fgets(STDIN));
echo "Ingrese el apellido: \n";
$eApellido=trim(fgets(STDIN));
echo "ingrese el DNI del pasajero: \n";
$eDni=trim(fgets(STDIN));
echo "ingrese el numero de telefono: \n";
$eTelefono=trim(fgets(STDIN));
echo "ingrese el numero de asiento: \n";
$eNumAsiento=trim(fgets(STDIN));
echo "ingrese el numero de Tiket: \n";
$eNumTiket=trim(fgets(STDIN));
$objPasajeroAgregar=new pasajero("$eNombre","$eApellido",$eDni,"$eTelefono","$eNumAsiento","$eNumTiket");
if ($objViaje->venderPasaje($objPasajeroAgregar)) {
    echo "********Se agrego correctamente a:********\n ";
    echo $objPasajeroAgregar->__toString(); 
}
else {
    echo "No se pudo vender el pasaje";
}