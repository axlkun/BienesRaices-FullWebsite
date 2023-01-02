<?php

namespace Model;

class Admin extends ActiveRecord{
    //Base de datos
    //protected y static indican que solo se pueden acceder a ellos en esta clase
    protected static $tabla = 'usuarios';
    protected static $columnasDB = ['idusuarios','email','password'];

    public $idusuarios;
    public $email;
    public $password;

    public function __construct($args = [])
    {
        //se crean cuando se instancia un objeto de esta clase
        $this->idusuarios = $args['idusuarios'] ?? null;
        $this->email = $args['email'] ?? '';
        $this->password = $args['password'] ?? '';
    }

    public function validar(){
        if(!$this->email){
            //el self:: indica que es estatico (no requiere instanciarse)
            self::$errores[] = 'El email es obligatorio';
        }
        if(!$this->password){
            self::$errores[] = 'El password es obligatorio';
        }

        return self::$errores;
    }

    public function existeUsuario(){
        //Revisar si un usuario existe
        $query = "SELECT * FROM " . self::$tabla . " WHERE email = '" . $this->email . "' LIMIT 1";

        $resultado = self::$db->query($query);

        //debuguear($resultado);
        if(!$resultado->num_rows){
            self::$errores[] = "El usuario no existe";
            return;
        }
        return $resultado;
    }

    public function comprobarPassword($resultado){
        $usuario = $resultado->fetch_object(); //resultado es una instancia de $db o de la base de datos tenemos acceso al metodo fetch_object el cual va a retornar lo que encuentre en la base de datos

        //debuguear($usuario); retorna el id, email y contraseña 

        $autenticado = password_verify($this->password,$usuario->password); //compara lo que registró el usuario con lo que esta en la base de datos y retorna true o false

        if(!$autenticado){
            self::$errores[] = 'La contraseña es incorrecta';
        }
        return $autenticado;
    }

    public function autenticar(){
        session_start();

        //llenar el arreglo de sesion
        $_SESSION['usuario'] = $this->email;
        $_SESSION['login'] = true;

        header('Location: /admin');
    }
}

?>