<?php
// chargement des dépendances
require_once "config.php";
require_once "Mechant.php";
require_once "MechantManager.php";

// tentative de connexion à notre DB
try {
    $db = new PDO(DB_TYPE . ':dbname=' . DB_NAME . ';host=' . DB_HOST . ';charset=' . DB_CHARSET . ';port=' . DB_PORT, DB_LOGIN, DB_PWD);
} catch (Exception $e) {
    die($e->getMessage());
}

// Instanciation de notre manager avec la connexion PDO
$mechantManager = new MechantManager($db);



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
    "nameMechant"=>"cahit",
        "forceMechant"=>1,
        "experienceMechant"=>2,
        "statusMechant"=>3
]);

var_dump($cahit);
$balek = $mechantManager->SelectAllMechant();
var_dump($balek);


?><hr>

<h3>Insertion depuis un formulaire</h3>
<form action="" method="post" name="balek">

    <input name='nameMechant' type="text" placeholder="votre nom"><br>
    <input name='forceMechant' type="number" placeholder=forceMechant><br>
    <input name='experienceMechant' type="number" placeholder='experienceMechant'><br>
    <input name='statusMechant' type="number" placeholder='StatusMechant'><br>
    <input type="submit" value="créer le personnage">
</form>
<?php

// si on a envoyé le formulaire
if(!empty($_POST)){
    // instanciation des valeurs passée par le formulaire
    $insert = new Mechant($_POST);
    var_dump($insert);
    // insertion dans la DB
    echo $mechantManager->insertMechant($insert);

}

?>

<h3>Affichez tous les méchants !</h3>
</body>

</html>