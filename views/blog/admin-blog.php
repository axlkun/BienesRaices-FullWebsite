<main class="contenedor seccion">
    <div class="titulo">

        <h1>Administrador de Bienes Raices</h1>

        <a class="enlace" href="/admin">Propiedades/Vendedores</a>
    </div>

    <?php
    if ($resultado) {
        $mensaje = mostrarNotificacion(intval($resultado));
        if ($mensaje) { ?>
            <p class="alerta exito"> <?php echo s($mensaje) ?> </p>
    <?php }
    } ?>

    <div class="contenedor-padre">
        <div class="contenedor-btn">
            <a href="/blog/crear" class="boton boton-amarillo">Nuevo post</a>
        </div>
    </div>

    <h2>Articulos publicados</h2>
    <table class="propiedades">
        <thead>
            <tr>
                <th>ID</th>
                <th>Titulo</th>
                <th>Imagen</th>
                <th>Fecha</th>
                <th>Autor</th>
                <th>Acciones</th>
            </tr>
        </thead>

        <tbody>
            <!-- Mostrar los resultados -->
            <?php foreach ($blog as $blog) : ?>
                <tr>
                    <td data-titulo="ID"> <?php echo $blog->id; ?> </td>
                    <td data-titulo="Titulo"> <?php echo $blog->titulo; ?> </td>
                    <td data-titulo="Imagen"> <img src="/imagenes/<?php echo $blog->imagen; ?>" class="imagen-tabla" alt="imagen blog"> </td>
                    <td data-titulo="Fecha"><?php echo $blog->fecha; ?> </td>
                    <td data-titulo="Autor"><?php echo $blog->autor; ?> </td>
                    <td>
                        <div class="tabla-botones">
                            <form method="POST" action="/blog/eliminar">
                                <input type="hidden" name="id" value="<?php echo $blog->id; ?>">
                                <input type="hidden" name="tipo" value="blog">
                                <input type="submit" class="boton-rojo-block w-100" value="Eliminar" onclick="return ventanaEmergente()">
                            </form>

                            <a href="/blog/actualizar?id=<?php echo $blog->id; ?>" class="boton-amarillo-block">Actualizar</a>
                        </div>

                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</main>

<?php if (isset($_SESSION['mensaje'])) : ?>
    <script>
        swal({
            title: "Éxito",
            text: "<?php echo $_SESSION['mensaje']; ?>",
            icon: "success"
        });
    //     .then(function() {
    //     // Redirige al usuario a la página de administración
    //     window.location = "/admin";
    //   });
    </script>
    <?php unset($_SESSION['mensaje']); ?>
<?php endif; ?>