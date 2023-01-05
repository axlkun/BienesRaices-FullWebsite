<?php

namespace Controllers;

use MVC\Router;
use Model\Propiedad;
use Model\Vendedor;
use Intervention\Image\ImageManagerStatic as Image;

class PropiedadController
{

    //el parametro Router $router hace referencia a los valores actualmente almacenados en el objeto de la clase (si se instancia un nuevo objeto se pierde la info) en otras palabras se pasa el objeto creado en index.php a este archivo 
    //debido a que el metodo es static no se requiere instanciar al momento de llamarlo
    public static function index(Router $router)
    {
 
        $propiedades = Propiedad::all();
        $vendedores = Vendedor::all();
        $resultado = $_GET['resultado'] ?? null;

        $router->render('propiedades/admin', [
            'propiedades' =>  $propiedades,
            'resultado' => $resultado,
            'vendedores' => $vendedores
        ]);
    }

    public static function crear(Router $router)
    {

        //Creamos una nueva instancia de Propiedad y se la pasamos a la vista
        $propiedad = new Propiedad();
        $vendedores = Vendedor::all();
        $errores = Propiedad::getErrores();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            //debuguear(CARPETA_IMAGENES);
            //Instanciamos un objeto de la clase Propiedad en el cual almacenamos toda la informacion de Nueva Propiedad pasandole los atributos necesarios por post
            $propiedad = new Propiedad($_POST['propiedad']);

            //crear una carpeta
            $carpetaImagenes = $_SERVER['DOCUMENT_ROOT'] . '\imagenes\\';

            //si no esta creada la carpeta imagenes, crearla
            if (!is_dir($carpetaImagenes)) {
                mkdir($carpetaImagenes);
            }

            //generar nombre unico (este es el nombre d ela imagen)
            $nombreImagen = md5(uniqid(rand(), true)) . ".jpg"; //nombre unico y extension

            //en caso de que haya una imagen almacenada en la global files vamos a almacenarla en memoria 
            //Realiza un resize a la imagen con Intervention  (esta es la imagen)
            if ($_FILES['propiedad']['tmp_name']['imagen']) {
                $image = Image::make($_FILES['propiedad']['tmp_name']['imagen'])->fit(800, 600);
                $propiedad->setImagen($nombreImagen);
            }

            //Validar
            $errores = $propiedad->validar();

            //revisar que el arreglo de errores esté vacío
            if (empty($errores)) {

                //Crear la carpeta para subir imagenes
                if (!is_dir(CARPETA_IMAGENES)) {
                    mkdir(CARPETA_IMAGENES);
                }
                //Subida de archivos
                //Guarda la imagen en el servidor
                $image->save($carpetaImagenes . $nombreImagen);

                //Guarda en la base de datos
                $propiedad->guardar();
                $_SESSION['mensaje'] = 'La propiedad se ha creado correctamente';
            }
        }

        $router->render('propiedades/crear', [
            'propiedad' => $propiedad, //'propiedad' es la llave, por lo que para acceder a los datos se usa $propiedad
            'vendedores' => $vendedores,
            'errores' => $errores
        ]);
    }

    public static function actualizar(Router $router)
    {
       $id = validarId('/admin');

       $propiedad = Propiedad::find($id);
       $errores = $propiedad->validar();
       $vendedores = Vendedor::all();

       if($_SERVER['REQUEST_METHOD'] === 'POST'){

        //Asignar los atributos
        $args = $_POST['propiedad']; //lee todos los atributos del formulario gracias a la manera en que estos se llaman en sus name de sus input (propiedad[atributo])
        //debuguear($args);
       
        //Sincronizar los cambios con el objeto en memoria
        $propiedad->sincronizar($args);

        //Validacion
        $errores = $propiedad->validar();

        //Subida de archivos
        $nombreImagen = md5( uniqid( rand(), true)) . ".jpg";

        if($_FILES['propiedad']['tmp_name']['imagen']){
            $image = Image::make($_FILES['propiedad']['tmp_name']['imagen'])->fit(800,600);
            $propiedad->setImagen($nombreImagen);
        }
        
        //revisar que el arreglo de errores esté vacío
        if(empty($errores)){
            if($_FILES['propiedad']['tmp_name']['imagen']){
            //Guardar la imagen en BD
                if ($_FILES['propiedad']['tmp_name']['imagen']){
                    $image->save(CARPETA_IMAGENES . $nombreImagen);
                }
            }
            $propiedad->guardar();
            $_SESSION['mensaje'] = 'La propiedad se ha actualizado correctamente';
        }
        
    }

        $router->render('/propiedades/actualizar',[
            'propiedad' => $propiedad,
            'errores' => $errores,
            'vendedores' => $vendedores
        ]);
    }

    public static function eliminar(){
        
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
       
            $id = $_POST['id'];
            $id = filter_var($id,FILTER_VALIDATE_INT);
    
            if($id){
    
                $tipo = $_POST['tipo'];
                
                if(validarTipoContenido($tipo)){
                    $propiedad = Propiedad::find($id);
                    $propiedad->eliminar();
                    
                } 
            
            }
        }
    }

    
}
