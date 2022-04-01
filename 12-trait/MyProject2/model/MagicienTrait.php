<?php
namespace MyProject2\model;

use MyProject2\model\Personnage\Personnage;

trait MagicienTrait{

    public function frapper(Personnage $autre, $dd=5)
    {
        echo $this->getNom(). " lance une boule de feu de ".Personnage::dice()[0]." points de dégâts à ".$autre->getNom();
    }

}