<?php

function conectarDB() : mysqli {
    // vardumpFormateado($_ENV);
    $db = new mysqli($_ENV['DB_HOST'],$_ENV['DB_USER'],$_ENV['DB_PASS'],$_ENV['DB_BD']);

    if(!$db) {
        echo "ERROR, No se pudo conectar";
        exit;
    }
    return $db;
}