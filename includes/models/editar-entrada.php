<?php

if (isset($_POST) && isset($_POST['titulo'])) {
    require_once '../functions/conexion.php';

    $titulo = trim(filter_var($_POST['titulo'], FILTER_SANITIZE_STRING));
    $descripcion = isset($_POST['descripcion']) ? trim(filter_var($_POST['descripcion'], FILTER_SANITIZE_STRING)) : false;
    $categoria = isset($_POST['selectCategoria']) ? (int) trim(filter_var($_POST['selectCategoria'], FILTER_SANITIZE_STRING)) : false;
    $entrada_id = isset($_GET['editar']) ? (int) filter_var($_GET['editar'], FILTER_SANITIZE_STRING) : false;
    $usuario_id = isset($_SESSION['usuario']) ? (int) $_SESSION['usuario']['id'] : false;

    // Controlador de errores
    $errores = array();

    if (empty($titulo)) {
        $errores['titulo'] = 'El titulo es invalido';
    }

    if (empty($descripcion)) {
        $errores['descripcion'] = 'La descripcion es invalida';
    }

    if (empty($categoria) || !is_int($categoria)) {
        $errores['categoria'] = 'La categoria es invalida';
    }

    if (empty($entrada_id) || !is_int($entrada_id) || empty($usuario_id) || !is_int($usuario_id)) {
        $errores['general'] = 'Error al intentar actualizar entrada';
    }

    if (count($errores) == 0) {
        //Cargar en la base de datos
        $stmt = $conexion->prepare("UPDATE entradas SET titulo = ?, descripcion = ?, categoria_id = ? WHERE id = ? AND usuario_id = ?");
        $stmt->bind_param("ssiii", $titulo, $descripcion, $categoria, $entrada_id, $usuario_id);
        $stmt->execute();
        $resultado = $stmt->affected_rows;

        if ($resultado == 1) {
            $_SESSION['completado'] = 'Se ha actualizado la entrada exitosamente';
        } else {
            $_SESSION['errores']['general'] = 'Error al actualizazr la entrada';
        }

        $stmt->close();
        $conexion->close();
    } else {
        //Devolver un error
        $_SESSION['errores'] = $errores;
    }

    header("Location: http://localhost/master-php/proyecto-blog/editar-entrada.php?id=$entrada_id");
} else {
    header("Location: http://localhost/master-php/proyecto-blog/index.php");
}
