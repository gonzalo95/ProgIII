<?php
    include_once("./clases/persona.php");

    class Alumno extends Persona
    {
        public $legajo;

        public function __construct($nombre, $legajo){
            parent::__construct($nombre);
            $this->legajo = $legajo;
        }

        public function Mostrar(){
            return json_encode($this);
        }
    }
?>