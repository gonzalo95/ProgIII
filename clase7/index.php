<?php
    require_once 'vendor/autoload.php';
    use \Firebase\JWT\JWT;
    
    use Psr\Http\Message\RequestInterface as Request;
    use Psr\Http\Message\ResponseInterface as Response;

    $config['displayErrorDetails'] = true;
    $config['addContentLengthHeader'] = false;

    $app = new \Slim\App(["settings" => $config]);

    $app -> group('/', function()
    {
        $this -> get('main', function (Request $request, Response $response){
            $response -> getBody() -> write("Ya estas autenticado");
            return $response;
        });
    })->add(function($request, $response, $next){
        if (isset($request->getHeader('token')[0])) {
            $token = $request->getHeader('token')[0];
            try {
                $decoded = JWT::decode($token, 'clave', array('HS256'));
                //var_dump($decoded);
                $response = $next($request, $response);
            } catch (Exception $e) {
                $response -> getBody() -> write("acceso invalido: ".$e);
            }
        }
        else {
            $response -> getBody() -> write("Usted no se ha logeado");
        }
        return $response;
    });

    $app->post('/login[/]', function (Request $request, Response $response){
        $args = $request -> getParsedBody();
        $user = $args['user'];
        $pass = $args['pass'];
        if ($user != 'gonzalo' || $pass != '1234') {
            $response -> getBody() -> write("Acceso denegado");
        }
        else {
            $key = "clave";
            $token = array(
                "saludo" => "hola mundo",
                "user" => $user,
                "pass" => $pass,
                "exp" => time() + 120
            );
            $jwt = JWT::encode($token, $key);
            $response -> getBody() -> write($jwt);
        }
        return $response;
    });

    $app->run();
?>