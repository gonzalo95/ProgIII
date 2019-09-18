<?php
    require_once 'vendor/autoload.php';
    require_once "./clases/persona.php";
    require_once "./clases/alumno.php";
    require_once "./crud.php";
    
    use Psr\Http\Message\RequestInterface as Request;
    use Psr\Http\Message\ResponseInterface as Response;

    $config['displayErrorDetails'] = true;
    $config['addContentLengthHeader'] = false;

    $app = new \Slim\App(["settings" => $config]);

    // $app -> get('/saludo[/]', function (Request $request, Response $response){
    //     $response -> getBody() -> write("Hello word!!!");
    //     return $response;
    // });

    // $app -> post('/saludo/{nombre}', function (Request $request, Response $response, $args){
    //     $nombre = $args['nombre'];
    //     $response -> getBody() -> write("Hello " . $nombre . "!!!");
    //     return $response;
    // });

    $app -> group('/alumnos', function()
    {
        $this -> get('/', function (Request $request, Response $response){
            $obj = leer();
            return $response ->withJson($obj, 200);
        });

        $this -> post('/', function (Request $request, Response $response){
            $args = $request -> getParsedBody();
            $nombre = $args['nombre'];
            $legajo = $args['legajo'];
            // $archivos = $request -> getUploadedFiles();
            guardar($nombre, $legajo);
            $response -> getBody() -> write("OK!!!");
            return $response;
        });

        $this -> put('/', function (Request $request, Response $response){
            $parametros = $request -> getParsedBody();
            $nombre = $parametros['nombre'];
            $id = $parametros['legajo'];
            modificar($id, $nombre);
            $response -> getBody() -> write("OK!!! - " . $id . " - " . $nombre);
            return $response;
        });

        $this -> delete('/', function (Request $request, Response $response){
            $args = $request -> getParsedBody();
            $id = $args['legajo'];
            eliminar($id);
            $response -> getBody() -> write("OK!!! - " . $id);
            return $response;
        });
    });

    $app->run();
?>