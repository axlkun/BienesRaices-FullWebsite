<?php

namespace Model;
  
class Vendedor extends ActiveRecord{
    protected static $tabla = 'vendedores';

//este arreglo permite identificar que columnas tendran los registros
   protected static $columnasDB = ['id','nombre','apellido','telefono'];

   public $id;
   public $nombre;
   public $apellido;
   public $telefono;

   public function __construct($args = [])
   {

      $this->id = $args['id'] ?? null;
      $this->nombre = $args['nombre'] ?? '';
      $this->apellido = $args['apellido'] ?? '';
      $this->telefono = $args['telefono'] ?? '';
   }

   public function validar(){
      if(!$this->nombre){
         self::$errores[] = "Debes añadir el nombre";
     }
      if(!$this->apellido){
         self::$errores[] = "Debes añadir el apellido";
     }
      if(!$this->telefono){
         self::$errores[] = "Debes añadir el telefono";
     }else{
      if(!preg_match('/[0-9]{10}/',$this->telefono)){
         self::$errores[] = "Formato de telefono no válido";
        }
     }

     return self::$errores; //es lo mismo que Vendedor::$errores
   }

}