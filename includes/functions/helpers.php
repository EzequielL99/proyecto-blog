<?php

function mostrarError($errores, $campo)
{
    $alerta = '';
    if (isset($errores[$campo]) && !empty($errores[$campo])) {
        $alerta = "<span class='invalid-feedback'>" . $errores[$campo] . "</span>";
    }

    return $alerta;
}

function borrarErrores()
{
    $borrado = false;
    if (isset($_SESSION['errores'])) {
        $_SESSION['errores'] = null;
        unset($_SESSION['errores']);
        $borrado = true;
    }

    if (isset($_SESSION['completado'])) {
        $_SESSION['completado'] = null;
        unset($_SESSION['completado']);
        $borrado = true;
    }

    return  $borrado;
}

function obtenerCategoria($conexion, $id){
    $sql = "SELECT * FROM categorias WHERE id = $id";
    $categoria = mysqli_query($conexion, $sql);

    $resultado = array();
    if($categoria && mysqli_num_rows($categoria) > 0){
        $resultado = mysqli_fetch_assoc($categoria);
    }

    return $resultado;
}

function obtenerCategorias($conexion)
{
    $sql = "SELECT * FROM categorias ORDER by id ASC";
    $categorias = mysqli_query($conexion, $sql);
    $resultado = array();

    if ($categorias && mysqli_num_rows($categorias) >= 1) {
        $resultado = $categorias;
    }

    return $resultado;
}

function obtenerEntradas($conexion, $limit = null, $categoria = null, $busqueda = null)
{
    $sql = "SELECT e.*, c.descripcion AS 'categoria' FROM entradas e " .
        "INNER JOIN categorias c ON c.id = e.categoria_id ";

    if (!empty($categoria)){
        $sql .= "WHERE e.categoria_id = $categoria ";
    }

    if (!empty($busqueda)){
        $sql .= "WHERE e.titulo LIKE '%$busqueda%' ";
    }

    $sql .= 'ORDER BY e.id DESC ';

    if ($limit) {
        $sql .= "LIMIT $limit";
    }

    $entradas = mysqli_query($conexion, $sql);

    $resultado = array();
    if ($entradas && mysqli_num_rows($entradas) >= 1) {
        $resultado = $entradas;
    }

    return $resultado;
}

function obtenerEntrada($conexion, $id){
    $sql = "SELECT e.*, c.descripcion AS 'categoria', CONCAT(u.nombre, ' ', u.apellidos) AS 'usuario' FROM entradas e "
        . "INNER JOIN categorias c ON c.id = e.categoria_id "
        . "INNER JOIN usuarios u ON u.id = e.usuario_id "
        . "WHERE e.id = $id";

    $entrada = mysqli_query($conexion, $sql);

    $resultado = array();
    if($entrada && mysqli_num_rows($entrada) > 0){
        $resultado = mysqli_fetch_assoc($entrada);
    }

    return $resultado;
}