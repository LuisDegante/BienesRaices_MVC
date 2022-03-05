<?php

define('TEMPLATES_URL',__DIR__.'/templates');
define('FUNCIONES_URL',__DIR__.'funciones.php');
define('CARPETA_IMAGENES',$_SERVER['DOCUMENT_ROOT'].'/imagenes/');

function incluirTemplate( string $nombre, bool $inicio = false ) {
    include TEMPLATES_URL . "/${nombre}.php";
}

function estaAutenticado() {
    session_start();

    if(!$_SESSION['login']) {
        header('Location: /');
    }
}

function vardumpFormateado($variable) {
    echo "<pre>";
        var_dump($variable);
    echo "</pre>";
    exit;
}

//Escapar / sanitizar el HTML
function sanitizar($html) : string {
    $sanitizado = htmlspecialchars($html);
    return $sanitizado;
}

//Validar tipo de contenido 
function validarTipoContenido($tipo) {
    $tipos = ['vendedor','propiedad'];
    return in_array($tipo,$tipos);
}

function validarORedireccionar(string $url) {
    //Validar que sea un ID Válido
    $id = $_GET['id'];
    // var_dump($id);
    $id = filter_var($id, FILTER_VALIDATE_INT);
    // var_dump($id);

    if (!$id) {
        header("Location: ${url}");
    }
    return $id;
}