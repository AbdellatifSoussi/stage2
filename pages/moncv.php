<?php
    include("../DB/conn.php");
    require("../fpdf181/fpdf.php");
    session_start();

    $id_user=$_SESSION['code_user'];
        if (!isset($_SESSION['email']))
        {
            header('Location: connexion.php');
        }

        if($_SESSION['role_user']=='admin'){
                header("location: home.php");
        }
                
                $reqcv = "SELECT * FROM cv where code_user ='".$id_user."'";
                $reponse = $conn->query($reqcv);		
                $cvinfo = $reponse->fetch();

                $_SESSION['code_cv']=$cvinfo['code_cv'];
                $code_cv=$_SESSION['code_cv'];
                
                $poste= $cvinfo['poste'];
                $contact= $cvinfo['contact'];
                $langue= $cvinfo['langue'];
                $competence= $cvinfo['competence'];
                $profil_pro= $cvinfo['profil_pro'];
                $formation= $cvinfo['formation'];
                $experience= $cvinfo['experience'];
                $projet= $cvinfo['projet'];

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

                    $modifCV=$conn->prepare (" UPDATE cv SET profil_pro =:profil_pro,poste=:poste, formation=:formation, contact=:contact, experience=:experience, langue=:langue, projet=:projet, competence=:competence WHERE code_user = ".$id_user);

                    $modifCV->bindValue(':profil_pro',$profil_pro,PDO::PARAM_STR);
                    $modifCV->bindValue(':poste',$poste,PDO::PARAM_STR);
                    $modifCV->bindValue(':formation',$formation,PDO::PARAM_STR);
                    $modifCV->bindValue(':contact',$contact,PDO::PARAM_STR);
                    $modifCV->bindValue(':experience',$experience,PDO::PARAM_STR);
                    $modifCV->bindValue(':langue',$langue,PDO::PARAM_STR);
                    $modifCV->bindValue(':projet',$projet,PDO::PARAM_STR);
                    $modifCV->bindValue(':competence',$competence,PDO::PARAM_STR);
                    $modifCV->execute();

                    header("location: moncv.php");    
                    //echo "insert reussi";
                }     
            }


        $nom_user=$_SESSION['nom_user'];
        $prenom_user=$_SESSION['prenom_user'];

         if(isset($_POST['pdf']))
         {
            $profil_pro= htmlspecialchars($_POST['profil_pro']);
            $poste= htmlspecialchars($_POST['poste']);
            $formation= htmlspecialchars($_POST['formation']);
            $contact= htmlspecialchars($_POST['contact']);
            $experience= htmlspecialchars($_POST['experience']);
            $langue=htmlspecialchars($_POST['langue']);
            $projet=htmlspecialchars($_POST['projet']);
            $competence=htmlspecialchars($_POST['competence']);
             
             
            $fpdf= new FPDF();
            $fpdf->AddPage('PORTRAIT','letter');
             
             class pdf extends FPDF{
                 
                 public function header(){
                     $this->SetFont('Arial','B',20);
                     $this->SetTextColor(25,174,194);
                     $this->Cell(0,20,'CV e-Learning TSA',0,10,'C');
                     $this->Image('img/logoo.png',0,5,50,20,'png');
                     
                 }
                 
                 public function footer(){
                    $this->SetFont('Arial','B',10);
                    $this->SetY(-15);
                    $this->Write(5,"e-Learning TSA");
                    $this->SetX(-30); 
                    $this->AliasNbPages("Pages");
                    $this->Write(5,$this->PageNo().'/Pages');
                 }
             }
             
            $fpdf= new pdf();
            $fpdf->AddPage('portrait','letter');
            
             
            $fpdf->Ln(5); 
            $fpdf->SetTextColor(143, 25, 46);
            $fpdf->SetFont('Arial','',25);
            $fpdf->Cell(0,10,"{$poste}",0,0,'C');
            $fpdf->Ln(10);
             
             
            $fpdf->SetFont('Arial','',12);
            $fpdf->SetTextColor(143, 25, 46);
            $fpdf->Cell(0,10,"Nom Complet :",0,0,'L');
            $fpdf->Ln(10);
            $fpdf->SetTextColor(128, 128, 128);  
            $fpdf->Cell(0,10,"{$prenom_user} {$nom_user}",0,50);
            
             
             
            $fpdf->SetFont('Arial','',12);
            $fpdf->SetTextColor(143, 25, 46);
            $fpdf->Cell(0,10,"Contacts :",0,0,'L');
            $fpdf->Ln(10);
            $fpdf->SetTextColor(128, 128, 128);  
            $fpdf->Cell(0,10,"{$contact}",0,50);
            $fpdf->Ln(5);
            
             
            $fpdf->SetTextColor(143, 25, 46);
            $fpdf->Cell(0,10,"Profil Pro :",0,0,'L');
            $fpdf->Ln(10);
            $fpdf->SetTextColor(128, 128, 128);  
            $fpdf->MultiCell(0,10,$profil_pro,'C');
            //$fpdf->Cell(0,0,"{$profil_pro}",0,50);
            $fpdf->Ln(5);
            $fpdf->Cell(0,0,"",1,20);
            $fpdf->Ln(5);
            
            
            $fpdf->SetTextColor(143, 25, 46);
            $fpdf->Cell(0,10,"Formations :",0,0,'L');
            $fpdf->Ln(10);
            $fpdf->SetTextColor(128, 128, 128);  
            //$fpdf->Cell(0,10,"{$formation}",0,50);
            $fpdf->MultiCell(0,10,$formation,'C');
            $fpdf->Ln(5);
            $fpdf->Cell(0,0,"",1,20);
            $fpdf->Ln(5);
             
           
            $fpdf->SetTextColor(143, 25, 46);
            $fpdf->Cell(0,10,"Experiences :",0,0,'L');
            $fpdf->Ln(10);
            $fpdf->SetTextColor(128, 128, 128);  
            $fpdf->Cell(0,10,"{$experience}",0,50);
            $fpdf->MultiCell(0,10,$experience,'C');
            $fpdf->Ln(5);
            $fpdf->Cell(0,0,"",1,20);
            $fpdf->Ln(5);
             

            $fpdf->SetTextColor(143, 25, 46);
            $fpdf->Cell(0,10,"Projets :",0,0,'L');
            $fpdf->Ln(10);
            $fpdf->SetTextColor(128, 128, 128);  
            //$fpdf->Cell(0,10,"{$projet}",0,50);
            $fpdf->MultiCell(0,10,$projet,'C');
            $fpdf->Ln(5);
            $fpdf->Cell(0,0,"",1,20);
            $fpdf->Ln(5);
             
            
            $fpdf->SetTextColor(143, 25, 46);
            $fpdf->Cell(0,10,"Competences :",0,0,'L');
            $fpdf->Ln(10);
            $fpdf->SetTextColor(128, 128, 128);  
            //$fpdf->Cell(0,10,"{$competence}",0,50);
            $fpdf->MultiCell(0,10,$competence,'C');
            $fpdf->Ln(5);
            $fpdf->Cell(0,0,"",1,20);
            $fpdf->Ln(5);
             
            
            $fpdf->SetTextColor(143, 25, 46);
            $fpdf->Cell(0,10,"Langues :",0,0,'L');
            $fpdf->Ln(10);
            $fpdf->SetTextColor(128, 128, 128);  
            //$fpdf->Cell(0,10,"{$langue}",0,50);
            $fpdf->MultiCell(0,10,$langue,'C');
            $fpdf->Ln(5);
            $fpdf->Cell(0,0,"",1,20);
            $fpdf->Ln(5);
             
             $fpdf->output();
             
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
            padding: 10%;
            border-radius: 4px;
            z-index: 0;
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
    
    <div class="container">
            <center><h2>MON CV</h2></center>
        <div class="col-md-12 cadre">
            
            <form name="form" method="post" action="">
                 
                <div class="row">
                   
                <div class="col-md-6">
                    <div class="form-group">
                        <input type="text" placeholder="Nom Complet" onclick="getTextareaSelection(this)" class="form-control" name="nom" readonly value="<?php echo $_SESSION['prenom_user']." ".$_SESSION['nom_user'];?>">
                    </div>
                </div>
                 <div class="col-md-6">
                    <div class="form-group">
                        <input type="text" placeholder="Titre du poste"  onclick="getTextareaSelection(this)" class="form-control" name="poste" value="<?php echo $poste; ?>">
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="form-group">
                        <textarea class="form-control adresse" rows="3" placeholder="Contacts" name="contact" onclick="getTextareaSelection(this)"><?php echo $contact; ?></textarea>
                    </div>
                </div>
               
                    
                <div class="col-md-12">
                  <div class="form-group">
                    <label for="exampleFormControlTextarea1">Profil Pro</label>
                    <textarea class="form-control"  rows="5" name="profil_pro" onclick="getTextareaSelection(this)"><?php echo $profil_pro; ?></textarea>
                  </div>
                  <div class="form-group">
                    <label for="exampleFormControlTextarea1">Formation</label>
                    <textarea class="form-control" rows="5" name="formation" onclick="getTextareaSelection(this)"><?php echo $formation; ?></textarea>
                  </div>
                  <div class="form-group">
                    <label for="exampleFormControlTextarea1">Expérience</label>
                    <textarea class="form-control" rows="5" name="experience" onclick="getTextareaSelection(this)"><?php echo $experience; ?>  
                    </textarea>
                  </div>
                  <div class="form-group">
                    <label for="exampleFormControlTextarea1">Projet</label>
                    <textarea class="form-control" rows="5" name="projet" onclick="getTextareaSelection(this)"><?php echo $projet; ?>  
                    </textarea>
                  </div>
                  <div class="form-group">
                    <label for="exampleFormControlTextarea1">Compétences</label>
                    <textarea class="form-control" rows="5" name="competence" onclick="getTextareaSelection(this)"><?php echo $competence; ?>  
                    </textarea>
                  </div>
                  <div class="form-group">
                    <label for="exampleFormControlTextarea1">Langues</label>
                    <textarea class="form-control" rows="5" name="langue" onclick="getTextareaSelection(this)"><?php echo $langue; ?>
                    </textarea>
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
    
    
    
</body>
</html>