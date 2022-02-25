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
        if($this->idUser == $value['id_User']) {
          echo '<li>
          <form action="CUD/Update/commentaire.php" method="post">
            <input type="hidden" name="idCommentaire" value="'.$value['idCommentaire'].'">
            <input type="hidden" name="id_Sortie" value="'.$value['id_Sortie'].'">
            <input type="hidden" name="idNav" value="'.$idNav.'">
            <button type="submit" name="button">Supprimer</button>
          </form>

          </li>';
        }
        echo '</ul>';

}
echo '</article>';
  }
}
?>
