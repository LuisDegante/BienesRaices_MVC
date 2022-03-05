<div class="contenedor-anuncios" data-cy="contenedor-anuncios">
    <?php foreach ($propiedades as $propiedad) :?>

    <div class="anuncio">
        <div class="contenido-anuncio">
            <img loading="lazy" src="/imagenes/<?php echo $propiedad->imagen; ?>" alt="Imagen Anuncio">    
            <h3><?php echo $propiedad->titulo; ?></h3>
            <p><?php echo $propiedad->descripcion; ?></p>
            <p class="precio">$ <?php echo $propiedad->precio; ?></p>
        </div>
        <div class="contenido-anuncio">
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
            <a data-cy="enlace-propiedad" class="boton-amarillo-block" href="propiedad?id=<?php echo $propiedad->id; ?>">Ver Propiedad</a>
        </div>
    </div>
    
    <?php endforeach; ?>
</div>