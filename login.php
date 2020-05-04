<?php require_once './includes/functions/helpers.php' ?>
<?php require_once './includes/layouts/header.php'; ?>
<main>
    <section id="principal" class="container registro">
        <div class="registro-box">
            <h2>Acceder</h2>
            <form action="./includes/models/login.php" method="POST">
                <div class="input-group">
                    <input type="email" name="correo" id="correo">
                    <label for="correo">Email</label>
                </div>
                <div class="input-group">
                    <input type="password" name="pass" id="pass">
                    <label for="pass">Contrasena</label>
                </div>

                <div class="input-group enviar">
                    <input type="submit" class="btn btn-primary" name="submit" value="Ingresar">
                    <?= isset($_SESSION['errores']) ? mostrarError($_SESSION['errores'], 'login') : '' ?>
                </div>

                <div class="input-group iniciar-sesion">
                    <a href="./registro.php">Registrarme</a>
                </div>

            </form>
            <?php borrarErrores(); ?>
        </div>
    </section>
</main>

<?php require_once './includes/layouts/footer.php'; ?>