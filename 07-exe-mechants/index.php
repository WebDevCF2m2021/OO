<?php
// chargement des dépendances
require_once "./config.php";
require_once "./Traits/Hydrate.php";
require_once "./Mechant.php";
require_once "./MechantManager.php";

// tentative de connexion à notre DB
try {
    $db = new PDO(DB_TYPE . ':dbname=' . DB_NAME . ';host=' . DB_HOST . ';charset=' . DB_CHARSET . ';port=' . DB_PORT, DB_LOGIN, DB_PWD);
} catch (Exception $e) {
    die($e->getMessage());
}

// Instanciation de notre manager avec la connexion PDO
$mechantManager = new MechantManager($db);
if(!empty($_POST)){
    if($mechantManager->insertMechant(new Mechant($_POST))===true){
        echo "Insertion done!";
    }else{
        echo "Insertion failed!";
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
<?php
$cahit = new Mechant([
        "lulu"=>"lala",
        "youpiCaBoum"=>"yes",
        "slup"=>25.25,
        "vie"=>5,
        25=>"jkhjih",
        "nom"=>"pause",
]);

var_dump($cahit);



?><hr>
<?php

?>
<h3>Insertion depuis un formulaire dans Mechant</h3>
<form action="" method="post" name="balek">
    <input name="nameMechant" type="text" placeholder="Nom du méchant"><br/>
    <input name="forceMechant" type="number" placeholder="Force du méchant"><br/>
    <input name="experienceMechant" type="number" placeholder="expérience du Méchant"><br/>
    <input name="statusMechant" id="statusTrue" type="radio" value="true" checked><label for="statusTrue">Actif</label><br/>
    <input name="statusMechant" id="statusFalse" type="radio" value="false"><label for="statusFalse">Inactif</label><br/>
    <input type="submit" value="Créer ce méchant">
</form>

<h3>Affichez tous les méchants !</h3>

<?php
forEach($mechantManager->getMechants() as $mechant){
    ?>
    <p>Je suis le super méchant <?=$mechant["nameMechant"]?> avec <?= $mechant["experienceMechant"]?> d'expérience.</p>
    <p>J'ai <?=$mechant["forceMechant"]?> de force et je suis actuellement <?= $mechant["statusMechant"]?"actif":"inactif" ?></p>
    <hr/>
<?php
}
?>
</body>

</html>