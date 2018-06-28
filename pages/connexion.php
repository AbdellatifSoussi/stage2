<?php
    include ("../DB/conn.php");
    session_start();

    if(isset($_POST['connecter']))
    {
        $email=htmlspecialchars($_POST['email']);
        $mdp=sha1($_POST['mdp']);
        
        if(!empty($_POST['email']) OR !empty($_POST['mdp']))
            {
                $requser=$conn->prepare("SELECT * FROM utilisateur WHERE email=? AND mdp=?");
                $requser->execute(array($email,$mdp));
                $userexist= $requser->rowCount();
                //rowCount() sa compte les lignes pour voir si l'email et le mot de passe saisi exist !
                if ($userexist == 1)
                {
                    $userinfo= $requser->fetch();
                    $code= $userinfo['code'];
                    $_SESSION['code_user']=$userinfo['code'];
                    $_SESSION['nom_user']=$userinfo['nom'];
                    $_SESSION['prenom_user']=$userinfo['prenom'];
                    $_SESSION['ville_user']=$userinfo['ville'];
                    $_SESSION['email']= $userinfo['email'];
                    $mdp= $userinfo['mdp'];
                    $_SESSION['mdp']=$userinfo['mdp'];
                    $_SESSION['role_user']=$userinfo['role'];
                    header("Location: home.php?id=".$code);
                }
                else
                {
                    $erreur=" Adresse email ou mot de passe incorrect ";     
                }
            }
        else
            {
                $erreur= "Tous les champs doivent être complétés !";
            }
    }
    
    if(isset($_POST['inscrire']))
    {
        $civilite= htmlspecialchars($_POST['civilite']);
        $nom= htmlspecialchars($_POST['nom']);
        $prenom= htmlspecialchars($_POST['prenom']);
        $ville= htmlspecialchars($_POST['ville']);
        $codepostal= htmlspecialchars($_POST['codepostal']);
        $email= htmlspecialchars($_POST['email']);
        $mdp= sha1($_POST['mdp']);

        if(!empty($_POST['civilite']) AND !empty($_POST['nom']) AND !empty($_POST['email']) AND !empty($_POST['mdp']) AND !empty($_POST['prenom']) AND !empty($_POST['ville']) AND !empty($_POST['codepostal']))
            {
                if (filter_var($email, FILTER_VALIDATE_EMAIL))
                {
                    $reqemail=$conn->prepare(" SELECT * FROM utilisateur WHERE email=?");
                    $reqemail->execute(array($email));
                    $emailexist= $reqemail->rowCount();
                    //rowCount() sa compte les lignes pour voir si l'email est déja utilisée ! 
                    if($emailexist==0)
                    {
                        $insertuser=$conn->prepare (" INSERT INTO utilisateur (civilite,nom,prenom,ville,codepostal,email,mdp) values(?,?,?,?,?,?,?) ");
                        $insertuser->execute(array($civilite,$nom,$prenom,$ville,$codepostal,$email,$mdp));

                        $msg= '<br><div class="alert alert-success fade in">
                        <a href="#" class="close" data-dismiss="alert">&times;</a>
                        <strong>Félicitation !</strong> Compte créer avec succées.</div>';    
                    }
                    else
                    {
                        $msg='<br><div class="alert alert-danger fade in">
                        <a href="#" class="close" data-dismiss="alert">&times;</a>
                        <strong>Erreur !</strong> Adresse email dèja utilisée.</div>';
                    }
                }
                else
                {
                    $msg= '<br><div class="alert alert-danger fade in">
                    <a href="#" class="close" data-dismiss="alert">&times;</a>
                    <strong>Erreur !</strong> Adresse email non valide. </div>';
                }
            }
        else
            {
                $msg= '<br><div class="alert alert-danger fade in">
                <a href="#" class="close" data-dismiss="alert">&times;</a>
                <strong>Erreur !</strong> Vérifiez que tout les champs sont completés !</div>';
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
    <link rel="stylesheet" href="includes/css/inscrip.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="includes/js/api.js"></script>
  </head>
<body>
    
    <header>
      <div class="container">
        <nav>
          <a href="index.php" class="home_link">
            <img src="img/logo.png" alt="E-Learning TSA logo" id="logo"/>
          </a>
        </nav>
      </div>
    </header>
    
        <div class="container" id="login">
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <center><h2>Connectez-vous</h2></center>
                    <form name="formconnexion" method="post" action="">
                      <div class="form-group"><br><br><br><br>
                          <?php   
                            if(isset($_POST['connecter']))
                            {
                                echo '<div class="alert alert-danger fade in" id="error">
                                <a href="#" class="close" data-dismiss="alert">&times;</a>'. $erreur ."</div>";
                            }    
                          ?>
                        <input type="email" class="form-control" name="email" placeholder="Email">
                      </div>
                      <div class="form-group">
                        <input type="password" class="form-control" name="mdp" placeholder="Mot de passe ">
                      </div>
                      <div class="form-group">
                        <input type="submit" id="buttt" class="btn btn-outline-primary btn-lg btn-block" name="connecter" value="CONNEXION">
                      </div>
                      <div class="form-group">
                      </div>
                    </form>      
                </div>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <center><h2>Découvrez nous maintenant !</h2></center><br><br>
                    <form name="forminscription" method="post" action="">
                        <?php   
                            if(isset($_POST['inscrire']))
                            { 
                                echo $msg;
                            }
                        ?>
                        <div class="form-group">
                            <input name="civilite" id="civilite" type="radio" value="Mme" checked>
                            <label for="civilite" style="margin-right:20px">Mme</label>
                            <input name="civilite" id="civilite" type="radio" value="M">
                            <label for="civilite2">M.</label>
                         </div>
                      <div class="form-group">
                        <input type="text" class="form-control" name="nom" id="nom" placeholder="Nom">
                      </div>
                      <div class="form-group">
                        <input type="text" class="form-control" name="prenom" id="prenom" placeholder="Prénom ">
                      </div>
                      <div class="form-group">
                        <input type="text" class="form-control" name="ville" id="ville" placeholder="Ville">
                            <ul>
                              <li data-vicopo="#ville">
                                <strong data-vicopo-code-postal></strong>
                                <span data-vicopo-ville></span>
                              </li>
                            </ul>
                      </div>
                      <div class="form-group">
                        <input type="text" class="form-control" name="codepostal" id="codepostal" placeholder="Code Postal">
                      </div>
                      <div class="form-group">
                        <input type="email" class="form-control" name="email" id="email" placeholder="Adresse électronique ">
                      </div>
                      <div class="form-group">
                        <input type="password" class="form-control" name="mdp" id="mdp" placeholder="Mot de passe ">
                      </div>
                      <div class="form-group">
                        <input type="submit" id="buttt" class="btn btn-outline-primary btn-lg btn-block" name="inscrire" value="S'INSCRIRE">
                      </div>
                      <div class="form-group">
                      </div>
                    </form>
                     
                </div>
            </div>  
    
        <footer class="fixed-bottom">
             ©SooDev - 2018
        </footer>
</body>
</html>