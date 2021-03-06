<?php require_once 'includes/layouts/header.php'; ?>
<!-- CONTENIDO PRINCIPAL -->
<section class="site-header inicio">
    <h1>Blog de Videojuegos</h1>
    <div class="buscador">
        <p>Te brindamos las ultimas noticias en videojuegos. No te las podes perder!</p>
        <form action="./buscar.php" method="POST">
            <label for="busqueda">Buscador: </label>
            <input type="text" name="busqueda" id="busqueda" placeholder="Ingresa una palabra">
            <button type="submit"><i class="fa fa-search"></i></button>
        </form>
    </div>
</section>
<main>
    <div id="principal" class="container inicio">
        <div class="entradas-wrapper">
            <h2>Ultimas entradas</h2>
            <?php
            $entradas = obtenerEntradas($conexion, 4);
            if (!empty($entradas)) :
                while ($entrada = mysqli_fetch_assoc($entradas)) :
            ?>
                    <article class="entrada">
                        <h4><?= $entrada['titulo'] ?></h4>
                        <span class="fecha"><?= $entrada['categoria'] . ' | ' . $entrada['fecha'] ?></span>
                        <p>
                            <?= substr($entrada['descripcion'], 0, 180) . '...' ?>
                        </p>
                        <a class="btn btn-primary" href="./entrada.php?id=<?= $entrada['id'] ?>">Leer la nota</a>
                    </article>
            <?php
                endwhile;
            endif;
            ?>
            <div class="todas-entradas">
                <a class="btn btn-primary" href="./entradas.php">Todas las entradas</a>
            </div>
        </div>
        <div class="inicio-imagen">

        </div>
    </div>
</main>
<?php require_once './includes/layouts/footer.php'; ?>