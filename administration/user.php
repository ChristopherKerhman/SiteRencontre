<?php
include 'administration/securite.php';
$role = ['Non valide', 'utilisateur', 'Moderateur', 'administrateur'];
$requetteSQL = "SELECT `idUser`, `nom`, `prenom`, `login`, `valide`, `role`
FROM `users`
ORDER BY  `role`,`login` ASC";
$prepare = [];
$readUser = new readDB ($requetteSQL, $prepare);
$dataUser = $readUser->read()
 ?>
<h3>Administration des utilisateurs</h3>
<article class="">
  <ul>
    <?php
  foreach ($dataUser as $key => $value) {
    echo '<li class="ligne">A venir '.$value['login'].' '.$role[$value['role']].'</li>';
  }
     ?>
  </ul>
  </article>
