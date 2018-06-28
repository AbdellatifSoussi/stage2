<?php

    DEFINE ('DB_USER', 'root');
    DEFINE ('DB_PSWD', '');

    try{
      $conn = new PDO('mysql:host=localhost;dbname=elearning;charset=utf8', DB_USER, DB_PSWD);
      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        //echo "connexion reussi ";
    }
    catch(Exception $e){
      die($e->getMessage());
    }


?>