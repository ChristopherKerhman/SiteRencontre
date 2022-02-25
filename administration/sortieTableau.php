<article class="presentationTableau">
<?php
include 'securite/securiterCreateur.php';
include 'functions/functionPagination.php';
require 'objets/getSorties.php';
require 'objets/printSortie.php';
if(isset($_GET['page']) && (!empty($_GET['page']))) {
  $currentPage = filter($_GET['page']);
  echo '  <h3>Les sorties qui ont été annulées par leur créateur : page'.$currentPage .'</h3>';
} else {
$currentPage = 1;
echo '  <h3>Les sorties qui ont été annulées par leur créateur : page'.$currentPage .'</h3>';
}
$parPage = 10;
// Déclaration de paramètre vide :

$param = [['prep'=>':valide', 'variable'=>$valide],['prep'=>':passer', 'variable'=>$passer]];
// Recherche du nombre d'armes total
$requetteSQL = "SELECT COUNT(`idSortie`) AS `nbr` FROM `sorties` WHERE `valide` = :valide AND `passer` = :passer";
$pages = parametrePagination ($parPage, $requetteSQL, $param );
// Calcul du premier article dans la page.
$premier = ($currentPage * $parPage) - $parPage;
// Traitement des données a affiché.
$requetteSQL = 'SELECT `idSortie`, `login`, `titreSortie`, `typeSortie`, `dateSortie`
FROM `sorties`
INNER JOIN `users` ON `idUser` = `id_User`
INNER JOIN `types` ON `idTypeSortie` = `type`
WHERE `sorties`.`valide`= :valide AND `passer` = :passer
LIMIT '.$premier.', '.$parPage.'';
$dataTraiter = affichageData($requetteSQL, $param);
// Print des sorties
$adminSortie = new PrintSortie();
$adminSortie->tableauSorties($dataTraiter);
navPagination($pages, $idNav); ?>
</article>
