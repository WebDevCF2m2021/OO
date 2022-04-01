<?php
namespace MyProject2\model;

interface PersonnageInterface{
    public const VIVANT = true;
    public function getNomAndLifeState();
}