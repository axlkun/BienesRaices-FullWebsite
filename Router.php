<?php

namespace MVC;

class Router{

    public $rutasGET = [];
    public $rutasPOST = [];

    public function get($url, $fn){
        $this->rutasGET[$url] = $fn;
    }

    public function post($url, $fn){
        $this->rutasPOST[$url] = $fn;
    }

    public function comprobarRutas(){

        session_start();
        
        $auth = $_SESSION['login'] ?? null; //el valor es true si ya inicio sesion, sino es null
        
        //Arreglo de rutas protegidas
        $rutas_protegidas = ['/admin','/propiedades/crear','/propiedades/actualizar','/propiedades/eliminar','/vendedores/crear','/vendedores/actualizar','/vendedores/eliminar','/admin-blog','/blog/crear','/blog/actualizar','/blog/eliminar'];

        $urlActual = $_SERVER['PATH_INFO'] ?? '/'; //almacena la URL en la que se encuentra el usuario
        // debuguear($urlActual);
        $metodo = $_SERVER['REQUEST_METHOD']; //almacena si es GET o POST
        //debuguear($metodo);

        if($metodo === 'GET'){
            $fn = $this->rutasGET[$urlActual] ?? null;
           //debuguear($this->rutasGET[$urlActual]);
            //debuguear($this->rutasGET);
        }else{
            $fn = $this->rutasPOST[$urlActual] ?? null;
        }

        //Proteger las rutas
        if(in_array($urlActual,$rutas_protegidas) && !$auth){ //busca la url actual en el arreglo de rutas protegidas y retorna un bool
            header('Location: /');
        }

        if($fn){
            //La URL existe y hay una funcion asociada
            call_user_func($fn,$this); //call user func se usa para ejeuctar una funcion la cual no conozcamos su nombre, permitiendo hacer mas dinamico ya que en esta instruccion van a pasar muchas urls y diferentes funciones se ejecutaran, esto permite ejecutarlas sin definir el nombre exacto de cada una
            //debuguear($fn);

        }else{
            echo "Pagina no encontrada";
        }
        
    }

    //Muestra una vista
    public function render($view,$datos = []){
        foreach($datos as $key => $value){
            $$key = $value; //convertir la llave en variable, para acceder a su contenido, $$ -> variable de variable
        }
        ob_start(); //iniciar almacenamiento en memoria
        include __DIR__ . "/views/$view.php";
        $contenido = ob_get_clean(); //limpiamos memoria
        include __DIR__ . "/views/layout.php";
    }
}