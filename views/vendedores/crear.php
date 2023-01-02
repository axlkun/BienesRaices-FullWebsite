<main class="contenedor seccion contenido-centrado">
    <h1 class="tituloMargin">Registrar vendedor</h1>

        <?php foreach($errores as $error): ?>
            <div class="alerta error">
                <?php echo $error; ?>
            </div>
        <?php endforeach; ?> 

            <a href="/admin" class="boton boton-verde">Regresar</a>

    <form class="formulario" method="POST" enctype="multipart/form-data">
        <?php include 'formulario.php'; ?>

        <input type="submit" value="Registrar vendedor" class="boton boton-verde">
    </form>

</main>

