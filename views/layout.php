<?php 

    if(!isset($_SESSION)) {
        session_start();
    }
    
    $auth = $_SESSION['login'] ?? null;
    // var_dump($auth);

    if(!isset($inicio)) {
        $inicio = false;
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Diseño Bienes Raíces</title>
    <link rel="stylesheet" href="../build/css/app.css">
</head>
<body>
    <header class="header <?php echo $inicio ? 'inicio' : '' ?>">
        <div class="contenedor contenido-header">
            <div class="barra">
                <a href="/">
                    <img src="/build/img/logo.svg" alt="Logo Bienes Raices">
                </a>
                <div class="hamburguesa">
                    <img src="/build/img/barras.svg" alt="Icono hamburguesa">
                </div>

                <div class="header-derecha">
                    <img class="boton-darkMode" src="/build/img/dark-mode.svg" alt="Icono Dark Mode">
                    <nav data-cy="navegacion-header" class="navegacion">
                        <?php if ($auth):  ?>
                            <a href="/propiedades">Previsualizar Propiedades</a>
                            <a href="/admin">Administrar</a>
                            <a href="/logout">Cerrar Sesión</a>
                        <?php endif;?>
                        <?php if (!$auth):  ?>
                            <a href="/sobre-nosotros">Sobre Nosotros</a>
                            <a href="/propiedades">Propiedades</a>
                            <a href="/blog">Blog</a>
                            <a href="/contacto">Contacto</a>
                            <a href="/login">Iniciar Sesión</a>
                        <?php endif;?>
                    </nav>
                </div>
            </div>
            <?php echo $inicio ? "<h1 data-cy='heading-sitio'>Venta de Casas y Departamentos Exclusivos De Lujo</h1>" : ''; ?>
        </div>
    </header>


    <?php echo $contenido; ?>



    <footer class="footer seccion">
        <div class="contenedor contenido-footer">
            <nav data-cy="navegacion-footer" class="navegacion">
                <?php if ($auth) :  ?>
                    <a href="/propiedades">Previsualizar Propiedades</a>
                    <a href="/admin">Administrar</a>
                    <a href="/logout">Cerrar Sesión</a>
                <?php endif; ?>
                <?php if (!$auth) :  ?>
                    <a href="/sobre-nosotros">Sobre Nosotros</a>
                    <a href="/propiedades">Propiedades</a>
                    <a href="/blog">Blog</a>
                    <a href="/contacto">Contacto</a>
                    <a href="/login">Iniciar Sesión</a>
                <?php endif; ?>
            </nav>
        </div>

        <p data-cy="copyright" class="copyright">&copy; Reservados Todos los Derechos - Por Luis Degante - <?php echo date('Y'); ?></p>
    </footer>


<script src="../build/js/bundle.js"></script>
</body>

</html>