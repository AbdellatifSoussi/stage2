<?php
    include("../DB/conn.php");
    session_start();
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
    <link rel="stylesheet" href="includes/css/home.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
      <style type="text/css">
          
          .nous td img{
              width: 150px;
              height: 150px;
          }
          .nous{
              width: 65%;
          }
          .nous td{
              text-align: center;
          }
          .nous th{
              text-align: center;
          }
          .nous th h3{
              font-style: normal;
              font-size: 26px;
              font-weight: 400;
              line-height: 31px;
              color: #2c3e50;
          }
          .lines{
              width: 70%;
          }
          .job{
              font-family: "Noto Sans", sans-serif;
              font-style: normal;
              font-weight: 400;
              font-size: 17px;
              line-height: 31px;
              color: #28323f;
          }
      </style>
  </head>
<body>
    <?php include("../common/header.php"); ?>
   
    
    <div class="home">
            <div class="title">
                <div class="infos">
                    <div class="padding" id="title1">STAGE E-LEARNING TSA </div>
                    <div class="padding" id="title3">GUIDE DE RECHERCHE D'EMPLOI</div> 
                    <div class="padding" id="title2">GUIDE DE PREPARATION AUX ENTRETIENS</div>
                </div>
                
            </div>
            <img src="img/rawpixel-665368-unsplash.jpg" alt="Stage_Emloi_Entretien">
    </div>    
    
    <div class="qui">
        <h2>Pour mieux communiquer ensemble  !</h2> 
        <img src="../img/earth.png">
        
    </div>
    
    <div class="qui2">
        <div class="col-8">
            <div class="container">
            <center>
                <span class="icons">
                    <table>
                        <tr>
                            <td><i class="fas"><img src="img/parents.png"><span> Parents</span></i></td>
                            <td></td>
                            <td><i class="fas"><img src="img/enseignant.png"><span> Enseignant</span></i></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td><i class="fas" id="professionnel"><img src="img/professionnel.png"><span> Professionnel</span></i></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td><i class="fas"><img src="img/particulier.png"><span> Particulier</span></i></td>
                            <td></td>
                            <td><i class="fas"><img src="img/etudiant.png"><span> Etudiant</span></i></td>
                        </tr>
                    
                    </table>  
                </span>                
            </center>
            </div>
        </div>
    </div>
    
    <div class="equipe">
        <div class="col-8">
            <hr class="lines">
            <h2> La famille E-Learning TSA </h2>
            <p> E-Learning TSA est une aventure professionnelle. Notre équipe est à l’image de notre philosophie ! </p>
            <hr class="lines">
            <center>
            <table class="nous">
                <tr>
                    <td>
                        <img src="img/eric.png">
                    </td>
                    <td>
                        <img src="img/me.png">
                    </td>
                </tr>
                 <tr>
                    <th><h3>Eric</h3></th>
                    <th><h3>Abdel</h3></th>
                </tr>
                <tr>
                    <td class="job">Fondateur</td>
                    <td class="job">Développeur</td>
                </tr>
            </table>
            </center>
        </div>
    </div>
        
    <?php include("../common/footer.php"); ?>
</body>
</html>