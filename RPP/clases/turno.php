<?php

    class turno
    {
        public $fecha;
        public $patente;
        public $marca;
        public $precio;
        public $tipo;

        public function __construct($fecha, $patente, $marca, $precio, $tipo){
            $this->patente = $patente;
            $this->marca = $marca;
            $this->fecha = $fecha;
            $this->precio = $precio;
            $this->tipo = $tipo;
        }
    }
?>