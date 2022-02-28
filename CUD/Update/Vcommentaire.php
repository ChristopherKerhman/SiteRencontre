<?php
session_start();
include '../enteteCUD.php';
if($_SERVER['REQUEST_METHOD'] === 'POST') {
$idNav = filter($_POST['idNav']);
$idSortie = filter($_POST['id_Sortie']);
$_POST = doublePOP($_POST);
$preparation = new Preparation();
$parametre = $preparation->creationPrep($_POST);;
$update = "UPDATE `commentaires` SET `verrou`= 0 WHERE `idCommentaire` = :idCommentaire AND `id_Sortie` = :id_Sortie";
$insert = new CurDB($update, $parametre);
$action = $insert->actionDB();
header('location:../../index.php?message=Commentaire déverouillé.&idNav='.$idNav.'&idSortie='.$idSortie);
} else {
  header('location:../../index.php?message=Il y a comme un lézard numérique');
}
