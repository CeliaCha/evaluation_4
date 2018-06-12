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
    public function create() {
        $row = [
            'numero' => $this->numero,
            'nom' => $this->nom,
            'grilleTarifaire' => $this->grilleTarifaire,
            'statut' => $this->statut
        ];
        $sql = 
            "INSERT INTO chambres SET 
            numero=:numero, 
            nom=:nom,
            grilleTarifaire=:grilleTarifaire,
            statut=:statut;";
        $status = parent::$db->prepare($sql)->execute($row);
        if ($status) {
            $lastId = parent::$db->lastInsertId();
            $this->ID = $lastId;
        }
    }

    public function read(int $id) {        
        $stmt = parent::$db->prepare("SELECT * FROM chambres WHERE ID = $id AND status=:status LIMIT 1");
        $stmt->execute([$column => $value, 'status' => $status]);
        return $stmt->fetch();
    }

    static function getIndex() {
        $req1 = parent::$db->prepare(
            "SELECT * FROM chambres" 
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