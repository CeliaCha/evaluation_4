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

    static function getIndex() {
        $req1 = parent::$db->prepare(
            "SELECT * FROM clients" 
        );
        $req1->execute();
        return $req1->fetchAll();
    }
}