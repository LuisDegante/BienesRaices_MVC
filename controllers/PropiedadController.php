<?php

namespace Controllers;

use MVC\Router;
use Model\Propiedad;
use Model\Vendedor;
use Intervention\Image\ImageManagerStatic as Image;

class PropiedadController {
    public static function index(Router $router) {
        // vardumpFormateado($router);
        $propiedades = Propiedad::all();
        $vendedores = Vendedor::all();
        
        //Muestra mensaje condicional
        $delete = $_GET['delete'] ?? null;

        $router->render('propiedades/admin', [
            'propiedades' => $propiedades,
            'delete' => $delete,
            'vendedores' => $vendedores
        ]);

    }

    public static function crear(Router $router) {

        $propiedad = new Propiedad;
        $vendedores = Vendedor::all();
        //Arreglo con mensajes de errores o confirmacion
        $errores = Propiedad::getErrores();
        // vardumpFormateado($errores);
        $confirmacion = [];

        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            // vardumpFormateado($_POST);
    
            //Creando una nueva instancia
            // vardumpFormateado($_FILES['propiedad']);
            $propiedad = new Propiedad($_POST['propiedad']);
            // vardumpFormateado($propiedad);
    
            /** SUBIDA DE ARCHIVOS A UNA CARPETA **/
    
            //Generar un nombre único para imágenes
            $nombreImagen = md5( uniqid( rand(), true )) . '.jpg';
            // vardumpFormateado($nombreImagen);
    
            //Setear la imagen 
            //RELIZANDO UN RESIZE A LA IMAGEN CON INTERVENTION IMAGE
            if($_FILES['propiedad']['tmp_name']['imagen']) {
                $image = Image::make($_FILES['propiedad']['tmp_name']['imagen'])->fit(800,600);
                $propiedad->setImagen($nombreImagen);
                // vardumpFormateado($propiedad);
            }
    
            //Validando errores
            $errores = $propiedad->validar();
            // vardumpFormateado($errores);
            
            if(empty($errores)) {  
    
                //Crear la carpeta para subir imágenes
                if(!is_dir(CARPETA_IMAGENES)) {
                    mkdir(CARPETA_IMAGENES);
                }
    
                //Guarda la imagen en el servidor
                $image->save(CARPETA_IMAGENES . $nombreImagen);
    
                //Guarda en la base de datos
    
                $resultado = $propiedad->crear();
                // vardumpFormateado($resultado);
    
                if($resultado) {
                    //Imprimiendo el mensaje de confirmación
                    $confirmacion[] = "Propiedad Creada Exitosamente. Redirigiendo al Menú Principal...";
    
                    $url = '/admin';
                    $tiempo_espera = 3;
                    header("refresh: $tiempo_espera; url= $url");
                }
            }
        }

        $router->render('propiedades/crear',[
            'propiedad' => $propiedad,
            'vendedores' => $vendedores,
            'errores' => $errores,
            'confirmacion' => $confirmacion
        ]);
    }

    public static function actualizar(Router $router) {
        // echo "Actualizar Propiedad";
        $id = validarORedireccionar('/admin');
        $propiedad = Propiedad::find($id);
        $vendedores = Vendedor::all();

        $errores = Propiedad::getErrores();
        // vardumpFormateado($errores);
        $confirmacion = [];

        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            // vardumpFormateado($propiedad);
            // vardumpFormateado($_POST);
    
            //Asignar los atributos
            $args = $_POST['propiedad'];
    
            $propiedad->sincronizar($args);
            // vardumpFormateado($propiedad);
    
            //Validación de errores
            $errores = $propiedad->validar();
            
    
            if(empty($errores)) {
                //Subida de archivos
                //Setear la imagen 
                //RELIZANDO UN RESIZE A LA IMAGEN CON INTERVENTION IMAGE
                if($_FILES['propiedad']['tmp_name']['imagen']) {
                    //Generar un nombre único para imágenes
                    $nombreImagen = md5( uniqid( rand(), true )) . '.jpg';
                    $image = Image::make($_FILES['propiedad']['tmp_name']['imagen'])->fit(800,600);
                    $propiedad->setImagen($nombreImagen);
                    //Almacenar la imagen
                    $image->save(CARPETA_IMAGENES . $nombreImagen);
                }
    
                //Guardar en la base de Datos
                $resultado = $propiedad->actualizar();
                
    
                if($resultado) {
                    //Imprimiendo el mensaje de confirmación
                    $confirmacion[] = "Actualización Exitosa. Redirigiendo al Menú Principal...";
    
                    $url = '/admin';
                    $tiempo_espera = 3;
                    header("refresh: $tiempo_espera; url= $url");
                }
            }
        }

        $router->render('/propiedades/actualizar',[
            'propiedad' => $propiedad,
            'errores' => $errores,
            'confirmacion' => $confirmacion,
            'vendedores' => $vendedores
        ]);
    }

    public static function eliminar() {
        
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            // vardumpFormateado($_POST);
    
            //Validando que sea un ID válido|
            $id = $_POST['id'];
            $id = filter_var($id, FILTER_VALIDATE_INT);
            // var_dump($id);
    
            if($id) {
    
                $tipo = $_POST['tipo'];
                // vardumpFormateado($tipo);
                if(validarTipoContenido($tipo)) {
                    //Obteniendo los datos de la propiedad
                    $propiedad = Propiedad::find($id);
                    // vardumpFormateado($propiedad);
                    $propiedad->eliminar();
                }
            }
        }
    }
}
