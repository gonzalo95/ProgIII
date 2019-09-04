<?php
    include_once("./leer.php");
    
    function guardar()
    {
        if (file_exists("./json.txt"))
        {
            $array = leer();
            var_dump($array);
            $obj = new stdClass();
            $obj->nombre = $_GET['nombre'];
            array_push($array, $obj);
            $file = fopen("./json.txt", "w");
            fwrite($file, json_encode($array));
            fclose($file);
        }
        else
        {
            $array = array();
            $obj = new stdClass();
            $obj->nombre = $_GET['nombre'];
            array_push($array, $obj);
            $file = fopen("./json.txt", "w");
            fwrite($file, json_encode($array));
            fclose($file);
        }
    }
?>