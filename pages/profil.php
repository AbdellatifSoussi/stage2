<?php
    include("../DB/conn.php");
    session_start();
        
    if (!isset($_SESSION['code_user']))
    {        
        header('Location: connexion.php');
    }
        
    $code=$_SESSION['code_user'];

    //Modification de l'adresse mail
    if(isset($_POST['modifieremail'])){     
        
        $email=htmlspecialchars($_POST['email']);    
            
        if(!empty($_POST['email'])){
         
            $modifemail=$conn->prepare("UPDATE utilisateur SET email =:email WHERE code = ".$code);                       
            $modifemail->bindValue(':email',$email,PDO::PARAM_STR);
            $modifemail->execute();   
            $msg= '<br><div class="alert alert-success fade in">
                    <a href="#" class="close" data-dismiss="alert">&times;</a>
                    <strong>Adresse mail !</strong>  modifier avec succées.</div>';
            header("location: ../DB/deconn.php");
        }
        else{
            $msg= '<br><div class="alert alert-danger fade in">
                    <a href="#" class="close" data-dismiss="alert">&times;</a>
                    <strong>Erreur !</strong></div>';
        }
    }

        if(isset($_POST['modifiermdp'])){
        $amdp=sha1($_POST['oldmdp']);
        $nmdp=sha1($_POST['newmdp1']);
        $vmdp=sha1($_POST['newmdp2']);
            
            if (($amdp!='')&&($nmdp!='')&&($vmdp!='')) {
                
                if ($amdp==$_SESSION['mdp']){
                    
                    if($nmdp==$vmdp){
                        
                        $modifmdp = $conn -> prepare("UPDATE utilisateur SET mdp=:newmdp1 WHERE code=".$code);
                        $modifmdp->bindValue(':newmdp1',$nmdp,PDO::PARAM_STR);
                        $modifmdp->execute();
                        
                        header("location:../DB/deconn.php");   
                    } 
                    else 
                    {
                        $msg= '<br><div class="alert alert-danger fade in">
                        <a href="#" class="close" data-dismiss="alert">&times;</a>
                        <strong>Erreur entre le nouveau mot de passe entr&eacute; et la vérification !</strong></div>';   
                    }
                } 
                else 
                {
                    $msg= '<br><div class="alert alert-danger fade in">
                    <a href="#" class="close" data-dismiss="alert">&times;</a>
                    <strong>Le mot de passe actuel n\'est pas valide !</strong></div>';
                }
            }
            else
            {
                $msg= '<br><div class="alert alert-danger fade in">
                <a href="#" class="close" data-dismiss="alert">&times;</a>
                <strong>Veuillez remplir tous les champs !</strong></div>';
            }
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
        <div class="col-12 dash">
            <h1>Mon Profil </h1>
        </div>
    </div><br>
    
    <section>
        <div class="container">
          <div class="row">
            <div class="col-lg-6">
                <div class="infos">
                    <h5>Nom: <?php echo $_SESSION['nom_user']; ?> </h5> 
                    <h5>Email:  <?php echo $_SESSION['email']; ?> </h5>
                </div>
                <div class="infos" id="infos2">
                <center><h2>Changement d'adresse email</h2>
                <form class="form" action="" method="post">     
                      <div class="form-group">
                        <input type="email" class="form-control" name="email" value="<?php echo $_SESSION["email"]; ?>">
                      </div>
                      <input type="submit" id="but" name="modifieremail" class="btn btn-primary" value="Modifier"><br><br>
                        <?php   
                            if(isset($_POST['modifieremail']))
                            { 
                                echo $msg;
                            }
                        ?>
                    </form></center>
                </div>
            </div>
            <div class="col-lg-6 ">
                <div class="infos" >
                    <center><h2>Changement de mot de passe </h2><br>
                    <form class="form" action="" method="post">     
                      <div class="form-group">
                        <input type="password" class="form-control" name="oldmdp" placeholder="Ancien mot de passe">
                      </div>
                      
                      <div class="form-group mx-sm-3">
                        <input type="password" class="form-control" name="newmdp1" placeholder="Nouveau mot de passe">
                      </div>
                        
                      <div class="form-group mx-sm-3">
                        <input type="password" class="form-control" name="newmdp2" placeholder="Confirmer le nouveau mot de passe">
                      </div>
                      
                      <input type="submit" id="but" name="modifiermdp" class="btn btn-primary" value="Modifier"><br><br>
                        <?php   
                            if(isset($_POST['modifiermdp']))
                            { 
                                echo $msg;
                            }
                        ?>
                    </form>
                    </center>
                </div>
            </div>
          </div>
        </div>
    </section><br>
    
    
    <?php include("../common/footer.php"); ?>
    
    
    
</body>
</html>