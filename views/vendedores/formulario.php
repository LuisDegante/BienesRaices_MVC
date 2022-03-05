<fieldset>
    <legend>Información Personal</legend>

    <label for="nombre">Nombre(s):</label>
    <input type="text" name="vendedor[nombre]" id="nombre" placeholder="Nombre Vendedor(a) " value="<?php echo sanitizar($vendedor->nombre);?>">
    
    <label for="apellido">Apellido(s):</label>
    <input type="text" name="vendedor[apellido]" id="apellido" placeholder="Apellido(s) Vendedor(a) " value="<?php echo sanitizar($vendedor->apellido);?>">
</fieldset>

<fieldset>
    <legend>Medios de Contacto</legend>

    <label for="telefono">Teléfono (a 10 Dígitos):</label>
    <input type="tel" name="vendedor[telefono]" id="telefono" placeholder="Ej. 5512345678" value="<?php echo sanitizar($vendedor->telefono);?>">
    
    <label for="email">Correo Electrónico:</label>
    <input type="email" name="vendedor[email]" id="email" placeholder="Ej. usuario@dominio.com" value="<?php echo sanitizar($vendedor->email);?>">
</fieldset>