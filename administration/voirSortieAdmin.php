<?php
include 'securite/securiterCreateur.php';
include 'functions/functionPagination.php';
require 'objets/getSorties.php';
require 'objets/printSortie.php';
require 'objets/getCommentaire.php';
require 'objets/printCommentaire.php';
$idSortie = filter($_GET['idSortie']);
$oneSortie =  new PrintSortie();
$dataTraiter = $oneSortie->oneSortie($idSortie);
$oneSortie->AdminSortie($dataTraiter, $idSortie, $idNav);
//On sort les données lier aux commentaires de la sortie

 ?>
<h3>Commentaire</h3>
<?php
  $commentaires = new PrintCommentaires();
  $dataCommentaires = $commentaires->commentaireSortie ($idSortie);
  $commentaires->commentairesAdmin($dataCommentaires, $idNav);
?>
