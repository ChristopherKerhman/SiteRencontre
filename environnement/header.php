<?php
session_start();
// Pass sanitaire
$pass = 1;
// Fin Pass Sanitaire
$titre = "Faite vous des amis !";
$sousTitre = "Une amitiés dure le temps d'une rencontre ou toute la vie";
function filter($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
$vueJSCDN = 'node_modules/vue/dist/vue.global.prod.js';
require 'objets/paramDB.php';
require 'objets/readDB.php';
// Préparation de la requette :
// Mutliple menu selon la connexion
if (!isset($_SESSION['role'])) {
  // Menu visiteur non connecter
  $requetteSQL = "SELECT `idNav`, `nomLien`, `cheminNav`, `valide`, `levelAdmi`
  FROM `nav`
  WHERE `valide` = 1 AND `levelAdmi` = :levelAdmi AND `centrale` = 0
  ORDER BY `ordre` DESC";
  $prepare = [['prep'=> ':levelAdmi', 'variable' => 0]];
} else {
  $requetteSQL = "SELECT `idNav`, `nomLien`, `cheminNav`, `valide`, `levelAdmi`
  FROM `nav`
  WHERE `valide` = 1 AND `levelAdmi` = :levelAdmi AND `centrale` = 0
  ORDER BY `ordre` ASC";
  $prepare = [['prep'=> ':levelAdmi', 'variable' => $_SESSION['role']]];
}
$readNav = new readDB($requetteSQL, $prepare);
$dataNav = $readNav->read();
$idNav = $dataNav[0]['idNav'];
?>
<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="css/master.css">
    <script src="<?php echo $vueJSCDN; ?>"></script>
    <title><?=$titre?></title>
  </head>
  <body>
  <header class="flex-center">
    <h1><?=$titre?></h1>
      <h2><?=$sousTitre?></h2>
        <nav>
          <ul class="listNav">
            <?php
              foreach ($dataNav as $key) {
                echo '<li><a class="lienSite" href="index.php?idNav='.$key['idNav'].'">'.$key['nomLien'].'</a></li>';
              }
             ?>
          </ul>
        </nav>
  </header>
<main>
  
