<?php

if(isset($_POST) && isset($_POST['titulo'])){
    require_once '../functions/conexion.php';

    $titulo = trim(filter_var($_POST['titulo'], FILTER_SANITIZE_STRING));
    $descripcion = isset($_POST['descripcion']) ? trim(filter_var($_POST['descripcion'], FILTER_SANITIZE_STRING)) : false;
    $categoria = isset($_POST['selectCategoria']) ? (int) trim(filter_var($_POST['selectCategoria'], FILTER_SANITIZE_STRING)) : false;
    $usuario = isset($_SESSION['usuario']) ? (int) $_SESSION['usuario']['id'] : false;

    // Controlador de errores
    $errores = array();

    if(empty($titulo)){
        $errores['titulo'] = 'El titulo es invalido';
    }

    if(empty($descripcion)){
        $errores['descripcion'] = 'La descripcion es invalida';
    }

    if(empty($categoria) || !is_int($categoria)){
        $errores['categoria'] = 'La categoria es invalida';
    }

    if(empty($usuario) || !is_int($usuario)){
        $errores['general'] = 'Error al intentar crear entrada'; 
    }

    if(count($errores) == 0){
        //Cargar en la base de datos
        $stmt = $conexion->prepare("INSERT INTO entradas VALUES(null, ?, ?, ?, ?, CURDATE())");
        $stmt->bind_param("iiss", $usuario, $categoria, $titulo, $descripcion);
        $stmt->execute();
        $resultado = $stmt->affected_rows;

        if($resultado >= 0){
            $_SESSION['completado'] = 'Se ha creado la entrada exitosamente';
        }else{
            $_SESSION['errores']['general'] = 'Error al cargar la entrada';
        }

        $stmt->close();
        $conexion->close();
    }else{
        //Devolver un error
        $_SESSION['errores'] = $errores;
    }
}

header('Location: http://localhost/master-php/proyecto-blog/crear-entrada.php');