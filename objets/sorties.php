<?php
function brassageDate($data) {
$date = $data;
$year = substr($date,0,4);
$month = substr($date,5,2);
$day = substr($date,8,2);
$date = $day.'/'.$month.'/'.$year;
return $date;
}
class Sorties {
public function sortieCreateByUser($idUser) {
  $selectSortie = "SELECT `idSortie`, `login`, `titreSortie`, `texteSortie`, `gratuit`, `prix`, `passSanitaire`,
  `nombreMax`, `dateSortie`, `heureSortie`, `dateCreation`, `lieu`, `codePostal`, `adult`, `sorties`.`valide`, `partager`
  FROM `sorties`
  INNER JOIN `users` ON `idUser` = `id_User`
  WHERE `sorties`.`valide` = 1 AND `id_User` = :idUser";
  $param = [['prep'=>':idUser', 'variable'=>$idUser]];
  $listeSortie = new readDB($selectSortie, $param);
  $dataSortie = $listeSortie->read();
  return $dataSortie;
}
public function lastSortie($limit, $valide) {
  $selectSortie = "SELECT `idSortie`, `login`, `titreSortie`, `texteSortie`, `gratuit`, `prix`, `passSanitaire`,
  `nombreMax`, `dateSortie`, `heureSortie`, `dateCreation`, `lieu`, `codePostal`, `adult`, `sorties`.`valide`, `partager`
  FROM `sorties`
  INNER JOIN `users` ON `idUser` = `id_User`
  WHERE `sorties`.`valide` = :valide
  ORDER BY `idSortie`
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
      <li><p>
      '.$value['texteSortie'].'
      </p></li>
      <strong><li>Personnes inscrite :'.$dataCount[0]['nbr'].'/'.$value['nombreMax'].'</li>
      <li>Date '.brassageDate($value['dateSortie']).'</li>
      <li>Heure du rendez-vous : '.$value['heureSortie'].'</li>
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
      <li><p>
      '.$value['texteSortie'].'
      </p></li>
      <strong><li>Personnes inscrite :'.$dataCount[0]['nbr'].'/'.$value['nombreMax'].'</li>
      <li>Date '.brassageDate($value['dateSortie']).'</li>
      <li>Heure du rendez-vous : '.$value['heureSortie'].'</li>
      <li>Prix : '.$value['prix'].' €</li></strong>
      <li>Adresse : '.$value['lieu'].'</li>
      <li>
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
