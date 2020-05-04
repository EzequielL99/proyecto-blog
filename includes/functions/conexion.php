<?php

if (!isset($_SESSION)) session_start();

//Conexion
$server = 'localhost';
$username = 'root';
$password = '';
$db = 'blog_master';

$conexion = mysqli_connect($server, $username, $password, $db);

if (mysqli_connect_errno()){
    echo 'ERROR: No se ha podido conectar a la BDD (' . mysqli_connect_error() . ')';
}

mysqli_query($conexion, "SET NAMES 'utf8'");