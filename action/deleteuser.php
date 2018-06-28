<?php
 session_start();
   include("../DB/conn.php");

            $suppclient=$conn->prepare ("DELETE FROM utilisateur  WHERE code = ".$_SESSION['id']);
            $suppclient->execute();
            header("location: ../pages/users.php");            
?>