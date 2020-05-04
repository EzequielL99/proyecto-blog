<?php require_once './includes/functions/redireccion.php'; ?>
<?php require_once './includes/layouts/header.php'; ?>
<main>
    <section class="site-header">
        <h1>Crear categoria</h1>
        <p>Crea tu propia categoria aqui</p>
    </section>
    <section id="principal" class="container crear-categoria">
        <h2>Crear Nueva Categoria</h2>
        <div class="registro-box">
            <form action="./includes/models/crear-categoria.php" method="POST">
                <div class="form-categoria-wrapper">
                    <div class="input-group categoria">
                        <input type="text" name="categoria" id="categoria">
                        <label for="categoria">Nueva Categoria</label>
                        <?= isset($_SESSION['errores']) ? mostrarError($_SESSION['errores'], 'categoria') : '' ?>
                    </div>
                    <div class="input-group enviar">
                        <input type="submit" class="btn btn-primary" name="submit" value="Crear Categoria">
                        <?php if (isset($_SESSION['completado'])) : ?>
                            <span class="valid-feedback">* <?= $_SESSION['completado'] ?></span>
                        <?php endif; ?>
                        <?= isset($_SESSION['errores']['general']) ? mostrarError($_SESSION['errores'], 'general') : '' ?>
                    </div>
                </div>
            </form>
            <?php borrarErrores(); ?>
        </div>
    </section>
</main>
<?php require_once './includes/layouts/footer.php'; ?>