<?php

    class vehiculo
    {
        public $marca;
        public $patente;
        public $kms;

        public function __construct($patente, $marca, $kms){
            $this->patente = $patente;
            $this->marca = $marca;
            $this->kms = $kms;
        }
    }
?>