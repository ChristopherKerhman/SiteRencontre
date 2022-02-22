<?php
require 'objets/sorties.php';
$Rencontres = new Sorties();
// Sortie créer par l'utilisateur
$dataSorties = $Rencontres->sortieCreateByUser($_SESSION['idUser']);
 ?>
<h3>Les sorties organisé par vos soins</h3>
<?php $Rencontres->administrationSortie($dataSorties, $idNav) ?>
