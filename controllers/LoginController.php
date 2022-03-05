<?php

namespace Controllers;

use MVC\Router;
use Model\Admin;

Class LoginController {
    public static function login(Router $router) {
        // echo "Desde Login";

        $errores = [];

        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            // echo "Autenticando...";
            $auth = new Admin($_POST);
            $errores = $auth->validar();

            if (empty($errores)) {
                //Verificar si el usuario existe
                $resultado = $auth->existeUsuario();

                if(!$resultado) {
                    //El usuario No Existe (mensaje de error)
                    $errores = Admin::getErrores();
                } else {
                    //Verificar que el password sea correcto
                    $autenticado = $auth->comprobarPassword($resultado);
                    if($autenticado) {
                        //Autenticar al usuario
                        $auth->autenticarUsuario();
                    } else {
                        //Password Incorrecto (mensaje de error)
                        $errores = Admin::getErrores();
                    }
                }
            }
        }

        $router->render('autenticacion/login',[
            'errores' => $errores
        ]);
    }

    public static function logout() {
        // echo "Desde Logout";
        session_start();
        // vardumpFormateado($_SESSION);
        $_SESSION = [];
        // vardumpFormateado($_SESSION);
        header('Location: /');
    }
}
