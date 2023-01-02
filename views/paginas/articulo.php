<?php foreach ($blog as $blog) : ?>
    <article class="entrada-blog">
        <!--cuando se tenga la entrada de un blog debe ir siempre en un article-->
        <div class="imagen">
            <img loading="lazy" src="/imagenes/<?php echo $blog->imagen; ?>" alt="Imagen blog">
        </div>

        <div class="texto-entrada">
            <a href="/entrada?id=<?php echo $blog->id; ?>">
                <h4><?php echo $blog->titulo ?></h4>
                <p class="informacion-meta">Escrito el: <span><?php echo $blog->fecha ?></span> por: <span><?php echo $blog->autor ?></span></p>

                <p><?php echo $blog->resumen ?></p>
            </a>
        </div>
    </article>
<?php endforeach; ?>