<?php
include 'securite/zonePrive.php';
$idUser = $_SESSION['idUser'];
$requetteSQL = "SELECT `idUser`, `nom`, `prenom`, `login`, `valide`, `role`,`departement`
FROM `users`
WHERE `idUser` = :idUser";
$parametreUser = [['prep'=> ':idUser', 'variable' => $idUser]];
$readFicheUser = new readDB($requetteSQL, $parametreUser);
$dataUser = $readFicheUser->read();
require 'objets/ficheUser.php';
require 'objets/preparationRequette.php';
$affichage = new ficheUser ($dataUser);
?>
<div class="flexCenter">
<?php
  $affichage->fiche();
  $affichage->modUserFiche();
 ?>
</div>
<div id="VERROU">
  Voir les <strong class="lienVueJS" v-if="!cle3" v-on:click="cle3 = true">CGU</strong> <strong class="lienVueJS" v-else v-on:click="cle3 = false">CGU</strong> du site ?
<aside v-if="cle3">
  <?php include 'dataStatic/cgu.php'; ?>
</aside>
</div>
</div>
<?php include 'javascript/verrou.php'; ?>
