<?php
    include("../DB/conn.php");
    session_start();
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>E-Learning TSL </title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="utf-8">
    <link href="https://fonts.googleapis.com/css?family=Abril+Fatface|Roboto:400,700" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.9/css/all.css" integrity="sha384-5SOiIsAziJl6AWe0HWRKTXlfcSHKmYV4RBF18PPJ173Kzn7jzMyFuTtk8JA7QQG1" crossorigin="anonymous">
    <link rel="stylesheet" href="includes/css/home.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <style type="text/css">
        body{
            background-color: white;
            font-family:  Roboto, sans-serif;
        }  
        p{
            font-style: normal;
            font-weight: 400;
            font-size: 20px;
            line-height: 22px;
        }
        #tsa{
            margin-top: 50px;
        }
        .section-header{
            text-align: center;
        }
        .difficultes{
            background-color: #f5f5f5;
            width: 100%;
            height: auto;
            margin-top: 40px;
        }
        .difficultes h3{
            font-style: normal;
            line-height: 40px;
            font-size: 30px;
            font-weight: 400;
        }
        .icons_img img{
            width: 80px;      
        }
        .centerr{
            text-align: center;
        }
        .difficultes ul li{
            font-style: normal;
            font-weight: 400;
            font-size: 17px;
            line-height: 31px;
        }
        .pricing-table{
            background-color: white;
            padding:25px;
            margin-bottom: 30px;
        }
        .benefice h2{
            color: #3399cc;
        }
        .benefice h3{
            font-style: normal;
            line-height: 40px;
            font-size: 30px;
            font-weight: 400;
        }
        .benefice p{
            font-size: 18px;
        }
        .benefice{
            padding-bottom: 30px;
        }
        .etapes{
            background-color: #f5f5f5;
            width: 100%;
            height: auto;
            margin-top: 40px; 
            padding-bottom: 30px;
        }
        .etapes_details{
            background-color: #3399cc;
            padding: 1px 30px 5px 30px;
            padding-bottom: 20px;
            -webkit-box-shadow:0px 1px 1px lightgray;
            -moz-box-shadow:0px 10px 10px lightgray;
            box-shadow:10px 7px 7px lightgray;
            color: white;
        }
        .etapes h3{
            font-style: normal;
            line-height: 40px;
            font-size: 30px;
            font-weight: 400;
        }
        .etapes p{
            font-style: normal;
            line-height: 40px;
            font-size: 18px;
            font-weight: 400;
        }
    </style>
  </head>
