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

            $idd_lm = $_GET['id'];
            $supplm=$conn->prepare ("DELETE FROM motivation  WHERE code_motiv = ".$idd_lm);
            $supplm->execute();
            header("location: gestioncv.php"); 
        
  ?>