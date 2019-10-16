<?php
    require_once "./clases/vehiculo.php";
    require_once "./clases/servicio.php";
    require_once "./clases/turno.php";

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

    function guardarVehiculo($patente, $marca, $kms)
    {
        $array = leerArray("./vehiculos.txt");
        if (validarPatente($patente, $array))
        {
            $obj = new vehiculo($patente, $marca, $kms);
            array_push($array, $obj);

            $file = fopen("./vehiculos.txt", "w");
            fwrite($file, json_encode($array));
            fclose($file);
            echo "{OK : 'vehiculo guardado'}";
        }
        else
        {
            echo "{error : 'patente invalida'}";
        }
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
        $array = leerArray("./vehiculos.txt");
        $flag = false;
        foreach ($array as $obj) 
        {
            if (strtolower($obj->marca) == strtolower($parametro) ||
                strtolower($obj->patente) == strtolower($parametro)) 
            {
                array_push($ocurrencias, $obj);
                $flag = true;
            }
        }
        if ($flag)
        {
            echo json_encode($ocurrencias);
        }
        else
        {
            echo 'No existe: '.$parametro;
        }
    }

    function cargarTipoServicio($id, $tipo, $precio, $demora)
    {
        $array = leerArray("./tiposServicios.txt");
        if (validarServicio($id, $tipo, $array) == 1)
        {
            $obj = new servicio($id, $tipo, $precio, $demora);
            array_push($array, $obj);

            $file = fopen("./tiposServicios.txt", "w");
            fwrite($file, json_encode($array));
            fclose($file);
            echo "{OK : 'servicio guardado'}";
        }
        elseif (validarServicio($id, $tipo, $array) == 2) 
        {
            echo "{error : 'id repetido'}";
        }
        else
        {
            echo "{error : 'tipo invalido'}";
        }
    }

    function validarServicio($id, $tipo, $array)
    {
        if ($tipo != '10.000km' &&
            $tipo != '20.000km' &&
            $tipo != '50.000km')
        {
            return 3;
        }
        foreach ($array as $obj) 
        {
            if ($obj->id == $id) 
            {
                return 2;
            }
        }
        return 1;
    }

    function sacarTurno($patente, $precio, $fecha)
    {
        $turnos = leerArray("./turnos.txt");
        $vehiculos = leerArray("./vehiculos.txt");
        $servicios = leerArray("./tiposServicios.txt");
        $vehiculo = buscarVehiculo($patente, $vehiculos);
        $servicio = buscarServicio($precio, $servicios);
        if (!$vehiculo) 
        {
            echo "{Error : No existe vehiculo}";
            return false;
        }
        if (!$servicio) 
        {
            echo "{Error : No existe servicio}";
            return false;
        }
        foreach ($turnos as $turno) 
        {
            if ($turno->fecha == $fecha) 
            {
                echo "{Error : Fecha no disponible}";
                return false;
            }
        }
        $obj = new turno($fecha, $patente, $vehiculo->marca, $precio, $servicio->tipo);
        array_push($turnos, $obj);
        $file = fopen("./turnos.txt", "w");
        fwrite($file, json_encode($turnos));
        fclose($file);
        echo "{Estado : OK!}";
        return true;
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

    function buscarServicio($precio, $array)
    {
        foreach ($array as $obj) 
        {
            if ($obj->precio == $precio) {
                return $obj;
            }
        }
        return false;
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

    function turnos()
    {
        $tabla = "";
        $array = leerArray("./turnos.txt");
        $filas = count($array);
        if($filas == 0)
        {
            echo "{error: no hay datos}";
            return false;
        }
        for ($i = 0; $i < $filas; $i++) 
        { 
            $turno = $array[$i];
            $tabla = $tabla."<tr><td>".$turno->fecha."</td><td>".$turno->patente."</td><td>".$turno->marca."</td><td>".$turno->precio."</td><td>".$turno->tipo."</td></tr>"; 
        }
        echo "<table>".$tabla."</table>";
    }

    function servicio($parametro)
    {
        $tabla = "";
        $array = leerArray("./turnos.txt");
        $filas = count($array);
        if($filas == 0)
        {
            echo "{error: no hay datos}";
            return false;
        }
        for ($i = 0; $i < $filas; $i++) 
        { 
            $turno = $array[$i];
            if ($turno->tipo == $parametro ||
                $turno->fecha == $parametro) {
                continue;
            }
            $tabla = $tabla."<tr><td>".$turno->fecha."</td><td>".$turno->patente."</td><td>".$turno->marca."</td><td>".$turno->precio."</td><td>".$turno->tipo."</td></tr>"; 
        }
        echo "<table>".$tabla."</table>";
    }

    function modificarVehiculo($patente, $marca, $kms)
    {
        $flag = false;
        $array = leerArray("./vehiculos.txt");
        foreach ($array as $obj) 
        {      
            if ($obj->patente == $patente) 
            {
                $flag = true;
                $archivos = scandir("./fotos");
                foreach($archivos as $archivo)
                {
                    $id = explode("_", $archivo)[0];
                    if ($id == $patente)
                    {
                        rename ("./fotos/".$archivo, "./backupFotos/".$patente."backup".'.'.pathinfo($archivo, PATHINFO_EXTENSION));
                    }
                }
                
                $obj->marca = $marca;
                $obj->kms = $kms;
                $obj->foto = $_FILES['foto']['name'];
                $ext = pathinfo($_FILES["foto"]["name"], PATHINFO_EXTENSION);
                move_uploaded_file($_FILES["foto"]["tmp_name"], "fotos/".$patente."_".date("d-m-y", time()).".".$ext);
            }               
        }
        $file = fopen("./vehiculos.txt", "w");
        fwrite($file, json_encode($array));
        fclose($file);
        if ($flag == true) {
            echo "{OK : 'vehiculo modificado'}";
        }
        else {
            echo "{error : 'patente no encontrada'}";
        }
        
    }

    function traerVehiculos()
    {
        $tabla = "";
        $array = leerArray("./vehiculos.txt");
        $filas = count($array);
        if($filas == 0)
        {
            echo "{error: no hay datos}";
            return false;
        }
        for ($i = 0; $i < $filas; $i++) 
        { 
            $vehiculo = $array[$i];

            if ($vehiculo->foto != null) 
            {
                $tabla = $tabla."<tr><td>".$vehiculo->marca."</td><td>".$vehiculo->patente."</td><td>".$vehiculo->kms."</td><td><img src=".$vehiculo->foto."></td></tr>"; 
            }
            else
            {
                $tabla = $tabla."<tr><td>".$vehiculo->marca."</td><td>".$vehiculo->patente."</td><td>".$vehiculo->kms."</td></tr>"; 
            }
        }
        echo "<table>".$tabla."</table>";
    }
?>