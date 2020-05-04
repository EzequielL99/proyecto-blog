<?php require_once 'includes/layouts/header.php'; ?>
<!-- CONTENIDO PRINCIPAL -->
<main>
    <section class="site-header">
        <h1><?= $entrada_actual['titulo'] ?></h1>
        <p><a href="./categoria.php?id=<?= $entrada_actual['categoria_id'] ?>"><?= $entrada_actual['categoria'] ?></a> | <?= $entrada_actual['fecha'] ?> | <?= $entrada_actual['usuario'] ?></p>
    </section>
    <div id="principal" class="container ver-entrada">
        <div class="entrada-wrapper">
            <h2><?= $entrada_actual['titulo'] ?></h2>
            <p><?= $entrada_actual['descripcion'] ?></p>
            <?php if (isset($_SESSION['usuario']) && $_SESSION['usuario']['id'] == $entrada_actual['usuario_id']) : ?>
                <div class="entrada-acciones">
                    <a href="./includes/models/borrar-entrada.php?id=<?= $entrada_actual['id'] ?>" class="btn btn-outline-danger"><i class="fa fa-trash"></i> Eliminar entrada</a>
                    <a href="./editar-entrada.php?id=<?= $entrada_actual['id'] ?>" class="btn btn-outline-primary"><i class="fa fa-pencil"></i> Editar entrada</a>
                </div>
            <?php endif; ?>
        </div>
        <div class="entrada-imagen"></div>
    </div>
</main>
<?php require_once './includes/layouts/footer.php'; ?>