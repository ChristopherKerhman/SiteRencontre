<?php
session_start();
include '../enteteCUD.php';
if($_SERVER['REQUEST_METHOD'] === 'POST') {
$idNav = filter($_POST['idNav']);
$idSortie = filter($_POST['idSortie']);
$_POST = doublePOP($_POST);
$ok = champsVide($_POST);
if ($ok > 0) {
  header('location:../../index.php?idNav='.$idNav.'&idSortie='.$idSortie.'&message=Un champs est vide.');
} else {
    $addCommentaire = "INSERT INTO `commentaires`(`id_Sortie`, `commentaire`, `id_User`) VALUES (:idSortie, :commentaire,  :idUser)";
    $preparation = new Preparation();
    $parametre = $preparation->creationPrepIdUser($_POST);
    $insert = new CurDB($addCommentaire, $parametre);
    $action = $insert->actionDB();
  header('location:../../index.php?idNav='.$idNav.'&idSortie='.$idSortie.'&message=Commentaire ajouté');
}
} else {
    header('location:../../index.php?message=Il y a comme un lézard numérique');
}
