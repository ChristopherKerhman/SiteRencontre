<?php
require 'cud.php';
class FicheUser {
  private $idUser;
  private $nom;
  private $prenom;
  private $login;
  private $valide;
  private $role;

  public function __construct($dataUser) {
    $this->idUser = $dataUser[0]['idUser'];
    $this->nom = $dataUser[0]['nom'];
    $this->prenom = $dataUser[0]['prenom'];
    $this->login = $dataUser[0]['login'];
    $this->valide = $dataUser[0]['valide'];
    $this->role = $dataUser[0]['role'];
    $this->roles = $roles = ['Non valide', 'utilisateur', 'gestionnaire', 'administrateur'];
    $this->yes = $yes = ['Non', 'Oui'];
  }
  public function fiche() {
    $compte = "SELECT COUNT(`idRestriction`) AS `nbr` FROM `exclusion` WHERE `id_Bloc` = :idUser";
    $param = [['prep'=>':idUser', 'variable'=>  $this->idUser]];
    $aligement = new readDB($compte, $param);
    $comportements = $aligement->read();
    $launch = $comportements[0]['nbr'];
    echo '<ul id="ficheProfil">
    <li><strong>Fiche de profil</strong></li>
    <li>Nom : '.$this->nom.'</li>
    <li>Prenom : '.$this->prenom.'</li>
    <li>Login : '.$this->login.'</li>
    <li>valide : '.$this->yes[$this->valide].'</li>
    <li>Role : '.$this->roles[$this->role].'</li>
    <li>Personne qui vous ont bloqué : '.$launch.'/10</li>
    </ul>';
    if($launch > 3) {
      $requetteSQL = "UPDATE `users` SET `valide`=0 WHERE `idUser`= :idUser";
      $parametreUser = [['prep'=> ':idUser', 'variable' => $this->idUser]];
      $updateUser = new CurDB($requetteSQL, $parametreUser);
      $updateUser->actionDB();
    }
  }
  public function administrationFiche () {
    echo '<form class="formulaires" action="CUD/Update/ficheUser.php" method="post">
            <label for="nom">Nom</label>
            <input id="nom" type="text" name="nom" value="'.$this->nom.'">
            <label for="prenom">Prenom</label>
            <input id="prenom" type="text" name="prenom" value="'.$this->prenom.'">
            <label for="login">Login</label>
            <input id="login" type="text" name="login" value="'.$this->login.'">
            <label for="valide">Compte valide ?</label>
            <select di="valide" name="valide">
              <option value="0">Non</option>
              <option value="1" selected>Oui</option>
            </select>
            <label for="role">Role ?</label>
            <select name="role">
                <option value="1">Utilisateur</option>
                <option value="2">Gestionnaire</option>
                <option value="3">Administrateur</option>
            </select>
          <input type="hidden" name="idUser" value="'.$this->idUser.'" />
          <button type="submit" name="button">Modifier fiche</button>
      </form>
      <form action="CUD/Delette/user.php" method="post">
            <input type="hidden" name="idUser" value="'.$this->idUser.'" />
            <button type="submit" name="button">Effacer</button>
        </form>';
  }
  public function modUserFiche () {
    echo '<form class="formulaire" action="CUD/Update/ficheUser.php" method="post">
            <label for="nom">Nom</label>
            <input id="nom" type="text" name="nom" value="'.$this->nom.'">
            <label for="prenom">Prenom</label>
            <input id="prenom"  type="text" name="prenom" value="'.$this->prenom.'">
            <label for="login">Login</label>
            <input id="login"  type="text" name="login" value="'.$this->login.'">
            <input type="hidden" name="idUser" value="'.$this->idUser.'" />
            <label for="valide">Supprimer mon compte ?</label>
            <select id="valide" name="valide">
            <option value="0">Oui</option>
            <option value="1" selected>Non</option>
            </select>
            <button  type="submit" name="button">Modifier fiche</button>
      </form>';
  }
  public function listeBloc () {
    $param = [['prep'=>':idUser', 'variable'=>  $this->idUser]];
    $sql = "SELECT `idRestriction`,`login`
    FROM `exclusion`
    INNER JOIN `users` ON `idUser` = `id_Bloc`
    WHERE `id_User` = :idUser";
    $liste = new readDB($sql, $param);
    $dataTraiter = $liste->read();
    echo '<ul id="ficheProfil"><li><strong>Personne bloqué</strong></li>';
    if($dataTraiter == array()) {
      echo '<li>Pas encore de personnes bloqués</li>';
    }
    foreach ($dataTraiter as $key => $value) {
      echo '<li>'.$value['login'].'</li>';
    }
    echo'</ul>';
  }
}
?>
