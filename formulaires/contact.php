<?php
include 'dataStatic/objet.php';
$token = genToken(6);
 ?>
<h3>Formulaire pour contacter les administrateurs</h3>
<form class="formulaire" action="CUD/Create/contact.php" method="post">
<label for="email">Mail pour vous répondre :</label>
<input id="email" type="text" name="email" placeholder="Email">
<label for="objet">Objet de votre message ?</label>
<select id="objet" name="objet">
<?php
for ($i=0; $i < count($objetsContact) ; $i++) {
  echo '<option value="'.$i.'">
  '.$objetsContact[$i].'
  </option>';
}
 ?>
</select>
<textarea name="courrielInterne" rows="8" cols="80" placeholder="Votre message..."></textarea>
  <label for="token">Copier le token "<?=$token?>" ici : </label>
  <input id="token" type="text" name="token" />
  <input type="hidden" name="verif" value="<?=$token?>">
  <button type="submit" name="button">Envois message</button>
</form>
