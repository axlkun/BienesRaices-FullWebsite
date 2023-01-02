<?php

namespace Model;

class ActiveRecord{
   //Base de datos
   protected static $db;
   
   protected static $tabla = '';
   //este arreglo permite identificar que columnas tendran los registros
   protected static $columnasDB = [];
   //Errores
   protected static $errores = []; //estatico= no requerimos una nueva instancia, protected= solo esta clase puede modificarlo

    
 
   //definir la conexion a la BD
   public static function setDB($database){
      self::$db = $database;
   }

   public function guardar($ruta = '/admin'){
      if(!is_null($this->id)){
         //Actualizar
         $this->actualizar($ruta);
      }else{
         //Crear
         $this->crear($ruta);
      }
   }

   public function crear($ruta){
      //sanitizar los datos
      $atributos = $this->santizarAtributos();

      //join hace un string a partir de un arreglo, el ',' es para indicar una separacion entre cada elemento del array
      $llaves = join(', ',array_keys($atributos));
      $valores = join("', '",array_values($atributos));
      
      //Insertar en la base de datos
      $query = "INSERT INTO " . static::$tabla . " ( ";
      $query .= $llaves;
      $query .= " ) VALUES (' "; 
      $query .= $valores;
      $query .= " ')";

      //debuguear($query);
      
      //se hace referencia a la conexion del BD que ya instanciamos en app.php, se accede al metodo query (de la clase mysqli) y se le pasa la consulta
      $resultado = self::$db->query($query);

      if($resultado){
         
         //header("Location: {$ruta}?resultado=1");
         header("Location: {$ruta}");

     }
   }

   public function actualizar($ruta){
      $atributos = $this->santizarAtributos();

      $valores = [];

      //Llenar el array de valores con un formato parecido al de crear
      foreach($atributos as $key => $value){
         $valores[] = "{$key}='{$value}'";
      }

      $query = "UPDATE " . static::$tabla . " SET ";
      $query .= join(', ',$valores);
      $query .= " WHERE id = '" . self::$db->escape_string($this->id) . "' ";
      $query .= " LIMIT 1";

      $resultado = self::$db->query($query);

      if($resultado){
         
         header("Location: {$ruta}"); 
     }

   }

   //Eliminar 
   public function eliminar($ruta = '/admin'){
      //Elimina el registro
      $query = "DELETE FROM " . static::$tabla . " WHERE id = " . self::$db->escape_string($this->id) . " LIMIT 1" ;
      $resultado = self::$db->query($query);

      if($resultado){
         $this->eliminarImagen();
         header("Location: {$ruta}?resultado=3");
     }
   }

   //atributos hace una copia de los valores del objeto en memoria "propiedad/vendedores" registrado en "nueva propíedad"
   //esta funcion une los nombres columnasDB con su valor registrado en nueva propiedad
   public function atributos(){
      $atributos = [];

      foreach(static::$columnasDB as $columna){
         //ignora la columna id por que todavia no la tenemos (se genera automaticamente en la BDD)
         if($columna === 'id') continue;
         $atributos[$columna] = $this->$columna;
      }
      return $atributos;
   }

   public function santizarAtributos(){
      $atributos = $this->atributos();
      //arreglo donde se almacenaran los datos ya sanitizados los cuales se ingresarán a la base de datos
      $sanitizado = [];

      //key son las columnas de la BD
      //value es lo que el usuario escribió, o sea el valor de la columna
      //recorre el array atributos, leeyendo la key y su value para despues copiar esa informacion en el array sanitizado manteniendo el orden a traves de la key pero insertando los valores ya sanitizados gracias al metodo escape_string propio de la clase mysqli instanciada en el objeto $db, pasandole como parametro los valores registrados por el usuario almacenados en la variable $value 
      foreach($atributos as $key => $value){
         //escape_string escapa los ', es decir si se introduce un: wendy's house, reescribe: wendy\'s house
         $sanitizado[$key] = self::$db->escape_string($value);
      }
      return $sanitizado;
   }

   //Subida de imagen
   public function setImagen($imagen){

      //Si existe un id, quiere decir que no se encuentra en Nueva Propiedad sino en Actualizar propiedad
      if(!is_null($this->id)){
         //Comprobar si existe el archivo
         $this->eliminarImagen();
      }
      
      //Asignar al atributo de imagen el nombre de la imagen
      if($imagen){
         $this->imagen = $imagen;
      }
   }

   //Eliminar imagen
   public function eliminarImagen(){
      
      $existeArchivo = file_exists(CARPETA_IMAGENES . $this->imagen);
         
      //Si si existe, eliminarlo, por que esa imagen se cambio por otra 
      if($existeArchivo){
         unlink(CARPETA_IMAGENES . $this->imagen);
      }
   }

   //Validacion
   public static function getErrores(){
      
      return static::$errores;
   }

   public function validar(){
      static::$errores = []; //limpiar arreglo
      return static::$errores;
   }
     
   //Lista todas las propiedades / all()
   public static function all(){
      $query = "SELECT * FROM " . static::$tabla; //self busca en esta clase (ActiveRecord), static lo busca en la clase en la cual se esta herdando

      $resultado = self::consultarSQL($query);

      return $resultado;
   }

   //Obtiene determinado numero de registros
   public static function get($cantidad){
      $query = "SELECT * FROM " . static::$tabla . " LIMIT " . $cantidad; 
      
      $resultado = self::consultarSQL($query);

      return $resultado;
   }

   //Buscar un registro por id / find()
   public static function find($id){
      //Consultar para obtener los datos de la propiedad
      $query = "SELECT * FROM " . static::$tabla . " WHERE id = ${id}";
      $resultado = self::consultarSQL($query);
      return array_shift($resultado); //primer elemento de un array
   }

   public static function consultarSQL($query){
      //Consultar la base de datos
      $resultado = self::$db->query($query);

      //Iterar los resultados
      $array = [];
      //Retorna un arreglo asociativo, por eso llamamos una funcion que convierte ese registro en un objeto y se lo asigna al array, por lo tanto tendriamos un array de objetos
      while($registro = $resultado->fetch_assoc()){
         $array[] = static::crearObjeto($registro);
      }
     
      //Liberar la memoria
      $resultado->free();

      //Retornar los resultados
      return $array;
   }

   //Active record trabaja con Objetos no con arreglos, entonces convertimos el arreglo arrojado por al consulta a un objeto
   protected static function crearObjeto($registro){
      $objeto = new static; //Nuevo objeto de la clase heredada (vendedor/propiedad) de acuerdo a los atributos de su constructor

      foreach($registro as $key => $value){
         if(property_exists($objeto,$key)){ //detectar la $key y añadirle su $value
            $objeto->$key = $value;
         }
      }

      return $objeto;
   }

   //Sincroniza el objeto en memoria con los cambios realizados por el usuario (actualizar propiedad)
   public function sincronizar($args = []){
      //lee el arreglo asociativo del formulario mandado por POST y lo compara con el objeto de la clase, para asi reescribir los cambios en el objeto de acuerdo a los cambios en actualizar propiedad
      foreach($args as $key => $value){
         if(property_exists($this,$key) && !is_null($value)){
            $this->$key = $value;
         }
      }
   }
}