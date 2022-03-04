<?php
require 'cud.php';
class FicheUser {
  private $idUser;
  private $nom;
  private $prenom;
  private $login;
  private $valide;
  private $role;
  private $departement;

  public function __construct($dataUser) {
    $this->idUser = $dataUser[0]['idUser'];
    $this->nom = $dataUser[0]['nom'];
    $this->prenom = $dataUser[0]['prenom'];
    $this->login = $dataUser[0]['login'];
    $this->valide = $dataUser[0]['valide'];
    $this->role = $dataUser[0]['role'];
    $this->departement = $dataUser[0]['departement'];
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
    <li>Departement : '.$this->departement.'</li>

    </ul>';
  }
  public function administrationFiche () {
    echo '<form class="formulaire" action="administration/ficheUser.php" method="post">
            <label for="nom">Nom</label>
            <input id="nom" type="text" name="nom" value="'.$this->nom.'">
            <label for="prenom">Prenom</label>
            <input id="prenom"  type="text" name="prenom" value="'.$this->prenom.'">
            <label for="login">Login</label>
            <input id="login"  type="text" name="login" value="'.$this->login.'">
            <input type="hidden" name="idUser" value="'.$this->idUser.'" />
            <label for="valide">Supprimer le compte ?</label>
            <select id="valide" name="valide">
            <option value="0">Oui</option>
            <option value="1" selected>Non</option>
            </select>
            <label for="role">Rôle ?</label>
            <select name="role">';
            for ($i=0; $i <count($this->roles) ; $i++) {
              if($i == $this->role) {
                echo '<option value="'.$i.'" selected>'.$this->roles[$i].'</option>';
              } else {
                  echo '<option value="'.$i.'">'.$this->roles[$i].'</option>';
              }
            }
            echo'</select>
            <button  type="submit" name="button">Modifier fiche</button>
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

            <label for="codePostal">Numéro du département de résidence ?</label>
            <select id="codePostal" name="departement">';
            for ($i=1; $i <= 103 ; $i++) {
              if($i == $this->departement) {
                  echo '<option value="'.$i.'" selected>'.$i.'</option>';
              } else {
                  echo '<option value="'.$i.'">'.$i.'</option>';
              }

            }
            echo'</select>
            <label for="valide">Supprimer mon compte ?</label>
            <select id="valide" name="valide">
            <option value="0">Oui</option>
            <option value="1" selected>Non</option>
            </select>
            <button  type="submit" name="button">Modifier fiche</button>
      </form>';
  }
}
?>
