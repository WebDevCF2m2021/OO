<?php
// mapping de la table mechant en PHP 8.0

class mechant
{
    // Attributs ou propriétés, en général toujours private (ou protected qu'on verra lors des extends) - À partir de PHP 7.4, on type nos attributs : https://www.php.net/manual/fr/migration74.new-features.php
    private int|null $idMechant; // le choix est possible autrement qu'avec ?int (int ou null en php 7)
    private string $nameMechant;
    private int $forceMechant;
    private int $experienceMechant;
    private int $statusMechant;



    // méthodes


    // constructeur - Appelé lors de l'instanciation
    public function __construct(array $tab)
    {
        // tentative d'hydration des données de Mechant
        $this->hydrate($tab);
    }

    // création de notre hydratation, en partant d'un tableau associatif et de ses clefs, on va régénérer le nom des setters existants
    private function hydrate(array $assoc){
        // tant qu'on a des éléments dans le tableau
        foreach($assoc as $clef => $valeur){
            // création du nom de la méthode
            echo $methodeName = "set".ucfirst($clef);
            // si la méthode existe
            if(method_exists($this,$methodeName)){
                $this->$methodeName($valeur);
                echo " ".$this->$clef."<br>";
            }else{
                echo " n'existe pas<br>";
            }
        }
    }

    /**
     * si on essaye d'afficher l'instance comme du texte
     * @return string
     */
    public function __toString(): string
    {
        return "Je suis une instance de " . $this->getNameMechant();
    }

    // Getters

    /**
     * @return int|null
     */
    public function getIdMechant(): int|null
    {
        return $this->idMechant;
    }

    /**
     * @return string
     */
    public function getNameMechant(): string
    {
        return $this->nameMechant;
    }

    /**
     * @return int
     */
    public function getForceMechant(): int
    {
        return $this->forceMechant;
    }

    /**
     * @return int
     */
    public function getExperienceMechant(): int
    {
        return $this->experienceMechant;
    }

    /**
     * @return int
     */
    public function getStatusMechant(): int
    {
        return $this->statusMechant;
    }



    // setters

    /**
     * @param int|null $idMechant
     * @return Mechant
     */
    public function setIdMechant(int|null $idMechant): Mechant
    {
        $this->idMechant = $idMechant;
        return $this;
    }


    /**
     * @param string $nameMechant
     * @return Mechant
     * Minimum 4 , maximum 60 caractères
     */
    public function setNameMechant(string $nameMechant): Mechant
    {
        $nom = strip_tags(trim($nameMechant));
        if (strlen($nameMechant) >= 3 && strlen($nameMechant) <= 60) {
            $this->nameMechant = htmlspecialchars($nom,ENT_QUOTES);
        } else {
            throw new Exception("Le nom doit être composé de 4 à 60 caractères");
        }

        return $this;
    }

    /**
     * @param int $forceMechant
     * @return Mechant
     */
    public function setForceMechant(int $forceMechant): Mechant
    {
        $this->forceMechant = $forceMechant;
        return $this;
    }

    /**
     * @param int $experienceMechant
     * @return Mechant
     */
    public function setExperienceMechant(int $experienceMechant): Mechant
    {
        $this->experienceMechant = $experienceMechant;
        return $this;
    }

    /**
     * @param int $statusMechant
     * @return Mechant
     */
    public function setStatusMechant(int $statusMechant): Mechant
    {
        $this->statusMechant = $statusMechant;
        return $this;
    }


}
