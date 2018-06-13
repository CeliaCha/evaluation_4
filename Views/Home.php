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
<div id='wrapper'>
<h1 class='h-center'>Gestion des réservations</h1>

<!-- Reservations table -->
<div class="table-responsive">
<table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">Id</th>
      <th scope="col">Client</th>
      <th scope="col">Chambre</th>
      <th scope="col">Dates</th>
      <th class="hidden-mobile" scope="col" >Statut</th>
      <th scope="col">Actions</th>
    </tr>
  </thead>
  <tbody>
    <span class='hidden-mobile'></span>
    <?php
      foreach ($resToDisplay as $row) {
        $dateEntree = date("d-m-Y", strtotime(substr($row['dateEntree'], 0, 10)));
        $dateSortie = date("d-m-Y", strtotime(substr($row['dateSortie'], 0, 10)));
        echo "<tr>
                <td>{$row['id']}</td>
                <td><span class='hidden-mobile'>{$row['clientprenom']} </span>{$row['clientnom']}</td>
                <td><span class='hidden-mobile'>{$row['chambrenom']}</span><span class='hidden-desktop'>{$row['chambrenum']}</span></td>
                <td><span class='hidden-mobile'>Du </span>{$dateEntree}<span class='hidden-mobile'> au {$dateSortie}</td>
                <td class='hidden-mobile'> {$row['statut']}</td>
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
</div>

<!-- Pagination bar -->
<nav class='h-center' aria-label="Page navigation example">
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

<a class="btn btn-primary" class='h-center' href="index.php?page=add-edit&action=add">Ajouter</a>
</div>


