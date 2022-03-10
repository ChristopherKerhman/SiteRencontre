<?php
require 'objets/getMessagerie.php';
require 'objets/printMessagerie.php';
$message =  new PrintMessagerie();
//Message non traité
$dataMessage = $message->getMessage(0);
// Message lu
$dataMessageLu = $message->getMessage(1);
//Message archivé
$dataMessageArch = $message->getMessage(2);
 ?>
<h3>Liste des messages non lu</h3>
<?php
$message->listeMessage($dataMessage);

 ?>
 <h3>Liste des messages non lu</h3>
 <?php
 $message->listeMessage($dataMessageLu);
  ?>
  <h3>Liste des messages Archivé</h3>
  <?php
  $message->listeMessage($dataMessageArch);
   ?>
