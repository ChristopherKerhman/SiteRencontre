<?php
session_start();
include '../enteteCUD.php';
if($_SERVER['REQUEST_METHOD'] === 'POST') {
$idNav = filter($_POST['idNav']);
$_POST = doublePOP($_POST);
$preparation = new Preparation();
$parametre = $preparation->creationPrepIdUser($_POST);
$update = "DELETE FROM `rencontres` WHERE `id_User` = :idUser AND `id_Sortie` = :id_Sortie";
$insert = new CurDB($update, $parametre);
$action = $insert->actionDB();
header('location:../../index.php?message=Participation supprimée&idNav='.$idNav);
} else {
  header('location:../../index.php?message=Il y a comme un lézard numérique');
}
