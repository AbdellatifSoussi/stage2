<?php 
session_start();

// Suppression des variables de session et de la session

session_destroy();

// Suppression des cookies de connexion automatique
setcookie('login', '');
setcookie('pass_hache', '');
header('Location: ../pages/index.php');
?>