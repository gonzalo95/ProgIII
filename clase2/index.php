<?php
    include_once("./clases/persona.php");
    include_once("./clases/alumno.php");
    include_once("./alumnoDAO.php");

    // echo "hola";
    // var_dump($_GET);
    // if (isset($_GET['nombre'])) {
    //     echo $_GET['nombre'];
    // }

    // if (isset($_GET['nombre']) && ($_GET['nombre'] != "" && isset($_GET['legajo']))) {
    //     $alumno = new Alumno($_GET['nombre'], $_GET['legajo']);
    //     // $alumno->Saludar();
    //     // echo "</br>";
    //     // var_dump($alumno);
    //     echo $alumno->Mostrar();
    // }
    // else {
    //     //echo "EROR: Faltan parametros!!!";
    // }

    // $alumnos = array();
    // if (isset($_POST['cantidad']) && (is_numeric($_POST['cantidad']))) {
    //     for ($i = 0; $i < $_POST['cantidad']; $i++) { 
    //         $alumno = new Alumno("Nuevo alumno", $i + 1);
    //         array_push($alumnos, $alumno);
    //     }
    //     echo json_encode($alumnos);
    // }
    // else{
    //     echo "EROR: Faltan parametros!!!";
    // }

    $request = $_SERVER['REQUEST_METHOD'];

    switch ($request) {
        case 'GET':
            if (isset($_GET['caso']) && ($_GET['caso'] == "alumno")) {
                TraerListado();
            } 
            else {
                echo json_encode("{status : case error}");
            }
            break;
        
        case 'POST':
            if (isset($_POST['caso']) && ($_POST['caso'] == "alumno")) {
                Guardar(new Alumno($_POST['nombre'], $_POST['legajo']));
            }
            else {
                echo json_encode("{status : case error}");
            }
            break;

        default:
            echo json_encode("{status : request error}");
            break;
    }
?>