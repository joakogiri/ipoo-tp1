<?php

class Viaje {
    // Sistema para crear viajes y guardar los datos correspondientes

    /** Atributos:
     *  $codViaje es el código del viaje
     *  $destino es el destino del viaje
     *  $cantPasajerosMax es número con la cantidad de pasajeros
     *  $pasajeros es el array donde se guardan los pasajeros con sus datos
     */
    private $codViaje, $destino, $cantPasajerosMax, $pasajeros;


    // Método constructor
    // Argumentos con valores por defecto para la posibilidad de crear un viaje nuevo vacío
    public function __construct (string $codViaje = '', string $destino = '', int $cantPasajerosMax = 0) {
        $this->codViaje = $codViaje;
        $this->destino = $destino;
        $this->cantPasajerosMax = $cantPasajerosMax;
        $this->pasajeros = [];
    }

    // Función reutilizable para crear un input en la línea de comandos.
    private function callInput () {
        return trim(fgets(STDIN));
    }

    // Getters
    public function getCodViaje() {
        return $this->codViaje;
    }
    
    public function getDestino() {
        return $this->destino;
    }
    
    public function getCantPasajerosMax() {
        return $this->cantPasajerosMax;
    }

    public function getPasajeros() {
        return $this->pasajeros;
    }

    // Setters
    public function setCodViaje() {
        $this->codViaje = $this->callInput();
    }

    public function setDestino() {
        $this->destino = $this->callInput();
    }

    public function setCantPasajerosMax() {
        $this->cantPasajerosMax = intval($this->callInput());
    }

    /**
     * Función reutilizable para el manejo de creación / edición de pasajeros
     * @return array
     */
    private function editPasajero () {
        echo "Nombre: \n";
        $this->pasajero["nombre"] = $this->callInput();

        echo "Apellido: \n";
        $this->pasajero["apellido"] = $this->callInput();

        echo "Número de documento: \n";
        $this->pasajero["nroDoc"] = $this->callInput();


        return $this->pasajero;

    }

    /**
     * Permite crear datos sobre un pasajero y añadirlo al array de pasajeros
     * O modificar los datos de un pasajero ya existente
     * @param mixed $nroPasajero
     */
    public function addModPasajero ($nroPasajero = -1) {


        if ($nroPasajero === -1) {


            if( count($this->pasajeros) < $this->getCantPasajerosMax() ) {

                do {

                    
                    $pasajeroNuevo = $this->editPasajero();
                    
                    array_push($this->pasajeros, $pasajeroNuevo);

                    if (count($this->pasajeros) < $this->cantPasajerosMax ) {

                        echo "Desea añadir otro pasajero? S/N: \n";
                        $this->desea = $this->callInput();
                        $this->desea === 'N' || $this->desea === 'n'? $this->agregar = false :  $this->agregar = true;
    
                    } else {

                        $this->agregar = false;
                    } 

                } while ($this->agregar === true);

            } else {


                echo "Límite de pasajeros alcanzados. (" . $this->getCantPasajerosMax() .  ")\n";
            }


        } else {
            $nroInt = intval($nroPasajero);

            if ($nroInt < count($this->pasajeros)) {

                
                
                $pasajeroMod = $this->editPasajero();
                $this->pasajeros[$nroInt] = $pasajeroMod;
                
            } else {
                echo "Ese número de pasajero no existe. (Cantidad actual de pasajeros: " . count($this->pasajeros) .  ")\n";
            }


        }
        
    }


    public function __toString() {
        return ( $this->getCodViaje() === '' ? "Nuevo viaje sín código, " : "Viaje " . $this->getCodViaje() . " " ) . ($this->getDestino() === '' ? "sin destino" : "con destino a " .$this->getDestino()). ". " . "Cantidad máxima de pasajeros: " . $this->getCantPasajerosMax() . ". \n";
    }


    /*
    public function __destruct() {
        echo $this . " instancia de viaje destruída. Sin referencias de este objeto. \n";
    }
    */
}