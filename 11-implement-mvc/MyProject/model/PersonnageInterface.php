<?php
namespace MyProject\model;

interface PersonnageInterface{
    public const VIVANT = true;
    public function getNomAndLifeState();
}