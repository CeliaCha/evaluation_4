<?php

class Chambre extends Database {
    private $ID;
    private $nom;
    private $numero;
    private $grilleTarifaire;
    private $statut;

    public function __construct($numero, $nom, $grilleTarifaire, $statut) {
        $this->nom = $nom;
        $this->numero = $numero;
        $this->grilleTarifaire = $grilleTarifaire;
        $this->statut = $statut;
    }

    public function __get($property) {
        switch($property) {
            case 'numero' :
            return $this->numero;
            break;
            case 'nom' :
            return $this->nom;
            break;
            case 'grilleTarifaire' :
            return $this->grilleTarifaire;
            break;
            case 'statut' :
            return $this->statut;
            break;
        }
    }
    static function getIndex() {
        $req1 = parent::$db->prepare(
            "SELECT * FROM chambres" 
        );
        $req1->execute();
        return $req1->fetchAll();
    }
}