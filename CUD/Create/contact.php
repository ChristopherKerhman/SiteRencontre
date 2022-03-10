<?php
session_start();
include '../enteteCUD.php';
if($_SERVER['REQUEST_METHOD'] === 'POST') {
//Verification Token
$verif = filter($_POST['verif']);
$token = filter($_POST['token']);
if($token != $verif) {
  header('location:../../index.php?message=Token invalide.');
} else {
  $_POST = doublePOP($_POST);
  array_pop($_POST);
  // Vérification champs vide
  $ok = champsVide($_POST);
    if ($ok >0) {
        header('location:../../index.php?message=Un champs est vide.');
    } else {
      $preparation =  new Preparation();
      $param = $preparation->creationPrep($_POST);
      $sqlInsert = "INSERT INTO `contacter`(`email`, `objet`, `courrielInterne`) VALUES (:email, :objet, :courrielInterne)";
      $insert = new CurDB($sqlInsert, $param);
      $action = $insert->actionDB();
        header('location:../../index.php?message=Message enregistré.');
    }
}
} else {
   header('location:../../index.php?message=Il y a comme un lézard numérique');
}
