<?php
spl_autoload_register(function($class){
    include_once  '10-final-namespace-autoload/'.$class . '.php';
});

$test = new \model\Personnage\PersonnageChild\Magicien([]);

var_dump($test);