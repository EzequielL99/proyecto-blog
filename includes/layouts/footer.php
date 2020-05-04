<?php if ($filename != 'registro' && $filename != 'login') : ?>
    <!-- PIE DE PAGINA -->
    <footer id="sitio-pie">
        <div class="pie-wrapper container">
            <div class="pie-top">
                <div class="pie-login">
                    <h2>Videojuegos</h2>
                    <?php if (isset($_SESSION['usuario'])) : ?>
                        <span>Usuario: <?= $_SESSION['usuario']['nombre'] . ' ' . $_SESSION['usuario']['apellidos'] ?></span>
                        <a class="text-secondary" href="./includes/models/login.php">Cerrar Sesion</a>
                    <?php else : ?>
                        <a class="btn btn-outline-light" href="#">Iniciar Sesion</a>
                    <?php endif; ?>
                </div>
                <div class="pie-menu">
                    <div class="menu-nosotros">
                        <h4>Nosotros</h4>
                        <a href="#">Nosotros</a>
                    </div>
                    <div class="menu-categorias">
                        <h4>Categorias</h4>
                        <a href="#">categoria1</a>
                        <a href="#">categoria2</a>
                        <a href="#">categoria3</a>
                        <a href="#">categoria4</a>
                    </div>
                    <div class="menu-ayuda">
                        <h4>Ayuda</h4>
                        <a href="#">Ayuda</a>
                        <a href="#">Contacto</a>
                        <a href="#">Terminos y Condiciones</a>
                    </div>
                </div>
            </div>
            <div class="pie-bottom">
                <div class="copyright">
                    <p>Todos los derechos reservados | <?= date('Y') ?> &copy;</p>
                </div>
                <ul class="redes-sociales-wrapper">
                    <li><a href="#">Facebook</a></li>
                    <li><a href="#">Twitter</a></li>
                    <li><a href="#">Instagram</a></li>
                    <li><a href="#">Pinterest</a></li>
                </ul>
            </div>
        </div>
    <?php endif; ?>
    </footer>

    <!-- SCRIPTS -->

    </body>

    </html>