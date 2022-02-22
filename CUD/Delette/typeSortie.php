<?php
session_start();
include '../enteteCUD.php';
include '../../securite/securiterCreateur.php';
if($_SERVER['REQUEST_METHOD'] === 'POST') {
$idNav = filter($_POST['idNav']);
$_POST = doublePOP($_POST);
$preparation = new Preparation();
$parametre = $preparation->creationPrep($_POST);;
$update = "DELETE FROM `types` WHERE `idTypeSortie`=:idTypeSortie";
$insert = new CurDB($update, $parametre);
$action = $insert->actionDB();
header('location:../../index.php?message=Type de sortie supprimée&idNav='.$idNav);
} else {
  header('location:../../index.php?message=Il y a comme un lézard numérique');
}
