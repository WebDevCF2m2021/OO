<?php

namespace MyProject2\model\Personnage\PersonnageChild;

// Magicien est étendu de Personnage
use MyProject2\model\MagicienTrait;
use MyProject2\model\Personnage\Personnage;

class Magicien extends Personnage
{



    // Nos méthodes abstraites

    // abstraite venant d'un trait
    use MagicienTrait;

    // pour un magicien, on choisi l'initialisation
    protected function initialiser()
    {

        // force en prenant une classe statique (self::dice())
        $this->setForcePerso(self::dice(2)[0]);
        $this->setDegats(array_sum(self::dice(3,5)));
        $this->setNiveau(0);
        $this->setExperience(0);
        $this->setVie(self::VIE_DE_BASE - array_sum(self::dice(30,12)));
    }



    public function parer($autre)
    {
        // TODO: Implement parer() method.
    }

    public function esquiver($autre)
    {
        // TODO: Implement esquiver() method.
    }

    public function soigner($autre)
    {
        // TODO: Implement soigner() method.
    }

    protected function mourir($autre)
    {
        // TODO: Implement mourir() method.
    }

    protected function updateNiveau($autre)
    {
        // TODO: Implement updateNiveau() method.
    }

    protected function updateExperience($autre)
    {
        // TODO: Implement updateExperience() method.
    }

    protected function updateVie($autre)
    {
        // TODO: Implement updateVie() method.
    }

}