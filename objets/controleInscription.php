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
  public function blocageIdSortie($idSortie) {
    $sql = "SELECT `id_UserBloc` FROM `blocage` WHERE `id_User` = 14 AND `id_UserBloc` IN (SELECT `id_User` FROM `rencontres` WHERE `id_Sortie` = 75)";
    $param = [['prep' => ':idUser', 'variable' => $_SESSION['idUser']], ['prep' => ':idSortie', 'variable' => $dataSortie]];
    $action = new readDB($sql, $param);
    $dataListe = $action->read();
    if($dataListe != array()) {
      return 1;
    } else {
      return 0;
    }
  }
}
