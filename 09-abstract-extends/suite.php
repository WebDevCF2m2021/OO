<?php
// dépendances
require_once "config.php";
require_once "model/MyPDO.php";
require_once "model/Personnage/Personnage.php";
require_once "model/Personnage/PersonnageManager.php";
require_once "model/Personnage/PersonnageChild/Magicien.php";

// tentative de connexion à notre DB avec notre classe étendue de PDO : MyPDO
try {
    $connectMyPDO = new MyPDO(DB_TYPE . ':dbname=' . DB_NAME . ';host=' . DB_HOST . ';charset=' . DB_CHARSET . ';port=' . DB_PORT, DB_LOGIN, DB_PWD, null, PROD);
} catch (Exception $e) {
    die($e->getMessage());
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Suite</title>
</head>
<body>
<a href="./">Accueil</a>
<h3>Magicien est étendu de Personnage</h3>
<p>Pour interdire l'instanciation de Personnage, on va utiliser le terme abstract</p>
<p>Une méthode statique ne doit pas être instanciée pour être appelée avec le nom de la classe et l'opérateur de la résolution de portée ::</p>
<?php
// Méthode statique non instanciée
//var_dump(Magicien::dice(6,5),Personnage::dice(roll:3));
$Pierre = new Magicien([
        'nom'=>'Pierre',
        'theclassID'=>1,
]);
var_dump($Pierre);
?>

</body>
</html>