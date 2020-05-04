<?php

if (isset($_POST) && isset($_POST['nombre'])) {
    require_once '../functions/conexion.php';

    $nombre = trim(filter_var($_POST['nombre'], FILTER_SANITIZE_STRING));
    $apellidos = isset($_POST['apellidos']) ? trim(filter_var($_POST['apellidos'], FILTER_SANITIZE_STRING)) : false;
    $email = isset($_POST['correo']) ? trim(filter_var($_POST['correo'], FILTER_SANITIZE_EMAIL)) : false;
    $usuario_id = (int) $_SESSION['usuario']['id'];

    // Controlador de errores
    $errores = array();

    if (empty($nombre) || !is_string($nombre) || preg_match("/[0-9]/", $nombre)) {
        $errores['nombre'] = 'El nombre es invalido';
    }

    if (empty($apellidos) || !is_string($apellidos) || preg_match("/[0-9]/", $apellidos)) {
        $errores['apellidos'] = 'Los apellidos son invalidos';
    }

    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errores['correo'] = "El email ingresado es invalido";
    }

    if (count($errores) == 0) {

        //Comprobar si existe el correo
        $sql = "SELECT id FROM usuarios WHERE email = '$email'";
        $resultado = mysqli_query($conexion, $sql);
        $usuario_bdd = mysqli_fetch_assoc($resultado);

        if (($usuario_bdd['id'] == $usuario_id) || empty($usuario_bdd)) {
            // Actualizar el usuario
            $stmt = $conexion->prepare("UPDATE usuarios SET nombre = ?, apellidos = ?, email = ? WHERE id = ?");
            $stmt->bind_param("sssi", $nombre, $apellidos, $email, $usuario_id);
            $stmt->execute();

            $resultado = $stmt->affected_rows;

            if ($resultado >= 1) {
                //Actualizar sesion
                $_SESSION['usuario']['nombre'] = $nombre;
                $_SESSION['usuario']['apellidos'] = $apellidos;
                $_SESSION['usuario']['email'] = $email;

                $_SESSION['completado'] = 'Tus datos se han actualizado con exito';
            } else {
                $_SESSION['errores']['general'] = 'Error al actualizar tus datos';
            }
        } else {
            $_SESSION['errores']['general'] = 'Ya existe un usuario con ese correo';
        }
    } else {
        $_SESSION['errores'] = $errores;
    }
}

header('Location: http://localhost/master-php/proyecto-blog/mis-datos.php');
