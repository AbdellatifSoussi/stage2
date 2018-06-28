<?php
include("../DB/conn.php");
session_start();    

    if (!isset($_SESSION['email']))
        {
            header('Location: connexion.php');
        }

    if($_SESSION['role_user']=='normal'){
                header("location:../pages/home.php");    
    }

            $idd = $_GET['id'];
            $suppuser=$conn->prepare ("DELETE FROM utilisateur  WHERE code = ".$idd);
            $suppuser->execute();
            header("location: ../pages/users.php"); 
        
  ?>