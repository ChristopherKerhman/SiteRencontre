<?php
session_start();
include '../enteteCUD.php';
if($_SERVER['REQUEST_METHOD'] === 'POST') {
$idNav = filter($_POST['idNav']);
$idSortie = filter($_POST['id_Sortie']);
$_POST = doublePOP($_POST);
$preparation = new Preparation();
$parametre = $preparation->creationPrepIdUser($_POST);
$update = "INSERT INTO `exclusion`(`id_Bloc`, `id_User`) VALUES (:id_Bloc, :idUser)";
$insert = new CurDB($update, $parametre);
$action = $insert->actionDB();
header('location:../../index.php?message=Personne bloqué.&idNav='.$idNav.'&idSortie='.$idSortie);
} else {
  header('location:../../index.php?message=Il y a comme un lézard numérique');
}
