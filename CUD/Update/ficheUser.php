<?php
session_start();
require '../../objets/paramDB.php';
require '../../objets/cud.php';
require '../../objets/readDB.php';
require '../../objets/preparationRequette.php';
require '../../objets/controleInscription.php';
include '../fonctionsDB.php';
  if($_SERVER['REQUEST_METHOD'] === 'POST') {
    array_pop($_POST);
    // Verification que aucun champs n'est vide.
    $ok = champsVide($_POST);
    // Fin de vérification
    //Verification des doublon pour le login :
    $sql = "SELECT  `login` FROM `users` WHERE `login`= :login";
    $preparation = ':login';
    $valeur = filter($_POST['login']);
    $test = new Controle();
    $testLogin = $test->doublon($sql, $preparation , $valeur);

    //Fin de verification
    if (($ok == 0)&&($testLogin == 0)) {
      $preparation = new Preparation ();
      $param = $preparation->creationPrepIdUser($_POST);
      // changement du département préférer
      $_SESSION['departement'] = filter($_POST['departement']);
      // Update des éléments de la fiche
      $requetteSQL = "UPDATE `users`
      SET `nom`= :nom,`prenom`= :prenom,`login`= :login, `valide`=:valide, `departement`= :departement
      WHERE `idUser`= :idUser";
      $updateUser = new CurDB($requetteSQL, $param);
      $updateUser->actionDB();
      header('location:../../index.php?message=Fiche de '.$login.' modifiée.');

    } else {
          header('location:../../index.php?message=Erreur de modification de la fiche.');
    }


  } else {
      header('location:../../index.php?message=Erreur de modification de la fiche.');
  }
