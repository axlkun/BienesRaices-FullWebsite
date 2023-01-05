<?php
if (!isset($_SESSION)) {
    session_start();
}
$auth = $_SESSION['login'] ?? false;

if (!isset($inicio)) {
    $inicio = false;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienes Raices</title>
    <link rel="icon" href="../build/img/iconopestana.png">
    <link rel="stylesheet" href="../build/css/app.css">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body>
    <header class="header <?php echo $inicio ? 'inicio' : ''; ?>">
        <!-- con un if (operador ternario) evalua si la variable inicio es true para agregar la clase inicio al header y sino no agregarla ----- isset es una funcion que permite revisar si una variable esta definida-->
        <div class="contenedor contenido-header">
            <div class="barra">
                <a href="/">
                    <img src="/build/img/logo.svg" alt="Logotipo de Bienes raices">
                </a>

                <div class="mobile-menu">
                    <img src="/build/img/barras.svg" alt="icono menu responsive">
                </div>

                <div class="derecha">

                    <div class="dark-mode-boton">
                        <img id="drkmode" src="/build/img/dark-mode.svg" alt="boton dark mode">
                        <img id="lightmode" src="/build/img/sun.svg" alt="boton dark mode">
                    </div>

                    <nav class="navegacion">
                        <a href="/nosotros">Nosotros</a>
                        <a href="/propiedades">Anuncios</a>
                        <a href="/blog">Blog</a>
                        <a href="/contacto">Contacto</a>
                        <?php if ($auth) : ?>
                            <a href="/logout" class="logout">Cerrar sesión</a>
                        <?php endif ?>
                    </nav>
                </div>

            </div>
            <!--barra-->

            <!--titulo de la pagina que solo aparece en la pagina inicio-->
            <?php if ($inicio) : ?>
                <h1>Venta de Casas y Departamentos de lujo</h1>
            <?php endif; ?>

        </div>
    </header>

    <?php echo $contenido ?>

    <footer class="footer seccion">
        <div class="contenedor contenedor-footer">
            <nav class="navegacion">
                <a href="/nosotros.php">Nosotros</a>
                <a href="/anuncios.php">Anuncios</a>
                <a href="/blog.php">Blog</a>
                <a href="/contacto.php">Contacto</a>
            </nav>
        </div>

        <p class="copyright">Todos los derechos reservados <?php echo date('Y'); ?> &copy;</p>
    </footer>
    

    <!--modernizr sirve para saber si el navegador soporta webp-->
    <script src="../build/js/bundle.min.js"></script>

    <script>
    $(document).on('click', '.logout', function(e) {
        const href = $(this).attr('href');
        e.preventDefault();

        swal({
                title: "Aviso",
                text: "¿Cerrar sesión?",
                icon: "warning",
                buttons: {
                    cancel: 'Cancelar', // Modificamos el texto del botón "Cancel" a "Cancelar"
                    confirm: 'Salir'
                },
                dangerMode: true
            })
            .then((willDelete) => {
                if (willDelete) {
                    // Enviar el formulario de eliminación
                    document.location.href = href;
                }
            });
    });
</script>

    
</body>

</html>