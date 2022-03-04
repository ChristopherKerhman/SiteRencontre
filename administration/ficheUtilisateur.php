<?php
require 'objets/getUser.php';
require 'objets/ficheUser.php';
$idUser =  filter($_GET['idUser']);
$action = new GetUser();
$dataTraiter = $action->getOneUser($idUser);
$action = new FicheUser($dataTraiter);
 ?>
 <h3>Administration de la fiche de <?=$dataTraiter[0]['login']?></h3>
 <div class="flexCenter">
   <?php
   $action->fiche();
   $action->administrationFiche(); ?>
 </div>
