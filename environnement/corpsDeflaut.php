<?php
require 'objets/sorties.php';
$nbr = 6;
$Rencontres = new Sorties();
// Sortie créer par l'utilisateur
$dataSorties = $Rencontres->lastSortie($nbr, 1);
 ?>
<article>
  <h3>Les <?=$nbr?> dernières sorties organisé</h3>
<?php $Rencontres->affichageSortie($dataSorties);  ?>
</article>
