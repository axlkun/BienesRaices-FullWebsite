<?php

namespace Controllers;
use MVC\Router;
use Model\Admin;

class LoginController{
    public static function login(Router $router){

        $errores = [];

        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            
            $auth = new Admin($_POST); //se crea una nueva instancia del objeto Admin con los datos almacenados en la variable POST
            //debuguear($auth);
            $errores = $auth->validar();

            if(empty($errores)){
                //verificar si el usuario existe
                $resultado = $auth->existeUsuario();

                if(!$resultado){
                    $errores = Admin::getErrores();
                }else{
                    //verificar que el password sea el del usuario
                    $autenticado = $auth->comprobarPassword($resultado);
                    
                    if($autenticado){
                        //autenticar al usuario
                        $auth->autenticar();
                    }else{
                        //password incorrecto
                        $errores = Admin::getErrores();
                    }
                }
                
            }

        }

        $router->render('/auth/login',[
            'errores' => $errores
        ]);
    }
    public static function logout(Router $router){
        session_start(); //debemos acceder a la sesion actual
        //debuguear($_SESSION); contiene el email y el login=true
        $_SESSION = []; //se reinicia la variable de sesion
        
        header('Location: /');
    }
}

?>