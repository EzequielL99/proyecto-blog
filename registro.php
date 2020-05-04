<?php require_once './includes/functions/helpers.php' ?>
<?php require_once './includes/layouts/header.php'; ?>
<main>
    <section id="principal" class="container registro">
        <div class="registro-box">
            <h2>Registrate</h2>
            <form action="./includes/models/registro.php" method="POST">
                <div class="input-group">
                    <input type="text" name="nombre" id="nombre">
                    <label for="nombre">Nombre</label>
                    <?= isset($_SESSION['errores']) ? mostrarError($_SESSION['errores'], 'nombre') : '' ?>
                </div>
                <div class="input-group">
                    <input type="text" name="apellidos" id="apellidos">
                    <label for="apellidos">Apellidos</label>
                    <?= isset($_SESSION['errores']) ? mostrarError($_SESSION['errores'], 'apellidos') : '' ?>
                </div>
                <div class="input-group">
                    <input type="email" name="correo" id="correo">
                    <label for="correo">Email</label>
                    <?= isset($_SESSION['errores']) ? mostrarError($_SESSION['errores'], 'correo') : '' ?>
                </div>
                <div class="input-group">
                    <input type="password" name="pass" id="pass">
                    <label for="pass">Contrasena</label>
                    <?= isset($_SESSION['errores']) ? mostrarError($_SESSION['errores'], 'pass') : '' ?>
                </div>

                <div class="input-group enviar">
                    <input type="submit" class="btn btn-primary" name="submit" value="Registrarme">
                    <?php if (isset($_SESSION['completado'])): ?>
                        <span class="valid-feedback">* <?= $_SESSION['completado'] ?></span>
                    <?php endif; ?>
                    <?= isset($_SESSION['errores']['general']) ? mostrarError($_SESSION['errores'], 'general') : '' ?>
                </div>
                
                <div class="input-group iniciar-sesion">
                    <a href="./login.php">Iniciar sesion</a>
                </div>
            </form>
            <?php borrarErrores(); ?>
        </div>
    </section>
</main>

<?php require_once './includes/layouts/footer.php'; ?>