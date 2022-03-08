<?php
require '../enteteCUD.php';
if($_SERVER['REQUEST_METHOD'] === 'POST') {
  $sql = "SELECT `email` FROM `users` WHERE `email` = :email";
  $preparation = ':email';
  $valeur = filter($_POST['email']);
  $test = new Controle();
  $testEmail = $test->doublon($sql, $preparation , $valeur);
  if($testEmail == 1) {
        array_pop($_POST);
        $_POST['token'] = genToken(10);
        $preparation =  new Preparation();
        $param = $preparation->creationPrep($_POST);
        $sqlUpdate = "UPDATE `users` SET `token`= :token, `valide`= 0 WHERE `email` = :email";
      $insert = new CurDB($sqlUpdate, $param);
      $action = $insert->actionDB();
      /*
      $to = filter($_POST['email']);
      $subject = 'Votre token d'activation';
      $message = 'Bonjour ; Votre token .$_POST['token']';
      */
     header('location:../../index.php?message= Vous devriez recevoir un mail avec votre token pour ré-activer votre compte.');

  } else {
    header('location:../../index.php?message=Email inconnus dans nos registres.');
  }
  } else {
      header('location:../../index.php?message=Il y a comme un lézard numérique');
  }
