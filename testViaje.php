<?php

include "Viaje.php";

$viaje1 = new Viaje();


/**
 * Función para navegar las opciones de un viaje
 * @param class $viaje
 */
function menuViaje ($viaje) {


do {
    $flag = true;
    echo "\n";
    echo "Menú de viaje: \n";
    echo "------------------- \n";    
    echo "1. Ver información actual del viaje \n";
    echo "2. Modificar datos del viaje \n";
    echo "3. Opciones sobre pasajeros \n";
    echo "4. Salir \n";
    echo "------------------- \n";    
    echo "Selecciona una opción: ";
    $option = trim(fgets(STDIN));
    echo "\n";
    

    echo "******************** \n";

    // Ver información actual del viaje
    if ($option == 1) {
        echo $viaje;
    }

    // Modificar datos del viaje
    else if ($option == 2) {
        echo "-Modificar datos- \n";
        echo "Código de viaje: \n";
        $viaje->setCodViaje();

        echo "Destino de viaje: \n";
        $viaje->setDestino();

        echo "Cantidad máxima de pasajeros: \n";
        $viaje->setCantPasajerosMax();
    }

    // Ver pasajeros
    else if ($option == 3) {
        

        do {
            
            $arrPasajeros = $viaje->getPasajeros();
            $cantPasajeros = count($arrPasajeros);

            $verPasajeros = true;

            echo "\n";
            echo "1. Ver listado completo de pasajeros \n";
            echo "2. Ver un pasajero específico por número \n";
            echo "3. Modificar un pasajero específico por número \n";
            echo "4. Añadir un nuevo pasajero \n";
            echo "5. Volver al menú anterior \n";
            echo "\n";    
            echo "Seleccione una opción: ";   

            $desea = trim(fgets(STDIN));
            echo "\n";

            // Listado completo de pasajeros
            if ($desea == 1) {

                if ($viaje->getCantPasajerosMax() > 0 && $cantPasajeros > 0) {

                    for ($i = 0; $i < $cantPasajeros; $i++) {
                        echo "++++++++++++++++++++++++++++\n";
                        echo "Pasajero N° " . ($i + 1) . " \n";
                        echo "Nombre: " . $arrPasajeros[$i]["nombre"]."\n";
                        echo "Apellido: " . $arrPasajeros[$i]["apellido"]."\n";
                        echo "Número de Documento: " . $arrPasajeros[$i]["nroDoc"]."\n";
                        echo "++++++++++++++++++++++++++++\n";
                    }
    
                } else {
                    echo "Aún no hay pasajeros. (" . $cantPasajeros .")\n";
                }
            
               
            }

            // Ver un pasajero específico por número
            else if ($desea == 2) {

                echo "Seleccione el número de pasajero: ";
                $nroPasajero = intval(trim(fgets(STDIN))) - 1;
                echo "\n";

                if ($nroPasajero >= 0 && $nroPasajero < $cantPasajeros ) {

                    echo "++++++++++++++++++++++++++++\n";
                    echo "Nombre: " . $arrPasajeros[$nroPasajero]["nombre"]."\n";
                    echo "Apellido: " . $arrPasajeros[$nroPasajero]["apellido"]."\n";
                    echo "Número de Documento: " . $arrPasajeros[$nroPasajero]["nroDoc"]."\n";
                    echo "++++++++++++++++++++++++++++\n";

                } else {

                    echo "Número no disponible, por favor intente con otro o verifique la cantidad de pasajeros. \n";
                }
            
            
            } 

            // Modificar un pasajero específico por número
            else if ($desea == 3) {


                echo "Seleccione el número de pasajero: ";
                $nroPasajero = intval(trim(fgets(STDIN))) - 1;
                echo "\n";


                if ($nroPasajero >= 0 && $cantPasajeros > 0 ) {

                    $viaje->addModPasajero($nroPasajero);
                } else {
                    echo "Número no disponible, por favor intente con otro o verifique la cantidad de pasajeros. \n";
                }

            } 

            // Añadir un nuevo pasajero
            else if ($desea == 4) {
                
                $viaje->addModPasajero();
            }
            
            // Salir
            else if ($desea == 5) {

                $verPasajeros = false;

            } else {
                echo "Opción no válida. \n";
            }

        } while ($verPasajeros === true);

    }
    

    // Salir
    else if ($option == 4 ) {
        $flag = false;
        echo "Fin menú de viaje \n";
    } else {
        echo "Opción inválida. Por favor eliga una opción disponible. \n";
    }
    echo "******************** \n";

} while ($flag === true);

}

menuViaje($viaje1);
