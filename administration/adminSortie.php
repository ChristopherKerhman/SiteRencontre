<?php
require 'objets/lienCentrale.php';
$role = $_SESSION['role'];
$centrale = 2;
$LienCentrale = new LienCentrale($role, $centrale, $idNav);
$dataNav = $LienCentrale->NavCentrale();
 ?>
<h3>Administration des sorties</h3>

<?php
  $LienCentrale->affichageLienCentrale($dataNav);
?>
