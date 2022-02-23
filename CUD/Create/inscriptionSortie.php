<?php
session_start();
include '../enteteCUD.php';
if($_SERVER['REQUEST_METHOD'] === 'POST') {
    array_pop($_POST);
  //Recherche si l'utilisateur n'est pas déjà inscrit ?
  $recherche = "SELECT `id_User` FROM `rencontres` WHERE `id_Sortie` = :id_Sortie AND `id_User` = :idUser";
  $preparation = new Preparation();
  $parametre = $preparation->creationPrepIdUser($_POST);
  $detection = new readDB($recherche, $parametre);
  $dataDectection = $detection->read();
  if(  $dataDectection == array()) {
    $createInscription = "INSERT INTO `rencontres`(`id_Sortie`, `id_User`) VALUES (:id_Sortie, :idUser)";
    $insert = new CurDB($createInscription, $parametre);
    $action = $insert->actionDB();
      header('location:../../index.php?message=Vous êtes inscrit à la sortie.');
  } else {
      header('location:../../index.php?message=Vous êtes déjà inscrit à la sortie.');
  }
} else {
    header('location:../../index.php?message=Il y a comme un lézard numérique');
}
