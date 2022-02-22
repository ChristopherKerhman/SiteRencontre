<?php
session_start();
include '../enteteCUD.php';
if($_SERVER['REQUEST_METHOD'] === 'POST') {
$idNav = filter($_POST['idNav']);
$_POST = doublePOP($_POST);
$preparation = new Preparation();
$parametre = $preparation->creationPrepIdUser($_POST);
$update = "UPDATE `sorties` SET `valide` = 0 WHERE `idSortie` = :idSortie AND `id_User`= :idUser";
$insert = new CurDB($update, $parametre);
$action = $insert->actionDB();
header('location:../../index.php?message=Sortie supprimée&idNav='.$idNav);
} else {
  header('location:../../index.php?message=Il y a comme un lézard numérique');
}
