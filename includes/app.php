<?php 
/* este archivo App.php sera quien coordine todo
mande a llamar funciones,db,etc */

require 'funciones.php';
require 'config/database.php';
require __DIR__ . '/../vendor/autoload.php';

/* Conectarnos a la DB  */
$db = conectarDB();

use App\Propiedad;


Propiedad::setDB($db);


    

