<?php

namespace Controllers;

use MVC\Router;
use Model\Vendedor;
use Model\ActiveRecord;

class VendedorController
{
    public static function crear(Router $router)
    {

        $vendedor = new Vendedor();
        $errores = Vendedor::getErrores();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            //Crear una nueva instancia
            $vendedor = new Vendedor($_POST['vendedor']);

            //Validar campos
            $errores = $vendedor->validar();

            if (empty($errores)) {
                $vendedor->guardar();
            }
        }

        $router->render('vendedores/crear', [
            'vendedor' => $vendedor,
            'errores' => $errores
        ]);
    }
    public static function actualizar(Router $router)
    {

        $id = validarId('/admin');

        $vendedor = Vendedor::find($id);

        $errores = Vendedor::getErrores();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            //Asignar los valores
            $args = $_POST['vendedor'];

            //Sincronizar objeto en memoria con lo que el usuario escribió
            $vendedor->sincronizar($args);

            //Validar
            $errores = $vendedor->validar();

            if (empty($errores)) {
                $vendedor->guardar();
            }
        }

        $router->render('vendedores/actualizar', [
            'vendedor' => $vendedor,
            'errores' => $errores
        ]);

    }
    public static function eliminar()
    {
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
       
            $id = $_POST['id'];
            $id = filter_var($id,FILTER_VALIDATE_INT);
    
            if($id){
    
                $tipo = $_POST['tipo'];
                
                if(validarTipoContenido($tipo)){
                    $vendedor = Vendedor::find($id);
                    $vendedor->eliminar();
                } 
            
            }
        }
    }
}
