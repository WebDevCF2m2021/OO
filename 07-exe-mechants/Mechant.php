<?php

use Traits\Hydrate;

class Mechant
{
    private int $idMechant;
    private string $nameMechant;
    private int $forceMechant;
    private int $experienceMechant;
    private bool $statusMechant;

    use Hydrate;

    public function __construct(array $datas)
    {
        if(!empty($datas))$this->hydrate($datas);
    }

    /**
     * @return int
     */
    public function getIdMechant() : int
    {
        return $this->idMechant;
    }

    /**
     * @return string
     */
    public function getNameMechant() : string
    {
        return $this->nameMechant;
    }

    /**
     * @param string $nameMechant
     *
     * @return Mechant
     */
    public function setNameMechant(string $nameMechant) : Mechant
    {
        $this->nameMechant = $nameMechant;
        return $this;
    }

    /**
     * @return int
     */
    public function getForceMechant() : int
    {
        return $this->forceMechant;
    }

    /**
     * @param int $forceMechant
     *
     * @return Mechant
     */
    public function setForceMechant(int $forceMechant) : Mechant
    {
        $this->forceMechant = $forceMechant;
        return $this;
    }

    /**
     * @return int
     */
    public function getExperienceMechant() : int
    {
        return $this->experienceMechant;
    }

    /**
     * @param int $experienceMechant
     *
     * @return Mechant
     */
    public function setExperienceMechant(int $experienceMechant) : Mechant
    {
        $this->experienceMechant = $experienceMechant;
        return $this;
    }

    /**
     * @return bool
     */
    public function getStatusMechant() : bool
    {
        return $this->statusMechant;
    }

    /**
     * @param bool $statusMechant
     *
     * @return Mechant
     */
    public function setStatusMechant(string $statusMechant) : Mechant
    {
        $this->statusMechant = $statusMechant === "true";
        return $this;
    }

}