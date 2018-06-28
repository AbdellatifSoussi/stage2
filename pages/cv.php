<?php
    include("../DB/conn.php");
    session_start();

    $id_user=$_SESSION['code_user'];
        if (!isset($_SESSION['email']))
        {
            header('Location: connexion.php');
        }
        
        if($_SESSION['role_user']=='admin'){
                header("location:../pages/home.php");
        }

        if(isset($_POST['enregistre']))
        {
            $poste= htmlspecialchars($_POST['poste']);
            $contact= htmlspecialchars($_POST['contact']);
            $langue= htmlspecialchars($_POST['langue']);
            $competence= htmlspecialchars($_POST['competence']);
            $profil_pro= htmlspecialchars($_POST['profil_pro']);
            $formation= htmlspecialchars($_POST['formation']);
            $experience= htmlspecialchars($_POST['experience']);
            $projet= htmlspecialchars($_POST['projet']);
            

            if(!empty($_POST['poste']) AND !empty($_POST['contact']) AND !empty($_POST['langue']) AND !empty($_POST['competence']) AND !empty($_POST['profil_pro']) AND !empty($_POST['formation']) AND !empty($_POST['experience']) AND !empty($_POST['projet'])){
                
                $validatecv=$conn->prepare (" insert into cv (poste,contact,langue,competence,profil_pro,formation,experience,projet,code_user) values (?,?,?,?,?,?,?,?,?)");
                                   
                $validatecv->execute(array( $poste, $contact, $langue, $competence, $profil_pro, $formation, $experience, $projet, $id_user)); 
                
                 $msg= '<center><div class="alert alert-success fade in">
                        <a href="#" class="close" data-dismiss="alert">&times;</a>
                        CV enregistrée.</div></center>';  
            }
            else{
                $msg= '<center><div class="alert alert-danger fade in">
                        <a href="#" class="close" data-dismiss="alert">&times;</a>
                        <strong>Erreur ! </strong>Véréfiez que tout les champs sont remplie !</div></center>'; 
            }
        }else{
            
        
                 $msg= '<center><div class="alert alert-danger fade in">
                        <a href="#" class="close" data-dismiss="alert">&times;</a>
                        <strong>Erreur inconnue !</strong></div></center>'; 
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
            <center><h2>Créer votre propre cv !</h2></center>
        <div class="col-md-12 cadre">
            
            <form name="form" method="post" action="cv.php">
                 
                <div class="row">
                    <?php   
                            if(isset($_POST['enregistre']))
                            { 
                                echo $msg;
                            }
                    ?>
                   
                <div class="col-md-6">
                    <div class="form-group">
                        <input type="text" placeholder="Nom Complet" class="form-control" name="nom" readonly value="<?php echo $_SESSION['prenom_user']." ".$_SESSION['nom_user'];?>">
                    </div>
                </div>
                 <div class="col-md-6">
                    <div class="form-group">
                        <input type="text" placeholder="Titre du poste"  class="form-control" name="poste" onclick="getTextareaSelection(this)">
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="form-group">
                        <textarea class="form-control adresse" rows="3" name="contact" onclick="getTextareaSelection(this)">Contacts (Adresse,Tel,Mail..etc)</textarea>
                    </div>
                </div>
               
                    
                <div class="col-md-12">
                  <div class="form-group">
                    <label for="exampleFormControlTextarea1">Profil Pro</label>
                    <textarea class="form-control"  rows="5" name="profil_pro" placeholder="" onclick="getTextareaSelection(this)">
Décrivez en quelques lignes vos compétences clés pour le poste et vos objectifs de carrière. Vous pouvez les mettre en forme à l'aide de puces ou les laisser sous forme de texte plein.
Cet espace peut servir de début d'introduction à votre lettre de motivation soyez précis, imaginatif et mettez en valeur votre potentiel professionnel.
  
                    </textarea>
                  </div>
                  <div class="form-group">
                    <label for="exampleFormControlTextarea1">Formation</label>
                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="5" name="formation" onclick="getTextareaSelection(this)">
1997-2001 Université
Décrivez ici votre formation, ses objectifs et ses atouts, options....1997-2001 Université
Décrivez ici votre formation, ses objectifs et ses atouts, options....
1997-2001 Université
Décrivez ici votre formation, ses objectifs et ses atouts, options....
  
                    </textarea>
                  </div>
                  <div class="form-group">
                    <label for="exampleFormControlTextarea1">Expérience</label>
                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="5" name="experience" onclick="getTextareaSelection(this)">
2005-2007 Société — Poste occupé
Décrivez ici les fonctions que vous avez occupées. Décrivez également vos missions, le nombre de personne quo vous avez encadrez etc....
2005-2007 Société — Poste occupé
Décrivez ici les fonctions que vous avez occupées. Décrivez également vos missions, le nombre de personne quo vous avez encadrez etc....
2005-2007 Société — Poste occupé
Décrivez ici les fonctions que vous avez occupées. Décrivez également vos missions, le nombre de personne quo vous avez encadrez etc....
  
                    </textarea>
                  </div>
                  <div class="form-group">
                    <label for="exampleFormControlTextarea1">Projet</label>
                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="5" name="projet" onclick="getTextareaSelection(this)">
2016 — Projet réalisé
Décrivez ici vos projets...
  
                    </textarea>
                  </div>
                  <div class="form-group">
                    <label for="exampleFormControlTextarea1">Compétences</label>
                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="5" name="competence" onclick="getTextareaSelection(this)">
2016 — Vos Compétences
Décrivez ici vos compétences...
                    </textarea>
                  </div>
                  <div class="form-group">
                    <label for="exampleFormControlTextarea1">Langues</label>
                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="5" name="langue" onclick="getTextareaSelection(this)">Langues</textarea>
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