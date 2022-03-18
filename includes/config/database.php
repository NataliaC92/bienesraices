<?php

function conectarDB() : mysqli {
    $db = new mysqli('localhost', 'root', '', 'bienes_raices');

    if(!$db){
        echo "Error no fue posible la conexion";
        exit;
    }

    return $db;

}