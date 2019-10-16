<?php
    require_once "./crud.php";
    require_once "./clases/vehiculo.php";
    require_once "./clases/servicio.php";
    require_once "./clases/turno.php";

    $proveedores = "proveedores.txt";
    $pedidos = "pedidos.txt";
    
    switch (getenv('REQUEST_METHOD')) 
    {
        case 'GET':
        if($_GET['caso'] == "consultarVehiculo")
        {
            consultarVehiculo($_GET['parametro']);
        }
        elseif ($_GET['caso'] == "sacarTurno")
        {
            sacarTurno($_GET['patente'], $_GET['precio'], $_GET['fecha']);
        }
        elseif ($_GET['caso'] == "turnos")
        {
            turnos();
        }
        elseif ($_GET['caso'] == "servicio")
        {
            servicio($_GET['parametro']);
        }
        elseif ($_GET['caso'] == "vehiculos")
        {
            traerVehiculos();
        }
            break;
        case 'POST':
            if($_POST['caso'] == "cargarVehiculo")
            {
            	guardarVehiculo($_POST['patente'], $_POST['marca'], $_POST['kms']);
            }
            elseif ($_POST['caso'] == "cargarTipoServicio")
            {
                cargarTipoServicio($_POST['id'], $_POST['tipo'], $_POST['precio'], $_POST['demora']);
            }
            elseif ($_POST['caso'] == "modificarVehiculo")
            {
                modificarVehiculo($_POST['patente'], $_POST['marca'], $_POST['kms']);
            }
            break;
        case 'PUT':
            break;
        case 'DELETE':
            # code...
            break;
                
        default:
            echo "Error";
            break;
    }
?>