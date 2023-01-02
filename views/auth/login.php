<main class="contenedor seccion centrar-login">
        <h1>Inicio de sesión</h1>

        <?php foreach($errores as $error): ?>
            <div class="alerta error">
                <?php echo $error; ?>
            </div>
        <?php endforeach; ?>

        <form class="formulario" method="POST" enctype="multipart/form-data" action="/login">
            <fieldset>
                <legend>Credenciales</legend>

                <label for="email">E-mail:</label>
                <input type="email" id="email" name="email" placeholder="Ingresa tu correo">

                <label for="contraseña">Contraseña:</label>
                <input type="password" id="contraseña" name="password" placeholder="Ingresa tu contraseña">
            </fieldset>

            <div class="centrar-boton">
                <input type="submit" value="Ingresar" class="boton boton-verde">
                <!-- <a href="/inventario_ayuntamiento/registros.php" class="boton-rojo">Ingresar</a> -->
            </div>

            <div class="espacio">

            </div>
            
        </form>


    </main>