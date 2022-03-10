<?php
require 'objets/getMessagerie.php';
require 'objets/printMessagerie.php';
$message =  new PrintMessagerie();
$idContact = filter($_GET['idContact']);
$dataMessage = $message->getOneMessage($idContact);
$message->affichageOneMessage ($dataMessage, $idNav);
 ?>
