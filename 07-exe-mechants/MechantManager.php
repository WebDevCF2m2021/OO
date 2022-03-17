<?php

// gestion de la table mappée Personnage
class MechantManager
{
    // Attributs
    private PDO $connection;

    // Méthodes

    // constructeur
    /**
     * @param PDO $connection
     */
    public function __construct(PDO $connection)
    {
        $this->connection = $connection;
    }

    // insertion d'un Personnage
    public function insertMechant(Mechant $lui): bool|int
    {
        // request
        $sql = "INSERT INTO `mechant`(`nameMechant`, `forceMechant`,`experienceMechant`, `statusMechant`) VALUES (?,?,?,?)";
        // requête préparée
        $prepare = $this->connection->prepare($sql);

        try {
            $prepare->execute([
                $lui->getNameMechant(),
                $lui->getForceMechant(),
                $lui->getExperienceMechant(),
                $lui->getStatusMechant(),

            ]);
            return true;
        } catch (Exception $e) {
            return $e->getCode();
        }

    }

    public function SelectAllMechant(): array
    {
        $sql = "SELECT * FROM `mechant` ORDER BY `experienceMechant` ASC";
        $request = $this->connection->query($sql);
        return $request->fetchAll(PDO::FETCH_ASSOC);
    }


}