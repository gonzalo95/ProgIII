<?php
    //Ej 1
    // $nombre = "Gonzalo";
    // $apellido = "Greco";
    // echo "$apellido".","."$nombre";

    // Ej 2
    // $x = -3;
    // $y = 15;
    // echo $x + $y;

    // Ej 3
    // $x = -3;
    // $y = 15;
    // echo "X: $x</br>"."Y: $y</br>".($x + $y);

    // Ej 4
    // $num = 0;
    // $sum = 0;
    // while ($sum + $num < 1000) 
    // {
    //     $sum += $num;
    //     $num ++;
    //     //echo "</br>".$num;
    // }
    // echo "</br>TOTAL: ".$sum;
    // echo "</br>CANTIDAD: ".$num;

    // Ej 5
    // $a = 5;
    // $b = 1;
    // $c = 5;

    // if ($a < $b && $a > $c || $a > $b && $a < $c) {
    //     echo $a;
    // }
    // elseif ($b < $a && $b > $c || $b > $a && $b < $c) {
    //     echo $b;
    // }
    // elseif ($c < $b && $c > $a || $c > $b && $c < $a) {
    //     echo $c;
    // }
    // else {
    //     echo "Sin valor medio";
    // }

    //Ej 6
    // $operador = "*";
    // $operando1 = 2;
    // $operando2 = 1;

    // switch ($operador) {
    //     case '+':
    //         echo $operando1 + $operando2;
    //         break;

    //     case '-':
    //         echo $operando1 - $operando2;
    //         break;

    //     case '/':
    //         if ($operando2 != 0) echo $operando1 / $operando2;
    //         else echo "PERO COMO VAS A DIVIDIR ENTRE CERO!?";
    //         break;

    //     case '*':
    //         echo $operando1 * $operando2;
    //         break;
        
    //     default:
    //         echo "QUE ES ESE OPERADOR!?";
    //         break;
    // }

    // Ej 7
    // echo 'Hoy es: </br>';
    // echo date("d-m-y")."</br>";
    // echo date("M d Y")."</br>";
    // echo date("Y/M/D")."</br>";

    // $dia = date('z');
    // if($dia < 80 || $dia > 356){
    //     echo 'Verano';
    // }
    // if($dia < 173){
    //     echo 'Otoño';
    // }
    // if($dia < 266){
    //     echo 'Invierno';
    // }
    // else{ 
    //     echo 'Primavera';
    // }

    // Ej 9
    // $lista = array();
    // for ($i = 0; $i < 5 ; $i++) 
    // { 
    //     $lista[$i] = rand(1, 10);
    // }
    
    // var_dump($lista);
    // echo "Promedio: ".(array_sum($lista) / count($lista));

    //Ej 10
    // $lista = array();
    // for ($i = 1; $i < 20; $i += 2) 
    // { 
    //     array_push($lista, $i);
    // }

    // var_dump($lista);

    // for ($i=0; $i < count($lista); $i++) 
    // { 
    //     echo $lista[$i]."</br>";
    // }

    // foreach ($lista as $valor) 
    // {
    //     echo $valor."</br>";
    // }

    // $i = 0;
    // while ($i < count($lista)) 
    // {
    //     echo $lista[$i]."</br>";
    //     $i++;
    // }

    // Ej 11
    // $v[1]=90;
    // $v[30]=7;
    // $v['e']=99;
    // $v['hola']= 'mundo';

    // foreach ($v as $clave => $valor) 
    // {
    //     echo $valor."</br>";
    // }

    // Ej 15
    // for ($i = 1; $i <= 4; $i++) 
    // { 
    //     for ($j = 1; $j <= 4; $j++) 
    //     { 
    //         echo CalcularPotencia($i, $j)."</br>";
    //     }
    // }

    // function CalcularPotencia($num, $exp)
    // {
    //     return pow($num, $exp);
    // }

    // Ej 16
    // var_dump(Invertir(array('a', 'b', 'c')));

    // function Invertir($lista)
    // {
    //     return array_reverse($lista);
    // }

    // Ej 17
    // echo Validar("Recuperatorio", 100);
    // function Validar($palabra, $max)
    // {
    //     $validas = array("Recuperatorio", "Parcial", "Programacion");
    //     if (in_array($palabra, $validas) && strlen($palabra) <= $max) return 1;
    //     return 0;
    // }

    //Ej 18
    // echo EsPar(2)."</br>";
    // echo EsImpar(2)."</br>";
    // echo EsPar(3)."</br>";
    // echo EsImpar(3)."</br>";

    // function EsPar($num)
    // {
    //     return ($num % 2 == 0) ? "TRUE" : "FALSE";
    // }

    // function EsImpar($num)
    // {
    //     return (EsPar($num) == "FALSE") ? "TRUE" : "FALSE";
    // }
?>