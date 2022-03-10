<?php
session_start();
require '../enteteCUD.php';
if($_SERVER['REQUEST_METHOD'] === 'POST') {
    $idNav = filter($_POST['idNav']);
    $idContact = filter($_POST['idContact']);
    $etat = filter($_POST['etat']);
    $param = [['prep'=>':etat', 'variable'=>$etat], ['prep'=>':idContact', 'variable'=>$idContact]];
    $sqlUpdate = "UPDATE `contacter` SET `etat`= :etat WHERE `idContact` = :idContact";
    $update = new CurDB($sqlUpdate,$param);
    $action = $update->actionDB();
    header('location:../../index.php?message=Etat du message modifier&idNav='.$idNav.'&idContact='.$idContact);
} else {
    header('location:../../index.php?message=Il y a comme un lézard numérique');
}
