<?php require_once './includes/functions/redireccion.php'; ?>
<?php require_once './includes/layouts/header.php'; ?>
<main>
    <section class="site-header">
        <h1>Mis Datos</h1>
        <p>Estos son tus datos personales. Editalos de ser necesario</p>
    </section>
    <section id="principal" class="container mis-datos">
        <div class="registro-box">
            <h2>Datos Personales</h2>
            <form action="./includes/models/actualizar-usuario.php" method="POST">
                <div class="input-group">
                    <input type="text" name="nombre" id="nombre" value="<?= $_SESSION['usuario']['nombre'] ?>">
                    <label for="nombre">Nombre</label>
                    <?= isset($_SESSION['errores']) ? mostrarError($_SESSION['errores'], 'nombre') : '' ?>
                </div>
                <div class="input-group">
                    <input type="text" name="apellidos" id="apellidos" value="<?= $_SESSION['usuario']['apellidos'] ?>">
                    <label for="apellidos">Apellidos</label>
                    <?= isset($_SESSION['errores']) ? mostrarError($_SESSION['errores'], 'apellidos') : '' ?>
                </div>
                <div class="input-group">
                    <input type="email" name="correo" id="correo" value="<?= $_SESSION['usuario']['email'] ?>">
                    <label for="correo">Email</label>
                    <?= isset($_SESSION['errores']) ? mostrarError($_SESSION['errores'], 'correo') : '' ?>
                </div>
                <div class="input-group enviar">
                    <input type="submit" class="btn btn-primary" name="submit" value="Actualizar">
                    <?php if (isset($_SESSION['completado'])) : ?>
                        <span class="valid-feedback">* <?= $_SESSION['completado'] ?></span>
                    <?php endif; ?>
                    <?= isset($_SESSION['errores']['general']) ? mostrarError($_SESSION['errores'], 'general') : '' ?>
                </div>
            </form>
            <?php borrarErrores(); ?>
        </div>
    </section>
</main>
<?php require_once './includes/layouts/footer.php'; ?>