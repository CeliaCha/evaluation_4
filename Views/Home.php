<?php
  include_once('./Model/Reservation.php');
  $reservations = Reservation::getIndex();

  // Handle pagination
  $numberOfRes = count($reservations);
  $numberOfPages = ceil($numberOfRes/5);
  if (isset($_GET['numpage'])) { $numPage = $_GET['numpage']; } else { $numPage = 1;}
  $linkprevious = ''; $linknext = '';
  if ($numPage == '1') { $linkprevious = " disabled" ; }
  else if ($numPage == strval($numberOfPages)) { $linknext = " disabled" ; }

  $resToDisplay = [];
  for ($i = (($numPage - 1) * 5) ; $i <= (($numPage - 1) * 5) + 4 ; $i++) {
    if ($i > $numberOfRes - 1) break;
    array_push($resToDisplay, $reservations[$i]);
  }

?>

<div>@Logo</div>

<h1>Gestion des réservations</h1>

<!-- Reservations table -->
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
      foreach ($resToDisplay as $row) {
        $dateEntree = date("d-m-Y", strtotime(substr($row['dateEntree'], 0, 10)));
        $dateSortie = date("d-m-Y", strtotime(substr($row['dateSortie'], 0, 10)));
        echo "<tr>
                <td>{$row['id']}</td>
                <td>{$row['clientprenom']} {$row['clientnom']}</td>
                <td>{$row['chambrenom']}</td>
                <td>Du {$dateEntree} au {$dateSortie}</td>
                <td> {$row['statut']}</td>
                <td> 
                  <a href='index.php?page=add-edit&action=edit&idres={$row['id']}'>Editer</a> - 
                  <a href='index.php?page=delete&idres={$row['id']}'>Supprimer</a>
                </td>
              </tr>"
        ;
      }
    ?>
  </tbody>
</table>

<!-- Pagination bar -->
<nav aria-label="Page navigation example">
  <ul class="pagination">
    <?php
      echo "<li class='page-item {$linkprevious}'><a class='page-link' href='index.php?page=home&numpage=" . intval($numPage - 1) . "'><</a></li>";
      for ($i = 1; $i <= $numberOfPages; $i++) {
        echo "<li class='page-item'><a class='page-link' 
        href='index.php?page=home&numpage={$i}'>{$i}</a></li>";
      }
      echo "<li class='page-item {$linknext}'><a class='page-link' href='index.php?page=home&numpage=" . intval($numPage + 1) . "'>></a></li>";
    ?>
  </ul>
</nav>

<a class="btn btn-primary" href="index.php?page=add-edit&action=add">Ajouter</a>


