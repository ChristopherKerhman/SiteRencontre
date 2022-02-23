<?php
include 'functionDateTime.php';
class SortieUtilisateur {
  public function __construct(){
    $this->date = date('Y-m-d');
    $this->idUser = $_SESSION['idUser'];
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
}
