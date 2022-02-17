<?php
function filter($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
function filterTexte($data) {
  $data = trim($data);
  $data = stripslashes($data);
  return $data;
}

function haschage($data) {
  $option = ['cost' => 10];
  $data = password_hash($data, PASSWORD_BCRYPT, $option);
  return $data;
}
function doublePOP($data) {
  array_pop($data);
  array_pop($data);
  return $data;
   }
function champsVide($data) {
  $ok = 0;
  foreach ($data as $key => $value) {
    if ($value === '') {
        $ok = 1;
    }
  }
  return $ok;
}
function redirect($data, $idNav) {
  foreach ($data as $key => $value) {
    if ($value === '') {
      return header('location:../../index.php?message=Un champs est vide');
    }
  }
}
function genToken ($size) {
    $alpha = 'abcdefghijklmnopqrstuvwxyz1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $token = NULL;
    for ($i=0 ; $i < $size  ; $i++ ) {
      $number = rand(0, strlen($alpha));
      $letter = substr($alpha, $number, 1);
      $token = $token.$letter;
      //$token =  $token.substr($alpha, rand(0,strlen($alpha)));
    }
    return $token;
}
 ?>
