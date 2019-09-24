<?php
    require_once 'vendor/autoload.php';
    require_once "./clases/vehiculo.php";
    require_once "./clases/servicio.php";
    require_once "./crud.php";
    
    use Psr\Http\Message\RequestInterface as Request;
    use Psr\Http\Message\ResponseInterface as Response;

    $config['displayErrorDetails'] = true;
    $config['addContentLengthHeader'] = false;

    $app = new \Slim\App(["settings" => $config]);

    $app -> group('/pp', function()
    {
        $this -> get('/consultarVehiculo/{parametro}', function (Request $request, Response $response, $args){
            $parametro = $args['parametro'];
            $obj = consultarVehiculo($parametro);
            return $response->withJson($obj, 200);
        });

        $this -> post('/cargarVehiculo', function (Request $request, Response $response){
            $args = $request -> getParsedBody();
            $marca = $args['marca'];
            $modelo = $args['modelo'];
            $patente = $args['patente'];
            $precio = $args['precio'];
            $bool = guardarVehiculo($marca, $modelo, $patente, $precio);
            if ($bool)
            {
                return $response->withJson(json_encode("{respuesta : Ok}"), 200);
            }
            return $response->withJson(json_encode("{Error : Patente repetida}"), 200);
        });

        $this -> post('/cargarTipoServicio', function (Request $request, Response $response){
            $args = $request -> getParsedBody();
            $id = $args['id'];
            $tipo = $args['tipo'];
            $demora = $args['demora'];
            $precio = $args['precio'];
            $bool = guardarServicio($id, $tipo, $precio, $demora);
            if ($bool)
            {
                return $response->withJson(json_encode("{respuesta : Ok}"), 200);
            }
            return $response->withJson(json_encode("{Error : Id repetido}"), 200);
        });

        $this -> get('/consultarVehiculo/{parametro}', function (Request $request, Response $response, $args){
            $parametro = $args['parametro'];
            $obj = consultarVehiculo($parametro);
            return $response->withJson($obj, 200);
        });
        
    });

    $app->run();
?>