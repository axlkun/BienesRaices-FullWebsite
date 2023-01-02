<?php

namespace Model;

class Blog extends ActiveRecord{
    protected static $tabla = 'blog';
    protected static $columnasDB = ['id','titulo','fecha','autor','resumen','contenido','imagen'];

    public $id;
    public $titulo;
    public $fecha;
    public $autor;
    public $resumen;
    public $contenido;
    public $imagen;

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->titulo = $args['titulo'] ?? '';
        $this->fecha = date('Y/m/d');
        $this->autor = $args['autor'] ?? '';
        $this->resumen = $args['resumen'] ?? '';
        $this->contenido = $args['contenido'] ?? '';
        $this->imagen = $args['imagen'] ?? '';
    }

    public function validar(){
        if(!$this->titulo){
            self::$errores[] = 'Debes añadir un titulo';
        }
        if(!$this->autor){
            self::$errores[] = 'Debes añadir el autor';
        }
        if(!$this->resumen){
            self::$errores[] = 'Debes añadir un resumen';
        }
        if(strlen($this->resumen) > 100){
            self::$errores[] = 'El resumen del articulo no debe tener mas de 100 caracteres';
        }
        if(!$this->contenido){
            self::$errores[] = 'Debes añadir el contenido';
        }
        if(!$this->imagen){
            self::$errores[] = 'Debes añadir una imagen';
        }

        return self::$errores;
    }

}

?>