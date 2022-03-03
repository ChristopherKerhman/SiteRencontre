<article class="presentationTableau">
<?php
include 'securite/securiterCreateur.php';
include 'functions/functionPagination.php';
require 'objets/getSorties.php';
require 'objets/printSortie.php';

if(isset($_GET['page']) && (!empty($_GET['page']))) {
    $currentPage = filter($_GET['page']);
  $titre = ['<h3>Les sorties en ligne : page'.$currentPage .'</h3>',
  '<h3>Les sorties qui ont été annulées par leur créateur : page'.$currentPage .'</h3>',
  '<h3>Les sorties passées et archivées : page'.$currentPage .'</h3>'];
  // Train de condition :
  if(($valide == 1) && ($passer ==1)) {
      echo $titre[2];
  }
  if(($valide == 0) && ($passer ==0)) {
      echo $titre[1];
  }
  if(($valide == 0) && ($passer ==1)) {
      echo $titre[0];
  }

} else {
$currentPage = 1;
$titre = ['<h3>Les sorties en ligne : page'.$currentPage .'</h3>',
'<h3>Les sorties qui ont été annulées par leur créateur : page'.$currentPage .'</h3>',
'<h3>Les sorties passées et archivées : page'.$currentPage .'</h3>'];
// Train de condition :
  if(($valide == 1) && ($passer ==1)) {
      echo $titre[2];
  }
  if(($valide == 0) && ($passer ==0)) {
      echo $titre[1];
  }
  if(($valide == 1) && ($passer ==0)) {
      echo $titre[0];
  }
}
$parPage = 10;
// Déclaration de paramètre :

$param = [['prep'=>':valide', 'variable'=>$valide],['prep'=>':passer', 'variable'=>$passer]];
// Recherche du nombre de sorties
$requetteSQL = "SELECT COUNT(`idSortie`) AS `nbr` FROM `sorties` WHERE `valide` = :valide AND `passer` = :passer";
$pages = parametrePagination ($parPage, $requetteSQL, $param );
// Calcul du premier article dans la page.
$premier = ($currentPage * $parPage) - $parPage;
// Traitement des données a affiché.
$requetteSQL = 'SELECT `idSortie`, `login`, `titreSortie`, `typeSortie`, `dateSortie`, `sorties`.`valide`, `passer`, `users`.`valide` AS `UV`
FROM `sorties`
INNER JOIN `users` ON `idUser` = `id_User`
INNER JOIN `types` ON `idTypeSortie` = `type`
WHERE `sorties`.`valide`= :valide AND `passer` = :passer
LIMIT '.$premier.', '.$parPage.'';
$dataTraiter = affichageData($requetteSQL, $param);
// Print des sorties
$adminSortie = new PrintSortie();
$adminSortie->tableauSorties($dataTraiter, $idNav);
navPagination($pages, $idNav); ?>
</article>
