<?php
    function guardar()
    {
        if (file_exists("./json.txt"))
        {
            $array = leer();
            $obj = new stdClass();
            $obj->nombre = $_POST['nombre'];
            $obj->legajo = $_POST['legajo'];
            array_push($array, $obj);
            $file = fopen("./json.txt", "w");
            fwrite($file, json_encode($array));
            fclose($file);
        }
        else
        {
            $array = array();
            $obj = new stdClass();
            $obj->nombre = $_POST['nombre'];
            $obj->legajo = $_POST['legajo'];
            array_push($array, $obj);
            $file = fopen("./json.txt", "w");
            fwrite($file, json_encode($array));
            fclose($file);
        }
    }

    function leer()
    {
        $file = fopen("./json.txt", "r");
        $array = fread($file, filesize("./json.txt"));
        fclose($file);
        return json_decode($array);
    }

    function eliminar($id)
    {
        $array = leer();
        $new = array();
        foreach ($array as $obj) {
            if ($obj->legajo != $id) array_push($new, $obj);
        }
        $file = fopen("./json.txt", "w");
        fwrite($file, json_encode($array));
        fclose($file);
    }

    function modificar($id)
    {
        $array = leer();
        $new = array();
        foreach ($array as $obj) {
            if ($obj->legajo == $id) $obj->nombre = $_PUT['nombre'];
        }
        $file = fopen("./json.txt", "w");
        fwrite($file, json_encode($array));
        fclose($file);        
    }
?>