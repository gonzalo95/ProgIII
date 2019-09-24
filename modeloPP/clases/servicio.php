<?php

    class servicio
    {
        public $id;
        public $tipo;
        public $precio;
        public $demora;

        public function __construct($id, $tipo, $precio, $demora){
            $this->id = $id;
            $this->tipo = $tipo;
            $this->precio = $precio;
            $this->demora = $demora;
        }

        public function Mostrar(){
            return json_encode($this);
        }
    }
?>