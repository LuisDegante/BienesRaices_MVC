<main class="contenedor seccion">
    <h1 data-cy="titulo-admin">Administrador de Bienes Raíces</h1>
        <?php if(intval($delete) === 1): ?>
            <p class="alerta confirmacion">Eliminado Correctamente... Espere</p>
        <?php 
            $url = '/admin';
            $tiempo_espera = 2;
            header("refresh: $tiempo_espera; url= $url");   
            endif; 
        ?>

    <hr>
    <h2>Información Propiedades</h2>
    <a href="/propiedades/crear" class="boton boton-verde">Nueva Propiedad</a>
    <table class="propiedades">
        <thead>
            <tr>
                <th>ID</th>
                <th>Título de la Propiedad</th>
                <th>Fotografía</th>
                <th>Precio</th>
                <th>Acciones</th>
            </tr>
        </thead>

        <tbody> <!--Mostrando los resultados -->
            <?php  foreach($propiedades as $propiedad) : ?>
                <tr>
                    <td> <?php echo $propiedad->id; ?> </td>
                    <td> <?php echo $propiedad->titulo; ?> </td>
                    <td>
                        <div class="centrar-imagen">
                            <img src="/imagenes/<?php echo $propiedad->imagen; ?>" class="imagen-tabla"> 
                        </div> 
                    </td>
                    <td> $ <?php echo $propiedad->precio; ?>  </td>
                    <td>
                        <form method="POST" class="w-100" action="/propiedades/eliminar">
                            <input type="hidden" name="id" value="<?php echo $propiedad->id; ?>">
                            <input type="hidden" name="tipo" value="propiedad">
                            <input type="submit" value="Eliminar" class="boton-rojo-block">
                        </form>
                        <a href="/propiedades/actualizar?id=<?php echo $propiedad->id; ?>" class="boton-amarillo-block">Actualizar</a>
                    </td>
                </tr>
            <?php endforeach;?>
        </tbody>
    </table>

    <br><br><hr>
    <h2>Información Vendedores</h2>
    <a href="/vendedores/crear" class="boton boton-verde">Nuevo Vendedor</a>

    <table class="propiedades">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre Completo</th>
                <th>Teléfono</th>
                <th>Correo Electrónico</th>
                <th>Acciones</th>
            </tr>
        </thead>

        <tbody> <!--Mostrando los resultados -->
            <?php foreach($vendedores as $vendedor) :?>
                <tr>
                    <td> <?php echo $vendedor->id; ?> </td>
                    <td> <?php echo $vendedor->nombre . " " . $vendedor->apellido; ?> </td>
                    <td> <?php echo $vendedor->telefono; ?>  </td>
                    <td> <?php echo $vendedor->email; ?>  </td>
                    <td>
                        <form method="POST" class="w-100" action="/vendedores/eliminar">
                            <input type="hidden" name="id" value="<?php echo $vendedor->id; ?>">
                            <input type="hidden" name="tipo" value="vendedor">
                            <input type="submit" value="Eliminar" class="boton-rojo-block">
                        </form>
                        <a href="/vendedores/actualizar?id=<?php echo $vendedor->id; ?>" class="boton-amarillo-block">Actualizar</a>
                    </td>
                </tr>
            <?php endforeach;?>
        </tbody>
    </table>
    <!-- -->
    <br><br><hr>
    <h2>Información Blog</h2>
    <a href="/blog/crear" class="boton boton-verde">Nueva Entrada</a>

    <table class="propiedades">
        <thead>
            <tr>
                <th>ID</th>
                <th>Título</th>
                <th>Fecha De Creación</th>
                <th>Creador</th>
                <th>Acciones</th>
            </tr>
        </thead>
    </table>
</main>