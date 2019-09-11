<?php
    var_dump($_FILES);
    // var_dump($_POST);
    $file = $_FILES['file'];
    $name = $file['name'];
    echo "nombre: ".$name.PHP_EOL;
    echo "temporal: ".$file['tmp_name'];
    // MAGIA NEGRA
    $path = $_FILES['file']['name'];
    $ext = pathinfo($path, PATHINFO_EXTENSION);
    $num = 0;
    foreach (scandir('C:\xampp\htdocs\ProgIII\clase4') as $f) {
        if (strpos($f, 'archivo') !== false) {
            $num++;
            echo $num;
        }
    }
    move_uploaded_file($file['tmp_name'], 'C:\xampp\htdocs\ProgIII\clase4\archivo'.$num.'.'.$ext);
?>