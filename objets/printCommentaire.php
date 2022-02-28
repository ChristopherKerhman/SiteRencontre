<?php
class PrintCommentaires extends GetCommentaires {
  public function __construct() {
    $this->idUser = $_SESSION['idUser'];
  }
  public function commentaires($data, $idNav) {
    echo '<article>';
foreach ($data as $key => $value) {
echo  '<ul class="commentaires">
        <li>le '.dateHeure($value['dateCommentaire']).'</li>
        <li> Par : '.$value['login'].'</li>
        <li><br /> '.$value['commentaire'].'</li>';
        if(($this->idUser == $value['id_User']) && ($value['verrou'] == 0)) {
          echo '<li>
          <form action="CUD/Update/commentaire.php" method="post">
            <input type="hidden" name="idCommentaire" value="'.$value['idCommentaire'].'">
            <input type="hidden" name="id_Sortie" value="'.$value['id_Sortie'].'">
            <input type="hidden" name="idNav" value="'.$idNav.'">
            <button type="submit" name="button">Supprimer</button>
          </form>
          <form
          <form class="formulaire" action="CUD/Update/modifCommentaire.php" method="post">
            <input type="hidden" name="idCommentaire" value="'.$value['idCommentaire'].'">
            <input type="hidden" name="id_Sortie" value="'.$value['id_Sortie'].'">
            <label for="commentaire">Modifier</label>
            <textarea id="commentaire" rows="8" cols="80" name="commentaire">'.$value['commentaire'].'</textarea>
            <input type="hidden" name="idNav" value="'.$idNav.'">
            <button type="submit" name="button">Modifier</button>
          </form>
          </div>
          </li>';
        } else {
          if ($this->idUser == $value['id_User']) {
            echo '<li><form action="CUD/Update/Vcommentaire.php" method="post">
            <input type="hidden" name="idCommentaire" value="'.$value['idCommentaire'].'">
            <input type="hidden" name="id_Sortie" value="'.$value['id_Sortie'].'">
            <input type="hidden" name="idNav" value="'.$idNav.'">
            <button type="submit" name="button">Deverrouiller</button>
            </form></li>';
          }
        }
        echo '</ul>';
}
echo '</article>';
  }
  public function commentairesAdmin($data, $idNav) {
    echo '<article>';
foreach ($data as $key => $value) {
echo  '<ul class="commentaires">
        <li>le '.dateHeure($value['dateCommentaire']).'</li>
        <li> Par : '.$value['login'].'</li>
        <li><br /> '.$value['commentaire'].'</li>';
        if(($_SESSION['role'] == 2) && ($value['verrou'] == 0)) {
          echo '<li>
          <form action="CUD/Update/commentaire.php" method="post">
            <input type="hidden" name="idCommentaire" value="'.$value['idCommentaire'].'">
            <input type="hidden" name="id_Sortie" value="'.$value['id_Sortie'].'">
            <input type="hidden" name="idNav" value="'.$idNav.'">
            <button type="submit" name="button">Supprimer</button>
          </form>
          <div class="" id="OUVERTURE">
          <button type="button" >Ouvrir</button><button v-else type="button" v-on:click="cle = false">Fermer</button>
          <form class="formulaire" v-if="cle" action="CUD/Update/modifCommentaire.php" method="post">
            <input type="hidden" name="idCommentaire" value="'.$value['idCommentaire'].'">
            <input type="hidden" name="id_Sortie" value="'.$value['id_Sortie'].'">
            <label for="commentaire">Modifier</label>
            <textarea id="commentaire" rows="8" cols="80" name="commentaire">'.$value['commentaire'].'.
            Modération le '.date('d-M-y').'</textarea>
            <input type="hidden" name="idNav" value="'.$idNav.'">
            <button type="submit" name="button">Modifier</button>
          </form>
        </li>';
      } else {
        echo '<li><form action="CUD/Update/Vcommentaire.php" method="post">
        <input type="hidden" name="idCommentaire" value="'.$value['idCommentaire'].'">
        <input type="hidden" name="id_Sortie" value="'.$value['id_Sortie'].'">
        <input type="hidden" name="idNav" value="'.$idNav.'">
        <button type="submit" name="button">Deverrouiller</button>
        </form></li>';
      }
    echo '</ul>';
}


  }
}
?>
