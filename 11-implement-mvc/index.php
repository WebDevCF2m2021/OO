<?php
// namespace non obligatoire car pas de correspondance avec un dossier
namespace MyProject;

// Appel de notre configuration (procédures avec constantes sans utilisation de son namespace, qui existe mais qui ne sera pas chargé par l'autoload)
require "MyProject/config.php";

// Autoload qui va chercher une classe via son nom et son namespace et la charger QUE si on l'utilise (par instanciation ou simplement par son nom (const ou static)
spl_autoload_register(function($class){
    include $class.".php";
});

// on indique qu'on va utiliser MyPDO se trouvant dans le namespace correspondant (namespace = dossiers)
use MyProject\model\MyPDO;
// les use pour nos différents PersonnageChild
use MyProject\model\Personnage\PersonnageChild\Guerrier;
use MyProject\model\Personnage\PersonnageChild\Magicien;
use MyProject\model\Personnage\PersonnageChild\MagicienDeGlace;

// tentative de connexion à notre DB avec notre classe étendue de PDO : MyPDO
try {
    // ! MyPDO se trouve dans le namespace
    $connectMyPDO = new MyPDO(DB_TYPE . ':dbname=' . DB_NAME . ';host=' . DB_HOST . ';charset=' . DB_CHARSET . ';port=' . DB_PORT, DB_LOGIN, DB_PWD, null, PROD);
} catch (Exception $e) {
    die($e->getMessage());
}

// ceci va fonctionner même sans instanciation de la classe "static"
echo "<h3>MyPDO::tellMyName()</h3><p>Affichage d'une méthode statique d'une classe non instanciée</p>Je suis un enfant de get_parent_class() et je suis get_class() OU Je suis un enfant de parent::class et je suis self::class Vont nous donner :<br><br>";
echo MyPDO::tellMyName();

echo "<h3>Création d'instances des 3 classes instanciables de type Personnage</h3>";
echo "<p>Guerrier : ";
$joueur1 = new Guerrier(["nom"=>"Manu"]);
var_dump($joueur1);
echo $joueur1->getNomAndLifeState();
echo "</p>";
echo "<p>Magicien : ";
$joueur2 = new Magicien(["nom"=>"Saber"]);
var_dump($joueur2);
echo $joueur2->getNomAndLifeState();
echo "</p>";
echo "<p>Magicien de Glace : ";
$joueur3 = new MagicienDeGlace(["nom"=>"Belgique"]);
var_dump($joueur3);
echo $joueur3->getNomAndLifeState();
echo "</p>";