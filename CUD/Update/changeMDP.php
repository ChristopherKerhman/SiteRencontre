<?php
require '../enteteCUD.php';
if($_SERVER['REQUEST_METHOD'] === 'POST') {
if (filter($_POST['mdp'] == '')) {
    header('location:../../index.php?message=Le mot de passe ne doit pas être un champs vide.');
} else {
$mdp = haschage(filter($_POST['mdp']));
}
$_POST = doublePOP($_POST);
$preparation =  new Preparation();
$param = $preparation->creationPrep($_POST);
array_push($param, ['prep' => ':mdp', 'variable' => $mdp]);
$idUser = "UPDATE `users` SET `mdp` = :mdp, `valide` = 1, `token` = NULL WHERE `email`=:email AND `token`=:token";
$action = new CurDB($idUser, $param);
print_r($param);
$update = $action->actionDB();
header('location:../../index.php');
  } else {
      header('location:../../index.php?message=Il y a comme un lézard numérique');
  }
