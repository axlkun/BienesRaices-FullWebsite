<main class="contenedor seccion">
        <h1>Más sobre nosotros</h1>

        <?php include 'iconos.php' ?>
    </main>

    <section class="seccion contenedor">
        <h2>Casas y departamentos en venta</h2>

        <?php
            
            include 'listado.php'
        ?>

        <div class="alinear-derecha">
            <a href="/propiedades" class="boton-verde">Ver todas</a>
        </div>
    </section>

    <section class="imagen-contacto">
        <h2>Encuentra la casa de tus sueños</h2>
        <p>Llena el formulario de contacto y un asesor se comunicará contigo a la brevedad</p>
        <a href="/contacto" class="boton-amarillo">Contactános</a>
    </section>

    <div class="contenedor seccion seccion-inferior">
        <section class="blog">
            <h3>Nuestro blog</h3> <!--cuando el primer hijo sea un heading (h1,h2,h3) el padre debe ser un section-->

            <?php include 'articulo.php'; ?>
        </section>

        <section class="testimoniales">
            <h3>Testimoniales</h3>

            <div class="testimonial">
                <blockquote> <!--etiqueta para testimoniales-->
                    El personal se comportó de una excelente forma, muy buena atención y la casa que me ofrecieron cumple con todas mis expectativas.
                </blockquote>
                <p>- Axel Cruz</p>
            </div>
        </section>

    </div>