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

    echo '<ul id="ficheProfil">
    <li><strong>Fiche de profil</strong></li>
    <li>Nom : '.$this->nom.'</li>
    <li>Prenom : '.$this->prenom.'</li>
    <li>Login : '.$this->login.'</li>
    <li>valide : '.$this->yes[$this->valide].'</li>
    <li>Role : '.$this->roles[$this->role].'</li>

    </ul>';
  }
  public function administrationFiche () {

if($this->valide == 0) {
  echo '<form class="formulaire" action="CUD/Update/ficheUser.php" method="post">
          <label for="nom">Nom</label>
          <input id="nom" type="text" name="nom" value="'.$this->nom.'">
          <label for="prenom">Prenom</label>
          <input id="prenom" type="text" name="prenom" value="'.$this->prenom.'">
          <label for="login">Login</label>
          <input id="login" type="text" name="login" value="'.$this->login.'">
          <label for="valide">Compte valide ?</label>
          <select di="valide" name="valide">';
            for ($i=0; $i < count($this->yes) ; $i++) {
              if($i == $this->valide) {
                echo '<option value="'.$i.'" selected>'.$this->yes[$i].'</option>';
              } else {
              echo '<option value="'.$i.'">'.$this->yes[$i].'</option>';
              }
            }

          echo '</select>
          <label for="role">Role ?</label>
          <select name="role">';
            for ($i=0; $i <count($this->roles) ; $i++) {
              if($i == $this->role) {
                echo '<option value="'.$i.'" selected>'.$this->roles[$i].'</option>';
              } else {
              echo '<option value="'.$i.'">'.$this->roles[$i].'</option>';
              }
            }
          echo'</select>
        <input type="hidden" name="idUser" value="'.$this->idUser.'" />
        <button type="submit" name="button">Modifier fiche</button>
        <form action="CUD/Delette/user.php" method="post">
              <input type="hidden" name="idUser" value="'.$this->idUser.'" />
              <button type="submit" name="button">Effacer</button>
          </form>  </form>';
} else {
  $compte = "SELECT COUNT(`idRestriction`) AS `nbr` FROM `exclusion` WHERE `id_Bloc` = :idUser";
  $param = [['prep'=>':idUser', 'variable'=>  $this->idUser]];
  $aligement = new readDB($compte, $param);
  $comportements = $aligement->read();
  $launch = $comportements[0]['nbr'];
  echo '<ul>
  <li>login : '.$this->login.'</li>
  <li>Nom : '.$this->nom.'</li>
  <li>prenom : '.$this->prenom.'</li>
  <li>Compte valide : Oui</li>
  <li>Rôle : '.$this->roles[$this->role].'</li>
  <li>Nombre de personne qui ont bloqué '.$this->login.' : '.$launch.'/10</li>
  </ul>';
}
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
    $sql = "SELECT `idRestriction`,`login`, `id_Bloc`
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
      echo '<li>'.$value['login'].'=>'.$value['id_Bloc'].'</li>';
    }
    echo'</ul>';
  }
}
?>
