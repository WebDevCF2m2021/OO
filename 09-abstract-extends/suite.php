<?php
// dépendances
require_once "config.php";
require_once "model/MyPDO.php";
require_once "model/Personnage/Personnage.php";
require_once "model/Personnage/PersonnageManager.php";
require_once "model/Personnage/PersonnageChild/Magicien.php";
require_once "model/Personnage/PersonnageChild/MagicienDeGlace.php";



// tentative de connexion à notre DB avec notre classe étendue de PDO : MyPDO
try {
    $connectMyPDO = new MyPDO(DB_TYPE . ':dbname=' . DB_NAME . ';host=' . DB_HOST . ';charset=' . DB_CHARSET . ';port=' . DB_PORT, DB_LOGIN, DB_PWD, null, PROD);
} catch (Exception $e) {
    die($e->getMessage());
}

$PersonnageManager = new PersonnageManager($connectMyPDO);
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

echo $PersonnageManager->insertPersonnage($Pierre);

$Luc = new MagicienDeGlace([
    'nom'=>'Luc',
    'theclassID'=>1]);

$PersonnageManager->insertPersonnage($Luc);

$Pierre->frapper($Luc,25);
echo "<hr>";
$Luc->frapper($Pierre);
echo "<hr>";
$Luc->frapper($Luc);

?><h3>Méthode statique</h3>
<p>Permet d'accéder à une méthode sans instancier la classe - Toujours publique</p>
<p>Mais elle doit exister et utiliser l'opérateur de résolution de portée (::) : var_dump(Personnage::dice()) depuis la classe parent :<br>
<?php var_dump(Personnage::dice());?></p>
<p>var_dump(Magicien::dice()) depuis une classe enfant<br>
    <?php var_dump(Magicien::dice());?></p>
<p>Non conseillé mais faisable, depuis une instance  (::) : var_dump($Pierre::dice(6,3))<br>
    <?php var_dump($Pierre::dice(6,3));?></p>
</body>
</html>