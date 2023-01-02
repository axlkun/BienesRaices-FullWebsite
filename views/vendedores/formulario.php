<fieldset>
    <legend>Informacion general</legend>

    <label for="nombre">Nombre:</label>
    <input type="text" id="titulo" name="vendedor[nombre]" placeholder="Nombre del vendedor(a)" value="<?php echo s($vendedor->nombre); ?>">
    
    <label for="apellido">Apellido:</label>
    <input type="text" id="apellido" name="vendedor[apellido]" placeholder="Apellido del vendedor(a)" value="<?php echo s($vendedor->apellido); ?>">

</fieldset>

<fieldset>
    <legend>Informacion de contácto</legend>

    <label for="telefono">Teléfono:</label>
    <input type="tel" id="telefono" name="vendedor[telefono]" placeholder="Teléfono del vendedor(a)" value="<?php echo s($vendedor->telefono); ?>">
</fieldset>