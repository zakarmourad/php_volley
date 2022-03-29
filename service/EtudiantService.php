<?php
include_once RACINE . '/classes/Etudiant.php';
include_once RACINE . '/connexion/Connexion.php';
include_once RACINE . '/dao/IDao.php';

class EtudiantService implements IDao
{
    private $connexion;
    function __construct()
    {
        $this->connexion = new Connexion();
    }

    public function create($o)
    {
        $query = "INSERT INTO Etudiant (`id`, `nom`, `prenom`, `ville`, `sexe`, `img`) VALUES (NULL, :nom, :prenom, :ville, :sexe, :img)";
        $req = $this->connexion->getConnexion()->prepare($query);
        $req->execute(array(
            "nom"=>$o->getNom(),
            "prenom"=>$o->getPrenom(),
            "ville"=>$o->getVille(),
            "sexe"=>$o->getSexe(),
            "img"=>$o->getImg()
        )) or die('Erreur SQL');
    }

    public function delete($o)
    {
        $query = "delete from Etudiant where id = :id";
        $req = $this->connexion->getConnexion()->prepare($query);
        $req->execute(array(
            "id"=>$o->getId()
        )) or die('Erreur SQL');
    }

    public function findAll()
    {
        $etds = array();
        $query = "select * from Etudiant";
        $req = $this->connexion->getConnexion()->prepare($query);
        $req->execute();
        while ($e = $req->fetch(PDO::FETCH_OBJ)) {
            $etds[] = new Etudiant($e->id, $e->nom, $e->prenom, $e->ville, $e->sexe, $e->img);
        }
        return $etds;
    }

    public function findById($id)
    {
        $query = "select * from Etudiant where id = :id";
        $req = $this->connexion->getConnexion()->prepare($query);
        $req->execute(array(
            "id"=>$id
        ));
        if ($e = $req->fetch(PDO::FETCH_OBJ)) {
            $etd = new Etudiant($e->id, $e->nom, $e->prenom, $e->ville, $e->sexe, $e->img);
        }
        return $etd;
    }

    public function update($o)
    {
        $query = "UPDATE `etudiant` SET `nom` = :nom, `prenom` = :prenom, `ville` = :ville, `sexe` = :sexe, `img` = :img WHERE `id` = :id";
        $req = $this->connexion->getConnexion()->prepare($query);
        $req->execute(array(
            "id"=>$o->getId(),
            "nom"=>$o->getNom(),
            "prenom"=>$o->getPrenom(),
            "ville"=>$o->getVille(),
            "sexe"=>$o->getSexe(),
            "img"=>$o->getImg()
        )) or die('Erreur SQL');
    }

    public function findAllApi()
    {
        $query = "select * from Etudiant";
        $req = $this->connexion->getConnexion()->prepare($query);
        $req->execute();
        return $req->fetchAll(PDO::FETCH_ASSOC);
    }
}
