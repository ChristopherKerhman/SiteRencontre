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
}
