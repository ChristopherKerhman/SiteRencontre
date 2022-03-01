<?php
include 'securite/zonePrive.php';
$idUser = $_SESSION['idUser'];
$requetteSQL = "SELECT `idUser`, `nom`, `prenom`, `login`, `valide`, `role`
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
<?php $affichage->fiche();
$affichage->modUserFiche();
$affichage->listeBloc();
 ?>
</div>

<form class="formulaire" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]).'?idNav='.$idNav; ?>" method="post">
  <label for="login"><h4>Recherche login</h4></label>
  <input type="text" name="login" placeholder="recherche de login">
  <button type="submit" name="button">Recherche</button>
</form>
<?php
if($_SERVER['REQUEST_METHOD'] === 'POST') {
  array_pop($_POST);
  $prep = new Preparation();
  $param = $prep->creationPrep($_POST);
  $search = "SELECT `idUser`, `login` FROM `users` WHERE `login` LIKE :login AND `role` = 1 AND `valide` = 1";
  $readListe = new readDB($search, $param);
  $dataTraiter = $readListe->read();
  echo '<ul class="formulaire">';
  foreach ($dataTraiter as $key => $value) {
    echo '<li class="flexLigne">'.$value['login'].'&emsp;
      <form action="CUD/Create/blocIdUser.php" method="post">
      <input type="hidden" name="id_Bloc" value="'.$value['idUser'].'">
      <input type="hidden" name="idNav" value="'.$idNav.'">
      <button type="submit" name="button" value="1">Bloqué</button></form>
      &emsp;
          <form action="CUD/Create/blocIdUser.php" method="post">
          <input type="hidden" name="id_Bloc" value="'.$value['idUser'].'">
          <input type="hidden" name="idNav" value="'.$idNav.'">
          <button type="submit" name="button" value="0">Débloqué</button></form>
        </li>';
  }
  echo '</ul>';
} else {
  echo '<h4>Pas encore de résultat de recherche</h4>';
}
 ?>
<ul>
  <li></li>
</ul>
