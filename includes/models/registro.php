<?php

if (isset($_POST)) {
    require_once '../functions/conexion.php';

    if (!isset($_SESSION)) session_start();

    $nombre = isset($_POST['nombre']) ? filter_var($_POST['nombre'], FILTER_SANITIZE_STRING) : false;
    $apellidos = isset($_POST['apellidos']) ? filter_var($_POST['apellidos'], FILTER_SANITIZE_STRING) : false;
    $email = isset($_POST['correo']) ? trim(filter_var($_POST['correo'], FILTER_SANITIZE_EMAIL)) : false;
    $pass = isset($_POST['pass']) ? trim(filter_var($_POST['pass'], FILTER_SANITIZE_STRING)) : false;

    $errores = array();
    // Validar los datos antes de guardarlos en la base de datos
    if (empty($nombre) || is_numeric($nombre) || preg_match("/[0-9]/", $nombre)) {
        $errores['nombre'] = "El nombre no es valido";
    }

    if (empty($apellidos) || is_numeric($apellidos) || preg_match("/[0-9]/", $apellidos)) {
        $errores['apellidos'] = "Los apellidos no son validos";
    }

    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errores['correo'] = 'El email no es valido';
    }

    if (empty($pass)) {
        $errores['pass'] = 'La contrasena esta vacia';
    }

    if (count($errores) == 0) { //Existe error
        // Cifrar contrasena
        $pass_hash = password_hash($pass, PASSWORD_BCRYPT, ['cost' => 4]);

        //INSERT TO DB
        $stmt = $conexion -> prepare("INSERT INTO usuarios(nombre, apellidos, email, pass, fecha) VALUES(?, ?, ?, ?, CURDATE())");
        $stmt -> bind_param("ssss", $nombre, $apellidos, $email, $pass_hash);
        $stmt -> execute();

        $resultado = $stmt->affected_rows;

        if ($resultado) {
            $_SESSION['completado'] = "Se ha registrado con exito!";
        } else {
            $_SESSION['errores']['general'] = 'Fallo al guardar el usuario en la BDD';
        }

        $stmt -> close();
        $conexion -> close();
    } else {
        $_SESSION['errores'] = $errores;
    }
}

header('Location: http://localhost/master-php/proyecto-blog/registro.php');
