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
