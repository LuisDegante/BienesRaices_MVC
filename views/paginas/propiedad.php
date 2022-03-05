<main class="contenedor seccion contenido-centrado">
    <h1 data-cy="titulo-propiedad"><?php echo $propiedad->titulo; ?></h1>
    <img loading="lazy" src="/imagenes/<?php echo $propiedad->imagen; ?>" alt="Imagen Destacada" height="350px">
    <div class="resumen-propiedad">
        <p class="precio">$<?php echo $propiedad->precio; ?></p>
        <ul class="iconos-caracteristicas">
            <li>
                <img loading="lazy" src="build/img/icono_wc.svg" alt="Icono WC">
                <p><?php echo $propiedad->wc; ?></p>
            </li>
            <li>
                <img loading="lazy" src="build/img/icono_estacionamiento.svg" alt="Icono Estacionamiento">
                <p><?php echo $propiedad->estacionamiento; ?></p>
            </li>
            <li>
                <img loading="lazy" src="build/img/icono_dormitorio.svg" alt="Icono Dormitorio">
                <p><?php echo $propiedad->habitaciones; ?></p>
            </li>
        </ul>
        <p><?php echo $propiedad->descripcion; ?></p>
        <h4>Nombre del Vendedor(a):
            <?php if (!is_null($propiedad->vendedorId)) {
                echo $vendedor->nombre . " " . $vendedor->apellido;
            } else {
                echo "Sin Vendedor(a) Asignado(a)";
            }
            ?>
        </h4>

    </div>
    <a data-cy="regresar" class="boton-amarillo" href="/">Regresar</a>
</main>