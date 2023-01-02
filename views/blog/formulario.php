<fieldset>
    <legend>Redacción del post</legend>

    <label for="titulo">Título:</label>
    <input type="text" id="titulo" name="blog[titulo]" placeholder="Titulo del artículo" value="<?php echo s($blog->titulo); ?>">

    <label for="resumen">Resumen (Menos de 100 caracteres):</label>
    <textarea id="resumen" name="blog[resumen]"><?php echo s($blog->resumen); ?></textarea>

    <label for="imagen">Imagen:</label>
    <input type="file" id="imagen" accept="image/jpeg, image/png" name="blog[imagen]">

    <?php if ($blog->imagen) : ?>
        <img src="/imagenes/<?php echo $blog->imagen ?>" class="imagen-small">
    <?php endif; ?>

    <label for="descripcion">Articulo:</label>
    <textarea id="descripcion" name="blog[contenido]"><?php echo s($blog->contenido); ?></textarea>

</fieldset>

<fieldset>
    <legend>Informacion adicional</legend>

    <label for="autor">Autor:</label>
    <input type="text" id="autor" name="blog[autor]" placeholder="Nombre del autor" value="<?php echo s($blog->autor); ?>">
</fieldset>

