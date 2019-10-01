<?php

    class turno
    {
        public $fecha;
        public $patente;
        public $marca;
        public $modelo;
        public $precio;
        public $tipo;

        public function __construct($fecha, $patente, $marca, $modelo, $precio, $tipo){
            $this->fecha = $fecha;
            $this->patente = $patente;
            $this->marca = $marca;
            $this->modelo = $modelo;
            $this->precio = $precio;
            $this->tipo = $tipo;
        }

        public function Mostrar(){
            return json_encode($this);
        }
    }
?>