<main class="contenedor seccion contenido-centrado">
        <h1>Contacto</h1>

        <picture>
            <source srcset="build/img/destacada3.webp" type="
            image/webp">
            <source srcset="build/img/destacada3.jpg" type="image/jpeg">
            <img loading="lazy" src="build/img/destacada3.jpg" alt="Imagen contacto">
        </picture>

        <h2>Llene el formulario de contacto</h2>

        <form class="formulario" action="/contacto" method="POST">
            <fieldset>
                <legend>Informacion personal</legend>

                <label for="nombre">Nombre</label>
                <input type="text" placeholder="Tu nombre" id="nombre" name="contacto[nombre]" required>

                <!-- esta sintaxis indica que agrupa el valor recibido 'nombre' en el arreglo contacto -->

                <label for="mensaje">Mensaje</label>
                <textarea id="mensaje" name="contacto[mensaje]" required></textarea>
            </fieldset>

            <fieldset>
                <legend>Información sobre la propiedad</legend>

                <label for="opciones">Vende o compra:</label>
                <select id="opciones" name="contacto[tipo]" required>
                    <option value="" disabled selected>-- Seleccione una opción</option>
                    <option value="Compra">Compra</option>
                    <option value="Vende">Vende</option>
                </select>

                <label for="presupuesto">Precio o presupuesto</label>
                <input type="number" placeholder="Tu precio o presupuesto" id="presupuesto" name="contacto[precio]" >

            </fieldset>

            <fieldset>
                <legend>Contacto</legend>

                <p>Como desea ser contactado:</p>

                <div class="forma-contacto">

                <!-- el name debe de ser el mismo pero lo que define lo que se va a enviar a la base de datos es el value -->
                    <label for="contactar-telefono">Teléfono</label>
                    <input type="radio" value="telefono" id="contactar-telefono" name="contacto[contacto]" required>

                    <label for="contactar-email">E-mail</label>
                    <input type="radio" value="email" id="contactar-email" name="contacto[contacto]" required>
                </div>

                <div id="contacto">

                </div>

            </fieldset>

            <input type="submit" value="Enviar" class="boton-verde">
        </form>

    </main>

    <!-- <?//php if (isset($_SESSION['mensajeExito'])) : ?>
    <?//php unset($_SESSION['mensajeExito']); ?>
    <script>
        swal({
            title: "Éxito",
            text: "<?//php echo $_SESSION['mensajeExito']; ?>",
            icon: "success",
            button: "Aceptar",
        }).then((value) => {
            window.location.replace("/");
        });
    </script>
    
<?//php endif; ?>

<?//php if (isset($_SESSION['mensajeError'])) : ?>
    <?//php unset($_SESSION['mensajeError']); ?>
    <script>
        swal({
            title: "Error",
            text: "El mensaje no se ha podido enviar",
            icon: "warning",
            button: "Aceptar",
        }).then((value) => {
            window.location.replace("/contacto");
        });
    </script>
    
<?//php endif; ?> -->