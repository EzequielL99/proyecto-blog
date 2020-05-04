<?php

if(isset($_POST) && isset($_POST['categoria'])){
    require_once '../functions/conexion.php';

    $categoria = trim(filter_var($_POST['categoria'], FILTER_SANITIZE_STRING));

    // Control de errores
    $errores = array();

    //Validar los datos antes de guardarlos en la BDD

    // Validar campo categoria
    if(!empty($categoria) && !is_numeric($categoria) && !preg_match("/[0-9]/", $categoria)){
        $nombre_validado = true;
    }else{
        $errores['categoria'] = "La categoria es invalida";
    }

    if(count($errores) == 0){
        $stmt = $conexion->prepare("INSERT INTO categorias(descripcion) VALUES(?)");
        $stmt->bind_param("s", $categoria);
        $stmt->execute();
        $resultado = $stmt->affected_rows;

        if($resultado > 0){
            $_SESSION['completado'] = 'La categoria se ha creado con exito';
        }else{
            $_SESSION['errores']['general'] = 'Se ha producido un error al insertar';
        }

        $stmt->close();
        $conexion->close();
    }else{
        $_SESSION['errores'] = $errores;
    }
}

header('Location: http://localhost/master-php/proyecto-blog/crear-categoria.php');