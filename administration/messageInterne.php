<?php
require 'objets/getMessagerie.php';
require 'objets/printMessagerie.php';
$message =  new PrintMessagerie();
//Message non traité
$dataMessage = $message->getMessage(0);
// Message lu
$dataMessageLu = $message->getMessage(1);
 ?>
<h3>Liste des messages non lu</h3>
<?php
$message->listeMessage($dataMessage);

 ?>
 <h3>Liste des messages non lu</h3>
 <?php
 $message->listeMessage($dataMessageLu);
  ?>
