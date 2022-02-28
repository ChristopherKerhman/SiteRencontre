<?php
include 'securite/zonePrive.php';
require 'objets/getSorties.php';
require 'objets/printSortie.php';
$mySortie = new PrintSortie();
$dataTraiter = $mySortie->getMysortie();
$mySortie->deinscriptionSortie($dataTraiter, $idNav);
