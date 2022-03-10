<?php
session_start();
require '../enteteCUD.php';
if($_SERVER['REQUEST_METHOD'] === 'POST') {
  $idContact = filter($_POST['idContact']);

    $param = [['prep'=>':idContact', 'variable'=>$idContact]];
    $sqlUpdate = "DELETE FROM `contacter` WHERE `idContact` = :idContact";
    $update = new CurDB($sqlUpdate,$param);
    $action = $update->actionDB();
    header('location:../../index.php?message=Message effacé définitivement.');
} else {
    header('location:../../index.php?message=Il y a comme un lézard numérique');
}
