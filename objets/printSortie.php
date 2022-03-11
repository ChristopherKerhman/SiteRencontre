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
        <li><strong>Département :'.$value['codePostal'].'</strong></li>
        <li><p>
        '.$value['texteSortie'].'
        </p></li>
        <strong><li>Personnes inscrite :'.$dataCount[0]['nbr'].'/'.$value['nombreMax'].'</li>
        <li>Date '.brassageDate($value['dateSortie']).'</li>
        <li>Heure du rendez-vous : '.heure($value['heureSortie']).'</li>
        <li>Prix : '.$value['prix'].' €</li></strong>
        <li>Adresse du rendez-vous : '.$value['lieu'].'</li>';
        echo'</ul>
      </div>';
      }
    echo '</div>';
  }
  public function affichageSortieGeneral ($data, $idUser) {
        $test = new Controle();
        echo '<div class="gallery">';
    foreach ($data as $key => $value) {
        $count = "SELECT COUNT(`idRencontre`) AS `nbr` FROM `rencontres` WHERE `id_Sortie` = :idSortie";
        $param = [['prep'=>':idSortie', 'variable'=>$value['idSortie']]];
        $counter = new readDB($count, $param);
        $dataCount = $counter->read();
        echo '  <div class="item">
        <ul>
        <li><h4>'.$value['titreSortie'].'</h4></li>
        <li><strong>Créer par : '.$value['login'].'</strong></li>
        <li><strong>'.$value['typeSortie'].'</strong></li>
        <li><p>'.$value['texteSortie'].'</p></li>
        <strong><li>Personnes inscrite :'.$dataCount[0]['nbr'].'/'.$value['nombreMax'].'</li>
        <li>Date '.brassageDate($value['dateSortie']).'</li>
        <li>Heure du rendez-vous : '.heure($value['heureSortie']).'</li>
        <li>Prix : '.$value['prix'].' €</li></strong>
        <li>Adresse : '.$value['lieu'].'</li>
        </ul>
        </div>';}

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
  public function administrationPasser($data, $nav){
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
        <a class="lienSite" href="index.php?idNav=44&idSortie='.$value['idSortie'].'">Relancer</a>
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
        if($dataCount[0]['nbr'] >= $value['nombreMax']) {
              echo '<strong>Sortie complète</strong>';
        } else {
          if ($dataTraiter == array()){
          echo '<form action="CUD/Create/inscriptionSortie.php" method="post">
            <input type="hidden" name="id_Sortie" value="'.$value['idSortie'].'" />
            <button type="submit" name="button">S\'inscrire</button>
          </form>';
        } else {
          echo '<strong>Vous êtes déjà inscrit</strong>';
        }
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
public function printInscription($value) {
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
  if($dataCount[0]['nbr'] >= $value['nombreMax']) {
        echo '<strong>Sortie complète</strong>';
  } else {
    if ($dataTraiter == array()){
    echo '<form action="CUD/Create/inscriptionSortie.php" method="post">
      <input type="hidden" name="id_Sortie" value="'.$value['idSortie'].'" />
      <button type="submit" name="button">S\'inscrire</button>
    </form>';
  } else {
    echo '<strong>Vous êtes déjà inscrit</strong>';
  }
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
  public function tableauSorties($data, $idNav) {
    $yes = ['Non', 'Oui'];
    echo '<table>';
    echo '<tr>
      <th>Nom sortie</th>
      <th>Créateur</th>
      <th>Compte valide</th>
      <th>Sortie valide</th>
      <th>Type</th>
      <th>Date</th>
      <th>Voir</th>
      <th>Supprimer</th>
    </tr>';
    foreach ($data as $key => $value) {
      echo '<tr>
        <td>'.$value['titreSortie'].'</td>
        <td>'.$value['login'].'</td>
        <td>'.$yes[$value['UV']].'</td>
        <td>'.$yes[$value['valide']].'</td>
        <td>'.$value['typeSortie'].'</td>
        <td>'.brassageDate($value['dateSortie']).'</td>
        <td><a class="lienSite" href="index.php?idNav=34&idSortie='.$value['idSortie'].'">Voir</a></td>';
        // Traitement conditionnelle des actions
        if ($value['valide'] == 1) {
          $message = 'Pas de suppression possible.';
        } else {
            $message = '<form class="" action="CUD/Delette/adminSortie.php" method="post">
              <input type="hidden" name="idSortie" value="'.$value['idSortie'].'">
              <input type="hidden" name="idNav" value="'.$idNav.'">
               <button type="submit" name="button">Supprimer</button>
            </form>';
          }
        echo'<td>'.$message.'</td>
        </tr>';
    }
    echo '</table>';
  }
  public function AdminSortie($data, $idSortie, $idNav) {
    echo '<div class="gallery">';
      foreach ($data as $key => $value) {
        $count = "SELECT COUNT(`idRencontre`) AS `nbr` FROM `rencontres` WHERE `id_Sortie` = :idSortie";
        $param = [['prep'=>':idSortie', 'variable'=>$value['idSortie']]];
        $counter = new readDB($count, $param);
        $dataCount = $counter->read();
        echo '<div class="item">
        <ul class="message">
        <li><h4>'.$value['titreSortie'].'</h4></li>
        <li>Sortie valide ? '.$this->yes[$value['valide']].'</li>
        <li><strong>Créer par : '.$value['login'].'</strong></li>
        <li><strong>'.$value['typeSortie'].'</strong></li>
        <li><p>
        '.$value['texteSortie'].'
        </p></li>
        <strong><li>Personnes inscrite :'.$dataCount[0]['nbr'].'/'.$value['nombreMax'].'</li>
        <li>Date '.brassageDate($value['dateSortie']).'</li>
        <li>Heure du rendez-vous : '.heure($value['heureSortie']).'</li>
        <li>Prix : '.$value['prix'].' €</li></strong>
        <li>Adresse du rendez-vous : '.$value['lieu'].'</li>';
        // Administration fine de la sortie :
        if($value['valide'] >0) {
          $message = 'Invalider';
          $valide = $value['valide'];
        } else {
          $message = 'Valider';
          $valide = $value['valide'];
        }
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

        echo '<li class="ligne">';
        echo '<form class="formulaire" action="CUD/Update/AdminValideSortie.php" method="post">
        <input type="hidden" name="valide" value="'.$valide.'" />
        <input type="hidden" name="id_Sortie" value="'.$idSortie.'" />
        <input type="hidden" name="idNav" value="'.$idNav.'" />
        <button type="submit" name="button">'.$message.'</button>
        </form>';

        echo'</li>';
        echo'</ul>';
        echo'</div>';
      }

    echo '</div>';
  }
}
