<?php
session_start();
include '../enteteCUD.php';
if($_SERVER['REQUEST_METHOD'] === 'POST') {
$idNav = filter($_POST['idNav']);
$_POST = doublePOP($_POST);
$preparation = new Preparation();
$parametre = $preparation->creationPrepIdUser($_POST);
print_r($parametre);
$sql = "SELECT COUNT(`idRestriction`) AS `nbr` FROM `exclusion` WHERE `id_User` = :idUser AND `id_Bloc` = :id_Bloc";
$testDoublon = new readDB($sql, $parametre);
$dataTraiter = $testDoublon->read();
$test = $dataTraiter[0]['nbr'];
if ($test > 0) {
  header('location:../../index.php?message=Vous avez déjà bloqué cet individus.');
} else {

  $update = "INSERT INTO `exclusion`(`id_Bloc`, `id_User`) VALUES (:id_Bloc, :idUser)";
  $insert = new CurDB($update, $parametre);
  $action = $insert->actionDB();
  header('location:../../index.php?message=Personne bloqué.&idNav='.$idNav.'&idSortie='.$idSortie);
}

} else {
  header('location:../../index.php?message=Il y a comme un lézard numérique');
}
