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
  public function InscriptionSortie($data) {
    echo '<div class="gallery">';
      foreach ($data as $key => $value) {
        $count = "SELECT COUNT(`idRencontre`) AS `nbr` FROM `rencontres` WHERE `id_Sortie` = :idSortie";
        $param = [['prep'=>':idSortie', 'variable'=>$value['idSortie']]];
        $counter = new readDB($count, $param);
        $dataCount = $counter->read();
        echo '<div class="item">
        <ul class="message">
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
        <li>';
        // utilisateur déjà enregistré ?
        $recherche = "SELECT `id_User` FROM `rencontres` WHERE `id_Sortie` = :idSortie AND `id_User` = :idUser";
        $param = [['prep'=>':idSortie', 'variable'=>$value['idSortie']], ['prep'=>':idUser', 'variable'=>$this->idUser]];
        $detection = new readDB($recherche, $param);
        $dataTraiter = $detection->read();
        if($dataCount[0]['nbr'] <= $value['nombreMax']) {
          if ($dataTraiter == array()){
          echo '<form action="CUD/Create/inscriptionSortie.php" method="post">
            <input type="hidden" name="id_Sortie" value="'.$value['idSortie'].'" />
            <button type="submit" name="button">S\'inscrire</button>
          </form>';
        } else {
          echo '<strong>Vous êtes déjà inscrit</strong>';
        }
        } else {
          echo 'Sortie complète';
        }
        echo'</li>';
        echo '<li><strong>Les personnes inscrites :</strong></li>';
        //Personnes inscrites à la sortie
        $liste = "SELECT `login`
        FROM `rencontres`
        INNER JOIN `users` ON `idUser` = `id_User`
        WHERE `id_Sortie` = :id_Sortie";
        $param = [['prep'=>'id_Sortie', 'variable'=>$value['idSortie']]];
        $inscrit = new readDB($liste, $param);
        $dataTraiter = $inscrit->read();
        foreach ($dataTraiter as $key => $value) {
          echo '<li>'.$value['login'].'</li>';
        }
        echo'</ul>';
        echo'</div>';
      }
    echo '</div>';
  }
  public function deinscriptionSortie($data, $idNav) {
        echo '<div class="gallery">';
    foreach ($data as $key => $value) {
      $count = "SELECT COUNT(`idRencontre`) AS `nbr` FROM `rencontres` WHERE `id_Sortie` = :idSortie";
      $param = [['prep'=>':idSortie', 'variable'=>$value['idSortie']]];
      $counter = new readDB($count, $param);
      $dataCount = $counter->read();
      echo '<div class="item">
      <ul class="message">
      <li><h4>'.$value['titreSortie'].'</h4></li>
      <li>
      <form action="CUD/Delette/annulerParticipation.php" method="post">
        <input type="hidden" name="id_Sortie" value="'.$value['idSortie'].'" />
        <input type="hidden" name="idNav" value="'.$idNav.'" />
        <button type="submit" name="button">Annuler ma participation</button>
      </form>
      </li>
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
      <li>';
      echo'</li>';
      echo '<li><strong>Les personnes inscrites :</strong></li>';
      //Personnes inscrites à la sortie
      $liste = "SELECT `login`
      FROM `rencontres`
      INNER JOIN `users` ON `idUser` = `id_User`
      WHERE `id_Sortie` = :id_Sortie";
      $param = [['prep'=>'id_Sortie', 'variable'=>$value['idSortie']]];
      $inscrit = new readDB($liste, $param);
      $dataTraiter = $inscrit->read();
      foreach ($dataTraiter as $key => $valeur) {
        echo '<li>'.$valeur['login'].'</li>';
      }
      echo '<li><a class="lienSite" href="index.php?idNav=31&idSortie='.$value['idSortie'].'">Espace commentaires</a></li>';
      echo'</ul>';
      echo'</div>';
    }
  echo '</div>';
  }
}
