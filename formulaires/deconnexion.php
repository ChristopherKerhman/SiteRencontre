<?php
require 'objets/cud.php';
session_destroy();
header('location:index.php?message=Deconnexion effectuée');
