<?php
class AdministrationSortie extends Sorties {
  private $dateDuJour;
  public function __construct(){
    $this->date = date('Y-m-d');
  }

}
