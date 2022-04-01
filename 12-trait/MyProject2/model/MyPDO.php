<?php
// création d'un namespace (souvent le nom du dossier, voir l'arborescence pour l'autoload)
namespace MyProject2\model;

// classe étendue de PDO, comme PHP ne va plus trouver PDO (qui se trouve à la racine du namespace) on met PDO à la racine (hors namespace en utilisant \PDO)
class MyPDO extends \PDO
{

    // surcharge du constructeur avec l'ajout de l'argument $production
    public function __construct(string $dsn,string|null $username,string|null $password,array|null $options, bool $production=true)
    {
        // chargement du constructeur parent (qui vient de PDO)
        parent::__construct($dsn, $username, $password, $options);

        // si nous sommes en production
        if($production){
            // nous désactivons l'affichage d'erreur
            $this->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_SILENT);
        }
    }

    // méthode static permettant d'afficher "je suis une enfant de PDO"
    public static function tellMyName(){
        return "Je suis un enfant de ".get_parent_class(). " et je suis ".get_class()."<br>Je suis un enfant de ".parent::class. " et je suis ".self::class."<br>";
    }

    // écrasement du query venant du parent (PDO)
    public function query($statement, $mode = PDO::ATTR_DEFAULT_FETCH_MODE, ...$fetch_mode_args) : Exception
    {
        // affichage de l'erreur
        throw new Exception("Query est désactivé dans MyPDO, veuillez utiliser une requête préparée");

    }


}