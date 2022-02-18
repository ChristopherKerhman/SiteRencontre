<?php
require '../enteteCUD.php';
if($_SERVER['REQUEST_METHOD'] === 'POST') {
    $sql = "SELECT `token` FROM `users` WHERE `token` = :token";
    $preparation = ':token';
    $valeur = filter($_POST['token']);
    $test = new Controle();
    $testLogin = $test->doublon($sql, $preparation , $valeur);
    if ($testLogin == 1) {
      $upDate = "UPDATE `users` SET `valide`=1,`role`=1,`token`= 0 WHERE `token` = :token";
        array_pop($_POST);
        print_r($_POST);
       $preparation =  new Preparation();
       $param = $preparation->creationPrep($_POST);
       $insert = new CurDB($upDate, $param);
       $action = $insert->actionDB();
       header('location:../../index.php?message=Compte activé.');
    } else {
        header('location:../../index.php?message=Token inexistant.');
    }
} else {
  header('location:../../index.php?message=Il y a comme un lézard numérique');
}
