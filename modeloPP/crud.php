<?php
    require_once "./clases/vehiculo.php";
    require_once "./clases/servicio.php";
    
    function leerVehiculos()
    {
        if (file_exists("./vehiculos.txt"))
        {
            $file = fopen("./vehiculos.txt", "r");
            $array = fread($file, filesize("./vehiculos.txt"));
            fclose($file);
            return json_decode($array);
        }
        return array();
    }

    function guardarVehiculo($marca, $modelo, $patente, $precio)
    {
        $array = array();
        if (file_exists("./vehiculos.txt"))
        {
            $array = leerVehiculos();
        }
        if (validarPatente($patente, $array))
        {
            $obj = new vehiculo($marca, $modelo, $patente, $precio);
            array_push($array, $obj);
            $file = fopen("./vehiculos.txt", "w");
            fwrite($file, json_encode($array));
            fclose($file);
            return true;
        }
        return false;
    }

    function validarPatente($patente, $array)
    {
        foreach ($array as $obj) 
        {
            if ($obj->patente == $patente) {
                return false;
            }
        }
        return true;
    }

    function consultarVehiculo($parametro)
    {
        $ocurrencias = array();
        if (!file_exists("./vehiculos.txt"))
        {
            $respuesta = 'No existe: '.$parametro;
            return json_encode(sprintf("{Error : %s}", $respuesta));
        }
        $array = leerVehiculos();
        $flag = false;
        foreach ($array as $obj) 
        {
            if ($obj->patente == $parametro ||
                $obj->marca == $parametro ||
                $obj->modelo == $parametro) 
            {
                array_push($ocurrencias, $obj);
                $flag = true;
            }
        }
        if ($flag)
        {
            return $ocurrencias;
        }
        $respuesta = 'No existe: '.$parametro;
        return json_encode(sprintf("{Error : %s}", $respuesta));
        
    }

    function leerArray($path)
    {
        if (file_exists($path))
        {
            $file = fopen($path, "r");
            $array = fread($file, filesize($path));
            fclose($file);
            return json_decode($array);
        }
        return array();
    }

    function guardarServicio($id, $tipo, $precio, $demora)
    {
        $array = leerArray("./tiposServicios.txt");
        if (validarId($id, $array))
        {
            $obj = new servicio($id, $tipo, $precio, $demora);
            array_push($array, $obj);
            $file = fopen("./tiposServicios.txt", "w");
            fwrite($file, json_encode($array));
            fclose($file);
            return true;
        }
        return false;
    }

    function validarId($id, $array)
    {
        foreach ($array as $obj) 
        {
            if ($obj->id == $id) {
                return false;
            }
        }
        return true;
    }

    function sacarTurno()
    {
        
    }
?>