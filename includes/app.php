<?php

require __DIR__ . '/../vendor/autoload.php';
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->safeLoad();

require 'funciones.php';
require 'database.php';

//Conectarnos a la BASE DE DATOS
$db = conectarDB();

use Model\ActiveRecord;
ActiveRecord::setDB($db);

