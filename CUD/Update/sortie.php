<?php
session_start();
include '../enteteCUD.php';
if($_SERVER['REQUEST_METHOD'] === 'POST') {
$idNav = filter($_POST['idNav']);
$idSortie = filter($_POST['idSortie']);
$_POST = doublePOP($_POST);
if (!empty(filter($_POST['prix']))) {
  $updateSortie = "UPDATE `sorties` SET `titreSortie`=:titreSortie,`texteSortie`=:texteSortie,
  `gratuit`=:gratuit,`prix`=:prix,`passSanitaire`=:passSanitaire,`nombreMax`=:nombreMax,`dateSortie`=:dateSortie,
  `heureSortie`=:heureSortie,`lieu`=:lieu,`codePostal`=:codePostal,`adult`=:adult,
  `partager`=:partager,`type`=:type WHERE `idSortie` = :idSortie AND `id_User`=:idUser";
} else {
  $updateSortie = "UPDATE `sorties` SET `titreSortie`=:titreSortie,`texteSortie`=:texteSortie,
  `gratuit`=:gratuit,`passSanitaire`=:passSanitaire,`nombreMax`=:nombreMax,`dateSortie`=:dateSortie,
  `heureSortie`=:heureSortie,`lieu`=:lieu,`codePostal`=:codePostal,`adult`=:adult,
  `partager`=:partager,`type`=:type WHERE `idSortie` = :idSortie AND `id_User`=:idUser";
}
$preparation = new Preparation();
$parametre = $preparation->creationPrepIdUser($_POST);
$insert = new CurDB($updateSortie, $parametre);
$action = $insert->actionDB();
header('location:../../index.php?message=Sortie modifée&idNav='.$idNav.'&idSortie='.$idSortie);
} else {
  header('location:../../index.php?message=Il y a comme un lézard numérique');
}
