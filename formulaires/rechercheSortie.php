<?php
include 'securite/zonePrive.php';
$dateDujour = date('y-m-d');
require 'objets/getSorties.php';
require 'objets/printSortie.php';
 ?>
 <article class="ligne">
<form v-if="cle" class="colonne" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]).'?idNav='.$idNav; ?>" method="post">
   <h3>Rechercher une sortie ?</h3>
<label for="limit">Nombre maximal de sortie affiché ?</label>
  <select id="limit" name="limit">
    <?php
    for ($i=1; $i <=8 ; $i++) {
      if($i == 4) {
        echo '<option value="'.$i.'" selected>'.$i.'</option>';
      } else {
        echo '<option value="'.$i.'">'.$i.'</option>';
      }

    }
     ?>
  </select>
<label for="dateHeureSortie">Date de la sortie ?</label>
   <input type="date" name="dateSortie" min="<?php echo date('Y-m-d'); ?>" value="<?php echo date('Y-m-d'); ?>" required>
  <?php
  // Liste des sorties disponible
  $triType = "SELECT `idTypeSortie`, `typeSortie` FROM `types` WHERE `valide` = 1 ORDER BY `typeSortie`";
  $param = [];
  $triTypesSorties = new readDB($triType, $param);
  $dataTypesSortie = $triTypesSorties->read();
   ?>
  <label for="type">Type de sortie ?</label>
  <select id="type" name="type">
    <?php foreach ($dataTypesSortie as $key => $value) {
      echo '<option value="'.$value['idTypeSortie'].'">'.$value['typeSortie'].'</option>';
  } ?>
  </select>
  <label for="codePostale">Numéro du département ?</label>
  <?php
  $triCodeP = "SELECT DISTINCT `codePostal` FROM `sorties`
  WHERE `partager` = 1 AND `valide` = 1 AND `dateSortie` >= :dateSortie";
  $param = [['prep'=>':dateSortie', 'variable'=>$dateDujour]];
  $triCP = new readDB($triCodeP, $param);
  $dataCP = $triCP->read();
   ?>
   <select id="codePostale" name="codePostale">
     <?php
      foreach ($dataCP as $key => $value) {
        echo '<option value="'.$value['codePostal'].'">'.$value['codePostal'].'</option>';
      }
      ?>
   </select>

  <label for="gratuit">Gratuite ?</label>
  <select id="gratuit" name="gratuit">
    <option value="1">Non</option>
    <option value="0" selected>Oui</option>
  </select>
  <label for="passSanitaire">Pass Sanitaire ?</label>
<select id="passSanitaire" name="passSanitaire">
  <option value="0">Non</option>
  <option value="1">Oui</option>
</select>

  <label for="adult">Sortie réservé aux adultes ?</label>
<select id="adult" name="adult">
  <option value="0">Non</option>
  <option value="1">Oui</option>
</select>
<button type="submit" name="button">Recherche</button>
</form>
<?php
if($_SERVER['REQUEST_METHOD'] === 'POST') {
  $limit = filter($_POST['limit']);
  $date = filter($_POST['dateSortie']);
  $type = filter($_POST['type']);
  $pass = filter($_POST['passSanitaire']);
  $gratuit = filter($_POST['gratuit']);
  $adult = filter($_POST['adult']);
  $codePostale = filter($_POST['codePostale']);
  // Affichage sortie
  $affichageSorties = new PrintSortie();
  $dataSortie = $affichageSorties->triSortie($limit, $type, $pass,$gratuit,$adult, $codePostale, $date);
  if($dataSortie == array()){
    $triType = "SELECT `idTypeSortie`, `typeSortie`
    FROM `types`
    WHERE `idTypeSortie` = :idTypeSortie";
    $param = [['prep'=>':idTypeSortie', 'variable'=>$type]];
    $triTypesSorties = new readDB($triType, $param);
    $dataTypesSortie = $triTypesSorties->read();
    echo '<div class="gallery">
    <div class="item">
    <ul class="message">
    <li>Pas de sortie à le '.brassageDate($date).' et dans ce lieu.</li>
    <li>Type de sortie : '.  $dataTypesSortie[0]['typeSortie'].'</li>
    <li>Où ? '.$codePostale.'</li>
    <li>  Il ne reste plus qu\'à créer votre sortie ?<br /></li>
    <li><a class="lienSite" href="index.php?idNav=24">Ajouter sortie</a></li>
    </ul>
    </div></div>';
  } else {
    $affichageSorties->InscriptionSortie($dataSortie);
  }
} else {
  echo '<div class="gallery">
  <div class="item">
  <ul class="message">
  <li>Pas encore de données trouvées.</li>
  <li>  Il ne reste plus qu\'à créer votre sortie ?<br /></li>
  <li><a class="lienSite" href="index.php?idNav=24">Ajouter une sortie</a></li>
  </ul>
  </div></div>';
}
 ?>
</article >
