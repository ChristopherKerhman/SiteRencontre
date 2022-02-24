<?php
require 'objets/sorties.php';
require 'objets/sortieUtilisateur.php';
$sortieProgrammer = new SortieUtilisateur();
$dataSortie = $sortieProgrammer->sortiePrevus();
$sortieProgrammer->affichageSortie($dataSortie);
 ?>
