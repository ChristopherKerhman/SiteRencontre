<?php
require 'objets/getSorties.php';
require 'objets/printSortie.php';
// Déclaration des variables
$limit = 6;
$valide = 1;
if (empty($_SESSION['idUser'])) {
  $_SESSION['idUser'] = 0;
$lastSortie =  new PrintSortie();
} else {
  $lastSortie =  new PrintSortie();
}
$dataTraiter = $lastSortie->lastSortie($limit, $valide);
$lastSortie->affichageSortie($dataTraiter);
