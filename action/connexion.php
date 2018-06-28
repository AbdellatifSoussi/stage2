<?php 
/*session_start();
include("../DB/conn.php");
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
                    $_SESSION['code_user']= $userinfo['code'];
                    $_SESSION['nom']=$userinfo['nom'];
                    $_SESSION['email']= $userinfo['email'];
                    $_SESSION['mdp']= $userinfo['mdp'];
                    header("Location: ../pages/home.php?id=".$_SESSION['code_user']);

                }
                else
                {
                    $_SESSION['erreur']=" Adresse email ou mot de passe incorrect ";
                    header("Location:../pages/connexion.php?erreur=".$_SESSION['erreur']);
                    
                }
            }
        else
            {
                $_SESSION['erreur']= "<div style='color:black;'>Tous les champs doivent être complétés !";
                header("Location:../pages/connexion.php?erreur=".$_SESSION['erreur']);
            }
    }*/
?>