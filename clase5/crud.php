<?php
    require_once "./clases/alumno.php";
    
    function leer()
    {
        if (file_exists("./json.txt"))
        {
            $file = fopen("./json.txt", "r");
            $array = fread($file, filesize("./json.txt"));
            fclose($file);
            return json_decode($array);
        }
        return array();
    }

    function guardar($nombre, $legajo)
    {
        $array = array();
        if (file_exists("./json.txt"))
        {
            $array = leer();
        }
        $obj = new Alumno($nombre, $legajo);
        array_push($array, $obj);
        $file = fopen("./json.txt", "w");
        fwrite($file, json_encode($array));
        fclose($file);
        //$archivo -> moveTo('./img/'.$nombre.$legajo);
    }

    function eliminar($id)
    {
        $array = leer();
        $new = array();
        foreach ($array as $obj) {
            if ($obj->legajo == $id){
                continue;
            }
            array_push($new, $obj);
        }
        $file = fopen("./json.txt", "w");
        fwrite($file, json_encode($new));
        fclose($file);
    }

    function modificar($id, $nombre)
    {
        $array = leer();
        $new = array();
        foreach ($array as $obj) {
            if ($obj->legajo == $id) $obj->nombre = $nombre;
        }
        $file = fopen("./json.txt", "w");
        fwrite($file, json_encode($array));
        fclose($file);        
    }
?>