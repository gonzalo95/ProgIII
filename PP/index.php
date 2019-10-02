<?php
    require_once 'vendor/autoload.php';
    require_once "./clases/pizza.php";
    require_once "./crud.php";
    
    use Psr\Http\Message\RequestInterface as Request;
    use Psr\Http\Message\ResponseInterface as Response;

    $config['displayErrorDetails'] = true;
    $config['addContentLengthHeader'] = false;

    $app = new \Slim\App(["settings" => $config]);

    session_start();

    if (!isset($_SESSION['id'])){
        $_SESSION['id'] = 1;
    }

    $app -> any('/pp', function (Request $request, Response $response){
        $metodo = $request ->getMethod();
        guardarLog($metodo);
    });

    $app -> group('/pp', function()
    {
        $this -> get('/pizzas/{parametro}', function (Request $request, Response $response, $args){
            $parametro = $args['parametro'];
            $obj = cantidadPizza($parametro);
            return $response->withJson($obj, 200);
        });

        $this -> post('/pizzas', function (Request $request, Response $response){
            $args = $request -> getParsedBody();
            $tipo = $args['tipo'];
            $cantidad = $args['cantidad'];
            $sabor = $args['sabor'];
            $precio = $args['precio'];
            $bool = guardarPizza($_SESSION['id'], $tipo, $precio, $cantidad, $sabor);
            if ($bool)
            {
                $_SESSION['id'] += 1;
                return $response->withJson(json_encode("{respuesta : Ok}"), 200);
            }
            return $response->withJson(json_encode("{respuesta : Error}"), 200);
        });

        $this -> post('/ventas', function (Request $request, Response $response){
            $args = $request -> getParsedBody();
            $mail = $args['mail'];
            $cantidad = $args['cantidad'];
            $sabor = $args['sabor'];
            $tipo = $args['tipo'];
            $bool = guardarPizza($_SESSION['id'], $tipo, $precio, $cantidad, $sabor);
            if ($bool)
            {
                $_SESSION['id'] += 1;
                return $response->withJson(json_encode("{respuesta : Ok}"), 200);
            }
            return $response->withJson(json_encode("{respuesta : Error}"), 200);
        });
    });

    $app->run();
?>