<fieldset>
    <legend>Información General</legend>

    <label for="titulo">Título:</label>
    <input type="text" name="propiedad[titulo]" id="titulo" placeholder="Título de la Propiedad" value="<?php echo sanitizar($propiedad->titulo);?>">

    <label for="precio">Precio:</label>
    <input type="number" name="propiedad[precio]" id="precio" placeholder="Precio de la Propiedad" value="<?php echo sanitizar( $propiedad->precio);?>">

    <label for="imagen">Fotografía:</label>
    <input type="file" name="propiedad[imagen]" id="imagen" accept="image/jpeg, image/png">

    <?php if($propiedad->imagen) : ?>
        <img src="/imagenes/<?php echo $propiedad->imagen ?>" class="imagen-small">
    <?php endif; ?>

    <label for="descripcion">Descripción</label>
    <textarea id="descripcion" name="propiedad[descripcion]"><?php echo sanitizar($propiedad->descripcion);?></textarea>
</fieldset>

<fieldset>
    <legend>Información de la Propiedad</legend>

    <label for="habitaciones">N° Habitaciones:</label>
    <input type="number" min="1" max="9" id="habitaciones" name="propiedad[habitaciones]" placeholder="Ej. 3" value="<?php echo sanitizar($propiedad->habitaciones);?>">

    <label for="wc">N° Baños:</label>
    <input type="number" min="1" max="9" id="wc" name="propiedad[wc]" placeholder="Ej. 3" value="<?php echo sanitizar($propiedad->wc);?>">

    <label for="estacionamiento">N° Estacionamientos:</label>
    <input type="number" min="1" max="9" id="estacionamiento" name="propiedad[estacionamiento]" placeholder="Ej. 3" value="<?php echo sanitizar($propiedad->estacionamiento);?>">

</fieldset>

<fieldset>
    <legend>Vendedor</legend>
                    
    <label for="vendedor">Nombre del Vendedor (a) </label>
    <select name="propiedad[vendedorId]" id="vendedor">
        <option value="" selected>-- Selecciona Una Opción --</option>
            <?php foreach ($vendedores as $vendedor) : ?>
                <option 
                    <?php echo $propiedad->vendedorId === $vendedor->id ? 'selected' : ''; ?>
                    value="<?php echo sanitizar($vendedor->id); ?>"><?php echo sanitizar($vendedor->nombre) . " " . sanitizar($vendedor->apellido); ?></option>
                <?php endforeach; ?>    
    </select>
</fieldset>