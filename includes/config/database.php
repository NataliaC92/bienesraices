<?php

function conectarDB() : mysqli {
    $db = mysqli_connect('localhost', 'root', '', 'bienes_raices');

    if(!$db){
        echo "Error no fue posible la conexion";
        exit;
    }

    return $db;

}