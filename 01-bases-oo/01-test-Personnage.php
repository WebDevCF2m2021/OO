<?php

require_once "Personnage.php";

$moi = new Personnage();

$toi = new Personnage();

$a = 5;
$b = $a;

$lui = $toi;

echo 'moi est une instance de Personnage (1er instance) :';

var_dump($moi);

echo 'toi est une instance de Personnage (2er instance) :';

var_dump($toi);
