<?php

    class venta
    {
        public $id;
        public $tipo;
        public $precio;
        public $cantidad;
        public $sabor;
        public $mail;

        public function __construct($id, $tipo, $precio, $cantidad, $sabor, $mail){
            $this->id = $id;
            $this->tipo = $tipo;
            $this->precio = $precio;
            $this->cantidad = $cantidad;
            $this->sabor = $sabor;
            $this->mail = $mail;
        }
    }
?>