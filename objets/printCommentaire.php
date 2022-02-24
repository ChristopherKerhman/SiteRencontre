<?php
class PrintCommentaires extends GetCommentaires {
  public function commentaires($data) {
    echo '<article>';
foreach ($data as $key => $value) {
echo  '<ul class="commentaires">
        <li>le '.dateHeure($value['dateCommentaire']).'</li>
        <li> Par : '.$value['login'].'</li>
        <li><br /> '.$value['commentaire'].'</li>
      </ul>';
}
echo '</article>';
  }
}
?>
