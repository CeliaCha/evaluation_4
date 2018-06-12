<?php

include_once('./Model/Reservation.php');
$reservations = Reservation::getIndex();

?>

<div>@Logo</div>
<h1>Gestion des réservations</h1>
<table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">Numéro</th>
      <th scope="col">Client</th>
      <th scope="col">Chambre</th>
      <th scope="col">Dates</th>
      <th scope="col">Statut</th>
      <th scope="col">Actions</th>
    </tr>
  </thead>
  <tbody>
    <?php
foreach ($reservations as $row) {
  $dateEntree = date("d-m-Y", strtotime(substr($row['dateEntree'], 0, 10)));
  $dateSortie = date("d-m-Y", strtotime(substr($row['dateSortie'], 0, 10)));
      echo "<tr>";
      echo "<td> {$row['id']}</td>";
      echo "<td> {$row['clientprenom']} {$row['clientnom']}</td>";
      echo "<td> {$row['chambrenom']}</td>";
      echo "<td>Du {$dateEntree} au {$dateSortie}</td>";
      echo "<td> {$row['statut']}</td>";
      // echo "<td> <a href='index.php?page=addedit&id={$row['id']}'>Editer</a> - <a href='index.php?page=delete&id={$row['id']}>Supprimer</a></td>";
      echo "<td>truc</td>";
      echo"</tr>";
}
?>
  </tbody>
</table>
<a class="btn btn-primary" href='index.php?page=addedit'>Ajouter</a>
<div>@pagination</div>