<?php

require_once __DIR__ . '/../includes/app.php';

use Controllers\LoginController;
use MVC\Router;
use Controllers\PropiedadController;
use Controllers\VendedorController;
use Controllers\PaginasController;

$router = new Router();
// vardumpFormateado(PropiedadController::class);

//Zona Privada
//$router->metodoGet('/usuario',[LoginController::class,'usuario']);
$router->metodoGet('/admin',[PropiedadController::class, 'index']);

$router->metodoGet('/propiedades/crear',[PropiedadController::class,'crear']);
$router->metodoPost('/propiedades/crear',[PropiedadController::class,'crear']);
$router->metodoGet('/propiedades/actualizar',[PropiedadController::class,'actualizar']);
$router->metodoPost('/propiedades/actualizar',[PropiedadController::class,'actualizar']);
$router->metodoPost('/propiedades/eliminar',[PropiedadController::class,'eliminar']);

$router->metodoGet('/vendedores/crear',[VendedorController::class,'crear']);
$router->metodoPost('/vendedores/crear',[VendedorController::class,'crear']);
$router->metodoGet('/vendedores/actualizar',[VendedorController::class,'actualizar']);
$router->metodoPost('/vendedores/actualizar',[VendedorController::class,'actualizar']);
$router->metodoPost('/vendedores/eliminar',[VendedorController::class,'eliminar']);

//Login y Autenticación
$router->metodoGet('/login',[LoginController::class,'login']);
$router->metodoPost('/login',[LoginController::class,'login']);
$router->metodoGet('/logout',[LoginController::class,'logout']);


//Zona Pública
$router->metodoGet('/',[PaginasController::class,'index']);
$router->metodoGet('/sobre-nosotros',[PaginasController::class,'sobre_nosotros']);
$router->metodoGet('/propiedades',[PaginasController::class,'propiedades']);
$router->metodoGet('/propiedad',[PaginasController::class,'propiedad']);
$router->metodoGet('/blog',[PaginasController::class,'blog']);
$router->metodoGet('/entrada-blog',[PaginasController::class,'entrada_blog']);
$router->metodoGet('/contacto',[PaginasController::class,'contacto']);
$router->metodoPost('/contacto',[PaginasController::class,'contacto']);

$router->comprobarRutas();