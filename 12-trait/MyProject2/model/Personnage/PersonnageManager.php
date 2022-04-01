<?php
// espace de travail Personnage
namespace MyProject2\model\Personnage;
// utilisation de MyPDO qui ne se trouve pas dans le même espace de travail
use MyProject2\model\MyPDO;
use Exception;
// non utile si on utilise MyPDO, mais les bonnes pratiques préfèrent que l'on parte de la classe parent pour utiliser les constantes PDO::FETCH_ASSOC
use PDO;


// gestion de la table mappée Personnage
// use model\MyPDO;

class PersonnageManager
{
    // Attributs
    private MyPDO $connection;

    // Méthodes

    // constructeur
    /**
     * @param MyPDO $connection
     */
    public function __construct(MyPDO $connection)
    {
        $this->connection = $connection;
    }

    // insertion d'un Personnage
    public function insertPersonnage(Personnage $item): bool|int|string
    {
        // request
        $sql = "INSERT INTO `personnage`(`nom`, `forcePerso`, `degats`, `niveau`, `experience`, `vie`, `theclassID`) VALUES (?,?,?,?,?,?,?)";
        // requête préparée
        $prepare = $this->connection->prepare($sql);

        try{
            $prepare->execute([
                $item->getNom(),
                $item->getForcePerso(),
                $item->getDegats(),
                $item->getNiveau(),
                $item->getExperience(),
                $item->getVie(),
                $item->getTheclassID(),

            ]);
            return true;
        }catch(Exception $e){
            return $item->getNom()." Est déjà pris!";
        }

    }

    // ne fonctionne plus avec MyPDO
    public function SelectAllPersonnage(): array{
        $sql = "SELECT * FROM `personnage` ORDER BY `idPersonnage` ASC";
        $request = $this->connection->query($sql);
        return $request->fetchAll(PDO::FETCH_ASSOC);
    }

    // fonctionne avec MyPDO
    public function SelectAllMyPersonnage(): array{
        $sql = "SELECT * FROM `personnage` ORDER BY `idPersonnage` ASC";
        $request = $this->connection->prepare($sql);
        $request->execute();
        return $request->fetchAll(PDO::FETCH_ASSOC);
    }

    public function SelectPersonnage(int $id, string $name): array|string {
        $sql = "SELECT * FROM `personnage` WHERE `idPersonnage` = ? AND `nom` = ? ;";
        $prepare = $this->connection->prepare($sql);
        try {
            $prepare->execute([
                $id,
                $name,
            ]);
            return $prepare->fetch(PDO::FETCH_ASSOC);
        }catch(Exception $e){
            return $e->getMessage();
        }
    }
}