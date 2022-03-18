<?php 

/* importar  conexion DB */
/* require 'includes/config/database.php'; */
require 'include/app.php';
$db = conectarDB();

/* crear usuario y password */
$email = "correo@correo.com";
$password = "123456";

$passwordHash = password_hash($password, PASSWORD_DEFAULT);


/* Query para crear usuario */
$query = "INSERT INTO usuarios (email,password) VALUES ('${email}','${passwordHash}')";

/* Agregar a la DB */
mysqli_query($db, $query);
