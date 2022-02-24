<?php
include 'functionDateTime.php';
class Sorties {
public function oneSortie($idSortie) {
  $selectSortie = "SELECT `idSortie`, `login`, `titreSortie`, `texteSortie`, `gratuit`, `prix`, `passSanitaire`,
  `nombreMax`, `dateSortie`, `heureSortie`, `dateCreation`, `lieu`, `codePostal`, `adult`, `sorties`.`valide`, `partager`, `typeSortie`, `type`
  FROM `sorties`
  INNER JOIN `users` ON `idUser` = `id_User`
  INNER JOIN `types` ON `idTypeSortie` = `type`
  WHERE `idSortie` = :idSortie";
  $param = [['prep'=>':idSortie', 'variable'=>$idSortie]];
  $listeSortie = new readDB($selectSortie, $param);
  $dataSortie = $listeSortie->read();
  return $dataSortie;
}
public function sortieCreateByUser($idUser) {
  $selectSortie = "SELECT `idSortie`, `login`, `titreSortie`, `texteSortie`, `gratuit`, `prix`, `passSanitaire`,
  `nombreMax`, `dateSortie`, `heureSortie`, `dateCreation`, `lieu`, `codePostal`, `adult`, `sorties`.`valide`, `partager`, `typeSortie`
  FROM `sorties`
  INNER JOIN `users` ON `idUser` = `id_User`
  INNER JOIN `types` ON `idTypeSortie` = `type`
  WHERE `sorties`.`valide` = 1 AND `id_User` = :idUser
  ORDER BY `dateSortie`, `heureSortie`";
  $param = [['prep'=>':idUser', 'variable'=>$idUser]];
  $listeSortie = new readDB($selectSortie, $param);
  $dataSortie = $listeSortie->read();
  return $dataSortie;
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
public function affichageSortie($data) {

  echo '<div class="gallery">';
    foreach ($data as $key => $value) {
      $count = "SELECT COUNT(`idRencontre`) AS `nbr` FROM `rencontres` WHERE `id_Sortie` = :idSortie";
      $param = [['prep'=>':idSortie', 'variable'=>$value['idSortie']]];
      $counter = new readDB($count, $param);
      $dataCount = $counter->read();
      echo '<div class="item">
      <ul>
      <li><h4>'.$value['titreSortie'].'</h4></li>
      <li><strong>Créer par : '.$value['login'].'</strong></li>
      <li><strong>'.$value['typeSortie'].'</strong></li>
      <li><p>
      '.$value['texteSortie'].'
      </p></li>
      <strong><li>Personnes inscrite :'.$dataCount[0]['nbr'].'/'.$value['nombreMax'].'</li>
      <li>Date '.brassageDate($value['dateSortie']).'</li>
      <li>Heure du rendez-vous : '.heure($value['heureSortie']).'</li>
      <li>Prix : '.$value['prix'].' €</li></strong>
      <li>Adresse du rendez-vous : '.$value['lieu'].'</li>
      </ul>
      </div>';
    }
  echo '</div>';
}
public function administrationSortie($data, $nav){

  echo '<div class="gallery">';
    foreach ($data as $key => $value) {
      $count = "SELECT COUNT(`idRencontre`) AS `nbr` FROM `rencontres` WHERE `id_Sortie` = :idSortie";
      $param = [['prep'=>':idSortie', 'variable'=>$value['idSortie']]];
      $counter = new readDB($count, $param);
      $dataCount = $counter->read();
      echo '  <div class="item">
      <ul>
      <li><h4>'.$value['titreSortie'].'</h4></li>
            <li><strong>'.$value['typeSortie'].'</strong></li>
      <li><p>
      '.$value['texteSortie'].'
      </p></li>
      <strong><li>Personnes inscrite :'.$dataCount[0]['nbr'].'/'.$value['nombreMax'].'</li>
      <li>Date '.brassageDate($value['dateSortie']).'</li>
      <li>Heure du rendez-vous : '.heure($value['heureSortie']).'</li>
      <li>Prix : '.$value['prix'].' €</li></strong>
      <li>Adresse : '.$value['lieu'].'</li>
      <li class="flexLigne">
      <a class="lienSite" href="index.php?idNav=27&idSortie='.$value['idSortie'].'">modifier</a>
      <form class="formulaire" action="CUD/Delette/sortie.php" method="post">
      <input type="hidden" name="idSortie" value="'.$value['idSortie'].'">
      <input type="hidden" name="idNav" value="'.$nav.'">
      <button type="submit" name="button">Supprimer</button>
      </form>

      </li>
      </ul>
      </div>';
    }
  echo '</div>';
}
}
