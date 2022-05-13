
<?php 
    $bdd =new  mysqli('localhost', 'root', '', 'ufr-sds');
    if(isset($_POST['validerinscriptionadm']))
        
        if(!empty($_POST['nomadm']) AND !empty($_POST['prenomadm']) AND!empty($_POST['emailadm']) AND!empty($_POST['passwordadm']) AND!empty($_POST['confirmpasswordadm']))
        {
            $nom = htmlspecialchars($_POST['nomadm']);
            $prenom = htmlspecialchars($_POST['prenomadm']);
            $mail = htmlspecialchars($_POST['emailadm']);
            $mdp = md5($_POST['passwordadm']);
            $cmdp= md5($_POST['confirmpasswordadm']);

            $nomlength =strlen($nom);
            $prenomlength =strlen($prenom);
            if($nomlength <= 80)
            {
                if($prenomlength <= 80)
                {
                        if($mdp == $cmdp)
                            {
                                $inscription = $bdd->prepare("INSERT INTO useradmin (nom,prenom,email,motdepasse) VALUES(?,?,?,?)");
                                $inscription->execute(array($nom, $prenom, $mail, $mdp,));
                                if($inscription){
                                $error = "Votre inscription a réuissi !";
                                header("Location: login.html");
                                echo $error;
                                }
                            }
                            else{
                                echo "Vos Mots de passe ne correspondent pas !";
                            }
                }
                else{
                    echo "Votre prénom ne doit pas depasseé 80 caractères!";
                }
            }
            else{
                echo "Votre nom ne doit pas depasseé 80 caractères!";
            }

        }
        else{
            header("Location: register.php");
            $error = "Veuillez remplir tous les champs !!";
        }
    
?>
