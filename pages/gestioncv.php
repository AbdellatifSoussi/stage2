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
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>E-Learning TSA </title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="utf-8">
    <link href="https://fonts.googleapis.com/css?family=Abril+Fatface|Roboto:400,700" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.9/css/all.css" integrity="sha384-5SOiIsAziJl6AWe0HWRKTXlfcSHKmYV4RBF18PPJ173Kzn7jzMyFuTtk8JA7QQG1" crossorigin="anonymous">
    <link rel="stylesheet" href="includes/css/dashbord.css">
    <link rel="stylesheet" href="includes/css/bare.css">
    <link rel="stylesheet" href="includes/css/style.css">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
	<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script type="application/javascript" src="includes/js/js.js"></script>
    <script type="text/javascript" src='includes/js/synthese.js'></script>
  </head>
<body>
    
    <?php 
            if($_SESSION['role_user']=='admin'){
                include ("../common/bare_admin.php");
            }

            if($_SESSION['role_user']=='normal'){
                include ("../common/bare.php");
            }
    ?>
    
    
    <?php include ("../common/synthese_bare.php"); ?>
    
    
    <div id="deconnexion">
        <a href="../DB/deconn.php" id="dec"><?php echo $_SESSION['nom_user']; ?> <i class="fas fa-sign-out-alt"></i> </a>
    </div>
    
    <div class="container">

        <div class="col-8 dash">
            <h1>Gestion des CV</h1>
        </div>
        
        <div class="col-12">
            <?php
                $sqlget = "SELECT *, utilisateur.nom,Utilisateur.prenom FROM cv,utilisateur where utilisateur.code=cv.code_user";
                $sqlData = $conn->query($sqlget);
            ?>
        <table class="table table-striped">
        <tr>
            <th scope="col">Code</th>
            <th scope="col">Poste</th>
            <th scope="col">Nom_Utilisateur</th>
            <th scope="col">Action</th>
         </tr>
             <?php
            while($row = $sqlData->fetch()){
                
                echo"<tr><th>";
                echo $row['code'];
                echo " </th><td>";
                
                $idd_cv=$row['code_cv'];
                
                echo $row['poste'];
                echo "</td><td>";
                
                echo $row['nom'];
                echo "</td><td>";
                
                
                echo"<a href=deleteCV.php?id=$idd_cv><img src='img/delete.png' width='16px')' /> </a>";
                echo "<a href=updateCV.php?id=$idd_cv><img src='img/modifier.png' width='16px'/></a>";
                echo "</td></tr>";
            }
            ?>
            </table>
            </div><br>
        </div>
    
    <?php include("../common/footer.php"); ?>
        
    
</body>
</html>