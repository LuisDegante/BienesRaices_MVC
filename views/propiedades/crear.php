<main class="contenedor seccion">
    <h1>Crear Propiedad</h1>

    <a href="/admin" class="boton boton-verde">Regresar</a>

    <?php foreach ($errores as $error): ?>
        <div class="alerta error">
            <?php echo $error; ?>
        </div>            
    <?php endforeach; ?>

    <?php foreach ($confirmacion as $confirm): ?>
        <div class="alerta confirmacion">
            <?php echo $confirm; ?>
        </div>            
    <?php endforeach; ?>

    <form class="formulario" method="POST" enctype="multipart/form-data">
        <?php include __DIR__ . '/formulario.php'; ?>

        <div class="alinear-derecha">
                <input type="submit" value="Crear Propiedad" class="boton boton-verde">
        </div>
    </form>
</main>