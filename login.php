<?php

/* require'includes/config/database.php'; */
require 'includes/app.php';
$db = conectarDB();

$errores = [];


/* autenticar usuario */
if($_SERVER['REQUEST_METHOD'] === 'POST') {
    /* echo"<pre>";
    var_dump($_POST);
    echo"</pre>"; */

    $email = mysqli_real_escape_string($db, filter_var($_POST['email'], FILTER_VALIDATE_EMAIL));
    $password = mysqli_real_escape_string($db, $_POST['password']);

    if(!$email){
    $errores[] = "El Email es obligatorio o no es valido";
    }

    if(!$password){
    $errores[] = "El Password es obligatorio o no es valido";
    }

    if(empty($errores)){

        /* Revisar si el usuario existe */
        $query = "SELECT * FROM usuarios WHERE email = '${email}'";
        $resultado = mysqli_query($db, $query);

        if($resultado->num_rows){
            /* Revisar si el Password es correcto */
            $usuario = mysqli_fetch_assoc($resultado);
            
            /* Verificar si el usuario es correcto o no  */

            $auth = password_verify($password, $usuario['password']);

            if($auth){
                /* El usuario esta autenticado */
                session_start();

                /* Llenar de informacion el arreglo de la sesion */
                $_SESSION['usuario'] = $usuario['email'];
                $_SESSION['login'] = true;

                header('Location: /admin');

            } else {
                $errores[] = "El Password es incorrecto";
            }
        } else {
            $errores[] = "El Usuario no existe";
        }
         
    }

}

/* incluye el header */
        
   incluirTemplate('header');
?>

    <main class="contenedor seccion contenido-centrado">
        <h1>Iniciar Sesion</h1>

        <?php foreach($errores as $error) :?>
            <div class="alerta error">
                <?php echo $error;?>
            </div>
        <?php endforeach; ?>    
        <form method="POST" action="" class="formulario">
            <fieldset>
                <legend>Tú Email y Password</legend>

                <label for="email">E-Mail</label>
                <input type="email" name="email" placeholder="Tu E-Mail" id="email" required>

                <label for="password">Password</label>
                <input type="password" name="password" placeholder="Tu Password" id="password" required>
            </fieldset>

            <input type="submit" value="Iniciar Sesión" class="boton boton-verde">

    </main>
    
<?php 

   incluirTemplate('footer');
?>