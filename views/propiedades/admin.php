<main class="contenedor seccion">

    <div class="titulo">

        <h1>Administrador de Bienes Raices</h1>

        <a class="enlace" href="/admin-blog">Blog</a>

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
            <a href="/propiedades/crear" class="boton boton-verde">Nueva propiedad</a>
            <a href="/vendedores/crear" class="boton boton-amarillo">Nuevo vendedor</a>
        </div>
    </div>


    <h2>Propiedades</h2>
    <table class="propiedades">
        <thead>
            <tr>
                <th>ID</th>
                <th>Titulo</th>
                <th>Imagen</th>
                <th>Precio</th>
                <th>Acciones</th>
            </tr>
        </thead>

        <tbody>
            <!-- Mostrar los resultados -->
            <?php foreach ($propiedades as $propiedad) : ?>
                <tr>
                    <td data-titulo="ID"> <?php echo $propiedad->id; ?> </td>
                    <td data-titulo="Titulo"> <?php echo $propiedad->titulo; ?> </td>
                    <td data-titulo="Imagen"> <img src="/imagenes/<?php echo $propiedad->imagen; ?>" class="imagen-tabla" alt="imagen propiedad"> </td>
                    <td data-titulo="Precio">$ <?php echo $propiedad->precio; ?> </td>
                    <td>
                        <div class="tabla-botones">
                            <form method="POST" action="/propiedades/eliminar">
                                <input type="hidden" name="id" value="<?php echo $propiedad->id; ?>">
                                <input type="hidden" name="tipo" value="propiedad">
                                <input type="submit" class="boton-rojo-block w-100" value="Eliminar" onclick="return ventanaEmergente()">
                            </form>

                            <a href="/propiedades/actualizar?id=<?php echo $propiedad->id; ?>" class="boton-amarillo-block">Actualizar</a>
                        </div>

                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <h2>Vendedores</h2>

    <table class="propiedades">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Telefono</th>
                <th>Acciones</th>
            </tr>
        </thead>

        <tbody>
            <!-- Mostrar los resultados -->
            <?php foreach ($vendedores as $vendedor) : ?>
                <tr>
                    <td data-titulo="ID"> <?php echo $vendedor->id; ?> </td>
                    <td data-titulo="Titulo"> <?php echo $vendedor->nombre . " " . $vendedor->apellido; ?> </td>

                    <td data-titulo="Precio"><?php echo $vendedor->telefono; ?> </td>
                    <td>
                        <div class="tabla-botones">
                            <form method="POST" action="/vendedores/eliminar">
                                <input type="hidden" name="id" value="<?php echo $vendedor->id; ?>">
                                <input type="hidden" name="tipo" value="vendedor">
                                <input type="submit" class="boton-rojo-block w-100" value="Eliminar" onclick="return ventanaEmergente()">
                            </form>

                            <a href="vendedores/actualizar?id=<?php echo $vendedor->id; ?>" class="boton-amarillo-block">Actualizar</a>
                        </div>

                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

</main>