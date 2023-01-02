<?php

namespace Controllers;

use MVC\Router;
use Model\Blog;
use Intervention\Image\ImageManagerStatic as Image;

class BlogController{
    public static function index(Router $router){
        $blog = Blog::all();
        $resultado = $_GET['resultado'] ?? null;

        $router->render('blog/admin-blog',[
            'blog' => $blog,
            'resultado' => $resultado
        ]);
    }

    public static function crear(Router $router){
        $blog = new Blog();
        $errores = Blog::getErrores();

        if($_SERVER['REQUEST_METHOD'] === 'POST'){

            $blog = new Blog($_POST['blog']);

            $carpetaImagenes = $_SERVER['DOCUMENT_ROOT'] . '\imagenes\\';

            if(!is_dir($carpetaImagenes)){
                mkdir($carpetaImagenes);
            }

            $nombreImagen = md5(uniqid(rand(), true)) . ".jpg";

            if($_FILES['blog']['tmp_name']['imagen']){
                $image = Image::make($_FILES['blog']['tmp_name']['imagen'])->fit(800,600);
                $blog->setImagen($nombreImagen);
            }

            $errores = $blog->validar();

            if(empty($errores)){

                if(!is_dir(CARPETA_IMAGENES)){
                    mkdir(CARPETA_IMAGENES);
                }

                $image->save($carpetaImagenes . $nombreImagen);

                $blog->guardar('/admin-blog');
            }
        }

        $router->render('blog/crear',[
            'blog' => $blog,
            'errores' => $errores
        ]);
    }

    public static function actualizar(Router $router){
        
        $id = validarId('/admin');
        $blog = Blog::find($id);
        $errores = Blog::getErrores();

        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            
            $args = $_POST['blog'];

            $blog->sincronizar($args);

            $errores = $blog->validar();

            $nombreImagen = md5(uniqid(rand(), true)) . ".jpg";

            if($_FILES['blog']['tmp_name']['imagen']){
                $image = Image::make($_FILES['blog']['tmp_name']['imagen'])->fit(800,600);
                $blog->setImagen($nombreImagen);
            }

            if(empty($errores)){

                if($_FILES['blog']['tmp_name']['imagen']){
                    $image->save(CARPETA_IMAGENES . $nombreImagen);
                }

                $blog->guardar('/admin-blog');
            }
        }

        $router->render('blog/actualizar',[
            'blog' => $blog,
            'errores' => $errores
        ]);
    }

    public static function eliminar(){
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $id = $_POST['id'];
            $id = filter_var($id,FILTER_VALIDATE_INT);

            if($id){
                $blog = Blog::find($id);
                $blog->eliminar('/admin-blog');
            }
        }
    }
}

?>