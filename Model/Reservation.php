<?php
include_once('Database.php');

class Reservation extends Database {
    private $ID;
    private $clientId;
    private $chambreId;
    private $dateEntree;
    private $dateSortie;
    private $statut;

    public function __construct($clientId, $chambreId, $dateEntree, $dateSortie, $statut) {
        $this->clientId = $clientId;
        $this->chambreId = $chambreId;
        $this->dateEntree = $dateEntree;
        $this->dateSortie = $dateSortie;
        $this->statut = $statut;
    }

    public function __get($property) {
        switch($property) {
            case 'chambreId' :
            return $this->chambreId;
            break;
            case 'clientId' :
            return $this->clientId;
            break;
            case 'dateEntree' :
            return $this->dateEntree;
            break;
            case 'dateSortie' :
            return $this->dateSortie;
            break;
            case 'dateModification' :
            return $this->dateModification;
            break;
            case 'statut' :
            return $this->statut;
            break;
        }
    }

    static function getIndex() {
        $req = parent::$db->prepare(
            "SELECT reservations.id, clients.prenom AS clientprenom, clients.nom AS clientnom, chambres.nom AS chambrenom, chambres.numero AS chambrenum, dateEntree, dateSortie, reservations.statut, dateModification
            FROM reservations 
            INNER JOIN clients
            ON reservations.clientId = clients.id
            INNER JOIN chambres
            ON reservations.chambreId = chambres.id"
        );
        $req->execute();
        return $req->fetchAll();
    }

    static function read(int $id) {        
        $req = parent::$db->prepare("SELECT * FROM reservations WHERE id = $id");
        $req->execute();
        return $req->fetch();
    }

    public function add() {
        $row = [
            'chambreId' => $this->chambreId,
            'clientId' => $this->clientId,
            'dateEntree' => $this->dateEntree,
            'dateSortie' => $this->dateSortie,
            'statut' => $this->statut
        ];
        $sql = 
            "INSERT INTO reservations SET 
            chambreId=:chambreId, 
            clientId=:clientId,
            dateEntree=:dateEntree,
            dateSortie=:dateSortie,
            dateModification=now(),
            statut=:statut;";
        $status = parent::$db->prepare($sql)->execute($row);
        if ($status) {
            $lastId = parent::$db->lastInsertId();
            $this->ID = $lastId;
        }
    }

    public function edit(int $id) {
        $row = [
            'chambreId' => $this->chambreId,
            'clientId' => $this->clientId,
            'dateEntree' => $this->dateEntree,
            'dateSortie' => $this->dateSortie,
            'statut' => $this->statut
        ];
        $sql = "UPDATE reservations SET 
                chambreId=:chambreId, 
                clientId=:clientId,
                dateEntree=:dateEntree,
                dateSortie=:dateSortie,
                dateModification=now(),
                statut=:statut
                WHERE id=$id;";
        $status = parent::$db->prepare($sql)->execute($row);
    }

    static function delete(int $id) {
        $where = ['id' => $id];
        parent::$db->prepare("DELETE FROM reservations WHERE id=:id")->execute($where);
    }
}
