<?php
    require_once "./clases/alumno.php";
    
    function leer()
    {
        $file = fopen("./json.txt", "r");
        $array = fread($file, filesize("./json.txt"));
        fclose($file);
        return json_decode($array);
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
            if ($obj->legajo == $id)
            {
                $obj->nombre = "modificado";
            }
            array_push($new, $obj);
        }
        $file = fopen("./json.txt", "w");
        fwrite($file, json_encode($new));
        fclose($file);        
    }

        // function leer()
    // {
    //     $file = fopen("./json.txt", "r");
    //     $array = fread($file, filesize("./json.txt"));
    //     fclose($file);
    //     return json_decode($array);
    // }

    // function guardar()
    // {
    //     if (file_exists("./json.txt"))
    //     {
    //         $array = leer();
    //         $obj = new stdClass();
    //         $obj->nombre = $_POST['nombre'];
    //         $obj->legajo = $_POST['legajo'];
    //         array_push($array, $obj);
    //         $file = fopen("./json.txt", "w");
    //         fwrite($file, json_encode($array));
    //         fclose($file);
    //     }
    //     else
    //     {
    //         $array = array();
    //         $obj = new stdClass();
    //         $obj->nombre = $_POST['nombre'];
    //         $obj->legajo = $_POST['legajo'];
    //         array_push($array, $obj);
    //         $file = fopen("./json.txt", "w");
    //         fwrite($file, json_encode($array));
    //         fclose($file);
    //     }
    // }

    // function eliminar($id)
    // {
    //     $array = leer();
    //     $new = array();
    //     foreach ($array as $obj) {
    //         if ($obj->legajo == $id){
    //             continue;
    //         }
    //         array_push($new, $obj);
    //     }
    //     $file = fopen("./json.txt", "w");
    //     fwrite($file, json_encode($new));
    //     fclose($file);
    // }

    // function modificar($id)
    // {
    //     $array = leer();
    //     $new = array();
    //     foreach ($array as $obj) {
    //         if ($obj->legajo == $id) $obj->nombre = $_POST['nombre'];
    //     }
    //     $file = fopen("./json.txt", "w");
    //     fwrite($file, json_encode($array));
    //     fclose($file);        
    // }

    // function TraerListado(){
    //     $array = leer();
    //     // var_dump($array);
    //     foreach ($array as $item) {
    //         echo "Nombre: ".$item->nombre.PHP_EOL;
    //         echo "Legajo: ".$item->legajo.PHP_EOL;
    //     }
    // }

    // function TraerUno($id){
    //     $array = leer();
    //     // var_dump($array);
    //     foreach ($array as $item) {
    //         if ($item->legajo == $id) {
    //             echo "Nombre: ".$item->nombre.PHP_EOL;
    //             echo "Legajo: ".$item->legajo.PHP_EOL;
    //         }
    //     }
    // }
?>