<?php
namespace Controllers;

use MVC\Router;
use Model\Vendedor;

class VendedorController {
    public static function crear(Router $router) {
        // echo "Crear Vendedor";
        $vendedor = new Vendedor;
        //Arreglo con mensajes de errores o confirmacion
        $errores = Vendedor::getErrores();
        // vardumpFormateado($errores);
        $confirmacion = [];

        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            // vardumpFormateado($_POST['vendedor']);
    
            //Creando una nueva instancia de los vendedores
            $vendedor = new Vendedor($_POST['vendedor']);
            // vardumpFormateado($vendedor);
    
            //Validando errores
            $errores = $vendedor->validar();
    
            if(empty($errores)) {
                // vardumpFormateado($vendedor);
                if(is_null($vendedor->email)) {
                    // vardumpFormateado("EMAIL ESTA EN NULL");
                    $vendedor->email = "----------";
                } 
                if (is_null($vendedor->telefono)) {
                    // vardumpFormateado("TELEFONO ESTA EN NULL");
                    $vendedor->telefono = "----------";
                }
                // vardumpFormateado($vendedor);
                $resultado = $vendedor->crear();
    
                if($resultado) {
                    //Imprimiendo el mensaje de confirmación
                    $confirmacion[] = "Vendedor(a) Registrado Exitosamente. Redirigiendo al Menú Principal...";
    
                    $url = '/admin';
                    $tiempo_espera = 3;
                    header("refresh: $tiempo_espera; url= $url");
                }
            }
        }

        $router->render('vendedores/crear',[
            'vendedor' => $vendedor,
            'errores' => $errores,
            'confirmacion' => $confirmacion
        ]);
    }

    public static function actualizar(Router $router) {
        // echo "Actualizar Vendedor";

        //Arreglo con mensajes de errores o confirmacion
        $errores = Vendedor::getErrores();
        // vardumpFormateado($errores);
        $confirmacion = [];

        $id = validarORedireccionar('/admin');
        //Obtener los datos de los vendedores
        $vendedor = Vendedor::find($id);

        //Ejecutar el código después de que el usuario envie el formulario
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            // vardumpFormateado($_POST);

            //Asignar los atributos
            $args = $_POST['vendedor'];
            // vardumpFormateado($vendedor);

            // vardumpFormateado($_POST['vendedor']);

            //Sincronizando los datos con los que el usuario actualizó
            $vendedor->sincronizar($args);
            // vardumpFormateado($vendedor);

            //Validación de errores
            $errores = $vendedor->validar();

            if(empty($errores)) {
                // vardumpFormateado("No Hubieron errores");
                // vardumpFormateado($vendedor);
                if(is_null($vendedor->email)) {
                    // vardumpFormateado("EMAIL ESTA EN NULL");
                    $vendedor->email = "----------";
                } 
                if (is_null($vendedor->telefono)) {
                    // vardumpFormateado("TELEFONO ESTA EN NULL");
                    $vendedor->telefono = "----------";
                }
                // vardumpFormateado($vendedor);
                //Guardar en la base de Datos
                $resultado = $vendedor->actualizar();

                if($resultado) {
                    //Imprimiendo el mensaje de confirmación
                    $confirmacion[] = "Actualización Exitosa. Redirigiendo al Menú Principal...";
    
                    $url = '/admin';
                    $tiempo_espera = 3;
                    header("refresh: $tiempo_espera; url= $url");
                }
            }
        }
        $router->render('vendedores/actualizar', [
            'errores' => $errores,
            'vendedor' => $vendedor,
            'confirmacion' => $confirmacion
        ]);
    }
    public static function eliminar() {
        // echo "Eliminar Vendedor";
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
                    $vendedor = Vendedor::find($id);
                    // vardumpFormateado($propiedad);
                    $vendedor->eliminar();
                }
            }
        }
    }
}