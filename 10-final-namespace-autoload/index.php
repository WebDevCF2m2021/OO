<?php
// dépendance obligatoire
require_once "config.php";

// Si on ne trouve pas une classe (instanciation new Personnage() ou la classe elle même  Personnage::class) on lance une fonction anonyme (closure) qui va chercher la classe via son namespace
spl_autoload_register(function ($class) {
    include_once  $class . '.php';
});

// utilisation d'un PersonnageManager spécifique
use model\Personnage\PersonnageManager;

/* Autant de dépendances que nécessaires
require_once "model/MyPDO.php";
require_once "model/Personnage/Personnage.php";
require_once "model/Personnage/PersonnageManager.php";
require_once "model/Personnage/PersonnageChild/Magicien.php";
*/

// tentative de connexion à notre DB avec notre classe étendue de PDO : MyPDO
try {
    // ! MyPDO se trouve dans le namespace
    $connectMyPDO = new \model\MyPDO(DB_TYPE . ':dbname=' . DB_NAME . ';host=' . DB_HOST . ';charset=' . DB_CHARSET . ';port=' . DB_PORT, DB_LOGIN, DB_PWD, null, PROD);
} catch (Exception $e) {
    die($e->getMessage());
}

// on va instancier le manager de Personnage avec notre instance de MyPDO
$PersonnageManager = new PersonnageManager($connectMyPDO);

var_dump(MagicienDeGlace::dice());

$Luc = new Magicien([]);
var_dump($Luc);

?>








