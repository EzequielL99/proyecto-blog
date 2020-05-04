<?php
require_once './includes/functions/conexion.php';
require_once './includes/functions/helpers.php';

$filename = basename($_SERVER['PHP_SELF'], '.php');
switch ($filename) {
    case 'buscar':
        if (!isset($_POST['busqueda'])) {
            header('Location: index.php');
        }

        break;
    case 'categoria':
        if (isset($_GET['id'])) {
            $categoria_actual = obtenerCategoria($conexion, $_GET['id']);

            if (!isset($categoria_actual['id'])) {
                header('Location: index.php');
            }
        } else {
            header('Location: index.php');
        }
        break;
    case 'editar-entrada':
    case 'entrada':
        if (isset($_GET['id'])) {
            $entrada_actual = obtenerEntrada($conexion, $_GET['id']);

            if (!isset($entrada_actual['id'])) {
                header('Location: index.php');
            }
        } else {
            header('Location: index.php');
        }
        break;
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog de Videojuegos</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha256-eZrrJcwDc/3uDhsdt61sL2oOBY362qM3lon1gyExkL0=" crossorigin="anonymous" />
    <link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,500,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="./css/main.css">
    </link>
</head>

<body>
    <?php if ($filename != 'registro' && $filename != 'login') : ?>
        <!-- CABECERA -->
        <header>
            <div class="barra-cabecera container">
                <div class="logo">
                    <a href="./index.php">videojuegos</a>
                </div>
                <!-- MENU PRINCIPAL -->
                <?php  ?>
                <nav id="menu-principal">
                    <ul>
                        <li><a href="./index.php">Inicio</a></li>
                        <?php
                        $categorias = obtenerCategorias($conexion);
                        if (!empty($categorias)) :
                            while ($categoria = mysqli_fetch_assoc($categorias)) :
                        ?>
                                <li><a href="categoria.php?id=<?= $categoria['id'] ?>"><?= $categoria['descripcion'] ?></a></li>
                        <?php
                            endwhile;
                        endif;
                        ?>
                        <li><a href="#">Sobre mi</a></li>
                        <li><a href="#">Contacto</a></li>
                    </ul>
                </nav>
                <div class="login">
                    <?php if (isset($_SESSION['usuario'])) : ?>
                        <button><?= $_SESSION['usuario']['nombre'] . ' ' . $_SESSION['usuario']['apellidos'] ?> <i class="fa fa-caret-down"></i></button>
                        <ul class="acciones">
                            <li><a href="./crear-categoria.php"><i class="fa  fa-folder-open"></i><span>Crear Categoria</span></a></li>
                            <li><a href="./crear-entrada.php"><i class="fa fa-pencil"></i><span>Nueva Entrada</span></a></li>
                            <li><a href="./mis-datos.php"><i class="fa fa-gear"></i><span>Configurar</span></a></li>
                            <li><a href="./includes/models/logout.php"><i class="fa fa-sign-out"></i><span>Salir</span></a></li>
                        </ul>
                    <?php else : ?>
                        <a class="btn btn-outline-light" href="./login.php">Iniciar Sesion</a>
                        <a class="btn btn-outline-primary" href="./registro.php">Registrarse</a>
                    <?php endif; ?>
                </div>
            </div>
        </header>
    <?php endif; ?>