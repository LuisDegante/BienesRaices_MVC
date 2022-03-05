<main class="contenedor seccion">
    <h2 data-cy="nosotros-sitio">¿Por Qué Con Nosotros?</h2>
    <?php include 'iconos-nosotros.php'?>
</main>

<section class="contenedor seccion">
    <h2 data-cy="casas-sitio">Casas y Departamentos en Venta</h2>

    <?php
        include 'listado.php';
    ?>

    <div class="alinear-derecha">
        <a data-cy="enlace-vertodos" href="/propiedades" class="boton boton-verde">Ver Todos</a>
    </div>
</section>

<section data-cy="contactanos-sitio" class="contacto">
    <h3>Encuentra la casa de tus sueños</h3>
    <p>Lllena el siguiente formulario y uno de nuestros asesores se contactará con usted a la brevedad</p>
    <a data-cy="enlace-contactanos" href="/contacto" class="boton-amarillo">Contáctanos</a>
</section>

<div class="contenedor seccion blogtestimoniales">
    <section data-cy="blog" class="blog">
        <h3>Nuestro Blog</h3>
        <article class="blog-entrada">
            <div class="entrada-imagen">
                <picture>
                    <source srcset="build/img/blog1.webp" type="image/webp">
                    <img loading="lazy" src="build/img/blog1.jpg" alt="Imagen Blog">
                </picture>
            </div>
            <div class="entrada-texto">
                <a href="/entrada-blog">
                    <h4>Terraza en el Techo de tu Casa</h4>
                    <p class="informacion-autor">Escrito el: <span>26/01/22</span> Por: <span>Luis Degante</span></p>
                    <p>Consejos para contruir una terraza en el techo de tu casa, con los mejores materiales y ahorrando mucho dinero.</p>
                </a>
            </div>
        </article>
        <article class="blog-entrada">
            <div class="entrada-imagen">
                <picture>
                    <source srcset="build/img/blog2.webp" type="image/webp">
                    <img loading="lazy" src="build/img/blog2.jpg" alt="Imagen Blog">
                </picture>
            </div>
            <div class="entrada-texto">
                <a href="/entrada-blog">
                    <h4>Guía para la Decoración de tu Casa</h4>
                    <p class="informacion-autor">Escrito el: <span>26/01/22</span> Por: <span>Luis Degante</span></p>
                    <p>Maximiza el espacio en tu hogar con esta guía, aprende a combinar colores y seleccionar los mejores muebles para darle vida a tu hogar.</p>
                </a>
            </div>
        </article>
        <div class="alinear-derecha">
            <a data-cy="enlace-blog" href="/blog" class="boton boton-verde boton-blog">Ver Todos</a>
        </div>
    </section>

    <section data-cy="testimoniales" class="testimoniales">
        <h3>Testimoniales</h3>
        <div class="testimonial">
            <blockquote>
                El personal se portó muy buena onda, muy buena la atención durante el proceso y la casa que me mostraron la verdad sí está bien buena para las fiestas con los amigos.
                Excelente Servicio
            </blockquote>
            <p>- José Ramírez</p>
        </div>
    </section>
</div>