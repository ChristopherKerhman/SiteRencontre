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
    // Recherche si il n'y a pas une personne inscrite dans sa liste de personne bloqué
    $triUser = "SELECT `id_User` FROM `rencontres` WHERE `id_Sortie` = :id_Sortie";
    $param = [['prep'=>':id_Sortie', 'variable'=>filter($_POST['id_Sortie'])]];
    $etablissement = new readDB($triUser,  $param);
    $listeInscrit = $etablissement->read();
    $triUser = "SELECT `id_Bloc` FROM `exclusion` WHERE `id_User` = :idUser";
    $param = [['prep'=>':idUser', 'variable'=>$_SESSION['idUser']]];
    $etablissement = new readDB($triUser,  $param);
    $listeBloquer = $etablissement->read();
    $lien = array_intersect($listeInscrit, $listeBloquer);
    //Fin
    if($lien == array()) {
      $createInscription = "INSERT INTO `rencontres`(`id_Sortie`, `id_User`) VALUES (:id_Sortie, :idUser)";
      $insert = new CurDB($createInscription, $parametre);
      $action = $insert->actionDB();
      header('location:../../index.php?message=Vous êtes inscrit à la sortie.');
    } else {
      header('location:../../index.php?message=Impossible de s\'inscrire, vous avez bloquer au moins 1 personne déjà inscrite sur cette sortie.');
    }
  } else {
      header('location:../../index.php?message=Vous êtes déjà inscrit à la sortie.');
  }
} else {
    header('location:../../index.php?message=Il y a comme un lézard numérique');
}
