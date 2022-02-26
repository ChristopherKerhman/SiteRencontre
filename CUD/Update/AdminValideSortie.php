<?php
session_start();
include '../../securite/securiterCreateur.php';
include '../enteteCUD.php';
if($_SERVER['REQUEST_METHOD'] === 'POST') {
$idNav = filter($_POST['idNav']);
$valide = filter($_POST['valide']);
if($valide > 0) {
  $_POST['valide'] = 0;
  $message = 'Sortie invalidé';
} else {
  $_POST['valide'] = 1;
  $message = 'Sortie validé';
}
$_POST = doublePOP($_POST);
$preparation = new Preparation();
$parametre = $preparation->creationPrep($_POST);
$update = "UPDATE `sorties` SET `valide` = :valide WHERE `idSortie` = :id_Sortie";
$insert = new CurDB($update, $parametre);
$action = $insert->actionDB();
header('location:../../index.php?message='.$message.'&idNav='.$idNav.'&idSortie='.filter($_POST['id_Sortie']));
} else {
  header('location:../../index.php?message=Il y a comme un lézard numérique');
}
