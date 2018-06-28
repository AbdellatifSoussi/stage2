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

    $idd = $_GET['id'];

    $req = "SELECT * FROM utilisateur where code ='".$idd."'";
    $reponse = $conn->query($req);		
    $data = $reponse->fetch();

    $nomm=$data['nom'];
    $prenomm=$data['prenom'];
    $codepostall=$data['codepostal'];
    $villee=$data['ville'];
    $emaill=$data['email'];
    
    if(isset($_POST['enregistre']))
    {
        $nom= htmlspecialchars($_POST['nom']);
        $prenom= htmlspecialchars($_POST['prenom']);
        $ville= htmlspecialchars($_POST['ville']);
        $codepostal= htmlspecialchars($_POST['codepostal']);
        $email= htmlspecialchars($_POST['email']);
        $id_user=$_SESSION['id'];

        if(!empty($_POST['nom']) AND !empty($_POST['prenom']) AND !empty($_POST['ville']) and !empty($_POST['codepostal']) AND !empty($_POST['email'])){

            $modifuser=$conn->prepare (" UPDATE utilisateur SET nom =:nom,prenom=:prenom, ville=:ville, codepostal=:codepostal, email=:email WHERE code = ".$idd);
                                   
            $modifuser->bindValue(':nom',$nom,PDO::PARAM_STR);
            $modifuser->bindValue(':prenom',$prenom,PDO::PARAM_STR);
            $modifuser->bindValue(':ville',$ville,PDO::PARAM_STR);
            $modifuser->bindValue(':codepostal',$codepostal,PDO::PARAM_STR);
            $modifuser->bindValue(':email',$email,PDO::PARAM_STR);
            $modifuser->execute();
            
            header("location: users.php");    
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
        form{
            width: 50%;
            margin-left: 24%;
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

        <div class="col-8 dash">
            <h1>Modification d'utilisateur:</h1>
        </div>
        
        
        <div class="col-6">
            <form name="updateform" method="post" action="">
                
                      <div class="form-group">
                        <input type="text" class="form-control" name="nom" id="nom" value="<?php echo $nomm; ?>">
                      </div>
                      <div class="form-group">
                        <input type="text" class="form-control" name="prenom" id="prenom" value="<?php echo $prenomm ?>">
                      </div>
                      <div class="form-group">
                        <input type="text" class="form-control" name="ville" id="ville" value="<?php echo $villee; ?>">
                      </div>
                      <div class="form-group">
                        <input type="text" class="form-control" name="codepostal" id="codepostal" value="<?php echo $codepostall ?>">
                      </div>
                      <div class="form-group">
                        <input type="email" class="form-control" name="email" id="email" value="<?php echo $emaill; ?>">
                      </div>
                      <div class="form-group">
                        <input type="submit" class="btn btn-primary btn-lg btn-block" name="enregistre" value="Enregistré">
                      </div>
                      <div class="form-group">
                      </div>
                    </form>
        </div>
    </div>
    
    <?php include("../common/footer.php"); ?>
        
    
</body>
</html>