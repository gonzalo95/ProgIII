<?php
    require_once "./clases/pizza.php";

    function leerArray($path)
    {
        if (file_exists($path) && filesize($path) > 0) // SI NO HAGO ESTA COMPROBACION PUEDE ROMPER
        {
            $file = fopen($path, "r");
            $array = fread($file, filesize($path));
            fclose($file);
            return json_decode($array);
        }
        return array();
    }

    function guardarPizza($id, $tipo, $precio, $cantidad, $sabor)
    {
        $array = leerArray("./pizza.txt");
        if (validarPizza($tipo, $sabor, $array))
        {
            $obj = new pizza($id, $tipo, $precio, $cantidad, $sabor);
            array_push($array, $obj);
            
            $path = $_FILES['imagen1']['name'];
            $ext = pathinfo($path, PATHINFO_EXTENSION);
            $string = 'C:\xampp\htdocs\ProgIII\PP\pizzas\pizza'.'.'.$tipo.'.'.$sabor;
            move_uploaded_file($_FILES['imagen1']['tmp_name'], $string.'1.'.$ext);

            $path = $_FILES['imagen2']['name'];
            $ext = pathinfo($path, PATHINFO_EXTENSION);
            move_uploaded_file($_FILES['imagen2']['tmp_name'], $string.'2.'.$ext);

            $file = fopen("./pizza.txt", "w");
            fwrite($file, json_encode($array));
            fclose($file);
            return true;
        }
        return false;
    }

    function validarPizza($tipo, $sabor, $array)
    {
        if ($tipo != 'molde' &&
            $tipo != 'piedra')
        {
            return false;
        }
        if ($sabor != 'muzza' &&
            $sabor != 'jamon' &&
            $sabor != 'especial')
        {
            return false;
        }
        foreach ($array as $obj) 
        {
            if ($obj->tipo == $tipo &&
                $obj->sabor == $sabor) {
                return false;
            }
        }
        return true;
    }

    function cantidadPizza($parametro){
        $cantidad = 0;
        if (!file_exists("./pizza.txt"))
        {
            $respuesta = 'No existe: '.$parametro;
            return json_encode(sprintf("{Error : %s}", $respuesta));
        }
        $array = leerArray("./pizza.txt");
        $flag = false;
        foreach ($array as $obj) 
        {
            if ($obj->sabor == strtolower($parametro) ||
                $obj->tipo == strtolower($parametro)) 
            {
                $cantidad += $obj->cantidad;
                $flag = true;
            }
        }
        if ($flag)
        {
            return $cantidad;
        }
        $respuesta = 'No existe: '.$parametro;
        return json_encode(sprintf("{Error : %s}", $respuesta));
    }

    function guardarLog($metodo)
    {
        $hora = date("(H:i:s)", $time);
        if (file_exists("./log.txt") && filesize("./log.txt") > 0)
        {
            $file = fopen("./log.txt", "a");
            fwrite($file, $hora.'.'.$metodo.PHP_EOL);
            fclose($file);
        }
        else
        {
            $file = fopen("./log.txt", "w");
            fwrite($file, $hora.'.'.$metodo.PHP_EOL);
            fclose($file);
        }
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