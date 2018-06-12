<?php

class Client extends Database {
    private $ID;
    private $nom;
    private $prenom;
    private $dateInscription;

    public function __construct($prenom, $nom, $dateInscription) {
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->dateInscription = $dateInscription;
    }

    public function __get($property) {
        switch($property) {
            case 'prenom' :
            return $this->prenom;
            break;
            case 'nom' :
            return $this->nom;
            break;
            case 'dateInscription' :
            return $this->dateInscription;
            break;
        }
    }
    public function create() {
        $row = [
            'prenom' => $this->prenom,
            'nom' => $this->nom,
            'dateInscription' => $this->dateInscription,
        ];
        $sql = 
            "INSERT INTO clients SET 
            prenom=:prenom, 
            nom=:nom,
            dateInscription=:dateInscription;";
        $status = parent::$db->prepare($sql)->execute($row);
        if ($status) {
            $lastId = parent::$db->lastInsertId();
            $this->ID = $lastId;
        }
    }

    public function read(int $id) {        
        $stmt = parent::$db->prepare("SELECT * FROM clients WHERE ID = $id AND status=:status LIMIT 1");
        $stmt->execute([$column => $value, 'status' => $status]);
        return $stmt->fetch();
    }

    static function getIndex() {

        $req1 = parent::$db->prepare(
            "SELECT * FROM clients" 
        );
        $req1->execute();
        return $req1->fetchAll();
    }



    public function update($id, $arraycolumns) {
        // @TODO : extraire colonnes du tableau en entréé
    }
    public function delete($id) {
        // @TODO : extraire colonnes du tableau en entréé
    }
}