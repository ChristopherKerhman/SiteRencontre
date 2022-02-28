<?php
if ($_SESSION['role'] > 0) {

} else {
  header('location:index.php');
}
 ?>
