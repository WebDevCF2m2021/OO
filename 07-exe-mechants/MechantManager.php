<?php

class MechantManager
{
    private PDO $pdo;

    public function __construct(PDO $pdo)
    {
        $this->setPdo($pdo);
    }

    /**
     * @param PDO $pdo
     *
     * @return MechantManager
     */
    public function setPdo(PDO $pdo) : MechantManager
    {
        $this->pdo = $pdo;
        return $this;
    }

    public function getMechants():array|string{
        $sql = "SELECT * from `mechant` ORDER BY `experienceMechant` ASC";
        $prepare = $this->pdo->prepare($sql);
        try{
            $prepare->execute();
            return $prepare->fetchAll(PDO::FETCH_ASSOC);
        }catch(Exception $e){
            return $e->getCode();
        }
    }

    public function insertMechant(Mechant $lui):bool|string{
        $sql = "INSERT INTO `mechant`( `nameMechant`, `forceMechant`, `experienceMechant`, `statusMechant`) VALUES (?,?,?,?)";
        $prepare = $this->pdo->prepare($sql);
        try{
            $prepare->bindValue(1,$lui->getNameMechant(),PDO::PARAM_STR);
            $prepare->bindValue(2,$lui->getForceMechant(),PDO::PARAM_INT);
            $prepare->bindValue(3,$lui->getExperienceMechant(),PDO::PARAM_INT);
            $prepare->bindValue(4,$lui->getStatusMechant(),PDO::PARAM_BOOL);
            return $prepare->execute();
        }catch(Exception $e){
           return $e->getMessage();
        }
    }

}