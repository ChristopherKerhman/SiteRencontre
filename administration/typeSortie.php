<?php include 'securite/securiterCreateur.php'; ?>
<h4>Ajouter un type de sortie</h4>
<form class="formulaire" action="CUD/Create/typeSortie.php" method="post">
  <label for="typeSortie">Ajouter un grand type de sortie :</label>
  <input id="typeSortie" type="text" name="typeSortie">
  <input type="hidden" name="idNav" value="<?=$idNav?>">
  <button type="submit" name="button">Créer</button>
</form>
<?php
$selectType = "SELECT `idTypeSortie`, `typeSortie`, `valide` FROM `types` ORDER BY `typeSortie`";
$param = [];
$read = new readDB($selectType, $param);
$dataType = $read->read();
 ?>
<article>
  <h4>Liste type de sortie activé</h4>
  <ul>
<?php
foreach ($dataType as $key => $value) {
  if($value['valide'] == 1) {
  echo '<li class="flexLigne">'.$value['typeSortie'].' -
    <form action="CUD/Update/modTypeSortie.php" method="post">
    <input type="hidden" name="valide" value="0">
      <input type="hidden" name="idTypeSortie" value="'.$value['idTypeSortie'].'">
    <input type="hidden" name="idNav" value="'.$idNav.'">
    <button class="suppression" type="submit" name="button">Désactiver</button>
  </form></li>';}
}
 ?>
  </ul>
  <h4>Liste type de sortie désactivé</h4>
  <?php
  foreach ($dataType as $key => $value) {
    if($value['valide'] == 0) {
    echo '<li class="flexLigne">'.$value['typeSortie'].' -
      <form action="CUD/Update/modTypeSortie.php" method="post">
      <input type="hidden" name="valide" value="1">
        <input type="hidden" name="idTypeSortie" value="'.$value['idTypeSortie'].'">
      <input type="hidden" name="idNav" value="'.$idNav.'">
      <button class="suppression" type="submit" name="button">Reactiver</button>
    </form>
    <form action="CUD/Delette/typeSortie.php" method="post">
      <input type="hidden" name="idTypeSortie" value="'.$value['idTypeSortie'].'">
    <input type="hidden" name="idNav" value="'.$idNav.'">
    <button class="suppression" type="submit" name="button">Effacer</button>
  </form>
    </li>';}
  }
   ?>
</article>
