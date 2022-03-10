<?php
include 'functionDateTime.php';
class GetMessagerie {
  protected $etat;
  protected $objetsContact;
  public function __construct() {
    $this->etat = ['Envoyé', 'Lu', 'Archivé'];
    $this->objet = ['Soucis avec votre compte', 'Rapporter un problème technique', 'Signaler un soucis de comportement', 'Autre'];
  }
  public function getMessage ($tri) {
    // $tri va prendre
    $sql = "SELECT `idContact`, `email`, `objet`, `courrielInterne`, `etat`, `dateHeure` FROM `contacter` WHERE `etat` = :etat";
    $param = [['prep'=>':etat', 'variable'=>$tri]];
    $action = new readDB($sql, $param);
    $dataTraiter = $action->read();
    return $dataTraiter;
  }
  public function getOneMessage($idContact) {
    // $tri va prendre
    $sql = "SELECT `idContact`, `email`, `objet`, `courrielInterne`, `etat`, `dateHeure` FROM `contacter` WHERE `idContact` = :idContact";
    $param = [['prep'=>':idContact', 'variable'=>$idContact]];
    $action = new readDB($sql, $param);
    $dataTraiter = $action->read();
    return $dataTraiter;
  }
}