<body>
    <?php include("../common/header.php"); ?>
   
    
    <div id="tsa" class="section pricing-section">
        <div class="container">
            
            <div class="row pricing-tables">

                <div class='col-md-6 col-sm-6 col-xs-12'>
                    
                        <div class='pricing-details'>
                            <h2>Présentation</h2>
                            <ul >
                                <li>« L’homme est une fantastique machine biologique qui est loin d’avoir livré tous ses secrets de fabrication. La plupart d’entre nous ignorent comment ils sont faits à l’intérieur d’eux-mêmes, ce qui ne les empêche pas de vivre et d’effectuer des tâches complexes, car si la machine reste en partie mystérieuse, son pilotage est en temps normal simple. Quand les fonctions se dérèglent pour diverses raisons, la vie devient moins facile […] ».</li>
                            </ul>
                        </div>
                </div>
                <div class='col-md-6 col-sm-6 col-xs-12'>
                        <div class='pricing-details'>
                            <h2>TSA</h2>
                            <span>Mieux les connaître pour mieux être employé :</span>
                            <ul>
                                <li>En 2005, les troubles cognitifs spécifiques, comme les troubles du langage et des apprentissages qu’ils induisent, plus communément appelés troubles dys, ont intégré le champ du handicap, comme handicap cognitif.</li><br>
                                <li>Et si la dyslexie dysorthographie reste encore le trouble le plus connu, il reste encore trop méconnus, voire inconnus du grand public, et même d’un certain nombre de professionnels qui sont amenés à côtoyer les dys au quotidien (conseiller d’insertion, directeur de ressource humaine, formateur professionnelles, enseignants, médecins …).</li>
                            </ul>
                        </div>
                </div>
                <div class='col-md-6 col-sm-6 col-xs-12'>
                        <div class='pricing-details'>
                            <h2>Pourquoi le site ?</h2>
                            <ul>
                                <li>Sur site internet adapté et accessible aux personnes différent à causse de leur troubles spécifique des apprentissages, je donne des possibilités de partager mon expérience en tempe que formateur conseillé d’insertion professionnelle.</li>
                            </ul>
                        </div>
                </div>
                
                <div class='col-md-6 col-sm-2 col-xs-10'>
                        <div class='pricing-details'>
                            <h2>L’emploi pour les Dys… !</h2>
                            <ul >
                                <li>Je suis dyslexie et dysorthographie je suis à la recherche d’une formation en alternance ou à la recherche d’emploi, comment je fais pour trouver le meilleur guide pratique adapter et qui comprend ma particularité Dys… !</li>
                            </ul>
                        </div>
                </div>
            </div>
            </div>
        </div>
    
        <div class="difficultes">
            <center><h2>Pour Quelles difficultés ?</h2></center>
            <div class="container">
            <div class="row pricing-tables">
                <div class="col-md-3 col-sm-6 col-xs-12 centerr">
                    <div class="pricing-table table-left">
                        <div class="pricing-details">
                            <h3>Troubles<br> DYS</h3>
                            <div class="icons_img">
                                <img src="img/DYS.png">
                            </div>
                            <ul>
                                <li>Dyslexie</li>
                                <li>Dyspraxie</li>
                                <li>Dysphasie</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="col-md-3 col-sm-6 col-xs-12 centerr" >
                    <div class="pricing-table" >
                        <div class="pricing-details">
                            <h3>Déficiences Visuelles</h3>
                            <div class="icons_img">
                                <img src="img/visuelle.png">
                            </div>
                            <ul>
                                <li>DMLA</li>
                                <li>Maladies Dégénérative</li>
                                <li>Mal-Voyants</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="col-md-3 col-sm-6 col-xs-12 centerr">
                    <div class="pricing-table">
                        <div class="pricing-details">
                            <h3>Autres Difficultés</h3>
                            <div class="icons_img">
                                <img src="img/difficult%C3%A9-acc%C3%A8s.png">
                            </div>
                            <ul>
                                <li>Analphabétisme</li>
                                <li>Illetrisme</li>
                                <li>Personnes Allophones</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6 col-xs-12 centerr">
                    <div class="pricing-table table-left" style="padding-bottom: 10%">
                            <h3>Tout Le<br> Monde</h3>
                            <div class="icons_img">
                                <img src="img/toutlemonde.png">
                            </div>
                            <ul>
                                <li>Toi</li>
                                <li>Moi</li>
                                <li>Nous</li>
                            </ul>
                    </div>
                </div>
                
            </div>
            </div>
        </div>
    
        <div class="benefice">
            <center><h2>Les bénéfices pour vous</h2></center>
            <div class="container">
                <div class="col-md-4 col-sm-6 col-xs-12 centerr">
                        <div class="pricing-details">
                            <div class="icons_img">
                                <img src="img/GAINT-DE-TEMPS.png">
                            </div>
                            <h3>Gain de temps</h3>
                            <p>Lire tous les textes en 2 clics.</p>
                        </div>
                </div>
                <div class="col-md-4 col-sm-6 col-xs-12 centerr">
                        <div class="pricing-details">
                            <div class="icons_img">
                                <img src="img/access.png">
                            </div><br><br>
                            <h3>Accessibilité</h3>
                            <p>Bénéficiez des solutions e-Learning TSA </p>
                        </div>
                </div>
                <div class="col-md-4 col-sm-6 col-xs-12 centerr">
                        <div class="pricing-details">
                            <div class="icons_img">
                                <img src="img/autonomie.png">
                            </div><br><br>
                            <h3>Autonomie</h3>
                            <p> Progresser en travail et gagner de confiance.</p>
                        </div>
                </div>
            </div>
        </div>
    
        <div class="etapes">
            <center><h2>Utilisez e-Learning TSA en 3 étapes !</h2></center>
            <div class="container">
                <div class="col-md-4 col-sm-6 col-xs-12 centerr">
                        <div class="etapes_details">
                            <div class="icons_img">
                                <img src="img/inscription.png">
                            </div><br><br>
                            <h3>Etape 1</h3>
                            <p>Inscrivez-vous</p>
                        </div>
                </div>
                <div class="col-md-4 col-sm-6 col-xs-12 centerr">
                        <div class="etapes_details">
                            <div class="icons_img">
                                <img src="img/connexion.png">
                            </div><br><br>
                            <h3>Etape 2 </h3>
                            <p>Connectez-vous </p>
                        </div>
                </div>
                <div class="col-md-4 col-sm-6 col-xs-12 centerr">
                        <div class="etapes_details">
                            <div class="icons_img">
                                <img src="img/en%20ligne.png">
                            </div><br><br>
                            <h3>Etape 3</h3>
                            <p>Bénéficiez de nos outils en ligne.</p>
                        </div>
                </div>
            </div>
        </div>
    <?php include("../common/footer.php"); ?>
</body>
</html>



