<?php
session_start();
// Déclaration des chemins
$cheminObjet = '../objets/';
$cheminCUD = '../CUD/';
// objets et fonction nécessaire au fonctionnement de la log
require $cheminObjet.'paramDB.php';
require $cheminObjet.'readDB.php';
require $cheminObjet.'cud.php';
include $cheminCUD.'fonctionsDB.php';

if($_SERVER['REQUEST_METHOD'] === 'POST') {
  $login = filter($_POST['login']);
  $moria = $_POST['motDePasse'];
  $requetteSQL = "SELECT `idUser`, `login`, `mdp`, `valide`, `role`, `departement`
  FROM `users`
  WHERE `login` = :login";
  $prepare = [['prep'=> ':login', 'variable' => $login]];
  $readLogin = new readDB($requetteSQL, $prepare);
  $dataUser = $readLogin->read();
  if (($dataUser[0]['login'] == $login)
  && (password_verify($moria, $dataUser[0]['mdp']))
  && ($dataUser[0]['valide'] == 1)) {
    $_SESSION['idUser'] = $dataUser[0]['idUser'];
    $_SESSION['role'] = $dataUser[0]['role'];
    $_SESSION['login']= $dataUser[0]['login'];
    $_SESSION['valide'] = $dataUser[0]['valide'];
    $_SESSION['departement'] = $dataUser[0]['departement'];
    $_SESSION['RGP'] = true;
    //Archiver automatiquement à la connexion
    $archivage = "UPDATE `sorties` SET `passer`=1 WHERE `dateSortie`< :dDay AND `passer` = 0";
    $param = [['prep'=>':dDay', 'variable'=>date('Y-m-d')]];
    $archive = new CurDB($archivage, $param);
    $archive->actionDB();
    //Fin archivage
    // Journaux de connexion enregistrement des données
    $recordJournaux = "INSERT INTO `journaux`(`ipUser`, `idUser`, `login`,`okConnexion`)
    VALUES (:ipUser, :idUser, :login, 1);
    UPDATE `users` SET `token`= 0 WHERE `idUser` = :idUser";
    $param = [['prep'=>':ipUser', 'variable'=>$_SERVER['REMOTE_ADDR']],
              ['prep'=>':idUser', 'variable'=>$dataUser[0]['idUser']],
              ['prep'=>':login', 'variable'=>$dataUser[0]['login']]];
    $actionJounal = new CurDB($recordJournaux, $param);
    $actionJounal->actionDB();


    header('location:../index.php?message="Bienvenu '.$dataUser[0]['login'].'"');
  } else {
    // Journaux de connexion enregistrement des données
    $recordJournaux = "INSERT INTO `journaux`(`ipUser`, `login`, `mdpHacker`)
    VALUES (:ipUser, :login, :mdpHacker)";
    $param = [['prep'=>':ipUser', 'variable'=>$_SERVER['REMOTE_ADDR']],
              ['prep'=>':login', 'variable'=>$login],
              ['prep'=>':mdpHacker', 'variable'=>$moria]];
    $actionJounal = new CurDB($recordJournaux, $param);
    $actionJounal->actionDB();
    header('location:../index.php?message="Login ou mot de passe incorrecte"');
  }
} else {
  header('location:../index.php?message="Tentative de connexion échoué"');
}
