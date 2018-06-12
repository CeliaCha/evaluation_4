<?php
include_once('./Model/Reservation.php');
include_once('./Model/Client.php');
include_once('./Model/Chambre.php');

$clients = Client::getIndex();
$chambres = Chambre::getIndex();
$reservations = Reservation::getIndex();
?>


@Logo
    <div class='card bg-light' style="max-width: 50rem;">
    <div class="card-header"><h4>Ajouter / Modifier une réservation</h4></div>
        <div class='card-body'>
            <form action='ReservationController.php' method='post'>
                <div class="form-group">
                    <label for="client">Client :</label>
                    <select class="form-control" id="client">
                        <?php
                        foreach ($clients as $row) {
                        echo " <option name={$row['id']}>{$row['prenom']} {$row['nom']}</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="chambre">Chambre :</label>
                    <select class="form-control" id="chambre">
                        <?php
                        foreach ($chambres as $row) {
                        echo " <option name={$row['id']}>N°{$row['numero']} : {$row['nom']}</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="date-entree">Date entrée :</label>
                    <input type="date" id="date-entree">
                </div>
                <div class="form-group">
                    <label for="date-sortie">Date sortie :</label>
                    <input type="date" id="date-sortie">
                </div>
                <div class="form-group">
                    <label for="statut">Statut :</label>
                    <select class="form-control" id="statut">
                    <?php
                        $statuts = [];
                        foreach ($reservations as $row) {
                            array_push($statuts, $row['statut']);
                        }
                        foreach (array_unique($statuts) as $statut) {
                            echo " <option name={$statut}>{$statut}</option>";
                        }
                        ?>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Valider</button>
            </form>
        </div>

    </div>


