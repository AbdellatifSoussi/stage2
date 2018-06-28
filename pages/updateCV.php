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

        $req = "SELECT cv.*, utilisateur.nom,Utilisateur.prenom FROM cv,utilisateur where utilisateur.code=cv.code_user and code_cv ='".$idd_cv."'";
        $reponse = $conn->query($req);		
        $data = $reponse->fetch();

        $profil_pro=$data['profil_pro'];
        $poste=$data['poste'];
        $formation=$data['formation'];
        $contact=$data['contact'];
        $experience=$data['experience'];
        $langue=$data['langue'];
        $projet=$data['projet'];
        $competence=$data['competence'];

        $nom_user_cv=$data['nom'];
        $prenom_user_cv=$data['prenom'];

            if(isset($_POST['enregistre']))
            {
                $profil_pro= htmlspecialchars($_POST['profil_pro']);
                $poste= htmlspecialchars($_POST['poste']);
                $formation= htmlspecialchars($_POST['formation']);
                $contact= htmlspecialchars($_POST['contact']);
                $experience= htmlspecialchars($_POST['experience']);
                $langue=htmlspecialchars($_POST['langue']);
                $projet=htmlspecialchars($_POST['projet']);
                $competence=htmlspecialchars($_POST['competence']);

                if(!empty($_POST['profil_pro']) AND !empty($_POST['poste']) AND !empty($_POST['formation']) and !empty($_POST['contact']) AND !empty($_POST['experience']) AND !empty($_POST['langue']) and !empty($_POST['projet']) AND !empty($_POST['competence'])){

                    $modifCV=$conn->prepare (" UPDATE cv SET profil_pro =:profil_pro,poste=:poste, formation=:formation, contact=:contact, experience=:experience, langue=:langue, projet=:projet, competence=:competence WHERE code_cv = ".$idd_cv);

                    $modifCV->bindValue(':profil_pro',$profil_pro,PDO::PARAM_STR);
                    $modifCV->bindValue(':poste',$poste,PDO::PARAM_STR);
                    $modifCV->bindValue(':formation',$formation,PDO::PARAM_STR);
                    $modifCV->bindValue(':contact',$contact,PDO::PARAM_STR);
                    $modifCV->bindValue(':experience',$experience,PDO::PARAM_STR);
                    $modifCV->bindValue(':langue',$langue,PDO::PARAM_STR);
                    $modifCV->bindValue(':projet',$projet,PDO::PARAM_STR);
                    $modifCV->bindValue(':competence',$competence,PDO::PARAM_STR);
                    $modifCV->execute();

                    header("location: gestioncv.php");    
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
            <center><h2>Modification CV :(<?php echo $prenom_user_cv." ".$nom_user_cv;?>)</h2></center>
        <div class="col-md-12 cadre">
            
            <form name="form" method="post" action=""> 
                <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <input type="text" placeholder="Nom Complet"  class="form-control" name="nom" readonly value="<?php echo $prenom_user_cv." ".$nom_user_cv;?>">
                    </div>
                </div>
                 <div class="col-md-6">
                    <div class="form-group">
                        <input type="text" placeholder="Titre du poste"  class="form-control" name="poste" value="<?php echo $poste; ?>">
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="form-group">
                        <textarea class="form-control adresse" rows="3" placeholder="Contacts" name="contact"><?php echo $contact; ?></textarea>
                    </div>
                </div>
               
                    
                <div class="col-md-12">
                  <div class="form-group">
                    <label for="exampleFormControlTextarea1">Profil Pro</label>
                    <textarea class="form-control" rows="5" name="profil_pro">
                        <?php echo $profil_pro; ?>  
                    </textarea>
                  </div>
                  <div class="form-group">
                    <label for="exampleFormControlTextarea1">Formation</label>
                    <textarea class="form-control" rows="5" name="formation">
                        <?php echo $formation; ?>  
                    </textarea>
                  </div>
                  <div class="form-group">
                    <label for="exampleFormControlTextarea1">Expérience</label>
                    <textarea class="form-control"  rows="5" name="experience">
                        <?php echo $experience; ?>  
                    </textarea>
                  </div>
                  <div class="form-group">
                    <label for="exampleFormControlTextarea1">Projet</label>
                    <textarea class="form-control" rows="5" name="projet">
                        <?php echo $projet; ?>  
                    </textarea>
                  </div>
                  <div class="form-group">
                    <label for="exampleFormControlTextarea1">Compétences</label>
                    <textarea class="form-control"  rows="5" name="competence">
                        <?php echo $competence; ?>  
                    </textarea>
                  </div>
                  <div class="form-group">
                    <label for="exampleFormControlTextarea1">Langues</label>
                    <textarea class="form-control" rows="5" name="langue">
                        <?php echo $langue; ?>
                    </textarea>
                  </div>
                     <center><input type="submit" class="btn btn-primary submit" value="Enregistré" name="enregistre"></center>
                  </div>
                </div>
            </form>
        </div>
    </div>

    <?php include("../common/footer.php"); ?>
    
</body>
</html>