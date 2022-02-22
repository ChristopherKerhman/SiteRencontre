<?php
session_start();
include '../enteteCUD.php';
if($_SERVER['REQUEST_METHOD'] === 'POST') {
//Création des contrôles
$dateDuJour = date('Y-m-d');
if(filter($_POST['dateSortie'])< $dateDuJour) {
  header('location:../../index.php?message=Problème de choix dans la date.');
} else {
  // On retire la dernière ligne de POST.
  array_pop($_POST);
 // On fait la chasse au champs vide.
 $ok = champsVide($_POST);
if ($ok > 0) {
    header('location:../../index.php?message=Au moins un champs est vide.');
} else {
  // Préparation des paramètre
$preparation = new Preparation();
$parametre = $preparation->creationPrepIdUser($_POST);
// Sortie payante ou non
if (!empty(filter($_POST['prix']))) {
  $createSortie = "INSERT INTO `sorties`( `titreSortie`, `texteSortie`, `gratuit`, `prix`,  `nombreMax`, `dateSortie`, `heureSortie`, `lieu`, `codePostal`, `adult`, `partager`, `passSanitaire`, `type`, `id_User`)
  VALUES (:titreSortie, :texteSortie, :gratuit, :prix, :nombreMax, :dateSortie, :heureSortie, :lieu, :codePostal, :adult, :partager, :passSanitaire, :type, :idUser )";
} else {
  $createSortie = "INSERT INTO `sorties`( `titreSortie`, `texteSortie`, `gratuit`,  `nombreMax`, `dateSortie`, `heureSortie`, `lieu`, `codePostal`, `adult`, `partager`, `passSanitaire`, `type`, `id_User`)
  VALUES (:titreSortie, :texteSortie, :gratuit, :nombreMax, :dateSortie, :heureSortie, :lieu, :codePostal, :adult, :partager, :passSanitaire, :type, :idUser )";
}
//print_r($parametre);
$insert = new CurDB($createSortie, $parametre);
$action = $insert->actionDB();
  header('location:../../index.php?message=Sortie '.filter($_POST['titreSortie']).' créée.');
}
}
} else {
  header('location:../../index.php?message=Il y a comme un lézard numérique');
}
