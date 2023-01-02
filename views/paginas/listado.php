<div class="contenedor-anuncios">
    <?php foreach($propiedades as $propiedad): ?>
    <div class="anuncio">
                
            <img loading="lazy" src="/imagenes/<?php echo $propiedad->imagen; ?>" alt="Imagen propiedad" class="img-anuncio">
                

                <div class="contenido-anuncio">
                    <h3><?php echo $propiedad->titulo; ?></h3>

                    <?php 
                    $cantidad=100;
                    $descripciones = $propiedad->descripcion; 
 
                    $descripcion = (strlen($descripciones)>$cantidad) ? substr($descripciones,0,$cantidad).'...' : $descripciones;?>

                    <div class="descripcion-tamaño">
                        <p > <?php echo $descripcion;?></p>
                    </div>
                    
                    <div class="precio-tamaño">
                        <p class="precio">$<?php echo $propiedad->precio; ?></p>
                    </div>
                    

                    <ul class="iconos-caracteristicas">
                        <li>
                            <img class="icono" loading="lazy" src="build/img/icono_wc.svg" alt="icono wc">
                            <p><?php echo $propiedad->wc; ?></p>
                        </li>
                        <li>
                            <img class="icono" loading="lazy" src="build/img/icono_estacionamiento.svg" alt="icono estacionamiento">
                            <p><?php echo $propiedad->estacionamiento; ?></p>
                        </li>
                        <li>
                            <img class="icono" loading="lazy" src="build/img/icono_dormitorio.svg" alt="icono habitaciones">
                            <p><?php echo $propiedad->habitaciones; ?></p>
                        </li>
                    </ul>

                    <a href="/propiedad?id=<?php echo $propiedad->id; ?>" class="boton-amarillo-block">Ver propiedad</a>

                </div> <!--contenido-anuncio--> 

    </div> <!--anuncio-->
    <?php endforeach; ?>
</div> <!--contenedor-anuncio-->