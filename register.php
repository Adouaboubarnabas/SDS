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
                                header("Location: login.php");
                                echo $error;
                                }
                            }
                            else{
                                $error ="Vos Mots de passe ne correspondent pas !";
                            }
                }
                else{
                    $error = "Votre prénom ne doit pas depasseé 80 caractères!";
                }
            }
            else{
                $error = "Votre nom ne doit pas depasseé 80 caractères!";
            }

        }
        else{

            $error = "Veuillez remplir tous les champs !!";
        }
    
?>


<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Création de compte</title>
        <link href="css/styles.css" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
    </head>
    <body>
        <div id="">
            <footer class="py-4 bg-light mt-auto entete">
                <div class="container-fluid px-4">
                    <div class="d-flex justify-content-between entetelogo">
                        <img src="file.png">
                    </div>
                </div>
            </footer>
        </div>
        <div id="layoutAuthentication">
            <div id="layoutAuthentication_content">
                <main>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div><p class="nomappli">Application Gestion UFR/SDS</p></div>
                            <div class="col-lg-7">
                                <div class="card  border-0 rounded-lg mt-5">
                                    <div class="card-header boiteconnexionsect1"><h3 class="text-center font-weight-light my-4">Création d'un compte Administrateur</h3></div>
                                    <div class="card-body boiteconnexionsect2">
                                        <form action="" method="post">
                                            <div class="row mb-3">
                                                <div class="col-md-6">
                                                    <div class="form-floating mb-3 mb-md-0">
                                                        <input class="form-control" id="inputFirstName" type="text" placeholder="Enter your first name" name="nomadm" />
                                                        <label for="inputFirstName">Nom</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-floating">
                                                        <input class="form-control" id="inputLastName" type="text" placeholder="Enter your last name"  name="prenomadm" />
                                                        <label for="inputLastName">Prénom</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-floating mb-3">
                                                <input class="form-control" id="inputEmail" type="email" placeholder="name@example.com"  name="emailadm"/>
                                                <label for="inputEmail">Adresse Email</label>
                                            </div>
                                            <div class="row mb-3">
                                                <div class="col-md-6">
                                                    <div class="form-floating mb-1 mb-md-0">
                                                        <input class="form-control" id="inputPassword" type="password" placeholder="Create a password"  name="passwordadm"/>
                                                        <label for="inputPassword">Mot de Passe</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-floating mb-3 mb-md-0">
                                                        <input class="form-control" id="inputPasswordConfirm" type="password" placeholder="Confirm password"  name="confirmpasswordadm" />
                                                        <label for="inputPasswordConfirm">Confirmer mot de Passe</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="d-flex align-items-center justify-content-between mt-2 mb-0">
                                                <input class="btn btn-primary" value="Valider l'inscription" type="submit" name= "validerinscriptionadm">
                                                <?php 
                                                    if(isset($error))
                                                    {
                                                        echo "<p style= color:red font-size:25px; >$error</p>";
                                                    }
                                                ?>
                                            </div>  
                                        </form>

                                    </div>
                                        
                                    <div class="card-footer boiteconnexionsect1 text-center py-2">
                                        
                                        <div class="small textbuttonfooterconn"><a href="login.php">Aviez-vous déja un compte? Allez à la connexion</a></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
            <div id="layoutAuthentication_footer">
                <footer class="py-4 bg-light mt-auto piedpage">
                    <div class="container-fluid px-4">
                        <div class="d-flex align-items-center justify-content-center small">
                            <div class="text-muted piedpagetext">Copyright &copy; Université Joseph-Ki Zerbo 2022 Tous Droits Réservés</div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
    </body>
</html>
