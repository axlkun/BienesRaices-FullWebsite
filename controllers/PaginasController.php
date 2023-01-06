<?php
namespace Controllers;
use MVC\Router;
use Model\Propiedad;
use Model\Blog;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;


class PaginasController{
    
    public static function index(Router $router){

        $propiedades = Propiedad::get(3);
        $blog = Blog::get(2);
        $inicio = true;

        $router->render('paginas/index',[
            'propiedades' => $propiedades,
            'blog' => $blog,
            'inicio' => $inicio
        ]);
    }
    public static function nosotros(Router $router){
        $router->render('/paginas/nosotros');
    }
    public static function propiedades(Router $router){

        $propiedades = Propiedad::all();

        $router->render('/paginas/propiedades',[
            'propiedades' => $propiedades
        ]);
    }
    public static function propiedad(Router $router){
        
        $id = validarId('/propiedades');

        $propiedad = Propiedad::find($id);

        $router->render('/paginas/propiedad',[
            'propiedad' => $propiedad
        ]);
    }
    public static function blog(Router $router){

        $blog = Blog::all();

        $router->render('/paginas/blog',[
            'blog' => $blog
        ]);
    }
    public static function entrada(Router $router){

        $id = validarId('/paginas/blog');
        $blog = Blog::find($id);

        $router->render('/paginas/entrada',[
            'blog' => $blog
        ]);
    }
    public static function contacto(Router $router){


        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            

            $respuestas = $_POST['contacto'];

            $mail = new PHPMailer(); //Crear una instancia de PHPMailer
            $mail->SMTPDebug = 2;
            //Configurar SMTP
            $mail->isSMTP();
            $mail->Host = 'smtp.mailtrap.io';
            $mail->SMTPAuth = true;
            $mail->Username = '2860ae3d72a655';
            $mail->Password = '279a21fb39131b';
            // $mail->SMTPSecure = 'tls';
            $mail->MAIL_ENCRYPTION= 'tls';
            $mail->Port = 2525;

            //Configurar el contenido del mail
            $mail->setFrom('bienesraices@correo.com'); //quien lo envia
            $mail->addAddress('bienesraices@correo.com', 'BienesRaices.com'); //quien lo recibe
            $mail->Subject = 'Tienes un nuevo mensaje';

            //Habilitar HTML
            $mail->isHTML(true);
            $mail->CharSet = 'UTF-8';


            //Definir el contenido
            $contenido = '<html>';
            $contenido .= '<p>Tienes un nuevo mensaje </p>';
            $contenido .= '<p>Nombre: ' . $respuestas['nombre'] . '</p>';
            
            //Enviar de forma condicional algunos campos de email o telefono

            if($respuestas['contacto'] === 'telefono'){
                $contenido .= '<p> Eligió ser contactado mediante telefono </p>';
                $contenido .= '<p>Telefono: ' . $respuestas['telefono'] . '</p>';
                $contenido .= '<p>Fecha: ' . $respuestas['fecha'] . '</p>';
                $contenido .= '<p>Hora: ' . $respuestas['hora'] . '</p>';
            }else{
                $contenido .= '<p> Eligió ser contactado mediante email </p>';
                $contenido .= '<p>E-mail: ' . $respuestas['email'] . '</p>';
            }

            $contenido .= '<p>Mensaje: ' . $respuestas['mensaje'] . '</p>';
            $contenido .= '<p>Vende / Compra: ' . $respuestas['tipo'] . '</p>';
            $contenido .= '<p>Precio / Presupuesto: $' . $respuestas['precio'] . '</p>';
            // $contenido .= '<p>Forma de contacto: ' . $respuestas['contacto'] . '</p>';
            $contenido .= '</html>';

            $mail->Body = $contenido;
            $mail->AltBody = 'Esto es texto alternativo sin html';
            //Enviar el mail
            if($mail->send()){
                // $mensaje = "Mensaje enviado correctamente";
                $_SESSION['mensajeExito'] = 'El mensaje se ha enviado correctamente';
            }else{
                // $mensaje = "El mensaje no se pudo enviar...";
                $_SESSION['mensajeError'] = 'No se ha podido enviar el mensaje';
            }
            
        }

        $router->render('/paginas/contacto',[
            
        ]);
    }

}


?>

