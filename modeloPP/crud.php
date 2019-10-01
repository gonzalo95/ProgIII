<?php
    require_once "./clases/vehiculo.php";
    require_once "./clases/servicio.php";
    require_once "./clases/turno.php";
    
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

    function sacarTurno($patente, $fecha, $tipo)
    {
        $turnos = leerArray("./turnos.txt");
        $vehiculos = leerArray("./vehiculos.txt");
        $servicios = leerArray("./tiposServicios.txt");
        $vehiculo = buscarVehiculo($patente, $vehiculos);
        $servicio = buscarServicio($tipo, $servicios);
        if (!$vehiculo) 
        {
            return json_encode("{Error : No existe vehiculo}");
        }
        if (!$servicio) 
        {
            return json_encode("{Error : No existe servicio}");
        }
        foreach ($turnos as $turno) 
        {
            if ($turno->fecha == $fecha) {
                return json_encode("{Error : Fecha no disponible}");
            }
        }
        $obj = new turno($fecha, $patente, $vehiculo->marca, $vehiculo->modelo, $servicio->precio, $tipo);
        array_push($turnos, $obj);
        $file = fopen("./turnos.txt", "w");
        fwrite($file, json_encode($turnos));
        fclose($file);
        return json_encode("{Estado : OK!}");
    }

    function buscarVehiculo($patente, $array)
    {
        foreach ($array as $obj) 
        {
            if ($obj->patente == $patente) {
                return $obj;
            }
        }
        return false;
    }

    function buscarServicio($tipo, $array)
    {
        foreach ($array as $obj) 
        {
            if ($obj->tipo == $tipo) {
                return $obj;
            }
        }
        return false;
    }

    function turnos()
    {
        return leerArray("./turnos.txt");
    }

    function inscripciones($parametro)
    {
        $ocurrencias = array();
        if (!file_exists("./turnos.txt"))
        {
            $respuesta = 'No existe: '.$parametro;
            return json_encode(sprintf("{Error : %s}", $respuesta));
        }
        $array = leerArray("./turnos.txt");
        $flag = false;
        foreach ($array as $obj) 
        {
            if ($obj->fecha == $parametro ||
                $obj->tipo == $parametro) 
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
?>