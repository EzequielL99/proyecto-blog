<?php
//Iniciar la sesion y la conexion con la BDD
require_once '../functions/conexion.php';

//Recoger datos del formulario
if (isset($_POST['correo'])) {
    $email = isset($_POST['correo']) ? trim(filter_var($_POST['correo'], FILTER_SANITIZE_EMAIL)) : false;
    $pass = isset($_POST['pass']) ? trim(filter_var($_POST['pass'], FILTER_SANITIZE_STRING)) : false;

    $errores = array();

    // Comprobar las credenciales del usuario
    $sql = "SELECT * FROM usuarios WHERE email = '$email' LIMIT 1";
    $resultado = $conexion->query($sql);

    if ($resultado->num_rows == 1) {
        $usuario = $resultado->fetch_assoc();

        $verificacion = password_verify($pass, $usuario['pass']);

        if ($verificacion) {
            // Utilizar sesion para guardar los datos del usuario logueado
            $_SESSION['usuario'] = $usuario;

            header('Location: http://localhost/master-php/proyecto-blog/');
        } else {
            $errores['login'] = 'Las credenciales son invalidas';
        }
    } else {
        // Si algo falla enviar una sesion con fallo
        $errores['login'] = 'Las credenciales son invalidas';
    }

    if (count($errores) != 0){
        $_SESSION['errores'] = $errores;
    }
}

//Redirigir al index.php
if (isset($_SESSION['errores'])) header('Location: http://localhost/master-php/proyecto-blog/login.php');
