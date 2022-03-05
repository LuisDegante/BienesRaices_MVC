<main class="contenedor seccion contenido-centrado">
        <h1 data-cy="iniciar-sesion">Iniciar Sesión</h1>
        <?php foreach ($errores as $error): ?>
            <div data-cy="alerta-error" class="alerta error">
                <?php echo $error; ?>
            </div>
        <?php endforeach; ?>

        <form data-cy="formulario-login" method="POST" action="/login" class="formulario">
            <fieldset>
                <legend>Usuario y Contraseña</legend>

                <label for="email">Correo Electrónico: </label>
                <input data-cy="login-email" type="email" placeholder="Ej. usuario@dominio.com" id="email" name="email">

                <label for="password">Contraseña: </label>
                <input data-cy="login-password" type="password" placeholder="Tu Contraseña" id="password" name="password">

            </fieldset>
            <div class="alinear-derecha">
                <input type="submit" value="Iniciar Sesión" class="boton boton-verde">
            </div>
        </form>
    </main>