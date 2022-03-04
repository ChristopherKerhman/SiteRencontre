<?php
require '../../objets/paramDB.php';
require '../../objets/cud.php';
require '../../objets/readDB.php';
require '../../objets/controleInscription.php';
require '../../objets/preparationRequette.php';
include '../fonctionsDB.php';
if($_SERVER['REQUEST_METHOD'] === 'POST') {
// Controle Formulaire en amont
if(filter($_POST['valide'] === NULL)) {
  header('location:../../index.php?message=Il faut accepter les CGU pour créer un compte.');
} else {

  // Contrôle doublon de login et de mail dans la DB
  $sql = "SELECT  `login` FROM `users` WHERE `login`= :login";
  $preparation = ':login';
  $valeur = filter($_POST['login']);
  $test = new Controle();
  $testLogin = $test->doublon($sql, $preparation , $valeur);
  $sql = "SELECT `email`FROM `users` WHERE `email`=:email";
  $preparation = ':email';
  $valeur = filter($_POST['email']);
  $testEmail = $test->doublon($sql, $preparation , $valeur);
  $verificationDoublon = $testLogin + $testEmail;

// vérification des Doublon de login et email
  if($verificationDoublon > 0) {
    header('location:../../index.php?message=Login ou mail déjà utilisé.');
  } else {
    //Si pas de doublon on continue
    $_POST = doublePOP($_POST);
    $_POST['mdp'] = haschage(filter($_POST['mdp']));
    // génération du token
    $_POST['token'] = genToken(12);
    // fin de génération du token
      $preparation =  new Preparation();
      $param = $preparation->creationPrep($_POST);
      $insertUser = "INSERT INTO `users`(`login`, `departement`, `nom`, `prenom`, `email`, `genre`, `mdp`, `token`)
      VALUES (:login, :departement, :nom, :prenom, :email, :genre, :mdp, :token)";
      print_r($param);
    $insert = new CurDB($insertUser, $param);

    $action = $insert->actionDB();
     /*
     $to = filter($_POST['email']);
     $subject = 'Votre token d'activation';
     $message = 'Bonjour ; Votre token .$_POST['token']';
     */
    header('location:../../index.php?message=Utilisateur enregistré vous devriez recevoir un mail avec votre token pour activer votre compte.');

  }

}
  } else {
 header('location:../../index.php?message=Il y a comme un lézard numérique');
}


 ?>
