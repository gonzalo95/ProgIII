<?php
    require_once 'vendor/autoload.php';
    use \Firebase\JWT\JWT;
    
    use Psr\Http\Message\RequestInterface as Request;
    use Psr\Http\Message\ResponseInterface as Response;

    $config['displayErrorDetails'] = true;
    $config['addContentLengthHeader'] = false;

    $app = new \Slim\App(["settings" => $config]);

    // $jwt = JWT::encode($token, $key);
    // $decoded = JWT::decode($jwt, $key, array('HS256'));

    $app -> group('/', function()
    {
        $this -> get('main', function (Request $request, Response $response){
            $token = $request->getHeader('token')[0];
            if ($token) {
                try {
                    $decoded = JWT::decode($token, 'clave', array('HS256'));
                    var_dump($decoded);
                    $response -> getBody() -> write("ok!!"."<hr>");
                } catch (Exception $e) {
                    $response -> getBody() -> write("acceso invalido: ".$e);
                }
            }
            return $response;
        });

        $this -> post('login[/]', function (Request $request, Response $response){
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
    });

    $app->run();
?>