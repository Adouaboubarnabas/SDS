<?php 
$bdd =new  mysqli('localhost', 'root', '', 'ufr-sds');
if (isset($_POST['seconnecter'])){
    if(!empty($_POST['mailconnect']) AND !empty($_POST['mdpconnect']))
    {
        $mail = stripslashes($_REQUEST['mailconnect']);
        $mail = mysqli_real_escape_string($bdd, $mail);
        $password = stripslashes($_REQUEST['mdpconnect']);
        $password = mysqli_real_escape_string($bdd, $password);
          $query = "SELECT * FROM `useradmin` WHERE email='$mail' and motdepasse='".hash('md5', $password)."'";
        $result = mysqli_query($bdd,$query) or die(mysql_error());
        $rows = mysqli_num_rows($result);
        if($rows==1){
            session_start();
            $_SESSION['auth']=true;
            $_SESSION['email'] = $mail;
            header("Location: index.php");
        }else{
          $error = "Votre email ou Mot de passe!";
        }
    }
    else{
        $error="Veuillez remplir tous les champs!";
    }    
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
        <title>Connexion</title>
        <link href="css/styles.css" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
    </head>
    <body>
        <div id="">
            <footer class= "bg-light mt-auto entete">
                <div class="container-fluid px-4">
                    <div class="d-flex justify-content-between entetelogo">
                        <img src="file.png">
                    </div>
                </div>
            </footer>
        </div>
            <div id="layoutAuthentication_content">
                <main style="margin-bottom :14%; !important; ">
                    <div class="container">

                        <div class="row justify-content-center ">
                            <div><p class="nomappli">Application Gestion UFR/SDS</p></div>
                            <div class="col-lg-5">
                                
                                <div class="card  border-1 ">
                                    
                                    <div class="card-header boiteconnexionsect1"><h3 class="font-weigh ">CONNEXION</h3></div>
                                    <div class="card-body boiteconnexionsect2">
                                        <form action="" method="post">
                                            <div class="form-floating mb-2">
                                                <input class="form-control" id="inputEmail" type="email" placeholder="name@example.com" name="mailconnect"/>
                                                <label for="inputEmail">Adresse mail</label>
                                            </div>
                                            <div class="form-floating mb-2">
                                                <input class="form-control" id="inputPassword" type="password" placeholder="Password" name="mdpconnect"/>
                                                <label for="inputPassword">Mot de Passe</label>
                                            </div>
                                            <div class="d-flex align-items-center justify-content-between mt-2 mb-1">
                                                <input class="btn btn-primary" value="Se connecter" type="submit" name= "seconnecter">
                                                <?php 
                                                if(isset($error))
                                                {
                                                    echo "<p style= color:red;>$error</p>";
                                                }
                                                ?>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="card-footer boiteconnexionsect1 text-center ">
                                        <div class="small textbuttonfooterconn"><a href="register.php">Aviez vous d??ja un compte? Incrivez-vous!</a></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
            <div id="layoutAuthentication_footer">
                <footer class="py-3 bg-light mt-auto piedpage">
                    <div class="container-fluid px-4">
                        <div class="d-flex align-items-center justify-content-center small">
                            <div class="text-muted piedpagetext">Copyright &copy; Universit?? Joseph-Ki Zerbo 2022 Tous Droits R??serv??s</div>
                        </div>
                    </div>
                </footer>
            </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
    </body>
</html>
