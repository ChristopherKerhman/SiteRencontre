
<?php
include 'administration/securite.php';
include 'functions/functionPagination.php';

if(isset($_GET['page']) && (!empty($_GET['page']))) {
  $currentPage = filter($_GET['page']);
  echo '<h3>Les utilisateurs page : '.$currentPage.'</h3>';
} else {
  $currentPage = 1;
  echo '<h3>Les utilisateurs page : '.$currentPage.'</h3>';
}
$parPage = 15;
// Déclaration de paramètre :
$param = [];
// Recherche du nombre de membre du site
$requetteSQL = "SELECT COUNT(`idUser`) AS `nbr` FROM `users`";
$pages = parametrePagination ($parPage, $requetteSQL, $param );
// Calcul du premier article dans la page.
$premier = ($currentPage * $parPage) - $parPage;
// Traitement des données a affiché.
$requetteSQL = 'SELECT `idUser`, `nom`, `prenom`, `login`, `valide`, `role`, `email`, `genre`
FROM `users`
ORDER BY `login`, `role`
LIMIT '.$premier.', '.$parPage.'';
$dataTraiter = affichageData($requetteSQL, $param);
//Print User
?>
<div class="colonne">


<table>
  <tr>
    <th>Login</th>
    <th>Prenom</th>
    <th>Nom</th>
    <th>Compte</th>
    <th>Rôle</th>
    <th>Email</th>
    <th>Genre</th>
    <th>Voir fiche</th>
  </tr>

  <?php
  $compte = ['Non actif', 'actif'];
  $role = ['Non valide', 'utilisateur', 'Moderateur', 'administrateur'];
  $genre = ['Féminin', 'Masculin', 'Non genré'];
  foreach ($dataTraiter as $key => $value) {
    echo '<tr>';
    echo'<td>'.$value['login'].'</td>';
    echo'<td>'.$value['prenom'].'</td>';
    echo'<td>'.$value['nom'].'</td>';
    echo'<td>'.$compte[$value['valide']].'</td>';
    echo'<td>'.$role[$value['role']].'</td>';
    echo'<td>'.$value['email'].'</td>';
    echo'<td>'.$genre[$value['genre']].'</td>';
    echo'<td><a class="lienSite" href="index.php?idNav=35&idUser='.$value['idUser'].'">Fiche</a></td>';
    echo'</tr>';
  }
   ?>
</table>

<?php
// Pagination
navPagination($pages, $idNav);?>
</div>
