<main class="contenedor seccion contenido-centrado">
    <h1 class="tituloMargin">Actualizar vendedor</h1>

        <?php foreach($errores as $error): ?>
            <div class="alerta error">
                <?php echo $error; ?>
            </div>
        <?php endforeach; ?> 

            <a href="/admin" class="boton boton-verde">Regresar</a>

    <form class="formulario" method="POST" enctype="multipart/form-data">
        <?php include __DIR__ . '/formulario.php'; ?>

        <input type="submit" value="Actualizar vendedor" class="boton boton-verde">
    </form>

</main>