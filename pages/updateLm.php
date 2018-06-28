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

        $req = "SELECT motivation.*, utilisateur.nom,Utilisateur.prenom FROM motivation,utilisateur where utilisateur.code=motivation.code_user and code_motiv ='".$idd_lm."'";
        $reponse = $conn->query($req);		
        $data = $reponse->fetch();

        $objet=$data['objet'];
        $description=$data['description'];

        $nom_user_lm=$data['nom'];
        $prenom_user_lm=$data['prenom'];

            if(isset($_POST['enregistre']))
            {
                $objet= htmlspecialchars($_POST['objet']);
                $description= htmlspecialchars($_POST['description']);
                

                if(!empty($objet) AND !empty($description)){

                    $modifLM=$conn->prepare (" UPDATE motivation SET objet =:objet, description=:description WHERE code_motiv = ".$idd_lm);

                    $modifLM->bindValue(':objet',$objet,PDO::PARAM_STR);
                    $modifLM->bindValue(':description',$description,PDO::PARAM_STR);
                    
                    $modifLM->execute();

                    header("location: gestionlm.php");    
                    //echo "insert reussi";
                }     
            }

?>
<!DOCTYPE html>
<html lang="fr">
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
            padding: 8%;
            border-radius: 4px;
            box-shadow: 4px 2px 15px #ccc;
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
    
    <div class="container">
            <center><h2>Modification lettre de motivation (<?php echo $prenom_user_lm." ".$nom_user_lm; ?>) </h2></center>
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
                        <textarea class="form-control adresse" rows="1" name="objet" onclick="getTextareaSelection(this)"><?php echo $objet; ?></textarea>
                    </div>
                </div>
               
                <div class="col-md-12">
                  <div class="form-group">
                    <textarea class="form-control"  rows="20" name="description" placeholder="" onclick="getTextareaSelection(this)"><?php echo $description; ?></textarea>
                  </div>
                    <center>
                        <input type="submit" class="btn btn-primary submit" value="Enregistré" name="enregistre">
                        <input type="submit" class="btn btn-danger submit" value="PDF" name="pdf">
                    </center>
                  </div>
                </div>
            </form>
        </div>
    </div>

    <?php include("../common/footer.php"); ?>

    <?php include("../common/footer.php"); ?>
    
</body>
</html>