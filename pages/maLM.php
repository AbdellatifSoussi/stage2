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
                
                $reqcv = "SELECT * FROM motivation where code_user ='".$id_user."'";
                $reponse = $conn->query($reqcv);		
                $lminfo = $reponse->fetch();

                $_SESSION['code_motiv']=$lminfo['code_motiv'];
                $code_motiv=$_SESSION['code_motiv'];

                $objet= $lminfo['objet'];
                $description= $lminfo['description'];
                

            if(isset($_POST['enregistre']))
            {
                $objet= htmlspecialchars($_POST['objet']);
                $description= htmlspecialchars($_POST['description']);
                

                if(!empty($objet) AND !empty($description)){

                    $modifLM=$conn->prepare (" UPDATE motivation SET objet =:objet,description=:description WHERE code_user = ".$id_user);

                    $modifLM->bindValue(':objet',$objet,PDO::PARAM_STR);
                    $modifLM->bindValue(':description',$description,PDO::PARAM_STR);
                   
                    $modifLM->execute();

                    header("location: maLM.php");    
                    //echo "insert reussi";
                }     
            }


            $nom_user=$_SESSION['nom_user'];
            $prenom_user=$_SESSION['prenom_user'];
            $ville=$_SESSION['ville_user'];
            $email=$_SESSION['email'];

         if(isset($_POST['pdf']))
         {
            $objet= htmlspecialchars($_POST['objet']);
            $description= htmlspecialchars($_POST['description']);
             
            
            
            $fpdf= new FPDF();
            $fpdf->AddPage('PORTRAIT','letter');
             
             class pdf extends FPDF{
                 
                 public function header(){
                     $this->SetFont('Arial','B',20);
                     $this->SetTextColor(25,174,194);
                     $this->Cell(0,10,'e-Learning TSA',10,10,'C');
                     $this->Image('img/logoo.png',0,5,50,20,'png');
                     $this->Ln(10);
                     
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
            
             
            $fpdf->Ln(7); 
            $fpdf->SetTextColor(143, 25, 46);
            $fpdf->SetFont('Arial','',25);
            $fpdf->Cell(0,10,"Lettre de Motivation",0,0,'C');
            $fpdf->Ln(10);
             
             
            $fpdf->SetFont('Arial','',12);
            $fpdf->SetTextColor(143, 25, 46);
            $fpdf->Cell(0,10,"",0,0,'L');
            $fpdf->Ln(10);
            $fpdf->SetTextColor(128, 128, 128);  
            $fpdf->Cell(0,5,"{$prenom_user} {$nom_user}",0,50);
            $fpdf->Cell(0,5,"{$email}",0,50);
            $fpdf->Cell(0,5,"{$ville}",0,50);
            $fpdf->Ln(10);
             
            $fpdf->SetFont('Arial','',12);
            $fpdf->SetTextColor(143, 25, 46);
            $fpdf->Cell(0,10,"Objet :",0,0,'L');
            $fpdf->Ln(10);
            $fpdf->SetTextColor(128, 128, 128);  
            $fpdf->Cell(0,10,"{$objet}",0,50);
            $fpdf->Ln(10);
            
            $fpdf->SetFont('Arial','',15);
            $fpdf->Cell(0,10,"Madame, Monsieur, ",0,0,'L');
            $fpdf->Ln(10);
            $fpdf->SetTextColor(128, 128, 128);  
            //$fpdf->Cell(0,10,$description,0,10);
            $fpdf->MultiCell(0,10,$description);
            $fpdf->Ln(10);

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
            <center><h2>Ma Lettre de Motivation </h2></center>
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
    
    
    
</body>
</html>