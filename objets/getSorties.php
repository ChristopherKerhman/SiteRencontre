<?php
include 'functionDateTime.php';
class GetSorties {
  public function __construct(){
    $this->date = date('Y-m-d');
    $this->idUser = $_SESSION['idUser'];
  }
  public function lastSortie($limit, $valide) {
    $selectSortie = "SELECT `idSortie`, `login`, `titreSortie`, `texteSortie`, `gratuit`, `prix`, `passSanitaire`,
    `nombreMax`, `dateSortie`, `heureSortie`, `dateCreation`, `lieu`, `codePostal`, `adult`, `sorties`.`valide`, `partager`, `typeSortie`
    FROM `sorties`
    INNER JOIN `users` ON `idUser` = `id_User`
    INNER JOIN `types` ON `type` = `idTypeSortie`
    WHERE `sorties`.`valide` = :valide AND `partager` = 1 AND `adult` = 0
    ORDER BY `idSortie` DESC
    LIMIT {$limit}";
    $param=[['prep'=>':valide', 'variable'=>$valide]];
    $listeSortie = new readDB($selectSortie, $param);
    $dataSortie = $listeSortie->read();
    return $dataSortie;
  }
  public function sortieCreateByUser() {
    $selectSortie = "SELECT `idSortie`, `login`, `titreSortie`, `texteSortie`, `gratuit`, `prix`, `passSanitaire`,
    `nombreMax`, `dateSortie`, `heureSortie`, `dateCreation`, `lieu`, `codePostal`, `adult`, `sorties`.`valide`, `partager`, `typeSortie`
    FROM `sorties`
    INNER JOIN `users` ON `idUser` = `id_User`
    INNER JOIN `types` ON `idTypeSortie` = `type`
    WHERE `sorties`.`valide` = 1 AND `id_User` = :idUser
    ORDER BY `dateSortie`, `heureSortie`";
    $param = [['prep'=>':idUser', 'variable'=>$this->idUser]];
    $listeSortie = new readDB($selectSortie, $param);
    $dataSortie = $listeSortie->read();
    return $dataSortie;
  }
  public function triSortie($limit, $type, $pass,$gratuit,$adult, $codePostale, $date) {
    $selectSortie = "SELECT `idSortie`, `login`, `titreSortie`, `texteSortie`, `gratuit`, `prix`, `passSanitaire`,
    `nombreMax`, `dateSortie`, `heureSortie`, `dateCreation`, `lieu`, `codePostal`, `adult`, `sorties`.`valide`, `partager`, `typeSortie`
    FROM `sorties`
    INNER JOIN `users` ON `idUser` = `id_User`
    INNER JOIN `types` ON `type` = `idTypeSortie`
    WHERE `sorties`.`valide` = 1
    AND `partager` = 1
    AND `type` = :typeSortie
    AND `passSanitaire` = :passSanitaire
    AND `gratuit` = :gratuit
    AND `adult` = :adult
    AND `codePostal` = :codePostale
    AND `dateSortie` >= :dateSortie
    ORDER BY `dateSortie`
    LIMIT {$limit}";
    $param=[['prep'=>':typeSortie', 'variable'=>$type],
            ['prep'=>':passSanitaire', 'variable'=>$pass],
            ['prep'=>':gratuit', 'variable'=>$gratuit],
            ['prep'=>':adult', 'variable'=>$adult],
            ['prep'=>':codePostale', 'variable'=>$codePostale],
            ['prep'=>':dateSortie', 'variable'=>$date]];
    $listeSortie = new readDB($selectSortie, $param);
    $dataSortie = $listeSortie->read();
    return $dataSortie;
  }
  public function getMysortie() {
    $tri = "SELECT `idRencontre`, `idSortie`, `titreSortie`, `texteSortie`, `gratuit`, `prix`, `passSanitaire`,
    `nombreMax`, `dateSortie`, `heureSortie`, `dateCreation`, `lieu`, `codePostal`, `adult`, `sorties`.`valide`, `partager`, `typeSortie`, `login`
    FROM `rencontres`
    INNER JOIN `sorties` ON `id_Sortie` = `idSortie`
    INNER JOIN `types` ON `type` = `idTypeSortie`
    INNER JOIN `users` ON `idUser` = `sorties`.`id_User`
    WHERE `rencontres`.`id_User` = :idUser AND `sorties`.`valide` = 1";
    $param = [['prep'=>':idUser', 'variable'=>$this->idUser]];
    $listeSortie = new readDB($tri, $param);
    $dataSortie = $listeSortie->read();
    return $dataSortie;
  }
}
