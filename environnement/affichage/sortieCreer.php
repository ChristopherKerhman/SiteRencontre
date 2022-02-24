<h3>Les sorties que vous avez créées</h3>
<?php
require 'objets/getSorties.php';
require 'objets/printSortie.php';
$mySortie = new PrintSortie();
$dataTraiter = $mySortie->sortieCreateByUser();
$mySortie->administrationSortie($dataTraiter, $idNav);
