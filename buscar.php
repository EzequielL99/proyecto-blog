<?php require_once 'includes/layouts/header.php'; ?>
<!-- CONTENIDO PRINCIPAL -->
<section class="site-header">
    <h1>Busqueda</h1>
    <p>Estas viendo resultados para la busqueda:  <?= $_POST['busqueda'] ?></p>
</section>
<main>
    <div id="principal" class="container entradas">
        <div class="entradas-wrapper">
            <?php
            $entradas = obtenerEntradas($conexion, null, null, $_POST['busqueda']);
            if (!empty($entradas) && $entradas->num_rows >= 1) :
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
            else :
            ?>
                <h4>No se han encontrado resultados</h4>
            <?php
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