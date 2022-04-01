<?php
// espace de travail Personnage
namespace MyProject\model\Personnage;

// on a besoin de la classe native Exception
use Exception;
use MyProject\model\PersonnageInterface;

// mapping de la table personnage en PHP 8.0
// le abstract devant le nom de la classe empêche l'instanciation de celle-ci
abstract class Personnage implements PersonnageInterface
{
    // Attributs ou propriétés, en général toujours protected (ou private) - À partir de PHP 7.4, on type nos attributs : https://www.php.net/manual/fr/migration74.new-features.php
    protected int|null $idPersonnage; // le choix est possible autrement qu'avec ?int (int ou null en php 7)
    protected string $nom;
    protected int $forcePerso;
    protected float $degats;
    protected int $niveau;
    protected int $experience;
    protected int $vie;
    protected int|null $theclassID;

    // constantes Modificatrices de visibilité des constantes de classe, à partir de PHP 7.1 : https://www.php.net/manual/fr/language.oop5.constants.php
    public const VIE_DE_BASE = 1000;


    // méthodes venant de l'implement
    public function getNomAndLifeState():string
    {
        return "<p>Je suis {$this->getNom()} et je suis ".( self::VIVANT ? "vivant": "mort")."</p>";
    }


    // constructeur - Appelé lors de l'instanciation
    public function __construct(array $tab)
    {
        // tentative d'hydration des données de Personnage
        $this->hydrate($tab);

        // on va vérifier si c'est une nouvelle instanciation (Id est uninitialized ou null)
        if(!isset($this->idPersonnage)){
            // on initialise dans l'enfant car c'est une méthode abstraite dans une classe abstraite
            $this->initialiser();
        }

    }

    // création de notre hydratation, en partant d'un tableau associatif et de ses clefs, on va régénérer le nom des setters existants
    protected function hydrate(array $assoc){
        // tant qu'on a des éléments dans le tableau
        foreach($assoc as $clef => $valeur){
            // création du nom de la méthode
            $methodeName = "set".ucfirst($clef);
            // si la méthode existe
            if(method_exists($this,$methodeName)){
                $this->$methodeName($valeur);
            }
        }
    }

    /**
     * si on essaye d'afficher l'instance comme du texte
     * @return string
     */
    public  function __toString(): string
    {
        return "Je suis une instance de " . $this->getNom();
    }

    // Getters

    /**
     * @return int|null
     */
    public function getIdPersonnage(): int|null
    {
        return $this->idPersonnage;
    }

    /**
     * @return string
     */
    public function getNom(): string
    {
        return $this->nom;
    }

    /**
     * @return int
     */
    public function getForcePerso(): int
    {
        return $this->forcePerso;
    }

    /**
     * @return float
     */
    public function getDegats(): float
    {
        return $this->degats;
    }

    /**
     * @return int
     */
    public function getNiveau(): int
    {
        return $this->niveau;
    }

    /**
     * @return int
     */
    public function getExperience(): int
    {
        return $this->experience;
    }

    /**
     * @return int
     */
    public function getVie(): int
    {
        return $this->vie;
    }

    /**
     * @return int|null
     */
    public function getTheclassID(): ?int
    {
        return $this->theclassID;
    }





    // setters

    /**
     * @param int|null $idPersonnage
     * @return Personnage
     */
    public function setIdPersonnage(int|null $idPersonnage): Personnage
    {
        $this->idPersonnage = $idPersonnage;
        return $this;
    }

    /**
     * @param string $nom
     * @return Personnage
     * Minimum 4 , maximum 60 caractères
     * @throws Exception
     */
    public function setNom(string $nom): Personnage|Exception
    {
        $nom = strip_tags(trim($nom));
        if (strlen($nom) >= 2 && strlen($nom) <= 60) {
            $this->nom = htmlspecialchars($nom,ENT_QUOTES);
        } else {
            throw new Exception("Le nom doit être composé de 4 à 60 caractères");
        }

        return $this;
    }

    /**
     * @param int $forcePerso
     * @return Personnage
     */
    public function setForcePerso(int $forcePerso): Personnage
    {
        $this->forcePerso = $forcePerso;
        return $this;
    }

    /**
     * @param float $degats
     * @return Personnage
     */
    public function setDegats(float $degats): Personnage
    {
        $this->degats = $degats;
        return $this;
    }

    /**
     * @param int $niveau
     * @return Personnage
     */
    public function setNiveau(int $niveau): Personnage
    {
        $this->niveau = $niveau;
        return $this;
    }

    /**
     * @param int $experience
     * @return Personnage
     */
    public function setExperience(int $experience): Personnage
    {
        $this->experience = $experience;
        return $this;
    }

    /**
     * @param int $vie
     * @return Personnage
     */
    public function setVie(int $vie): Personnage
    {
        $this->vie = $vie;
        return $this;
    }

    /**
     * @param int|null $theclassID
     * @return Personnage
     */
    public function setTheclassID(?int $theclassID): Personnage
    {
        $this->theclassID = $theclassID;
        return $this;
    }

    // jet de dé statique (side = face et roll = nombre de jet)
    public static function dice(int $side = 20, int $roll = 1): array
    {
        for ($i = 0; $i < $roll; $i++) {
            $des[]=mt_rand(1, ($side));
        }
        return $des;
    }


    /*
     * Créations de méthodes abstraites, qui doivent être redéfinies pour être fonctionnelles dans les enfants !
     */

    abstract protected function initialiser();

    abstract public function frapper(Personnage $autre);

    abstract public function parer(Personnage $autre);

    abstract public function esquiver(Personnage $autre);

    abstract public function soigner(Personnage $autre);

    abstract protected function mourir($autre);

    abstract protected function updateNiveau($autre);

    abstract protected function updateExperience($autre);

    abstract protected function updateVie($autre);




}
