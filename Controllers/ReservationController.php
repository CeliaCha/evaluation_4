<?php

include_once('./Model/Reservation.php');

class ReservationController extends Reservation {
    private $ID;
    private $clientId;
    private $chambreId;
    private $dateEntree;
    private $dateSortie;
    private $statut;
    private $dateModification;

    public function __construct($clientId, $chambreId, $dateEntree, $dateSortie, $statut, $dateModification) {
        $this->clientId = $clientId;
        $this->chambreId = $chambreId;
        $this->dateEntree = $dateEntree;
        $this->dateSortie = $dateSortie;
        $this->statut = $statut;
        $this->dateModification = $dateModification;
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
    public function create() {
        $row = [
            'chambreId' => $this->chambreId,
            'clientId' => $this->clientId,
            'dateEntree' => $this->dateEntree,
            'dateSortie' => $this->dateSortie,
            'dateModification' => $this->dateModification,
            'statut' => $this->statut
        ];
        $sql = 
            "INSERT INTO reservations SET 
            chambreId=:chambreId, 
            clientId=:clientId,
            dateEntree=:dateEntree,
            dateSortie=:dateSortie,
            dateModification=:dateModification,
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
    public function update($id, $arraycolumns) {
        // @TODO : extraire colonnes du tableau en entréé
    }
    public function delete($id) {
        // @TODO : extraire colonnes du tableau en entréé
    }
}