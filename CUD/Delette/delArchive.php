<?php
session_start();
include '../enteteCUD.php';
include '../../securite/securiterCreateur.php';
if($_SERVER['REQUEST_METHOD'] === 'POST') {
$idNav = filter($_POST['idNav']);
$parametre = [];
$update = "DELETE FROM `sorties` WHERE `passer` = 1";
$insert = new CurDB($update, $parametre);
$action = $insert->actionDB();
header('location:../../index.php?message=Archive supprimée&idNav='.$idNav);
} else {
  header('location:../../index.php?message=Il y a comme un lézard numérique');
}
