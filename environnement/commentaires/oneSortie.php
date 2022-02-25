<?php
require 'objets/getSorties.php';
require 'objets/printSortie.php';
require 'objets/getCommentaire.php';
require 'objets/printCommentaire.php';
$idSortie = filter($_GET['idSortie']);
$oneSortie =  new PrintSortie();
$dataTraiter = $oneSortie->oneSortie($idSortie);
$oneSortie->InscriptionSortie($dataTraiter);
 ?>
<form class="formulaire" action="CUD/Create/commentaireSortie.php" method="post">
  <textarea name="commentaire" rows="8" cols="80" placeholder="Ajouter un commentaire ?"></textarea>
    <input type="hidden" name="idSortie" value="<?=$idSortie?>">
  <input type="hidden" name="idNav" value="<?=$idNav?>">
  <div>
    <button type="submit" name="button">Ajouter</button>
    <button type="reset" name="button">Effacer</button>
  </div>
</form>
<?php

  //On sort les données lier aux commentaires de la sortie
  $commentaires = new PrintCommentaires();
  $dataCommentaires = $commentaires->commentaireSortie ($idSortie);
  $commentaires->commentaires($dataCommentaires, $idNav);
?>
