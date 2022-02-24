<?php

class PrintSortie extends GetSorties {
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
