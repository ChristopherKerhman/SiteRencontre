<article>
<h3>Les sorties que vous avez créées</h3>
<?php
include 'securite/zonePrive.php';
require 'objets/getSorties.php';
require 'objets/printSortie.php';
$mySortie = new PrintSortie();
$dataTraiter = $mySortie->sortieCreateByUser(0);
$mySortie->administrationSortie($dataTraiter, $idNav);
?>
</article>
<article>
<h3>Les sorties que vous avez créées passer</h3>
<?php
$dataTraiter = $mySortie->sortieCreateByUser(1);
$mySortie->administrationPasser($dataTraiter, $idNav);
?>
</article>
