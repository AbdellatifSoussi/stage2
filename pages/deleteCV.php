<?php
include("../DB/conn.php");
session_start();    

    if (!isset($_SESSION['email']))
        {
            header('Location: connexion.php');
        }

    if($_SESSION['role_user']=='normal'){
                header("location: home.php");
        }

            $idd_cv = $_GET['id'];
            $suppcv=$conn->prepare ("DELETE FROM cv  WHERE code_cv = ".$idd_cv);
            $suppcv->execute();
            header("location: gestioncv.php"); 
        
  ?>