<?php
$valide = 1;
$passer = 1;
include 'administration/sortieTableau.php';
 ?>
<article class="presentationTableau">
  <form class="formulaire" action="CUD/Delette/delArchive.php" method="post">
    <input type="hidden" name="idNav" value="<?=$idNav?>">
    <button type="submit" name="button">Effacer les archives.</button>
  </form>
</article>
