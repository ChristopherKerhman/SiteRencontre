<?php
session_start();
include '../enteteCUD.php';
include '../../securite/securiterCreateur.php';
if($_SERVER['REQUEST_METHOD'] === 'POST') {
  $idNav = filter($_POST['idNav']);
  $_POST = doublePOP($_POST);
  $ok = champsVide($_POST);
  if($ok > 0) {
      header('location:../../index.php?message=Un champs est vide.');
  } else {
    // Recherche de doublon
    $sql = "SELECT  `typeSortie`FROM `types` WHERE `typeSortie` = :typeSortie";
    $preparation = ':typeSortie';
    $valeur = filter($_POST['typeSortie']);
    $doublon = new Controle();
    $recherche = $doublon->doublon($sql, $preparation , $valeur);
    // fin de recherche de doublon
    if ($recherche > 0) {
        header('location:../../index.php?message=Le type enregistré est un doublon.');
    } else {
      // Enregistrement du nouveau type
      $insertType = "INSERT INTO `types`( `typeSortie`) VALUES (:typeSortie)";
      $preparation = new Preparation();
      $parametre = $preparation->creationPrep($_POST);
      $insert = new CurDB($insertType, $parametre);
      $action = $insert->actionDB();
      header('location:../../index.php?message=Type ajouté&idNav='.$idNav);
    }
  }
} else {
  header('location:../../index.php?message=Il y a comme un lézard numérique');
}
