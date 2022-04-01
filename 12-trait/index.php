<?php
// namespace non obligatoire car pas de correspondance avec un dossier
namespace MyProject2;

// Appel de notre configuration (procédures avec constantes sans utilisation de son namespace, qui existe mais qui ne sera pas chargé par l'autoload)
require "MyProject2/config.php";

// Autoload qui va chercher une classe via son nom et son namespace et la charger QUE si on l'utilise (par instanciation ou simplement par son nom (const ou static)
spl_autoload_register(function($class){
    include $class.".php";
});

// on indique qu'on va utiliser MyPDO se trouvant dans le namespace correspondant (namespace = dossiers)
use MyProject2\model\MyPDO;
// les use pour nos différents PersonnageChild
use MyProject2\model\Personnage\PersonnageChild\Guerrier;
use MyProject2\model\Personnage\PersonnageChild\Magicien;
use MyProject2\model\Personnage\PersonnageChild\MagicienDeGlace;

// tentative de connexion à notre DB avec notre classe étendue de PDO : MyPDO
try {
    // ! MyPDO se trouve dans le namespace
    $connectMyPDO = new MyPDO(DB_TYPE . ':dbname=' . DB_NAME . ';host=' . DB_HOST . ';charset=' . DB_CHARSET . ';port=' . DB_PORT, DB_LOGIN, DB_PWD, null, PROD);
} catch (Exception $e) {
    die($e->getMessage());
}

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Les traits</title>
</head>
<body>
<h1>Les traits</h1>
<p>Un trait permet de récupérer dans une classe les propriétés et méthodes, il ne peut être instancié, et s'écrite avec le mot clef trait</p>
<pre><code>
    trait HydrateTrait{

        public bool $traitHydrate = true;

        protected function hydrate(array $assoc){

            foreach($assoc as $clef => $valeur){

                $methodeName = "set".ucfirst($clef);

                if(method_exists($this,$methodeName)){
                    $this->$methodeName($valeur);
                }
            }
        }
    }
</code></pre>
<h3>Utilisation</h3>
<p>On peut l'utiliser avec un simple use à l'intérieur d'une classe (pas dans une interface)</p>
<pre><code>
    // chargement du trait
        use MyProject2\model\HydrateTrait;

    // classe, abstraite, finale ou normale
    abstract class Personnage implements PersonnageInterface{
        ....
        use HydrateTrait
        ....
        }
</code></pre>

<?php
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
$joueur1->frapper($joueur2);
echo "<br>";
$joueur2->frapper($joueur1);
?>
</body>
</html>

