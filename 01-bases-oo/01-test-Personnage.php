<?php

require_once "Personnage.php";

$moi = new Personnage();

$toi = new Personnage();

echo 'moi est une instance de Personnage (1er instance) :';

var_dump($moi);

echo 'toi est une instance de Personnage (2er instance) :';

var_dump($toi);

echo "<h4>Affichage d'attributs publics</h4>";
echo '<p>$moi->nom affiche ' . $moi->nom . '</p>';
echo '<p>$toi->nom affiche ' . $toi->nom . '</p>';

echo "<h4>L'Affichage d'attributs non publics n'est pas possible de la même manière</h4>";
