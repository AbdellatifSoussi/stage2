<?php
    include("../DB/conn.php");
    session_start();

    $id_user=$_SESSION['code_user'];

        if (!isset($_SESSION['email']))
        {
            header('Location: connexion.php');
        }
        
        if($_SESSION['role_user']=='admin'){
                header("location: home.php");
        }

        if(isset($_POST['save']))
        {
            $objet= htmlspecialchars($_POST['objet']);
            $description= htmlspecialchars($_POST['description']);
            

            if(!empty($objet) AND !empty($description)){
                
                $validate_lm=$conn->prepare(" insert into motivation (objet,description,code_user) values (?,?,?)");  
                $validate_lm->execute(array($objet,$description,$id_user));     
                
               $msg= '<center><div class="alert alert-success fade in">
                        <a href="#" class="close" data-dismiss="alert">&times;</a>
                        Lettre de motivation enregistrée.</div></center>';          
            }
            else{
                $msg= '<center><div class="alert alert-danger fade in">
                        <a href="#" class="close" data-dismiss="alert">&times;</a>
                        <strong>Erreur ! </strong>Véréfiez que tout les champs sont remplie !</div></center>'; 
            }
        }
        else{
                $msg= '<div class="alert alert-danger fade in">
                        <a href="#" class="close" data-dismiss="alert">&times;</a>
                        Erreur inconnue !</div>'; 
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
          <style type="text/css">
        .cadre{
            border: 1px solid lightgray;
            background-color: white;
            padding: 7%;
            border-radius: 4px;
        }  
        input[type='text']{
                width: 74%;
        }
        .form-control{
            min-width: 100% !important;
        }
        body{
            background-color: #f5f5f5;
        }
        .form-control adresse{
            width: 50px !important;
        }
    </style>
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
    <br>
    <div class="container">
            <center><h2>Créer votre propre Lettre de Motivation !</h2></center>
        <div class="col-md-12 cadre">
            
            <form name="form" method="post" action="">
                 
                <div class="row">
                   <?php   
                            if(isset($_POST['save']))
                            { 
                                echo $msg;
                            }
                    ?>
                <div class="col-md-8">
                        <div class="form-group">
                        <textarea class="form-control adresse" rows="4" name="adresse" readonly onclick="getTextareaSelection(this)">
                        <?php 
                            echo "Nom Complet :".$_SESSION['prenom_user']." ".$_SESSION['nom_user']."\n";                            
                            echo "Adresse :".$_SESSION['ville_user']."\n";
                            echo "Email :".$_SESSION['email']."\n"; 
                        ?>
                        </textarea>
                        </div>
                </div>
                
                <div class="col-md-8">
                    <div class="form-group">
                        <label for="exampleFormControlTextarea1">Objet</label>
                        <textarea class="form-control adresse" rows="1" name="objet" onclick="getTextareaSelection(this)">
                        </textarea>
                    </div>
                </div>
               
                <div class="col-md-12">
                  <div class="form-group">
                    <textarea class="form-control"  rows="20" name="description" placeholder="" onclick="getTextareaSelection(this)">
Décrivez ici votre lettre de motivation
                    </textarea>
                  </div>
                     <center><input type="submit" class="btn btn-primary submit" value="Enregistré" name="save"></center>
                  </div>
                </div>
            </form>
        </div>
    </div>

    <?php include("../common/footer.php"); ?>
    
    
    
</body>
</html>