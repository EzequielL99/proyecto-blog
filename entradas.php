<?php require_once 'includes/layouts/header.php'; ?>
<!-- CONTENIDO PRINCIPAL -->
<section class="site-header">
    <h1>Todas las Entradas</h1>
    <p>Puedes ver todas las entradas de todas las categorias</p>
</section>
<main>
    <div id="principal" class="container entradas">
        <div class="entradas-wrapper">
            <?php
            $entradas = obtenerEntradas($conexion);
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
                <a class="btn btn-primary" href="./index.php">Volver al Inicio</a>
            </div>
        </div>
        <div class="inicio-imagen">

        </div>
    </div>
</main>
<?php require_once './includes/layouts/footer.php'; ?>