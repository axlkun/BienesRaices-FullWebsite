<?php

require 'funciones.php';
require 'config/database.php';
require __DIR__ . '/../vendor/autoload.php';

//Conectarnos a la BDD
$db = conectarDB();
 
use Model\ActiveRecord;

//Se crea un nuevo objeto, pero no se vuelve a reescribir jamas, no requiere instancia por que el metodo, y el atributo al que hace referencia son staticos. Por lo tanto estos valores se mantienen estaticos
ActiveRecord::setDB($db);
