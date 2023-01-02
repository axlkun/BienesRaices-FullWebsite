            <fieldset>
                <legend>Informacion general</legend>

                <label for="titulo">Titulo:</label>
                <input type="text" id="titulo" name="propiedad[titulo]" placeholder="Titulo propiedad" value="<?php echo s($propiedad->titulo); ?>">

                <label for="precio">Precio:</label>
                <input type="number" id="precio" name="propiedad[precio]" placeholder="Precio propiedad" value="<?php echo s($propiedad->precio); ?>" min="1" max="9999999999">

                <label for="imagen">Imagen:</label>
                <input type="file" id="imagen" accept="image/jpeg, image/png" name="propiedad[imagen]">

                <?php if($propiedad->imagen): ?>
                     <img src="/imagenes/<?php echo $propiedad->imagen ?>" class="imagen-small">
                <?php endif; ?>

                <label for="descripcion">Descripcion:</label>
                <textarea id="descripcion" name="propiedad[descripcion]"><?php echo s($propiedad->descripcion); ?></textarea>

            </fieldset>

            <fieldset>
                <legend>Informacion propiedad</legend>

                <label for="habitaciones">Habitaciones:</label>
                <input type="number" id="habitaciones" name="propiedad[habitaciones]" placeholder="Numero de habitaciones" value="<?php echo s($propiedad->habitaciones); ?>" min="1">

                <label for="wc">Baños:</label>
                <input type="number" id="wc" name="propiedad[wc]" placeholder="Numero de baños" value="<?php echo s($propiedad->wc); ?>" min="1">

                <label for="estacionamiento">Estacionamiento:</label>
                <input type="number" id="estacionamiento" name="propiedad[estacionamiento]" placeholder="Numero de estacionamientos" value="<?php echo s($propiedad->estacionamiento); ?>" min="1">

            </fieldset>

            <fieldset>
                <legend>Vendedor</legend>
                
                <label for="vendedor">Nombre</label>
                <select name="propiedad[vendedores_id]" id="vendedor">
                    <option value="">Elige una opción</option>
                    <?php foreach($vendedores as $vendedor): ?>
                        <option 
                           <?php echo $propiedad->vendedores_id === $vendedor->id ? 'selected' : ''; ?>
                            value="<?php echo s($vendedor->id); ?>">
                            <?php echo s($vendedor->nombre) . " " . s($vendedor->apellido);  ?>
                        </option>
                    <?php endforeach; ?>    
                </select>
                
            </fieldset>