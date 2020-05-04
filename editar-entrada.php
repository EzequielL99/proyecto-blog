<?php require './includes/functions/redireccion.php'; ?>
<?php require './includes/layouts/header.php'; ?>
<main>
    <section class="site-header">
        <h1>Editar Entrada</h1>
        <p>Edita tu entrada anadiendo informacion util</p>
    </section>
    <section id="principal" class="container crear-entrada">
        <div class="registro-box">
            <form action="./includes/models/editar-entrada.php?editar=<?= $entrada_actual['id'] ?>" method="POST">
                <div class="form-entrada-wrapper">
                    <div class="input-group">
                        <input type="text" name="titulo" id="titulo" value="<?= $entrada_actual['titulo'] ?>">
                        <label for="titulo">Titulo</label>
                        <?= isset($_SESSION['errores']) ? mostrarError($_SESSION['errores'], 'titulo') : '' ?>
                    </div>
                    <div class="input-group">
                        <textarea name="descripcion" id="descripcion" cols="30" rows="10">
                        <?= $entrada_actual['descripcion'] ?>
                        </textarea>
                        <label for="descripcion">Descripcion</label>
                        <?= isset($_SESSION['errores']) ? mostrarError($_SESSION['errores'], 'descripcion') : '' ?>
                    </div>
                    <div class="input-group">
                        <select name="selectCategoria" id="selectCategoria">
                            <option value="" disabled> Escoge una Categoria</option>
                            <?php
                            $categorias = obtenerCategorias($conexion);
                            if (!empty($categorias)) :
                                while ($categoria = mysqli_fetch_assoc($categorias)) :
                            ?>
                                    <option value="<?= $categoria['id'] ?>" <?= ($categoria['id'] == $entrada_actual['categoria_id']) ? 'selected' : '' ?>>
                                        <?= $categoria['descripcion'] ?>
                                    </option>
                            <?php
                                endwhile;
                            endif;
                            ?>
                        </select>
                        <?= isset($_SESSION['errores']) ? mostrarError($_SESSION['errores'], 'categoria') : '' ?>
                    </div>
                    <div class="input-group enviar">
                        <input type="submit" class="btn btn-primary" name="submit" value="Actualizar">
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
<?php require './includes/layouts/footer.php'; ?>