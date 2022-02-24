<?php
require 'objets/getSorties.php';
require 'objets/printSortie.php';
// Déclaration des variables
$limit = 6;
$valide = 1;
$lastSortie =  new PrintSortie();
$dataTraiter = $lastSortie->lastSortie($limit, $valide);
$lastSortie->affichageSortie($dataTraiter);
