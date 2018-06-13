<?php

include_once('../Model/Database.php');
include_once('../Model/Reservation.php');
Database::connect();

if (isset($_POST)) {
        switch($_GET['action']) {
            case 'add' :
                $clientId = $_POST['client'];
                $chambreId = $_POST['chambre'];
                $dateEntree  = $_POST['dateEntree']; 
                $dateSortie = $_POST['dateSortie'];
                $statut = $_POST['statut'];
            
                $reservation = new Reservation($clientId, $chambreId, $dateEntree, $dateSortie, $statut);
                $reservation->add();
                echo "La réservation a bien été ajoutée.";
                header("refresh:2;../index.php");
            break;
            case 'edit' :
                $clientId = $_POST['client'];
                $chambreId = $_POST['chambre'];
                $dateEntree  = $_POST['dateEntree']; 
                $dateSortie = $_POST['dateSortie'];
                $statut = $_POST['statut'];
            
                $reservation = new Reservation($clientId, $chambreId, $dateEntree, $dateSortie, $statut);
                $reservation->edit($_GET['idres']);
                echo "La réservation a bien été modifiée.";
                header("refresh:2;../index.php");
            break;
            case 'delete' :
                Reservation::delete($_GET['idres']);
                echo "La réservation a bien été supprimée.";
                header("refresh:2;../index.php");
            break;
            default :
                echo "Je suis un message de gestion d'erreurs.";
        }
}

