<?php
class lienNav {
  public $tri = "SELECT `idNav`, `nomLien`, `cheminNav`, `valide`, `levelAdmi`, `ordre` FROM `nav` ORDER BY `levelAdmi` ASC";
  public $parametre = [];
  public $yes = ['non', 'oui'];
  public $admin = ['Visiteur', 'Utilisateur', 'Createur', 'Administrateur' ];
  public function readNav () {
    $dataNav = new readDB ($this->tri, $this->parametre);
    return $dataNav->read();
  }
  public function lien ($dataNav, $param) {
    foreach ($dataNav as $key) {
      if ($key['levelAdmi'] == $param) {
        echo '<li>
        Id menu :'.$key['idNav'].'- Nom '.$key['nomLien'].'- chemin ='.$key['cheminNav'].'- Valide ?'.$this->yes[$key['valide']].'-'.$this->admin[$key['levelAdmi']].'- Ordre'.$key['ordre'].'
        </li>';

        echo '<li><form action="CUD/Delette/lien.php" method="post">
            <input type="hidden" name="idNav" value="'.$key['idNav'].'">
            <button type="submit" name="button">Supprimer</button>
          </form>
          <form class="formulaire" action="CUD/Update/lien.php" method="post">
            <input type="hidden" name="idNav" value="'.$key['idNav'].'">
            <label for="nomLien">Nom Lien</label>
            <input id="nomLien" type="text" name="nomLien" value="'.$key['nomLien'].'">
            <label for="Chemin">Chemin</label>
            <input id="Chemin" type="text" name="cheminNav" value="'.$key['cheminNav'].'">
            <label for="valide">Valide ?</label>
            <select class="inputFormulaire" name="valide">
              <option value="0">Non</option>
              <option value="1" selected>Oui</option>
            </select>
            <label for="levelAdmi">Niveau d\'administration</label>
            <select name="levelAdmi">
              <option value="0" selected>Visiteur</option>
              <option value="1">Utilisateur</option>
              <option value="2">Createur</option>
              <option value="3">Administrateur</option>
            </select>
            <label for="ordre">ordre</label>
            <input id="ordre" type="number" min="0" max="10" name="ordre" value="'.$key['ordre'].'">
            <button type="submit" name="button">Modifier</button>
          </form>
        </li>';
      }
    }
  }

}
