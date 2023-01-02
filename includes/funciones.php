<?php

//require 'app.php';

// define('TEMPLATES_URL', __DIR__ . '/templates');
define('FUNCIONES_URL', __DIR__. 'funciones.php');
define('CARPETA_IMAGENES', $_SERVER['DOCUMENT_ROOT'] . '\imagenes\\');

// function incluirTemplate(string $nombre, bool $inicio = false ){
//     include TEMPLATES_URL . "/${nombre}.php";
// }

function estaAutenticado(){
    session_start();
    
    if(!$_SESSION['login']){
        header('Location: /index.php');
    }
}

function debuguear($variable){
    echo "<pre>";
    var_dump($variable);
    echo "</pre>";
    exit;
}

//Escapa / Sanitizar el HTML
function s($html) : string{
    $s = htmlspecialchars($html);
    return $s;
}

//Validar tipo de Contenido
function validarTipoContenido($tipo){
    $tipos = ['vendedor','propiedad'];

    return in_array($tipo,$tipos);
}

//Muestra las alertas
function mostrarNotificacion($codigo){
    $mensaje = '';

    switch($codigo){
        case 1: $mensaje='Registro creado correctamente'; break;
        case 2: $mensaje='Registro actualizado correctamente'; break;
        case 3: $mensaje='Registro eliminado correctamente'; break;
        default: $mensaje = false; break;
    }

    return $mensaje;
}

function validarId($url){
    $id = $_GET['id'];
    //$id = filter_var($id, FILTER_VALIDATE_INT);

    // Validamos que el ID por URL sea cualquier positivo entero
    if(!is_numeric($id)){               
        header("Location: ${url}");
    }
    // Validamos que el ID por URL no sea una letra o un string y validamos que sea un entero
    elseif(!is_string($id)){           
        $id = filter_var($id, FILTER_VALIDATE_INT);
    }
    return $id;
}