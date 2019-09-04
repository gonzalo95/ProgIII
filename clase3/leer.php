<?php
    function leer()
    {
        $file = fopen("./json.txt", "r");
        $array = fread($file, filesize("./json.txt"));
        fclose($file);
        return json_decode($array);
    }
?>