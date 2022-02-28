<?php
class GetCommentaires {
  public function commentaireSortie ($idSortie) {
    $triCommentaire = "SELECT `idCommentaire`, `id_Sortie`, `id_User`, `dateCommentaire`, `commentaires`.`valide`, `commentaire`, `login`, verrou
    FROM `commentaires`
    INNER JOIN `users` ON `id_User` = `idUser`
    WHERE `id_Sortie` = :idSortie AND `commentaires`.`valide` = 1
    ORDER BY `dateCommentaire` DESC";
    $param = [['prep'=>':idSortie', 'variable'=>$idSortie]];
    $commentaires = new readDB($triCommentaire, $param);
    $data = $commentaires->read();
    return $data;
  }
}
