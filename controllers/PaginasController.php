<?php

namespace Controllers;

use MVC\Router;
use Model\Propiedad;
use Model\Vendedor;
use Intervention\Image\ImageManagerStatic as Image;
use PHPMailer\PHPMailer\PHPMailer;

class PaginasController {
    public static function index(Router $router) {
        // echo "Desde Index en Páginas Controller";

        $propiedades = Propiedad::getEspecifico(3);
        $inicio = true;

        $router->render('paginas/index',[
            'propiedades' => $propiedades,
            'inicio' => $inicio
        ]);
    }

    public static function sobre_nosotros(Router $router) {
        // echo "Desde Nosotros en Páginas Controller";

        $router->render('paginas/sobre-nosotros');
    }

    public static function propiedades(Router $router) {
        // echo "Desde Propiedades en Páginas Controller";

        $propiedades = Propiedad::all();

        $router->render('paginas/propiedades',[
            'propiedades' => $propiedades
        ]);

    }

    public static function propiedad(Router $router) {
        // echo "Desde Propiedad en Páginas Controller";

        //Verificando que sea un ID válido
        $id = validarORedireccionar('/propiedades');

        $propiedad = Propiedad::find($id);
        // vardumpFormateado($propiedad);

        $vendedor = Vendedor::all();
        if(!is_null($propiedad->vendedorId)) {
            $vendedor = Vendedor::find($propiedad->vendedorId);
        }

        $router->render('paginas/propiedad',[
            'propiedad' => $propiedad,
            'vendedor' => $vendedor
        ]);
    }

    public static function blog(Router $router) {
        // echo "Desde Blog en Páginas Controller";

        $router->render('paginas/blog');
    }

    public static function entrada_blog(Router $router) {
        // echo "Desde Entrada Blog en Páginas Controller";

        $router->render('paginas/entrada-blog');
    }

    public static function contacto(Router $router) {
        // echo "Desde Contacto en Páginas Controller";
        $confirmacion = [];
        $errores = [];

        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            // vardumpFormateado($_POST);
            $confirmacion = [];
            $errores = [];

            $respuestas = $_POST['contacto'];

            //Crear una instancia de PHP Mailer
            $mail = new PHPMailer();

            //Configurar SMTP
            $mail->isSMTP();
            $mail->Host = 'smtp.mailtrap.io';
            $mail->SMTPAuth = true;
            $mail->Username = 'c907de0e15e3bf';
            $mail->Password = '33bddfd1de98ab';
            $mail->SMTPSecure = 'tls';
            $mail->Port = 2525;

            //Configurar el contenido del EMAIL
            $mail->setFrom('admin@bienesraices.com');
            $mail->addAddress('admin@bienesraices.com','BienesRaices.com');
            $mail->Subject = 'Tienes un Nuevo Mensaje';

            //Habilitar HTML
            $mail->isHTML(true);
            $mail->CharSet = 'UTF-8';

            //Definir el Contenido
            $contenido = '<html>';
            $contenido .='<p>Hola! Mi Nombre es: ' . $respuestas['nombre'] . '</p>';
            $contenido .='<p>Soy una persona que está interesada en ' . $respuestas['tipo'] . ' una propiedad con un precio de $' . $respuestas['precio'] . '</p>';
            $contenido .='<p>Por lo cual: ' . $respuestas['mensaje'] . '</p>';
            if($respuestas['contacto'] === 'telefono') {
                $contenido .='<p>Y requiero que me sea contactado(a) por medio de: ' . $respuestas['contacto'] . '</p>';
                $contenido .='<p> El el siguiente número de teléfono que es: ' . $respuestas['telefono'] . '</p>';
                $contenido .='<p>En un Horario de: ' . $respuestas['hora'] . '</p>';
                $contenido .='<p>El día: ' . $respuestas['fecha'] . '</p>';
            } else {
                $contenido .='<p>Y requiero que me sea contactado(a) por medio de: ' . $respuestas['contacto'] . '</p>';
                $contenido .='<p>En el siguiente correo que es: ' . $respuestas['email'] . '</p>';
            }
            $contenido .= 'Sin más, agradezco su atención y quedo pendiente de su contacto.';
            $contenido .= '</html>';
            // vardumpFormateado($contenido);

            $mail->Body = $contenido;

            $mail->AltBody = 'Esto es Texto Alternativo sin HTML';

            //Enviar en EMAIL
            if($mail->send()) {
                // echo "Mensaje Enviado Correctamente";
                $confirmacion[] = "Formulario Enviado Exitosamente. Esté pendiente de su medio de contacto proporcionado...";
                    $url = '/';
                    $tiempo_espera = 5;
                    header("refresh: $tiempo_espera; url= $url");
            } else {
                // echo "El mensaje no se pudo enviar";
                $errores[] = "El Formulario no se envió correctamente. Intente Nuevamente";
                    $url = '/contacto';
                    $tiempo_espera = 3;
                    header("refresh: $tiempo_espera; url= $url");
            }
        }

        $router->render ('paginas/contacto',[
            'errores' => $errores,
            'confirmacion' => $confirmacion
        ]);
    }
}