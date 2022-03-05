<?php

namespace MVC;

class Router {
    
    public $rutasGET = [];
    public $rutasPOST = [];

    public function metodoGet($url,$funcion) {
        $this->rutasGET[$url] = $funcion;
    }
    
    public function metodoPost($url,$funcion) {
        $this->rutasPOST[$url] = $funcion;
    }
    
    public function comprobarRutas() {

        session_start();
        $auth = $_SESSION['login'] ?? null;
        // vardumpFormateado($auth);

        //Arreglo de rutas protegidas
        $rutas_protegidas = ['/admin','/propiedades/crear','/propiedades/actualizar','/propiedades/eliminar','/vendedores/crear','/vendedores/actualizar','/vendedores/eliminar'];

        // vardumpFormateado($_SERVER);
        // $urlActual = $_SERVER['PATH_INFO'] ?? '/';
        $urlActual = ($_SERVER['REQUEST_URI'] === '') ? '/' : $_SERVER['REQUEST_URI'];
        // vardumpFormateado($urlActual);
        $metodo = $_SERVER['REQUEST_METHOD'];
        // vardumpFormateado($metodo);

        //Dividimos la URL actual cada vez que exista un ? que indica que se están pasando variables por la URL
        $splitURL = explode('?', $urlActual);
        // vardumpFormateado($splitURL);

        if($metodo === 'GET') {
            // echo "ES UN METODO GET";
            // vardumpFormateado($this->rutasGET);
            $funcion = $this->rutasGET[$splitURL[0]] ?? null; //splitURL[0] contiene la URL sin variables
            // vardumpFormateado($funcion);
        } else {
            $funcion = $this->rutasPOST[$splitURL[0]] ?? null;
        }
        // vardumpFormateado($funcion);

        //Proteger las rutas
        if(in_array($urlActual,$rutas_protegidas) && !$auth) {
            // echo "Es una ruta protegida";
            header('Location: /');
        }

        if($funcion) {
            //La URL existe, por tanto hay una funcion asociada
            // vardumpFormateado($funcion);
            // vardumpFormateado($this);
            call_user_func($funcion,$this);
        } else {
            echo "Página No Encontrada";
        }
    }

    //Muestra una vista
    public function render($view, $datos = []) {
        // echo "Desde el Render";
        
        foreach($datos as $key => $value) {
            $$key = $value;
        }


        ob_start();
        include_once __DIR__ . "/views/$view.php";

        $contenido = ob_get_clean(); //Limpiar memoria del server

        include_once __DIR__ . "/views/layout.php";
    }
}