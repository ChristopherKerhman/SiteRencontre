<?php
class GetUser {
  public function getOneUser($idUser) {
    $selectOneUser = "SELECT `idUser`, `nom`, `prenom`, `login`, `valide`, `role`, `email`, `genre`
    FROM `users` WHERE `idUser` = :idUser";
    $param = [['prep'=>':idUser', 'variable'=>$idUser]];
    $traitement = new readDB($selectOneUser, $param);
    $dataUser = $traitement->read();
    return $dataUser;
  }
}

 ?>
