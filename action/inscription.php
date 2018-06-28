<?php
session_start();
include ("../DB/conn.php");


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
                        
                        echo $_SESSION['msg']= '<br><div class="alert alert-success fade in">
                        <a href="#" class="close" data-dismiss="alert">&times;</a>
                        <strong>Félicitation !</strong> Compte créer avec succées.
                        </div>';
                        //header("Location:../pages/connexion.php");
                        
                        
                    }
                    else
                    {
                        
                        echo $_SESSION['msg']='<br><div class="alert alert-danger fade in">
                        <a href="#" class="close" data-dismiss="alert">&times;</a>
                        <strong>Erreur !</strong> Adresse mail dèja utilisée.
                        </div>';
                        //header("Location:../pages/connexion.php");
                    
                        
                    }
                }
                else
                {
                    echo $_SESSION['msg']= '<br><div class="alert alert-danger fade in">
                    <a href="#" class="close" data-dismiss="alert">&times;</a>
                    <strong>Erreur !</strong> Adresse mail non valide. </div>';
                    //header("Location:../pages/connexion.php");
                }
            }
        else
            {
                    echo $_SESSION['msg']= '<br><div class="alert alert-danger fade in">
                        <a href="#" class="close" data-dismiss="alert">&times;</a>
                        <strong>Erreur !</strong> Vérifiez que tout les champs sont completés !
                        </div>';
                    //header("Location:../pages/connexion.php");
            }           
}
?>
