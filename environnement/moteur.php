<?php
require 'objets/lienCentrale.php';
$role = $_SESSION['role'];
$centrale = 1;
$LienCentrale = new LienCentrale($role, $centrale, $idNav);
$dataNav = $LienCentrale->NavCentrale();
 ?>
<h3>Moteurs de recherches</h3>

    <?php
    $LienCentrale->affichageLienCentrale($dataNav);
     ?>
