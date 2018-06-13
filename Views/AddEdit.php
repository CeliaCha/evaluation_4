<?php
include_once('./Model/Reservation.php');
include_once('./Model/Client.php');
include_once('./Model/Chambre.php');

$reservations = Reservation::getIndex();
$clients = Client::getIndex();
$chambres = Chambre::getIndex();
$edit = false;

if (!empty($_GET['action'])) { $action = $_GET['action']; }
if (!empty($_GET['idres'])) { $edit = Reservation::read(intval($_GET['idres'])); } 

?>


@Logo
    <div class='card bg-light' style="max-width: 50rem;">
    <div class="card-header">
    <h4>
    <?php if ($action == "add") {echo "Ajouter une réservation";} else {echo "Modifier réservation n° {$_GET['idres']}";} ?>
    </h4>
    </div>
        <div class='card-body'>
            <form  action='./Controllers/ReservationController.php?
            <?php 
            echo "action={$action}";
            if (isset($_GET['idres'])) {echo "&idres={$_GET['idres']}";}
            ?>'
            method='post'>

                <div class="form-group">
                    <label for="client">Client :</label>
                    <select class="form-control" id="client" name="client">
                        <option>Sélectionner un client</option>
                        <?php
                            foreach ($clients as $row) {
                                if ($row['id'] == $edit['clientId']) { $selected = "selected"; }
                                else {$selected = "";}
                                echo " <option {$selected} value={$row['id']}>{$row['prenom']} {$row['nom']}</option>";
                            }
                        ?>
                    </select>
                </div>

                <div class="form-group">
                    <label for="chambre">Chambre :</label>
                    <select class="form-control" id="chambre" name="chambre">
                    <option>Sélectionner une chambre</option>
                        <?php
                            foreach ($chambres as $row) {
                                if ($row['id'] == $edit['chambreId']) { $selected = "selected"; }
                                else {$selected = "";}
                                echo " <option {$selected} value={$row['id']}>N°{$row['numero']} : {$row['nom']}</option>";
                            }
                        ?>
                    </select>
                </div>

                <div class="form-group">
                    <label for="date-entree">Date entrée :</label>
                    <input type="date" id="date-entree" name="dateEntree"
                    <?php if ($edit) echo "value={$edit['dateEntree']}" ?>>
                </div>

                <div class="form-group">
                    <label for="date-sortie">Date sortie :</label>
                    <input type="date" id="date-sortie" name="dateSortie" 
                    <?php if ($edit) echo "value={$edit['dateSortie']}" ?>>
                </div>

                <div class="form-group">
                    <label for="statut">Statut :</label>
                    <select class="form-control" id="statut" name="statut">
                        <?php
                        $statuts = ['attente', 'valide', 'refus'];
                        foreach ($statuts as $statut) {
                            if ($statut == $edit['statut']) { $selected = "selected"; }
                            else {$selected = "";}
                            echo "<option {$selected} value={$statut}>{$statut}</option>";
                        }   
                       ?>
                    </select>
                </div>
                
                <button type="submit" class="btn btn-primary">Enregistrer</button>
            </form>
        </div>
        <a href='index.php'>Retour</a>
    </div>


