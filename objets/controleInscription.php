<?php
class Controle {
  public function doublon($sql, $preparation , $valeur) {
    /* $sql doit être une requette sql, $préparation doit prendre
    la forme :preparation et $valeur c'est la valeur du doublon à tester.*/
    $param = $param = [['prep'=>$preparation, 'variable'=>$valeur]];
    $controle = new readDB($sql, $param);
    $test = $controle->read();
    $preparation = trim($preparation, ':');
    if (empty($test[0][$preparation])) {
      $test =  0;
    } else {
      $test = 1;
    }
    return $test;
  }
  public function exclusion ($idUser, $idOrga) {
    $sql = "SELECT `id_User` FROM `exclusion` WHERE `id_Bloc` = :idUser";
    $param = [['prep'=>':idUser', 'variable'=>$idUser]];
    $action = new readDB($sql, $param);
    $dataListe = $action->read();
    foreach ($dataListe as $key => $valeur) {
      if(($valeur['id_User'] == $idOrga)) {
        return 1;
      } else {
        return 0;
      }
    }
  }

}
