<main class="contenedor seccion">
    <h1 data-cy="titulo-contacto">Contacto</h1>
    <?php foreach ($errores as $error): ?>
    <div class="alerta error">
        <?php echo $error; ?>
    </div>            
    <?php endforeach; ?>
    <?php foreach ($confirmacion as $confirm): ?>
        <div data-cy="alerta-confirmacion" class="alerta confirmacion">
        <?php echo $confirm; ?>
    </div>            
    <?php endforeach; ?>
    <picture>
        <source srcset="build/img/destacada3.webp" type="image/webp">
        <img loading="lazy" src="build/img/destacada3.jpg" alt="Imagen Contacto" height="250px">
    </picture>
    <h2 data-cy="titulo-formulario">Favor de Llenar el Siguiente Formulario</h2>
    <form data-cy="formulario-contacto" class="formulario" action="/contacto" method="POST">
        <fieldset>
            <legend>Información Personal</legend>

            <label for="nombre">Nombre Completo: </label>
            <input data-cy="input-nombre" type="text" placeholder="Tu Nombre Completo" id="nombre" name="contacto[nombre]" required>

            <label for="mensaje">Mensaje: </label>
            <textarea data-cy="input-mensaje" type="tel" placeholder="Ej. Requiero información sobre..." id="mensaje" name="contacto[mensaje]" required></textarea>
        </fieldset>

        <fieldset>
            <legend>Información sobre la Propiedad</legend>

            <label for="opciones">Vende o Compra: </label>
            <select data-cy="input-opciones" name="contacto[tipo]" id="opciones" required>
                <option disabled selected>--Selecciona Una Opción--</option>
                <option value="comprar">Compra</option>
                <option value="vender">Vende</option>
            </select>

            <label for="precio">Precio o Presupuesto:</label>
            <input data-cy="input-precio" type="number" id="precio" name="contacto[precio]" required>
        </fieldset>

        <fieldset>
            <legend>Medios de Contacto</legend>

            <p>¿Cómo desea ser contactado (a)?</p>
            <div class="forma-contacto">
                <label for="contactar-telefono">Teléfono</label>
                <input data-cy="forma-contacto" type="radio" value="telefono" id="contactar-telefono" name="contacto[contacto]" required>

                <label for="contactar-email">Correo Electrónico</label>
                <input data-cy="forma-contacto" type="radio" value="email" id="contactar-email" name="contacto[contacto]" required>
            </div>

            <div id="contacto"></div>

        </fieldset>

        <div class="alinear-derecha">
            <input type="submit" value="Enviar" class="boton-verde">
        </div>
    </form>
</main>