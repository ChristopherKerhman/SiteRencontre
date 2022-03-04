<?php include 'securite/zonePrive.php'; ?>
<form class="formulaire" action="CUD/Create/sortie.php" method="post">
  <h3>Créer une nouvelle sortie <?=$_SESSION['login']; ?> ?</h3>
  <label for="titreSortie">Titre de votre sortie</label>
  <input id="titreSortie" type="text" name="titreSortie" placeholder="Titre de votre sortie" required>

<div id="GRATUIT">
    <label for="texteSortie">Description de votre sortie (255 caractère maximum)</label>
  <textarea id="texteSortie" v-model="texteSortie" name="texteSortie" rows="8" cols="80"></textarea>
  <ul id="price">
<li>
  <label for="gratuit">La sortie est elle gratuite ?</label>
    <select id="gratuit" name="gratuit" v-model="gratuit">
      <option value="0" selected>Oui</option>
      <option value="1">Non</option>
    </select>
</li>
<li v-if="gratuit == 1">
  <label for="prix">Prix par personne de votre sortie ?</label>
    <input id="prix" type="number" name="prix" min="1" max="120"> €
</li>
</ul>
</div>
<div>
<label for="nombreMax">Nombre de personne maximum ?</label>
<input id="nombreMax" type="number" name="nombreMax" min="3" max="120" value="3"> personnes</div>
  <h4>Date et heure </h4>
<label for="dateHeureSortie">Date de la sortie ?</label>
<input type="date" name="dateSortie" min="<?php echo date('Y-m-d'); ?>" value="<?php echo date('Y-m-d'); ?>" required>
<label for="heureSortie">Heure du rendez-vous ?</label>
<input id="heureSortie" type="time" name="heureSortie" required>
</div>
  <h4>Adresse </h4>
  <label for="lieu">adresse de la sortie ?</label>
  <input id="lieu" type="text" name="lieu" required>
  <label for="codePostal">Numéro du département de la sortie ?</label>
  <select id="codePostal" name="codePostal">
    <?php
    for ($i=1; $i <= 103 ; $i++) {
      if ($i == $_SESSION['departement']) {
          echo '<option value="'.$i.'" selected>'.$i.'</option>';
      } else {
          echo '<option value="'.$i.'">'.$i.'</option>';
      }

    }
     ?>
  </select>
<div>
<label for="adult">Sortie interdit aux mineurs ?</label>
<select name="adult">
  <option value="0" selected>Non</option>
  <option value="1"> Oui</option>
</select>

<label for="partager">Partager cette sortie ?</label>
<select id="partager" name="partager">
  <option value="0">Non</option>
  <option value="1" selected> Oui</option>
</select>

<?php if($pass == 1) { ?>
  <label for="pass">Pass Sanitaire obligatoire ?</label>
<select id="pass" name="passSanitaire">
  <option value="0" selected>Non</option>
  <option value="1">Oui</option>
</select>
<?php } ?>
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
</div>
  <button type="submit" name="button">Créer</button>
</form>
<script>
  const GRATUIT = Vue.createApp({
    data () {
      return {
      gratuit: 0
      }
    }
  })
  GRATUIT.mount('#GRATUIT')
</script>
