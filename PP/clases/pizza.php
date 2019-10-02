<?php

    class pizza
    {
        public $id;
        public $tipo;
        public $precio;
        public $cantidad;
        public $sabor;

        public function __construct($id, $tipo, $precio, $cantidad, $sabor){
            $this->id = $id;
            $this->tipo = $tipo;
            $this->precio = $precio;
            $this->cantidad = $cantidad;
            $this->sabor = $sabor;
        }
    }
?>