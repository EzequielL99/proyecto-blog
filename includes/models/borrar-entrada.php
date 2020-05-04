<?php
require_once '../functions/conexion.php';

if (isset($_SESSION['usuario']) && isset($_GET['id'])){
    $entrada_id = (int) filter_var($_GET['id'], FILTER_SANITIZE_STRING);
    $usuario_id = (int) $_SESSION['usuario']['id'];

    // Eliminar entrada de la BDD
    $stmt = $conexion->prepare("DELETE FROM entradas WHERE usuario_id = ? AND id = ?");
    $stmt->bind_param("ii", $usuario_id, $entrada_id);
    $stmt->execute();

    $resultado = $stmt->affected_rows;
    if($resultado == 1){
    }else{
    }
}


header("Location: http://localhost/master-php/proyecto-blog/index.php");