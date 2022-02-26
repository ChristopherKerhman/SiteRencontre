<?php
session_start();
include '../../securite/securiterCreateur.php';
include '../enteteCUD.php';
if($_SERVER['REQUEST_METHOD'] === 'POST') {
$idNav = filter($_POST['idNav']);
$_POST = doublePOP($_POST);
$preparation = new Preparation();
$parametre = $preparation->creationPrep($_POST);
$update = "DELETE FROM `sorties` WHERE `idSortie` = :idSortie AND `valide` = 0";
$insert = new CurDB($update, $parametre);
$action = $insert->actionDB();
header('location:../../index.php?message=Sortie effacé définitivement.&idNav=28');
} else {
  header('location:../../index.php?message=Il y a comme un lézard numérique');
}
