<?php
    include_once("./clases/persona.php");
    include_once("./clases/alumno.php");
    include_once("./crud.php");

    // $file = fopen("./test.txt", "a");
    // fwrite($file, "Hola Miguel".PHP_EOL);
    // fwrite($file, "Hola Martin".PHP_EOL);
    // fwrite($file, "Hola Mabel".PHP_EOL);
    // fwrite($file, "Hola Raquel".PHP_EOL);
    // copy("./test.txt", "./copia.txt");
    // unlink("./test.txt");
    // fclose($file);
    // $aux = fopen("./copia.txt", "r");
    // echo fread($aux, filesize("./copia.txt"));
    // fclose($aux);

    // guardar();
    // $array = leer();
    // var_dump($array);

    $request = $_SERVER['REQUEST_METHOD'];

    switch ($request) {
        case 'GET': //LISTAR
            if (isset($_GET['id'])) {
                TraerUno($_GET['id']);
            } 
            else {
                TraerListado();
            }
            break;
        
        case 'POST': //GUARDAR
            if ($_POST['metodo'] == 'PUT') {
                modificar($_POST['id']);
            } 
            elseif ($_POST['metodo'] == 'DELETE') {
                eliminar($_POST['id']);
            }
            else {
                guardar();
            }
            break;

        case 'PUT': //MODIFICAR
            var_dump($_PUT);
            // modificar($_PUT['legajo']);
            break;

        case 'DELETE': //BORRAR
            var_dump($_DELETE);
            // eliminar($_DELETE['legajo']);
            break;

        default:
            echo json_encode("{status : request error}");
            break;
    }
?>