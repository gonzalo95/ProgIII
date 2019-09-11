<?php
    include_once("./clases/persona.php");

    class Alumno extends Persona
    {
        public $legajo;
        public $foto;

        public function __construct($nombre, $legajo, $foto){
            parent::__construct($nombre);
            $this->legajo = $legajo;
            $this->foto = $foto;
        }

        public function Mostrar(){
            return json_encode($this);
        }
    }
?>