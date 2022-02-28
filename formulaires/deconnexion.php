<?php
require 'objets/cud.php';
// Exclusion de la personne :
$compte = "SELECT COUNT(`idRestriction`) AS `nbr` FROM `exclusion` WHERE `id_Bloc` = :idUser";
$param = [['prep'=>':idUser', 'variable'=> $_SESSION['idUser']]];
$aligement = new readDB($compte, $param);
$comportements = $aligement->read();
$launch = $comportements[0]['nbr'];
if($launch >= 10) {
  $requetteSQL = "UPDATE `users` SET `valide`= 0 WHERE `idUser`= :idUser; UPDATE `sorties` SET `valide` = 0 WHERE `id_User` = :idUser;
  UPDATE `sorties` SET `valide`= 0 WHERE `id_User` = :idUser";
  $parametreUser = [['prep'=> ':idUser', 'variable' => $_SESSION['idUser']]];
  $updateUser = new CurDB($requetteSQL, $parametreUser);
  $updateUser->actionDB();
}
// Fin exclusion
session_destroy();
header('location:index.php?message=Deconnexion effectuée');
