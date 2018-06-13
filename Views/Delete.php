<?php
include_once('./Model/Reservation.php');
include_once('./Model/Client.php');
include_once('./Model/Chambre.php');

$reservations = Reservation::getIndex();
$clients = Client::getIndex();
$chambres = Chambre::getIndex();

if (!empty($_GET['idres'])) { $deleted = Reservation::read(intval($_GET['idres'])); } 

?>
@Logo
    <div class='card bg-light' style="max-width: 50rem;">
    <div class="card-header">
    <h4>Supression d'une réservation</h4>
    </div>
        <div class='card-body'>
            <h5>Êtes-vous sûr de vouloir supprimer la réservation N° <?php echo $_GET['idres'];?> ?</h5>
            <?php
                foreach ($clients as $row) {
                    if ($row['id'] == $deleted['clientId']) { 
                        echo "<p>{$row['prenom']} {$row['nom']}</p>";
                        break;
                    }
                }
                foreach ($chambres as $row) {
                    if ($row['id'] == $deleted['chambreId']) { 
                        echo "<p>Chambre N° {$row['numero']}</p>";
                        break;
                    }
                }
                $dateEntree = date("d-m-Y", strtotime(substr($deleted['dateEntree'], 0, 10)));
                $dateSortie = date("d-m-Y", strtotime(substr($deleted['dateSortie'], 0, 10)));
                echo "<p>Du : {$dateEntree}</p>";
                echo "<p>Au : {$dateSortie}</p>";
            ?>

            <form  
            action='./Controllers/ReservationController.php?action=delete&idres= <?php echo $_GET['idres'];?>' method='post'>
                <a class="btn btn-primary" href="index.php?page=home">Annuler</a>
                <button type="submit" class="btn btn-primary">Confirmer la suppression</button>
            </form>
        </div>
    </div>


