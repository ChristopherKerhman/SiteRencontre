<?php
require 'objets/getSorties.php';
require 'objets/printSortie.php';
require 'objets/controleInscription.php';
// Déclaration des variables

if (empty($_SESSION['idUser'])) {
  $_SESSION['idUser'] = NULL;
  $limit = 10;
  $valide = 1;
  $lastSortie =  new PrintSortie();
  $dataTraiter = $lastSortie->lastSortie($limit, $valide);
  $lastSortie->affichageSortie($dataTraiter);
} else {
  $limit = 6;
  $valide = 1;
  $lastSortie = new PrintSortie();
  $dataTraiter = $lastSortie->lastSortiePerso($limit, $valide, $_SESSION['departement']);
  $lastSortie->affichageSortieGeneral ($dataTraiter, $_SESSION['idUser']);
}
