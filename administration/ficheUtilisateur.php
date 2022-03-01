<?php
require 'objets/getUser.php';
require 'objets/ficheUser.php';
$idUser =  filter($_GET['idUser']);
$action = new GetUser();
$dataTraiter = $action->getOneUser($idUser);
$action = new FicheUser($dataTraiter);
$action->administrationFiche();

 ?>
