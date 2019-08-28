<?php
    include_once("./clases/persona.php");
    include_once("./clases/alumno.php");

    session_start();

    if (!isset($_SESSION['alumnos'])){
        $_SESSION['alumnos'] = array();
    }

    function Guardar($alumno){
        array_push($_SESSION['alumnos'], $alumno);
        echo json_encode("{status : ok}");
    }

    function TraerListado(){
        echo json_encode($_SESSION['alumnos']);
    }

    //session_unset();
?>